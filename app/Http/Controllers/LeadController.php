<?php

namespace App\Http\Controllers;

use App\Mail\LeadRequestMail;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:80'],
            'phone' => ['required', 'string', 'max:32', 'regex:/^[\d\s\-+()]+$/'],
            'message' => ['nullable', 'string', 'max:3000'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,heic,heif,avif', 'max:25600'],
            'website' => ['nullable', 'string', 'max:0'],
        ], [
            'phone.required' => 'Укажите номер телефона.',
            'phone.regex' => 'Проверьте формат номера телефона.',
            'photo.mimes' => 'Фото должно быть в формате JPG, PNG, WebP, HEIC или AVIF.',
            'photo.max' => 'Размер фотографии не должен превышать 25 МБ.',
        ]);

        if ($request->filled('website')) {
            Log::warning('Lead form honeypot triggered', ['ip' => $request->ip()]);

            return $this->successResponse($request);
        }

        if (strlen((string) preg_replace('/\D+/', '', $data['phone'])) < 7) {
            $message = 'Введите номер телефона минимум из 7 цифр.';

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['message' => $message, 'errors' => ['phone' => [$message]]], 422);
            }

            return back()->withInput()->withErrors(['phone' => $message]);
        }

        $photo = $request->file('photo');
        $photoData = $this->photoData($photo);
        $lead = [
            'name' => trim((string) ($data['name'] ?? '')),
            'phone' => trim($data['phone']),
            'message' => trim((string) ($data['message'] ?? '')),
            'page' => $request->headers->get('referer') ?? $request->fullUrl(),
            'created_at' => now()->timezone('Asia/Novosibirsk')->format('d.m.Y H:i'),
            'user_agent' => (string) $request->userAgent(),
            'ip' => $request->ip(),
            'photo_name' => $photoData['name'] ?? null,
        ];

        $mailSent = $this->sendEmails($lead, $photoData);
        $maxSent = $this->sendMax($lead, $photo);

        Log::info('Lead delivery result', [
            'mail_sent' => $mailSent,
            'max_sent' => $maxSent,
            'has_photo' => $photo !== null,
            'ip' => $request->ip(),
        ]);

        if (! $mailSent && ! $maxSent) {
            $message = 'Не удалось отправить заявку. Позвоните нам по телефону +7 913 895-45-25.';

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['message' => $message], 503);
            }

            return back()->withInput()->withErrors(['form' => $message]);
        }

        return $this->successResponse($request);
    }

    private function sendEmails(array $lead, ?array $photoData): bool
    {
        $mailer = (string) config('mail.default');

        if (in_array($mailer, ['array', 'log'], true)) {
            Log::error('Lead email delivery is disabled', ['mailer' => $mailer]);

            return false;
        }

        $recipients = array_values(array_filter(
            (array) config('mail.lead_to_addresses', []),
            static fn ($email): bool => is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false
        ));

        if ($recipients === []) {
            Log::error('Lead email recipients are not configured');

            return false;
        }

        $sent = 0;

        foreach ($recipients as $recipient) {
            try {
                Mail::to($recipient)->send(new LeadRequestMail($lead, $photoData));
                $sent++;
            } catch (\Throwable $exception) {
                Log::error('Lead email delivery failed', [
                    'recipient' => $recipient,
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        return $sent > 0;
    }

    private function sendMax(array $lead, ?UploadedFile $photo): bool
    {
        $accessToken = trim((string) config('services.max.access_token'));
        $userId = trim((string) config('services.max.user_id'));
        $chatId = trim((string) config('services.max.chat_id'));

        if ($accessToken === '' || ($userId === '' && $chatId === '')) {
            return false;
        }

        $recipientKey = $userId !== '' ? 'user_id' : 'chat_id';
        $recipientId = $userId !== '' ? $userId : $chatId;

        if (! preg_match('/^-?\d+$/', $recipientId)) {
            Log::error('MAX recipient ID has an invalid format');

            return false;
        }

        try {
            $attachments = [];
            $imageToken = $photo?->isValid() ? $this->uploadPhotoToMax($accessToken, $photo) : null;

            if ($imageToken !== null) {
                $attachments[] = [
                    'type' => 'image',
                    'payload' => ['token' => $imageToken],
                ];
            }

            $messageUrl = 'https://platform-api2.max.ru/messages?'.http_build_query([$recipientKey => $recipientId]);
            $response = $this->maxClient($accessToken)->post($messageUrl, [
                'text' => $this->formatNotification($lead, $photo !== null && $imageToken === null),
                'format' => 'html',
                'disable_link_preview' => true,
                'attachments' => $attachments,
            ]);

            if (! $response->successful() && $attachments !== []) {
                Log::warning('MAX image was not ready, retrying lead without attachment', [
                    'status' => $response->status(),
                ]);
                $response = $this->maxClient($accessToken)->post($messageUrl, [
                    'text' => $this->formatNotification($lead, true),
                    'format' => 'html',
                    'disable_link_preview' => true,
                    'attachments' => [],
                ]);
            }

            if (! $response->successful()) {
                Log::error('MAX lead delivery failed', [
                    'status' => $response->status(),
                    'description' => $response->json('description') ?? $response->json('message'),
                ]);

                return false;
            }

            return true;
        } catch (\Throwable $exception) {
            Log::error('MAX lead delivery exception', ['message' => $exception->getMessage()]);

            return false;
        }
    }

    private function uploadPhotoToMax(string $accessToken, UploadedFile $photo): ?string
    {
        try {
            $slot = $this->maxClient($accessToken)
                ->post('https://platform-api2.max.ru/uploads?type=image');
            $uploadUrl = $slot->json('url');

            if (! $slot->successful() || ! is_string($uploadUrl) || $uploadUrl === '') {
                Log::warning('MAX image upload slot was not created', ['status' => $slot->status()]);

                return null;
            }

            $contents = file_get_contents($photo->getRealPath());

            if ($contents === false) {
                return null;
            }

            $upload = $this->maxClient($accessToken)
                ->attach('data', $contents, $photo->getClientOriginalName(), [
                    'Content-Type' => $photo->getMimeType() ?: 'application/octet-stream',
                ])
                ->post($uploadUrl);
            $token = $upload->json('token') ?? $slot->json('token');

            if (! $upload->successful() || ! is_string($token) || $token === '') {
                Log::warning('MAX image upload failed', ['status' => $upload->status()]);

                return null;
            }

            return $token;
        } catch (\Throwable $exception) {
            Log::warning('MAX image upload exception', ['message' => $exception->getMessage()]);

            return null;
        }
    }

    private function maxClient(string $accessToken): PendingRequest
    {
        $client = Http::asJson()
            ->acceptJson()
            ->withHeaders(['Authorization' => $accessToken])
            ->timeout(20);
        $caBundle = trim((string) config('services.max.ca_bundle'));

        if ($caBundle !== '') {
            $client = $client->withOptions(['verify' => $caBundle]);
        }

        return $client;
    }

    private function formatNotification(array $lead, bool $photoByEmailOnly = false): string
    {
        $lines = [
            '<b>Новая заявка · НСК Макстар · Диски</b>',
            '<b>Имя:</b> '.($lead['name'] !== '' ? $this->escapeHtml($lead['name']) : '—'),
            '<b>Телефон:</b> '.$this->escapeHtml($lead['phone']),
            '<b>Описание:</b> '.($lead['message'] !== '' ? $this->escapeHtml($lead['message']) : '—'),
        ];

        if ($lead['photo_name']) {
            $lines[] = $photoByEmailOnly
                ? '<b>Фото:</b> приложено к письму'
                : '<b>Фото:</b> прикреплено к сообщению';
        }

        $lines[] = '<b>Время:</b> '.$this->escapeHtml($lead['created_at']).' (Новосибирск)';

        return implode("\n", $lines);
    }

    private function photoData(?UploadedFile $photo): ?array
    {
        if (! $photo?->isValid()) {
            return null;
        }

        return [
            'path' => $photo->getRealPath(),
            'name' => $photo->getClientOriginalName(),
            'mime' => $photo->getMimeType() ?: 'application/octet-stream',
        ];
    }

    private function escapeHtml(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private function successResponse(Request $request)
    {
        $message = 'Заявка отправлена! Мы изучим фото и свяжемся с вами.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['status' => 'ok', 'message' => $message]);
        }

        return back()->with('ok', $message);
    }
}

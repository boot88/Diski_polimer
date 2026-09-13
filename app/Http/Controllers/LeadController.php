<?php

namespace App\Http\Controllers;

use App\Mail\LeadRequestMail;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    private const SITE_NAME = 'НСК Макстар - Диски';

    public function send(Request $request)
    {
        // A filled honeypot must never trigger delivery, even with otherwise invalid data.
        if ($request->filled('website')) {
            return $this->successResponse($request);
        }

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:80'],
            'phone' => ['required', 'string', 'max:32', 'regex:/^[\d\s\-+()]+$/'],
            'message' => ['nullable', 'string', 'max:3000'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,heic,heif,avif', 'max:5120'],
            'size' => ['nullable', Rule::in(array_column(config('wheels.sizes'), 'label'))],
            'finish' => ['nullable', Rule::in(array_column(config('wheels.finishes'), 'key'))],
        ], [
            'phone.required' => 'Укажите номер телефона.',
            'phone.regex' => 'Проверьте формат номера телефона.',
            'photo.mimes' => 'Фото должно быть в формате JPG, PNG, WebP, HEIC или AVIF.',
            'photo.max' => 'Размер фотографии не должен превышать 5 МБ.',
            'photo.uploaded' => 'Не удалось загрузить фотографию. Попробуйте выбрать файл ещё раз.',
        ]);

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
            'size' => $data['size'] ?? null,
            'finish' => collect(config('wheels.finishes'))->firstWhere('key', $data['finish'] ?? null)['name'] ?? null,
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

        $recipients = array_values(array_unique(array_filter(
            (array) config('mail.lead_to_addresses', []),
            static fn ($email): bool => is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false
        )));

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
            $imagePayload = $photo?->isValid() ? $this->uploadPhotoToMax($accessToken, $photo) : null;

            if ($imagePayload !== null) {
                $attachments[] = [
                    'type' => 'image',
                    'payload' => $imagePayload,
                ];
            }

            $messageUrl = 'https://platform-api2.max.ru/messages?'.http_build_query([$recipientKey => $recipientId]);
            $response = null;
            $retryDelays = $attachments !== [] ? [0, 700000, 1000000, 2000000] : [0];

            foreach ($retryDelays as $attempt => $delay) {
                if ($delay > 0) {
                    usleep($delay);
                }

                $response = $this->maxClient($accessToken)->post($messageUrl, [
                    'text' => $this->formatNotification($lead, $photo !== null && $attachments === []),
                    'format' => 'html',
                    'disable_link_preview' => true,
                    'attachments' => $attachments,
                ]);

                if ($response->successful()) {
                    break;
                }

                $error = strtolower((string) ($response->json('code')
                    ?? $response->json('message')
                    ?? $response->json('description')
                    ?? ''));

                if ($attachments === []
                    || (! str_contains($error, 'attachment.not.ready')
                        && ! str_contains($error, 'not.processed')
                        && ! str_contains($error, 'not ready'))) {
                    break;
                }

                Log::info('MAX image is still processing', [
                    'attempt' => $attempt + 1,
                    'status' => $response->status(),
                ]);
            }

            if (! $response?->successful() && $attachments !== []) {
                Log::warning('MAX image delivery failed after retries, sending lead text', [
                    'status' => $response?->status(),
                    'description' => $response?->json('description') ?? $response?->json('message'),
                ]);

                $response = $this->maxClient($accessToken)->post($messageUrl, [
                    'text' => $this->formatNotification($lead, true),
                    'format' => 'html',
                    'disable_link_preview' => true,
                    'attachments' => [],
                ]);
            }

            if (! $response?->successful()) {
                Log::error('MAX lead delivery failed', [
                    'status' => $response?->status(),
                    'description' => $response?->json('description') ?? $response?->json('message'),
                ]);

                return false;
            }

            return true;
        } catch (\Throwable $exception) {
            Log::error('MAX lead delivery exception', ['message' => $exception->getMessage()]);

            return false;
        }
    }

    private function uploadPhotoToMax(string $accessToken, UploadedFile $photo): ?array
    {
        try {
            $slot = $this->maxClient($accessToken)
                ->post('https://platform-api2.max.ru/uploads?type=image');
            $uploadUrl = $slot->json('url');

            if (! $slot->successful() || ! is_string($uploadUrl) || $uploadUrl === '') {
                Log::warning('MAX image upload slot was not created', ['status' => $slot->status()]);

                return null;
            }

            $contents = fopen($photo->getRealPath(), 'rb');

            if ($contents === false) {
                return null;
            }

            try {
                $upload = $this->maxUploadClient()
                    ->attach('data', $contents, $photo->getClientOriginalName(), [
                        'Content-Type' => $photo->getMimeType() ?: 'application/octet-stream',
                    ])
                    ->post($uploadUrl);
            } finally {
                if (is_resource($contents)) {
                    fclose($contents);
                }
            }

            $queryToken = null;
            $query = parse_url($uploadUrl, PHP_URL_QUERY);

            if (is_string($query)) {
                parse_str($query, $queryParameters);
                $queryToken = $queryParameters['token'] ?? $queryParameters['attachment_token'] ?? null;
            }

            $photos = $upload->json('photos') ?? $upload->json('retval.photos');
            $token = $upload->json('token')
                ?? $upload->json('retval.token')
                ?? $slot->json('token')
                ?? $queryToken;

            if (! $upload->successful()) {
                Log::warning('MAX image upload failed', [
                    'status' => $upload->status(),
                    'description' => $upload->json('description') ?? $upload->json('message'),
                ]);

                return null;
            }

            if (is_array($photos) && $photos !== []) {
                return ['photos' => $photos];
            }

            if (is_string($token) && $token !== '') {
                return ['token' => $token];
            }

            Log::warning('MAX image upload returned no attachment payload', [
                'status' => $upload->status(),
                'response_keys' => array_keys((array) $upload->json()),
            ]);

            return null;
        } catch (\Throwable $exception) {
            Log::warning('MAX image upload exception', ['message' => $exception->getMessage()]);

            return null;
        }
    }

    private function maxUploadClient(): PendingRequest
    {
        $client = Http::acceptJson()->connectTimeout(5)->timeout(30);
        $caBundle = trim((string) config('services.max.ca_bundle'));

        return $caBundle !== '' ? $client->withOptions(['verify' => $caBundle]) : $client;
    }

    private function maxClient(string $accessToken): PendingRequest
    {
        return $this->maxUploadClient()->asJson()
            ->withHeaders(['Authorization' => $accessToken])->timeout(20);
    }

    private function formatNotification(array $lead, bool $photoByEmailOnly = false): string
    {
        $lines = [
            '<b>Новая заявка · </b><a href="'.$this->escapeHtml(rtrim(config('app.url'), '/').'/').'">'.self::SITE_NAME.'</a>',
            '<b>Имя:</b> '.($lead['name'] !== '' ? $this->escapeHtml($lead['name']) : '—'),
            '<b>Телефон:</b> '.$this->escapeHtml($lead['phone']),
            '<b>Описание:</b> '.($lead['message'] !== '' ? $this->escapeHtml($lead['message']) : '—'),
        ];

        if (! empty($lead['size']) || ! empty($lead['finish'])) {
            $lines[] = '<b>Подбор:</b> '.$this->escapeHtml(implode(' · ', array_filter([$lead['size'] ?? null, $lead['finish'] ?? null])));
        }

        if ($lead['photo_name']) {
            $lines[] = $photoByEmailOnly
                ? '<b>Фото:</b> не прикреплено в MAX; проверьте email'
                : '<b>Фото:</b> прикреплено к сообщению';
        }

        $lines[] = '<b>Время:</b> '.$this->formatNotificationTime($lead['created_at']).' (Новосибирск)';

        return implode("\n", $lines);
    }

    private function formatNotificationTime(string $value): string
    {
        if (! preg_match('/^(\d{2})\.(\d{2})\.(\d{4}) (\d{2}):(\d{2})$/', $value, $parts)) {
            return 'только что';
        }

        $months = [
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        ];

        return sprintf(
            '%d %s %d года, %d часов %d минут',
            (int) $parts[1],
            $months[(int) $parts[2]] ?? '',
            (int) $parts[3],
            (int) $parts[4],
            (int) $parts[5]
        );
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

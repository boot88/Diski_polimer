<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function send(Request $request)
    {
        // Валидация с ограничениями по символам и длине
        $data = $request->validate([
            'name' => [
                'nullable',
                'string',
                'max:30',
                // Русские + английские буквы, пробелы, запятые, точки
                'regex:/^[\p{Cyrillic}A-Za-z\s,.]+$/u',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                // Цифры, пробел, + - ( )
                'regex:/^[0-9+\-\s()]+$/',
            ],
            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        // Собираем данные заявки
        $lead = [
            'name'       => $data['name'] ?? null,
            'phone'      => $data['phone'],
            'message'    => $data['message'] ?? null,
            'page'       => $request->headers->get('referer') ?? $request->fullUrl(),
            'created_at' => now()->format('d.m.Y H:i'),
            'user_agent' => (string) $request->userAgent(),
            'ip'         => $request->ip(),
        ];

        try {
            // HTML-письмо по шаблону emails.lead_request
            Mail::send('emails.lead_request', ['lead' => $lead], function ($message) {
                $message
                    ->to('povisok888@gmail.com')
                    ->subject('Новая заявка с сайта PolymerDisk');
            });
        } catch (\Throwable $e) {
            // Логируем, но пользователю лишних подробностей не показываем
            report($e);

            // AJAX-запрос → JSON с ошибкой
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Ошибка при отправке заявки. Попробуйте ещё раз позже.',
                ], 500);
            }

            // Обычный POST → назад с ошибкой и старыми данными
            return back()
                ->withErrors(['mail' => 'Ошибка при отправке заявки. Попробуйте ещё раз позже.'])
                ->withInput();
        }

        // AJAX → JSON “ok”
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'ok',
                'message' => 'Заявка отправлена. Мы свяжемся с вами в ближайшее время.',
            ]);
        }

        // Обычный POST → флеш-сообщение в session('ok')
        return back()->with('ok', 'Заявка отправлена! Мы свяжемся с вами в ближайшее время.');
    }
}

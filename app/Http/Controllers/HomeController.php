<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        // 3 размера (картинки — внешние ссылки; лучше заменить на локальные public/images/*)
        $sizes = [
            ['label' => 'R15', 'folder' => 'images/R15', 'price' => 14400],
            ['label' => 'R17', 'folder' => 'images/R17', 'price' => 16400],
            ['label' => 'R19', 'folder' => 'images/R19', 'price' => 18400],
        ];
        
        // Варианты покрытий/цветов (файлы лежат в папках каждого размера)
        $finishes = [
            ['key' => 'base',       'name' => 'Оригинал',           'file' => 'g.png'],
            ['key' => 'gloss',      'name' => 'Глянцевый чёрный',   'file' => 'g_g.png'],
            ['key' => 'matte',      'name' => 'Матовый чёрный',     'file' => 'g_m.png'],
            ['key' => 'silver',     'name' => 'Серебро',            'file' => 'g_s.png'],
            ['key' => 'anthracite', 'name' => 'Антрацит',           'file' => 'g_a.png'],
            ['key' => 'bronze',     'name' => 'Бронза',             'file' => 'g_b.png'],
        ];
        
        return view('home', compact('sizes', 'finishes'));    }
        
        public function sendContact(Request $request)
        {
            $data = $request->validate([
                'name'    => ['nullable', 'string', 'max:100'],
                'phone'   => ['required', 'string', 'max:60'],
                'message' => ['nullable', 'string', 'max:2000'],
            ]);
            
            $to = env('CONTACT_TO', 'povisok888@gmail.com');
            
            $subject = 'PolymerDisk: новая заявка с сайта';
            $bodyLines = [
                'Новая заявка с сайта PolymerDisk',
                '------------------------------',
                'Имя: ' . ($data['name'] ?? '—'),
                'Телефон: ' . $data['phone'],
                'Комментарий: ' . ($data['message'] ?? '—'),
                '------------------------------',
                'IP: ' . $request->ip(),
                'User-Agent: ' . substr((string)$request->userAgent(), 0, 250),
            ];
            $body = implode("\n", $bodyLines);
            
            try {
                Mail::raw($body, function ($m) use ($to, $subject) {
                    $m->to($to)->subject($subject);
                });
            } catch (\Throwable $e) {
                return back()
                ->withErrors(['mail' => 'Не удалось отправить письмо. Проверьте настройки MAIL_* в .env'])
                ->withInput();
            }
            
            return back()->with('ok', 'Заявка отправлена! Мы свяжемся с вами в ближайшее время.');
        }
}

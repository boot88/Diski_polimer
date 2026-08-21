<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
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

        return view('home', compact('sizes', 'finishes'));
    }
}

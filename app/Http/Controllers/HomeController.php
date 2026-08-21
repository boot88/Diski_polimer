<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $sizes = [
            [
                'label' => 'R15',
                'name' => 'Classic 5',
                'image' => 'images/wheels/r15-classic.webp',
                'price' => 14400,
            ],
            [
                'label' => 'R17',
                'name' => 'Sport Split',
                'image' => 'images/wheels/r17-sport.webp',
                'price' => 16400,
            ],
            [
                'label' => 'R19',
                'name' => 'Forged Mesh',
                'image' => 'images/wheels/r19-forged.webp',
                'price' => 18400,
            ],
        ];

        $finishes = [
            ['key' => 'silver',     'name' => 'Серебро OEM',        'tone' => 'silver',     'swatch' => '#aeb4ba'],
            ['key' => 'graphite',   'name' => 'Сатин графит',       'tone' => 'graphite',   'swatch' => '#4b5055'],
            ['key' => 'gloss',      'name' => 'Глянцевый чёрный',   'tone' => 'gloss',      'swatch' => '#111315'],
            ['key' => 'matte',      'name' => 'Матовый чёрный',     'tone' => 'matte',      'swatch' => '#292b2d'],
            ['key' => 'anthracite', 'name' => 'Антрацит',           'tone' => 'anthracite', 'swatch' => '#3f4549'],
            ['key' => 'bronze',     'name' => 'Тёмная бронза',      'tone' => 'bronze',     'swatch' => '#806044'],
        ];

        return view('home', compact('sizes', 'finishes'));
    }
}

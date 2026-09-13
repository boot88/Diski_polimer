<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $sizes = config('wheels.sizes');
        $finishes = config('wheels.finishes');

        return view('home', compact('sizes', 'finishes'));
    }
}

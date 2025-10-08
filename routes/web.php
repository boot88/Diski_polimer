<?php  //C:\laragon\www\Sandblasting

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
<?php  //C:\laragon\www\Sandblasting

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('home');
});

Route::post('/lead', [LeadController::class, 'send'])->name('lead.send');
=======

Route::get('/', function () {
    return view('home');
});
>>>>>>> 940e35ecfb49a7c334f9e6f870acf7eea0daf4ac

<?php  //C:\laragon\www\Sandblasting

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('home');
});

Route::post('/lead', [LeadController::class, 'send'])->name('lead.send');
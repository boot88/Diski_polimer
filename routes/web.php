<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/lead', [LeadController::class, 'send'])
    ->middleware('throttle:10,1')
    ->name('lead.send');

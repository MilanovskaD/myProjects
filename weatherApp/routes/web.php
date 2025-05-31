<?php

use App\Http\Controllers\RainAlertController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('map', function () {
   return view('map');
})->name('map');

Route::get('search', function () {
    return view('search');
})->name('search');

Route::get('settings', function () {
    return view('settings');
})->name('settings');

Route::post('/rain-alert/subscribe', [RainAlertController::class, 'subscribe'])->name('rain-alert.subscribe');


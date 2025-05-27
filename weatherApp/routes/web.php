<?php

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

<?php

use App\Http\Controllers\RainAlertController;
use App\Models\Subscription;
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

Route::get('/unsubscribe/{email}/{token}/{city}', function (string $email, string $token, string $city) {
    $subscription = Subscription::where('email', $email)
        ->where('city', $city)
        ->first();

    $expectedToken = hash('sha256', $email . config('app.key'));

    if (!$subscription || !hash_equals($expectedToken, $token)) {
        abort(404, 'Subscription not found or invalid token');
    }

    $subscription->delete();

    return view('unsubscribe-success', [
        'city' => $city,
        'email' => $email
    ]);
})->name('unsubscribe');

Route::view('/unsubscribed', 'unsubscribe');


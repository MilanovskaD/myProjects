<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'checkRole'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
});


Route::resource('events', \App\Http\Controllers\EventsController::class);

Route::resource('conferences', \App\Http\Controllers\AnnualConferencesController::class);

Route::resource('speakers', \App\Http\Controllers\SpeakersController::class);

Route::resource('tickets', \App\Http\Controllers\TicketsController::class);

Route::resource('agenda', \App\Http\Controllers\AgendaController::class);

Route::resource('users', \App\Http\Controllers\UserController::class);

//restoring banned(soft deleted) users
Route::put('/users/{id}/restore', [\App\Http\Controllers\UserController::class, 'restore'])->name('users.restore');

Route::resource('employees', \App\Http\Controllers\EmployeesController::class);

Route::resource('generalInfo', \App\Http\Controllers\GeneralInfoController::class);

Route::resource('blogs', \App\Http\Controllers\BlogsController::class);

Route::resource('comments', \App\Http\Controllers\CommentsController::class)->only(['index', 'destroy']);

Route::get('test', [\App\Http\Controllers\AdminDashboardController::class, 'indexTest'])->name('test');

require __DIR__.'/auth.php';

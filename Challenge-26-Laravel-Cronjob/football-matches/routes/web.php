<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Group routes that require admin access
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {

    // Routes for teams
    Route::get('teams', [App\Http\Controllers\TeamsController::class, 'index'])->name('teams');
    Route::get('add-team', [App\Http\Controllers\TeamsController::class, 'create'])->name('add-team');
    Route::post('create-team', [\App\Http\Controllers\TeamsController::class, 'store'])->name('create-team');
    Route::get('delete-team/{id}', [App\Http\Controllers\TeamsController::class, 'destroy'])->name('delete-team');
    Route::get('edit-team/{id}', [App\Http\Controllers\TeamsController::class, 'edit'])->name('edit-team');
    Route::post('update-team/{id}', [App\Http\Controllers\TeamsController::class, 'update'])->name('update-team');

    // Routes for players
    Route::get('players', [App\Http\Controllers\PlayersController::class, 'index'])->name('players');
    Route::get('add-player', [App\Http\Controllers\PlayersController::class, 'create'])->name('add-player');
    Route::post('create-player', [\App\Http\Controllers\PlayersController::class, 'store'])->name('create-player');
    Route::get('delete-player/{id}', [\App\Http\Controllers\PlayersController::class, 'destroy'])->name('delete-player');
    Route::get('edit-player/{id}', [App\Http\Controllers\PlayersController::class, 'edit'])->name('edit-player');
    Route::post('update-player/{id}', [App\Http\Controllers\PlayersController::class, 'update'])->name('update-player');

    // Routes for matches
    Route::get('add-match', [App\Http\Controllers\MatchesController::class, 'create'])->name('add-match');
    Route::post('create-match', [\App\Http\Controllers\MatchesController::class, 'store'])->name('create-match');
    Route::get('delete-match/{id}', [\App\Http\Controllers\MatchesController::class, 'destroy'])->name('delete-match');
    Route::get('edit-match/{id}', [App\Http\Controllers\MatchesController::class, 'edit'])->name('edit-match');
    Route::post('update-match/{id}', [App\Http\Controllers\MatchesController::class, 'update'])->name('update-match');


    // Admin dashboard
    Route::get('/admin.dashboard', [App\Http\Controllers\MatchesController::class, 'index'])->name('admin.dashboard');
});




<?php

use App\Http\Controllers\VehiclesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-vehicle', [VehiclesController::class, 'store'])->name('create-vehicle');

Route::get('/vehicles', [VehiclesController::class, 'index'])->name('vehicles');

Route::delete('/delete-vehicle/{id}', [VehiclesController::class, 'destroy'])->name('delete-vehicle');

Route::patch('/update-vehicle/{id}', [VehiclesController::class, 'update'])->name('update-vehicle');






<?php

use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ShortlinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'index'])->name('login');
Route::post('/auth/login', [UserController::class, 'login']);
Route::post('/auth/register', [UserController::class, 'register']);
Route::post('/shortlink/validation', [ShortlinkController::class, 'ShortlinkCalback']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/shortlink', [UserController::class, 'shortlink']);
    Route::get('/logout', [UserController::class, 'destroy']);
    Route::get('/time/claim', [ClaimController::class, 'time']);
    Route::get('/setting', [UserController::class, 'setting']);
    Route::post('/auth/claim', [ClaimController::class, 'claim']);

});
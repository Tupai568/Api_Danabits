<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiUserController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [ApiAuthController::class, "logout"]);
    Route::get('/me', [ApiUserController::class, "me"]);
    Route::post('/claimFaucet', [ApiUserController::class, "claimFaucet"]);
});

Route::post('login', [ApiAuthController::class, "login"]);
Route::post('register', [ApiAuthController::class, "store"]);



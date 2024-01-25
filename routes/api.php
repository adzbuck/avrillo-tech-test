<?php

use App\Http\Controllers\QuoteController;
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

Route::middleware('auth:api')->group(function () {
    Route::get('/quotes', [QuoteController::class, 'index']);

    Route::put('/quotes', [QuoteController::class, 'update']);

    Route::delete('/quotes', [QuoteController::class, 'destroy']);
});

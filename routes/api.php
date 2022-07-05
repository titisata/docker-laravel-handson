<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/comment/experience', [App\Http\Controllers\CommentsController::class, 'experience_post']);
    Route::post('/comment/goods', [App\Http\Controllers\CommentsController::class, 'goods_post']);
});

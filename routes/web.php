<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

Auth::routes();

Route::get('/partner/{id}', [App\Http\Controllers\PartnerController::class, 'show']);
Route::get('/search/goods', [App\Http\Controllers\GoodsController::class, 'index']);
Route::get('/search/experience', [App\Http\Controllers\ExperienceController::class, 'index']);
Route::get('/goods/{id}', [App\Http\Controllers\GoodsController::class, 'show']);
Route::post('/goods/{id}', [App\Http\Controllers\GoodsController::class, 'post']);
Route::get('/experience/{id}', [App\Http\Controllers\ExperienceController::class, 'show']);
Route::get('/experience/{folder_id}/{id}', [App\Http\Controllers\ExperienceController::class, 'reserve_detail']);
Route::post('/experience/{folder_id}/{id}', [App\Http\Controllers\ExperienceController::class, 'post']);
Route::redirect('/search', '/search/experience');

// この中に書かれたルートはログインしてないとアクセス出来ないようになる（ログインページにリダイレクトされる）
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
    Route::get('/cart/confirm', [App\Http\Controllers\CartController::class, 'confirm']);
    Route::get('/cart/purchase', [App\Http\Controllers\CartController::class, 'purchase']);
    Route::post('/cart/purchase', [App\Http\Controllers\CartController::class, 'purchase_post']);
});

// ユーザーがアクセスできる
Route::prefix('mypage/user')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\MUserController::class, 'home']);
    Route::get('/reserve', [App\Http\Controllers\MUserController::class, 'reserve']);
});

// パートナーがアクセスできる
Route::prefix('mypage/partner')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\MPartnerController::class, 'home']);
    Route::get('/event', [App\Http\Controllers\MPartnerController::class, 'event']);
    Route::get('/event/{id}', [App\Http\Controllers\MPartnerController::class, 'event_edit']);
    Route::post('/event/{id}', [App\Http\Controllers\MPartnerController::class, 'event_edit_update']);
    Route::get('/profile', [App\Http\Controllers\MPartnerController::class, 'profile']);
    Route::post('/profile', [App\Http\Controllers\MPartnerController::class, 'profile_post']);
    Route::get('/reserve', [App\Http\Controllers\MPartnerController::class, 'reserve']);
});

// 管理者がアクセスできる
Route::prefix('mypage/owner')->middleware(['auth'])->group(function () {
    Route::get('/reserve', [App\Http\Controllers\MOwnerController::class, 'reserve']);
});

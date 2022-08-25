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
Route::get('test', [App\Http\Controllers\TestTestController::class, 'edit']);
Route::post('test', [App\Http\Controllers\TestTestController::class, 'edit_post']);
Route::get('test/show', [App\Http\Controllers\TestTestController::class, 'show']);
Route::get('test/update/{id}', [App\Http\Controllers\TestTestController::class, 'update']);
Route::post('test/update', [App\Http\Controllers\TestTestController::class, 'update_post']);
Route::get('test/delete/{id}', [App\Http\Controllers\TestTestController::class, 'delete']);
Route::post('test/delete', [App\Http\Controllers\TestTestController::class, 'delete_post']);

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
    Route::get('/partner_display', [App\Http\Controllers\MOwnerController::class, 'partner_display']);
    Route::get('/partner_new', [App\Http\Controllers\MOwnerController::class, 'partner_new']);
    Route::post('/partner_display', [App\Http\Controllers\MOwnerController::class, 'partner_new_make']);
    Route::get('/partner_manege/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_manege']);
    Route::post('/partner_manege_update/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_manege_update']);
    Route::post('/partner_manege_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_manege_delete']);
    Route::get('/site', [App\Http\Controllers\MOwnerController::class, 'site']);
    Route::post('/site', [App\Http\Controllers\MOwnerController::class, 'site_post']);
    Route::get('/category_display', [App\Http\Controllers\MOwnerController::class, 'category_display']);
    Route::post('/action_experience_category_display', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_display']);
    Route::post('/action_experience_category_update', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_update']);
    Route::post('/action_experience_category_delete', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_delete']);
    Route::post('/action_goods_category_insert', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_insert']);
    Route::post('/action_goods_category_update', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_update']);
    Route::post('/action_goods_category_delete', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_delete']);
    
});

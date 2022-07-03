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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/partner/{id}', [App\Http\Controllers\PartnerController::class, 'show']);
Route::get('/search/goods', [App\Http\Controllers\GoodsController::class, 'index']);
Route::get('/search/experience', [App\Http\Controllers\ExperienceController::class, 'index']);
Route::get('/goods/{id}', [App\Http\Controllers\GoodsController::class, 'show']);
Route::redirect('/search', '/search/experience');

// この中に書かれたルートはログインしてないとアクセス出来ないようになる（ログインページにリダイレクトされる）
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
});

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

// Route::get('/layout',[App\Http\Controllers\LayoutController::class, 'index'])->name('layouts.app');

Route::get('/partner/{id}', [App\Http\Controllers\PartnerController::class, 'show']);
Route::get('/partner/partner_link_show/{id}', [App\Http\Controllers\PartnerController::class, 'partner_link_show']);
Route::get('/search/goods', [App\Http\Controllers\GoodsController::class, 'index']);
Route::get('/search/experience', [App\Http\Controllers\ExperienceController::class, 'index']);
Route::get('/goods/{id}', [App\Http\Controllers\GoodsController::class, 'show']);
Route::post('/goods/{id}', [App\Http\Controllers\GoodsController::class, 'post']);
Route::get('/experience/{id}', [App\Http\Controllers\ExperienceController::class, 'show']);
Route::get('/experience/{folder_id}/{id}', [App\Http\Controllers\ExperienceController::class, 'reserve_detail']);
Route::post('/experience/{folder_id}/{id}', [App\Http\Controllers\ExperienceController::class, 'post']);
Route::post('/favorite_edit', [App\Http\Controllers\FavoriteController::class, 'favorite_edit']);
Route::redirect('/search', '/search/experience');
Route::get('/link/{id}', [App\Http\Controllers\LinkController::class, 'show']);

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
Route::prefix('mypage/user')->middleware(['auth','role:user'])->group(function () {
    Route::get('/', [App\Http\Controllers\MUserController::class, 'home']);
    Route::get('/reserve', [App\Http\Controllers\MUserController::class, 'reserve']);
});

// パートナーがアクセスできる
Route::prefix('mypage/partner')->middleware(['auth','role:partner'])->group(function () {
    Route::get('/', [App\Http\Controllers\MPartnerController::class, 'home']);
    Route::get('/event', [App\Http\Controllers\MPartnerController::class, 'event']);
    Route::get('/event_add/{id}', [App\Http\Controllers\MPartnerController::class, 'event_add']);
    Route::post('/action_event_add', [App\Http\Controllers\MPartnerController::class, 'action_event_add']);
    Route::get('/event/{id}', [App\Http\Controllers\MPartnerController::class, 'event_edit']);
    Route::post('event_edit_update', [App\Http\Controllers\MPartnerController::class, 'event_edit_update']);
    Route::post('/action_event_delete', [App\Http\Controllers\MPartnerController::class, 'action_event_delete']);
    Route::get('/experience_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'experience_delete']);
    Route::post('/action_experience_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'action_experience_delete']);
    Route::get('/event_image_insert/{id}', [App\Http\Controllers\MPartnerController::class, 'event_image_insert']);
    Route::post('/action_event_image_insert/{id}', [App\Http\Controllers\MPartnerController::class, 'action_event_image_insert']);
    Route::get('/event_image_update/{id}', [App\Http\Controllers\MPartnerController::class, 'event_image_update']);
    Route::post('/action_event_image_update/{id}', [App\Http\Controllers\MPartnerController::class, 'action_event_image_update']);
    Route::get('/event_image_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'event_image_delete']);
    Route::post('/action_event_image_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'action_event_image_delete']);
    Route::get('/goods', [App\Http\Controllers\MPartnerController::class, 'goods']);
    Route::get('/goods_add/{id}', [App\Http\Controllers\MPartnerController::class, 'goods_add']);
    Route::post('/action_goods_add', [App\Http\Controllers\MPartnerController::class, 'action_goods_add']);
    Route::get('/goods/{id}', [App\Http\Controllers\MPartnerController::class, 'goods_edit']);
    Route::post('/goods_edit_update', [App\Http\Controllers\MPartnerController::class, 'goods_edit_update']);    
    Route::get('/goods_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'goods_delete']);
    Route::post('/action_goods_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'action_goods_delete']);
    Route::post('/action_goods_display_delete', [App\Http\Controllers\MPartnerController::class, 'action_goods_display_delete']);
    Route::get('/goods_image_insert/{id}', [App\Http\Controllers\MPartnerController::class, 'goods_image_insert']);
    Route::post('/action_goods_image_insert/{id}', [App\Http\Controllers\MPartnerController::class, 'action_goods_image_insert']);
    Route::get('/goods_image_update/{id}', [App\Http\Controllers\MPartnerController::class, 'goods_image_update']);
    Route::post('/action_goods_image_update/{id}', [App\Http\Controllers\MPartnerController::class, 'action_goods_image_update']);
    Route::get('/goods_image_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'goods_image_delete']);
    Route::post('/action_goods_image_delete/{id}', [App\Http\Controllers\MPartnerController::class, 'action_goods_image_delete']);
    Route::get('/profile', [App\Http\Controllers\MPartnerController::class, 'profile']);
    Route::post('/profile', [App\Http\Controllers\MPartnerController::class, 'profile_post']);
    Route::get('/reserve', [App\Http\Controllers\MPartnerController::class, 'reserve']);
    Route::get('/reserved_user', [App\Http\Controllers\MPartnerController::class, 'reserved_user']);
    Route::get('/user_info/{id}', [App\Http\Controllers\MPartnerController::class, 'user_info']);
    Route::get('/link_display', [App\Http\Controllers\MPartnerController::class, 'link_display']);
    Route::get('/link_insert/{id}', [App\Http\Controllers\MPartnerController::class, 'link_insert']);
    Route::post('/action_link_insert', [App\Http\Controllers\MPartnerController::class, 'action_link_insert']);
    Route::get('/link_edit/{id}', [App\Http\Controllers\MPartnerController::class, 'link_edit']);
    Route::post('/action_link_edit', [App\Http\Controllers\MPartnerController::class, 'action_link_edit']);
    Route::post('/action_link_delete', [App\Http\Controllers\MPartnerController::class, 'action_link_delete']);
    

});

// 管理者がアクセスできる
Route::prefix('mypage/owner')->middleware(['auth','role:system_admin|site_admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\MOwnerController::class, 'home']);
    Route::get('/reserve', [App\Http\Controllers\MOwnerController::class, 'reserve']);
    Route::get('/reserve_edit/{id}', [App\Http\Controllers\MOwnerController::class, 'reserve_edit']);
    Route::post('/reserve_edit/{id}', [App\Http\Controllers\MOwnerController::class, 'action_reserve_edit']);
    // Route::get('/reserve_make/{id}', [App\Http\Controllers\MOwnerController::class, 'reserve_make']);
    // Route::post('/reserve_make/{id}', [App\Http\Controllers\MOwnerController::class, 'action_reserve_make']);
    Route::get('/partner_display', [App\Http\Controllers\MOwnerController::class, 'partner_display']);
    Route::get('/partner_make', [App\Http\Controllers\MOwnerController::class, 'partner_make']);
    Route::post('/partner_display', [App\Http\Controllers\MOwnerController::class, 'action_partner_make']);
    Route::get('/partner_manege/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_manege']);
    Route::post('/partner_manege_update/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_manege_update']);
    Route::post('/partner_manege_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_manege_delete']);
    Route::get('/partner_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_image_insert']);
    Route::post('/action_partner_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'action_partner_image_insert']);
    Route::get('/partner_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_image_update']);
    Route::post('/action_partner_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'action_partner_image_update']);
    Route::get('/partner_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'partner_image_delete']);
    Route::post('/action_partner_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'action_partner_image_delete']);
    
    Route::get('/site', [App\Http\Controllers\MOwnerController::class, 'site']);
    Route::post('/site', [App\Http\Controllers\MOwnerController::class, 'site_post']);
    Route::get('/site_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'site_image_insert']);
    Route::post('/action_site_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'action_site_image_insert']);
    Route::get('/site_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'site_image_update']);
    Route::post('/action_site_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'action_site_image_update']);
    Route::get('/site_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'site_image_delete']);
    Route::post('/action_site_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'action_site_image_delete']);
    Route::get('/category_display', [App\Http\Controllers\MOwnerController::class, 'category_display']);
    Route::post('/action_experience_category_display', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_display']);
    Route::post('/action_experience_category_update', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_update']);
    Route::post('/action_experience_category_delete', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_delete']);
    Route::post('/action_goods_category_insert', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_insert']);
    Route::post('/action_goods_category_update', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_update']);
    Route::post('/action_goods_category_delete', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_delete']);
    Route::get('/experience_category_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'experience_category_image_insert']);
    Route::post('/action_experience_category_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_image_insert']);
    Route::get('/experience_category_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'experience_category_image_update']);
    Route::post('/action_experience_category_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_image_update']);
    Route::get('/experience_category_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'experience_category_image_delete']);
    Route::post('/action_experience_category_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'action_experience_category_image_delete']);
    Route::get('/goods_category_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'goods_category_image_insert']);
    Route::post('/action_goods_category_image_insert/{id}', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_image_insert']);
    Route::get('/goods_category_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'goods_category_image_update']);
    Route::post('/action_goods_category_image_update/{id}', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_image_update']);
    Route::get('/goods_category_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'goods_category_image_delete']);
    Route::post('/action_goods_category_image_delete/{id}', [App\Http\Controllers\MOwnerController::class, 'action_goods_category_image_delete']);
    Route::get('/link_display', [App\Http\Controllers\MOwnerController::class, 'link_display']);
    Route::get('/link_edit/{id}', [App\Http\Controllers\MOwnerController::class, 'link_edit']);
    Route::post('/action_link_edit', [App\Http\Controllers\MOwnerController::class, 'action_link_edit']);
    Route::get('/users', [App\Http\Controllers\MUserController::class, 'users']);
    Route::get('/users_edit/{id?}', [App\Http\Controllers\MUserController::class, 'users_edit']);
    Route::post('/users_edit', [App\Http\Controllers\MUserController::class, 'users_edit_post']);
    
    Route::get('/hotel_group_display', [App\Http\Controllers\MOwnerController::class, 'hotel_group_display']);
    Route::get('/hotel_group_insert', [App\Http\Controllers\MOwnerController::class, 'hotel_group_insert']);
    Route::post('/action_hotel_group_insert', [App\Http\Controllers\MOwnerController::class, 'action_hotel_group_insert']);
    Route::get('/hotel_group_edit/{id}', [App\Http\Controllers\MOwnerController::class, 'hotel_group_edit']);
    Route::post('/action_hotel_group_edit', [App\Http\Controllers\MOwnerController::class, 'action_hotel_group_edit']);
    Route::post('/action_hotel_group_delete', [App\Http\Controllers\MOwnerController::class, 'action_hotel_group_delete']);
    Route::get('/hotel_display', [App\Http\Controllers\MOwnerController::class, 'hotel_display']);
    Route::get('/hotel_insert', [App\Http\Controllers\MOwnerController::class, 'hotel_insert']);
    Route::post('/action_hotel_insert', [App\Http\Controllers\MOwnerController::class, 'action_hotel_insert']);
    Route::get('/hotel_edit/{id}', [App\Http\Controllers\MOwnerController::class, 'hotel_edit']);
    Route::post('/action_hotel_edit', [App\Http\Controllers\MOwnerController::class, 'action_hotel_edit']);
    Route::post('/hotel_delete', [App\Http\Controllers\MOwnerController::class, 'hotel_delete']);
    
    Route::get('/food_group_display', [App\Http\Controllers\MOwnerController::class, 'food_group_display']);
    Route::get('/food_group_insert', [App\Http\Controllers\MOwnerController::class, 'food_group_insert']);
    Route::post('/action_food_group_insert', [App\Http\Controllers\MOwnerController::class, 'action_food_group_insert']);
    Route::get('/food_group_edit/{id}', [App\Http\Controllers\MOwnerController::class, 'food_group_edit']);
    Route::post('/action_food_group_edit', [App\Http\Controllers\MOwnerController::class, 'action_food_group_edit']);
    Route::post('/action_food_group_delete', [App\Http\Controllers\MOwnerController::class, 'action_food_group_delete']);
    Route::get('/food_display', [App\Http\Controllers\MOwnerController::class, 'food_display']);
    Route::get('/food_insert', [App\Http\Controllers\MOwnerController::class, 'food_insert']);
    Route::post('/action_food_insert', [App\Http\Controllers\MOwnerController::class, 'action_food_insert']);
    Route::get('/food_edit/{id}', [App\Http\Controllers\MOwnerController::class, 'food_edit']);
    Route::post('/action_food_edit', [App\Http\Controllers\MOwnerController::class, 'action_food_edit']);
    Route::post('/food_delete', [App\Http\Controllers\MOwnerController::class, 'food_delete']);
});


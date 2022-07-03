<?php

namespace App\Http\Controllers;

use App\Models\ExperienceCartItem;
use App\Models\GoodCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        return view('cart.list', compact('experienceCartItems', 'goodCartItems'));
    }
}

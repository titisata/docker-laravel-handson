<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MUserController extends Controller
{
    public function home()
    {
        return view('mypage.user.home');
    }

    public function reserve()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $ordered_goods = $user->ordered_goods;
        $reserved_experiences = $user->reserved_experiences;
        return view('mypage.user.reserve', compact('user', 'partner', 'ordered_goods', 'reserved_experiences'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ExperienceReserve;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $ordered_goods = $user->ordered_goods;
        $reserved_experiences = $user->reserved_experiences;
        return view('home', compact('user', 'partner', 'ordered_goods', 'reserved_experiences'));
    }
}

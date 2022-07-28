<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MOwnerController extends Controller
{
    public function reserve()
    {
        $user = Auth::user();
        $partners = Partner::all();
        return view('mypage.owner.reserve', compact('user', 'partners'));
    }
}

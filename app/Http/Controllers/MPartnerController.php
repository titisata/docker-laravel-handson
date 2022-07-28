<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MPartnerController extends Controller
{
    public function home()
    {
        return view('mypage.partner.home');
    }

    public function event()
    {
        $user = Auth::user();
        $reserved_experiences = $user->reserved_experiences;
        return view('mypage.partner.experience', compact('user', 'reserved_experiences'));
    }

    public function reserve()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $experiences_folders = ExperienceFolder::where('partner_id', 1)->get();
        return view('mypage.partner.reserve', compact('user', 'partner', 'experiences_folders'));
    }
}

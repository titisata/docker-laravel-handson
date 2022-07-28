<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MPartnerController extends Controller
{
    public function home()
    {
        return view('mypage.partner.home');
    }

    public function event()
    {
        return view('mypage.partner.experience');
    }

    public function reserve()
    {
        return view('mypage.partner.reserve');
    }
}

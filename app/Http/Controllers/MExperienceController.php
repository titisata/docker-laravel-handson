<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MExperienceController extends Controller
{
    public function index()
    {
        return view('mypage.partner.reserves');
    }
}

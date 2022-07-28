<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MAdminController extends Controller
{
    public function index()
    {
        return view('mypage.partner.home');
    }
}

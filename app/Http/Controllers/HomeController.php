<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        return view('home', compact('user', 'partner'));
    }
}

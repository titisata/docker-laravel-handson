<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\ExperienceReserve;
use App\Models\Goods;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $experiences_folders = ExperienceFolder::where('recommend_flag', 1)->orderBy('recommend_sort_no', 'desc')->get();
        $goods = Goods::where('recommend_flag', 1)->orderBy('recommend_sort_no', 'desc')->get();
        return view('welcome', compact('experiences_folders', 'goods'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\ExperienceReserve;
use App\Models\Goods;
use App\Models\Partner;
use App\Models\SiteMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $site_masters = SiteMaster::find(1);
        return view('welcome',compact('site_masters'));
    }
}

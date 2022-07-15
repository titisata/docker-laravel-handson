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
        return view('welcome');
    }
}

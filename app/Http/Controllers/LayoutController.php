<?php

namespace App\Http\Controllers;

use App\Models\SiteMaster;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    //
    public function index() {
        $site_masters = SiteMaster::find(1);
		return view('layouts.app',compact('site_masters'));
    }
}

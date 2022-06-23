<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\ExperienceFolder;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword == '') {
            return view('search.goods');
        }

        $goods = ExperienceFolder::search($keyword, per_page: 10);
        return view('search.goods_list', compact('goods'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\ExperienceReserve;
use App\Models\Goods;
use App\Models\Partner;
use App\Models\SiteMaster;
use App\Models\GoodsCategory;
use App\Models\GoodsFolder;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $images = Image::where('table_name', 'site_masters')->get();
        $site_masters = SiteMaster::find(1);
        $categories = GoodsCategory::all();
        $goods_folders = array();

        $i=0;
        foreach( $categories as $category){
            //カテゴリ別に配列に入れる
            $goods_folders[$i] = GoodsFolder::where('recommend_flag', 1)->where('category1', $category->name )->where('status', 1)->orderBy('recommend_sort_no', 'asc')->get();
            $i++;
        }
        return view('welcome',compact('site_masters' , 'images','categories','goods_folders'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\Partner;
use App\Models\SiteMaster;
use App\Models\ExperienceCategory;
use App\Models\GoodsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MOwnerController extends Controller
{
    public function reserve()
    {
        $user = Auth::user();
        $partners = Partner::all();
        return view('mypage.owner.reserve', compact('user', 'partners'));
    }

    public function site()
    {
        $user = Auth::user();
        $site_master = SiteMaster::find(1);
        return view('mypage.owner.site', compact('site_master'));
    }

    public function site_post(Request $request)
    {
        $site_name = $request->site_name;
        $open_flag = $request->open_flag;
        $service = $request->service;
        $shop_num = $request->shop_num;
        $regist_num = $request->regist_num;
        $recommend_limit = $request->recommend_limit;
        $comment = $request->comment;
        $main_image = $request->main_image;
        $site_color = $request->site_color;
        $sales_copy = $request->sales_copy;

        SiteMaster::where('site_name', '!=', 'null')->update([
            'site_name'=>$site_name,
            'open_flag'=>$open_flag,
            'service'=>$service,
            'shop_num'=>$shop_num,
            'regist_num'=>$regist_num,
            'recommend_limit'=>$recommend_limit,
            'comment'=>$comment,
            'main_image'=>$main_image,
            'site_color'=>$site_color,
            'sales_copy'=>$sales_copy,
        ]);
        $site_master = SiteMaster::find(1);
        return view('mypage.owner.site', compact('site_master'));

    }

    public function experience_category()
    {
        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
    }

    public function experience_category_post(Request $request)
    {
        $name = $request->name;

        ExperienceCategory::create([
            'name'=>$name,
        ]);

        $goods_categories = GoodsCategory::all();
        $experience_categories = ExperienceCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));

    }

    public function experience_update(string $id)
    { 
        $goods_categories = GoodsCategory::all();
        $experience_categories = ExperienceCategory::find($id);
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }

    public function experience_update_post(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $experience_categories = ExperienceCategory::where('id', $id)->update([
            'id' => $id,
            'name' => $name,
        ]);

        $goods_categories = GoodsCategory::all();
        $experience_categories = ExperienceCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }


    public function experience_delete(string $id)
    { 
        $goods_categories = GoodsCategory::all();
        $experience_categories = ExperienceCategory::find($id);
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }

    public function experience_delete_post(Request $request)
    {
        $id = $request->id;

        $experience_categories = ExperienceCategory::where('id', $id)->delete();

        $goods_categories = GoodsCategory::all();
        $experience_categories = ExperienceCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }

    public function goods_category()
    {
        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
    }


    public function goods_category_post(Request $request)
    {
        $name = $request->name;
        
        GoodsCategory::create([
            'name'=>$name,
        ]);

        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));

    }

    public function goods_update(string $id)
    { 
        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::find($id);
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }

    public function goods_update_post(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $goods_categories = GoodsCategory::where('id', $id)->update([
            'id' => $id,
            'name' => $name,
        ]);

        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }


    public function goods_delete(string $id)
    { 
        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::find($id);
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }

    public function goods_delete_post(Request $request)
    {
        $id = $request->id;

        $goods_categories = GoodsCategory::where('id', $id)->delete();
        
        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::all();
        return view('mypage.owner.category', compact('goods_categories','experience_categories'));
        
    }

   

   
}

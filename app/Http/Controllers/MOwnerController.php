<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\Partner;
use App\Models\PartnerMaster;
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

    public function partner_display()
    {
        $user = Auth::user();
        $partners = Partner::all();
        return view('mypage.owner.partner_display', compact('partners'));
    }
    

    public function partner_manege(string $id)
    {
        $user = Auth::user();
        $partners = Partner::find($id);
        return view('mypage.owner.partner_manege', compact('partners'));
    }

    public function partner_new()
    {
        $user = Auth::user();
        return view('mypage.owner.partner_new', compact('user'));
    }

    public function partner_new_make(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $uid = Auth::user()->id;
        $reserve_flag = $request->reserve_flag;
        $service = $request->service; 
        $regist_num = $request->regist_num;
        $main_image = $request->main_image;
        $description = $request->description;
        $background_color = $request->background_color;
        $catch_copy = $request->catch_copy;
        $address = $request->address;
        $phone = $request->phone;
        $access = $request->access;
        
        Partner::create([
            'name'=>$name,
            'user_id'=>$uid,
            'reserve_flag'=>$reserve_flag,
            'service'=>$service,
            'regist_num'=>$regist_num,
            'main_image'=>$main_image,
            'description'=>$description,
            'background_color'=>$background_color,
            'catch_copy'=>$catch_copy,
            'address'=>$address,
            'phone'=>$phone,
            'access'=>$access,
        ]);

        $return_view = $this->partner_display();
        return $return_view;
    }

    public function partner_manege_update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $reserve_flag = $request->reserve_flag;
        $service = $request->service;
        $regist_num = $request->regist_num;
        $main_image = $request->main_image;
        $background_color = $request->background_color;
        $catch_copy = $request->catch_copy;
        $address = $request->address;
        $phone = $request->phone;
        $access = $request->access;
       
        Partner::where('id',$id)->update([
            'name'=>$name,
            'reserve_flag'=>$reserve_flag,
            'service'=>$service,
            'regist_num'=>$regist_num,
            'main_image'=>$main_image,
            'background_color'=>$background_color,
            'catch_copy'=>$catch_copy,
            'address'=>$address,
            'phone'=>$phone,
            'access'=>$access,
        ]);

        $return_view = $this->partner_display();
        return $return_view;

    }

    public function partner_manege_delete(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $reserve_flag = $request->reserve_flag;
        $service = $request->service;
        $regist_num = $request->regist_num;
        $main_image = $request->main_image;
        $background_color = $request->background_color;
        $catch_copy = $request->catch_copy;
        $address = $request->address;
        $phone = $request->phone;
        $access = $request->access;
       
        Partner::where('id', $id)->delete();

        $return_view = $this->partner_display();
        return $return_view;

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

    public function category_display()
    {
        //体験・お土産カテゴリー全件取得、カテゴリー編集画面表示

        $experience_categories = ExperienceCategory::all();
        $goods_categories = GoodsCategory::all();
        return view('mypage.owner.category_display', compact('goods_categories','experience_categories'));
    }

    public function experience_category_insert(Request $request)
    {
        //nameに入れられた情報受け取りexperiencecategory.tableに追加・作成

        $name = $request->name;

        ExperienceCategory::create([
            'name'=>$name,
        ]);
    }

    public function experience_category_update(Request $request)
    {
        //nameに入れられた情報受け取りidをもとにexperiencecategory.tableを更新

        $id = $request->id;
        $name = $request->name;

        $experience_categories = ExperienceCategory::where('id', $id)->update([
            'id' => $id,
            'name' => $name,
        ]);
    }

    public function experience_category_delete(Request $request)
    {
        //idをもとにexperiencecategory.tableから削除

        $id = $request->id;

        $experience_categories = ExperienceCategory::where('id', $id)->delete();

    }

    public function action_experience_category_display(Request $request)
    {
        $this->experience_category_insert($request);

        $return_view = $this->category_display();
        return $return_view;
        
    }

    public function action_experience_category_update(Request $request)
    {
        $this->experience_category_update($request);

        $return_view = $this->category_display();
        return $return_view;
        
    }

    public function action_experience_category_delete(Request $request)
    {
        $this->experience_category_delete($request);

        $return_view = $this->category_display();
        return $return_view;
        
    }

    public function goods_category_insert(Request $request)
    {
        //nameに入れられた情報受け取りgoodscategory.tableに追加・作成

        $name = $request->name;
        
        GoodsCategory::create([
            'name'=>$name,
        ]);
    }

    public function goods_category_update(Request $request)
    {
        //nameに入れられた情報受け取りidをもとにgoodscategory.tableを更新

        $id = $request->id;
        $name = $request->name;

        $goods_categories = GoodsCategory::where('id', $id)->update([
            'id' => $id,
            'name' => $name,
        ]);
    }

    public function goods_category_delete(Request $request)
    {
        //idをもとにgoodscategory.tableから削除

        $id = $request->id;

        $goods_categories = GoodsCategory::where('id', $id)->delete();

    }



    public function action_goods_category_insert(Request $request)
    {
        $this->goods_category_insert($request);

        $return_view = $this->category_display();
        return $return_view;

    }

    // public function goods_update(string $id)
    // { 
    //     $experience_categories = ExperienceCategory::all();
    //     $goods_categories = GoodsCategory::find($id);
        
    // }

    public function action_goods_category_update(Request $request)
    {
        $this->goods_category_update($request);

        $return_view = $this->category_display();
        return $return_view;
        
    }


    public function action_goods_category_delete(Request $request)
    {
        $this->goods_category_delete($request);
        
        $return_view = $this->category_display();
        return $return_view;
        
    }

   

   
}

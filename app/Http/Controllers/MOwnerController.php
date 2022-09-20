<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\Partner;
use App\Models\PartnerMaster;
use App\Models\SiteMaster;
use App\Models\ExperienceCategory;
use App\Models\ExperienceReserve;
use App\Models\Experience;
use App\Models\HotelGroup;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Link;
use App\Models\GoodsCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MOwnerController extends Controller
{

    public function home()
    {
        return view('mypage.owner.home');
    }
    public function reserve()
    {
        $user = Auth::user();
        $partners = Partner::all();
        return view('mypage.owner.reserve', compact('user', 'partners'));
    }

    public function reserve_edit(string $id)
    {
        $user = Auth::user();
        $experiencereserve = ExperienceReserve::find($id);
        $hotel_group_id = $experiencereserve->hotel_group_id;
        $hotels = Hotel::where('hotel_group_id', 1)->get();
        return view('mypage.owner.reserve_edit', compact('user', 'experiencereserve','hotels'));
    }

    public function action_reserve_edit(Request $request)
    {
        $id = $request->id;
        $hotel_id = $request->hotel_id;

        ExperienceReserve::where('id',$id)->update([
            'hotel_id'=>$hotel_id,
        ]);

        $to = 'satou@b-partners.jp';
        $view = 'email.hotel_confirm';

        //予約データを取得
        $reserve = ExperienceReserve::where('id',$id)->first();
        
        //ホテル情報を取得
        $hotel= hotel::where('id',$hotel_id)->first();

        //管理者へのメール送信
        $user = Auth::user();
        // echo "管理者--".$user->name."--".$user->email."<br>";
        $subject = '管理者へのメール';
        $name = $user->name;
        $with = [
            'name' => $name,
            'hotel' => $hotel->name,
            'for' => 'admin',
        ];
        // Mail::send(new SendMail($with, $to, $subject, $view));

        //予約者へのメール送信
        $user = User::where('id',$reserve->user_id)->first();
        // echo "予約者--".$user->name."--".$user->email."<br>";
        $subject = '予約者へのメール';
        $name = $user->name;
        $with = [
            'name' => $name,
            'hotel' => $hotel->name,
            'for' => 'user',
        ];
        // Mail::send(new SendMail($with, $to, $subject, $view));

        //パートナーへメール送信
        $experience = Experience::where('id',$reserve->experience_id)->first();
        $experience_folder = ExperienceFolder::where('id',$experience->experience_folder_id)->first();
        $user = User::where('id',$experience_folder->partner_id)->first();
        // echo "パートナー--".$user->name."--".$user->email."<br>";
        $subject = 'パートナーへのメール';
        $name = $user->name;
        $with = [
            'name' => $name,
            'hotel' => $hotel->name,
            'for' => 'partner',
        ];
        // Mail::send(new SendMail($with, $to, $subject, $view));

        //ホテルへのメール送信
        
        return $this->reserve();
    }

    // public function reserve_make(string $id)
    // {
    //     $user = Auth::user();
    //     $partners = Partner::find($id);
    //     return view('mypage.owner.reserve_make', compact('user', 'partners'));
    // }

    // public function action_reserve_make(Request $request)
    // {
    //     $id = $request->id;
    //     $pid = Auth::partner()->id;
    //     $cid = Auth::company()->id;
    //     $name = $request->name;
    //     $description = $request->description;
    //     $address = $request->address;
    //     $caution = $request->caution;
    //     $detail = $request->detail; 
    //     $category1 = $request->category1;
    //     $category2 = $request->category2;
    //     $category3 = $request->category3;
    //     $is_loding = $request->is_loding;
    //     $is_before_loding = $request->is_before_loding;
    //     $price_child = $request->price_child;
    //     $price_adult = $request->price_adult;
    //     $reccomend_flag = $request->reccomend_flag;
    //     $reccomend_sort_no = $request->reccomend_sort_no;
        
    //     ExperienceFolder::create([
    //         'id'=>$id,
    //         'partner_id'=>$pid,
    //         'company_id'=>$cid,
    //         'name'=>$name,
    //         'description'=>$description,
    //         'address'=>$address,
    //         'caution'=>$caution,
    //         'detail'=>$detail,
    //         'category1'=>$category1,
    //         'category2'=>$category2,
    //         'category3'=>$category3,
    //         'is_loding'=>$is_loding,
    //         'is_before_loding'=>$is_before_loding,
    //         'price_child'=>$price_child,
    //         'price_adult'=>$price_adult,
    //         'reccomend_flag'=>$reccomend_flag,
    //         'reccomend_sort_no'=>$reccomend_sort_no ,
    //     ]);

    //     $user = Auth::user();
    //     return view('mypage.owner.reserve', compact('user'));
    // }

    public function image_insert(Request $request)
    {
        //画像インサート処理

        $table_name = $request->table_name;
        $table_id = $request->table_id;

        // storage/imagesディレクトリに画像を保存
        $img = $request->file('image_path');
        $path = $img->store('images','public');
        

        Image::create([
            'table_name' => $table_name,
            'table_id' => $table_id,
            'image_path' => '/storage/' . $path,
        ]);
    }

    public function image_delete(Request $request, string $id)
    {
        //画像デリート処理

        $image_path = $request->image_path;
        $table_id = $request->table_id;

        Storage::disk('public')->delete($image_path);
       
        Image::where('id', $id)->delete();
    }

    public function image_update(Request $request, string $id)
    {
        //画像アップデート処理

        $table_id = $request->table_id;
        $table_name = $request->table_name;
        
        // imagesディレクトリに画像を保存
        $img = $request->file('image_path');
        $path = $img->store('images','public');

        Image::create([
            'table_id'=>$table_id,
            'image_path' => '/storage/' . $path,
            'table_name'=>$table_name,
        ]);

        //削除するファイルのパスを入手
        $delete_path = $request->delete_path;
        //storageから画像ファイルを削除
        Storage::disk('public')->delete($delete_path);
        Image::where('id', $id)->delete();
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

    public function partner_make()
    {
        $user = Auth::user();
        return view('mypage.owner.partner_make', compact('user'));
    }

    public function action_partner_make(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $uid = Auth::user()->id;
        $reserve_flag = $request->reserve_flag;
        $service = $request->service; 
        $regist_num = $request->regist_num;
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
        $background_color = $request->background_color;
        $catch_copy = $request->catch_copy;
        $address = $request->address;
        $phone = $request->phone;
        $access = $request->access;
       
        Partner::where('id', $id)->delete();

        $return_view = $this->partner_display();
        return $return_view;

    }

    public function partner_image_insert(string $id)
    {
        $partner = Partner::find($id);
        return view('mypage.owner.partner_image_insert', compact('partner'));
    }

    public function action_partner_image_insert(Request $request)
    {
        $this->image_insert($request);

        $table_id = $request->table_id;
        $partners = Partner::find($table_id);
        return view('mypage.owner.partner_manege', compact('partners'));
    }

    public function partner_image_update(string $id)
    {
        $images = Image::find($id);
        $partner = Partner::find($id);
        return view('mypage.owner.partner_image_update', compact('partner', 'images'));
    }

    public function action_partner_image_update(Request $request, string $id)
    {
        $this->image_update($request,$id);

        $table_id = $request->table_id;
        $partners = Partner::find($table_id);
        return view('mypage.owner.partner_manege', compact('partners'));
    }

    public function partner_image_delete(string $id)
    {
        $images = Image::find($id);
        $partner = Partner::find($id);
        return view('mypage.owner.partner_image_delete', compact('partner', 'images'));
    }

    public function action_partner_image_delete(Request $request, string $id)
    {
        $this->image_delete($request,$id);

        $table_id = $request->table_id;
        $partners = Partner::find($table_id);
        return view('mypage.owner.partner_manege', compact('partners'));
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
            'site_color'=>$site_color,
            'sales_copy'=>$sales_copy,
        ]);
        $site_master = SiteMaster::find(1);
        return view('mypage.owner.site', compact('site_master'));

    }

    public function site_image_insert(string $id)
    {
        $site_master = SiteMaster::find($id);
        return view('mypage.owner.site_image_insert', compact('site_master'));
    }

    public function action_site_image_insert(Request $request)
    {
        $this->image_insert($request);

        $table_id = $request->table_id;
        $site_master = SiteMaster::find($table_id);
        return view('mypage.owner.site', compact('site_master'));
    }

    public function site_image_update(string $id)
    {
        $images = Image::find($id);
        $site_master = SiteMaster::find($id);
        return view('mypage.owner.site_image_update', compact('site_master', 'images'));
    }

    public function action_site_image_update(Request $request, string $id)
    {
        $this->image_update($request,$id);

        $table_id = $request->table_id;
        $site_master = SiteMaster::find($table_id);
        return view('mypage.owner.site', compact('site_master'));
    }

    public function site_image_delete(string $id)
    {
        $images = Image::find($id);
        $site_master = SiteMaster::find($id);
        return view('mypage.owner.site_image_delete', compact('site_master', 'images'));
    }

    public function action_site_image_delete(Request $request, string $id)
    {
        $this->image_delete($request,$id);

        $table_id = $request->table_id;
        $site_master = SiteMaster::find($table_id);
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

    public function experience_category_image_insert(string $id)
    {
        $experience_category = ExperienceCategory::find($id);
        return view('mypage.owner.experience_category_image_insert', compact('experience_category'));
    }

    public function action_experience_category_image_insert(Request $request)
    {
        $this->image_insert($request);

        $return_view = $this->category_display();
        return $return_view;
    }

    public function experience_category_image_update(string $id)
    {
        $images = Image::find($id);
        $experience_category = ExperienceCategory::find($id);
        return view('mypage.owner.experience_category_image_update', compact('experience_category', 'images'));
    }

    public function action_experience_category_image_update(Request $request, string $id)
    {
        $this->image_update($request,$id);

        $return_view = $this->category_display();
        return $return_view;
    }

    public function experience_category_image_delete(string $id)
    {
        $images = Image::find($id);
        $experience_category = ExperienceCategory::find($id);
        return view('mypage.owner.experience_category_image_delete', compact('experience_category', 'images'));
    }

    public function action_experience_category_image_delete(Request $request, string $id)
    {
        $this->image_delete($request,$id);

        $return_view = $this->category_display();
        return $return_view;
    }

    public function goods_category_image_insert(string $id)
    {
        $goods_category = GoodsCategory::find($id);
        return view('mypage.owner.goods_category_image_insert', compact('goods_category'));
    }

    public function action_goods_category_image_insert(Request $request)
    {
        $this->image_insert($request);

        $return_view = $this->category_display();
        return $return_view;
    }

    public function goods_category_image_update(string $id)
    {
        $images = Image::find($id);
        $goods_category = GoodsCategory::find($id);
        return view('mypage.owner.goods_category_image_update', compact('goods_category', 'images'));
    }

    public function action_goods_category_image_update(Request $request, string $id)
    {
        $this->image_update($request,$id);

        $return_view = $this->category_display();
        return $return_view;
    }

    public function goods_category_image_delete(string $id)
    {
        $images = Image::find($id);
        $goods_category = GoodsCategory::find($id);
        return view('mypage.owner.goods_category_image_delete', compact('goods_category', 'images'));
    }

    public function action_goods_category_image_delete(Request $request, string $id)
    {
        $this->image_delete($request,$id);

        $return_view = $this->category_display();
        return $return_view;
    }

    public function link_display()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        return view('mypage.owner.link_display', compact('user', 'partner'));
    }

    public function link_edit(string $id)
    {
        if($id == 1){
            $name = '利用規約';
        }elseif($id == 2){
            $name = 'プライバシー規約';
        }elseif($id == 3){
            $name = '特定証取引に基づく表示';
        }elseif($id == 4){
            $name = '店舗情報';
        }else{
            $name = 'ヘルプ・マニュアル';
        }

        if(DB::table('links')->where('id', $id)->exists()){

            $link = Link::where('id', $id)->first();
            
        }else{
            $link = '';
        }

        // echo $content;
        // exit;

        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        return view('mypage.owner.link_edit', compact('user', 'partner','name','id','link'));
    }

    public function action_link_edit(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $content = $request->content;
        
        if(DB::table('links')->where('id', $id)->exists()){
            
            Link::where('id', $request->id)->update([
                'id'=>$id,
                'name'=>$name,
                'content'=>$content,
            ]);

        }else{
            Link::create([
                'id'=>$id,
                'name'=>$name,
                'content'=>$content,
            ]);
        }
        
        $return_view = $this->link_display();
        return $return_view;
    }

   
}

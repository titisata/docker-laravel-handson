<?php

namespace App\Http\Controllers;

use App\Models\ExperienceFolder;
use App\Models\Partner;
use App\Models\PartnerMaster;
use App\Models\SiteMaster;
use App\Models\ExperienceCategory;
use App\Models\ExperienceReserve;
use App\Models\Experience;
use App\Models\GoodsOrder;
use App\Models\GoodsFolder;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\HotelGroup;
use App\Models\HotelSelect;
use App\Models\HotelGroupSelect;
use App\Models\Hotel;
use App\Models\FoodGroup;
use App\Models\FoodSelect;
use App\Models\FoodGroupSelect;
use App\Models\Food;
use App\Models\Image;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SiteRequest;
use App\Http\Requests\EventEditRequest;
use App\Http\Requests\EventAddRequest;
use App\Http\Requests\GoodsEditRequest;
use App\Http\Requests\GoodsAddRequest;
use App\Http\Requests\LinkEditRequest;
use App\Http\Requests\HotelEditRequest;
use App\Http\Requests\HotelGroupEditRequest;
use App\Http\Requests\FoodEditRequest;
use App\Http\Requests\FoodGroupEditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Carbon\Carbon;

class MOwnerController extends Controller
{

    public function home()
    {
        $now = now()->format('y-m-d');
        $tomorrow = now()->addDay()->format('y-m-d');
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $ordered_goods = GoodsOrder::all();
        $reserved_experiences = ExperienceReserve::where('start_date', $now)->orWhere('start_date', $tomorrow)->get();  
        return view('mypage.owner.home', compact('user', 'partner', 'ordered_goods', 'reserved_experiences'));
    }

    
    public function reserve()
    {
        $user = Auth::user();
        $partners =  User::Join('partners', 'users.id', '=', 'partners.user_id')->select('users.*')->get();
        
        $dates = array();
        for($i = 0; $i < 6; $i++){
            $dates[] = now()->addMonth($i)->format('y-m');
        }
        
        return view('mypage.owner.reserve', compact('user', 'partners', 'dates'));
    }

    public function reserve_past()
    {
        $user = Auth::user();
        $partners =  User::Join('partners', 'users.id', '=', 'partners.user_id')->select('users.*')->get();
        $dates = array();
        for($i = 0; $i < 6; $i++){
            $dates[] = now()->subMonth($i)->format('y-m');
        }
        return view('mypage.owner.reserve_past', compact('user', 'partners', 'dates'));
    }

    public function reserve_select(string $id)
    {
        $now = now()->format('y-m-d');
        $user = Auth::user();
        $experience_folder = ExperienceFolder::where('id', $id)->first();
        $experiences = Experience::where('experience_folder_id', $experience_folder->id)->get();
        
        return view('mypage.owner.reserve_select', compact('user','experience_folder', 'experiences', 'now'));
    }

    public function reserve_select_date(string $id)
    {
        $now = now()->format('y-m-d');
        $datetime = $id;
        $datetime1 = explode(' ', $datetime);
        $date = explode('-', $datetime1[0]);
        $year = $date[0];
        $month = $date[1];

        $user = Auth::user();
        $reserves = ExperienceReserve::whereMonth('start_date', $month)->where('start_date', '>=', $now)->get();
      
        return view('mypage.owner.reserve_select_date', compact('user', 'id', 'reserves'));
    }

    public function reserve_select_past(string $id)
    {
        $now = now()->format('y-m-d');
        $user = Auth::user();
        $experience_folder = ExperienceFolder::where('id', $id)->first();
        $experiences = Experience::where('experience_folder_id', $experience_folder->id)->get();
        
        return view('mypage.owner.reserve_select_past', compact('user', 'experience_folder', 'experiences', 'now'));
    }

    public function reserve_select_date_past(string $id)
    {
        $now = now()->format('y-m-d');
        $datetime = $id;
        $datetime1 = explode(' ', $datetime);
        $date = explode('-', $datetime1[0]);
        $year = $date[0];
        $month = $date[1];

        $user = Auth::user();
        $reserves = ExperienceReserve::whereMonth('start_date', $month)->where('start_date', '<', $now)->get();
       
        return view('mypage.owner.reserve_select_date_past', compact('user', 'id', 'reserves'));
    }

    

    public function reserve_edit(string $id)
    {
        $user = Auth::user();
        $experiencereserve = ExperienceReserve::find($id);
        if( isset($experiencereserve->hotel_group_id)){
            $hotel_group_id = $experiencereserve->hotel_group_id;
            $hotels = Hotel::Join('hotel_selects', 'hotels.id', '=', 'hotel_selects.hotel_id')->select('hotels.*')->where('hotel_selects.hotel_group_id', 1)->get();
        }else{
            $hotels = Hotel::Join('hotel_selects', 'hotels.id', '=', 'hotel_selects.hotel_id')->select('hotels.*')->get();
        }
        return view('mypage.owner.reserve_edit', compact('user', 'experiencereserve','hotels'));
    }

    public function action_reserve_edit(Request $request)
    {
        $id = $request->id;
        $quantity_adult = $request->quantity_adult;
        $quantity_child = $request->quantity_child;
        $hotel_group = $request->hotel_group;
        $food_group = $request->food_group;
        $comment = $request->comment;
        $stasus = $request->status;

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
        $user = User::where('id',$experience_folder->user_id)->first();
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

    public function site_post(SiteRequest $request)
    {

        // $validate_rule = [
        //     'site_name'=>'required',
        //     'shop_num'=>'numeric|between:0,100',
        //     'regist_num'=>'numeric|between:0,100',
        //     'recommend_limit'=>'numeric|between:0,100',
        //     'comment'=>'required',
        //     'site_color'=>'nullable',
        //     'sales_copy'=>'required',
        // ];

        // $this->validate($request, $validate_rule);
        // return view('mypage.owner.site', ['msg'=>'test']);

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

        if(Link::where('id', $id)->exists()){

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

    public function action_link_edit(LinkEditRequest $request)
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



    public function h_g_edit(Request $request)
    {
        //requestに入れられた情報受け取りhotelgroup.tableの情報を編集

        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;

        HotelGroup::where('id', $id)->update([
            'name'=>$name,
            'description'=>$description,
            'price_adult'=>$price_adult,
            'price_child'=>$price_child,
        ]);

    
    }


    public function hotel_group_display()
    {
        $user = Auth::user();
        $hotel_groups = HotelGroup::all();
        return view('mypage.owner.hotel_group_display', compact('hotel_groups'));
    }

    public function hotel_group_insert()
    {
        return view('mypage.owner.hotel_group_insert');
    }

    public function hotel_group_edit(string $id)
    {
        $hotel_group = HotelGroup::where('id', $id)->first();
        $hotel_selects = HotelSelect::where('hotel_group_id', $hotel_group->id)->get();
        return view('mypage.owner.hotel_group_edit', compact('hotel_group', 'hotel_selects'));
    }

    public function action_hotel_group_insert(HotelGroupEditRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;

        HotelGroup::create([
            'name' => $name,
            'description' => $description,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
        ]);

        $return_view = $this->hotel_group_display();
        return $return_view;
    }

    

    public function action_hotel_group_edit(HotelGroupEditRequest $request)
    {
        $this->h_g_edit($request);

        $return_view = $this->hotel_group_display();
        return $return_view;
    }

    public function action_hotel_group_delete(Request $request)
    {
        $id = $request->id;

        $hotel_selects = HotelSelect::where('hotel_group_id', $id)->delete();

        $hotels = HotelGroup::where('id', $id)->delete();

        $return_view = $this->hotel_group_display();
        return $return_view;
        
    }

    public function hotel_display()
    {
        $hotels = Hotel::all();
        return view('mypage.owner.hotel_display', compact('hotels'));
    }

    public function hotel_insert()
    {
        $hotel_groups = HotelGroup::all();
        return view('mypage.owner.hotel_insert', compact('hotel_groups'));
        
    }


    public function action_hotel_insert(HotelEditRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $address = $request->address;
        $email = $request->email;
        $hotel_groups = $request->hotel_group;

        $data = Hotel::create([
            'name' => $name,
            'description' => $description,
            'address' => $address,
            'email' => $email,
        ]);

        for ($i=0; $i < count($hotel_groups); $i++) {

            $hotel_group = $hotel_groups[$i];

            HotelSelect::create([
                'hotel_group_id' => $hotel_group,
                'hotel_id' => $data->id, 
            ]);
        }
        
        
        $return_view = $this->hotel_display();
        return $return_view;
        
    }

    public function hotel_edit(string $id)
    {
        $hotels = Hotel::where('id', $id)->first();
        $hotel_groups = HotelGroup::all();
        $Hotel_select_ids = HotelSelect::where('hotel_id',$id)->get();
        $checked_hotels_group = array();
        foreach($Hotel_select_ids as $Hotel_select_id){
            $checked_hotels_group[] = $Hotel_select_id->hotel_group_id;
        }
        // print_r($checked_hotels_group);
        // exit;
        return view('mypage.owner.hotel_edit', compact('hotels', 'hotel_groups', 'checked_hotels_group'));
        
    }


    public function action_hotel_edit(HotelEditRequest $request)
    {
        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $address = $request->address;
        $mail = $request->mail;
        $hotel_groups = $request->hotel_group;

        $date = Hotel::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
            'address' => $address,
            'mail' => $mail,
        ]);

        //一旦すべてをデリート
        $delete = HotelSelect::where('hotel_id', $id)->delete();

        
        for ($i=0; $i < count($hotel_groups); $i++) {

            $hotel_group = $hotel_groups[$i];
            
            //その後、選択されたものをインサート

                HotelSelect::create([
                    'hotel_group_id' => $hotel_group,
                    'hotel_id' => $id, 
                ]);

        }

       


        $return_view = $this->hotel_display();
        return $return_view;
    }

    public function hotel_delete(Request $request)
    {
        $id = $request->id;

        $hotel_selects = HotelSelect::where('hotel_id', $id)->delete();

        $hotels = Hotel::where('id', $id)->delete();

        $return_view = $this->hotel_display();
        return $return_view;
        
    }

    public function f_g_edit(Request $request)
    {
        //requestに入れられた情報受け取りhotelgroup.tableの情報を編集

        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;

        FoodGroup::where('id', $id)->update([
            'name'=>$name,
            'description'=>$description,
            'price_adult'=>$price_adult,
            'price_child'=>$price_child,
        ]);

    
    }


    public function food_group_display()
    {
        $food_groups = FoodGroup::all();
        return view('mypage.owner.food_group_display', compact('food_groups'));
    }

    public function food_group_insert()
    {
        return view('mypage.owner.food_group_insert');
    }

    public function food_group_edit(string $id)
    {
        $food_group = FoodGroup::where('id', $id)->first();
        $food_selects = FoodSelect::where('food_group_id', $food_group->id)->get();
        return view('mypage.owner.food_group_edit', compact('food_group', 'food_selects'));
    }

    public function action_food_group_insert(FoodGroupEditRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;

        FoodGroup::create([
            'name' => $name,
            'description' => $description,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
        ]);

        $return_view = $this->food_group_display();
        return $return_view;
    }

    

    public function action_food_group_edit(FoodGroupEditRequest $request)
    {
        $this->f_g_edit($request);

        $return_view = $this->food_group_display();
        return $return_view;
    }

    public function action_food_group_delete(Request $request)
    {
        $id = $request->id;

        $food_selects = FoodSelect::where('food_group_id', $id)->delete();

        $foods = FoodGroup::where('id', $id)->delete();

        $return_view = $this->food_group_display();
        return $return_view;
        
    }

    public function food_display()
    {
        $foods = Food::all();
        return view('mypage.owner.food_display', compact('foods'));
    }

    public function food_insert()
    {
        $food_groups = FoodGroup::all();
        return view('mypage.owner.food_insert', compact('food_groups'));
        
    }


    public function action_food_insert(FoodEditRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $food_groups = $request->food_group;

        $data = Food::create([
            'name' => $name,
            'description' => $description,
        ]);

        for ($i=0; $i < count($food_groups); $i++) {

            $food_group = $food_groups[$i];

            FoodSelect::create([
                'food_group_id' => $food_group,
                'food_id' => $data->id, 
            ]);
        }
        
        
        $return_view = $this->food_display();
        return $return_view;
        
    }

    public function food_edit(string $id)
    {
        $foods = Food::where('id', $id)->first();
        $food_groups = FoodGroup::all();
        $food_select_ids = FoodSelect::where('food_id',$id)->get();
        $checked_foods_group = array();
        foreach($food_select_ids as $food_select_id){
            $checked_foods_group[] = $food_select_id->food_group_id;
        }
        // print_r($checked_hotels_group);
        // exit;
        return view('mypage.owner.food_edit', compact('foods', 'food_groups', 'checked_foods_group'));
        
    }


    public function action_food_edit(FoodEditRequest $request)
    {
        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $food_groups = $request->food_group;

        $date = Food::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        //一旦すべてをデリート
        $delete = FoodSelect::where('food_id', $id)->delete();

        
        for ($i=0; $i < count($food_groups); $i++) {

            $food_group = $food_groups[$i];
            
            //その後、選択されたものをインサート

                FoodSelect::create([
                    'food_group_id' => $food_group,
                    'food_id' => $id, 
                ]);

        }



        $return_view = $this->food_display();
        return $return_view;
    }

    public function food_delete(Request $request)
    {
        $id = $request->id;

        $food_selects = FoodSelect::where('food_id', $id)->delete();

        $foods = Food::where('id', $id)->delete();

        $return_view = $this->food_display();
        return $return_view;
        
    }

   
}

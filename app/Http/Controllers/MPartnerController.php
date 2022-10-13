<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExperienceCategory;
use App\Models\ExperienceCartItem;
use App\Models\ExperienceFolder;
use App\Models\ExperienceReserve;
use App\Models\Experience;
use App\Models\GoodsOrder;
use App\Models\GoodCartItem;
use App\Models\GoodsFolder;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\HotelGroup;
use App\Models\Hotel;
use App\Models\HotelSelect;
use App\Models\HotelGroupSelect;
use App\Models\FoodGroup;
use App\Models\FoodSelect;
use App\Models\FoodGroupSelect;
use App\Models\Partner;
use App\Models\Image;
use App\Models\Link;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\EventEditRequest;
use App\Http\Requests\EventAddRequest;
use App\Http\Requests\GoodsAddRequest;
use App\Http\Requests\GoodsEditRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use DateTime;

class MPartnerController extends Controller
{
    public function home()
    {
        $now = now()->format('y-m-d');
        $tomorrow = now()->addDay()->format('y-m-d');
        $user = Auth::user();

        if ($user->hasRole('system_admin|site_admin')) {
            $partner = Partner::where('user_id', $user->id)->first();
            $ordered_goods = GoodsOrder::all();
            $decrease_goods = Goods::where('quantity', '<', '6')->get();
            $reserved_experiences = ExperienceReserve::where('start_date', $now)->orWhere('start_date', $tomorrow)->get();  
            $uncomplete_reserved_experiences = ExperienceReserve::where('status', '!=', '10')->get();
            return view('mypage.owner.home', compact('user', 'partner', 'ordered_goods', 'reserved_experiences', 'decrease_goods'));
        }
        
        if($user->hasRole('partner')){
            $ordered_goods = GoodsOrder::where('partner_id', $user->id)->get();
            $reserved_experiences = ExperienceReserve::where('partner_id', $user->id)->where('start_date', $now)->orWhere('start_date', $tomorrow)->get();  
            $decrease_goods = Goods::Join('goods_folders', 'goods.goods_folder_id', '=', 'goods_folders.id')->select('goods.*')->where('quantity', '<', '6')->where('user_id', $user->id)->get();
            return view('mypage.partner.home', compact('user', 'ordered_goods', 'reserved_experiences','decrease_goods'));
        }
    }

   
    public function event()
    {
        $user = Auth::user();

        if ($user->hasRole('system_admin|site_admin')) {
            $experiences_folders = ExperienceFolder::all();
            return view('mypage.partner.event', compact('user', 'experiences_folders'));
        }
        
        if($user->hasRole('partner')){
            $experiences_folders = ExperienceFolder::where('user_id', $user->id)->get();
            return view('mypage.partner.event', compact('user', 'experiences_folders'));
        }
        
    }

    public function event_add(string $id)
    {

        $user = Auth::user();
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();

        $hotel_groups = HotelGroup::all();
        
        $food_groups = FoodGroup::all();

        $schedules = Schedule::where('experience_folder_id',$id)->get();
        return view('mypage.partner.event_add', compact('user', 'experiences_folder', 'categories', 'hotel_groups', 'food_groups'));
        
    }

    public function action_event_add(EventAddRequest $request)
    {
        // dd($request);
        // exit;

        $user_id = $request->user_id;
        $name = $request->name;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;
        $address = $request->address;
        $phone = $request->phone;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $is_lodging = $request->is_lodging;
        $is_before_lodging = $request->is_before_lodging;
        $recommend_flag = $request->recommend_flag;
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $table_name = $request->table_name;
        $hotel_groups = $request->hotel_group;
        $food_groups = $request->food_group;
        $ex_name = $request->ex_name;
        $ex_price_adult = $request->ex_price_adult;
        $ex_price_child = $request->ex_price_child;
        $ex_sort_no = $request->ex_sort_no;
        $ex_quantity = $request->ex_quantity;
        $ex_status = $request->ex_status;  
        $key_count = $request->key_count;
        $selected_date = $request->selected_date;

        

        $data = ExperienceFolder::create([
            'user_id' => $user_id,
            'name' => $name,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
            'address' => $address,
            'phone' => $phone,
            'description' => $description,
            'detail' => $detail,
            'caution' => $caution,
            'is_lodging' => $is_lodging,
            'is_before_lodging' => $is_before_lodging,
            'status' => $status,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'recommend_flag' => $recommend_flag,
            'category1' => $category,
        ]);   

        if( $request->file('image_path') != ''){
        $img = $request->file('image_path');
        $path = $img->store('images','public');

        Image::create([
            'table_name' => $table_name,
            'table_id' => $data->id,
            'image_path' => '/storage/' . $path,
        ]);
        }

        //スケジュールを登録
        if(!is_null($selected_date)){
            foreach($selected_date as $d){
                Schedule::create([
                    'partner_id' => $user_id,
                    'experience_folder_id' => $data->id,
                    'is_holiday' => 1,
                    'title' => 'お休み',
                    'date' => new DateTime($d),
                ]);
            }
        }

        if($is_lodging == 1){
            for ($i=0; $i < count($hotel_groups); $i++) {

                $hotel_group = $hotel_groups[$i];
                
                //選択されたものをインサート

                HotelGroupSelect::create([
                    'experience_folder_id' => $data->id,
                    'hotel_group_id' => $hotel_group,
                ]);

            }
        }

        if( $is_lodging == 1){
            for ($i=0; $i < count($food_groups); $i++) {

                $food_group = $food_groups[$i];
                
                //選択されたものをインサート

                FoodGroupSelect::create([
                    'experience_folder_id' => $data->id,
                    'food_group_id' => $food_group,
                ]);

            }
        }

        Experience::create([
            'experience_folder_id' => $data->id,
            'name' => $ex_name,
            'price_adult' => $ex_price_adult,
            'price_child' => $ex_price_child,
            'sort_no' => $ex_sort_no,
            'quantity' => $ex_quantity,
            'status' => $ex_status,
        ]);

        for ($i=1; $i < $key_count + 1; $i++) {
            $ex_names = $request['ex_names_'.$i];
            $ex_sort_nos = $request['ex_sort_nos_'.$i];
            $ex_quantities = $request['ex_quantities_'.$i];
            $ex_price_adults = $request['ex_price_adults_'.$i];
            $ex_price_childs = $request['ex_price_childs_'.$i];
            $ex_statuses = $request['ex_statuses_'.$i];
            $eex_name = $ex_names;
            $eex_price_adult = $ex_price_adults;
            $eex_price_child = $ex_price_childs;
            $eex_sort_no = $ex_sort_nos;
            $eex_quantity = $ex_quantities;
            $eex_status = $ex_statuses;

            Experience::create([
                'experience_folder_id' => $data->id,
                'name' => $eex_name,
                'price_adult' => $eex_price_adult,
                'price_child' => $eex_price_child,
                'sort_no' => $eex_sort_no,
                'quantity' => $eex_quantity,
                'status' => $eex_status,
            ]);

        }

        $return_view = $this->event();
        return $return_view;
        
    }

    public function event_edit(string $id)
    {
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();

        $start_date = $experiences_folder->start_date->format('y-m-d');
        $end_date = $experiences_folder->end_date->format('y-m-d');
        
        $hotel_groups = HotelGroup::all();
        $hotel_select_ids = HotelGroupSelect::where('experience_folder_id',$id)->get();
        $checked_hotels_group = array();
        foreach($hotel_select_ids as $hotel_select_id){
            $checked_hotels_group[] = $hotel_select_id->hotel_group_id;
        }
        
        $food_groups = FoodGroup::all();
        $food_select_ids = FoodGroupSelect::where('experience_folder_id',$id)->get();
        $checked_foods_group = array();
        foreach($food_select_ids as $food_select_id){
            $checked_foods_group[] = $food_select_id->food_group_id;
        }

        $schedules = Schedule::where('experience_folder_id',$id)->get();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories', 'hotel_groups', 'food_groups', 'checked_foods_group', 'checked_hotels_group', 'schedules', 'start_date', 'end_date'));
    }

    public function event_edit_update(EventEditRequest $request)
    {

        // dd($request);
        // exit;

        $user_id = $request->user_id;
        $name = $request->name;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;
        $address = $request->address;
        $phone = $request->phone;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $is_lodging = $request->is_lodging;
        $is_before_lodging = $request->is_before_lodging;
        $recommend_flag = $request->recommend_flag;
        $status = $request->status; 
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $id = $request->id;
        $key = $request->key;
        $hotel_groups = $request->hotel_group;
        $food_groups = $request->food_group;
        $selected_date = $request->selected_date;

        $experiences_folder = ExperienceFolder::where('id', $id)->update([
            'user_id' => $user_id,
            'name' => $name,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
            'address' => $address,
            'phone' => $phone,
            'description' => $description,
            'detail' => $detail,
            'caution' => $caution,
            'is_lodging' => $is_lodging,
            'is_before_lodging' => $is_before_lodging,
            'status' => $status,
            'recommend_flag' => $recommend_flag,
            'category1' => $category,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        //スケジュールを登録
        Schedule::where('experience_folder_id', $id)->delete();
        if(!is_null($selected_date)){
            foreach($selected_date as $d){
                Schedule::create([
                    'partner_id' => $user_id,
                    'experience_folder_id' => $id,
                    'is_holiday' => 1,
                    'title' => 'お休み',
                    'date' => new DateTime($d),
                ]);
            }
        }

        //前回までの情報を削除
        $hotel_delete = HotelGroupSelect::where('experience_folder_id', $id)->delete();

        if(!is_null($hotel_groups)){
            for ($i=0; $i < count($hotel_groups); $i++) {
                $hotel_group = $hotel_groups[$i];    
                //その後、選択されたものをインサート
                HotelGroupSelect::create([
                    'experience_folder_id' => $id,
                    'hotel_group_id' => $hotel_group,
                ]);
            }
        }

        //前回までの情報を削除
        $food_delete = FoodGroupSelect::where('experience_folder_id', $id)->delete();

        if(!is_null($food_groups)){
            for ($i=0; $i < count($food_groups); $i++) {
                $food_group = $food_groups[$i];
                //その後、選択されたものをインサート
                FoodGroupSelect::create([
                    'experience_folder_id' => $id,
                    'food_group_id' => $food_group,
                ]);    
            }
        }

        for ($i=1; $i < $key + 1; $i++) {
            $ex_names = $request['ex_names_'.$i];
            $ex_ids = $request['ex_ids_'.$i];
            $ex_sort_nos = $request['ex_sort_nos_'.$i];
            $ex_quantities = $request['ex_quantities_'.$i];
            $ex_price_adults = $request['ex_price_adults_'.$i];
            $ex_price_childs = $request['ex_price_childs_'.$i];
            $ex_statuses = $request['ex_statuses_'.$i];
            $ex_id = $ex_ids;
            $ex_name = $ex_names;
            $ex_price_adult = $ex_price_adults;
            $ex_price_child = $ex_price_childs;
            $ex_sort_no = $ex_sort_nos;
            $ex_quantity = $ex_quantities;
            $ex_status = $ex_statuses;


            if( $ex_id == ''){
                Experience::create([
                    'experience_folder_id' => $id,
                    'name' => $ex_name,
                    'price_adult' => $ex_price_adult,
                    'price_child' => $ex_price_child,
                    'sort_no' => $ex_sort_no,
                    'quantity' => $ex_quantity,
                    'status' => $ex_status,
                ]);

            }else{
                Experience::where('id', $ex_id)->update([
                    'experience_folder_id' => $id,
                    'name' => $ex_name,
                    'price_adult' => $ex_price_adult,
                    'price_child' => $ex_price_child,
                    'sort_no' => $ex_sort_no,
                    'quantity' => $ex_quantity,
                    'status' => $ex_status,
                ]);
            }
           
        }

        $return_view = $this->event();
        return $return_view;
        
    }

    public function event_edit_delete(Request $request){

        $id = $request->id;
        $delete_id = $request->delete_id;

        if(ExperienceReserve::where('experience_id', $delete_id)->first() == '' && ExperienceCartItem::where('experience_id', $delete_id)->first() ==''){

            $experience_delete = Experience::where('id', $delete_id)->delete();

            $return_view = $this->event_edit($id);
            return $return_view;

        }else{

        return back()->with('result', 'カートに登録または予約が過去にあった体験は削除ができません。表示の設定を非表示に切り替えると表示がされなくなります。');

        }
        
    }

    public function action_event_delete(Request $request)
    {
        //idをもとにexperiencefolder.tableから削除

        $id = $request->id;

        $ex_ids = Experience::where('experience_folder_id', $id)->get();

        $flag = 0;

        foreach($ex_ids as $ex_id){
            if(ExperienceReserve::where('experience_id', $ex_id->id)->first() == '' && ExperienceCartItem::where('experience_id', $ex_id->id)->first() ==''){
                $flag = 0;
            }else{
                $flag = 1; 
                break;
            }
            
        }
        

        if($flag == 0 ){
            $schedule_delete = Schedule::where('experience_folder_id', $id)->delete();

            $hotel_delete = HotelGroupSelect::where('experience_folder_id', $id)->delete();
    
            $food_delete = FoodGroupSelect::where('experience_folder_id', $id)->delete();
    
            $experience_delete = Experience::where('experience_folder_id', $id)->delete();
    
            $experience_folder = ExperienceFolder::where('id', $id)->delete();
    
            $image = Image::where('table_name', 'experience_folders')->where('table_id', $id)->delete();

            $return_view = $this->event();
            return $return_view;
        }else{

            return back()->with('result', 'カートに登録または予約が過去にあった体験は削除ができません。表示の設定を非表示に切り替えると表示がされなくなります。');
    
        }
        

    }

    public function goods()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        

        if ($user->hasRole('system_admin|site_admin')) {
            $goods_folders = GoodsFolder::all();
            return view('mypage.partner.goods', compact('user', 'goods_folders'));
        }

        if($user->hasRole('partner')){
            $goods_folders = GoodsFolder::where('user_id', $user->id)->get();
            return view('mypage.partner.goods', compact('user', 'goods_folders'));
        }
    }

   

    public function goods_add(string $id)
    {
        $user = Auth::user();
        $goods_folder = GoodsFolder::find($id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_add', compact('user', 'goods_folder', 'categories'));
    }

   

    public function action_goods_add(GoodsAddRequest $request)
    {

        // dd($request);
        // exit;
        $user_id = $request->user_id;
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $recommend_flag = $request->recommend_flag;
        $goods_name = $request->goods_name;
        $goods_price = $request->goods_price;
        $goods_description = $request->goods_description;
        $goods_sort_no = $request->goods_sort_no;
        $goods_quantity = $request->goods_quantity;
        $goods_status = $request->goods_status;
        $table_name = $request->table_name;
        $key_count = $request->key_count;

        $data = GoodsFolder::create([
            'user_id' => $user_id,
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'detail' => $detail,
            'caution' => $caution,
            'recommend_flag' => $recommend_flag,
            'category1' => $category,
        ]);     

        Goods::create([
            'goods_folder_id' => $data->id,
            'name' => $goods_name,
            'price' => $goods_price,
            'description' => $goods_description,
            'sort_no' => $goods_sort_no,
            'quantity' => $goods_quantity,
            'status' => $goods_status,
        ]);


        if( $request->file('image_path') != ''){
            $img = $request->file('image_path');
            $path = $img->store('images','public');

            Image::create([
                'table_name' => $table_name,
                'table_id' => $data->id,
                'image_path' => '/storage/' . $path,
            ]);

        }

        for ($i=1; $i < $key_count + 1; $i++) {
            $goods_ids = $request['goods_ids_'.$i];
            $goods_names = $request['goods_names_'.$i];
            $goods_pricies = $request['goods_pricies_'.$i];
            $goods_descriptions = $request['goods_descriptions_'.$i];
            $goods_sort_nos = $request['goods_sort_nos_'.$i];
            $goods_quantities = $request['goods_quantities_'.$i];
            $goods_statuses = $request['goods_statuses_'.$i];
            $goods_id = $goods_ids;
            $goods_name = $goods_names;
            $goods_price = $goods_pricies;
            $goods_description = $goods_descriptions;
            $goods_sort_no = $goods_sort_nos;
            $goods_quantity = $goods_quantities;
            $goods_status = $goods_statuses;

           
            Goods::create([
                'goods_folder_id' => $data->id,
                'name' => $goods_name,
                'price' => $goods_price,
                'description' => $goods_description,
                'sort_no' => $goods_sort_no,
                'quantity' => $goods_quantity,
                'status' => $goods_status,
            ]);
            
        }

        $return_view = $this->goods();
        return $return_view;

    }


    public function goods_edit(string $id)
    {
        $goods_folder = GoodsFolder::find($id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
    }

    public function goods_edit_update(GoodsEditRequest $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $recommend_flag = $request->recommend_flag;
        $status = $request->status;
        $category1 = $request->category1;
        $key = $request->key;

        $goods_folder = GoodsFolder::where('id', $id)->update([
            'name' => $name,
            'user_id' => $user_id,
            'price' => $price,
            'description' => $description,
            'caution' => $caution,
            'detail' => $detail,
            'category1' => $category1,
            'status' => $status,
            'recommend_flag' => $recommend_flag,
        ]);

        for ($i=1; $i < $key + 1; $i++) {
            $goods_ids = $request['goods_ids_'.$i];
            $goods_names = $request['goods_names_'.$i];
            $goods_pricies = $request['goods_pricies_'.$i];
            $goods_descriptions = $request['goods_descriptions_'.$i];
            $goods_sort_nos = $request['goods_sort_nos_'.$i];
            $goods_quantities = $request['goods_quantities_'.$i];
            $goods_statuses = $request['goods_statuses_'.$i];
            $goods_id = $goods_ids;
            $goods_name = $goods_names;
            $goods_price = $goods_pricies;
            $goods_description = $goods_descriptions;
            $goods_sort_no = $goods_sort_nos;
            $goods_quantity = $goods_quantities;
            $goods_status = $goods_statuses;

            if( $goods_id == ''){
                Goods::create([
                    'goods_folder_id' => $id,
                    'name' => $goods_name,
                    'price' => $goods_price,
                    'description' => $goods_description,
                    'sort_no' => $goods_sort_no,
                    'quantity' => $goods_quantity,
                    'status' => $goods_status,
                ]);
            }else{
                Goods::where('id', $goods_id)->update([
                    'goods_folder_id' => $id,
                    'name' => $goods_name,
                    'price' => $goods_price,
                    'description' => $goods_description,
                    'quantity' => $goods_quantity,
                    'status' => $goods_status,
                ]);
            }
        }

        
        $return_view = $this->goods();
        return $return_view;
    }


    public function goods_edit_delete(Request $request){

        $id = $request->id;
        $delete_id = $request->delete_id;
        $limit = $request->limit;

        if(GoodsOrder::where('goods_id', $delete_id)->first() == '' && GoodCartItem::where('goods_id', $delete_id)->first() ==''){
            $goods_delete = Goods::where('id', $delete_id)->delete();

            $return_view = $this->goods_edit($id);
            return $return_view;
        }else{

            return back()->with('result', 'カートまたは注文が過去にあった商品は削除ができません。表示の設定を非表示に切り替えると表示がされなくなります。');

        }
        
        
    }

    public function action_goods_delete(Request $request)
    {
        //idをもとにgoodsfolders.tableから削除

        $id = $request->id;

        $goods_ids = Goods::where('goods_folder_id', $id)->get();
    
        $flag = 0;
        
        foreach($goods_ids as $goods_id){
            if(GoodsOrder::where('goods_id', $goods_id->id)->first() == '' && GoodCartItem::where('goods_id', $goods_id->id)->first() ==''){
                $flag = 0;
            }else{
                $flag = 1; 
                break;
            }
            
        }
        

        if($flag == 0 ){

            $goods = Goods::where('goods_folder_id', $id)->delete();

            $image = Image::where('table_name', 'goods_folders')->where('table_id', $id)->delete();

            $goods_folder = GoodsFolder::where('id', $id)->delete();


            $return_view = $this->goods();
            return $return_view;

        }else{

            return back()->with('result', 'カートに登録または予約が過去にあった体験は削除ができません。表示の設定を非表示に切り替えると表示がされなくなります。');
    
        }
        

    }


    public function image_insert(Request $request)
    {
        //新規画像登録処理

        $table_name = $request->table_name;
        $table_id = $request->table_id;

        //storage/imagesディレクトリに画像を保存
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
        //画像削除処理

        $image_path = $request->image_path;
        $table_id = $request->table_id;

        Storage::disk('public')->delete($image_path);
       
        Image::where('id', $id)->delete();

    }

    public function image_update(Request $request)
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
        Image::where('image_path', $delete_path)->delete();
    }

   

    public function event_image_edit(Request $request)
    {
        //編集ページ表示
        $table_id = $request->table_id;
        $experiences_folder = ExperienceFolder::find($table_id);
        $categories = ExperienceCategory::all();

        $schedules = Schedule::where('experience_folder_id',$table_id)->get();

        $hotel_groups = HotelGroup::all();
        $hotel_select_ids = HotelGroupSelect::where('experience_folder_id', $experiences_folder->id)->get();
        $checked_hotels_group = array();
        foreach($hotel_select_ids as $hotel_select_id){
            $checked_hotels_group[] = $hotel_select_id->hotel_group_id;
        }
        
        $food_groups = FoodGroup::all();
        $food_select_ids = FoodGroupSelect::where('experience_folder_id',$experiences_folder->id)->get();
        $checked_foods_group = array();
        foreach($food_select_ids as $food_select_id){
            $checked_foods_group[] = $food_select_id->food_group_id;
        }

        $start_date = $experiences_folder->start_date->format('y-m-d');
        $end_date = $experiences_folder->end_date->format('y-m-d');


        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories', 'hotel_groups', 'food_groups', 'checked_foods_group', 'checked_hotels_group', 'schedules','start_date','end_date'));
        
    }

    public function event_image_insert(string $id)
    {
        $experiences_folder = ExperienceFolder::find($id);
        return view('mypage.partner.event_image_insert', compact('experiences_folder'));
    }


    public function action_event_image_insert(Request $request)
    {
        $this->image_insert($request);

        $return_view = $this->event_image_edit($request);
        return $return_view;
    }

    public function event_image_update(string $id)
    {
        $images = Image::find($id);
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_image_update', compact('experiences_folder', 'categories', 'images'));
    }

    public function action_event_image_update(Request $request, string $id)
    {
        $this->image_update($request, $id);

        $return_view = $this->event_image_edit($request);
        return $return_view;
    }

    public function event_image_delete(string $id)
    {
        $images = Image::find($id);
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_image_delete', compact('experiences_folder', 'categories', 'images'));
    }

    public function action_event_image_delete(Request $request, string $id)
    {
        $this->image_delete($request, $id);

        $return_view = $this->event_image_edit($request);
        return $return_view;
    }

    public function goods_image_edit(Request $request)
    {
        $table_id = $request->table_id;
        $goods_folder = GoodsFolder::find($table_id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
    }

    public function goods_image_insert(string $id)
    {
        $goods_folder = GoodsFolder::find($id);
        return view('mypage.partner.goods_image_insert', compact('goods_folder'));
    }

    public function action_goods_image_insert(Request $request, string $id)
    {
        $this->image_insert($request);

        $return_view = $this->goods_image_edit($request);
        return $return_view;
    }

    public function goods_image_update(string $id)
    {
        $images = Image::find($id);
        
        return view('mypage.partner.goods_image_update', compact('images'));
    }

    public function action_goods_image_update(Request $request)
    {
        $this->image_update($request);
        
        $return_view = $this->goods_image_edit($request);
        return $return_view;
    }

    
    public function goods_image_delete(string $id)
    {
        $images = Image::find($id);
        $goods_folder = GoodsFolder::find($id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_image_delete', compact('goods_folder', 'categories', 'images'));
    }

    public function action_goods_image_delete(Request $request, string $id)
    {
        $this->image_delete($request, $id);

        $return_view = $this->goods_image_edit($request);
        return $return_view;
    }

    public function reserve()
    {
        $user = Auth::user();
        
        $dates = array();
        for($i = 0; $i < 6; $i++){
            $dates[] = now()->addMonth($i)->format('y-m');
        }

        if ($user->hasRole('system_admin|site_admin')) {
            $partners =  User::Join('partners', 'users.id', '=', 'partners.user_id')->select('users.*')->get();
            return view('mypage.partner.reserve', compact('user', 'partners', 'dates'));
        }
        
        if($user->hasRole('partner')){
            
            $partners =  User::where('id',$user->id)->get();
            return view('mypage.partner.reserve', compact('user', 'partners', 'dates'));
        }
    }

    public function reserve_past()
    {
        $user = Auth::user();
        $dates = array();
        for($i = 0; $i < 6; $i++){
            $dates[] = now()->subMonth($i)->format('y-m');
        }
        
        if ($user->hasRole('system_admin|site_admin')) {
            $partners =  User::Join('partners', 'users.id', '=', 'partners.user_id')->select('users.*')->get();
            return view('mypage.partner.reserve_past', compact('user', 'partners', 'dates'));
        }
        
        if($user->hasRole('partner')){
            
            $partners =  User::where('id',$user->id)->get();
            return view('mypage.partner.reserve_past', compact('user', 'partners', 'dates'));
        }
    }

    public function search_reserve(Request $request)
    {
        $free_word = $request->free_word;
        $user = Auth::user();

        if($user->hasRole('partner')){
            $where[] = ['experience_reserves.partner_id', '=', $user->id];
        }else{
            $where = []; 
        }
        
        if($free_word == ""){
            $reserves = ExperienceReserve::where($where)->orderBy('id','desc')->get();
        }else{
            $reserves = ExperienceReserve::Join('experiences', 'experience_reserves.experience_id', '=', 'experiences.id')
            ->Join('experience_folders', 'experiences.experience_folder_id', '=', 'experience_folders.id')
            ->select('experience_reserves.*')->where($where)
            ->where(function ($query) use($free_word){
                $query->where('experience_folders.name', 'like', '%'.$free_word.'%')
                    ->orWhere('experience_folders.description', 'like', '%'.$free_word.'%')
                    ->orWhere('experiences.name', 'like', '%'.$free_word.'%');
            })
            ->orderBy('id','desc')->get();
        }
        
        return view('mypage.partner.search_reserve', compact('reserves'));
    }

    public function reserve_select(string $id)
    {
        $now = now()->format('y-m-d');
        $user = Auth::user();
        $experience_folder = ExperienceFolder::where('id', $id)->first();
        $experiences = Experience::where('experience_folder_id', $experience_folder->id)->get();
        
        return view('mypage.partner.reserve_select', compact('user','experience_folder', 'experiences', 'now'));
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
      
        return view('mypage.partner.reserve_select_date', compact('user', 'id', 'reserves'));
    }

    public function reserve_select_past(string $id)
    {
        $now = now()->format('y-m-d');
        $user = Auth::user();
        $experience_folder = ExperienceFolder::where('id', $id)->first();
        $experiences = Experience::where('experience_folder_id', $experience_folder->id)->get();
        
        return view('mypage.partner.reserve_select_past', compact('user', 'experience_folder', 'experiences', 'now'));
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

        return view('mypage.partner.reserve_select_date_past', compact('user', 'id', 'reserves'));
    }

    public function search_goods(Request $request)
    {
        $free_word = $request->free_word;
        $user = Auth::user();

        if($user->hasRole('partner')){
            $where[] = ['goods_orders.partner_id', '=', $user->id];
        }else{
            $where = []; 
        }
        
        if($free_word == ""){
            $goods = GoodsOrder::where($where)->orderBy('id','desc')->get();
        }else{
            $goods = GoodsOrder::Join('goods', 'goods_orders.goods_id', '=', 'goods.id')
            ->Join('goods_folders', 'goods.goods_folder_id', '=', 'goods_folders.id')
            ->select('goods_orders.*')->where($where)
            ->where(function ($query) use($free_word){
                $query->where('goods_folders.name', 'like', '%'.$free_word.'%')
                    ->orWhere('goods_folders.description', 'like', '%'.$free_word.'%')
                    ->orWhere('goods.name', 'like', '%'.$free_word.'%');
            })
            ->orderBy('id','desc')->get();
        }
        
        return view('mypage.partner.search_goods', compact('goods'));
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
        return view('mypage.partner.reserve_edit', compact('user', 'experiencereserve','hotels'));
    }

    public function action_reserve_edit(Request $request)
    {
        $id = $request->id;
        $save_flag = $request->save_flag;
        $hotel_id = $request->hotel_id;

        ExperienceReserve::where('id',$id)->update([
            'status'=>$save_flag,
            'hotel_id'=>$hotel_id,
        ]);

        if($save_flag == 10 || $save_flag == 99 || $save_flag == 99){
            $obj = new ExSendRemaindMail($save_flag, $id);
            $obj->ex_send_remaind_mail();

            return back()->with('result', '予約状況を更新し、メールを送信しました。');
        }else{
            return back()->with('result', '予約状況を更新しました。');
        }
       
    }

    public function goods_reserve()
    {
        $user = Auth::user();
        
        $dates = array();
        for($i = 0; $i < 6; $i++){
            $dates[] = now()->addMonth($i)->format('y-m');
        }
        
        if ($user->hasRole('system_admin|site_admin')) {
            $partners =  User::Join('partners', 'users.id', '=', 'partners.user_id')->select('users.*')->get();
            return view('mypage.partner.goods_reserve', compact('user', 'partners', 'dates'));
        }
        
        if($user->hasRole('partner')){
            $partners =  User::where('id',$user->id)->first();
            return view('mypage.partner.goods_reserve', compact('user', 'partners', 'dates'));
        }
    }

    public function goods_reserve_past()
    {
        $user = Auth::user();
        $dates = array();
        for($i = 0; $i < 6; $i++){
            $dates[] = now()->subMonth($i)->format('y-m');
        }
        
        if ($user->hasRole('system_admin|site_admin')) {
            $partners =  User::Join('partners', 'users.id', '=', 'partners.user_id')->select('users.*')->get();
            return view('mypage.partner.goods_reserve_past', compact('user', 'partners', 'dates'));
        }
        
        if($user->hasRole('partner')){
            $partners =  User::where('id',$user->id)->first();
            return view('mypage.partner.goods_reserve_past', compact('user', 'partners', 'dates'));
        }
    }

    public function goods_reserve_select(string $id)
    {
        $now = now()->format('y-m-d');
        $user = Auth::user();
        $goods_folder = GoodsFolder::where('id', $id)->first();
        $goods = Goods::where('goods_folder_id', $goods_folder->id)->get();

        return view('mypage.partner.goods_reserve_select', compact('user','goods_folder', 'goods', 'now'));
    }

    public function goods_reserve_select_date(string $id)
    {
        $now = now()->format('y-m-d');
        $datetime = $id;
        $datetime1 = explode(' ', $datetime);
        $date = explode('-', $datetime1[0]);
        $year = $date[0];
        $month = $date[1];

        $user = Auth::user();
        $orders = GoodsOrder::whereMonth('created_at', $month)->where('status', '!=', '30')->get();
      
        return view('mypage.partner.goods_reserve_select_date', compact('user', 'id', 'orders'));
    }

    public function goods_reserve_select_past(string $id)
    {
        $now = now()->format('y-m-d');
        $user = Auth::user();
        $goods_folder = GoodsFolder::where('id', $id)->first();
        $goods = Goods::where('goods_folder_id', $goods_folder->id)->get();
        
        return view('mypage.partner.goods_reserve_select_past', compact('user','goods_folder', 'goods', 'now'));
    }

    public function goods_reserve_select_date_past(string $id)
    {
        $now = now()->format('y-m-d');
        $datetime = $id;
        $datetime1 = explode(' ', $datetime);
        $date = explode('-', $datetime1[0]);
        $year = $date[0];
        $month = $date[1];

        $user = Auth::user();
        $orders = GoodsOrder::whereMonth('created_at', $month)->where('status', '=', '30')->get();
      
        return view('mypage.partner.goods_reserve_select_date_past', compact('user', 'id', 'orders'));
    }

    public function goods_reserve_edit(string $id)
    {
        $user = Auth::user();
        $goods_order = GoodsOrder::find($id);
        
        return view('mypage.partner.goods_reserve_edit', compact('user', 'goods_order'));
    }

    public function action_goods_reserve_edit(Request $request)
    {
        $id = $request->id;
        $save_flag = $request->save_flag;
        $delivery_company = $request->delivery_company;
        $delivery_number = $request->delivery_number;

        $input_company = $request->input_company;
        
        if( $input_company != ''){
            GoodsOrder::where('id',$id)->update([
                'status'=>$save_flag,
                'delivery_company'=>$input_company,
                'delivery_number'=>$delivery_number,
            ]);

        }else{
            GoodsOrder::where('id',$id)->update([
                'status'=>$save_flag,
                'delivery_company'=>$delivery_company,
                'delivery_number'=>$delivery_number,
            ]);
        }
        

        if($save_flag == 10 || $save_flag == 98){
            $obj = new GoodsSendRemaindMail($save_flag, $id);
            $obj->goods_send_remaind_mail();

            return back()->with('result', '注文状況を更新し、メールを送信しました。');
        }else{
            return back()->with('result', '注文状況を更新しました。');
        }

    
        // if( $mail == 1 ){
        //     $to = 'satou@b-partners.jp';
        //     $view = 'email.goods_send_confirm';

        //     //予約データを取得
        //     $order = GoodsOrder::where('id',$id)->first();
        //     $goods_folder = GoodsFolder::where('id',$order->goods->goods_folder_id)->first();

        //     //管理者へのメール送信
        //     $user = Auth::user();
        //     // echo "管理者--".$user->name."--".$user->email."<br>";
        //     $subject = '管理者へのメール';
        //     $name = $user->name;
        //     $with = [
        //         'name' => $name,
        //         'goods_name' => $goods_folder->name,
        //         'goods_kind' => $order->goods->name,
        //         'from_name' => $order->from_name,
        //         'from_postal_code' => $order->from_postal_code,
        //         'from_pref_id' => $order->from_pref_id,
        //         'from_city' => $order->from_city,
        //         'from_town' => $order->from_town,
        //         'from_building' => $order->from_building,
        //         'from_phone' => $order->from_phone,
        //         'to_name' => $order->to_name,
        //         'to_postal_code' => $order->to_postal_code,
        //         'to_pref_id' => $order->to_pref_id,
        //         'to_city' => $order->to_city,
        //         'to_town' => $order->to_town,
        //         'to_building' => $order->to_building,
        //         'to_phone' => $order->to_phone,    
        //         'contact_info' => $order->contact_info,
        //         'delivery_company' => $delivery_company,
        //         'delivery_number' => $delivery_number,
        //         'for' => 'admin',
        //     ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));

        //     //予約者へのメール送信
        //     $user = User::where('id',$order->user_id)->first();
        //     // echo "予約者--".$user->name."--".$user->email."<br>";
        //     $subject = '予約者へのメール';
        //     $name = $user->name;
        //     $with = [
        //         'name' => $name,
        //         'goods_name' => $goods_folder->name,
        //         'goods_kind' => $order->goods->name,
        //         'from_name' => $order->from_name,
        //         'from_postal_code' => $order->from_postal_code,
        //         'from_pref_id' => $order->from_pref_id,
        //         'from_city' => $order->from_city,
        //         'from_town' => $order->from_town,
        //         'from_building' => $order->from_building,
        //         'from_phone' => $order->from_phone,
        //         'to_name' => $order->to_name,
        //         'to_postal_code' => $order->to_postal_code,
        //         'to_pref_id' => $order->to_pref_id,
        //         'to_city' => $order->to_city,
        //         'to_town' => $order->to_town,
        //         'to_building' => $order->to_building,
        //         'to_phone' => $order->to_phone,    
        //         'contact_info' => $order->contact_info,
        //         'delivery_company' => $delivery_company,
        //         'delivery_number' => $delivery_number,
        //         'for' => 'admin',
        //     ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));

        //     //パートナーへメール送信
        //     $goods = Goods::where('id',$order->goods_id)->first();
        //     $goods_folder = GoodsFolder::where('id',$goods->goods_folder_id)->first();
        //     $user = User::where('id',$goods_folder->user_id)->first();
        //     // echo "パートナー--".$user->name."--".$user->email."<br>";
        //     $subject = 'パートナーへのメール';
        //     $name = $user->name;
        //     $with = [
        //         'name' => $name,
        //         'goods_name' => $goods_folder->name,
        //         'goods_kind' => $order->goods->name,
        //         'from_name' => $order->from_name,
        //         'from_postal_code' => $order->from_postal_code,
        //         'from_pref_id' => $order->from_pref_id,
        //         'from_city' => $order->from_city,
        //         'from_town' => $order->from_town,
        //         'from_building' => $order->from_building,
        //         'from_phone' => $order->from_phone,
        //         'to_name' => $order->to_name,
        //         'to_postal_code' => $order->to_postal_code,
        //         'to_pref_id' => $order->to_pref_id,
        //         'to_city' => $order->to_city,
        //         'to_town' => $order->to_town,
        //         'to_building' => $order->to_building,
        //         'to_phone' => $order->to_phone,    
        //         'contact_info' => $order->contact_info,
        //         'delivery_company' => $delivery_company,
        //         'delivery_number' => $delivery_number,
        //         'for' => 'admin',
        //     ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));

           
        //     return back()->with('result', '商品発送メールを送信しました。');

        // }elseif( $mail == 2 ){
        //     $to = 'satou@b-partners.jp';
        //     $view = 'email.goods_cansel_confirm';

        //     //予約データを取得
        //     $order = GoodsOrder::where('id',$id)->first();
            

        //     //管理者へのメール送信
        //     $user = Auth::user();
        //     // echo "管理者--".$user->name."--".$user->email."<br>";
        //     $subject = '管理者へのメール';
        //     $name = $user->name;
        //     $with = [
        //         'name' => $name,
        //         'goods_name' => $goods_folder->name,
        //         'goods_kind' => $order->goods->name,
        //         'from_name' => $order->from_name,
        //         'from_postal_code' => $order->from_postal_code,
        //         'from_pref_id' => $order->from_pref_id,
        //         'from_city' => $order->from_city,
        //         'from_town' => $order->from_town,
        //         'from_building' => $order->from_building,
        //         'from_phone' => $order->from_phone,
        //         'to_name' => $order->to_name,
        //         'to_postal_code' => $order->to_postal_code,
        //         'to_pref_id' => $order->to_pref_id,
        //         'to_city' => $order->to_city,
        //         'to_town' => $order->to_town,
        //         'to_building' => $order->to_building,
        //         'to_phone' => $order->to_phone,    
        //         'contact_info' => $order->contact_info,
        //         'for' => 'admin',
        //     ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));

        //     //予約者へのメール送信
        //     $user = User::where('id',$order->user_id)->first();
        //     // echo "予約者--".$user->name."--".$user->email."<br>";
        //     $subject = '予約者へのメール';
        //     $name = $user->name;
        //     $with = [
        //         'name' => $name,
        //         'goods_name' => $goods_folder->name,
        //         'goods_kind' => $order->goods->name,
        //         'from_name' => $order->from_name,
        //         'from_postal_code' => $order->from_postal_code,
        //         'from_pref_id' => $order->from_pref_id,
        //         'from_city' => $order->from_city,
        //         'from_town' => $order->from_town,
        //         'from_building' => $order->from_building,
        //         'from_phone' => $order->from_phone,
        //         'to_name' => $order->to_name,
        //         'to_postal_code' => $order->to_postal_code,
        //         'to_pref_id' => $order->to_pref_id,
        //         'to_city' => $order->to_city,
        //         'to_town' => $order->to_town,
        //         'to_building' => $order->to_building,
        //         'to_phone' => $order->to_phone,    
        //         'contact_info' => $order->contact_info,
        //         'for' => 'admin',
        //     ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));

        //      //パートナーへメール送信
        //      $goods = Goods::where('id',$order->goods_id)->first();
        //      $goods_folder = GoodsFolder::where('id',$goods->goods_folder_id)->first();
        //      $user = User::where('id',$goods_folder->user_id)->first();
        //      // echo "パートナー--".$user->name."--".$user->email."<br>";
        //      $subject = 'パートナーへのメール';
        //      $name = $user->name;
        //      $with = [
        //         'name' => $name,
        //         'goods_name' => $goods_folder->name,
        //         'goods_kind' => $order->goods->name,
        //         'from_name' => $order->from_name,
        //         'from_postal_code' => $order->from_postal_code,
        //         'from_pref_id' => $order->from_pref_id,
        //         'from_city' => $order->from_city,
        //         'from_town' => $order->from_town,
        //         'from_building' => $order->from_building,
        //         'from_phone' => $order->from_phone,
        //         'to_name' => $order->to_name,
        //         'to_postal_code' => $order->to_postal_code,
        //         'to_pref_id' => $order->to_pref_id,
        //         'to_city' => $order->to_city,
        //         'to_town' => $order->to_town,
        //         'to_building' => $order->to_building,
        //         'to_phone' => $order->to_phone,    
        //         'contact_info' => $order->contact_info,
        //         'for' => 'admin',
        //      ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));   

        //     return back()->with('result', '商品キャンセルメールを送信しました。');


        // }else{

        //     return back()->with('result', '予約状況を更新しました。');

        // }


    }

    public function reserved_user()
    {
        $user = Auth::user();
        $reserved_users = ExperienceReserve::where('partner_id', $user->id)->get();

        // print_r($reserved_users);
        // exit;
       

        return view('mypage.partner.reserved_user', compact('user', 'reserved_users'));
    }

    public function user_info(string $id)
    {
        $user = User::where('id', $id)->first();

        return view('mypage.partner.user_info', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        return view('mypage.partner.profile', compact('user', 'partner'));
    }

    public function profile_post(Request $request)
    {
        $name = $request->name;
        $catch_copy = $request->catch_copy;
        $address = $request->address;
        $phone = $request->phone;
        $description = $request->description;
        $access = $request->access;
        $user = Auth::user();
        Partner::where('user_id', $user->id)->update([
            'name'=>$name,
            'catch_copy'=>$catch_copy,
            'address'=>$address,
            'phone'=>$phone,
            'description'=>$description,
            'access'=>$access,
        ]);
        
        $return_view = $this->profile();
        return $return_view;
    }

    public function link_delete(Request $request)
    {
        //idをもとにgoodscategory.tableから削除

        $id = $request->id;

        $links = Link::where('id', $id)->delete();

    }

    public function link_display()
    {
        $user = Auth::user();
        $current_user_id = $user->id;
        $links = Link::where('user_id', $current_user_id)->get();
        return view('mypage.partner.link_display', compact('user', 'links'));
    }

    public function link_insert(string $id)
    {
        $user = Auth::user();
        $links = Link::where('user_id', $user->id)->first();
        
        return view('mypage.partner.link_insert', compact('user', 'links'));
    }

    public function action_link_insert(Request $request)
    {
        $partner_id = $request->partner_id;
        $name = $request->name;
        $content = $request->content;
        
        Link::create([
            'partner_id'=>$partner_id,
            'name'=>$name,
            'content'=>$content,
        ]);
        
        $return_view = $this->link_display();
        return $return_view;
    }


    public function link_edit(string $id)
    {

        $user = Auth::user();
        $current_user_id = $user->id;
        $link = Link::where('user_id', $current_user_id)->where('id', $id)->first();
        
        return view('mypage.partner.link_edit', compact('user', 'link'));
    }

    public function action_link_edit(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $content = $request->content;
        
        Link::where('id', $id)->update([
            'name'=>$name,
            'content'=>$content,
        ]);
        
        
        $return_view = $this->link_display();
        return $return_view;
    }

    public function action_link_delete(Request $request)
    {
        $this->link_delete($request);
        
        $return_view = $this->link_display();
        return $return_view;
        
    }

    
}

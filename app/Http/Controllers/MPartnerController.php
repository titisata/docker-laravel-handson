<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExperienceCategory;
use App\Models\ExperienceFolder;
use App\Models\Experience;
use App\Models\GoodsFolder;
use App\Models\GoodsCategory;
use App\Models\Goods;
use App\Models\Partner;
use App\Models\Image;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MPartnerController extends Controller
{
    public function home()
    {
        return view('mypage.partner.home');
    }

   
    public function event()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $experiences_folders = $partner->experiences;
        return view('mypage.partner.event', compact('user', 'experiences_folders'));
    }

    public function event_add(string $id)
    {
        $user = Auth::user();
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_add', compact('user', 'experiences_folder', 'categories'));
    }

    public function event_post_date(Request $request)
    {   
        
        $partner_id = $request->partner_id;
        $name = $request->name;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;
        $address = $request->address;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $is_lodging = $request->is_lodging;
        $is_before_lodging = $request->is_before_lodging;
        $recommend_flag = $request->recommend_flag;
        $status = $request->status;
        $ex_names = $request->ex_names;
        $ex_price_adults = $request->ex_price_adults;
        $ex_price_childs = $request->ex_price_childs;  

        
    }


    public function action_event_add(Request $request)
    {
        $partner_id = $request->partner_id;
        $name = $request->name;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;
        $address = $request->address;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $is_lodging = $request->is_lodging;
        $is_before_lodging = $request->is_before_lodging;
        $recommend_flag = $request->recommend_flag;
        $status = $request->status;
        $ex_names = $request->ex_names;
        $ex_price_adults = $request->ex_price_adults;
        $ex_price_childs = $request->ex_price_childs;  
        
        ExperienceFolder::create([
            'partner_id' => $partner_id,
            'name' => $name,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
            'address' => $address,
            'description' => $description,
            'detail' => $detail,
            'caution' => $caution,
            'is_lodging' => $is_lodging,
            'is_before_lodging' => $is_before_lodging,
            'status' => $status,
            'recommend_flag' => $recommend_flag,
            'category1' => $category,
        ]);     

        $return_view = $this->event();
        return $return_view;
        
    }

    public function event_edit(string $id)
    {
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories'));
    }

    public function event_edit_update(Request $request)
    {

        $partner_id = $request->partner_id;
        $name = $request->name;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;
        $address = $request->address;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $is_lodging = $request->is_lodging;
        $is_before_lodging = $request->is_before_lodging;
        $recommend_flag = $request->recommend_flag;
        $status = $request->status; 
        $id = $request->id;
        $key = $request->key;

        $experiences_folder = ExperienceFolder::where('id', $id)->update([
            'name' => $name,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
            'address' => $address,
            'description' => $description,
            'detail' => $detail,
            'caution' => $caution,
            'is_lodging' => $is_lodging,
            'is_before_lodging' => $is_before_lodging,
            'status' => $status,
            'recommend_flag' => $recommend_flag,
            'category1' => $category,
        ]);

        // echo '<pre>';
        // print_r ($_POST);
        // echo '</pre>';
        // echo 'a';
        // echo $key;
        // exit;

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

    public function action_event_delete(Request $request)
    {
        //idをもとにexperiencecategory.tableから削除

        $id = $request->id;

        $experience_folder = ExperienceFolder::where('id', $id)->delete();

        $return_view = $this->event();
        return $return_view;

    }

    public function experience_delete(string $id)
    {
        //experience_deleteページへ
        $experience = Experience::where('id', $id)->first();
        return view('mypage.partner.experience_delete', compact('experience'));
    }

    public function action_experience_delete(Request $request)
    {
        $id = $request->ex_ids;
        $experience_folder_id = $request->ex_folder_ids;

        //idをもとにexperience.tableから削除
        $experience = Experience::where('id', $id)->delete();

        $return_view = $this->event_edit($experience_folder_id);
        return $return_view;
    }

    public function goods()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $goods_folders = GoodsFolder::all();
        return view('mypage.partner.goods', compact('user', 'goods_folders'));
    }

    public function goods_post_date(Request $request)
    {   
        $partner_id = $request->partner_id;
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;
        $detail = $request->detail;
        $caution = $request->caution;
        $category = $request->category;
        $recommend_flag = $request->recommend_flag; 

        
    }

    public function goods_add(string $id)
    {
        $user = Auth::user();
        $goods_folder = GoodsFolder::find($id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_add', compact('user', 'goods_folder', 'categories'));
    }

    public function action_goods_add(Request $request)
    {
        $this->goods_post_date($request);

        GoodsFolder::create([
            'partner_id' => $partner_id,
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'detail' => $detail,
            'caution' => $caution,
            'recommend_flag' => $recommend_flag,
            'category1' => $category,
        ]);     

        $return_view = $this->goods();
        return $return_view;
        
    }


    public function goods_edit(string $id)
    {
        $goods_folder = GoodsFolder::find($id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
    }

    public function goods_edit_update(Request $request)
    {

        $id = $request->id;
        $partner_id = $request->partner_id;
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

        // echo '<pre>';
        // print_r ($_POST);
        // echo '</pre>';
        // exit;

        $goods_folder = GoodsFolder::where('id', $id)->update([
            'name' => $name,
            'partner_id' => $partner_id,
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


    public function goods_delete(string $id)
    {
        //goods_deleteページへ
        $goods = Goods::where('id', $id)->first();
        return view('mypage.partner.goods_delete', compact('goods'));
    }

    public function action_goods_delete(Request $request)
    {
        $id = $request->goods_ids;
        $goods_folder_id = $request->goods_folder_ids;

        //idをもとにgoods.tableから削除
        $goods = Goods::where('id', $id)->delete();

        $return_view = $this->goods_edit($goods_folder_id);
        return $return_view;

    }

    public function action_goods_display_delete(Request $request)
    {
        //idをもとにgoodsfolders.tableから削除

        $id = $request->id;

        $goods_folder = GoodsFolder::where('id', $id)->delete();

        $return_view = $this->goods();
        return $return_view;

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

    public function event_image_edit($request)
    {
        //編集ページ表示
        $table_id = $request->table_id;
        $experiences_folder = ExperienceFolder::find($table_id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories'));
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
        $this->image_update($request, $id);
        
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
        $partner = Partner::where('user_id', $user->id)->first();
        $experiences_folders = ExperienceFolder::where('partner_id', $partner->id)->get();
        return view('mypage.partner.reserve', compact('user', 'partner', 'experiences_folders'));
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
        $links = Link::where('partner_id', $current_user_id)->get();
        return view('mypage.partner.link_display', compact('user', 'links'));
    }

    public function link_insert(string $id)
    {
        $user = Auth::user();
        $links = Link::where('partner_id', $id)->first();
        
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
        $link = Link::where('partner_id', $current_user_id)->where('id', $id)->first();
        
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

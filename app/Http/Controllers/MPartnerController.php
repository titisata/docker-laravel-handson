<?php

namespace App\Http\Controllers;

use App\Models\ExperienceCategory;
use App\Models\ExperienceFolder;
use App\Models\GoodsFolder;
use App\Models\GoodsCategory;
use App\Models\Partner;
use App\Models\Image;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MPartnerController extends Controller
{
    public function home()
    {
        return view('mypage.partner.home');
    }

    public function goods()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $goods_folders = GoodsFolder::all();
        return view('mypage.partner.goods', compact('user', 'goods_folders'));
    }

    public function goods_edit(string $id)
    {
        $goods_folder = GoodsFolder::find($id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
    }

    public function goods_edit_update(string $id, Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $description = $request->description;
        $caution = $request->caution;
        $detail = $request->detail;
        $category = $request->category;
        $ex_names = $request->ex_names;
        $ex_prices = $request->ex_prices;

        $goods_folder = GoodsFolder::where('id', $id)->update([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'caution' => $caution,
            'detail' => $detail,
            'category1' => $category,
        ]);

        for ($i=0; $i < count($ex_names); $i++) {
            $ex_name = $ex_names[$i];
            $ex_price = $ex_prices[$i];
        }

        $goods_folder = GoodsFolder::find($id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
    }

    public function event()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $experiences_folders = $partner->experiences;
        return view('mypage.partner.event', compact('user', 'experiences_folders'));
    }

    public function event_edit(string $id)
    {
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories'));
    }

    public function event_edit_update(string $id, Request $request)
    {
        $name = $request->name;
        $price_adult = $request->price_adult;
        $price_child = $request->price_child;
        $description = $request->description;
        $caution = $request->caution;
        $category = $request->category;
        $ex_names = $request->ex_names;
        $ex_price_adults = $request->ex_price_adults;
        $ex_price_childs = $request->ex_price_childs;

        $experiences_folder = ExperienceFolder::where('id', $id)->update([
            'name' => $name,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
            'description' => $description,
            'caution' => $caution,
            'category1' => $category,
        ]);

        for ($i=0; $i < count($ex_names); $i++) {
            $ex_name = $ex_names[$i];
            $ex_price_adult = $ex_price_adults[$i];
            $ex_price_child = $ex_price_childs[$i];
        }

        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories'));
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



    public function event_image_insert(string $id)
    {
        $experiences_folder = ExperienceFolder::find($id);
        return view('mypage.partner.event_image_insert', compact('experiences_folder'));
    }

    public function action_event_image_insert(Request $request, string $id)
    {
        $this->image_insert($request);

        $table_id = $request->table_id;
        $experiences_folder = ExperienceFolder::find($table_id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories'));
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

        $table_id = $request->table_id;
        $experiences_folder = ExperienceFolder::find($table_id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories'));
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

        $table_id = $request->table_id;
        $experiences_folder = ExperienceFolder::find($table_id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.event_edit', compact('experiences_folder', 'categories'));
    }

    public function goods_image_insert(string $id)
    {
        $goods_folder = GoodsFolder::find($id);
        return view('mypage.partner.goods_image_insert', compact('goods_folder'));
    }

    public function action_goods_image_insert(Request $request, string $id)
    {
        $this->image_insert($request);

        $table_id = $request->table_id;
        $goods_folder = GoodsFolder::find($table_id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
    }

    public function goods_image_update(string $id)
    {
        $images = Image::find($id);
        
        return view('mypage.partner.goods_image_update', compact('images'));
    }

    public function action_goods_image_update(Request $request)
    {
        $this->image_update($request, $id);
        
        $table_id = $request->table_id;
        $goods_folder = GoodsFolder::find($table_id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
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

        $table_id = $request->table_id;
        $goods_folder = GoodsFolder::find($table_id);
        $categories = GoodsCategory::all();
        return view('mypage.partner.goods_edit', compact('goods_folder', 'categories'));
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
        $partner = Partner::where('user_id', $user->id)->first();
        return view('mypage.partner.profile', compact('user', 'partner'));
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
        // $partner = Partner::where('user_id', $user->id)->first();
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
        
        $user = Auth::user();
        $current_user_id = $user->id;
        // $partner = Partner::where('user_id', $current_user_id)->first();
        $links = Link::where('partner_id', $current_user_id)->first();
        
        return view('mypage.partner.link_display', compact('user', 'links'));
    }


    public function link_edit(string $id)
    {

        $user = Auth::user();
        $current_user_id = $user->id;
        // $partner = Partner::where('user_id', $user->id)->first();
        $link = Link::where('partner_id', $current_user_id)->where('id', $id)->first();

        // echo $link;
        // exit;
        
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
        
        
        $user = Auth::user();
        // $partner = Partner::where('user_id', $user->id)->first();
        $current_user_id = $user->id;
        $links = Link::where('partner_id', $current_user_id)->get();
        return view('mypage.partner.link_display', compact('user', 'links'));
    }

    public function action_link_delete(Request $request)
    {
        $this->link_delete($request);
        
        $user = Auth::user();
        $current_user_id = $user->id;
        $links = Link::where('partner_id', $current_user_id)->get();
        return view('mypage.partner.link_display', compact('user', 'links'));
        
    }
}

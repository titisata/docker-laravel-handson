<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use App\Models\ExperienceReserve;
use App\Models\ExperienceFolder;
use App\Models\GoodsOrder;
use App\Models\GoodsFolder;
use App\Models\Favorite;
use App\Models\Link;
use App\Models\SiteMaster;
use App\Consts\LinkConst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class MUserController extends Controller
{
    public function home()
    {
        $now = now()->format('y-m-d');
        $user = Auth::user();
        $ordered_goods = $user->ordered_goods;
        $future_reserved_experiences = $user->future_reserved_experiences;

        $data1 = ExperienceReserve::where('user_id', $user->id)->select('payment_id','created_at');

        $data2 = GoodsOrder::where('user_id', $user->id)->select('payment_id','created_at')->union($data1)->orderBy('created_at', 'desc')->get();
        
        return view('mypage.user.home', compact('user', 'ordered_goods', 'future_reserved_experiences', 'data2'));
    }

    public function reserve()
    {
        $user = Auth::user();
        $reserved_experiences = $user->reserved_experiences;
        return view('mypage.user.reserve', compact('user', 'reserved_experiences'));
    }


    public function reserve_info(string $id)
    {
        $user = Auth::user();
        $reserved_experience = ExperienceReserve::where('id', $id)->first();
        $experience_folder = ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first();
        return view('mypage.user.reserve_info', compact('user', 'reserved_experience', 'experience_folder'));
    }

    public function goods_reserve_info(string $id)
    {
        $user = Auth::user();
        $goods_order = GoodsOrder::where('id', $id)->first();
        $goods_folder = GoodsFolder::where('id',$goods_order->goods->goods_folder_id)->first();
        return view('mypage.user.goods_reserve_info', compact('user', 'goods_order', 'goods_folder'));
    }

    public function favorite()
    {
        $user = Auth::user();
        $ex_favorites = Favorite::where('user_id', $user->id)->where('table_name', 'experience_folders')->get();
        $goods_favorites = Favorite::where('user_id', $user->id)->where('table_name', 'goods_folders')->get();
        return view('mypage.user.favorite', compact('user', 'ex_favorites', 'goods_favorites'));
    }

    public function receipt(string $id)
    {
        $user = Auth::user();
        $now = now()->format('y年m月d日');

        $site_masters = SiteMaster::find(1);

        $ordered_goods = $user->ordered_goods;
        $reserved_experiences = $user->reserved_experiences;

        $price = 0;

        if( $ordered_goods != '' && $reserved_experiences == ''){
            
            foreach($ordered_goods->where('payment_id', $id) as $one_ordered_goods){
                $price += $one_ordered_goods->total_price;
                $date = $one_ordered_goods->created_at;
                
            }

        }else if( $reserved_experiences != '' && $ordered_goods == ''){

            foreach ($reserved_experiences->where('payment_id', $id) as $reserved_experience){
                $price += $reserved_experience->sum_price();
                $date = $reserved_experience->created_at;
            }

        }else{

            foreach ($reserved_experiences->where('payment_id', $id) as $reserved_experience){
                $price += $reserved_experience->sum_price();
                $date = $reserved_experience->created_at;
            }
    
            foreach($ordered_goods->where('payment_id', $id) as $one_ordered_goods){
                $price += $one_ordered_goods->total_price;
                $date = $one_ordered_goods->created_at;
            }

        }
        
       
        return view('mypage.user.receipt', compact('user', 'ordered_goods', 'reserved_experiences', 'id', 'now', 'price', 'date', 'site_masters')); 
    }


    public function users()
    {
        $login_user = Auth::user();
        if($login_user->hasRole('system_admin')){
            $users = User::all();
        }else{
            $users = User::with('roles')
            ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
            ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
            ->select('users.*')
            ->whereIn("roles.name",["partner","user"]) 
            ->orderby("users.id")
            ->get();
        }
        
        return view('mypage.user.users', compact('users'));
    }

    public function users_edit(Request $request)
    {
        // $users = User::find($id)->first();
        $user = User::where('id', $request->id)->first();

        $login_user = Auth::user();
        if($login_user->hasRole('system_admin')){
            $roles = Role::all();
        }else{
            $roles = Role::whereIn("name",["partner","user"])->get();
        }
        
        $user_roles = array();
        if($request->id<>""){
            $user_roles_object = $user->getRoleNames();
            foreach($user_roles_object as $role_name){
                $user_roles[] = $role_name;
            }
        }

        return view('mypage.user.users_edit', compact('user', 'roles', 'user_roles'));
    }

    public function users_edit_post(Request $request)
    {
        $mode = $request->mode;
        
        if($mode=="ins"){
            $name = $request->name;
            $email = $request->email;
            $pass = $request->pass;
            $postal_code = $request->postal_code;
            $pref_id = $request->pref_id;
            $city = $request->city;
            $town = $request->town;
            $building = $request->building;
            $phone_number = $request->phone_number;
            $role = $request->role;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => null,
                'password' => Hash::make($pass),
                'postal_code' => $postal_code,
                'pref_id' => $pref_id,
                'city' => $city,
                'town' => $town,
                'building' => $building,
                'phone_number' => $phone_number,
            ]);

            $roles = Role::all();
            foreach($roles as $r){
                if(in_array($r->name,(array)$role)){
                    //echo $r->name."のroleを付与します<br>";
                    $user->assignRole($r->name);

                    if($r->name=="partner"){
                        //パートナーテーブルに登録
                        $partner = Partner::create([
                            'user_id' => $user->id,
                            'name' => $user->name,
                        ]);
                        Link::create([
                            'user_id'=>$partner->user_id,
                            'name'=>LinkConst::NAME,
                            'content'=>LinkConst::CONTENTS,
                        ]);

                    }
                }
            }

            if(in_array("partner",(array)$role)){
                return redirect('mypage/owner/partner_manege/'.$partner->id);
            }
        }

        if($mode=="upd"){
            $id = $request->id;
            $name = $request->name;
            $email = $request->email;
            $pass = $request->pass;
            $role = $request->role;

            $user = User::where('id', $id)->update([
                'name' => $name,
                'email' => $email,
            ]);
            
            if($pass<>""){
                $user = User::where('id', $id)->update([
                    'password' => Hash::make($pass),
                ]);
            }

            $user = User::where('id', $id)->first();
            $roles = Role::all();
            foreach($roles as $r){
                if(in_array($r->name,(array)$role)){
                    //echo $r->name."のroleを付与します<br>";
                    $user->assignRole($r->name);
                }else{
                    //echo $r->name."のroleを削除します<br>";
                    $user->removeRole($r->name);
                }
            }
        }

        if($mode=="del"){
            $id = $request->id;
            //パートナーテーブルから削除
            Partner::where('user_id', $id)->delete();

            User::where('id', $id)->delete();
        }
        
        return $this->users();
    }
}

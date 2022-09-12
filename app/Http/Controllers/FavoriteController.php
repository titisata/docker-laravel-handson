<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favorite_edit(Request $request){
        $user_id = $request->f_user_id;
        $favorite_id = $request->f_experienceFolder_id;
        $table_name = $request->f_table_name;
        //echo $user_id."---".$favorite_id."---".$table_name;
        
        if (Favorite::where('user_id', $user_id)->where('favorite_id', $favorite_id)->where('table_name', $table_name)->exists()){
            //登録有->取消処理
            $favorite = Favorite::where('user_id', $user_id)->where('favorite_id', $favorite_id)->where('table_name', $table_name)->first();
            Favorite::where('id', $favorite->id)->delete();

        }else{
            //登録なし->登録処理
            $favorite = Favorite::create([
                'user_id' => $user_id,
                'favorite_id' => $favorite_id,
                'table_name' => $table_name,
            ]);    
        }
        return "fin";
    }
}

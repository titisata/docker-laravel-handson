<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function show(string $id)
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

        $link = Link::where('id', $id)->first();
        
        return view('link.detail', compact('id', 'name', 'link'));
    }
}

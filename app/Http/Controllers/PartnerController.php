<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\ExperienceFolder;
use App\Models\GoodsFolder;

class PartnerController extends Controller
{
    public function show($id)
    {
        $partner = Partner::find($id);
        if ($partner == null) {
            return abort(404);
        }
        $experience_folders = ExperienceFolder::where('partner_id', $id)->get();
        $goods_folders = GoodsFolder::where('partner_id', $id)->get();
        return view('partner.detail', compact('partner', 'experience_folders', 'goods_folders'));
    }
}

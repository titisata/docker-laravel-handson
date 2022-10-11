<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\ExperienceFolder;
use App\Models\GoodsFolder;
use App\Models\Link;

class PartnerController extends Controller
{
    public function show($id)
    {
        $partner = Partner::find($id);
        if ($partner == null) {
            return abort(404);
        }
        $experience_folders = ExperienceFolder::where('user_id', $id)->get();
        $goods_folders = GoodsFolder::where('user_id', $id)->get();
        $links = Link::where('user_id', $partner->user_id)->get();
        return view('partner.detail', compact('partner', 'experience_folders', 'goods_folders', 'links'));
    }

    public function partner_link_show(string $id)
    {
        $link = Link::where('id', $id)->first();
        return view('partner.partner_link_show', compact('link'));
    }
}

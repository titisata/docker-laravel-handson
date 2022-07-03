<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\ExperienceCartItem;
use App\Models\ExperienceFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword == '') {
            return view('search.experience');
        }

        $experinceFolders = ExperienceFolder::search($keyword, per_page: 10);
        return view('search.experience_list', compact('experinceFolders'));
    }


    public function show(string $id)
    {
        $experienceFolder = ExperienceFolder::find($id);
        if ($experienceFolder == null) {
            return abort(404);
        }
        $experiences = $experienceFolder->experiences;
        return view('experience.detail', compact('experienceFolder', 'experiences'));
    }

    public function reserve_detail(string $folder_id, string $id)
    {
        $experienceFolder = ExperienceFolder::find($folder_id);
        $experience = Experience::find($id);
        if ($experienceFolder == null || $experience == null) {
            return abort(404);
        }
        return view('experience.reserve', compact('experienceFolder', 'experience'));
    }

    public function post(Request $request)
    {
        $id = $request->id;
        $uid = Auth::user()->id;
        $quantity_child = $request->quantity_child;
        $quantity_adult = $request->quantity_adult;
        $hotel_group_id = $request->hotel_group_id;
        $food_group_id = $request->food_group_id == 'food_group_null' ? null : $request->food_group_id;

        // TODO: 不正な IDの場合の処理
        ExperienceCartItem::create([
            'experience_id' => $id,
            'user_id' => $uid,
            'hotel_group_id' => $hotel_group_id,
            'food_group_id' => $food_group_id,
            'quantity_child' => $quantity_child,
            'quantity_adult' => $quantity_adult,
        ]);

        return view('experience.cart_success');
    }
}

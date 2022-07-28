<?php

namespace App\Http\Controllers;

use App\Models\ExperienceCategory;
use App\Models\ExperienceFolder;
use App\Models\Partner;
use Illuminate\Http\Request;
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
        return view('mypage.partner.experience', compact('user', 'experiences_folders'));
    }

    public function event_edit(string $id)
    {
        $experiences_folder = ExperienceFolder::find($id);
        $categories = ExperienceCategory::all();
        return view('mypage.partner.experience_edit', compact('experiences_folder', 'categories'));
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
        return view('mypage.partner.experience_edit', compact('experiences_folder', 'categories'));
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
}

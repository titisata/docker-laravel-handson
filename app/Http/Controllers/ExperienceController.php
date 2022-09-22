<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Experience;
use App\Models\ExperienceCartItem;
use App\Models\ExperienceCategory;
use App\Models\ExperienceFolder;
use App\Models\HotelGroupSelect;
use App\Models\FoodGroupSelect;
use App\Models\HotelGroup;
use App\Models\FoodGroup;
use App\Models\SiteMaster;
use App\Models\Image;
use App\Models\Favorite;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $category = $request->category;
        $is_lodging = $request->is_lodging;
        $categories = ExperienceCategory::all();
        $lodging = $request->lodging;

        // echo $category;
        // exit;
       

        if ($keyword == '') {
            $images = Image::where('table_name', 'experience_category')->get();
            $experiences_folders_is_lodging = ExperienceFolder::where('recommend_flag', 1)->where('is_lodging', 1)->where('status', 1)->orderBy('recommend_sort_no', 'desc')->get();
            $experiences_folders_not_is_lodging = ExperienceFolder::where('recommend_flag', 1)->where('is_lodging', 0)->where('status', 1)->orderBy('recommend_sort_no', 'desc')->get();
            return view('search.experience', compact('experiences_folders_is_lodging', 'experiences_folders_not_is_lodging', 'categories', 'images'));

        }elseif( ExperienceCategory::where('name', $category)->first() == ''){   

            $categories = ExperienceCategory::all();
            $experienceFolders = ExperienceFolder::search($keyword, $lodging, per_page: 10);
            $category = 'カテゴリー選択なし';
           
            return view('search.experience_list', compact('experienceFolders', 'categories', 'keyword', 'category', 'lodging'));

        }else{

            $categories = ExperienceCategory::all();
            $img_category = ExperienceCategory::where('name', $category)->first();
            $images = Image::where('table_name', 'experience_category')->where('table_id', $img_category->id)->first();
            $experienceFolders = ExperienceFolder::all_search($keyword, $category, $lodging, per_page: 10);

            // echo $category;
            // exit;
           
            return view('search.experience_list', compact('experienceFolders', 'categories', 'images', 'keyword', 'category', 'lodging'));

        }


        
    }


    public function show(string $id)
    {
        $user = Auth::user();
        $experienceFolder = ExperienceFolder::find($id);
        if ($experienceFolder == null) {
            return abort(404);
        }
        $experiences = $experienceFolder->active_experiences;
        $comments = $experienceFolder->comments();
        $reserves = $experienceFolder->reserves;
        $schedules = $experienceFolder->schedules;
        $mycomment = $experienceFolder->mycomment();
         
        $event_start_date = $experienceFolder->start_date;
        $event_end_date = $experienceFolder->end_date;

        $events = [];
        foreach ($reserves as $reserve) {
            $start_date = new DateTime($reserve->start_date);
            $event_date = $start_date->format('Y-m-d');
            $event_id = $start_date->format('Y-m-d') . $reserve->experience_id;
            if (array_key_exists($event_id, $events)) {
                $events[$event_id]['count']++;
            } else {
                $experience = $reserve->experience;
                $events[$event_id] = [
                    'count' => 1,
                    'name' => $experience->name,
                    'quantity' => $experience->quantity,
                    'start' => $event_date,
                ];
            }
        }

        $holiday_events = [];
        $work_events = [];
        foreach ($schedules as $schedule) {
            $date = new DateTime($schedule->date);
            $event_date = $date->format('Y-m-d');
            $event_id = $start_date->format('Y-m-d') . $schedule->id;

            if ($schedule->is_holiday) {
                $holiday_events[$event_id] = [
                    'title' => $schedule->title,
                    'comment' => $schedule->comment,
                    'date' => $event_date,
                ];
            } else {
                $work_events[$event_id] = [
                    'title' => $schedule->title,
                    'comment' => $schedule->comment,
                    'quantity' => $schedule->quantity,
                    'date' => $event_date,
                ];
            }
        }

        return view('experience.detail', compact('user', 'experienceFolder', 'experiences', 'comments', 'events', 'holiday_events', 'work_events', 'mycomment', 'event_start_date', 'event_end_date'));
    }

    

    public function reserve_detail(string $folder_id, string $id)
    {
        $user = Auth::user();
        $experienceFolder = ExperienceFolder::find($folder_id);
        $experience = Experience::find($id);
        // $hotel_group_selects = HotelGroupSelect::where('experience_folder_id', $experienceFolder->id)->first();
        // $food_group_selects = FoodGroupSelect::where('experience_folder_id', $experienceFolder->id)->get();
        $comments = $experienceFolder->comments();
        $mycomment = $experienceFolder->mycomment();

        if ($experienceFolder == null || $experience == null) {
            return abort(404);
        }
        return view('experience.reserve', compact('user', 'experienceFolder', 'experience', 'comments', 'mycomment'));
    }

    public function post(Request $request)
    {
        if( Auth::user()==null){
            return view('auth.login');
        }

        $id = $request->id;
        $user_id = $request->user_id;
        $uid = Auth::user()->id;
        $quantity_child = $request->quantity_child;
        $date = $request->date;
        $quantity_adult = $request->quantity_adult;
        $hotel_group_id = $request->hotel_group_id;
        $message = $request->message;
        $food_group_id = $request->food_group_id == 'food_group_null' ? null : $request->food_group_id;

        
        // TODO: 不正な IDの場合の処理
        ExperienceCartItem::create([
            'experience_id' => $id,
            'partner_id' => $user_id,
            'user_id' => $uid,
            'message' => $message,
            'hotel_group_id' => $hotel_group_id,
            'food_group_id' => $food_group_id,
            'quantity_child' => $quantity_child,
            'quantity_adult' => $quantity_adult,
            'start_date' => $date,
            'end_date' => $date,
            
        ]);

        return view('experience.cart_success');
    }
}

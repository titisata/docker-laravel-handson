<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Experience;
use App\Models\ExperienceCartItem;
use App\Models\GoodCartItem;
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
        $free_word = $request->free_word;
        $keyword = $request->keyword;
        $category = $request->category;
        $is_lodging = $request->is_lodging;
        $categories = ExperienceCategory::all();
        $lodging = $request->lodging;

        if ($keyword == '' && ExperienceCategory::where('name', $category)->first() == '' && $lodging == '' && $free_word == '') {
            $images = Image::where('table_name', 'experience_category')->get();
            $experiences_folders_is_lodging = ExperienceFolder::where('recommend_flag', 1)->where('is_lodging', 1)->where('status', 1)->orderBy('recommend_sort_no', 'asc')->get();
            $experiences_folders_not_is_lodging = ExperienceFolder::where('recommend_flag', 1)->where('is_lodging', 0)->where('status', 1)->orderBy('recommend_sort_no', 'asc')->get();
            return view('search.experience', compact('experiences_folders_is_lodging', 'experiences_folders_not_is_lodging', 'categories', 'images'));

        // }elseif( ExperienceCategory::where('name', $category)->first() == ''){   

        //     $categories = ExperienceCategory::all();
        //     $experienceFolders = ExperienceFolder::search($keyword, $lodging, per_page: 10);
        //     $category = 'カテゴリー選択なし';
        //     $images = Image::where('table_name', 'experience_category')->get();

        //     return view('search.experience_list', compact('experienceFolders', 'categories', 'keyword', 'category', 'lodging','images'));

        // }elseif($keyword == ''){   

        //     $categories = ExperienceCategory::all();
        //     $experienceFolders = ExperienceFolder::category_search($category, $lodging, per_page: 10);
        //     $keyword = '日付指定なし';
        //     $img_category = ExperienceCategory::where('name', $category)->first();
        //     $images = Image::where('table_name', 'experience_category')->where('table_id', $img_category->id)->get();
        //     return view('search.experience_list', compact('experienceFolders', 'categories', 'keyword', 'category', 'lodging','images'));

        // }else{

        //     $categories = ExperienceCategory::all();
        //     $img_category = ExperienceCategory::where('name', $category)->first();
        //     $images = Image::where('table_name', 'experience_category')->where('table_id', $img_category->id)->get();
        //     $experienceFolders = ExperienceFolder::all_search($keyword, $category, $lodging, per_page: 10);

        //     return view('search.experience_list', compact('experienceFolders', 'categories', 'images', 'keyword', 'category', 'lodging'));

        // }
        }else{
            $categories = ExperienceCategory::all();
            $experienceFolders = ExperienceFolder::search_ex($keyword, $category, $free_word, $lodging, per_page: 10);
            $images = Image::where('table_name', 'experience_category')->get();
            if($keyword==""){
                $keyword = '日付指定なし';
            }
            if($free_word==""){
                $free_word = '指定なし';
            }
            if($category==""){
                $category = 'カテゴリー選択なし';
                $images = Image::where('table_name', 'experience_category')->get();
            }else{
                $img_category = ExperienceCategory::where('name', $category)->first();
                $images = Image::where('table_name', 'experience_category')->where('table_id', $img_category->id)->get();
            }
            return view('search.experience_list', compact('experienceFolders', 'categories', 'images', 'keyword', 'free_word', 'category', 'lodging'));
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

        $full_experience = array();
        if (app('request')->input('keyword')<>""){
            if($experienceFolder->is_before_lodging){
                $target_date = app('request')->input('keyword')->modify("-1day")->format('Y-m-d');
            }else{
                $target_date = app('request')->input('keyword');
            }
            foreach($experiences as $ex) {
                //echo $ex->id."----".$ex->quantity."----".$ex->reserve_count($target_date);
                //echo "<br>";
                if($ex->reserve_count($target_date)>=$ex->quantity){
                    $full_experience[] = $ex->id;
                }
            }
        }

        if( $user!=null ){
            $favorite = Favorite::where('user_id', $user->id)->where('favorite_id', $experienceFolder->id)->first();
            return view('experience.detail', compact('user', 'experienceFolder', 'experiences', 'comments', 'events', 'holiday_events', 'work_events', 'mycomment', 'event_start_date', 'event_end_date', 'full_experience', 'favorite'));
        }else{
            return view('experience.detail', compact('user', 'experienceFolder', 'experiences', 'comments', 'events', 'holiday_events', 'work_events', 'mycomment', 'event_start_date', 'event_end_date', 'full_experience'));
        }
        
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

        if($experience->reserve_count(app('request')->input('keyword'))>=$experience->quantity){
            $full_experience_flag = 1;
        }else{
            $full_experience_flag = 0;
        }

        if ($experienceFolder == null || $experience == null) {
            return abort(404);
        }
        return view('experience.reserve', compact('user', 'experienceFolder', 'experience', 'comments', 'mycomment', 'full_experience_flag'));
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

        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $price = 0;
        foreach ($experienceCartItems as $experienceCartItem) {
            $price += $experienceCartItem->sum_price();
        }
        foreach ($goodCartItems as $goodCartItem) {
            $price += $goodCartItem->sum_price();
        }
        return view('cart.list', compact('experienceCartItems', 'goodCartItems', 'price'));
        
    }
}

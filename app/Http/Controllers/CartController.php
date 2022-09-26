<?php

namespace App\Http\Controllers;

use App\Models\ExperienceCartItem;
use App\Models\ExperienceReserve;
use App\Models\GoodCartItem;
use App\Models\Goods;
use App\Models\GoodsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class CartController extends Controller
{
    public function index()
    {
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

    public function confirm()
    {
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
        return view('cart.cofirm', compact('experienceCartItems', 'goodCartItems', 'price'));
    }

    public function purchase()
    {
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
        return view('cart.purchase', compact('price'));
    }

    public function delete_experience(Request $request)
    {
        $uid = Auth::user()->id;
        $item_id = $request->id;
        // TODO: UIDの確認を入れる
        ExperienceCartItem::destroy($item_id);
        return response()->json(['message'=>'success']);
    }

    public function delete_goods(Request $request)
    {
        $uid = Auth::user()->id;
        $item_id = $request->id;
        // TODO: UIDの確認を入れる
        GoodCartItem::destroy($item_id);
        return response()->json(['message'=>'success']);
    }

    public function purchase_post(Request $request)
    {
        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();

        $price = 0;
        $description_experiences = '';
        $description_goods = '';
        $partner_array = array();
        foreach ($experienceCartItems as $experienceCartItem) {
            ExperienceReserve::create([
                'user_id' => $uid,
                'partner_id' => $experienceCartItem->partner_id,
                'experience_id' => $experienceCartItem->experience_id,
                'hotel_group_id' => $experienceCartItem->hotel_group_id,
                'food_group_id' => $experienceCartItem->food_group_id,
                'hotel_id' => null,
                'food_id' => null,
                'comment' => 'コメントはありません',
                'message' => $experienceCartItem->message,
                'status' => '対応待ち',
                'quantity_child' => $experienceCartItem->quantity_child,
                'quantity_adult' => $experienceCartItem->quantity_adult,
                'start_date' =>  $experienceCartItem->start_date,
                'end_date' =>  $experienceCartItem->end_date,
            ]);
            
            $price += $experienceCartItem->sum_price();
            $description_experiences.= "---------------------------------\r\n";
            $description_experiences.= $experienceCartItem->experience->name."\r\n";
            $description_experiences.= "予約日：".$experienceCartItem->experience->start_date."\r\n";
            $description_experiences.= "大人：".$experienceCartItem->quantity_adult."人　子供：".$experienceCartItem->quantity_adult."人\r\n";
            $description_experiences.= is_null($experienceCartItem->hotelGroup) ? "宿泊：なし\r\n" : "宿泊：".$experienceCartItem->hotelGroup->name."\r\n";
            $description_experiences.= is_null($experienceCartItem->foodGroup) ? "食事：なし\r\n" : "食事：".$experienceCartItem->foodGroup->name."\r\n";
            $description_experiences.= "金額：".$experienceCartItem->sum_price()."\r\n";
            $description_experiences.= "---------------------------------\r\n";
            if(!in_array($experienceCartItem->partner_id, $partner_array)) {
                $partner_array += array($experienceCartItem->partner_id => array('description_experiences' => "", 'description_goods' => "", 'price' => 0));
            }
            $partner_array[$experienceCartItem->partner_id]['description_experiences'] .= $description_experiences;
            $partner_array[$experienceCartItem->partner_id]['price'] += $experienceCartItem->sum_price();
        }
        
        foreach ($goodCartItems as $goodCartItem) {
            GoodsOrder::create([
                'partner_id' => $goodCartItem->partner_id,
                'goods_id' => $goodCartItem->goods_id,
                'user_id' => $uid,
                'quantity' => $goodCartItem->quantity,
            ]);
            
            $price += $goodCartItem->sum_price();
            $description_goods.= "---------------------------------\r\n";
            $description_goods.= "名前：".$goodCartItem->goods->name."\r\n";
            $description_goods.= "個数：".$goodCartItem->goods->quantity."\r\n";
            $description_goods.= "金額：".$goodCartItem->sum_price()."\r\n";
            $description_goods.= "---------------------------------\r\n";
            // if(!in_array($experienceCartItem->partner_id, $partner_array)) {
            //     $partner_array += array($experienceCartItem->partner_id => array('description_experiences' => "", 'description_goods' => "", 'price' => 0));
            // }
            // $partner_array[$experienceCartItem->partner_id]['description_goods'] .= $description_goods;
            // $partner_array[$experienceCartItem->partner_id]['price'] +=  $goodCartItem->sum_price();
        }

        // echo "<pre>";
        // print_r($partner_array);
        // echo "</pre>";
        // exit;

        ExperienceCartItem::where('user_id', $uid)->delete();
        GoodCartItem::where('user_id', $uid)->delete();
        
        //管理者へメール

        //ユーザへメール
        $to = 'satou@b-partners.jp';
        $view = 'email.cart_confirm';

        $user = Auth::user();
        $subject = '決済完了メール';
        $name = $user->name;
        $with = [
            'name' => $name,
            'description_experiences' => $description_experiences,
            'description_goods' => $description_goods,
            'price' => $price,
            'for' => 'user',
        ];
        // Mail::send(new SendMail($with, $to, $subject, $view));
        // echo "fin";
        // exit;
        
        return view('cart.success');
    }
}

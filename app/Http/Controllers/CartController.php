<?php

namespace App\Http\Controllers;

use App\Models\ExperienceCartItem;
use App\Models\ExperienceReserve;
use App\Models\GoodCartItem;
use App\Models\Goods;
use App\Models\GoodsOrder;
use App\Models\User;
use App\Mail\PurchaseSendRemaindMail;
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

        $show = 0;
        return view('cart.cofirm', compact('experienceCartItems', 'goodCartItems', 'price', 'show'));
        
        
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

        $name = Auth::user()->name;
        $postal_code = Auth::user()->postal_code;
        $pref_id = Auth::user()->pref_id;
        $city = Auth::user()->city;
        $town = Auth::user()->town;
        $building = Auth::user()->building;
        $phone_number = Auth::user()->phone_number;
        $stripe_public_key = config('stripe_key.stripe_public_key');

        return view('cart.purchase', compact('experienceCartItems', 'goodCartItems', 'price', 'name', 'postal_code', 'pref_id', 'city', 'town', 'building', 'phone_number', 'price', 'stripe_public_key'));
        
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
        $goodCartItem = GoodCartItem::where('id', $item_id)->first();
        Goods::where('id', $goodCartItem->goods_id)->increment('quantity',$goodCartItem->quantity);

        GoodCartItem::destroy($item_id);
        return response()->json(['message'=>'success']);
    }

    public function purchase_post(Request $request)
    {
        $stripe_secret_key = config('stripe_key.stripe_secret_key');
        \Stripe\Stripe::setApiKey($stripe_secret_key);
        
        try {
            $amount = intval($request->price);
            $stripeToken = $request->stripeToken;
            $charge = \Stripe\Charge::create(array(
                'amount' => $amount,
                'currency' => 'jpy',
                'source'=> $stripeToken,
            ));
            $result = 1;
            $uniq_id = $charge['id'];
        } catch(\Stripe\Exception\CardException $e) {
            $result = 2;
            $error = $e->getMessage();
        } catch (\Stripe\Exception\RateLimitException $e) {
            $result = 3;
            $error = $e->getMessage();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $result = 4;
            $error = $e->getMessage();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $result = 5;
            $error = $e->getMessage();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $result = 6;
            $error = $e->getMessage();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $result = 7;
            $error = $e->getMessage();
        } catch (Error $e) {
            $result = 8;
            $error = $e->getMessage();
        }

        if ($result==1) {
            //決済成功
        }else{
            //決済失敗
            return view('cart.failure');
            exit;
        }

        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();

        $price = 0;
        $description_experiences_all = '';
        $description_goods_all = '';
        $partner_array = array();
        $ex_make_id = array();
        $goods_make_id = array();
        foreach ($experienceCartItems as $experienceCartItem) {
            $description_experiences = '';
            $description_goods = '';


            $ex_data = ExperienceReserve::create([
                'user_id' => $uid,
                'partner_id' => $experienceCartItem->partner_id,
                'experience_id' => $experienceCartItem->experience_id,
                'hotel_group_id' => $experienceCartItem->hotel_group_id,
                'food_group_id' => $experienceCartItem->food_group_id,
                'hotel_id' => null,
                'food_id' => null,
                'comment' => 'コメントはありません',
                'message' => $experienceCartItem->message,
                'contact_info' => $experienceCartItem->contact_info(),
                'status' => '1',
                'quantity_child' => $experienceCartItem->quantity_child,
                'quantity_adult' => $experienceCartItem->quantity_adult,
                'start_date' =>  $experienceCartItem->start_date,
                'end_date' =>  $experienceCartItem->end_date,
                'payment_id' => $uniq_id,
                'experience_price_child' =>  $experienceCartItem->experience->price_child,
                'experience_price_adult' =>  $experienceCartItem->experience->price_adult,
                'hotel_price_child' =>  is_null($experienceCartItem->hotelGroup) ? NULL : $experienceCartItem->hotelGroup->price_child,
                'hotel_price_adult' =>  is_null($experienceCartItem->hotelGroup) ? NULL : $experienceCartItem->hotelGroup->price_adult,
                'food_price_child' =>  is_null($experienceCartItem->foodGroup) ? NULL : $experienceCartItem->foodGroup->price_child,
                'food_price_adult' =>  is_null($experienceCartItem->foodGroup) ? NULL : $experienceCartItem->foodGroup->price_adult,
                'total_price' =>  $experienceCartItem->sum_price(),
            ]);
            
            $price += $experienceCartItem->sum_price();
            $description_experiences = "---------------------------------\r\n";
            $description_experiences.= $experienceCartItem->experience->name."\r\n";
            $description_experiences.= "予約日：".$experienceCartItem->experience->start_date."\r\n";
            $description_experiences.= "大人：".$experienceCartItem->quantity_adult."人　子供：".$experienceCartItem->quantity_adult."人\r\n";
            $description_experiences.= is_null($experienceCartItem->hotelGroup) ? "宿泊：なし\r\n" : "宿泊：".$experienceCartItem->hotelGroup->name."\r\n";
            $description_experiences.= is_null($experienceCartItem->foodGroup) ? "食事：なし\r\n" : "食事：".$experienceCartItem->foodGroup->name."\r\n";
            $description_experiences.= "金額：".$experienceCartItem->sum_price()."\r\n";
            $description_experiences.= "この体験に関するお問合せ：".$experienceCartItem->contact_info()."\r\n";
            $description_experiences.= "---------------------------------\r\n";
            $description_experiences_all.= $description_experiences;
            if(!in_array($experienceCartItem->partner_id, $partner_array)) {
                $partner_array += array($experienceCartItem->partner_id => array('description_experiences' => "", 'description_goods' => "", 'price' => 0));
            }
            $partner_array[$experienceCartItem->partner_id]['description_experiences'] .= $description_experiences;
            $partner_array[$experienceCartItem->partner_id]['price'] += $experienceCartItem->sum_price();

            $ex_make_id[] = $ex_data->id; 
        }

        $to_name = $request->to_name;
        $to_postal_code = $request->to_postal_code;
        $to_pref_id = $request->to_pref_id;
        $to_city = $request->to_city;
        $to_town = $request->to_town;
        $to_building = $request->to_building;
        $to_phone_number = $request->to_phone_number;
        
        
        foreach ($goodCartItems as $goodCartItem) {
            $goods_data = GoodsOrder::create([
                'partner_id' => $goodCartItem->partner_id,
                'goods_id' => $goodCartItem->goods_id,
                'user_id' => $uid,
                'quantity' => $goodCartItem->quantity,
                'contact_info' => $goodCartItem->contact_info(),
                'goods_price' =>  $goodCartItem->goods->price,
                'total_price' =>  $goodCartItem->sum_price(),
                'status' => '1',
                'delivery_company' => '未確定',
                'delivery_number' => '0',
                'from_name' =>Auth::user()->name,
                'from_postal_code' =>Auth::user()->postal_code,
                'from_pref_id' =>Auth::user()->pref_id,
                'from_city' =>Auth::user()->city,
                'from_town' =>Auth::user()->town,
                'from_building' =>Auth::user()->building,
                'from_phone_number' =>Auth::user()->phone_number,
                'to_name' => $to_name,
                'to_postal_code' => $to_postal_code,
                'to_pref_id' => $to_pref_id,
                'to_city' => $to_city,
                'to_town' => $to_town,
                'to_building' => $to_building,
                'to_phone_number' => $to_phone_number,
                'payment_id' => $uniq_id,

            ]);
            
            $price += $goodCartItem->sum_price();
            $description_goods = "---------------------------------\r\n";
            $description_goods.= "名前：".$goodCartItem->goods->name."\r\n";
            $description_goods.= "個数：".$goodCartItem->goods->quantity."\r\n";
            $description_goods.= "金額：".$goodCartItem->sum_price()."\r\n";
            $description_goods.= "お届け先氏名：".$to_name."\r\n";
            $description_goods.= "お届け先郵便番号：".$to_postal_code."\r\n";
            $description_goods.= "お届け先住所：".User::$prefs[$to_pref_id]."".$to_city."".$to_town."".$to_building."\r\n";
            $description_goods.= "お届け先電話番号：".$to_phone_number."\r\n";
            $description_goods.= "商品に関するお問合せ：".$goodCartItem->contact_info()."\r\n";
            $description_goods.= "---------------------------------\r\n";
            $description_goods_all.= $description_goods;
            if(!in_array($goodCartItem->partner_id, $partner_array)) {
                $partner_array += array($goodCartItem->partner_id => array('description_experiences' => "", 'description_goods' => "", 'price' => 0));
            }
            $partner_array[$goodCartItem->partner_id]['description_goods'] .= $description_goods;
            $partner_array[$goodCartItem->partner_id]['price'] +=  $goodCartItem->sum_price();
            $goods_make_id[] = $goods_data->id;
        }

        
        ExperienceCartItem::where('user_id', $uid)->delete();
        GoodCartItem::where('user_id', $uid)->delete();

        
        $obj = new PurchaseSendRemaindMail($ex_make_id, $goods_make_id, $partner_array);
        $obj->purchase_send_remaind_mail();

        // exit;

        
        //メール文章
        // $view = 'email.cart_confirm';

        // //各パートナーへメール
        // foreach ($partner_array as $partner_id => $v) {
        //     $partner = User::where('id', $partner_id)->first();
        //     $subject = '決済完了通知メール';
        //     $name = $partner->name;
        //     $to = $partner->email;
        //     $to = 'satou@b-partners.jp';

        //     $with = [
        //         'name' => $name,
        //         'description_experiences' => $v['description_experiences'],
        //         'description_goods' => $v['description_goods'],
        //         'price' => $v['price'],
        //         'for' => 'user',
        //     ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));
        // }

        //管理者へメール
        // $admins  = User::with('roles')
        // ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
        // ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
        // ->select('users.*')
        // ->where("roles.name", "site_admin") 
        // ->get();

        // foreach ($admins as $admin) {
        //     $subject = '決済完了通知メール';
        //     $name = $admin->name;
        //     $to = $admin->email;
        //     $to = 'satou@b-partners.jp';
        //     $with = [
        //         'name' => $name,
        //         'description_experiences' => $description_experiences_all,
        //         'description_goods' => $description_goods_all,
        //         'price' => $price,
        //         'for' => 'user',
        //     ];
        //     // Mail::send(new SendMail($with, $to, $subject, $view));
        // }        

        // //ユーザへメール
        // $user = Auth::user();
        // $subject = '決済完了メール';
        // $name = $user->name;
        // $to = $user->email;
        // $to = 'satou@b-partners.jp';
        // $with = [
        //     'name' => $name,
        //     'description_experiences' => $description_experiences_all,
        //     'description_goods' => $description_goods_all,
        //     'price' => $price,
        //     'for' => 'user',
        // ];
        // Mail::send(new SendMail($with, $to, $subject, $view));
        // echo "fin";
        // exit;
        
        return view('cart.success');
    }
}

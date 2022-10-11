<?php

namespace App\Mail;

use App\Models\GoodsOrder;
use App\Models\User;
use App\Models\Role;
use App\Consts\GoodsMailConst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class GoodsSendRemaindMail
{

    //ステータスを見る
    private $save_flag;
    private $reserve_data;
    private $request_data;
    private $array;
    private $subject;
    private $view;
    private $site_admin;
    private $partner;
    private $user;
    private $with = array();
    private $i = 0;

    // コンストラクタ
    public function __construct($save_flag ,$id) {
        $this->save_flag = $save_flag;
        $this->order_data = GoodsOrder::where('id', $id)->first();
    }
    

    public function contents_info($save_flag){

        $this->array = [
            [
                [
                    'user_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "system_admin") 
                    ->first(),
                    'goods_info'=> $this->order_data,
                    'admin_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "system_admin") 
                    ->first(),
                    'for'=>'system_admin',
                ],
                User::with('roles')
                ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                ->select('users.*')
                ->where("roles.name", "system_admin") 
                ->first()->email,
                GoodsMailConst::SUBJECT_2,
                GoodsMailConst::SUBJECT_2,
            ],
            [
                [
                    'user_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "site_admin") 
                    ->first(),
                    'goods_info'=> $this->order_data,
                    'admin_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "site_admin") 
                    ->first(),
                    'for'=>'site_admin',
                ],
                User::with('roles')
                ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                ->select('users.*')
                ->where("roles.name", "site_admin") 
                ->first()->email,
                GoodsMailConst::SUBJECT_2,
                GoodsMailConst::SUBJECT_2,
            ],
            [
                [
                'user_info'=>Auth::user()->first(),
                'goods_info'=> $this->order_data,
                'admin_info'=>User::with('roles')
                ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                ->select('users.*')
                ->where("roles.name", "site_admin") 
                ->first(),
                'for'=>'partner',
                ],
                User::where('id', $this->order_data->partner_id)->first()->email,
                GoodsMailConst::SUBJECT_2,
                GoodsMailConst::SUBJECT_2,
            ],
            [
                [
                'user_info'=>User::where('id', $this->order_data->user_id)->first(),
                'goods_info'=> $this->order_data,
                'admin_info'=>User::with('roles')
                ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                ->select('users.*')
                ->where("roles.name", "site_admin") 
                ->first(),
                'for'=>'partner',
                ],
                User::where('id', $this->order_data->user_id)->first()->email,
                GoodsMailConst::SUBJECT_2,
                GoodsMailConst::SUBJECT_2,
            ],
        
            
        ];
        
    }

    // public function MailContents($save_flag){
        
    //     switch ( $save_flag ){
           
    //         //商品発送
    //         case 10:
    //             $request_data = $this->contents_info($this->save_flag);
    //             $this->$subject = GoodsMailConst::SUBJECT_2;
    //             $this->$view = GoodsMailConst::VIEW_2;
                
    //             foreach($this->array as $key=>$to){
    //                 $this->with[] =[
    //                     'user_info'=>$to[1],
    //                     'order_data'=>$this->order_data,
    //                     'for'=>$key,
    //                 ];
    //             }
               
    //             break;
            
    //         //キャンセル連絡済み
    //         case 99:
    //             $request_data = $this->contents_info($this->save_flag);
    //             $this->subject = GoodsMailConst::SUBJECT_3;
    //             $this->view = GoodsMailConst::VIEW_3;

    //             foreach($this->array as $key=>$to){
    //                 $this->with[] =[
    //                     'user_info'=>$to[1],
    //                     'order_data'=>$this->order_data,
    //                     'for'=>$key,
    //                 ];
    //             }
                
    //           break;
    //         default:
    //         echo $save_flag;
    //     }
    // }

    public function goods_send_remaind_mail(){
        $request_data = $this->contents_info($this->save_flag);

        foreach($this->array as $key=>$to){

            Mail::send(new SendMail($to[0],'titaya@knowledge-cs.com', $to[2], $to[1] ));
            // Mail::send(new SendMail($with[$key],$to[0], $subject, $view ));
            // print_r($with[$key]);
        }
    //  exit;
        
    }

}


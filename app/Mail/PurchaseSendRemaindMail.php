<?php

namespace App\Mail;

use App\Models\ExperienceReserve;
use App\Models\GoodsOrder;
use App\Models\User;

use App\Models\Role;
use App\Consts\PurchaseConst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class PurchaseSendRemaindMail
{

    //ステータスを見る
    private $reserve_data = array();
    private $order_data = array();
    private $request_data;
    private $array;
    private $subject;
    private $view;
    private $site_admin;
    private $site_admin_mail;
    private $partner;
    private $user;
    private $partner_array = array();
    private $with = array();
    private $array_merge = array();
    private $i = 0;

    // コンストラクタ
    public function __construct($ex_make_id, $goods_make_id, $partner_array) {
        foreach($ex_make_id as $ex_id){
            $this->reserve_data[] = ExperienceReserve::where('id', $ex_id)->first();
        }

        foreach($goods_make_id as $goods_id){
            $this->order_data[] = GoodsOrder::where('id', $goods_id)->first();
        }

    }
    
    public function contents_info(){

        $this->array = [
            [ 
                [
                    'user_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "system_admin") 
                    ->first(),
                    'ex_infos'=>$this->reserve_data,
                    'goods_infos'=> $this->order_data,
                    'admin_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "site_admin") 
                    ->first(),
                    'for'=>'system_admin',
                ],
                User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "system_admin") 
                    ->first()->email,
                PurchaseConst::SUBJECT_1,
                PurchaseConst::VIEW_1,
            ],

            [ 
                [
                    'user_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "site_admin") 
                    ->first(),
                    'ex_infos'=>$this->reserve_data,
                    'goods_infos'=> $this->order_data,
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
                PurchaseConst::SUBJECT_1,
                PurchaseConst::VIEW_1,
            ],
            
            [
               
                [
                    'user_info'=>Auth::user(),
                    'ex_infos'=>$this->reserve_data,
                    'goods_infos'=> $this->order_data,
                    'admin_info'=>User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "site_admin") 
                    ->first(),
                    'for'=>'user',
                ],
                Auth::user()->email,
                PurchaseConst::SUBJECT_1,
                PurchaseConst::VIEW_1,
            ],
            
        ];

        $this->array_2 =[];
        $check_array = array();
        
        foreach($this->reserve_data as $ex_partner){
            $id = $ex_partner->partner_id;
            if(!in_array($id, $check_array)) {
                $this->array_2 = [
                   [
                        [
                            'user_info'=>User::where('id', $id )->first(),
                            'ex_infos'=>$this->reserve_data,
                            'goods_infos'=> $this->order_data,
                            'admin_info'=>User::with('roles')
                            ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                            ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                            ->select('users.*')
                            ->where("roles.name", "site_admin") 
                            ->first(),
                            'for'=>'partner',
                        ],
                        User::where('id', $id )->first()->email,
                        PurchaseConst::SUBJECT_1,
                        PurchaseConst::VIEW_1,
                    ],
                ];
                $check_array[] = $id;
            }
 
        }

        foreach($this->order_data as $goods_partner){
            $id = $goods_partner->partner_id;
            if(!in_array($id, $check_array)) {
                $this->array_2 = [ 
                    [
                        [
                            'user_info'=>User::where('id', $id )->first(),
                            'ex_infos'=>$this->reserve_data,
                            'goods_infos'=> $this->order_data,
                            'admin_info'=>User::with('roles')
                            ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                            ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                            ->select('users.*')
                            ->where("roles.name", "site_admin") 
                            ->first(),
                            'for'=>'partner',
                        ],
                        User::where('id', $id )->first()->email,
                        PurchaseConst::SUBJECT_1,
                        PurchaseConst::VIEW_1,
                    ],
                ];
            }
            $check_array[] = $id;

        }

        // print_r($this->array_2);
        // exit;

        
        //配列を結合する
        $this->array_merge = array_merge($this->array, $this->array_2);
        
    }

    

    public function purchase_send_remaind_mail(){
        $request_data = $this->contents_info();

        
        // print_r('<pre>');
        // print_r($this->array_merge);
        // print_r('<pre>');
        // exit;

        foreach ($this->array_merge as $to){
            
            Mail::send(new SendMail($to[0],'titaya@knowledge-cs.com', $to[2], $to[3] ));
            // Mail::send(new SendMail($with[$key],$to[1], $subject, $view ));
            // print_r($with[$key]);
          
        }
    //  exit;
        
    }

}


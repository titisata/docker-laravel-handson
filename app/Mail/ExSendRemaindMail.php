<?php

namespace App\Mail;

use App\Models\ExperienceReserve;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Role;
use App\Consts\ExMailConst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ExSendRemaindMail
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
    private $hotel;
    private $hotel_info;
    private $with = array();
    private $i = 0;

    // コンストラクタ
    public function __construct($save_flag ,$id) {
        $this->save_flag = $save_flag;
        $this->reserve_data = ExperienceReserve::where('id', $id)->first();
    }
    

    public function contents_info($save_flag){

        if($save_flag != 10){

            $this->array = [
                [
                    $this->site_admin = Auth::user()->email,
                    $this->site_admin = Auth::user(),
                ],
                [   
                    $this->partner = User::where('id', $this->reserve_data->partner_id)->first()->email,
                    $this->partner = User::where('id', $this->reserve_data->partner_id)->first(),
                ],
                [
                    $this->user = User::where('id', $this->reserve_data->user_id)->first()->email,
                    $this->user = User::where('id', $this->reserve_data->user_id)->first(),
                ],
                
            ];
        }else{

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
                    'for'=>'system_admin',
                ],
                User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "system_admin") 
                    ->first()->email,
                    ExMailConst::SUBJECT_2,
                    ExMailConst::VIEW_2,
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
                    'for'=>'site_admin',
                ],
                User::with('roles')
                    ->leftjoin('model_has_roles' , 'users.id', '=','model_has_roles.model_id')
                    ->leftjoin('roles' , 'model_has_roles.role_id', '=','roles.id')
                    ->select('users.*')
                    ->where("roles.name", "site_admin") 
                    ->first()->email,
                    ExMailConst::SUBJECT_2,
                    ExMailConst::VIEW_2,
            ],

            [
                [
                    'user_info'=>User::where('id', $this->reserve_data->partner_id)->first(),
                    'ex_infos'=>$this->reserve_data,
                    'for'=>'user',
                ],
                Auth::user()->email,
                ExMailConst::SUBJECT_2,
                ExMailConst::VIEW_2,
            ],
            
            [
               
                [
                    'user_info'=>User::where('id', $this->reserve_data->user_id)->first(),
                    'ex_infos'=>$this->reserve_data,
                    'for'=>'user',
                ],
                Auth::user()->email,
                ExMailConst::SUBJECT_2,
                ExMailConst::VIEW_2,
            ],
            [
               
                [
                    'user_info'=>Hotel::where('id', $this->reserve_data->hotel_id)->first(),
                    'ex_infos'=>$this->reserve_data,
                    'for'=>'user',
                ],
                Auth::user()->email,
                ExMailConst::SUBJECT_2,
                ExMailConst::VIEW_2,
            ],
            
        ];
        }
        

    
    }


    public function ex_send_remaind_mail(){
        $request_data = $this->contents_info($this->save_flag);

        foreach($this->array as $key=>$to){

            Mail::send(new SendMail($to[0],'titaya@knowledge-cs.com', $to[2], $to[1] ));
            // Mail::send(new SendMail($with[$key],$to[0], $subject, $view ));
            // print_r($with[$key]);
        }
    //  exit;
        
    }

}


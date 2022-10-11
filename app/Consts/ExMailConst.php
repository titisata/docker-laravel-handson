<?php

namespace App\Consts;

class ExMailConst
{


    //ステータス：予約受付
    
    const SUBJECT_1 = "予約受付を承りました ";

    const VIEW_1 = "email.hotel_confirm";
    

    //ステータス：ホテル確定

    const SUBJECT_2 = "宿泊ホテルが確定いたしました ";

    const VIEW_2 = "email.hotel_confirm";
    
    //ステータス：キャンセル連絡済

    const SUBJECT_3 = "予約のキャンセルが確定いたしました ";

    const VIEW_3 = "email.cansel_confirm";
    
    
    
}


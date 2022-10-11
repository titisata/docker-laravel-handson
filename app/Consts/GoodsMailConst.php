<?php

namespace App\Consts;

class GoodsMailConst
{
    //ステータス：予約受付
    
    const SUBJECT_1 = "注文受付を承りました ";

    const VIEW_1 = "email.hotel_confirm";

    //ステータス：注文受付
    
    const SUBJECT_2 = "商品を発送しました";

    const VIEW_2 = "email.goods_send_confirm";
    
    
    //ステータス：キャンセル連絡済

    const SUBJECT_3 = "注文のキャンセルが確定いたしました ";

    const VIEW_3 = "email.goods_cansel";
    
    
    
}


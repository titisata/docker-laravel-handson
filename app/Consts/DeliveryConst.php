<?php

namespace App\Consts;

class DeliveryConst
{

    const DELIVERY_1 = '1';

    const DELIVERY_1_NAME = 'クロネコヤマト';

    const DELIVERY_2 = '2';

    const DELIVERY_2_NAME = '佐川急便';

    const DELIVERY_3 = '3';

    const DELIVERY_3_NAME = '日本郵便';

    const DELIVERY_LIST = [
        self::DELIVERY_1 => self::DELIVERY_1_NAME,
        self::DELIVERY_2 => self::DELIVERY_2_NAME,
        self::DELIVERY_3 => self::DELIVERY_3_NAME,
    ];
    
}


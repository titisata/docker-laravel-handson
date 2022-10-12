<?php

namespace App\Consts;

class OrderConst
{
    const STATUS_RESERVE = '1';

    const STATUS_RESERVE_NAME = '予約中';

    const STATUS_RECEPT = '5';

    const STATUS_RECEPT_NAME = '受付済み';

    const STATUS_HOTEL_ASSIGN = '10';

    const STATUS_HOTEL_ASSIGN_NAME = 'ホテル選定済み';

    const STATUS_GOODS_ASSIGN = '30';

    const STATUS_GOODS_ASSIGN_NAME = '出荷済み';

    const STATUS_CANCEL_RECEPT = '98';

    const STATUS_CANCEL_RECEPT_NAME = 'キャンセル受付';

    const STATUS_CANCEL_CONFIRM = '99';

    const STATUS_CANCEL_CONFIRM_NAME = 'キャンセル連絡済み';


    const LODGING_STATUS_LIST = [
        self::STATUS_RESERVE => self::STATUS_RESERVE_NAME,
        self::STATUS_RECEPT => self::STATUS_RECEPT_NAME,
        self::STATUS_HOTEL_ASSIGN => self::STATUS_HOTEL_ASSIGN_NAME,
        self::STATUS_CANCEL_RECEPT => self::STATUS_CANCEL_RECEPT_NAME,
        self::STATUS_CANCEL_CONFIRM => self::STATUS_CANCEL_CONFIRM_NAME,
    ];

    const STATUS_LIST = [
        self::STATUS_RESERVE => self::STATUS_RESERVE_NAME,
        self::STATUS_RECEPT => self::STATUS_RECEPT_NAME,
        self::STATUS_CANCEL_RECEPT => self::STATUS_CANCEL_RECEPT_NAME,
        self::STATUS_CANCEL_CONFIRM => self::STATUS_CANCEL_CONFIRM_NAME,
    ];

    const LODGING_PARTNER_STATUS_LIST = [
        self::STATUS_RESERVE => self::STATUS_RESERVE_NAME,
        self::STATUS_CANCEL_CONFIRM => self::STATUS_CANCEL_CONFIRM_NAME,
    ];

    const PARTNER_STATUS_LIST = [
        self::STATUS_RESERVE => self::STATUS_RESERVE_NAME,
        self::STATUS_RECEPT => self::STATUS_RECEPT_NAME,
        self::STATUS_CANCEL_CONFIRM => self::STATUS_CANCEL_CONFIRM_NAME,
    ];

    const GOODS_STATUS_LIST = [
        self::STATUS_RESERVE => self::STATUS_RESERVE_NAME,
        self::STATUS_RECEPT => self::STATUS_RECEPT_NAME,
        self::STATUS_GOODS_ASSIGN => self::STATUS_GOODS_ASSIGN_NAME,
        self::STATUS_CANCEL_RECEPT => self::STATUS_CANCEL_RECEPT_NAME,
    ];
}


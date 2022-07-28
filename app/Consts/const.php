<?php

namespace App\Consts;

class RoleConst
{
    public const NAME_TO_ROLEID = [
        'admin' => 1,
        'owner' => 2,
        'partner' => 3,
    ];

    public const ROLEID_TO_DISPLAY = [
        1 => 'システム管理者',
        2 => 'サイトオーナー',
        3 => 'パートナー',
    ];
}

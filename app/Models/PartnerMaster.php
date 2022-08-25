<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_num',
        'reserve_flag',
        'service',
        'regist_num',
        'comment',
        'main_image',
        'site_color',
        'sales_copy',
        'address',
        'phone',
        'access',
    ];
}

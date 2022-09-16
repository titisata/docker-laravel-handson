<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelGroupSelect extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'hotel_group_id',
        'experience_folder_id',
    ];

    /**
     * ホテルグループを取得
     *
     * @return HotelGroup
     */

    public function hotelgroup()
    {
        return $this->belongsTo(HotelGroup::class);
        // return '1111';
    }
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;

class HotelSelect extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'hotel_group_id',
        'hotel_id',
    ];

    /**
     * ホテルを取得
     *
     * @return Hotel
     */

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
        // return '1111';
    }
}

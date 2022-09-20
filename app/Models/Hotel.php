<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'mail',

    ];

    /**
     * hotel_selectを取得
     *
     * @return Collection<HotelSelect>
     */

    public function hotelselcts()
    {
        return $this->hasMany(HotelSelect::class);
    }

}

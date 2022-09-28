<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceReserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'partner_id',
        'experience_id',
        'hotel_group_id',
        'food_group_id',
        'hotel_id',
        'food_id',
        'comment',
        'status',
        'message',
        'quantity_child',
        'quantity_adult',
        'start_date',
        'end_date',
        'cancel_flag',
    ];

    // public function experiencefolder()
    // {
    //     return $this->belongsTo(ExperienceFolder::class);
    // }

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reserved_user()
    {
        return $this->hasMany(User::class);
    }

    //hotelsテーブルと結合
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    //hotel_groupsテーブルと結合
    public function hotelGroup()
    {
        return $this->belongsTo(HotelGroup::class);
    }

    //_groupsテーブルと結合
    public function foodGroup()
    {
        return $this->belongsTo(FoodGroup::class);
    }
    
    public function sum_price()
    {
        $ex = $this->experience;
        $price_adult = $ex->price_adult * $this->quantity_adult;
        $price_child = $ex->price_child * $this->quantity_child;
        $price_adult += ($this->foodGroup?->price_adult ?? 0) * $this->quantity_adult;
        $price_child += ($this->foodGroup?->price_child ?? 0) * $this->quantity_child;
        $price_adult += ($this->hotelGroup?->price_adult ?? 0) * $this->quantity_adult;
        $price_child += ($this->hotelGroup?->price_child ?? 0) * $this->quantity_child;
        return $price_adult + $price_child;
    }
}

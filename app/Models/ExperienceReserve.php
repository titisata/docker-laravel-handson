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
        'contact_info',
        'quantity_child',
        'quantity_adult',
        'experience_price_child',
        'experience_price_adult',
        'hotel_price_child',
        'hotel_price_adult',
        'food_price_child',
        'food_price_adult',
        'total_price',
        'start_date',
        'end_date',
        'cancel_flag',
        'payment_id',
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
        $price_adult = $this->experience_price_adult * $this->quantity_adult;
        $price_child = $this->experience_price_child * $this->quantity_child;
        $price_adult += ($this->food_price_adult ?? 0) * $this->quantity_adult;
        $price_child += ($this->food_price_child ?? 0) * $this->quantity_child;
        $price_adult += ($this->hotel_price_adult ?? 0) * $this->quantity_adult;
        $price_child += ($this->hotel_price_child ?? 0) * $this->quantity_child;
        return $price_adult + $price_child;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceCartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience_id',
        'partner_id',
        'user_id',
        'hotel_group_id',
        'food_group_id',
        'quantity_child',
        'quantity_adult',
        'message',
        'start_date',
        'end_date',
    ];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function hotelGroup()
    {
        return $this->belongsTo(HotelGroup::class);
    }

    public function foodGroup()
    {
        return $this->belongsTo(FoodGroup::class);
    }

    public function contact_info()
    {
        $experience = $this->experience;
        $folder = ExperienceFolder::where('id',$experience->experience_folder_id)->first();
        return $folder->phone;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceReserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
    ];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //hotelsテーブルと結合
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    
}

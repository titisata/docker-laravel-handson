<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience_folder_id',
        'name',
        'price_child',
        'price_adult',
        'sort_no',
        'quantity',
        'status',
        
    ];

    public function folder()
    {
        return $this->belongsTo(ExperienceFolder::class);
    }

    public function reserve_count(string $date)
    {
        $reserve = $this->hasmany(ExperienceReserve::class)->where('start_date', $date)->get();
        return count($reserve);
    }

    /**
     * 予約を取得
     *
     * @return Collection<ExperienceReserve>
     */

    public function ex_reserves()
    {
        $now = now()->format('y-m-d');
        return $this->hasMany(ExperienceReserve::class)->where('start_date', '>=', $now);
    }

    /**
     * 過去予約を取得
     *
     * @return Collection<ExperienceReserve>
     */

    public function ex_reserves_past()
    {
        $now = now()->format('y-m-d');
        return $this->hasMany(ExperienceReserve::class)->where('start_date', '<', $now);
    }
   
}

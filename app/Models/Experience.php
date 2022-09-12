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
}

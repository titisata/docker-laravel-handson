<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_folder_id',
        'name',
        'price',
        'description',
        'sort_no',
        'quantity',
        'status',
        
    ];

    public function folder()
    {
        return $this->belongsTo(ExperienceFolder::class);
    }
}

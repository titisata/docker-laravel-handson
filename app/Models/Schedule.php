<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $dates = [
        'date'
    ];

    protected $fillable = [
        'partner_id',
        'experience_folder_id',
        'date',
        'quantity',
        'is_holiday',
        'title',
        'comment',
    ];
}

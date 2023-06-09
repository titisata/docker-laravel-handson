<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceComment extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'experience_folder_id',
        'content',
        'rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

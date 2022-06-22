<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceFolder extends Model
{
    use HasFactory;

    public function experiences()
    {
        return $this->hasMany('App\Models\Experience');
    }
}

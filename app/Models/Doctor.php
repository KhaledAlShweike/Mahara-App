<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public function Actor_personal_info()
    {
        return $this->belongsTo(Actor_personal_info::class);
    }
}

<?php

namespace App\Models;

use App\Models\Actor_personal_info;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    public function Actor_personal_info()
    {
        return $this->belongsTo(Actor_personal_info::class);
    }
}

<?php

namespace App\Models;

use App\Models\ActorPersonalInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    public function ActorPersonalInfo()
    {
        return $this->belongsTo(ActorPersonalInfo::class);
    }
}

<?php

namespace App\Models;

use App\Models\ActorPersonalInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = ['Rule_type'];


    public function ActorPersonalInfos()
    {
        return $this->belongsTo(ActorPersonalInfo::class);
    }
}

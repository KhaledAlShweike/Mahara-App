<?php

namespace App\Models;

use App\Models\ActorPersonalInfos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = ['Rule_type'];
    protected $table ="Rule";


    public function ActorPersonalInfos()
    {
        return $this->belongsTo(ActorPersonalInfos::class);
    }
}

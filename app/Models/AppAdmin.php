<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppAdmin extends Model
{
    use HasFactory;

    protected $table ='AppAdmins';

    public function ActorPersonalInfos()
    {
        return $this->belongsTo(ActorPersonalInfos::class);
    }
}

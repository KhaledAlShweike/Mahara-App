<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table ='Doctors';

    public function ActorPersonalInfos()
    {
        return $this->belongsTo(ActorPersonalInfos::class);
    }
}

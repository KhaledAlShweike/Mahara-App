<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player_toTeam_matching extends Model
{
    use HasFactory;

    public function Locations()
    {
        return $this->belongsTo(Location::class);
    }
}

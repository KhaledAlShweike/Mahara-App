<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pending_TeamtoTeam_matching extends Model
{
    use HasFactory;
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }
}

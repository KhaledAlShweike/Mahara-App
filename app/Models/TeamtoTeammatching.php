<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamtoTeamMatching extends Model
{
    use HasFactory;
    protected $table ="TeamtoTeamMatchings";

    public function Locations()
    {
        return $this->belongsTo(Location::class);
    }

   
}

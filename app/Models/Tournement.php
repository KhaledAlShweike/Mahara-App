<?php

namespace App\Models;

use App\Models\Club;
use App\Models\Day;
use App\Models\Location;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournement extends Model
{
    use HasFactory;

    public function Clubs()
    {
        return $this->hasMany(Club::class);
    }
    public function Teams()
    {
        return $this->belongsToMany(Team::class);
    }
    public function Days()
    {
        return $this->belongsToMany(Day::class);
    }
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }
}

<?php

namespace App\Models;

use App\Models\Club;
use App\Models\Pending_TeamtoTeam_matching;
use App\Models\Player_toTeam_matching;
use App\Models\Team_to_Team_matching;
use App\Models\Tournement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function Clubs()
    {
        return $this->hasMany(Club::class);
    }
    public function Tournement()
    {
        return $this->hasMany(Tournement::class);
    }
    public function Pending_TeamtoTeam_matching()
    {
        return $this->hasMany(Pending_TeamtoTeam_matching::class);
    }
    public function Player_to_Team_matching()
    {
        return $this->hasMany(Player_toTeam_matching::class);
    }
    public function Team_to_Team_matching()
    {
        return $this->hasMany(Team_to_Team_matching::class);
    }
}

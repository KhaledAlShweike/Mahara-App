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
    public function PendingTeamtoTeamMatching()
    {
        return $this->hasMany(PendingTeamtoTeamMatching::class);
    }
    public function PlayertoTeamMatching()
    {
        return $this->hasMany(PlayertoTeamMatching::class);
    }
    public function TeamtoTeamMatching()
    {
        return $this->hasMany(TeamtoTeamMatching::class);
    }
}

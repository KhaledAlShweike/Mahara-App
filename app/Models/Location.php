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

    protected $fillable = ['name'];


    public function Clubs()
    {
        return $this->hasMany(Club::class);
    }
    public function Tournements()
    {
        return $this->hasMany(Tournement::class);
    }
    public function PendingTeamtoTeamMatchings()
    {
        return $this->hasMany(PendingTeamtoTeamMatching::class);
    }
    public function PlayertoTeamMatchings()
    {
        return $this->hasMany(PlayertoTeamMatching::class);
    }
    public function TeamtoTeamMatchings()
    {
        return $this->hasMany(TeamtoTeamMatching::class);
    }
}

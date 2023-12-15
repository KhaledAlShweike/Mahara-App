<?php

namespace App\Models;

use App\Models\Player;
use App\Models\Tournement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public function Players()
    {
        return $this->belongsToMany(Player::class);
    }
    public function Tournement()
    {
        return $this->belongsToMany(Tournement::class);
    }
}

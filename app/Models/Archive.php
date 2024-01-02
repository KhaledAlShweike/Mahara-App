<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable=['Final_result'];

    public function Reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function Player()
    {
        return $this->belongsToMany(Player::class);
    }
}

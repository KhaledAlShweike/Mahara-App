<?php

namespace App\Models;

use App\Models\Player;
use App\Models\Stadium;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['start_date','end_date'];


    public function Archives()
    {
        return $this->hasOne(Archive::class);
    }
    public function Players()
    {
        return $this->belongsToMany(Player::class);
    }
    public function Stadiums()
    {
        return $this->belongsToMany(Stadium::class);
    }
}

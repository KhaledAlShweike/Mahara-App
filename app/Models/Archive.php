<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable=['Final_result'];
    protected $table ="Archives";

    public function Reservations()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function Players()
    {
        return $this->belongsToMany(Player::class);
    }
}

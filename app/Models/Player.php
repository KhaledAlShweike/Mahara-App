<?php

namespace App\Models;

use App\Models\ActorPersonalInfo;
use App\Models\Archive;
use App\Models\Notification;
use App\Models\Reservation;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function ActorPersonalInfo()
    {
        return $this->belongsTo(ActorPersonalInfo::class);
    }
    
    public function Reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
    public function Archives()
    {
        return $this->belongsToMany(Archive::class);
    }
    public function Teams()
    {
        return $this->belongsToMany(Team::class);
    }
    public function Notifications()
    {
        return $this->belongsToMany(Notification::class);
    }
    public function Images()
    {
        return $this->hasOne(Image::class);
    }
}

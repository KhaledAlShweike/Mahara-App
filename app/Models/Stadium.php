<?php

namespace App\Models;

use App\Models\Club;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    public function Reservation()
    {
        return $this->belongsToMany(Reservation::class);
    }
    public function CLubs()
    {
        return $this->belongsToMany(Club::class);
    }

    public function Image()
    {
        return $this->hasMany(Image::class,'id','price');
    }
}

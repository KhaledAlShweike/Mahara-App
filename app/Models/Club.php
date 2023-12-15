<?php

namespace App\Models;

use App\Models\Sport_type;
use App\Models\Stadium;
use App\Models\Tournement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function Locations()
    {
        return $this->belongsToMany(Location::class);
    }
    public function Stadium()
    {
        return $this->belongsToMany(Stadium::class);
    }
    public function Sport_type()
    {
        return $this->belongsToMany(Sport_type::class);
    }
    public function Tournement()
    {
        return $this->belongsToMany(Tournement::class);
    }
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }
}

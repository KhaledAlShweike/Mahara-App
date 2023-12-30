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

    // Additional details
    protected $fillable = ['name', 'address', 'phone_number'];

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
        return $this->belongsTo(Tournement::class);
    }
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }

    public function Image()
    {
        return $this->hasMany(Image::class,'name','id');
    }
}

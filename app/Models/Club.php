<?php

namespace App\Models;

use App\Models\SportType;
use App\Models\Stadium;
use App\Models\Tournement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    // Additional details
    protected $fillable = ['name', 'address', 'phone_number'];

   
    public function Stadiums()
    {
        return $this->belongsToMany(Stadium::class);
    }
    public function SportTypes()
    {
        return $this->belongsToMany(SportType::class);
    }
    public function Tournements()
    {
        return $this->belongsTo(Tournement::class);
    }
    public function Locations()
    {
        return $this->belongsTo(Location::class);
    }

    public function Image()
    {
        return $this->hasOne(Image::class,'name','id');
    }
}

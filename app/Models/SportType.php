<?php

namespace App\Models;

use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportType extends Model
{
    use HasFactory;

    protected $fillable = ['Sport_type'];

    protected $table ='SportTypes';


    public function Clubs()
    {
        return $this->belongsToMany(Club::class);
    }
    public function Teams()
    {
        return $this->hasMany(Team::class);
    }
}

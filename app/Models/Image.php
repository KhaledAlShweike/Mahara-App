<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'Image_path'];


    public function Clubs()
    {
    return $this->belongsTo(Club::class);
    }

    public function Stadiums()
    {
    return $this->belongsToMany(Stadium::class);
    }

    public function Players()
    {
        return $this->belongsTo(Player::class);
    }
}

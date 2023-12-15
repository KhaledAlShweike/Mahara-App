<?php

namespace App\Models;

use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport_type extends Model
{
    use HasFactory;

    public function Clubs()
    {
        return $this->belongsToMany(Club::class);
    }
}

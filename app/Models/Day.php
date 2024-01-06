<?php

namespace App\Models;

use App\Models\Tournement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table ='Days';

    public function Tournements()
    {
        return $this->belongsToMany(Tournement::class);
    }
}

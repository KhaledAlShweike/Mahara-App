<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_path'];


    public function Club()
    {
    return $this->belongsTo(Club::class);
    }

    public function Stadium()
    {
    return $this->belongsTo(Stadium::class);
    }
}

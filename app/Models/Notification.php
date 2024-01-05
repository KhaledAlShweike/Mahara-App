<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table ="Notifications";

    protected $fillable = ['Type','Title','Content','Expire_date'];


    public function Players()
    {
        return $this->belongsToMany(Player::class);
    }
}

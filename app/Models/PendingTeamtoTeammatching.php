<?php

namespace App\Models;

use App\Models\Location;
use App\Models\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class PendingTeamtoTeamMatching extends Model
{
    use HasFactory;
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }

}

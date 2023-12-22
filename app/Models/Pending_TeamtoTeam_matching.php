<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class Pending_TeamtoTeam_matching extends Model
{
    use HasFactory;
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }


    public function connectTeams(Request $request)
{
    // Validate request and get team matching criteria

    $teamMatching = Pending_TeamtoTeam_matching::create([
        'team_id' => $team->id,
        'location' => $location,
        'preferred_playing_time' => $preferredPlayingTime,
    ]);

    // Implement logic to connect teams based on matching criteria

    return response()->json(['message' => 'Teams connected successfully'], 200);
}
}

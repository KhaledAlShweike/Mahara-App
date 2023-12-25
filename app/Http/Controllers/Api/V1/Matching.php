<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Pending_TeamtoTeam_matching;
use App\Models\Reservation;
use App\Models\Team;
use App\Models\Team_to_Team_matching;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Matching extends Controller
{
    
    public function searchAndMatchTeams(Request $request)
    {
        // Validation 
        $this->validate($request, [
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'location' => 'required|exists:locations,name',
            'sport_type' => 'required|exists:sport_types,name',
        ]);
    
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $team1Id = $request->input('team1_id');
        $team2Id = $request->input('team2_id');
        $location = $request->input('location');
        $sportType = $request->input('sport_type');
    
        // Search for available reservations within the specified time range
        $availableReservations = Reservation::whereDoesntHave('pendingTeamToTeamMatchings', function ($query) use ($startTime, $endTime) {
            $query->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '>=', $startTime)
                    ->orWhere('end_time', '<=', $endTime);
            })->orWhere(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '<=', $startTime)
                    ->where('end_time', '>=', $endTime);
            });
        })->get();
    
        // Perform team matching logic based on available reservations
        foreach ($availableReservations as $reservation) {
            $matchingCriteria = [
                'team1_id' => $team1Id,
                'team2_id' => $team2Id,
                'location' => $location,
                'sport_type' => $sportType,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];
    
            // Check if teams match and add to pending team to team matching
            if ($this->checkTeamsMatch($matchingCriteria)) {
                Pending_TeamtoTeam_matching::create($matchingCriteria);
            }
        }
    
        return response()->json(['message' => 'Search and match completed successfully'], 200);
    }
    
    private function checkTeamsMatch($criteria)
    {
        // Retrieve team information based on criteria
        $team1 = Team::find($criteria['team1_id']);
        $team2 = Team::find($criteria['team2_id']);
    
        // Check if teams exist
        if (!$team1 || !$team2) {
            return false;
        }
    
        // Check if teams have the same location and sport type
        if (
            $team1->location !== $criteria['location'] ||
            $team1->sport_type !== $criteria['sport_type'] ||
            $team2->location !== $criteria['location'] ||
            $team2->sport_type !== $criteria['sport_type']
        ) {
            return false;
        }
    
        return true; // Teams are considered a match
    }
}


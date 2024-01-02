<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PendingTeamtoTeamMatching;
use App\Models\Reservation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamtoTeamMatching extends Controller
{
    public function TeamtoTeamMatching(Request $request)
    {
        // Validation 
        $this->validate($request, [
            'start_time' => 'date_format:Y-m-d H:i:s',
            'end_time' => 'date_format:Y-m-d H:i:s|after:start_time',
            'Team1_id' => 'required|exists:Teams,id',
            'Team2_id' => 'required|exists:Teams,id|different:Team1_id',
            'Location' => 'required|exists:Locations,name',
            'SportType' => 'required|exists:SportTypes,name',
        ]);

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $Team1Id = $request->input('Team1_id');
        $Team2Id = $request->input('Team2_id');
        $Location = $request->input('Location');
        $sportType = $request->input('SportType');

        // Search for available Reservations within the specified time range
        $availableReservations = Reservation::where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '>=', $startTime)
                    ->orWhere('end_time', '<=', $endTime);
            })->orWhere(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '<=', $startTime)
                    ->where('end_time', '>=', $endTime);
            });
        })->doesntHave('Pending_TeamtoTeam_matchings')->doesntHave('Team_to_Team_matching')->get();

        // Perform Team matching logic based on available Reservations
        foreach ($availableReservations as $Reservation) {
            $matchingCriteria = [
                'Team1_id' => $Team1Id,
                'Team2_id' => $Team2Id,
                'Location' => $Location,
                'SportType' => $sportType,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];

            // Check if Teams match and add to pending Team to Team matching
            if ($this->checkTeamsMatch($matchingCriteria)) {
                $pendingMatching = PendingTeamtoTeamMatching::create($matchingCriteria);

                return response()->json([
                    'message' => 'Matching process created successfully',
                    'Teams' => [
                        'Team1_id' => $matchingCriteria['Team1_id'],
                        'Team2_id' => $matchingCriteria['Team2_id'],
                    ],
                    'Reservation' => [
                        'start_time' => $Reservation->start_time,
                        'end_time' => $Reservation->end_time,
                        'Club_id' => $Reservation->Club_id,
                        'name' => $Reservation->Club_name,
                        'address' => $Reservation->address,
                        'Stadium_id' => $Reservation->Stadium_id,
                        'SportType' => $Reservation->SportType,
                    ],
                    'pending_matching_id' => $pendingMatching->id,
                ], 200);
            }
        }

        return response()->json(['message' => 'No matching process created'], 404);
    }

    private function checkTeamsMatch($criteria)
    {
        // Retrieve Team information based on criteria
        $Team1 = Team::find($criteria['Team1_id']);
        $Team2 = Team::find($criteria['Team2_id']);

        // Check if Teams exist
        if (!$Team1 || !$Team2) {
            return false;
        }

        // Check if Teams have the same Location and sport type
        return (
            $Team1->Location === $criteria['Location'] &&
            $Team1->SportType === $criteria['SportType'] &&
            $Team2->Location === $criteria['Location'] &&
            $Team2->SportType === $criteria['SportType']
        );
    }
}

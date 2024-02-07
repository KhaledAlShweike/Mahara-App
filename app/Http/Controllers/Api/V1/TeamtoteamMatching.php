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
            'date' => 'date_format:Y-m-d H:i:s',
            'slot' => 'required|integer',
            'stadium_id' => 'required|exists:Stadiums|integer',
            'Team1_id' => 'required|exists:Teams,id',
            'Team2_id' => 'required|exists:Teams,id|different:Team1_id',
            'status' => 'required|integer',
            'SportType' => 'required|exists:SportTypes,name',
        ]);

        $Date = $request->input('date');
        $Slot = $request->input('slot');
        $Stadiumid = $request->input('stadium_id');
        $Team1Id = $request->input('Team1_id');
        $Team2Id = $request->input('Team2_id');
        $Status = $request->input('status');
        $sportType = $request->input('SportType');

        // Search for available Reservations within the specified time range
        $availableReservations = Reservation::where(function ($query) use ($Date) {
            
        })->doesntHave('Pending_TeamtoTeam_matchings')->doesntHave('Team_to_Team_matching')->get();

        // Perform Team matching logic based on available Reservations
        foreach ($availableReservations as $Reservation) {
            $matchingCriteria = [
                'Team1_id' => $Team1Id,
                'Team2_id' => $Team2Id,
                'slot' => $Slot,
                'SportType' => $sportType,
                'date' => $Date,
                'stadium_id'=>$Stadiumid,
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
                        'Club_id' => $Reservation->Stadiums->Clubs->id,
                        'name' => $Reservation->Stadiums->Clubs->name,
                        'address' => $Reservation->Stadium->Clubs->Locations,
                        'Stadium_id' => $Reservation->Stadiums->id,
                        'SportType' => $Reservation->Stadiums->Clubs->SportTypes->Sport_Type,
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

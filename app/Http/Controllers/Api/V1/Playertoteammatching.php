<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Pending_TeamtoPlayer_matching;
use App\Models\PendingTeamtoPlayermatching;
use App\Models\Reservation;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class TeamtoPlayer_Matching extends Controller
{

    public function TeamtoPlayerMatching(Request $request)
    {
        $this->validate($request, [
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'Team_id' => 'required|exists:Teams,id',
            'Player_id' => 'required|exists:Players,id',
            'Location' => 'required|exists:Locations,name',
            'SportType' => 'required|exists:SportTypes,name',
        ]);

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $TeamId = $request->input('Team_id');
        $PlayerId = $request->input('Player_id');
        $Location = $request->input('Location');
        $sportType = $request->input('SportType');

        $availableReservations = Reservation::where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '>=', $startTime)
                    ->orWhere('end_time', '<=', $endTime);
            })->orWhere(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '<=', $startTime)
                    ->where('end_time', '>=', $endTime);
            });
        })->doesntHave('Pending_TeamtoPlayer_matching')->doesntHave('PlayertoTeammatching')->get();

        foreach ($availableReservations as $Reservation) {
            $matchingCriteria = [
                'Team1_id' => $TeamId,
                'Player_id' => $PlayerId,
                'Location' => $Location,
                'SportType' => $sportType,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];

            // Check if they match and add to pending tema to Player matching
            if ($this->checkTOPMatch($matchingCriteria)) {
                $pendingMatching = PendingTeamtoPlayermatching::create($matchingCriteria);

                return response()->json([
                    'message' => 'Matching process created successfully',
                    'Teams' => [
                        'Team_id' => $matchingCriteria['Team_id'],
                        'Player_id' => $matchingCriteria['Player-id'],
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



    private function checkTOPMatch($criteria)
    {
        // Retrieve Team and Player information based on criteria
        $Team = Team::find($criteria['Team_id']);
        $Player = Player::find($criteria['Player_id']);

        // Check if Teams exist
        if (!$Team || !$Player) {
            return false;
        }

        // Check if they have the same Location and sport type
        return (
            $Team->Location === $criteria['Location'] &&
            $Team->SportType === $criteria['SportType'] &&
            $Player->Location === $criteria['Location'] &&
            $Player->SportType === $criteria['SportType']
        );
    }
}

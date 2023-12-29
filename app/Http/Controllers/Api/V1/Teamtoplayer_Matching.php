<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Pending_TeamtoPlayer_matching;
use App\Models\Reservation;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class Teamtoplayer_Matching extends Controller
{

    public function Teamtoplayer_Matching(Request $request)
    {
        $this->validate($request, [
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'team_id' => 'required|exists:teams,id',
            'player_id' => 'required|exists:players,id',
            'location' => 'required|exists:locations,name',
            'sport_type' => 'required|exists:sport_types,name',
        ]);

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $teamid = $request->input('team_id');
        $playerid = $request->input('player_id');
        $location = $request->input('location');
        $sporttype = $request->input('sport_type');


        $availableReservations = Reservation::where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '>=', $startTime)
                    ->orWhere('end_time', '<=', $endTime);
            })->orWhere(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '<=', $startTime)
                    ->where('end_time', '>=', $endTime);
            });
        })->doesntHave('Pending_TeamtoPlayer_matching')->doesntHave('Team_toPlayer_matching')->get();

        foreach ($availableReservations as $reservation) {
            $matchingCriteria = [
                'team1_id' => $teamid,
                'player_id' => $playerid,
                'location' => $location,
                'sport_type' => $sporttype,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];

            // Check if teams match and add to pending team to team matching
            if ($this->checkTOPMatch($matchingCriteria)) {
                $pendingMatching = Pending_TeamtoPlayer_matching::create($matchingCriteria);

                return response()->json([
                    'message' => 'Matching process created successfully',
                    'teams' => [
                        'team1_id' => $matchingCriteria['team1_id'],
                        'team2_id' => $matchingCriteria['team2_id'],
                    ],
                    'reservation' => [
                        'start_time' => $reservation->start_time,
                        'end_time' => $reservation->end_time,
                        'club_id' => $reservation->club_id,
                        'name' => $reservation->club_name,
                        'address' => $reservation->address,
                        'stadium_id' => $reservation->stadium_id,
                        'sport_type' => $reservation->sport_type,
                    ],
                    'pending_matching_id' => $pendingMatching->id,
                ], 200);
            }
        }

        return response()->json(['message' => 'No matching process created'], 404);
    }



    private function checkTOPMatch($criteria)
    {
        // Retrieve team and player information based on criteria
        $team = Team::find($criteria['team_id']);
        $player = Player::find($criteria['player_id']);

        // Check if teams exist
        if (!$team || !$player) {
            return false;
        }

        // Check if they have the same location and sport type
        return (
            $team->location === $criteria['location'] &&
            $team->sport_type === $criteria['sport_type'] &&
            $player->location === $criteria['location'] &&
            $player->sport_type === $criteria['sport_type']
        );
    }
}

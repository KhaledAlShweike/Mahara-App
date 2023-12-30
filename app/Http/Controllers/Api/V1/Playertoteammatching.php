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

    public function TeamtoplayerMatching(Request $request)
    {
        $this->validateRequest($request);

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $teamId = $request->input('team_id');
        $playerId = $request->input('player_id');
        $location = $request->input('location');
        $sportType = $request->input('sport_type');

        $availableReservations = Reservation::where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '>=', $startTime)
                    ->orWhere('end_time', '<=', $endTime);
            })->orWhere(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '<=', $startTime)
                    ->where('end_time', '>=', $endTime);
            });
        })->doesntHave('Pending_teamtoplayer_matching')->doesntHave('PlayertoTeammatching')->get();

        foreach ($availableReservations as $reservation) {
            $matchingCriteria = [
                'team1_id' => $teamId,
                'player_id' => $playerId,
                'location' => $location,
                'sport_type' => $sportType,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];

            // Check if they match and add to pending tema to player matching
            if ($this->checkTOPMatch($matchingCriteria)) {
                $pendingMatching = Pending_TeamtoPlayer_matching::create($matchingCriteria);

                return response()->json([
                    'message' => 'Matching process created successfully',
                    'teams' => [
                        'team_id' => $matchingCriteria['team_id'],
                        'player_id' => $matchingCriteria['player-id'],
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

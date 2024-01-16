<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;

class TeamManagement extends Controller
{
    public function removePlayer(Request $request, Team $team, Player $player)
    {
        if ($team->players()->where('id', $player->id)->exists()) {
            $team->players()->detach($player->id);

            return response()->json([
                'message' => 'Player removed from the team successfully.'
            ]);
        } else {
            return response()->json([
                'message' => 'Player not found in the team.'
            ], 404);
        }
    }


    /*---------------------------*/

    public function AcceptPlayer(Request $request, Team $team, Player $player)
    {
   
        $playerId = $request->input('player_id');

        try {
            $player = Player::findOrFail($playerId);

            $player->team_id = $team->id;
            $player->save();

            return response()->json(['status' => 0, 'message' => 'Player accepted to the team.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 1, 'message' => 'Failed to accept player to the team.', 'error' => $e->getMessage()]);
        }
    }


    /*------------------------------*/


    public function MakeCaptin(Team $team, Player $player)
    {
        Player::where('team_id', $team->id)->update(['is_captain' => false]);

        $player->is_captain = true;
        $player->save();

        return response()->json(['message' => 'Player is now the captain of the team.']);
    }


    /*-------------------------------- */


    public function RemoveCaptin(Team $team, Player $player)
    {
        try {
            $player->is_captain = false;
            $player->save();
    
            return response()->json(['status' => 0, 'message' => 'Player is no longer the captain of the team.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 1, 'message' => 'Failed to update captain status.', 'error' => $e->getMessage()]);
        }
    }




    /*------------------------------------*/

    public function joinTeam(Request $request, Team $team, Player $player)
    {
        try {
            // Assuming you have the player_id in the request
            $playerId = $request->input('player_id');
            $player = Player::findOrFail($playerId);

            // Check if the player is already part of a team
            if ($player->team_id) {
                return response()->json(['status' => 1, 'message' => 'Player is already part of a team.']);
            }

            // Join the team
            $player->team_id = $team->id;
            $player->save();

            return response()->json(['status' => 0, 'message' => 'Player joined the team successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 1, 'message' => 'Failed to join the team.', 'error' => $e->getMessage()]);
        }
    }


    /*------------------------------------*/


    public function exitTeam(Request $request, Player $player)
    {
        try {
            // Assuming you have the player_id in the request
            $playerId = $request->input('player_id');
            $player = Player::findOrFail($playerId);

            // Check if the player is not part of any team
            if (!$player->team_id) {
                return response()->json(['status' => 1, 'message' => 'Player is not part of any team.']);
            }

            // Exit the team
            $player->team_id = null;
            $player->save();

            return response()->json(['status' => 0, 'message' => 'Player exited the team successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 1, 'message' => 'Failed to exit the team.', 'error' => $e->getMessage()]);
        }
    }


}

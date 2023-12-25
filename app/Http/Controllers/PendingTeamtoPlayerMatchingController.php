<?php

namespace App\Http\Controllers;

use App\Models\Pending_TeamtoPlayer_matching;
use App\Models\Pending_TeamtoTeam_matching;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PendingTeamtoPlayerMatchingController extends Controller
{


    public function connectTeam_to_player()
    {
        // Your logic to find matching teams based on criteria
        $matchingTeams = \Illuminate\Support\Facades\DB::table('pending__teamto_player_matchings')
            ->select('team_id', 'player_id')
            ->where('status', false) // Assuming false means the match is not yet connected
            ->orderBy('created_at', 'asc') // Oldest first
            ->first();

        if (!$matchingTeams) {
            return response()->json(['message' => 'No matching teams found'], 404);
        }

        // Your logic to connect teams and update status
        $teamId = $matchingTeams->team_one_id;
        $playerid = $matchingTeams->player_id;

        // Update the status or perform any other actions as needed
        Pending_TeamtoTeam_matching::where('team_one_id', $teamId)
            ->where('team_two_id', $playerid)
            ->update(['status' => true]);

        return response()->json([
            'message' => 'player connected with the team for the match',
            'team_one_id' => $teamId,
            'player_id' => $playerid,
        ], 200);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pending_TeamtoPlayer_matching $pending_TeamtoPlayer_matching)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pending_TeamtoPlayer_matching $pending_TeamtoPlayer_matching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pending_TeamtoPlayer_matching $pending_TeamtoPlayer_matching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pending_TeamtoPlayer_matching $pending_TeamtoPlayer_matching)
    {
        //
    }
}

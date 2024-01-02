<?php

namespace App\Http\Controllers;

use App\Models\Pending_TeamtoPlayer_matching;
use App\Models\Pending_TeamtoTeam_matching;
use App\Models\PendingTeamtoPlayermatching;
use App\Models\PendingTeamtoTeamMatching;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PendingTeamtoPlayerMatchingController extends Controller
{


    public function connectTeam_to_Player()
    {
        // Your logic to find matching Teams based on criteria
        $matchingTeams = \Illuminate\Support\Facades\DB::table('PendingTeamtoPlayerMatchings')
            ->select('Team_id', 'Player_id')
            ->where('status', false) // Assuming false means the match is not yet connected
            ->orderBy('created_at', 'asc') // Oldest first
            ->first();

        if (!$matchingTeams) {
            return response()->json(['message' => 'No matching Teams found'], 404);
        }

        // Your logic to connect Teams and update status
        $TeamId = $matchingTeams->Team_one_id;
        $Playerid = $matchingTeams->Player_id;

        // Update the status or perform any other actions as needed
        PendingTeamtoTeamMatching::where('Team_one_id', $TeamId)
            ->where('Team_two_id', $Playerid)
            ->update(['status' => true]);

        return response()->json([
            'message' => 'Player connected with the Team for the match',
            'Team_one_id' => $TeamId,
            'Player_id' => $Playerid,
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
    public function show(PendingTeamtoPlayermatching $PendingTeamtoPlayerMatching)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendingTeamtoPlayerMatching $PendingTeamtoPlayerMatching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendingTeamtoPlayerMatching $PendingTeamtoPlayerMatching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendingTeamtoPlayerMatching $PendingTeamtoPlayerMatching)
    {
        //
    }
}

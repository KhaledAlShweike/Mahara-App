<?php

namespace App\Http\Controllers;

use App\Models\Player_toTeam_matching;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PlayerToTeamMatchingController extends Controller
{


    public function getPlayertoTeammatching(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required|exists:locations,name',
        ]);

        $locationName = $request->input('location_name');
        $Playertoteam = Player_toTeam_matching::where('location_name', $locationName)->get();

        if ($Playertoteam->isEmpty()) {
            return response()->json(['message' => 'No matching found in this location'], 404);
        }

        return response()->json(['player to team matchs' => $Playertoteam], 200);
    }

    
    
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
    public function show(Player_toTeam_matching $player_toTeam_matching)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player_toTeam_matching $player_toTeam_matching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player_toTeam_matching $player_toTeam_matching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player_toTeam_matching $player_toTeam_matching)
    {
        //
    }
}

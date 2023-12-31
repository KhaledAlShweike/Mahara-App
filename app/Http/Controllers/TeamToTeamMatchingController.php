<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\TeamToTeamMatching;
use App\Models\Pending_TeamtoTeam_matching;
use App\Models\Team;
use App\Models\Team_to_Team_matching;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamToTeamMatchingController extends Controller
{

    public function getTeamtoTeammatching(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required|exists:locations,name',
        ]);

        $locationName = $request->input('location_name');
        $Teamtoteam = Team_to_Team_matching::where('location_name', $locationName)->get();

        if ($Teamtoteam->isEmpty()) {
            return response()->json(['message' => 'No matching found in this location'], 404);
        }

        return response()->json(['Team to team matchs' => $Teamtoteam], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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
    public function show(Team_to_Team_matching $team_to_Team_matching)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team_to_Team_matching $team_to_Team_matching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team_to_Team_matching $team_to_Team_matching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team_to_Team_matching $team_to_Team_matching)
    {
        //
    }
}

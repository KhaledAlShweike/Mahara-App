<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\TeamtoTeamMatching;
use App\Models\Pending_TeamtoTeam_matching;
use App\Models\Team;
use App\Models\Team_to_Team_matching;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamtoTeamMatchingController extends Controller
{

    public function getTeamtoTeamMatching(Request $request)
    {
        $this->validate($request, [
            'Location_name' => 'required|exists:Locations,name',
        ]);

        $LocationName = $request->input('Location_name');
        $TeamtoTeam = Team_to_Team_matching::where('Location_name', $LocationName)->get();

        if ($TeamtoTeam->isEmpty()) {
            return response()->json(['message' => 'No matching found in this Location'], 404);
        }

        return response()->json(['Team to Team matchs' => $TeamtoTeam], 200);
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
    public function show(Team_to_Team_matching $Team_to_Team_matching)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team_to_Team_matching $Team_to_Team_matching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team_to_Team_matching $Team_to_Team_matching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team_to_Team_matching $Team_to_Team_matching)
    {
        //
    }
}

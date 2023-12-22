<?php

namespace App\Http\Controllers;

use App\Models\Team_to_Team_matching;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamToTeamMatchingController extends Controller
{
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
    public function create(Request $request)
    {
        $this->validate($request, [
            'team_id' => 'required|exists:teams,id',
            // Add other validation rules based on your criteria
        ]);

        // Check if a matching already exists for the given team
        $existingMatching = Team_To_Team_matching::where('team_id', $request->input('team_id'))->first();

        if ($existingMatching) {
            return response()->json(['message' => 'Matching already exists for the team'], 422);
        }

        $teamMatching = Team_To_Team_matching::create([
            'team_id' => $request->input('team_id'),
            // Add other fields based on your criteria
        ]);

        // Implement additional logic as needed

        return response()->json(['message' => 'Team matching created successfully'], 200);
    }

     public function listTeamConnections()
    {
        $teamConnections = Team_To_Team_matching::orderBy('created_at', 'asc')->get();

        return response()->json(['team_connections' => $teamConnections], 200);
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

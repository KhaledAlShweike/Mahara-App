<?php

namespace App\Http\Controllers;

use App\Models\Pending_TeamtoTeam_matching;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PendingTeamtoTeamMatchingController extends Controller
{


    public function connectTeams(Request $request)
    {
        $this->validate($request, [
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            // Add other validation rules based on your criteria
        ]);

        // Check if a connection already exists between the teams
        $existingConnection = Pending_TeamtoTeam_matching::where(function ($query) use ($request) {
            $query->where('team1_id', $request->input('team1_id'))
                ->where('team2_id', $request->input('team2_id'));
        })->orWhere(function ($query) use ($request) {
            $query->where('team1_id', $request->input('team2_id'))
                ->where('team2_id', $request->input('team1_id'));
        })->first();

        if ($existingConnection) {
            return response()->json(['message' => 'Connection already exists between the teams'], 422);
        }

        $teamConnection = Pending_TeamtoTeam_matching::create([
            'team1_id' => $request->input('team1_id'),
            'team2_id' => $request->input('team2_id'),
            // Add other fields based on your criteria
        ]);

        // Implement additional logic as needed

        return response()->json(['message' => 'Teams connected successfully'], 200);
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
    public function show(Pending_TeamtoTeam_matching $pending_TeamtoTeam_matching)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pending_TeamtoTeam_matching $pending_TeamtoTeam_matching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pending_TeamtoTeam_matching $pending_TeamtoTeam_matching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pending_TeamtoTeam_matching $pending_TeamtoTeam_matching)
    {
        //
    }
}

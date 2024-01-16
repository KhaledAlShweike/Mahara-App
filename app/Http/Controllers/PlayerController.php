<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function getPlayerMatchings($teamId, $playerId)
    {
        $teamToTeamMatchings = DB::table('teamtoteammatchings')
            ->join('teams', 'teamtoteammatchings.opponent_team_id', '=', 'teams.id')
            ->select('teamtoteammatchings.*', 'teams.name as opponent_team_name')
            ->where('teamtoteammatchings.team_id', $teamId)
            ->get();

        $teamToPlayerMatchings = DB::table('teamtoplayermatchings')
            ->join('players', 'team_to_player_matchings.player_id', '=', 'players.id')
            ->select('teamtoplayermatchings.*', 'players.name as player_name')
            ->where('teamtoplayermatchings.team_id', $teamId)
            ->where('teamtoplayermatchings.player_id', $playerId)
            ->get();

        $playerToTeamMatchings = DB::table('playertoteammatchings')
            ->join('teams', 'playertoteammatchings.team_id', '=', 'teams.id')
            ->select('playertoteammatchings.*', 'teams.name as team_name')
            ->where('playertoteammatchings.player_id', $playerId)
            ->get();

        return response()->json([
            'team_to_team_matchings' => $teamToTeamMatchings,
            'team_to_player_matchings' => $teamToPlayerMatchings,
            'player_to_team_matchings' => $playerToTeamMatchings,
        ]);
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
    public function show(Player $Player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $Player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $Player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $Player)
    {
        //
    }
}

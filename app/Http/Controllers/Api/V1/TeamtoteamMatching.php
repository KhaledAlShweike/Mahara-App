<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class TeamToTeamMatchingController extends Controller
{
    public function createOrUpdateMatching(Request $request)
    {   $dataInput = $request->json()->all();
        $request->validate([
            'team_id' => 'required|integer',
            'date' => 'required|date',
            'slot' => 'required|string',
            'stadium_id' => 'required|integer',
        ]);

        $teamId = $dataInput['team_id'];
        $date = $dataInput['date'];
        $slot = $dataInput['slot'];
        $stadiumId = $dataInput['stadium_id'];

        $reservationExists = DB::table('reservations')
            ->where('date', $date)
            ->where('slot', $slot)
            ->where('stadium_id', $stadiumId)
            ->exists();

        if ($reservationExists) {
            return response()->json(['status' => false, 'error' => 'This time is reserved']);
        }

        $matchingId = DB::table('teamtoteammatchings')
            ->where('date', $date)
            ->where('slot', $slot)
            ->where('stadium_id', $stadiumId)
            ->value('id');

        if ($matchingId) {
            $matchingTeams = DB::table('teamtoteammatchings')
                ->where('id', $matchingId)
                ->first();

            if ($matchingTeams->Team1_id === null && $matchingTeams->Team2_id !== $teamId) {
                DB::table('teamtoteammatchings')
                    ->where('id', $matchingId)
                    ->update(['Team1_id' => $teamId]);

                return response()->json(['status' => true]);
            } elseif ($matchingTeams->Team2_id === null && $matchingTeams->Team1_id !== $teamId) {
                DB::table('teamtoteammatchings')
                    ->where('id', $matchingId)
                    ->update(['Team2_id' => $teamId]);

                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'error' => 'This time is not available']);
            }
        } else {
            DB::table('teamtoteammatchings')
                ->insert([
                    'date' => $date,
                    'slot' => $slot,
                    'stadium_id' => $stadiumId,
                    'Team1_id' => $teamId,
                ]);

            return response()->json(['status' => true]);
        }
    }
}
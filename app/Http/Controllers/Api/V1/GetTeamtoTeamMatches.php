<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\TeamMatch;
use App\Models\TeamtoTeamMatching;
use Illuminate\Routing\Controller;

class GetTeamtoTeamMatches extends Controller
{
    public function GetTeamtoTeamMatches(Request $request)
    {
        $request->validate([
            'SportType' => 'required|string',
            'Location' => 'required|string|exists:Location',
            'name' => 'nullable|string|exists:Clubs',
            'dateTime' => 'nullable|date',
        ]);

        $query = TeamtoTeamMatching::query();

        if ($request->filled('SportType')) {
            $query->orWhere('SportType', $request->input('SportType'));
        }

        if ($request->filled('Location')) {
            $query->orWhere('Location', $request->input('Location'));
        }

        if ($request->filled('name')) {
            $query->orWhere('name', $request->input('name'));
        }

        if ($request->filled('dateTime')) {
            $query->orWhere('dateTime', $request->input('dateTime'));
        }

        $teamMatches = $query->get();

        if($teamMatches==Null)
        {         return response()->json(['status'=> 1 ,'message' => 'No Matches found']);
        }
        return response()->json(['status'=> 0 ,'data' => $teamMatches]);
    }
}

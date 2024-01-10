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
            'sport' => 'nullable|string',
            'city' => 'nullable|string',
            'club' => 'nullable|string',
            'dateTime' => 'nullable|date',
        ]);

        $query = TeamtoTeamMatching::query();

        if ($request->filled('sport')) {
            $query->orWhere('sport', $request->input('sport'));
        }

        if ($request->filled('city')) {
            $query->orWhere('city', $request->input('city'));
        }

        if ($request->filled('club')) {
            $query->orWhere('club', $request->input('club'));
        }

        if ($request->filled('dateTime')) {
            $query->orWhere('dateTime', $request->input('dateTime'));
        }

        $teamMatches = $query->get();

        return response()->json(['data' => $teamMatches]);
    }
}

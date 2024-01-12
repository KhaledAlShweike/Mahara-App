<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TeamtoPlayermatching;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;


class GetTeamtoPlayerMatches extends Controller
{
    public function GetTeamtoPlayerMatches(Request $request)
    {

        $request->validate([
            'SportType' => 'required|string|exists:SportType,name',
            'Location' => 'required|string|exists:Location,name',
            'Position' => 'nullabe|string|exists:Position,name',
            'name' => 'nullabe|string|exists:Club,name',
            'dateTime' => 'nullable|date',
        ]);

        $query = TeamtoPlayermatching::query();

        if ($request->filled('SportType')) {
            $query->orWhere('SportType', $request->input('SportType'));
        }

        if ($request->filled('Location')) {
            $query->orWhere('Location', $request->input('Location'));
        }

        if ($request->filled('Position')) {
            $query->orWhere('Position', $request->input('Position'));
        }

        if ($request->filled('name')) {
            $query->orWhere('name', $request->input('name'));
        }

        if ($request->filled('dateTime')) {
            $query->orWhere('dateTime', $request->input('dateTime'));
        }

        $teamtoPlayermatches = $query->get();

        if ($teamtoPlayermatches == Null) {
            return response()->json(['status' => 1, 'message' => 'No Matches found']);
        }
        return response()->json(['status' => 0, 'data' => $teamtoPlayermatches]);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Stadium;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class GetTopReservedStadiums extends Controller
{
    public function getTopReservedStadiums()
    {
        // Retrieve the top 10 reserved stadiums
        $topStadiums = Stadium::select('stadiums.*', DB::raw('COUNT(reservations.id) as reservation_count'))
            ->leftJoin('reservations', 'stadiums.id', '=', 'reservations.stadium_id')
            ->groupBy('stadiums.id')
            ->orderByDesc('reservation_count')
            ->take(10)
            ->get();

            if ($topStadiums->isEmpty()) {
                return response()->json(['status' => 1, 'message' => 'No top reserved stadiums found.'], 404);
            }

        // Return the top reserved stadiums in the response
        return response()->json(['status' => 0, 'top_stadiums' => $topStadiums]);
    }
}

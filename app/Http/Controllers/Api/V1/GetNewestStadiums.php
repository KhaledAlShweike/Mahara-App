<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class GetNewestStadiums extends Controller
{
    public function GetNewestStadiums(Request $request)
    {
        $topStadiums = Stadium::orderBy('created_at', 'desc')->take(10)->get();
       
        return response()->json([
            'message' => 'Top 10 stadiums by creation date',
            'data' => $topStadiums,
        ]);
    }
}

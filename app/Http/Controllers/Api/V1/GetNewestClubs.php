<?php 

namespace App\Http\Controllers\Api\V1;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GetNewestClubs extends Controller
{
    public function GetNewestClubs(Request $request)
    {
        $topClubs = Club::orderBy('created_at', 'desc')->take(10)->get();
       
        return response()->json([
            'message' => 'Top 10 stadiums by creation date',
            'data' => $topClubs,
        ]);
    }
}
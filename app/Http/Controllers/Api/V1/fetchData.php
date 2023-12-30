<?php 

namespace App\Http\Controllers\Api\V1;

use Auth;
use Illuminate\Routing\Controller;

class fetchData extends Controller
{
    
    public function getUser() {
        $user = \Illuminate\Support\Facades\Auth::user();
        return response()->json($user);
        }
}
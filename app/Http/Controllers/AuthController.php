<?php

namespace App\Http\Controllers;

use App\Models\Actor_personal_info;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginPlayer(Request $request)
    {
    }

    public function loginClubManager(Request $request)
    {
    }


    public function signupPlayer(Request $request)
    {
    }
}

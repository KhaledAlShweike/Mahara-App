<?php

namespace App\Http\Controllers;

use App\Models\ActorPersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:14',
            'email' => 'required|email|unique:players|max:255',
            'password' => 'required|string|min:8',
            'locations' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'b_date' => 'required|date_format:Y-m-d',
        ]);

        $user = new ActorPersonalInfo();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->phone_number = $request['phone_number'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->Location = $request['Location'];
        $user->Rule = $request['Rule'];
        $user->gender = $request['gender'];
        $user->b_date = $request['b_date'];
        // Set a default value of 0 for 'status' when registering
        $user->status = 1;

        $user->save();

        return response()->json("success", 200);
    }



    public function login(Request $request)
    {
        $credentials = $request->only('phone_number', 'password');

        $user = ActorPersonalInfo::where('phone_number', $credentials['phone_number'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Set 'status' to 1 when the user is signed in
        $user->status = 1;
        $user->save();
        
    if (Auth::attempt($credentials)) {
        // Authentication passed
        $user = Auth::ActorPersonalInfo();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['message' => 'Login successful', 'user' => $user, 'access_token' => $token], 200);
    } else {
        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    }
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }




    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh(JWTAuth::getToken()));
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}

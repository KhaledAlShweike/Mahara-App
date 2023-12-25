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
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

   
        public function __construct()
        {
            $this->middleware('auth:api', ['except' => ['login','register']]);
        }
    
    
        function register(Request $req){
            $data = $req->all();
            // if($data["utype"]==1){
            $user = new Actor_personal_info();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->phone_number=$data['phone_number'];
            $user->email= $data['email'];
            $user->password= Hash::make($data['password']);
            $user->location=$data['location'];
            $user->Rule = $data['Rule'];
            $user->gender=$data['gender'];
            $user->b_date = $data['b_date'];
            // Set a default value of 0 for 'status' when registering
            $user->status = 0;
    
            $user->save();
    
            return response()->json("success", 200);
        }
    
    
    
        public function login(Request $request)
        {
            $credentials = $request->only('phone_number', 'password');
    
            $user = Actor_personal_info::where('phone_number', $credentials['phone_number'])->first();
    
            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            // Set 'status' to 1 when the user is signed in
            $user->status = 1;
            $user->save();
            $token = JWTAuth::attempt($credentials);
            return $this->respondWithToken($token);
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


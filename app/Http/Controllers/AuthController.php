<?php

namespace App\Http\Controllers;


use App\Models\Actor_personal_info;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   // Player Login
   public function playerLogin(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'phone_number' => 'required|numeric',
           'password' => 'required',
           'Rule' => 'required|in:Player',
       ]);

       if ($validator->fails()) {
           return response()->json(['error' => $validator->errors()], 400);
       }

       $credentials = $request->only('phone_number', 'password', 'Rule');

       if (Auth::attempt($credentials)) {
           $user = Auth::user();
           $token = JWTAuth::fromUser($user);

           return response()->json(['user' => $user, 'access_token' => $token]);
       } else {
           return response()->json(['error' => 'Invalid credentials'], 401);
       }
   }

   // Club Manager Login
   public function clubManagerLogin(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'code' => 'required',
           'password' => 'required',
           'Rule' => 'required|in:club_manager',
       ]);

       if ($validator->fails()) {
           return response()->json(['error' => $validator->errors()], 400);
       }

       $credentials = $request->only('code', 'password', 'Rule');

       if (Auth::attempt($credentials)) {
           $user = Auth::user();
           $token = JWTAuth::fromUser($user);

           return response()->json(['user' => $user, 'access_token' => $token]);
       } else {
           return response()->json(['error' => 'Invalid credentials'], 401);
       }
   }

   // Player Signup
   public function playerSignup(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'first_name' => 'required',
           'last_name' => 'required',
           'Rule' => 'required|in:Player',
           'phone_number' => 'required|numeric|unique:actor_personal_infos',
           'email' => 'required|email|unique:actor_personal_infos',
           'password' => 'required|min:6',
       ]);

       if ($validator->fails()) {
           return response()->json(['error' => $validator->errors()], 400);
       }

       $user = Actor_personal_info::create([
           'first_name' => $request->input('first_name'),
           'last_name' => $request->input('last_name'),
           'Rule' => $request->input('Rule'),
           'phone_number' => $request->input('phone_number'),
           'email' => $request->input('email'),
           'password' => bcrypt($request->input('password')),
       ]);

       $token = JWTAuth::fromUser($user);

       return response()->json(['user' => $user, 'access_token' => $token]);


   }

   //////////////////////

   

   // Logout
   public function logout(Request $request)
   {
       Auth::logout();

       return response()->json(['message' => 'Successfully logged out']);
   }
}

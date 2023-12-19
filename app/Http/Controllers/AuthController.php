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
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $credentials = $request->only('phone_number', 'password');

        $user = Actor_personal_info::where('phone_number', $credentials['phone_number'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        throw ValidationException::withMessages(['phone_number' => 'Invalid credentials']);
    }

    public function loginClubManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $code = $request->input('code');
        $clubManager = Actor_personal_info::where('code', $code)->first();

        if ($clubManager) {
            $token = $clubManager->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        throw ValidationException::withMessages(['code' => 'Invalid code']);
    }

  
    public function signupPlayer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string|unique:actor_personal_infos',
            'password' => 'required|min:8'
        
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $player = new Actor_personal_info([
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'b_date'=>Carbon::parse($request->input('b_date'))->format('Y-m-d'),
            'phone_number' => $request->input('phone_number'),
            'Rule_id'=="player"? 1: 2,
            'gender' => $request->input('gender') == "male" ? 1 : 2,
            'email' => $request->has('email') ? $request->input('email') : null,
            'country' => $request->input('country'),
            'password' => Hash::make($request->input('password')),
            
        ]);

        $player->save();

       

        $token = $player->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 201); 
    }

}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller; // Add this import statement
use App\Models\ActorPersonalInfos;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class RegisterController extends \Illuminate\Routing\Controller
{
    public function register(Request $request)
    {
        $dataInput = $request->json()->all();

        $validator = Validator::make($dataInput, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:14',
            'email' => 'nullable|unique:users|max:255',
            'password' => 'required|string|min:8',
            'locations' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'b_date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = new ActorPersonalInfos();
        $user->first_name = $dataInput['first_name'];
        $user->last_name = $dataInput['last_name'];
        $user->phone_number = $dataInput['phone_number'];
        $user->email = $dataInput['email'] ?? null;
        $user->password = bcrypt($dataInput['password']);
        $user->locations = $dataInput['locations'];
        $user->gender = $dataInput['gender'];
        $user->b_date = $dataInput['b_date'];
        $user->save();

        // Issue JWT token
        $token = auth()->attempt($request->only('email', 'password'));

        return response()->json(compact('token'), 201);
    }
}

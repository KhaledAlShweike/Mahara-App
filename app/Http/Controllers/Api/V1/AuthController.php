<?php

namespace App\Http\Controllers;

use App\Models\ActorPersonalInfos;
use Http;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    function Register(Request $request)
    {
        
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:14',
            'email' => 'nullable|exists:email|unique:players|max:255',
            'password' => 'required|string|min:8',
            'locations' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'b_date' => 'required|date_format:Y-m-d',
        ]);

        $user = new ActorPersonalInfos();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->phone_number = $request['phone_number'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->Location = $request['Location'];
        $user->Rule = $request['Rule'];
        $user->gender = $request['gender'];
        $user->b_date = $request['b_date'];
        $user->status = 1;

        $user->save();

        return response()->json("success", 200);
    }



    public function Login(Request $request)
    {
        $credentials = $request->only('phone_number', 'password');

        $user = ActorPersonalInfos::where('phone_number', $credentials['phone_number'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return Response::json(['error' => 'Unauthorized'], 401);
        }
    
        // Set 'status' to 1 when the user is signed in
        $user->status = 1;
        $user->save();
    
        $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'key=AAAAiG6RzA8:APA91bFyWSi4lI8HjUBaGxtkm5bDxVOt2VBPuPV_XeaBsuWsfYRwAcYHA80vRv_n0GpoAbZZNJAGJYQ0TvTg0IzhAtb6fk4_7p8usoQt9pLBmdIf4y6GzLB5dstFEFx1XhLTb78O58vK',
            ])
            ->post('https://fcm.googleapis.com/fcm/send', [
                'to' => 'هون بتحط التوكين يلي ببعتلك ياه و يلي بتخزنو بتيبل ال player',
                'notification' => [
                    'title' => 'هون عنوان النتفوكيشن ',
                    'body' => 'هون الكتابة التحتانية تبع النفوكيشن ',
                ],
                'data' => [
                    'type' => 'logout',
                    'title' => 'This account is used to login in another device, Please use one device only to use our application',
                ],
            ]);
    
        return $response;
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

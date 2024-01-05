<?php

namespace App\Http\Controllers;


use App\Models\ActorPersonalInfos;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActorPersonalInfosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    public function update(Request $request,ActorPersonalInfos $ActorPersonalInfos ) 
    {

        $actor = ActorPersonalInfos::get('id');
        if ($actor) {
            $actor->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => $request->password,
                'b_date' => $request->b_date,
            ]);
            return response()->json(['message' => "Successfully updated actor!"], 201);
        } else {
            return response()->json(['error' => 'Failed to add new actor'], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}

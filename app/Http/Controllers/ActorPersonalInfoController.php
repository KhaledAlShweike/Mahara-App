<?php

namespace App\Http\Controllers;


use App\Models\Actor_personal_info;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActorPersonalInfoController extends Controller
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
    public function create(Actor_personal_info $actor_personal)
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
    public function show(Actor_personal_info $actor_personal_info)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor_personal_info $actor_personal_info)
    {
        //
    }

    public function update(Request $request, Actor_personal_info $actor_personal_info)
    {

        $actor = Actor_personal_info::find('id');
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
    public function destroy(Actor_personal_info $actor_personal_info)
    {
        //
    }
}

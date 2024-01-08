<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ActorPersonalInfos;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Player;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class UpdateActorInformations extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'actor_id' => 'required|exists:actor_personal_infos,id',
            'new_password' => 'required|string',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('actor_id'));
        $actor->password = Hash::make($request->input('new_password'));
        $actor->save();

        return response()->json(['message' => 'Password changed successfully']);
    }

    public function changeFirstName(Request $request)
    {
        $request->validate([
            'actor_id' => 'required|exists:actor_personal_infos,id',
            'new_first_name' => 'required|string',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('actor_id'));
        $actor->first_name = $request->input('new_first_name');
        $actor->save();

        return response()->json(['message' => 'First name changed successfully']);
    }

    public function changeLastName(Request $request)
    {
        $request->validate([
            'actor_id' => 'required|exists:actor_personal_infos,id',
            'new_last_name' => 'required|string',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('actor_id'));
        $actor->last_name = $request->input('new_last_name');
        $actor->save();

        return response()->json(['message' => 'Last name changed successfully']);
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'actor_id' => 'required|exists:actor_personal_infos,id',
            'new_email' => 'required|email|unique:actor_personal_infos,email',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('actor_id'));
        $actor->email = $request->input('new_email');
        $actor->save();

        return response()->json(['message' => 'Email changed successfully']);
    }

    public function changeBirthdate(Request $request)
    {
        $request->validate([
            'actor_id' => 'required|exists:actor_personal_infos,id',
            'new_birthdate' => 'required|date',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('actor_id'));
        $actor->b_date = $request->input('new_birthdate');
        $actor->save();

        return response()->json(['message' => 'Birthdate changed successfully']);
    }

    public function createTeamAndMakeCaptain(Request $request)
    {
        $request->validate([
            'actor_id' => 'required|exists:actor_personal_infos,id',
            'team_name' => 'required|string|unique:teams,name',
        ]);

        // Create a new team
        $team = Team::create(['name' => $request->input('team_name')]);

        // Make the actor the captain of the newly created team
        $actor = ActorPersonalInfos::findOrFail($request->input('actor_id'));
        $actor->update(['team_id' => $team->id, 'is_captain' => true]);

        return response()->json(['message' => 'Team created, and actor made captain successfully']);
    }
}

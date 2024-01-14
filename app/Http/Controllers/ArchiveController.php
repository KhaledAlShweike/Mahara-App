<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'player_id' => 'required|exists:Player,id',
        ]);

        $playerId = $request->input('Player_id');
        $archive = Archive::where('Player', $playerId)->get();

        if ($archive->isEmpty()) {
            return response()->json(['status'=> 1,'message' => 'The archive for this player are empty']);
        }

        return response()->json(['status'=> 0,'Players' => $archive]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Archive $Archive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archive $Archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archive $Archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archive $Archive)
    {
        //
    }
}

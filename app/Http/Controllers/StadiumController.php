<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $this->validate($request, [
        'Club_name' => 'required|exists:Locations,name',
    ]);

    $ClubName = $request->input('Club_name');

    $Stadiums = Stadium::where('Club_name', $ClubName)->get();

    if ($Stadiums->isEmpty()) {
        return response()->json(['message' => 'No Stadiums found in this Club'], 404);
    }

    return response()->json(['Stadiums' => $Stadiums], 200);
    }

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
    public function show($id)
    {
        $Stadium = Stadium::with(['Image', 'Image.Image_path'])->find($id);

        if ($Stadium) {
            return response()->json(['data' => $Stadium], 200);
        } else {
            return response()->json(['message' => 'Stadium not found'], 404);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stadium $Stadium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stadium $Stadium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stadium $Stadium)
    {
        //
    }
}

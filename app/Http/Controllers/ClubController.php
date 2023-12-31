<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LocationController;
use App\Models\Club;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Contracts\Service\Attribute\Required;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getClub(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required|exists:locations,name',
        ]);

        $locationName = $request->input('location_name');
        $clubs = Club::where('location', $locationName)->get();

        if ($clubs->isEmpty()) {
            return response()->json(['message' => 'No clubs found in this location'], 404);
        }

        return response()->json(['clubs' => $clubs], 200);
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
        $club = Club::with(['image', 'image.image_path'])->find($id);

        if ($club) {
            return response()->json(['data' => $club], 200);
        } else {
            return response()->json(['message' => 'Club not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        //
    }
}

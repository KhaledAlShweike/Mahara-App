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
    public function index(Request $request)
    {
        $this->validate($request, [
            'Location_name' => 'required|exists:Locations,name',
        ]);

        $LocationName = $request->input('Location_name');
        $Clubs = Club::where('Location', $LocationName)->get();

        if ($Clubs->isEmpty()) {
            return response()->json(['message' => 'No Clubs found in this Location'], 404);
        }

        return response()->json(['Clubs' => $Clubs], 200);
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
        $Club = Club::with(['Image', 'Image.Image_path'])->find($id);

        if ($Club) {
            return response()->json(['data' => $Club], 200);
        } else {
            return response()->json(['message' => 'Club not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Club $Club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $Club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $Club)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

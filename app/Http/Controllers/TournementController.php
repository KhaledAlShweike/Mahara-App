<?php

namespace App\Http\Controllers;

use App\Models\Tournement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TournementController extends Controller
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
        $Touenements = Tournement::where('Location', $LocationName)->get();

        if (  $Touenements->isEmpty()) {
            return response()->json(['message' => 'No   Touenements found in this Location'], 404);
        }

        return response()->json(['Touenements' =>   $Touenements], 200);
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
    public function show(Tournement $Tournement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournement $Tournement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tournement $Tournement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tournement $Tournement)
    {
        //
    }
}

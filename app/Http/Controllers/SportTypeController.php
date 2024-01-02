<?php

namespace App\Http\Controllers;

use App\Models\SportType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSports()
    {
        $Sport = SportType::all();
        return response()->json(['Sports Type'=>$Sport],200);
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
    public function show(SportType $SportType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportType $SportType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SportType $SportType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportType $SportType)
    {
        //
    }
}

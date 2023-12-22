<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StadiumController extends Controller
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
        $stadium = Stadium::with(['image', 'image.image_path'])->find($id);

        if ($stadium) {
            return response()->json(['data' => $stadium], 200);
        } else {
            return response()->json(['message' => 'Stadium not found'], 404);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stadium $stadium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stadium $stadium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stadium $stadium)
    {
        //
    }
}

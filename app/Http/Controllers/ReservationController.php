<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Reservations = Reservation::all();

        return response()->json(['Reservations' => $Reservations]);
    }


    public function ClubReservation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|exists:Club,name',
        ]);

        $CLubname = $request->input('name');
        $Reservation = Reservation::where('Location', $CLubname)->get();

        if ($Reservation->isEmpty()) {
            return response()->json(['message' => 'No reservation found in this club'], 404);
        }

        return response()->json(['Reservation' => $Reservation], 200);
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
    public function show(Reservation $Reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $Reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $Reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $Reservation)
    {
        //
    }
}

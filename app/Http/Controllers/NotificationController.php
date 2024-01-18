<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationController extends Controller
{
    
  
  public function PlayerNotifications(Request $request)
  {
    $this->validate($request, [
        'player_id' => 'required|exists:Player,id',
    ]);

    $playerId = $request->input('player_id');
    $notifications = Notification::where('player_id', $playerId)->get();

    if ($notifications->isEmpty()) {
        return response()->json(['message' => 'No Notifications found for this player'], 404);
    }

    return response()->json(['Notifications' => $notifications], 200);
  }
  
     public function index()
    {
        $count = Notification::where('is_read', false)->count();

        return response()->json(['count' => $count]);
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
    public function show(Notification $Notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $Notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $Notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $Notification)
    {
        //
    }
}

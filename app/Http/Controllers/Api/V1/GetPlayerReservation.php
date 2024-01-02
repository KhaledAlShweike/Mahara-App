<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Player;



class GetPlayerReservation extends Controller
{
    public function GetReservation(Request $request)
    {
        $this->validate($request, [
            'Player_id' => 'required|exists:Players',
        ]);

        $Playerid = $request->input('Player_id');

        if (!$Playerid)
            return response()->json(['message' => 'Player not found']);

        $Player = Player::with(['Reservations.Teams.SportType', 'Reservations.Stadiums.Clubs']);

        $playerFirstName = $Playerid->first_name;
        $playerLastName = $Playerid->last_name;
        $Playerfullname = $playerFirstName . ' ' . $playerLastName;

        $Reservations = $Player->Reservations;

        foreach ($Reservations as $reservation) {
            $Teamid = $reservation->Player->Teams->id;
            $TeamName = $reservation->Player->Teams->name;
            $SportTypename = $reservation->Player->Teams->SportType->name;
            $SportTypeid = $reservation->Player->Teams->SportType->id;
            $Stadiumid = $reservation->Stadium->id;
            $StadiumName = $reservation->Stadium->name;
            $Reservationid = $reservation->id;
            $ReservationStartTime = $reservation->starttime;
            $ReservationEndTime = $reservation->endtime;
            $Clubid = $reservation->Stadium->Clubs->id;
            $ClubName = $reservation->Stadium->CLubs->name;
        }


        $reservationsInfo[] = [
            'Reservation id' => $Reservationid,
            'Start time' => $ReservationStartTime,
            'End time' => $ReservationEndTime,
            'Team Reservations' => [
                'Team id' => $Teamid,
                'Team Name' => $TeamName,
                'Sport Type id' => $SportTypeid,
                'Sport Type name' => $SportTypename
            ],
            'Stadium' => [
                'Stadium id' => $Stadiumid,
                'Stadium name' => $StadiumName,
                'Club id' => $Clubid,
                'Club name' => $ClubName,
            ],
        ];

        return response()->json([
            'message' => 'All player reservations:',
            'Player name' => $Playerfullname,
            'Reservations' => $reservationsInfo,
        ]);
    }
}
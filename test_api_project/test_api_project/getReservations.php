<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['player_id'])) {
    echo json_encode(array("status" => "-1", "error" => "enter player id"));
} else {
    $playerID = $_GET['player_id'];
    $stm = $connect->prepare("SELECT reservations.id, reservations.date,reservations.slot,reservations.stadium_id from reservations,playerreservations WHERE reservations.id = playerreservations.reservation_id and playerreservations.player_id = ?");
    $stm->execute(array($playerID));
    $reservationData = $stm->fetchAll(PDO::FETCH_ASSOC);
    $playerReservationsCount = $stm->rowCount();
    if ($playerReservationsCount > 0) {
        for ($i = 0; $i < $playerReservationsCount; $i++) {
            //get stadium info
            $stadiumID = $reservationData[$i]['stadium_id'];
            $stm = $connect->prepare("SELECT stadiums.name as stadium_name,sporttypes.SportType as sport,clubs.name as club_name,clubs.id as club_id FROM clubs,stadiums,sporttypes WHERE stadiums.sport_type_id = sporttypes.id and clubs.id = stadiums.club_id AND stadiums.id = ?");
            $stm->execute(array($stadiumID));
            $reservationInfo = $stm->fetch(PDO::FETCH_ASSOC);
            $reservationData[$i]['sport'] = $reservationInfo['sport'];
            $reservationData[$i]['stadium_name'] = $reservationInfo['stadium_name'];
            $reservationData[$i]['club_id'] = $reservationInfo['club_id'];
            $reservationData[$i]['club_name'] = $reservationInfo['club_name'];
            $reservationData[$i]['from'] = "my reservation";
        }
    }
    //get team resrvations :
    $stm = $connect->prepare("SELECT teamplayers.team_id,teams.name FROM teamplayers,teams WHERE teamplayers.team_id = teams.id and teamplayers.player_id = ?");
    $stm->execute(array($playerID));
    $playerTeams = $stm->fetchAll(PDO::FETCH_ASSOC); 
    $isValed = $stm->rowCount();
    $teamsResrvationsData = array();
    if ($isValed > 0) {
        for ($i = 0; $i < $isValed; $i++) {
            $teamID = $playerTeams[$i]['team_id'];
            $stm = $connect->prepare("SELECT reservationteam.Reservation_id as id,reservations.date,reservations.slot,reservations.stadium_id FROM reservationteam,reservations WHERE reservationteam.Reservation_id = reservations.id AND reservationteam.Team_id = ?");
            $stm->execute(array($teamID));
            $teamResrvations = $stm->fetchAll(PDO::FETCH_ASSOC);
            $resrvationsCount = $stm->rowCount();
            if ($resrvationsCount > 0) {
                for ($j = 0; $j < $resrvationsCount; $j++) {
                    $stadiumID = $teamResrvations[$j]['stadium_id'];
                    $stm = $connect->prepare("SELECT stadiums.name as stadium_name,sporttypes.SportType as sport,clubs.name as club_name,clubs.id as club_id FROM clubs,stadiums,sporttypes WHERE stadiums.sport_type_id = sporttypes.id and clubs.id = stadiums.club_id AND stadiums.id = ?");
                    $stm->execute(array($stadiumID));
                    $reservationInfo = $stm->fetch(PDO::FETCH_ASSOC);
                    $teamResrvations[$j]['sport'] = $reservationInfo['sport'];
                    $teamResrvations[$j]['stadium_name'] = $reservationInfo['stadium_name'];
                    $teamResrvations[$j]['club_id'] = $reservationInfo['club_id'];
                    $teamResrvations[$j]['club_name'] = $reservationInfo['club_name'];
                    $teamResrvations[$j]['from'] = $playerTeams[$i]['name'];
                    $teamResrvations[$j]['team_id'] = $playerTeams[$i]['team_id'];
                }
                $teamsResrvationsData = array_merge($teamsResrvationsData, $teamResrvations);
            }
        }
    }
    $reservationData = array_merge($reservationData, $teamsResrvationsData);
    $count = count($reservationData);
    if($count > 0){
        echo json_encode(array("status" => "0" , "data" => $reservationData));
    }
    else{
        echo json_encode(array("status" => "1" , "error" => "no reservations for this player"));
    }
}
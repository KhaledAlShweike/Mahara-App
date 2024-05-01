<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['player_id'])) {
    echo json_encode(array("status" => false, "error" => "enter player_id"));
} else {
    $playerID = $_GET['player_id'];

    //1. get player matching 
    $personalMatching = array();

    $stm = $connect->prepare("SELECT date,slot,stadium_id FROM playertoteammatchings WHERE player_id = ?");
    $stm->execute(array($playerID));
    $mathcingData = $stm->fetchAll(PDO::FETCH_ASSOC);

    $mathcingCount = $stm->rowCount();

    for ($i = 0; $i < $mathcingCount; $i++) {
        $stm = $connect->prepare("SELECT name FROM stadiums WHERE id = ?");
        $stm->execute(array($mathcingData[$i]['stadium_id']));
        $stadiumName = $stm->fetch(PDO::FETCH_COLUMN);

        array_push($personalMatching, array("type" => "player to team", "slot" => $mathcingData[$i]['slot'], "date" => $mathcingData[$i]['date'], "stadium_id" => $mathcingData[$i]['stadium_id'], "stadium_name" => $stadiumName, "matching_status" => 0));
    }

    $stm = $connect->prepare("SELECT team_id , reservation_id  FROM teamtoplayermatchings WHERE player_id = ?");
    $stm->execute(array($playerID));
    $mathcingData = $stm->fetchAll(PDO::FETCH_ASSOC);

    $mathcingCount = $stm->rowCount();

    for ($i = 0; $i < $mathcingCount; $i++) {
        $stm = $connect->prepare("SELECT name FROM teams WHERE id = ?");
        $stm->execute(array($mathcingData[$i]['team_id']));
        $teamName = $stm->fetch(PDO::FETCH_COLUMN);

        $stm = $connect->prepare("SELECT date,slot FROM reservations WHERE id = ?");
        $stm->execute(array($mathcingData[$i]['reservation_id']));
        $reservationData = $stm->fetch(PDO::FETCH_ASSOC);

        array_push($personalMatching, array("type" => "player to team", "slot" => $reservationData['slot'], "date" => $reservationData['date'], "team_id" => $mathcingData[$i]['team_id'], "team_name" => $teamName, "matching_status" => 1));
    }

    // 2. get team matching : 

    $teamMatchimg = array();

    $stm = $connect->prepare("SELECT team_id FROM teamplayers WHERE  Captin = 1 AND player_id = ?");
    $stm->execute(array($playerID));
    $teamID = $stm->fetchAll(PDO::FETCH_COLUMN);

    $teamCount = $stm->rowCount();

    for ($i = 0; $i < $teamCount; $i++) {
        $stm = $connect->prepare("SELECT id,date,slot,stadium_id,status,Team1_id,Team2_id FROM teamtoteammatchings WHERE Team1_id = ? OR Team2_id = ?");
        $stm->execute(array($teamID[$i], $teamID[$i]));
        $matchingData = $stm->fetchAll(PDO::FETCH_ASSOC);
        $mathcingCount = $stm->rowCount();
        for ($j = 0; $j < $mathcingCount; $j++) {
            $stm = $connect->prepare("SELECT name FROM stadiums WHERE id = ?");
            $stm->execute(array($matchingData[$j]['stadium_id']));
            $stadiumName = $stm->fetch(PDO::FETCH_COLUMN);

            array_push($teamMatchimg, array("type" => "team to team", "id" => $matchingData[$j]['id'], "slot" => $matchingData[$j]['slot'], "date" => $matchingData[$j]['date'], "stadium_id" => $matchingData[$j]['stadium_id'], "player_team" => $teamID[$i], "team1" => $matchingData[$j]['Team1_id'], "team2" => $matchingData[$j]['Team2_id'], "playment_status" => $matchingData[$j]['status'], "stadium_name" => $stadiumName));
        }
    }
    //3. team to player only for admins 
    $stm = $connect->prepare("SELECT team_id FROM teamplayers WHERE Captin = 1 AND player_id = ?");
    $stm->execute(array($playerID));
    $teamID = $stm->fetchAll(PDO::FETCH_COLUMN);

    $teamCount = $stm->rowCount();

    for ($i = 0; $i < $teamCount; $i++) {
        $stm = $connect->prepare("SELECT id,reservation_id,player_id FROM teamtoplayermatchings WHERE team_id = ?");
        $stm->execute(array($teamID[$i]));
        $matchingData = $stm->fetchAll(PDO::FETCH_ASSOC);

        $mathcingCount = $stm->rowCount();

        for ($j = 0; $j < $mathcingCount; $j++){
            $stm = $connect->prepare("SELECT date,slot FROM reservations WHERE id = ?");
            $stm->execute(array($matchingData[$j]['reservation_id']));
            $reservationData = $stm->fetch(PDO::FETCH_ASSOC);

            $stm = $connect->prepare("SELECT actorpersonalinfos.first_name FROM actorpersonalinfos , players WHERE players.actor_personal_infos_id = actorpersonalinfos.id AND players.id = ?");
            $stm->execute(array($matchingData[$j]['player_id']));
            $playerName = $stm->fetch(PDO::FETCH_COLUMN);

            array_push($teamMatchimg , array("type" => "team to player", "id" => $matchingData[$j]['id'] , "date" => $reservationData['date'],"slot" => $reservationData['slot'] ,"player_name" => $playerName , "player_id" => $matchingData[$j]['player_id']));
        }
    }
    echo json_encode(array ("personal_matching" => $personalMatching ,"team_matching" => $teamMatchimg));
}
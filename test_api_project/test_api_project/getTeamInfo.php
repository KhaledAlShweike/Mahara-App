<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['team_id'])) {
    echo json_encode(array("status" => "-1", "error" => "enter team id"));
} else {
    $teamID = $_GET['team_id'];
    $stm = $connect->prepare("SELECT teams.name , sporttypes.SportType from teams,sporttypes WHERE teams.sport_type_id = sporttypes.id AND teams.id = ?");
    $stm->execute(array($teamID));
    $teamData = $stm->fetch(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if ($isValed > 0) {
        $teamMempers = array();
        $stm = $connect->prepare("SELECT teamplayers.player_id,teamplayers.Captin FROM teamplayers WHERE teamplayers.team_id = ?");
        $stm->execute(array($teamID));
        $teamPlayersIDs = $stm->fetchAll(PDO::FETCH_ASSOC);
        $isValed = $stm->rowCount();
        if ($isValed > 0) {
            for ($i = 0; $i < $isValed; $i++) {
                $playerID = $teamPlayersIDs[$i]['player_id'];
                $stm = $connect->prepare("SELECT actorpersonalinfos.first_name , actorpersonalinfos.last_name  FROM actorpersonalinfos,players WHERE players.actor_personal_infos_id = actorpersonalinfos.id AND players.id = ?");
                $stm->execute(array($playerID));
                $playerInfo = $stm->fetch(PDO::FETCH_ASSOC);
                $playerInfo['isCaptin'] = $teamPlayersIDs[$i]['Captin'];
                $playerInfo['player_id'] = $playerID;
                $teamMempers[$i] = $playerInfo ;
            }
        }
        $teamData['players'] = $teamMempers;
        echo json_encode(array("status" => "0", "data" => $teamData));
    } else {
        echo json_encode(array("status" => "-2", "error" => "team id not valed"));
    }
}
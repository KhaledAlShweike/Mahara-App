<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['team_id']) || empty($_GET['player_id']) ) {
    echo json_encode(array("status" => "-1", "error" => "enter team id and player id"));
}else{
    $teamID = $_GET['team_id'];
    $playerID = $_GET['player_id'];
    $stm = $connect->prepare("SELECT teamplayers.player_id,teamplayers.Captin from teamplayers WHERE teamplayers.player_id = ? AND teamplayers.team_id = ? ");
    $stm->execute(array($playerID,$teamID));
    $teamData = $stm->fetch(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if($isValed == 1){
        echo json_encode(array("isJoined" => true,"isCaptin" => $teamData['Captin']));
    }else{
        echo json_encode(array("isJoined" => false));
    }
}
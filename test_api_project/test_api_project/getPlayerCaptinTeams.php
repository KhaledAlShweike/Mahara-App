<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if(empty($_GET['player_id'])){
    echo json_encode(array("status" => "-1" , "error" => "enter player id"));
}else{
    $playerID = $_GET['player_id'];
    $stm = $connect->prepare("SELECT teams.id,teams.name,sporttypes.SportType ,teams.sport_type_id FROM `teams`,teamplayers,sporttypes WHERE teams.sport_type_id = sporttypes.id AND teamplayers.team_id = teams.id and teamplayers.Captin = 1 and  teamplayers.player_id = ?");
    $stm->execute(array($playerID));
    $playerTeams = $stm->fetchAll(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if($isValed > 0){
        echo json_encode(array("status" => "0","data" => $playerTeams));
    }else{
        echo json_encode(array("status" => "1" , "error" => "no data"));
    }
}
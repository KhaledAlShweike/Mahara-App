<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_POST['team_name']) || empty($_POST['sport_type_id']) || empty($_POST['player_id'])) {
    echo json_encode(array("status" => "-1", "error" => "Enter team name and sport type id and player id"));
} else {
    $playerID = $_POST['player_id'];
    $sportTypeID = $_POST['sport_type_id'];
    $teamName = $_POST['team_name'];
    $stm = $connect->prepare("SELECT CreatNewTeam(? , ? , ?) as 'team_id';");
    $stm->execute(array($teamName, $sportTypeID, $playerID));
    $newTeamId = $stm->fetch(PDO::FETCH_OBJ);
    $isValed = $stm->rowCount();
    if ($isValed > 0) {
        
        echo json_encode(array("status" => "0", "data" => $newTeamId));
    } else {
        echo json_encode(array("status" => "-2", "error" => $newTeamId));
    }
}

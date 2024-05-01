<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_POST['player_id']) || empty($_POST['email'])) {
    echo json_encode(array("status" => false, "error" => "Enter team player id and email type id and player id"));
}else{
    $playerID = $_POST['player_id'];
    $email = $_POST['email'];
    $stm = $connect->prepare("UPDATE `actorpersonalinfos`,players SET actorpersonalinfos.email = ? WHERE actorpersonalinfos.id = players.actor_personal_infos_id AND players.id = ?");
    $stm->execute(array($email,$playerID));
    $isValed = $stm->rowCount();
    if($isValed == 1){
        echo json_encode(array("status" => true));
    }else{
        echo json_encode(array("status" => false));
    }
}
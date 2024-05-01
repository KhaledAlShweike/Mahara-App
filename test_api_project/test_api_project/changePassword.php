<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_POST['player_id']) || empty($_POST['password'])) {
    echo json_encode(array("status" => false, "error" => "Enter team player id and password type id and player id"));
}else{
    $playerID = $_POST['player_id'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    //
    $stm = $connect->prepare("UPDATE `actorpersonalinfos`,players SET actorpersonalinfos.password = ? WHERE actorpersonalinfos.id = players.actor_personal_infos_id AND players.id = ?");
    $stm->execute(array($hashedPassword,$playerID));
    $isValed = $stm->rowCount();
    if($isValed == 1){
        echo json_encode(array("status" => true));
    }else{
        echo json_encode(array("status" => false));
    }
}
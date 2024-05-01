<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_POST['phone'])) {
    echo json_encode(array("status" => false, "error" => "Enter phone number"));
}else{
    $phone = $_POST['phone'];
    $stm = $connect->prepare("SELECT players.id FROM actorpersonalinfos, players WHERE players.actor_personal_infos_id = actorpersonalinfos.id AND actorpersonalinfos.phone_number = ? ");
    $stm->execute(array($phone));
    $playerID = $stm->fetch(PDO::FETCH_COLUMN);
    $isValed = $stm->rowCount();
    if($isValed > 0){
        echo json_encode(array("status" => true, "id" => $playerID));
    }else{
        echo json_encode(array("status" => false, "error" => "phone number not valed"));
    }
}
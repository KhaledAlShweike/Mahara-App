<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['player_id'])) {
    echo json_encode(array("status" => false, "error" => "enter player_id"));
}else{
    $playerID = $_GET['player_id'];

    $stm = $connect->prepare("SELECT COUNT(*) FROM notificationplayers WHERE notificationplayers.player_id = ?");
    $stm->execute(array($playerID));
    $notificationCount = (int)$stm->fetch(PDO::FETCH_COLUMN);

    echo json_encode(array("status" => true , "count" => $notificationCount));
}
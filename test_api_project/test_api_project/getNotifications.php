<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['player_id'])) {
    echo json_encode(array("status" => false, "error" => "enter player_id"));
} else {
    $playerID = $_GET['player_id'];

    $notifications = array();

    $stm = $connect->prepare("SELECT notificationplayers.notification_id  FROM notificationplayers WHERE notificationplayers.player_id = ?");
    $stm->execute(array($playerID));
    $notificationId = $stm->fetchALL(PDO::FETCH_COLUMN);
    $notificationCount = $stm->rowCount();

    for ($i = 0; $i < $notificationCount; $i++) {
        $stm = $connect->prepare("SELECT  `type`, `title`, `flow_id` FROM `notifications` WHERE id = ?");
        $stm->execute(array($notificationId[$i]));
        $notificationData = $stm->fetch(PDO::FETCH_ASSOC);
        array_push($notifications , $notificationData);
    }
    echo json_encode($notifications);
}

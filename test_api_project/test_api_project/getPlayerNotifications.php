<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['player_id'])) {
    echo json_encode(array("status" => false, "error" => "enter player_id"));
} else {
    $playerID = $_GET['player_id'];

    $notifications = array();

    $stm = $connect->prepare("SELECT notification_id FROM notificationplayers WHERE player_id = ?");
    $stm->execute(array($playerID));
    $notificationID = $stm->fetchAll(PDO::FETCH_COLUMN);

    $notificationCount = $stm->rowCount();

    for ($i = 0; $i < $notificationCount; $i++) {
        $stm = $connect->prepare("SELECT type,title,flow_id FROM notifications WHERE id = ?");
        $stm->execute(array($notificationID[$i]));
        $notificationData = $stm->fetch(PDO::FETCH_ASSOC);

        if ($notificationData['type'] == "accept_player_matching") {
            $stm = $connect->prepare("SELECT reservation_id,player_id FROM teamtoplayermatchings WHERE id = ?");
            $stm->execute(array($notificationData['flow_id']));
            $matchingData = $stm->fetch(PDO::FETCH_ASSOC);

            $stm = $connect->prepare("SELECT actorpersonalinfos.first_name FROM actorpersonalinfos,players WHERE actorpersonalinfos.id = players.actor_personal_infos_id AND players.id = ?");
            $stm->execute(array($matchingData['player_id']));
            $playerName = $stm->fetch(PDO::FETCH_COLUMN);

            $stm = $connect->prepare("SELECT date,slot FROM reservations WHERE id = ?");
            $stm->execute(array($matchingData['reservation_id']));
            $reservationData = $stm->fetch(PDO::FETCH_ASSOC);

            array_push($notifications, array("id" => $notificationID[$i],"type" => $notificationData['type'] , "title" =>  $notificationData['title'] , "matching_id" => $notificationData['flow_id'] , "reservation_id" => $matchingData['reservation_id'] , "date" => $reservationData['date'], "slot" => $reservationData['slot'], "player_name" => $playerName , "player_id" => $matchingData['player_id']));

        }else if($notificationData['type'] == "accept_player_invitation"){
            $stm = $connect->prepare("SELECT player_id,stadium_id , date , slot FROM playertoteammatchings WHERE id = ?");
            $stm->execute(array($notificationData['flow_id']));
            $matchingData = $stm->fetch(PDO::FETCH_ASSOC);

            $stm = $connect->prepare("SELECT actorpersonalinfos.first_name FROM actorpersonalinfos,players WHERE actorpersonalinfos.id = players.actor_personal_infos_id AND players.id = ?");
            $stm->execute(array($matchingData['player_id']));
            $playerName = $stm->fetch(PDO::FETCH_COLUMN);

            $stm = $connect->prepare("SELECT name FROM stadiums WHERE id = ?");
            $stm->execute(array($matchingData['stadium_id']));
            $stadiumName = $stm->fetch(PDO::FETCH_COLUMN);

            array_push($notifications , array("id" => $notificationID[$i] , "type" => $notificationData['type'] , "title" =>  $notificationData['title'] , "matching_id" => $notificationData['flow_id'] , "date" => $matchingData['date'] , "slot" => $matchingData['slot'] , "stadium_name" => $stadiumName , "stadium_id" => $matchingData['stadium_id'] , "player_name" => $playerName , "player_id" => $matchingData['player_id']));
        }
    }

    echo json_encode($notifications);
}

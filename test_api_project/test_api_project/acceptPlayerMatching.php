<?php
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $dataInput = json_decode(file_get_contents('php://input'), true);
    if (empty($dataInput['matching_id']) || empty($dataInput['player_id']) || empty($dataInput['is_accepted']) || empty($dataInput['notification_id']) || empty($dataInput['reservation_id'])) {
        echo json_encode(array("status" => false, "error" => "enter matching_id , player_id , is_accepted , notification_id"));
    } else {
        $matchingID = $dataInput['matching_id'];
        $playerID = $dataInput['player_id'];
        $isAccepted = $dataInput['is_accepted'];
        $notificationID = $dataInput['notification_id'];
        $reservationID = $dataInput['reservation_id'];

        $message = "temp";
        if ($isAccepted == -1) {
            $stm = $connect->prepare("UPDATE teamtoplayermatchings SET player_id = NULL WHERE id = ?");
            $stm->execute(array($matchingID));
            $message = "Your request to play for a team has been rejected :(";
        } else if ($isAccepted == 1) {
            $stm = $connect->prepare("INSERT INTO playerreservations(player_id, reservation_id) VALUES (?,?)");
            $stm->execute(array($playerID, $reservationID));

            $stm = $connect->prepare("DELETE FROM teamtoplayermatchings WHERE id = ?");
            $stm->execute(array($matchingID));
            $message = "Team captin accept to come over :) ; cheak your reservations";
        }

        $stm = $connect->prepare("SELECT `token` FROM `players` WHERE id = ?");
        $stm->execute(array($playerID));
        $token = $stm->fetch(PDO::FETCH_COLUMN);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"to\": \"$token\",\n    \"notification\": {\n      \"title\": \"Matching Update !\",\n      \"body\": \"<message>\"\n      }\n}",
            CURLOPT_HTTPHEADER => [
                "Authorization: key=AAAAiG6RzA8:APA91bFyWSi4lI8HjUBaGxtkm5bDxVOt2VBPuPV_XeaBsuWsfYRwAcYHA80vRv_n0GpoAbZZNJAGJYQ0TvTg0IzhAtb6fk4_7p8usoQt9pLBmdIf4y6GzLB5dstFEFx1XhLTb78O58vK",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $stm = $connect->prepare("DELETE FROM `notificationplayers` WHERE `notification_id` = ?");
        $stm->execute(array($notificationID));

        $stm = $connect->prepare("DELETE FROM notifications WHERE id = ?");
        $stm->execute(array($notificationID));

        echo json_encode(array("status" => true));
    }
} else {
    echo json_encode(array("status" => false, "error" => "This API do not support " . $_SERVER['REQUEST_METHOD'] . " method"));
}

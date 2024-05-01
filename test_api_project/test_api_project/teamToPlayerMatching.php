<?php
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $dataInput = json_decode(file_get_contents('php://input'), true);
    if (empty($dataInput['team_id']) || empty($dataInput['resservation_id']) || (!isset($dataInput['slot']) && $dataInput['slot'] == "") || empty($dataInput['date']) || empty($dataInput['stadium_id']) ) {
        echo json_encode(array("status" => false, "error" => "enter team_id , resservation_id , slot , date , stadium_id"));
    } else {
        $teamID = $dataInput['team_id'];
        $reservationID = $dataInput['resservation_id'];
        $slot = $dataInput['slot'];
        $date = $dataInput['date'];
        $stadiumID = $dataInput['stadium_id'];

        $stm = $connect->prepare("SELECT id,player_id FROM playertoteammatchings WHERE slot = ? AND date = ? AND stadium_id = ? ;");
        $stm->execute(array($slot, $date, $stadiumID));
        $playerMatchingData = $stm->fetchAll(PDO::FETCH_ASSOC);

        $isTherePlayersMatching = $stm->rowCount();

        $isMatchFound = false;
        $playerID = null;
        for ($i = 0; $i < $isTherePlayersMatching; $i++) {
            $stm = $connect->prepare("SELECT COUNT(*) FROM teamplayers WHERE  teamplayers.player_id = ? AND teamplayers.team_id = ? ;");
            $stm->execute(array($playerMatchingData[$i]['player_id'], $teamID));
            $isPlayerJoinedTeam = (int)$stm->fetch(PDO::FETCH_COLUMN);
            if ($isPlayerJoinedTeam == 0) {

                $stm = $connect->prepare("INSERT INTO playerreservations(player_id, reservation_id) VALUES (?,?)");
                $stm->execute(array($playerMatchingData[$i]['player_id'], $reservationID));

                $stm = $connect->prepare("DELETE FROM playertoteammatchings WHERE id = ?");
                $stm->execute(array($playerMatchingData[$i]['id']));

                $playerID = $playerMatchingData[$i]['player_id'];
                $isMatchFound = true;
                break;
            }
        }

        if ($isMatchFound == false) {
            $stm = $connect->prepare("SELECT COUNT(*) FROM teamtoplayermatchings WHERE team_id = ? AND reservation_id = ?");
            $stm->execute(array($teamID, $reservationID));
            $isTeamMtchingInThisTime = (int)$stm->fetch(PDO::FETCH_COLUMN);
            if ($isTeamMtchingInThisTime == 0) {
                $stm = $connect->prepare("INSERT INTO teamtoplayermatchings(reservation_id, team_id) VALUES (?,?);");
                $stm->execute(array($reservationID, $teamID));

                echo json_encode(array("status" => true, "matching_status" => "Request sent!; We will notify you if we find a player" , "testMatch" => $isMatchFound , ));
            }else{
                echo json_encode(array("status" => false, "error" => "You already matching in this time"));
            }
        } else { // send notification to player 
            $stm = $connect->prepare("SELECT token FROM players WHERE id = ?");
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
                CURLOPT_POSTFIELDS => "{\n    \"to\": \"$token\",\n    \"notification\": {\n      \"title\": \"Match found !\",\n      \"body\": \"We found team wants to play with you ; please cheak your reservations\"\n      }\n}",
                CURLOPT_HTTPHEADER => [
                    "Authorization: key=AAAAiG6RzA8:APA91bFyWSi4lI8HjUBaGxtkm5bDxVOt2VBPuPV_XeaBsuWsfYRwAcYHA80vRv_n0GpoAbZZNJAGJYQ0TvTg0IzhAtb6fk4_7p8usoQt9pLBmdIf4y6GzLB5dstFEFx1XhLTb78O58vK",
                    "Content-Type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);


            echo json_encode(array("status" => true, "matching_status" => "player found ! ; we will notify him to come over :)"));
        }
        
    }
} else {
    echo json_encode(array("status" => false, "error" => "This API do not support " . $_SERVER['REQUEST_METHOD'] . " method"));
}

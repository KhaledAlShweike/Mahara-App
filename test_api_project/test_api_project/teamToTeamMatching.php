<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
$dataInput = json_decode(file_get_contents('php://input'), true);
if (empty($dataInput['team_id']) || empty($dataInput['date']) || (!isset($dataInput['slot']) && $dataInput['slot'] == "") || empty($dataInput['stadium_id'])) {
    echo json_encode(array("status" => false, "error" => "enter team_id date slot stadium_id" ));
} else {
    $teamID = $dataInput['team_id'];
    $date = $dataInput['date'];
    $slot = $dataInput['slot'];
    $stadiumId = $dataInput['stadium_id'];

    $stm = $connect->prepare("SELECT COUNT(*) FROM reservations WHERE date = ? AND slot = ? AND stadium_id = ?");
    $stm->execute(array($date, $slot, $stadiumId));
    $isExistResrvation = (int)$stm->fetch(PDO::FETCH_COLUMN);

    if ($isExistResrvation == 1) {
        echo json_encode(array("status" => false, "error" => "this time is reserved"));
    } else {
        $stm = $connect->prepare("SELECT id FROM teamtoteammatchings WHERE date = ? AND slot = ? AND stadium_id = ?");
        $stm->execute(array($date, $slot, $stadiumId));
        $slotId = $stm->fetch(PDO::FETCH_COLUMN);

        $isNewMatching = $stm->rowCount();

        if ($isNewMatching == 1) {
            $stm = $connect->prepare("SELECT Team1_id,Team2_id FROM teamtoteammatchings WHERE id = ?");
            $stm->execute(array($slotId));
            $slotTeams = $stm->fetch(PDO::FETCH_ASSOC);

            if ($slotTeams['Team1_id'] == null && $slotTeams['Team2_id'] != $teamID) {
                $stm = $connect->prepare("UPDATE teamtoteammatchings SET Team1_id = ? WHERE id = ?");
                $stm->execute(array($teamID, $slotId));

                //send notification :
                $stm = $connect->prepare("SELECT player_id FROM teamplayers WHERE Captin = 1 AND team_id = ?");
                $stm->execute(array($slotTeams['Team2_id']));
                $Captins = $stm->fetchAll(PDO::FETCH_COLUMN);
                $CaptinsCount = $stm->rowCount();
                for ($i = 0; $i < $CaptinsCount; $i++) {


                    $stm = $connect->prepare("SELECT token FROM players WHERE id = ?");
                    $stm->execute(array($Captins[$i]));
                    $token = $stm->fetch(PDO::FETCH_COLUMN);
                    $curl = curl_init();
                    $curl = curl_init();

                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "{\n    \"to\": \"$token\",\n    \"notification\": {\n      \"title\": \"A player wants play with you !\",\n      \"body\": \"there is player wants to play with your team , if you need someone to back up yor team cheak your notifications\"\n      }\n}",
                        CURLOPT_HTTPHEADER => [
                            "Authorization: key=AAAAiG6RzA8:APA91bFyWSi4lI8HjUBaGxtkm5bDxVOt2VBPuPV_XeaBsuWsfYRwAcYHA80vRv_n0GpoAbZZNJAGJYQ0TvTg0IzhAtb6fk4_7p8usoQt9pLBmdIf4y6GzLB5dstFEFx1XhLTb78O58vK",
                            "Content-Type: application/json"
                        ],
                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);
                }
                echo json_encode(array("status" => true));
            } else if ($slotTeams['Team2_id'] == null && $slotTeams['Team1_id'] != $teamID) {
                $stm = $connect->prepare("UPDATE teamtoteammatchings SET Team2_id = ? WHERE id = ?");
                $stm->execute(array($teamID, $slotId));

                //send notification :
                $stm = $connect->prepare("SELECT player_id FROM teamplayers WHERE Captin = 1 AND team_id = ?");
                $stm->execute(array($slotTeams['Team1_id']));
                $Captins = $stm->fetchAll(PDO::FETCH_COLUMN);
                $CaptinsCount = $stm->rowCount();
                for ($i = 0; $i < $CaptinsCount; $i++) {

                    $stm = $connect->prepare("SELECT token FROM players WHERE id = ?");
                    $stm->execute(array($Captins[$i]));
                    $token = $stm->fetch(PDO::FETCH_COLUMN);
                    $curl = curl_init();
                    $curl = curl_init();

                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "{\n    \"to\": \"$token\",\n    \"notification\": {\n      \"title\": \"A player wants play with you !\",\n      \"body\": \"there is player wants to play with your team , if you need someone to back up yor team cheak your notifications\"\n      }\n}",
                        CURLOPT_HTTPHEADER => [
                            "Authorization: key=AAAAiG6RzA8:APA91bFyWSi4lI8HjUBaGxtkm5bDxVOt2VBPuPV_XeaBsuWsfYRwAcYHA80vRv_n0GpoAbZZNJAGJYQ0TvTg0IzhAtb6fk4_7p8usoQt9pLBmdIf4y6GzLB5dstFEFx1XhLTb78O58vK",
                            "Content-Type: application/json"
                        ],
                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);
                }

                echo json_encode(array("status" => true));
            } else {
                echo json_encode(array("status" => false, "error" => "this time is not available"));
            }
        } else {
            $stm = $connect->prepare("INSERT INTO teamtoteammatchings (date, slot, stadium_id, Team1_id) VALUES (?,?,?,?)");
            $stm->execute(array($date, $slot, $stadiumId, $teamID));

            echo json_encode(array("status" => true));
        }
    }
}

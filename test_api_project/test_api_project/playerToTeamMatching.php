<?php
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $dataInput = json_decode(file_get_contents('php://input'), true);
    if (empty($dataInput['date']) || (!isset($dataInput['slot']) && $dataInput['slot'] == "") || empty($dataInput['stadium_id']) || empty($dataInput['player_id'])) {
        echo json_encode(array("status" => false, "error" => "enter player_id date slot stadium_id"));
    } else {
        $date = $dataInput['date'];
        $slot = $dataInput['slot'];
        $stadiumId = $dataInput['stadium_id'];
        $playerID = $dataInput['player_id'];

        $stm = $connect->prepare("SELECT id FROM reservations WHERE date = ? AND slot = ? AND stadium_id = ?");
        $stm->execute(array($date, $slot, $stadiumId));
        $reservationID = $stm->fetch(PDO::FETCH_COLUMN);

        $isThereRerservation = $stm->rowCount();
        if ($isThereRerservation == 1) {
            $stm = $connect->prepare("SELECT team_id,id FROM teamtoplayermatchings WHERE reservation_id = ? AND player_id IS NULL");
            $stm->execute(array($reservationID));
            $teamInMatching = $stm->fetch(PDO::FETCH_ASSOC);

            $isThereMathing = $stm->rowCount();

            if ($isThereMathing == 1) {
                $teamInMatchingID = $teamInMatching['team_id'];
                $matchingId = $teamInMatching['id'];
                // but befor we neet to cheak if the player joined this team 
                $stm = $connect->prepare("SELECT COUNT(*) from teamplayers WHERE teamplayers.player_id = ? AND teamplayers.team_id = ? ");
                $stm->execute(array($playerID, $teamInMatchingID));
                $isPlayerInTeam = (int)$stm->fetch(PDO::FETCH_COLUMN);

                if ($isPlayerInTeam > 0) {
                    echo json_encode(array("status" => false, "error" => "You can't match with your team !"));
                } else {
                    $stm = $connect->prepare("UPDATE teamtoplayermatchings SET player_id = ? WHERE reservation_id = ? AND team_id = ?");
                    $stm->execute(array($playerID, $reservationID, $teamInMatchingID));
                    // send notifucation ro team captin 
                    // add it to notfication table 
                    // firset we need to get captin id 

                    $stm = $connect->prepare("SELECT player_id FROM teamplayers WHERE Captin = 1 AND team_id = ?");
                    $stm->execute(array($teamInMatchingID));
                    $Captins = $stm->fetchAll(PDO::FETCH_COLUMN);
                    $CaptinsCount = $stm->rowCount();
                    for ($i = 0; $i < $CaptinsCount; $i++) {
                        $stm = $connect->prepare("INSERT INTO notifications(type, title, flow_id) VALUES ('accept_player_matching','Player found !',?); INSERT INTO notificationplayers(player_id, notification_id) VALUES (?,LAST_INSERT_ID());");
                        $stm->execute(array($matchingId, $Captins[$i]));

                        $stm = $connect->prepare("SELECT token FROM players WHERE id = ?");
                        $stm->execute(array($Captins[$i]));
                        $token = $stm->fetch(PDO::FETCH_COLUMN);
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
                            CURLOPT_POSTFIELDS => "{\n    \"to\": \"$token\",\n    \"notification\": {\n      \"title\": \"Player Found !\",\n      \"body\": \"we found a player to play with you; please check your notifications\"\n      }\n}",
                            CURLOPT_HTTPHEADER => [
                                "Authorization: key=AAAAiG6RzA8:APA91bFyWSi4lI8HjUBaGxtkm5bDxVOt2VBPuPV_XeaBsuWsfYRwAcYHA80vRv_n0GpoAbZZNJAGJYQ0TvTg0IzhAtb6fk4_7p8usoQt9pLBmdIf4y6GzLB5dstFEFx1XhLTb78O58vK",
                                "Content-Type: application/json"
                            ],
                        ]);

                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);
                    }
                    echo json_encode(array("status" => true, "matching_status" => "request sent to team captain ; waiting for acceptance"));
                }
            } else { //  في حجز بس مافي ماتشبنغ او في ماتشنغ بس ملاقي لاعب
                //send notfificattion to team captin to tell them that someone wants to play with you 
                //insert new player to team matching 
                $stm = $connect->prepare("SELECT COUNT(*) FROM playertoteammatchings WHERE playertoteammatchings.slot = ? AND playertoteammatchings.date = ? AND playertoteammatchings.stadium_id = ? AND playertoteammatchings.player_id = ?");
                $stm->execute(array($slot, $date, $stadiumId, $playerID));
                $isPlayerMathingSameTime = (int)$stm->fetch(PDO::FETCH_COLUMN);
                if ($isPlayerMathingSameTime == 0) {
                    $stm = $connect->prepare("SELECT insert_playertoteammatchings(?,?,?,?);");
                    $stm->execute(array($date, $slot, $stadiumId, $playerID));
                    $matchingId = $stm->fetch(PDO::FETCH_COLUMN);

                    $stm = $connect->prepare("SELECT team_id FROM reservationteam WHERE reservation_id = ?;");
                    $stm->execute(array($reservationID));
                    $teamId = $stm->fetchAll(PDO::FETCH_COLUMN);

                    $teamsCount = $stm->rowCount();

                    for ($j = 0; $j < $teamsCount; $j++) {
                        $stm = $connect->prepare("SELECT player_id FROM teamplayers WHERE Captin = 1 AND team_id = ?");
                        $stm->execute(array($teamId[$j]));
                        $Captins = $stm->fetchAll(PDO::FETCH_COLUMN);
                        $CaptinsCount = $stm->rowCount();
                        for ($i = 0; $i < $CaptinsCount; $i++) {

                            $stm = $connect->prepare("INSERT INTO notifications(type, title,  flow_id) VALUES ('accept_player_invitation','A player wants to play with you',?); INSERT INTO notificationplayers(player_id, notification_id) VALUES (?,LAST_INSERT_ID());");
                            $stm->execute(array( $matchingId, $Captins[$i]));
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
                    }
                    echo json_encode(array("status" => true, "matching_status" => "we sent message to captin of team playing in this time"));
                } else {
                    echo json_encode(array("status" => false, "error" => "You already matching in this time"));
                }
            }
        } else { // مافي حجز بالاساس 
            $stm = $connect->prepare("SELECT COUNT(*) FROM playertoteammatchings WHERE playertoteammatchings.slot = ? AND playertoteammatchings.date = ? AND playertoteammatchings.stadium_id = ? AND playertoteammatchings.player_id = ?");
            $stm->execute(array($slot, $date, $stadiumId, $playerID));
            $isPlayerMathingSameTime = (int)$stm->fetch(PDO::FETCH_COLUMN);
            if ($isPlayerMathingSameTime == 0) {
                $stm = $connect->prepare("SELECT insert_playertoteammatchings(?,?,?,?);");
                $stm->execute(array($date, $slot, $stadiumId, $playerID));
                echo json_encode(array("status" => true, "matching_status" => "no one playing at this time here ; if some one come to play here we will tell him about you :)"));
            } else {
                echo json_encode(array("status" => false, "error" => "You already matching in this time"));
            }
        }
    }
} else {
    echo json_encode(array( "status" => false ,"error" => "This API do not support ". $_SERVER['REQUEST_METHOD'] . " method"));
}

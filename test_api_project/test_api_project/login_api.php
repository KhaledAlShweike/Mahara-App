<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_POST['token']) || empty($_POST['pass']) || empty($_POST['ph'])) {
    echo json_encode(array("status" => "-1", "error" => "enter phone number and password and token"));
} else {

    $phoneNumber = $_POST['ph'];
    $passWord = $_POST['pass'];
    $token = $_POST['token'];

    $stm = $connect->prepare("SELECT id,password,rule_id FROM actorpersonalinfos  WHERE phone_number = ?");
    $stm->execute(array($phoneNumber));
    $dbData = $stm->fetch(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if ($isValed > 0) {
        
        if (!password_verify($passWord,$dbData['password'])) {
            echo json_encode(array("status" => "-2", "error" => "Phone number or password not valed !"));
        }else {
            if ($dbData['rule_id'] != 1) {
                echo json_encode(array("status" => "-3", "error" => "This User type can not login"));
            } else {
                $personal_id = $dbData['id'];
                $stm = $connect->prepare("SELECT players.token,players.id,actorpersonalinfos.first_name,actorpersonalinfos.last_name,actorpersonalinfos.email,actorpersonalinfos.b_date FROM players,actorpersonalinfos WHERE players.actor_personal_infos_id = actorpersonalinfos.id AND actorpersonalinfos.id = ? ");
                $stm->execute(array($personal_id));
                $dbLoginData = $stm->fetch(PDO::FETCH_ASSOC);
                $player_id = $dbLoginData['id']; //get player id to update the token
                $stm =  $connect->prepare("UPDATE players SET token = ? WHERE id = ?"); //updating the token
                $stm->execute(array($token,$player_id));
                $isNewToken = $stm->rowCount();
                if ($isNewToken == 1) {
                    $oldeToken = $dbLoginData['token'];
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "{\n    \"to\": \"$oldeToken\",\n    \"notification\": {\n      \"title\": \"Warning\",\n      \"body\": \"Your current account user to login in anuther \"\n      },\n      \"data\" : {\n        \"type\" : \"logout\",\n        \"title\": \"This account is used to login in another divice, Please use one divice only to use our application\"\n      }\n}",
                        CURLOPT_HTTPHEADER => ["Authorization: key=AAAAiG6RzA8:APA91bFyWSi4lI8HjUBaGxtkm5bDxVOt2VBPuPV_XeaBsuWsfYRwAcYHA80vRv_n0GpoAbZZNJAGJYQ0TvTg0IzhAtb6fk4_7p8usoQt9pLBmdIf4y6GzLB5dstFEFx1XhLTb78O58vK", "Content-Type: application/json"],
                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                        //echo "cURL Error #:" . $err;
                    } else {
                        //echo $response;
                    }
                    //$dbLoginData['notifications_token'] = $token;
                }
                //unset($dbLoginData['notifications_token']);
                echo json_encode(array("status" => "0", "data" => $dbLoginData));
            }
        }
    } else {
        echo json_encode(array("status" => "-4", "error" => "Phone number or password not valed !"));
    }
}

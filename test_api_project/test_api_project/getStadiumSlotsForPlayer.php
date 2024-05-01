<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['stadium_id']) || empty($_GET['date'])) {
    echo json_encode(array("status" => false, "error" => "enter team id"));
} else {
    $stadiumId = $_GET['stadium_id'];
    $date = $_GET['date'];

    $slots = array();

    $stm = $connect->prepare("SELECT id,slot FROM reservations WHERE stadium_id = ? AND date = ?");
    $stm->execute(array($stadiumId, $date));
    $stadiumReservations = $stm->fetchAll(PDO::FETCH_ASSOC);

    $isTherAnyReservations = $stm->rowCount();

    for ($i = 0; $i < $isTherAnyReservations; $i++) {
        $stm = $connect->prepare("SELECT team_id FROM teamtoplayermatchings WHERE reservation_id = ? AND player_id IS NULL");
        $stm->execute(array($stadiumReservations[$i]['id']));
        $teamInMatching = $stm->fetchALL(PDO::FETCH_COLUMN);

        $isInMatchng = $stm -> rowCount();

        for($j = 0; $j < $isInMatchng; $j++){
            array_push($slots,array("slot" => $stadiumReservations[$i]['slot'], "team_id" => $teamInMatching[$j]));
            //echo json_encode(array($j.'t' => array("slot" => $stadiumReservations[$i]['slot'], "team_id" => $teamInMatching[$j])));
            //$slots[$j] = array("slot" => $stadiumReservations[$i]['slot'], "team_id" => $teamInMatching[$j]);
            
        }
    }

    echo json_encode(array("status" => true,"data" => $slots));
}

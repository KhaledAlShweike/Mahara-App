<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['stadium_id']) || empty($_GET['date'])) {
    echo json_encode(array("status" => false, "error" => "enter team id"));
} else {
    $stadium_id = $_GET['stadium_id']; 
    $date = $_GET['date'];

    $stm = $connect->prepare("SELECT slot,Team1_id,Team2_id,status FROM teamtoteammatchings WHERE date = ? AND stadium_id = ?");
    $stm->execute(array($date, $stadium_id));
    $matching_data = $stm->fetchAll(PDO::FETCH_ASSOC);

    $stm = $connect->prepare("SELECT slot FROM reservations WHERE date = ? AND stadium_id = ?");
    $stm->execute(array($date, $stadium_id));
    $reservation_data = $stm->fetchAll(PDO::FETCH_COLUMN);

    $stadium_data = array("reservations" => $reservation_data,"matching" => $matching_data);
    echo json_encode(array("status" => true, "data" => $stadium_data)); 
}
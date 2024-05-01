<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
$dataInput = json_decode(file_get_contents('php://input'), true);
if (empty($dataInput['date']) || empty($dataInput['id'])) {
    echo json_encode(array("status" => false, "error" => "enter id and date"));
} else {
    $stm = $connect->prepare("UPDATE `actorpersonalinfos`,players SET actorpersonalinfos.b_date = ? WHERE actorpersonalinfos.id = players.actor_personal_infos_id AND players.id = ?");
    $stm->execute(array($dataInput['date'], $dataInput['id']));
    $temp = $stm->fetch(PDO::FETCH_COLUMN);
    $isValed = $stm->rowCount();
    if ($isValed > 0) {
        echo json_encode(array("status" => true));
    } else {
        echo json_encode(array("status" => false));
    }
}
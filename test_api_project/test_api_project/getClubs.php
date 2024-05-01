<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['city_id'])) { 
    echo json_encode(array("status" => "-1", "error" => "enter city name"));
} else {
    $city = $_GET['city_id'];
    $stm = $connect->prepare("SELECT clubs.id,clubs.name,clubs.address FROM `clubs` WHERE clubs.location_id  = ? ;");
    $stm->execute(array($city));
    $dbData = $stm->fetchAll(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if ($isValed > 0) {
        for ($i = 0; $i < $isValed; $i++) {
            $stm = $connect->prepare("SELECT sporttypes.SportType FROM clubsports,sporttypes WHERE sporttypes.id = clubsports.sport_type_id AND clubsports.club_id = ?");
            $stm->execute(array($dbData[$i]['id']));
            $sportsData = $stm->fetchAll(PDO::FETCH_COLUMN);
            $dbData[$i]['sports'] = $sportsData;
        }
        echo json_encode(array("status" => "0", "data" => $dbData , "test" => $isValed));
    } else {
        echo json_encode(array("status" => "-2", "error" => "No clubs in this city"));
    }
}
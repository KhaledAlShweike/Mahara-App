<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['q']) || empty($_GET['location_id'])) {
    echo json_encode(array("status" => "-1", "error" => "enter query"));
} else {
    $query = "%" . $_GET['q'] . "%";
    $locationID = $_GET['location_id'];
    $stm = $connect->prepare("select clubs.id,clubs.name,clubs.address from clubs where clubs.location_id = ? AND name like ? order by  clubs.name");
    $stm->execute(array($locationID,$query));
    $searchResult = $stm->fetchAll(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if ($isValed > 0) {
        for ($i = 0; $i < $isValed; $i++) {
            $clubID = $searchResult[$i]['id'];
            $stm = $connect->prepare("SELECT sporttypes.SportType FROM clubsports,sporttypes WHERE sporttypes.id = clubsports.sport_type_id AND clubsports.club_id = ?");
            $stm->execute(array($clubID));
            $sportsData = $stm->fetchAll(PDO::FETCH_COLUMN);
            $searchResult[$i]['sports'] = $sportsData;
        }
        echo json_encode(array("status" => "0", "data" => $searchResult));
    } else {
        echo json_encode(array("status" => "1", "error" => "no data"));
    }
}
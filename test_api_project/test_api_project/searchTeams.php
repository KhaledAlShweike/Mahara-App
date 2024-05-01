<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_GET['q'])) {
    echo json_encode(array("status" => "-1", "error" => "enter query"));
} else {
    $query = "%" . $_GET['q'] . "%";
    $stm = $connect->prepare("select teams.name,teams.id,sporttypes.SportType from teams,sporttypes where sporttypes.id = teams.sport_type_id AND teams.name like ? order by  name");
    $stm->execute(array($query));
    $searchResult = $stm->fetchAll(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if ($isValed > 0) {
        echo json_encode(array("status" => "0", "data" => $searchResult));
    } else {
        echo json_encode(array("status" => "1", "error" => "no data"));
    }
}
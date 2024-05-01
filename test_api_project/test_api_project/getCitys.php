<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');

$stm = $connect->prepare("SELECT `name`,id FROM `locations`");
$stm->execute();
$dbData = $stm->fetchAll(PDO::FETCH_ASSOC);
$isValed = $stm->rowCount();
if ($isValed > 0) {
    echo json_encode(array("status" => "0", "data" => $dbData));
}
else {
    echo json_encode(array("status" => "-1", "erroe" => "no data"));
}
<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if(empty($_GET['club_id']) || empty($_GET['sport_id'])){
    echo json_encode(array("status" => "-1" , "error" => "enter player id"));
}else{
    $clubID = $_GET['club_id'];
    $SportID = $_GET['sport_id'];
    $stm = $connect->prepare("SELECT stadiums.name, stadiums.price , stadiums.discount, stadiums.id , sporttypes.SportType  FROM stadiums,sporttypes WHERE stadiums.club_id = ? AND sporttypes.id = stadiums.sport_type_id AND stadiums.sport_type_id = ?");
    $stm->execute(array($clubID,$SportID));
    $clubStadums = $stm->fetchAll(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if($isValed > 0){
        echo json_encode(array("status" => "0","data" => $clubStadums));
    }else{
        echo json_encode(array("status" => "1" , "error" => "no data"));
    }
}
<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
if (empty($_POST['phone']) || empty($_POST['email'])) {
    echo json_encode(array("status" => false, "error" => "Enter phone and email "));
} else {
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $stm = $connect->prepare("SELECT COUNT(*) FROM `actorpersonalinfos` WHERE phone_number = ? OR email = ? ");
    $stm->execute(array($phone, $email));
    $isValed = (int)$stm->fetch(PDO::FETCH_COLUMN);
    if($isValed > 0){
        echo json_encode(array("status" => false));
    }else{
        echo json_encode(array("status" => true));
    }
}
<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
$stm = $connect->prepare("SELECT * FROM actor_personal_infos");
$stm->execute();
$user = $stm->fetchAll(PDO::FETCH_ASSOC);
$count = $stm->rowCount();
if($count < 1){
    echo json_encode(-1);
}
else{
    echo json_encode($user);
}
?>
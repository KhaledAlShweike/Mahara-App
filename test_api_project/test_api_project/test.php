<?php
/*
include "connect.php";
$stm = $connect->prepare("INSERT INTO `reports`(`title`, `content`) VALUES ('[value-1]','[value-2]')");
$stm->execute();
$teamData = $stm->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(array("data" => $teamData));
*/
//INSERT INTO `reports`(`title`, `content`) VALUES ('[value-1]','[value-2]');


$pass = password_hash('123@AsdA',PASSWORD_DEFAULT);
echo $pass;

?>
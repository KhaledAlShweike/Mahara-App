<?php 
$dns = "mysql:host=localhost;dbname=mahara_app";
$user = "root";
$pass = "AIU@201910229";
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
); 
try{
    $connect = new PDO($dns, $user, $pass, $option);
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
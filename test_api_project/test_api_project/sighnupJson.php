<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');
$dataInput = json_decode(file_get_contents('php://input'), true);
if (empty($dataInput['first_name']) || empty($dataInput['last_name']) || empty($dataInput['phone_number']) || empty($dataInput['password']) || empty($dataInput['gender'])) {
    echo json_encode(array("status" => false, "error" => "Enter all parameters"));
} else {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone_number'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $email = null;
    $birthDate = null;
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (!empty($_POST['birth_date'])) {
        $birthDate = empty($_POST['birth_date']);
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stm = $connect->prepare("INSERT INTO `actorpersonalinfos`(`first_name`, `last_name`, `phone_number`, `email`, `password`, `b_date`, `gender`) VALUES (?,?,?,?,?,?,?)");
    $stm->execute(array($firstName, $lastName, $phoneNumber, $email, $hashedPassword, $birthDate, $gender));
    $dbData = $stm->fetchAll(PDO::FETCH_ASSOC);
    $isValed = $stm->rowCount();
    if($isValed > 0){
        echo json_encode(array("status" => true));
    }else{
        echo json_encode(array("status" => false));
    }
}

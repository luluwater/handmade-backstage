<?php
session_start();
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

$newUser =[
    ':account'=>$_POST["account"],
    ':password'=>$password=$_POST["password"],
    ':name'=>$_POST["name"], 
    ':email'=>$_POST["email"],
    ':phone'=>$_POST["phone"],
    ':birthday'=>$_POST["birthday"],
    ':address'=>$_POST["address"],
    ':gender'=>$_POST["gender"],
];

$account=$_POST["account"];
$email=$_POST["email"];
$sqlCheck = "SELECT * FROM user WHERE account=? AND email=? ";
$stmt = $db_host->prepare($sqlCheck);
$stmt->execute([$account, $email]);
$memberExist = $stmt->rowCount();

if ($memberExist > 0) {
    $row = $stmt->fetch();
    $user = [
        "account" => $row["account"],
        "email" => $row["email"]
    ];
    try {
    $_SESSION["user"] = $user;
    header("location: sign-up-member.php");
    } 
catch (PDOException $e) {
    echo $e->getMessage();
    }
}

if ($memberExist == 0) {
    $now = date("Y-m-d H:i:s");
    $password=md5($password);
    $sql = "INSERT INTO user 
    (create_time, account, password, name, email, phone, birthday, address, gender, state) VALUES ( '$now', :account, :password, :name, :email, :phone, :birthday, :address, :gender, 1)";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute($newUser);
        echo "註冊成功";
    } catch (PDOException $e) {
        echo "預處理陳述式執行失敗！ <br/>";
        echo "Error: " . $e->getMessage() . "<br/>";
        $db_host = NULL;
        exit;
    }
}   
?>
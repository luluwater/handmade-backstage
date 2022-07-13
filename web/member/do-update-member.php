<?php
//連線路徑調整===========================================
if(!isset($_POST["id"])){
    echo "沒有帶資料";
    exit;
}
require("../../db-connect.php");
//=======================================================

$id=$_POST["id"];

$input = [
    ':id' => $_POST["id"],
    ':state' => $_POST["user_state_name"],
    ':name' => $_POST["name"],
    ':gender' => $_POST["gender"],
    ':email' => $_POST["email"],
    ':address' => $_POST["address"],
    ':phone' => $_POST["phone"]
];

$sql = $db_host->prepare("UPDATE user SET name = :name, email= :email, phone = :phone, address = :address, gender = :gender, state = :state WHERE id=:id");
try { 
    $sql->execute($input); 
    echo "資料修改完成";

} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

//路徑調整 ============================================= 
header("location: member-list.php?id=$_POST[id]");
//====================================================== 



//0713
$id=$_POST["id"];

$input = [
    ':id' => $_POST["id"],
    ':state' => $_POST["user_state_name"],
    ':name' => $_POST["name"],
    ':gender' => $_POST["gender"],
    ':email' => $_POST["email"],
    ':address' => $_POST["address"],
    ':phone' => $_POST["phone"]
];

//驗證是否已註冊
$email=$_POST["email"];
$sqlCheck = "SELECT * FROM user WHERE email=?";
$stmt = $db_host->prepare($sqlCheck);
$stmt->execute([$email]);
$memberExist = $stmt->rowCount();

if ($memberExist > 0) {
    $row = $stmt->fetch();
    $user = [
        "email" => $row["email"]
    ];
    try {
    $_SESSION["user"] = $user;
    header("location: member-list.php?id=$_POST[id]");
    } 
catch (PDOException $e) {
    echo $e->getMessage();
    }
}

//註冊
if ($memberExist == 0) {
    $sql = $db_host->prepare("UPDATE user SET name = :name, email= :email, phone = :phone, address = :address, gender = :gender, state = :state WHERE id=:id");
    try { 
        $sql->execute($input); 
        echo "資料修改完成";
    
    } catch (PDOException $e) {
        echo "預處理陳述式執行失敗！ <br/>";
        echo "Error: " . $e->getMessage() . "<br/>";
        $db_host = NULL;
        exit;
    }
}   
//路徑調整 ============================================= 
header("location: member-list.php?id=$_POST[id]");
//====================================================== 

?>
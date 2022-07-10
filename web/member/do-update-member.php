<?php
//連線路徑調整===========================================
if(!isset($_POST["id"])){
    echo "沒有帶資料";
    exit;
}
require("../../db-connect.php");
//=======================================================

$sql = "SELECT user.*, user_state_category.name AS user_state_name FROM user
JOIN user_state_category ON user.state = user_state_category.id";
$result= $db_host->prepare($sql);
$result->execute();

$input = [
    ':id' => $_POST["id"],
    ':state' => $_POST["user_state_name"],
    ':name' => $_POST["name"],
    ':gender' => $_POST["gender"],
    ':email' => $_POST["email"],
    ':address' => $_POST["address"],
    ':phone' => $_POST["phone"]
];

$result = $db_host->prepare("UPDATE user SET name = :name, email= :email, phone = :phone, address = :address, gender = :gender, state = :state WHERE id=:id");
try { 
    $result->execute($input); 
    echo "資料修改";

} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

//$db_host = NULL;

//路徑調整 ============================================= 
header("location: member-list.php?id=$_POST[id]");
//====================================================== 

?>
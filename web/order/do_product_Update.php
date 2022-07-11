<?php
if(!isset($_POST["name"])){
    echo "沒有資料";
    exit;
}

require_once("../../db-connect.php");


$id=$_POST["id"];
$name=$_POST["name"];
$phone=$_POST["phone"];
$address = $_POST["address"];
$payment_state_id = $_POST["payment_state_id"];
$order_state_id=$_POST["order_state_id"];
// echo $name;

$sql = $db_host->prepare("UPDATE product_order SET name='$name',phone='$phone',address='$address' ,payment_state_id = '$payment_state_id',order_state_id='$order_state_id' WHERE id = '$id'");

// echo $sql;

try {
    $sql->execute();
    echo "修改完成";


} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header("location: product_order_detail.php?id=".$id); //儲存後返回的頁面
?>
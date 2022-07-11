<?php
if(!isset($_POST["name"])){
    echo "沒有資料";
    exit;
}

require_once("../../db-connect.php");


$id=$_POST["id"];
// $name=$_POST["name"];
// $phone=$_POST["phone"];
// $order_state_id=$_POST["order_state_id"];
// echo $name;

$sql = $db_host->prepare("UPDATE category SET 
category_name='$category_name',category_en_name='$category_en_name',
  WHERE id = '$id'");

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

header("location: course_order_detail.php?id=".$id); //儲存後返回的頁面
?>
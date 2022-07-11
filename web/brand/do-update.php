<?php

require_once("../../db-connect.php");

if (isset($_POST["name"])) {
    $order = $_POST["name"];
    echo $order;
}


$sql = $db_host->prepare("UPDATE category SET 
category_name='$category_name',category_en_name='$category_en_name',
  WHERE id = '$id'");
// $sql= "INSERT INTO category (id, category_name, category_en_name`, `valid`) 
// VALUES ('7', '7', '7', '1')";
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

// header("location: course_order_detail.php?id=".$id); //儲存後返回的頁面
?>
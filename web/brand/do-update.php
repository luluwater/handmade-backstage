<?php

require_once("../../db-connect.php");

if (isset($_GET["name"])) {
    $order = $_GET["name"];
    echo $order;
}
//定義name值 變數= get or post 取德的name值
$id=$_GET["id"];
$category_name=$_GET["categoryName"];
$category_en_name=$_GET["categoryNO1"];

// echo $id ;
// exit;

$sql = $db_host->prepare("UPDATE category SET 
category_name='$category_name',
category_en_name='$category_en_name'
  WHERE id = '$id'");


try {
    $sql->execute();
    echo "修改完成";
   

} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

//更新完回到這頁
header("location:brand-edit.php?id=$_GET[id]");

?>
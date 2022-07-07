<?php

require("../db-connect.php");

$data=[
    ':name'=>$_POST["name"],
    ':content'=>$_POST["content"],
    ':product_discount'=>$_POST["product_discount"],
    ':start_date'=>$_POST["start_date"],
    ':end_date'=>$_POST["end_date"],
];

$sql = "INSERT INTO discount 
(name, content, product_discount, start_date, end_date, state)
VALUES(:name, :content, :product_discount, :start_date, :end_date, 1)";

$stmt = $db_host->prepare($sql);


try {
    $stmt->execute($data);
    // echo "成功";
    
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
$id = $db_host->lastInsertId();

header("location: discount.php");
?>
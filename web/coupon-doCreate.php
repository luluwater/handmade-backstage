<?php

require("../db-connect.php");

$data=[
    ':name'=>$_POST["name"],
    ':content'=>$_POST["content"],
    ':coupon_discount'=>$_POST["coupon_discount"],
    ':amount'=>$_POST["amount"],
    ':discount_code'=>$_POST["discount_code"],
    ':start_date'=>$_POST["start_date"],
    ':end_date'=>$_POST["end_date"],
];

$sql="INSERT INTO coupon
(name, content, coupon_discount, amount, discount_code, start_date, end_date, state)
VALUES(:name, :content, :coupon_discount, :amount, :discount_code, :start_date, :end_date, 1)";

$stmt = $db_host->prepare($sql);

try {
    $stmt->execute($data);
    echo "成功";
    
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
$id = $db_host->lastInsertId();
// header("location: coupon.php");

?>
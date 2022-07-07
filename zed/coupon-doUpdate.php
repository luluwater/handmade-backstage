<?php

if(!isset($_POST["id"])){
    echo "沒有參數";
    exit;
}

require("../db-connect.php");

$data=[
    ':id'=>$_POST["id"],
    ':name'=>$_POST["name"],
    ':content'=>$_POST["content"],
    ':coupon_discount'=>$_POST["coupon_discount"],
    ':amount'=>$_POST["amount"],
    ':discount_code'=>$_POST["discount_code"],
    ':start_date'=>$_POST["start_date"],
    ':end_date'=>$_POST["end_date"],
    ':state'=>$_POST["state"],
];

$sql = "UPDATE coupon SET 
name=:name, content=:content, coupon_discount=:coupon_discount,
amount=:amount, discount_code=:discount_code, start_date=:start_date, end_date=:end_date, state=:state
WHERE id=:id";
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

header("location: coupon.php");

?>
<?php

if(!isset($_POST["id"])){
    echo "沒有參數";
    exit;
}

require("../db-connect.php");

$pay=$_POST["discount_type_id"]==1?null:$_POST["pay"];
$coupon_discount=$_POST["coupon_discount"]?$_POST["coupon_discount"]:$_POST["coupon_discount2"];

$data=[
    ':id'=>$_POST["id"],
    ':name'=>$_POST["name"],
    ':content'=>$_POST["content"],
    ':coupon_discount'=>$coupon_discount,
    ':amount'=>$_POST["amount"],
    ':discount_code'=>$_POST["discount_code"],
    ':start_date'=>$_POST["start_date"],
    ':end_date'=>$_POST["end_date"],
    ':state'=>$_POST["state"],
    ':discount_type_id'=>$_POST["discount_type_id"],
    ':pay'=>$pay,
];

$sql = "UPDATE coupon SET 
name=:name, content=:content, coupon_discount=:coupon_discount, amount=:amount, discount_code=:discount_code, 
start_date=:start_date, end_date=:end_date, state=:state,  discount_type_id=:discount_type_id, pay=:pay
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

header("location: coupon-preview.php?id=$_POST[id]");

?>
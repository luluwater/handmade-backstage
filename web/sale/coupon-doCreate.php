<?php
session_start();


if(!isset($_POST["id"])){
    echo "沒有參數啦!!";
    exit;
};

require("../../db-connect.php");

$pay=$_POST["discount_type_id"]==1?null:$_POST["pay"];
$coupon_discount=$_POST["coupon_discount"]?$_POST["coupon_discount"]:$_POST["coupon_discount2"];

$data=[
    ':name'=>$_POST["name"],
    ':content'=>$_POST["content"],
    ':coupon_discount'=>$coupon_discount,
    ':amount'=>$_POST["amount"],
    ':discount_code'=>$_POST["discount_code"],
    ':start_date'=>$_POST["start_date"],
    ':end_date'=>$_POST["end_date"],
    ':discount_type_id'=>$_POST["discount_type_id"],
    ':pay'=>$pay,

];

// ========== SESSION ==========

$discount_code=$_POST["discount_code"];
$sqlCheck= "SELECT * FROM coupon WHERE discount_code=? ";
$stmt = $db_host->prepare($sqlCheck);

    $stmt->execute([$discount_code]);
    $discountExist = $stmt->rowCount();

    if ($discountExist > 0) {
        $row = $stmt->fetch();
        $coupon = [
            "discount_code" => $row["discount_code"]
        ];
        try {
        $_SESSION["coupon"] = $coupon;
        header("location: coupon-create.php");
    }
 catch (PDOException $e) {
    echo $e->getMessage();
}
    }

    if ($discountExist == 0) {
$sql="INSERT INTO coupon
(name, content, coupon_discount, amount, discount_code, start_date, end_date, state, discount_type_id, pay)
VALUES(:name, :content, :coupon_discount, :amount, :discount_code, :start_date, :end_date, 1, :discount_type_id, :pay)";

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
header("location: coupon.php");
    }
?>
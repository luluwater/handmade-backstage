<?php
session_start();

if(!isset($_POST["id"])){
    echo "沒有參數啦!!";
    exit;
};


require("../db-connect.php");

$pay=$_POST["discount_type_id"]==1?null:$_POST["pay"];
$product_discount=$_POST["product_discount"]?$_POST["product_discount"]:$_POST["product_discount2"];

$data=[
    ':name'=>$_POST["name"],
    ':content'=>$_POST["content"],
    ':product_discount'=>$product_discount,
    ':start_date'=>$_POST["start_date"],
    ':end_date'=>$_POST["end_date"],
    ':discount_type_id'=>$_POST["discount_type_id"],
    ':pay'=>$pay,
];

// ========== SESSION ==========

$name=$_POST["name"];
$sqlCheck= "SELECT * FROM discount WHERE name=? ";
$stmt = $db_host->prepare($sqlCheck);

    $stmt->execute([$name]);
    $discountExist = $stmt->rowCount();
    
    if ($discountExist > 0) {
        $row = $stmt->fetch();
        $discount = [
            "name" => $row["name"]
        ];
        try {
        $_SESSION["discount"] = $discount;
        header("location: discount-create.php");
    }
 catch (PDOException $e) {
    echo $e->getMessage();
}

    }
if ($discountExist == 0) {


$sql = "INSERT INTO discount 
(name, content, product_discount, start_date, end_date, state, discount_type_id, pay)
VALUES(:name, :content, :product_discount, :start_date, :end_date, 1, :discount_type_id, :pay)";


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

header("location: discount-preview.php?id=$_POST[id]");

}
?>
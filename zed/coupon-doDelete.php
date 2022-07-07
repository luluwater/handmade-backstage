<?php

if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}

require("../db-connect.php");

$sql = "UPDATE coupon SET state=:state WHERE id=:id";
$stmt = $db_host->prepare($sql);

$change=[
    ':id'=>$_GET["id"],
    ':state'=>0,
];
try {
    $stmt->execute($change);
    // echo "成功";
    
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header("location: coupon.php");
?>
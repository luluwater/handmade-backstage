<?php

if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}

require("../db-connect.php");

$sql = "UPDATE discount SET 
(`name`, `content`, `product_discount`, `start_date`, `end_date`)
VALUES(?, ?, ?, ?, ?)
WHERE id=:id";
$stmt = $db_host->prepare($sql);

$values = [
    $_POST["name"],
    $_POST["content"],
    $_POST["product_discount"],
    $_POST["start_date"],
    $_POST["end_date"],
];


try {
    $stmt->execute($values);
    echo "資料修改成功";
    
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

// $sth->execute([$name, $content, $product_discount, $start_date, $end_date]);
// header("location: discount.php");
?>
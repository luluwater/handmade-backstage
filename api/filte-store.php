<?php
require("../db-connect.php");
$category_id=$_GET["category_id"];

$stmt=$db_host->prepare("SELECT store.id,store.category_id,store.name FROM store WHERE store.category_id = ?");

try{    
    $stmt->execute([$category_id]);
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $data=[
        "stores"=>$rows
    ];
    echo json_encode($data);
    
}catch (PDOException $e){
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

$db_host = NULL;
?>
<?php
require_once("../db-connect.php");



$blog_id=$_POST["blog_id"];
    
$stmtDelete=$db_host->prepare("UPDATE blog SET valid=0 WHERE id='$blog_id'");

$stmt=$db_host->prepare("SELECT * FROM blog INNER JOIN category ON blog.id=category.id  WHERE blog.valid=1  ORDER BY create_time DESC");

try {
    $stmt->execute();
    $stmtDelete->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}


    echo json_encode($result);
  
    
    exit;

?>
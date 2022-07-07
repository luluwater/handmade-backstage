<?php

require_once("../db-connect.php");

$stmt=$db_host->prepare("SELECT * FROM blog");

try {
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    var_dump($rows);
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

$db_host = NULL;


?>
<?php

require_once("../../db-connect.php");

$id=$_POST["commentId"];

echo $id;

$stmtComments=$db_host->prepare("UPDATE comment SET valid=0 WHERE id='$id'");

try {
    $stmtComments->execute();
    echo "刪除! <br/>";
    
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header('Location:'. $_SERVER['HTTP_REFERER']);




?>
<?php
<<<<<<< HEAD

=======
>>>>>>> e7980d3697239070bb18aab6e3091609800c4f96
require_once("../../db-connect.php");

$id=$_GET["id"];
$PreviousPage=$_GET["page"];
$pageView=$_GET["pageView"];
$order=$_GET["order"];

<<<<<<< HEAD
=======

>>>>>>> e7980d3697239070bb18aab6e3091609800c4f96
$sql = $db_host->prepare("UPDATE course_order SET valid=0 WHERE id='$id'");

try {
    $sql->execute();
    echo "刪除! <br/>";
    
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header('Location:'. $_SERVER['HTTP_REFERER']);


?>
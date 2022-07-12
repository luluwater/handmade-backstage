<?php
require_once("../../db-connect.php");

if (isset($_POST["name"])) {
    $order = $_POST["name"];
    echo $order;
}

//更新valid 會變成0 導致選項消失
$sql = $db_host->prepare("UPDATE category SET valid=0 WHERE  id='$order'");



try {
    $sql->execute();
    echo "刪除! <br/>";
    
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header("Location:brand-list.php");


?>
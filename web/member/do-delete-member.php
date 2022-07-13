<?php

$id=$_GET["id"];
if(!isset($_GET["id"])){
    echo "沒有帶資料";
    exit;
} else {
    echo $_GET["id"];
}



//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

$sqlDelete  = "DELETE FROM user WHERE id='$id'";
$stmt = $db_host->prepare($sqlDelete);

try {
    $stmt ->execute();
    echo "刪除! <br/>";
    
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

//路徑調整 ============================================= 
header("location: members-list.php?");
//====================================================== 

?>
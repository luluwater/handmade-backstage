<?php
require_once("../db-connect.php");


$checked_id=$_POST["checked"];
$type=$_POST["type"];
// $state=0;
if(!($checked_id||$type)){
    exit;
}
if(isset($_POST["上架"])){
    $state=1;
}else if(isset($_POST["下架"])){
    $state=0;
}
foreach($checked_id as $id){
    switch($type){
        case "course":
            $stmt=$db_host->prepare("UPDATE course SET state=$state WHERE id=?");
            $stmt->execute([$id]);    
            break;
        case "product":
            $stmt=$db_host->prepare("UPDATE product SET state=$state WHERE id=?");
            $stmt->execute([$id]); 
            break;
    }    
}
// header("location: course.php?type=$type");
echo "<script>history.back(-1)</script>";
?>
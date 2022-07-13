<?php


require_once("../../db-connect.php");
$title = mysqli_real_escape_string($con, $_POST["blogTitle"]);
$content = mysqli_real_escape_string($con, $_POST["atricle_content"]);
$pubilshTime=$_POST["pubilshTime"];
$storeId=$_POST["store"];
$category=$_POST["category"];
echo $storeId;


$content = str_replace( '&', '&amp;',$content );



if(isset($_POST["save_data"])){
    $state=$_POST["save_data"];
}

if(isset($_POST["submit_data"])){
    $state=$_POST["submit_data"];
}

$stmt=$db_host->prepare("INSERT INTO blog(title,content,create_time,category_id, store_id,state,valid) VALUES ('$title','$content','$pubilshTime', '$category', '$storeId','$state',1)");

header('refresh:2; url=manage-blog.php');

try {
    $stmt->execute();
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
$db_host = NULL;


?>
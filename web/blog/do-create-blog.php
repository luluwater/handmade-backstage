<?php

if(isset($_POST["submit_data"])){
    require_once("../../db-connect.php");
    $title = mysqli_real_escape_string($con, $_POST["blogTitle"]);
    $content = mysqli_real_escape_string($con, $_POST["atricle_content"]);
    $pubilshTime=$_POST["pubilshTime"];
    $storeId=$_POST["store"];
    $category=$_POST["category"];
    $state=$_POST["submit_data"];
    $content = str_replace( '&', '&amp;',$content );
    echo $state;

    if(isset($_POST["isPublish"])){
        
    }
    
    if( $state=="發布"){
        $stmt=$db_host->prepare("INSERT INTO blog(title,content,create_time,category_id, store_id,state,valid) VALUES ('$title','$content','$pubilshTime', '$category', $storeId,'$state',1)");
        header('refresh:2; url=manage-blog.php');
        echo "發布成功";
    }
    else{
        header("Location:create-blog.php?未發表");
        exit();
    }
}else{
    header("Location:create-blog.php?invalidRequset");


}try {
    $stmt->execute();
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
$db_host = NULL;


?>
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

<<<<<<< HEAD
    if(isset($_POST["isPublish"])){
        
    }
    
    if( $state=="發布"){
        $stmt=$db_host->prepare("INSERT INTO blog(title,content,create_time,category_id, store_id,state,valid) VALUES ('$title','$content','$pubilshTime', '$category', $storeId,'$state',1)");
<<<<<<< HEAD
=======

>>>>>>> e7980d3697239070bb18aab6e3091609800c4f96
        header('refresh:2; url=manage-blog.php');
        echo "發布成功";
    }
    else{
        header("Location:create-blog.php?未發表");
        exit();
    }
}else{
    header("Location:create-blog.php?invalidRequset");
=======
$stmt=$db_host->prepare("INSERT INTO blog(title,content,create_time,category_id, store_id,state,valid) VALUES ('$title','$content','$pubilshTime', '$category', '$storeId','$state',1)");

// header('refresh:2; url=manage-blog.php');
>>>>>>> a91023d1164716daa64e8ab27c8d21aa8019b575

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
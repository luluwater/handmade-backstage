<?php
/**
 * 1. 標題
 * 2. 使用者 :後臺一律 0001 管理者
 * 3. 分類等等...
 * 4. 內文(包含圖片)我要在今天用完
 * 5. 是否發表 -->判斷式 如果是 on 就===發表。如果是空值 === 未發布
 * 6. 發表時間
 * 
 * ////
 * 新增按鈕按下後引導到 blog-page.php
 * 
 * sql 語法 $變數名 = "INSERT INTO blog (title,create_time,content,state,valid) VALUES ('$title','$create_time','$content','$state',1)"
 */

 
?>

<?php

if(isset($_POST["submit_data"])){

    require_once("../../db-connect.php");

    $title = mysqli_real_escape_string($con, $_POST["blogTitle"]);
    $content = mysqli_real_escape_string($con, $_POST["atricle_content"]);
    $pubilshTime=$_POST["pubilshTime"];
    $storeName=$_POST["store"];
    $category=$_POST["category"];
    $state=$_POST["submit_data"];
    echo $storeName;
    echo $state;
    echo $title ;
    echo $content;
    echo $pubilshTime;
    echo $category;

    if( $state=="發布"){
        $stmt=$db_host->prepare("INSERT INTO blog(title,content,create_time,category_id,state,valid) VALUES ('$title','$content','$pubilshTime', '$category', '$state',1)");
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

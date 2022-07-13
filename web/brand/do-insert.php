<?php
if(!isset($_POST["category-type"])){
    echo "沒有帶資料";
    exit; //不會直接點這個網址就可以更新自己的資料 設置這個函數的用意
}

require("../../db-connect.php");

//帶入表單中的name值 
$order=$_POST["order"];
$category=$_POST["category-type"];
$categoryEnglish=$_POST["category-type-en"];

//prepare 欲處理
// values 後面帶入的是:->等於是變數 代表欄位
$sql=$db_host->prepare("INSERT INTO 
category ( category_name, category_en_name)
 VALUES (:categoryNo1 , :categoryNo2)");

try {
    //這邊是去執行 類似php陣列 用=>胖箭頭
    $sql->execute([
        ":categoryNo1"=>$category,
        ":categoryNo2"=>$categoryEnglish
    ]);
    echo "刪除! <br/>";
    
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header("Location:brand-list.php");


?>
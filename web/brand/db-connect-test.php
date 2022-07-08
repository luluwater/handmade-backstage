<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "hand_db";
// $dbname = "my_test_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
//arr.length js .用來表達顯示陣列長度方法;
//php這邊.是用來字串連結
//兩者相等 php-> 受箭頭顯示東西的資訊 跟js .一樣
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}else{
    // echo "連線成功";
}

?>
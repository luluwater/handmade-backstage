<?php
if(!isset($_POST["name"])){
    echo "沒有資料";
    exit;
}

require("../db-connect.php");

$id=$_POST["id"];
$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
// echo $name;

$sql="UPDATE users SET name='$name',phone='$phone',email='$email' WHERE id='$id'";

// echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "修改完成";
} else {
    echo "修改失敗: " . $conn->error;
}

$conn->close();

header("location: user.php?id=".$id); //儲存後返回的頁面
?>
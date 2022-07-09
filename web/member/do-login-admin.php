<?php
session_start();
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

// if(!isset($_POST["account"])){
//     echo "請循正常管道進入本頁";
//     exit;
// }

$account=$_POST["account"];
$password=$_POST["password"];
$stmt=$db_host->prepare("SELECT * FROM administrator WHERE account = ? AND password = ?");

try {
    $stmt->execute([$account, $password]);
    $loginStatus = $stmt->rowCount();
    if($loginStatus === 0){
        if(isset($_SESSION["error"])){
            $times=$_SESSION["error"]["times"]++;
        } else {
            $times=1;
        }
        $dataError=array(
            "message"=>"帳號或密碼錯誤",
            "times"=>$times
        );
        $_SESSION["error"]=$dataError;
//連線路徑調整===========================================
        header("location: login-admin.php");
//=======================================================
    } 
    else {
        while($row=$stmt->fetch()){
            $dataUser=array(
                "account"=>$row["account"],
                "password"=>$row["password"],
            );
            unset($_SESSION["error"]);
            //$_SESSION["user"]=$dataUser;
//連線路徑調整===========================================
        header("location: ../example.php");
//======================================================    
        }
    }
        }catch(PDOException $e){
            echo "資料庫連結失敗<br>";
            echo "Eroor: ".$e->getMessage(). "<br>";
            exit;
    }
?>
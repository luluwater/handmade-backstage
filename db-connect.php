<?php  
$serverName="localhost";
$username="admin";
$password="12345";
$dbname="test";


try{
    $db_host=new PDO("mysql:host={$serverName};dbname={$dbname};
    charset=utf8",$username,$password);
}catch(PDOException $e){
    echo "資料庫連線失敗";
    echo "Error: ".$e->getMessage();
    exit;
}

?>



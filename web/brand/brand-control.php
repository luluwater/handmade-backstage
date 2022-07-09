<?php
//連線路徑調調整===========================================
// if(!isset($_POST["id"])){
//     echo "沒有帶資料";
//     exit;
// }
require("../../db-connect.php");
//=======================================================

// 測試連線
// try{
//     $db_host=new PDO("mysql:host={$serverName};dbname={$dbname};charset=utf8",$username,$password);
//     echo "成功";
        
// }catch(PDOException $e){
//     echo "資料庫連線失敗";
//     echo "Error: ".$e->getMessage();
//     exit;
// }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../css/style.css">
    
  </head>
  <body>
    
    <?php
    require("../main-menu.html");
    ?>
    <main>
        <div class="container-fluid ">
            <div class="d-flex justify-content-center mb-3">
           <p>管理分類</p>
            </div>
            <form action="" method="post" >
            <div class="mb-5">
                <label class="mb-1" for="">金工</label>
                <input type="text" class="form-control" 
                name="category">
            </div>
            <div class="mb-5">
                <label class="mb-1" for="">花藝</label>
                <input type="password" class="form-control"
                 name="category">
            </div>
            <div class="mb-5">
                <label class="mb-1" for="">陶藝</label>
                <input type="text" class="form-control" 
                name="category">
            </div>
             <div>
                <div class="d-flex justify-content-around">
                    <a class="button btn btn-main-color" href="login-admin.php">刪除</a>
                    <button class="button btn btn-main-color" type="submit">新增</button>
                 <!-- 這邊點心曾可以跳到另一個畫面然後類似老師
                 user.php註冊方式 或是
                  create-user.php輸入值帶到sql然後按確定新增成功 
                 就可以在創建button案確定返回這一頁
                然後這一夜就會新增一個新的類別 
                然後刪除也一樣 會顯示刪除成功
                -->
                </div>
            </div>
        
            </form>
    </div>
    </main>
    
  </body>
</html>
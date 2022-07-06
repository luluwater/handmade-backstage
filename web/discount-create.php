<?php

if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}

$id=$_GET["id"];

require("../db-connect.php");

$sql = "SELECT * FROM discount id=$id";

$result= $db_host->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$count=$result->rowCount();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>一般折扣-新增-手手</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/style.css">
        <style>
            form ul{
                position: relative;
                list-style-type: none;
                right: 30px;
            }
            form li{
                color: #3f3f3f;
            }
            .btn{
                color: #ffffff;
                font-size: 600;
            }
            .btn-cancel{
                background: #D7BAA5;
            }
            .btn-red{
                background: #D6624F;
            }
            .button{
                position: relative;
                right: 235px;
            }
        </style>
  </head>
  <body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <p class="title">編輯一般折扣</p>
            </div>
            <form action="doUpdate.php" method="POST">
                <div></div>
                    <ul>
                        <li>活動名稱</li>
                        <li><input type="text" class="form-control my-3" style="width: 1200px;" name="name"></li>
                        <li>活動簡介</li>
                        <li><input type="text" class="form-control my-3" style="width: 1200px; height:350px;" name="content"></li>
                        <li>折數</li>
                        <li><input type="text" class="form-control my-3" style="width: 1200px;" name="product_discount"></li>
                        <li>活動期間</li>
                        <li class="d-flex">
                            <input type="date" class="form-control my-3 me-3" style="width: 500px;" name="start_date">
                            <div class="pt-4">至</div>
                            <input type="date" class="form-control my-3 ms-3" style="width: 500px;" name="end_date">
                        </li>
                    </ul>
                    <div class="text-end me-5 button">
                        <a href="discount.php" class="btn btn-cancel mx-2">取消</a>
                        <button class="btn btn-red mx-2" type="submit">儲存</button>
                    </div>
            </form>
        </div>
    </main>
  </body>
</html>
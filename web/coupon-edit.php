<?php

if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}

$id=$_GET["id"];

require("../db-connect.php");

$sql = "SELECT * FROM coupon WHERE id=:id";

$result= $db_host->prepare($sql);
$result->execute([":id"=>$id]);
$row = $result->fetch();
$discountCount=$result->rowCount();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>優惠券-編輯-手手</title>
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
        <?php if($discountCount > 0):?>
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <p class="title">編輯優惠券</p>
            </div>
            <form action="coupon-doUpdate.php" method="POST" class="mb-3">
                <div></div>
                    <ul>
                        <input type="hidden" name="id" value="<?=$row["id"]?>">
                        <li>優惠券名稱</li>
                        <li><input type="text" class="form-control my-3" style="width: 1200px;" 
                        name="name" value="<?=$row["name"]?>"></li>
                        <li>優惠券簡介</li>
                        <li><textarea type="text" class="form-control my-3 content" style="width: 1200px; height:350px;" 
                        name="content"><?=$row["content"]?></textarea></li>
                        <li>折數</li>
                        <li><input type="text" class="form-control my-3" style="width: 1200px;" 
                        name="coupon_discount" value="<?=$row["coupon_discount"]?>"></li>
                        <div class="d-flex">
                            <div class="pe-4">
                                <li class="pt-4">發放張數</li>
                                <li><input type="text" class="form-control my-3" style="width: 500px;" 
                                name="amount" value="<?=$row["amount"]?>"></li>
                            </div>
                            <div class="ps-4">
                                <li class="pt-4">折扣碼</li>
                                <li><input type="text" class="form-control my-3" style="width: 500px;" 
                                name="discount_code" value="<?=$row["discount_code"]?>"></li>
                            </div>
                        </div>
                        <li>活動期間</li>
                        <li class="d-flex">
                            <input type="date" class="form-control my-3 me-3" style="width: 500px;" 
                            name="start_date" value="<?=$row["start_date"]?>">
                            <div class="pt-4">至</div>
                            <input type="date" class="form-control my-3 ms-3" style="width: 500px;" 
                            name="end_date" value="<?=$row["end_date"]?>">
                        </li>
                    </ul>
                    <div class="text-end me-5 button">
                        <a href="discount.php" class="btn btn-cancel mx-2">取消</a>
                        <button class="btn btn-red mx-2" type="submit">儲存</button>
                    </div>
            </form>
        </div>
    <?php else: ?>
        CANNOT FIND THE USER
    <?php endif; ?>
    </main>
  </body>
</html>
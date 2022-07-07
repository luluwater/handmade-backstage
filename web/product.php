<?php
require_once("../db-connect.php");

$stmt=$db_host->prepare("SELECT course.id,name,amount,price,sold_amount,state FROM course");
$stmt->execute();    
$rows=$stmt->fetchALL(PDO::FETCH_ASSOC);




?>
<!doctype html>
<html lang="tw-zh">

<head>
    <title>商品管理-手手</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <p class="title">課程管理</p>
                <p>顯示 
                  <select class="count-bg text-center" aria-label="Default select example">
                    <option value="1" selected>5</option>
                    <option value="2">10</option>
                  </select> 
                  筆數
                </p>
            </div>
            <?php require("./mod/search-bar.php") ?>
            <div class="text-end my-4">
              <a href="" class="text-dark m-2"><i class="fa-solid fa-trash m-2"></i>下架課程</a>
              <a href="creat-new-product.php" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增課程</a>
              
            </div>
            <table class="table">
              <thead class="table-head">
                <tr class="text-center">
                  <td class="col-1"><input type="checkbox" name="" id=""></td>
                  <td class="col">課程編號<i class="fa-solid fa-sort mx-2"></i></td>
                  <td class="col-3">課程名稱</td>
                  <td class="col-1">上線人數</td>
                  <td class="col-1">金額</td>
                  <td class="col-1">售出堂數</td>
                  <td class="col-1">上架</td>
                  <td class="col-1">收藏數<i class="fa-solid fa-sort mx-2"></i></td>
                  <td class="col-1">編輯</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach($rows as $row): ?>                  
                  <tr>
                    <td><input type="checkbox" name="" id=""></td>
                    <td><?=$row["id"]?></td>
                    <td><?=$row["name"]?></td>
                    <td><?=$row["amount"]?></td>
                    <td><?=$row["price"]?></td>
                    <td><?=$row["sold_amount"]?></td>
                    <td><?=$row["state"]?></td>
                    <td></td>
                    <td><a href="view-course.php?course=<?=$row["id"]?>"><i class="fa-solid fa-pen"></i></a></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
            <?php require("./mod/page-number.php") ?>
        </div>
    </main>
</body>

</html>
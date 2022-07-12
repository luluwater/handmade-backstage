<?php

require("../db-connect.php");



//========== sale_state_category 狀態類別資料表 ==========
$sqlState = "SELECT * FROM sale_state_category" ;
$resultState= $db_host->prepare($sqlState);
$resultState->execute();
$rowsState = $resultState->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["sale_state_category"])){
  $sale_state_category = $_GET["sale_state_category"];
  $sqlWhere="AND discount.state = $sale_state_category ";

}else{
  $sale_state_category="";
  $sqlWhere="";
}

//========== discount 主要的資料表 ==========

if(isset($_GET["keyword"])){
  $searchText = "'%" . $_GET["keyword"] . "%'";
  $sql = "SELECT discount.name, discount_type_id, product_discount, pay, start_date, end_date,
  sale_state_category.name AS sale_state_name FROM discount
  JOIN sale_state_category ON discount.state = sale_state_category.id  
  WHERE discount.state!=0 $sqlWhere AND discount.name LIKE $searchText ";
  $result= $db_host->prepare($sql);
} else {
  $sql = "SELECT discount.*, sale_state_category.name AS sale_state_name FROM discount
  JOIN sale_state_category ON discount.state = sale_state_category.id  
  WHERE discount.state!=0 $sqlWhere";
  $result= $db_host->prepare($sql);
}



$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$discountCount = count($rows);


?>

<!doctype html>
<html lang="en">
  <head>
    <title>doSearch</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style-sale.css">
        <style>
          tbody td{
            vertical-align: middle;
          }
          tbody td a{
            color: #D7BAA5;
          }
          tbody td a:hover{
            vertical-align: middle;
            color: #D6624F;
          }
          .active{
            background-color: #D6624F;
          }
          .btn{
                color: #ffffff;
                font-size: 600;
          }
        </style>
  </head>
  <body>

  <?php
  require("./main-menu.html");
  ?>
    <main>

<!-- ========== 搜尋、新增折扣 ========== -->
            <form action="discount-doSearch.php" method="get">
                <div class="row my-4">
                    <div class="col-8">
                    <input class="form-control mx-2 searchText" name="keyword" placeholder="搜尋活動名稱關鍵字">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-bg-color">搜尋</button>
                    </div>
                    <div class="col-2 text-end">
                        <a href="discount.php" class="btn btn-bg-color">返回列表</a>
                    </div>
                </div>
            </form>

<!-- ========== table ========== -->
            <table class="table">
              <thead class="table-head">
                <tr class="text-center">
                  <td class="col-3">活動名稱</td>
                  <td class="col-2">折扣內容</td>
                  <td class="col-3">活動期間</td>
                  <td class="col-2">狀態</td>
                  <td class="col-1">操作</td>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($rows as $row): ?>
                  <tr class="text-center">
                    <td><?=$row["name"]?></td>
                    <td>
                      <?php if($row["discount_type_id"]==1):?>
                        原價 x <?=$row["product_discount"]?>
                      <?php elseif($row["discount_type_id"]==2):?>
                        滿 <?=$row["pay"]?> 折 <?=$row["product_discount"]?>
                    <?php endif ;?>

                    </td>
                    <td><?=$row["start_date"]?> - <?=$row["end_date"]?></td>
                    <td><?=$row["sale_state_name"]?></td>
                    <td>
                        <a href="discount-edit.php?id=<?=$row["id"]?>" name="edit">編輯</a><br>
                        <a href="discount-doDelete.php?id=<?=$row["id"]?>" name="delete">刪除</a>
                    </td>
                  </tr>
              <?php endforeach; ?>
              </tbody>
            </table>

    </main>
</body>

</html> 
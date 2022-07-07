<?php
require("../db-connect.php");


//========== sale_state_category 狀態類別資料表 ==========
$sqlState = "SELECT * FROM sale_state_category" ;
$resultState= $db_host->prepare($sqlState);
$resultState->execute();
$rowsState = $resultState->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["sale_state_category"])){
  $sale_state_category = $_GET["sale_state_category"];
  $sqlWhere="AND coupon.state = $sale_state_category ";

}else{
  $sale_state_category="";
  $sqlWhere="";
}

//========== coupon 主要的資料表 ==========
$sql = "SELECT coupon.*, sale_state_category.name AS sale_state_name FROM coupon
JOIN sale_state_category ON coupon.state = sale_state_category.id  
WHERE coupon.state!=0 $sqlWhere ORDER BY state ";
$result= $db_host->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="tw-zh">

<head>
    <title>優惠券-手手</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/style-sale.css">
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

        
        </style>
</head>

<body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
 <!-- ========== state bar 狀態頁籤 ========== -->
      <div class="mb-4">
        <?php // require("./mod/status-bar-coupon.php");?>
        <div class="title">一般折扣</div>
        <div><br></div>
        <div class="status-bar">
          <ul class="d-flex list-unstyled justify-content-around align-items-center m-0 h-100 ">

            <li class="status-button">
              <a href="coupon.php" class="status-a text-center fs-5
              <?php if($sale_state_category=="") echo "active"; ?>" name="all">全部活動</a>
            </li>
            <?php foreach($rowsState as $row): ?>
                    <li class="status-button">
                        <a class="status-a text-center fs-5
                        <?php
                        if($sale_state_category==$row["id"]) echo "active";
                        ?>" 
                        href="coupon.php?sale_state_category=<?=$row["id"]?>"><?=$row["name"]?></a>
                    </li>
        <?php endforeach; ?>
          </ul>
      </div> 
        
        <div class="container-fluid">
            <div class="d-flex justify-content-between pt-4">
              <p class="title"></p>
                <p>顯示 
                  <select class="count-bg text-center" aria-label="Default select example" method="POST">
                    <option value="1" name="p5" selected>5</option>
                    <option value="2" name="p10">10</option>
                  </select> 
                  筆數
                </p>
            </div>
            <?php require("./mod/search-bar-sale.php") ?>
            <div class="text-end my-4">
              <a href="coupon-create.php" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增優惠券</a>
            </div>
            <table class="table">
              <thead class="table-head">
                <tr class="text-center">
                  <td class="col-2">折扣碼</td>
                  <td class="col-3">優惠券名稱</td>
                  <td class="col-1">折數</td>
                  <td class="col-3">活動期間</td>
                  <td class="col-2">狀態</td>
                  <td class="col-1">操作</td>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($rows as $row): ?>
                  <tr class="text-center">
                    <td><?=$row["discount_code"]?></td>
                    <td><?=$row["name"]?></td>
                    <td><?=$row["coupon_discount"]?></td>
                    <td><?=$row["start_date"]?> - <?=$row["end_date"]?></td>
                    <td><?=$row["sale_state_name"]?></td>
                    <td>
                        <a href="coupon-edit.php?id=<?=$row["id"]?>" name="edit">編輯</a> <br>
                        <a href="coupon-doDelete.php?id=<?=$row["id"]?>" name="delete">刪除</a>
                    </td>
                  </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
            <?php require("./mod/page-number-sale.php") ?>
            
        </div>
    </main>
</body>

</html> 
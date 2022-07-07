<?php

require("../db-connect.php");

$sqlAll = "SELECT * FROM coupon";
$resultAll= $db_host->prepare($sqlAll);
$resultAll->execute();
$rowsAll = $resultAll->fetchAll(PDO::FETCH_ASSOC);
$discountAllCount = count($rowsAll);

//========== PAGE ==========
if(isset($_GET["page"])){
  $page=$_GET["page"];
}else{
  $page=1;
}

//取得每頁看到幾欄
$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']):5;

//每頁開始的id
$start=($page-1)*$pageView;


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
WHERE coupon.state!=0 $sqlWhere ORDER BY end_date DESC LIMIT $start , $pageView";
$result= $db_host->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$discountCount = count($rows);


//========== Page ==========
//開始的筆數
$startItem=($page-1)*$pageView+1;
//結束的筆數
$endItem=$page*$pageView;
if($endItem>$discountAllCount)$endItem=$discountAllCount;

//總筆數
$totalPage=ceil($discountAllCount / $pageView);

//上一頁
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
//下一頁
$nextPage = (($page + 1) >$totalPage) ?$totalPage: ($page + 1);


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
        <div class="title">優惠券</div>
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
 <!-- ========== 每頁顯示幾筆 ========== -->
                <form action="coupon.php" method="GET">
                <p>顯示
                  <select class="count-bg text-center" aria-label="Default select example"  name="pageView" onchange="submit();">
                    <option value="5" <?php if ($pageView == '5') print 'selected ';?>>5</option>
                    <option value="10" <?php if ($pageView == '10') print 'selected ';?>>10</option>
                  </select> 
                筆</p>
                </form>
                
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

 <!-- ========== 分頁 ========== -->
            <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example ">
            <ul class="pagination mt-4 px-5">
                <li class="page-item">
                    <a class="page-link" href="coupon.php?page=<?=$PreviousPage?>&pageView=<?=$pageView?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for($i=1; $i<=$totalPage;$i++): ?>
                <li class="page-item <?php if($page==$i)echo "active"?>"><a class="page-link" href="coupon.php?page=<?=$i?>&pageView=<?=$pageView?>"><?=$i?></a></li>
                <?php endfor; ?>



                <li class="page-item">
                    <a class="page-link" href="coupon.php?page=<?=$nextPage?>&pageView=<?=$pageView?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="mt-4 pt-2">第 <?=$startItem?> - <?=$endItem?> 筆 , 共 <?=$discountAllCount?> 筆資料</div>
        </div>   
        </div>
    </main>
</body>

</html> 
<?php

require("../db-connect.php");

//========== 抓取全部資料 ==========
$sqlAll = "SELECT * FROM discount WHERE discount.state!=0";
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
  $sqlWhere="AND discount.state = $sale_state_category ";

}else{
  $sale_state_category="";
  $sqlWhere="";
}

//========== discount 主要的資料表 & search ==========

if(isset($_GET["keyword"])){
  $searchText = "'%" . $_GET["keyword"] . "%'";
  $sqlSearch = "SELECT discount.name, discount_type_id, product_discount, pay, start_date, end_date,
  sale_state_category.name AS sale_state_name FROM discount
  JOIN sale_state_category ON discount.state = sale_state_category.id  
  WHERE discount.state!=0 $sqlWhere AND discount.name LIKE $searchText ";
  $keyword=$_GET["keyword"];
  $result= $db_host->prepare($sqlSearch);
  $resultSearch= $db_host->prepare($sqlSearch);
  $resultSearch->execute();
  $rowsSearch = $resultSearch->fetchAll(PDO::FETCH_ASSOC);
  $searchCount = count($rowsSearch);
} else {
  $sql = "SELECT discount.*, sale_state_category.name AS sale_state_name FROM discount
  JOIN sale_state_category ON discount.state = sale_state_category.id  
  WHERE discount.state!=0 $sqlWhere ORDER BY end_date DESC LIMIT $start , $pageView";
  $result= $db_host->prepare($sql);


}

$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$discountCount = count($rows);


// $sql = "SELECT discount.*, sale_state_category.name AS sale_state_name FROM discount
// JOIN sale_state_category ON discount.state = sale_state_category.id  
// WHERE discount.state!=0 $sqlWhere ORDER BY end_date DESC LIMIT $start , $pageView";
// $result= $db_host->prepare($sql);
// $result->execute();
// $rows = $result->fetchAll(PDO::FETCH_ASSOC);
// $discountCount = count($rows);

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
    <title>一般折扣-手手</title>
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
        <div class="title">一般折扣</div>
        <div><br></div>
        <div class="status-bar">
          <ul class="d-flex list-unstyled justify-content-around align-items-center m-0 h-100 ">
            <li class="status-button">
              <a href="discount.php" class="status-a text-center fs-5
              <?php if($sale_state_category=="") echo "active"; ?>" name="all">全部活動</a>
            </li>
            <?php foreach($rowsState as $row): ?>
            <li class="status-button">
              <a class="status-a text-center fs-5
              <?php
              if($sale_state_category==$row["id"]) echo "active";
              ?>" 
              href="discount.php?sale_state_category=<?=$row["id"]?>&pageView=<?=$pageView?>"><?=$row["name"]?></a>
            </li>
            <?php endforeach; ?>
          </ul>
      </div> 

      </div>
        <div class="container-fluid">

<!-- ========== 每頁顯示幾筆 ========== -->
            <div class="d-flex justify-content-between">
                <p class="title"></p>
                
                <form action="discount.php?" method="GET">
                  <p>顯示
                    <select class="count-bg text-center" aria-label="Default select example"  name="pageView" onchange=submit();>
                      <option value="5" <?php if ($pageView == '5') print 'selected ';?>>5</option>
                      <option value="10" <?php if ($pageView == '10') print 'selected ';?>>10</option>
                    </select> 
                  筆</p>
                </form>
            
            </div>
 
<!-- ========== 搜尋、新增折扣 ========== -->
            <form action="discount.php" method="get">
                <div class="row my-4">
                    <div class="col-4">
                    <input class="form-control mx-2 searchText" name="keyword" placeholder="活動名稱">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-bg-color">搜尋</button>
                    </div>
                </div>
            </form>
            <div class="text-end my-4">
              <a href="discount-create.php" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增折扣</a>
            </div>

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

 <!-- ========== 分頁 ========== -->
            <div class="d-flex justify-content-center">
            <?php if (isset($_GET['keyword'])) : ?>  
            <div class="mt-4 pt-2 d-flex">關鍵字<p class="text-danger fw-bold">&nbsp;<?=$_GET["keyword"]?>&nbsp;</p>的搜尋結果&nbsp;;&nbsp;共 <?=$searchCount?> 筆資料</div>
            <?php elseif (!isset($_GET['keyword']) && ($sale_state_category=="") ) : ?>  
              <nav aria-label="Page navigation example ">
                <ul class="pagination mt-4 px-5">
                    <!-- 上一頁 -->
                    <li class="page-item">
                        <a class="page-link" href="discount.php?page=<?=$PreviousPage?>&pageView=<?=$pageView?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <!-- 頁碼 -->
                    <?php for($i=1; $i<=$totalPage;$i++): ?>
                    <li class="page-item">
                      <a class="page-link  <?php if($page==$i)echo "active"?>" href="discount.php?page=<?=$i?>&pageView=<?=$pageView?>"><?=$i?></a>
                    </li>
                    <?php endfor; ?>
                    <!-- 下一頁 -->
                    <li class="page-item">
                        <a class="page-link" href="discount.php?page=<?=$nextPage?>&pageView=<?=$pageView?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
              </nav>
              <div class="mt-4 pt-2">第 <?=$startItem?> - <?=$endItem?> 筆 , 共 <?=$discountAllCount?> 筆資料</div>
              <?php else: ?>
              
              <?php endif; ?>
            </div>   
        </div>
    </main>
</body>

</html> 
<?php
require_once("../../db-connect.php");

if(isset($_GET["page"])){
    $page=$_GET["page"];
}else{
    $page=1;
}


//取得每頁看到幾欄
$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']):5;

//每頁開始的id
$start=($page-1)*$pageView;

//取得排序方式
$order = isset($_GET["order"]) ? $_GET["order"] : 1;


switch($order){
    case 1:
      $orderType="id ASC";
      break;
    case 2:
      $orderType="id DESC";
      break;
    case 3:
      $orderType="create_time ASC";
    break;
    case 4:
      $orderType="create_time DESC";
    break;
  
    default:
      $orderType="id DESC";
  } 



$sqlAll = $db_host->prepare("SELECT * FROM course_order");
$sql = $db_host->prepare("SELECT * FROM course_order ORDER BY $orderType LIMIT $start , $pageView");

try {
    $sqlAll->execute();
    $rows = $sqlAll->fetchAll(PDO::FETCH_ASSOC);
    $orderCount = count($rows);

    $sql->execute();
    $orderPageCount = $sql->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}


//開始的筆數
$startItem=($page-1)*$pageView+1;
//結束的筆數
$endItem=$page*$pageView;
if($endItem>$orderCount)$endItem=$orderCount;

//總筆數
$totalPage=ceil($orderCount / $pageView);

//上一頁
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
//下一頁
$nextPage = (($page + 1) >$totalPage) ?$totalPage: ($page + 1);

?>
<!doctype html>
<html lang="tw-zh">

<head>
    <title>體驗課程-所有訂單</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/order-list-style.css">


    <style>



    </style>
</head>

<body>
    <?php
    require("../main-menu.html");
    ?>
    <main>
        <div class="d-flex justify-content-between ">
            <h2 class="main-h2 mt-3 ms-3">訂單-體驗課程</h2>
            <div class="d-flex justify-content-between align-items-center display-page-box">
                <p class="m-0">顯示</p>
                <form action="course_order-list.php" method="get" class="pageForm" class="text-center" >
                    <select name="pageView" id="" class="display-page form-select mx-1 " onchange="submit();">
                        <option value="5" <?php if ($pageView == '5') print 'selected '; ?>>5</option>
                        <option value="10" <?php if ($pageView == '10') print 'selected '; ?>>10</option>
                        <option value="15" <?php if ($pageView == '15') print 'selected '; ?>>15</option>

                    </select>
                </form>
         
                <p class="m-0">筆</p>
            </div> <!-- 第一行結束 -->

        </div>

        <!-- 篩選器開始 -->

        <div class="ms-3 mt-3">
            <form action="" method="get" class="d-flex">
                <select class="form-select search-filter">
                    <option selected value="order-id">訂單編號</option>
                    <option value="create_time">訂單日期</option>
                    <option value="name">訂購人</option>
                    <option value="order_state_id">訂單狀態</option>
                </select>

                <!-- 輸入搜尋 -->
                <input type="search" class="form-control mx-2 searchText hide" name="dateSearch" placeholder="請輸入搜尋關鍵字">

                <!-- 日期搜尋 -->
                <input type="date" class="form-control mx-2 searchDate " name="dateSearch">

                <!-- 訂單狀態搜尋 -->
                <select name="" id="" class="form-select mx-2 searchState hide">
                    <option selected value="">已付款</option>
                    <option selected value="">取消</option>

                </select>

                <button type="search" class="btn btn-bg-color" name="searchSubmit">搜尋</button>
            </form>
        </div>
        <!-- 篩選器結束 -->

        <!-- 訂單表單開始 -->
        <div class="d-flex justify-content-center">
            <table class="table table-hover mt-5 order-table">
                <thead class="order-th ">
                    <tr class="text-center order-title">

                        <td> <span class="d-flex justify-content-center align-items-center"> 訂單編號 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn"><a href="course_order-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=1" class="arrowBtn <?php if($order==1)echo "order-th-btn"?>"><i class="fa-solid fa-caret-up"></i></a> <a href="course_order-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=2"><i class="fa-solid fa-caret-down"></i></a></span></span></td>

                        <td> <span class="d-flex justify-content-center align-items-center"> 訂單日期 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn"><a href="course_order-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=3" class="arrowBtn"><i class="fa-solid fa-caret-up"></i></a> <a href="course_order-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=4"><i class="fa-solid fa-caret-down"></i></a></span></span></td>
                        <td>訂購人</td>
                        <td>總金額</td>
                        <td>訂單狀態</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orderPageCount as $row):?>
                    <tr class="text-center">
                            <td><?=$row["id"]?></td>
                            <td><?=$row["create_time"]?></td>
                            <td><?=$row["name"]?></td>
                            <td>總金額</td>
                            <td><?=$row["order_state_id"]?></td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <!-- 訂單表格結束 -->

        <!-- 頁碼開始 -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-5">
                <li class="page-item">
                    <a class="page-link" href="course_order-list.php?page=<?=$PreviousPage?>&pageView=<?=$pageView?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                
                <?php for($i=1; $i<=$totalPage;$i++): ?>
                <li class="page-item <?php if($page==$i)echo "active"?>"><a class="page-link" href="course_order-list.php?page=<?=$i?>&pageView=<?=$pageView?>&order=<?=$order?>"><?=$i?></a></li>
                <?php endfor; ?>



                <li class="page-item">
                    <a class="page-link" href="course_order-list.php?page=<?=$nextPage?>&pageView=<?=$pageView?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- 頁碼結束 -->


    </main>
</body>

</html>
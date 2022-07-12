<?php
require_once("../../db-connect.php");

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

isset(($_GET["searchType"]))?  $searchType = $_GET["searchType"] :$searchType = "course_order.id";

isset($_GET["keyword"])?$searchText = "'%" . $_GET["keyword"] . "%'":$_GET["keyword"] = "";

if (!isset($_GET["sBtn"])) {
    $_GET["sBtn"] = "";
}




// $urlParams = [];
// parse_str($_SERVER['QUERY_STRING'], $urlParams);
// print_r($_GET);

//取得每頁看到幾欄
$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']) : 5;

//每頁開始的id
$start = ($page - 1) * $pageView;

//取得排序方式
$order = isset($_GET["order"]) ? $_GET["order"] : 1;


switch ($order) {
    case 1:
        $orderType = "id ASC";
        break;
    case 2:
        $orderType = "id DESC";
        break;
    case 3:
        $orderType = "create_time ASC";
        break;
    case 4:
        $orderType = "create_time DESC";
        break;

    default:
        $orderType = "id DESC";
}




if ($_GET['sBtn'] == 's') {
    $sql = $db_host->prepare("SELECT course_order.*,order_staus.name AS order_staus FROM course_order JOIN order_staus ON course_order.order_state_id = order_staus.id 
    WHERE $searchType like $searchText AND valid=1 ORDER BY $orderType LIMIT $start , $pageView");

    // print_r($sql);
} else {
    $sql = $db_host->prepare("SELECT course_order.*,order_staus.name AS order_staus FROM course_order JOIN order_staus ON course_order.order_state_id = order_staus.id AND valid=1 ORDER BY $orderType LIMIT $start , $pageView");
}


$sqlAll = $db_host->prepare("SELECT * FROM course_order WHERE valid=1");



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
$startItem = ($page - 1) * $pageView + 1;
//結束的筆數
$endItem = $page * $pageView;
if ($endItem > $orderCount) $endItem = $orderCount;

//總筆數
$totalPage = ceil($orderCount / $pageView);

//上一頁
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
//下一頁
$nextPage = (($page + 1) > $totalPage) ? $totalPage : ($page + 1);

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
        .detailLink {
            padding: 5px 30px;
        }

        .trash {
            padding: 5px 30px;
        }
    </style>
</head>

<body>
    <?php
    require("../main-menu.html");
    ?>
    <main>
        <!-- 顯示筆數 -->
        <div class="d-flex justify-content-between ">
            <h2 class="main-h2 mt-3 ms-3">訂單-體驗課程</h2>
            <div class="d-flex justify-content-between align-items-center display-page-box">
                <p class="m-0">顯示</p>
                <form action="" method="get" class="pageForm" class="text-center">
                    <select name="pageView" id="" class="display-page form-select mx-1 " onchange="submit();">
                        <option value="5" <?php if ($pageView == '5') print 'selected '; ?>>5</option>
                        <option value="10" <?php if ($pageView == '10') print 'selected '; ?>>10</option>
                        <option value="15" <?php if ($pageView == '15') print 'selected '; ?>>15</option>

                    </select>
                </form>

                <p class="m-0">筆</p>
            </div>
            <!-- 顯示筆數結束 -->

        </div>

        <!-- 篩選器開始 -->

        <div class="ms-3 mt-3">
            <form action="course_order-list.php" method="get" class="d-flex">
                <select class="form-select search-filter" name="searchType" onchange="submit();">
                    <option value="course_order.id" <?php if ($searchType == 'course_order.id') print 'selected'; ?>>訂單編號</option>
                    <option value="create_time" <?php if ($searchType == 'create_time') print 'selected'; ?>>訂單日期</option>
                    <option value="course_order.name" <?php if ($searchType == 'course_order.name') print 'selected'; ?>>訂購人</option>
                    <option value="order_state_id" <?php if ($searchType == 'order_state_id') print 'selected'; ?>>訂單狀態</option>
                </select>

                <?php if ($searchType == 'course_order.id') : ?>
                    <input type="search" class="form-control mx-2 searchText" name="keyword" placeholder="請輸入搜尋關鍵字">
                <?php elseif ($searchType == 'create_time') : ?>
                    <input type="date" class="form-control mx-2 searchDate" name="keyword">
                <?php elseif ($searchType == 'course_order.name') : ?>
                    <input type="search" class="form-control mx-2 searchText" name="keyword" placeholder="請輸入搜尋關鍵字">
                <?php elseif ($searchType == 'order_state_id') : ?>
                    <select name="keyword" id="" class="form-select mx-2 searchState">
                        <option value="<?php if ($searchType == "order_state_id") echo "3" ?>">已付款</option>
                        <option value="<?php if ($searchType == "order_state_id") echo "5" ?>">取消</option>
                    </select>

                <?php endif ?>

                <button type="search" class="btn btn-bg-color" name="sBtn" value="s">搜尋</button>

            </form>
        </div>
        <!-- 篩選器結束 -->


        <!-- 訂單表單開始 -->
        <div class="d-flex justify-content-center">
            <table class="table table-hover mt-5 order-table">
                <thead class="order-th ">
                    <tr class="text-center order-title">

                        <td> <span class="d-flex justify-content-center align-items-center"> 訂單編號 
                            <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act">
                                <a href="course_order-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=1" class="arrowBtn <?php if($order==1)echo "arrow-active"?>">
                                <i class="fa-solid fa-caret-up arrow-color"></i></a> 
                                <a href="course_order-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=2" class="<?php if($order==2)echo "arrow-active"?>">
                                <i class="fa-solid fa-caret-down arrow-color">
                                </i></a></span></span></td>
                        <td> <span class="d-flex justify-content-center align-items-center"> 訂單編號 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act"><a href="course_order-list.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=1" class="arrowBtn <?php if ($order == 1) echo "arrow-active" ?>"><i class="fa-solid fa-caret-up arrow-color"></i></a> <a href="course_order-list.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=2" class="<?php if ($order == 2) echo "arrow-active" ?>"><i class="fa-solid fa-caret-down arrow-color"></i></a></span></span></td>

                        <td> <span class="d-flex justify-content-center align-items-center"> 訂單日期 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn"><a href="course_order-list.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=3" class="arrowBtn <?php if ($order == 3) echo "arrow-active" ?>"><i class="fa-solid fa-caret-up arrow-color"></i></a> <a href="course_order-list.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=4" class="<?php if ($order == 4) echo "arrow-active" ?>"><i class="fa-solid fa-caret-down arrow-color"></i></a></span></span></td>
                        <td>訂購人</td>
                        <td>總金額</td>
                        <td>訂單狀態</td>
                        <td>刪除</td>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderPageCount as $row) : ?>
                        <tr class="text-center">
                            <td class="col-auto"><a class="detailLink" href="course_order_detail.php?id=<?= $row["id"] ?>"><?= $row["id"] ?></a></td>
                            <td class="col-3"><?= $row["create_time"] ?></td>
                            <td class="col-2"><?= $row["name"] ?></td>
                            <td class="col-2">$<?= $row["total_amount"] ?></td>
                            <td class="col-2"><?= $row["order_staus"] ?></td>
                            <td class="col-1"><a class="trash delete-btn"><i class="fa-solid fa-trash-can trash"></i></a></td>
                            <!-- 是否確定刪除盒子 -->
                            <div class="confirm hide" id="confirm">
                                <div class="popup">
                                    <div class="close" id="close">X</div>
                                    <div class="content">
                                        <h3 class="confirm-h3">是否確定刪除?</h3>
                                        <div class="text-end">
                                        <a href="" class="btn btn-bg-color btn-cancel-color" id="cancelBtn">取消</a>
                                        <a href="do_course_order_delete.php?id=<?= $row["id"] ?>" class="btn btn-main-color " id="confirm-btn">確認</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 是否確定刪除盒子 -->
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <!-- 訂單表格結束 -->

        <!-- 頁碼開始 -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-5">
                <div class="d-flex">
                    <li class="page-item">
                        <a class="page-link" href="course_order-list.php?page=<?= $PreviousPage ?>&pageView=<?= $pageView ?>&order=<?= $order ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) echo "active" ?>"><a class="page-link" href="course_order-list.php?page=<?= $i ?>&pageView=<?= $pageView ?>&order=<?= $order ?>"><?= $i ?></a></li>
                    <?php endfor; ?>



                    <li class="page-item">
                        <a class="page-link" href="course_order-list.php?page=<?= $nextPage ?>&pageView=<?= $pageView ?>&order=<?= $order ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </div>


                <li class="px-5 py-2">
                    第<?= $startItem ?>- <?= $endItem ?>筆,共 <?= $orderCount ?> 筆資料
                </li>
            </ul>

        </nav>
        <!-- 頁碼結束 -->






    </main>

    <script>
        let deleteBtn = document.querySelectorAll(".delete-btn");
        let confirm = document.querySelector("#confirm");
        let close = document.querySelector("#close");
        let confirmBtn = document.querySelector("#confirm-btn");
        let cancelBtn = document.querySelector("#cancelBtn");

        for (let i = 0; i < deleteBtn.length; i++) {
            deleteBtn[i].addEventListener('click', () => {
                confirm.classList.remove('hide')
            })
        }

        close.addEventListener('click', () => {
            confirm.classList.add('hide')
        })
        confirmBtn.addEventListener('click', () => {
            confirm.classList.add('hide')
        })
        cancelBtn.addEventListener('click', () => {
            confirm.classList.add('hide')
        })
    </script>
</body>

</html>
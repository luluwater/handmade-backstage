<?php
require_once("../../db-connect.php");

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}



isset(($_GET["searchType"])) ?  $searchType = $_GET["searchType"] : $searchType = "product_order.id";
isset($_GET["keyword"]) ? $searchText = $_GET["keyword"] : $searchText = $_GET["keyword"] = "";


function orderLink($item, $cur_pageView, $order)
{
    isset(($_GET["searchType"])) ?  $searchType = $_GET["searchType"] : $searchType = "product_order.id";
    isset($_GET["keyword"]) ? $searchText = $_GET["keyword"] : $_GET["keyword"] = "";

    switch ($item) {
        case "nextPage":
            return  "product_order-list.php?pageView=$cur_pageView&order=$order&keyword=$searchText&searchType=$searchType";
            break;
        case "pageView":
            $cur_pageView = $cur_pageView == 10 ? 5 : 10;
            return  "product_order-list.php?pageView=$cur_pageView&order=$order&keyword=$searchText&searchType=$searchType";
            break;

        default:
            $order = $item;

            return  "product_order-list.php?pageView=$cur_pageView&order=$order&keyword=$searchText&searchType=$searchType";
            break;
    }
}



//取得每頁看到幾欄
$pageView = $_GET['pageView'] ?? 5;


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


if ($searchText != "" && $searchType != "") {
    $sqlWhere = "WHERE $searchType LIKE'%$searchText%' AND valid=1";
} else {
    $sqlWhere = "WHERE valid=1";
}


$sql = $db_host->prepare("SELECT product_order.*,order_staus.name AS order_staus ,payment.name AS payment_name, delivery.name AS delivery_name,payment_state.name AS payment_name 
FROM product_order 
JOIN order_staus ON product_order.order_state_id = order_staus.id 
JOIN payment ON product_order.payment_id = payment.id 
JOIN delivery ON product_order.delivery_id = delivery.id
JOIN payment_state ON product_order.payment_state_id = payment_state.id
$sqlWhere ORDER BY $orderType LIMIT $start , $pageView");


$sqlAll = $db_host->prepare("SELECT * FROM product_order $sqlWhere");


try {
    $sqlAll->execute();
    $rows = $sqlAll->fetchAll(PDO::FETCH_ASSOC);
    $orderCount = count($rows);

    $sql->execute();
    $orderPageCount = $sql->fetchAll(PDO::FETCH_ASSOC);
    // print_r($orderPageCount);
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
$theNextPage = (($page + 1) > $totalPage) ? $totalPage : ($page + 1);

?>

<!doctype html>
<html lang="tw-zh">

<head>
    <title>實體商品-所有訂單</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/order-list-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        

    <style>
        .detailLink {
            padding: 5px 30px;
        }

        .trash {
            padding: 5px 30px;
        }

        .searchState {
            width: 200px;
        }
        #p-order_active{
            background: var(--main-color);
            color: #fff;
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
            <h2 class="main-h2 mt-3 ms-3">訂單-實體商品</h2>
            <div class="d-flex justify-content-between align-items-center display-page-box">
                <p class="m-0">顯示</p>
                <form action="" method="get" class="pageForm" class="text-center">
                    <select name="pageView" class="display-page form-select mx-1 " id="pageView">
                        <option value="5" <?php if ($pageView == '5') print 'selected '; ?>>5</option>
                        <option value="10" <?php if ($pageView == '10') print 'selected '; ?>>10</option>

                    </select>
                </form>

                <p class="m-0">筆</p>
            </div>
            <!-- 顯示筆數結束 -->

        </div>

        <!-- 篩選器開始 -->

        <div class="ms-3 mt-3">
            <form action="product_order-list.php" method="get" class="d-flex">
                <select class="form-select search-filter" name="searchType" onchange="submit();">
                    <option value="product_order.id" <?php if ($searchType == 'product_order.id') print 'selected'; ?>>訂單編號</option>
                    <option value="create_time" <?php if ($searchType == 'create_time') print 'selected'; ?>>訂單日期</option>
                    <option value="product_order.name" <?php if ($searchType == 'product_order.name') print 'selected'; ?>>訂購人</option>
                    <option value="delivery_id" <?php if ($searchType == 'delivery_id') print 'selected'; ?>>配送方式</option>
                    <option value="payment_state_id" <?php if ($searchType == 'payment_state_id') print 'selected'; ?>>付款狀態</option>
                    <option value="order_state_id" <?php if ($searchType == 'order_state_id') print 'selected'; ?>>訂單狀態</option>
                </select>

                <?php if ($searchType == 'product_order.id') : ?>
                    <input type="search" class="form-control mx-2 searchText" name="keyword" placeholder="請輸入搜尋關鍵字">
                <?php elseif ($searchType == 'create_time') : ?>
                    <input type="date" class="form-control mx-2 searchDate" name="keyword">
                <?php elseif ($searchType == 'product_order.name') : ?>
                    <input type="search" class="form-control mx-2 searchText" name="keyword" placeholder="請輸入搜尋關鍵字">
                <?php elseif ($searchType == 'delivery_id') : ?>
                    <select name="keyword" id="" class="col-5 form-select mx-2 searchState">
                        <option value="">請選擇</option>
                        <option value="<?php if ($searchType == "delivery_id") echo "1" ?>">黑貓宅急便</option>
                        <option value="<?php if ($searchType == "delivery_id") echo "2" ?>" >7-11取貨付款</option>
                        <option value="<?php if ($searchType == "delivery_id") echo "3" ?>">7-11取貨不付款</option>
                    </select>
                <?php elseif ($searchType == 'payment_state_id') : ?>
                    <select name="keyword" id="" class="form-select mx-2 searchState">
                        <option value="">請選擇</option>
                        <option value="<?php if ($searchType == "payment_state_id") echo "1" ?>">已付款</option>
                        <option value="<?php if ($searchType == "payment_state_id") echo "2" ?>">未付款</option>
                        <option value="<?php if ($searchType == "payment_state_id") echo "3" ?>">已退款</option>
                    </select>
                <?php elseif ($searchType == 'order_state_id') : ?>
                    <select name="keyword" id="" class="form-select mx-2 searchState">
                        <option value="">請選擇</option>
                        <option value="<?php if ($searchType == "order_state_id") echo "1" ?>">未出貨</option>
                        <option value="<?php if ($searchType == "order_state_id") echo "2" ?>" >已出貨</option>
                        <option value="<?php if ($searchType == "order_state_id") echo "4" ?>" >完成</option>
                        <option value="<?php if ($searchType == "order_state_id") echo "5" ?>">取消</option>
                    </select>
                <?php endif ?>

                <button type="search" class="btn btn-bg-color">搜尋</button>

            </form>
        </div>
        <!-- 篩選器結束 -->


        <!-- 訂單表單開始 -->
        <div class="d-flex justify-content-center">
            <table class="table table-hover mt-5 order-table">
                <thead class="order-th ">
                    <tr class="text-center order-title">

                        <td> <span class="d-flex justify-content-center align-items-center"> 訂單編號 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act"><a href="<?= orderLink("1", $pageView, $order) ?>" class="arrowBtn <?php if ($order == 1) echo "arrow-active" ?>"><i class="fa-solid fa-caret-up arrow-color"></i></a> <a href="<?= orderLink("2", $pageView, $order) ?>" class="<?php if ($order == 2) echo "arrow-active" ?>"><i class="fa-solid fa-caret-down arrow-color"></i></a></span></span></td>

                        <td> <span class="d-flex justify-content-center align-items-center"> 訂單日期 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn"><a href="<?= orderLink("3", $pageView, $order) ?>" class="arrowBtn <?php if ($order == 3) echo "arrow-active" ?>"><i class="fa-solid fa-caret-up arrow-color"></i></a> <a href="<?= orderLink("4", $pageView, $order) ?>" class="<?php if ($order == 4) echo "arrow-active" ?>"><i class="fa-solid fa-caret-down arrow-color"></i></a></span></span></td>
                        <td>訂購人</td>
                        <td>總金額</td>
                        <td>配送方式</td>
                        <td>付款狀態</td>
                        <td>訂單狀態</td>
                        <td>刪除</td>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderPageCount as $row) : ?>
                        <tr class="text-center">
                            <td class="col-2"><a class="detailLink" href="product_order_detail.php?id=<?= $row["id"] ?>"><?= $row["id"] ?></a></td>
                            <td class="col-2"><?= $row["create_time"] ?></td>
                            <td class="col-2"><?= $row["name"] ?></td>
                            <td class="col-1">$<?= $row["total_amount"] ?></td>
                            <td class="col-2"><?= $row["delivery_name"] ?></td>
                            <td class="col-1"><?= $row["payment_name"] ?></td>
                            <td class="col-1"><?= $row["order_staus"] ?></td>
                            <td class="col-1"><a class="trash delete-btn" data-id=<?=$row["id"]?>><i class="fa-solid fa-trash-can trash"></i></a></td>

                        </tr>
                    <?php endforeach; ?>
                                        <!-- 是否確定刪除盒子 -->
                                        <div class="confirm hide" id="confirm">
                        <div class="popup">
                            <div class="close" id="close">X</div>
                            <div class="content">
                                <h3 class="confirm-h3">是否確定刪除?</h3>
                                <div class="text-end">
                                    <a href="" class="btn btn-bg-color btn-cancel-color" id="cancelBtn">取消</a>
                                    <a href="" class="btn btn-main-color " id="confirm-btn">確認</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 是否確定刪除盒子 -->
                    <div class="" id="black-box"></div>


                </tbody>
            </table>
        </div>
        <!-- 訂單表格結束 -->

        <!-- 頁碼開始 -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-5">
                <div class="d-flex">
                    <li class="page-item">
                        <a class="page-link" href="<?= orderLink("nextPage", $pageView, $order) ?>&page=<?= $PreviousPage ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) echo "active" ?>"><a class="page-link" href="<?= orderLink("nextPage", $pageView, $order) ?>&page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>



                    <li class="page-item">
                        <a class="page-link" href="<?= orderLink("nextPage", $pageView, $order) ?>&page=<?= $theNextPage ?>" aria-label="Next">
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
        const pageView = document.querySelector("#pageView");
        pageView.addEventListener("change", function() {
            console.log("test")
            window.location.assign("<?= orderLink("pageView", $pageView, $order) ?>");
        })


        let deleteBtn = document.querySelectorAll(".delete-btn");
        let confirm = document.querySelector("#confirm");
        let close = document.querySelector("#close");
        let confirmBtn = document.querySelector("#confirm-btn");
        let cancelBtn = document.querySelector("#cancelBtn");
        let blackBox = document.querySelector("#black-box");


        for (let i = 0; i < deleteBtn.length; i++) {
            deleteBtn[i].addEventListener('click', function() {
                let id = this.dataset.id;
                confirm.classList.remove('hide')
                blackBox.classList.add('black-box')
                confirm.classList.add('animate__animated')
                confirm.classList.add('animate__bounceIn')
                confirmBtn.href=`do_product_order_delete.php?id=${id}`
            })
        }

        close.addEventListener('click', () => {
            confirm.classList.add('hide')
            confirm.classList.remove('animate__bounceIn')
            blackBox.classList.remove('black-box')
        })
        confirmBtn.addEventListener('click', () => {
            confirm.classList.add('hide')
            blackBox.classList.remove('black-box')
            confirm.classList.remove('animate__bounceIn')
        })
        cancelBtn.addEventListener('click', () => {
            confirm.classList.add('hide')
            blackBox.classList.remove('black-box')
            confirm.classList.remove('animate__bounceIn')
        })
    </script>
</body>

</html>
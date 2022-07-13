<?php

require_once("../../db-connect.php");
$order = isset($_GET["order"]) ? $_GET["order"] : 1;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']) : 5;
$start = ($page - 1) * $pageView;
$status = isset($_GET["status"]) ? $_GET["status"] : "all";




switch ($order) {
    case 1:
        $orderType = "create_time DESC";
        break;
    case 2:
        $orderType = "create_time ASC";
        break;
    case 3:
        $orderType = "category_id DESC";
        break;
    case 4:
        $orderType = "category_id ASC";
        break;
    case 5:
        $orderType = "state DESC";
        break;
    case 6:
        $orderType = "state ASC";
        break;
    case 7:
        $orderType = "comment_amount DESC";
        break;
    case 8:
        $orderType = "comment_amount ASC";
        break;
    case 9:
        $orderType = "favorite_amount DESC";
        break;
    case 10:
        $orderType = "favorite_amount ASC";
        break;
    default:
        $orderType = "create_time ASC";
}


switch ($status) {
    case 'publish':
        $statusType = "發布";
        break;

    case 'unPublish':
        $statusType = "未發布";
        break;
}


if($status=="all"){
    $sql="SELECT blog.*,category.category_name FROM blog JOIN category ON blog.category_id = category.id WHERE blog.valid=1 ORDER BY $orderType LIMIT $start,$pageView";
}else{
    $sql="SELECT blog.*,category.category_name FROM blog JOIN category ON blog.category_id = category.id WHERE blog.valid=1 AND state='$statusType' ORDER BY $orderType LIMIT $start,$pageView";

}

$stmt = $db_host->prepare($sql);

$stmtCategory = $db_host->prepare("SELECT * FROM category");
$sqlAll = $db_host->prepare("SELECT * FROM blog WHERE valid=1");


try {
    $stmt->execute();
    $sqlAll->execute();
    $stmtCategory->execute();

    $rows = $sqlAll->fetchAll(PDO::FETCH_ASSOC);
    $blogStmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $categories = $stmtCategory->fetchAll(PDO::FETCH_ASSOC);
    $blogCount = count($rows);
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

$db_host = NULL;

$startItem = ($page - 1) * $pageView + 1;
$endItem = $page * $pageView;
if ($endItem > $blogCount) $endItem = $blogCount;
$totalPage = ceil($blogCount / $pageView);
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
$nextPage = (($page + 1) > $totalPage) ? $totalPage : ($page + 1);

?>


<!doctype html>
<html lang="en">

<head>
    <title>Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <head>

        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="./style/blog.css">
    </head>

    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        #blog_active {
            color: #fff;
            background: var(--main-color);
        }

        #blog_active a::before {
            content: "";
            height: 25px;
            width: 5px;
            background: #fff;
            position: absolute;
            top: 50%;
            transform: translate(-300%, -50%);
        }
    </style>
</head>

<body>

    <?php require("../main-menu.html"); ?>
    <main>
        <div class="title">文章管理</div>
        <div class="status-bar" id="status-bar">
            <ul class="d-flex list-unstyled justify-content-around align-items-center m-0 h-100">
                <li class="status-button ">
                    <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=<?= $order ?>&status=all" id="allAcritle" class="status-a text-center fs-5 <?php if ($status == "all") echo "active" ?>">全部文章</a>
                </li>
                <li class="status-button">
                    <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=<?= $order ?>&status=publish" id="publishAcritle" class="status-a text-center fs-5 <?php if ($status == "publish") echo "active" ?>">已發表</a>
                </li>
                <li class="status-button">
                    <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=<?= $order ?>&status=unPublish" id="hiddenAcritle" class="status-a text-center fs-5 <?php if ($status == "unPublish") echo "active" ?>">未發布</a>
                </li>

            </ul>
        </div>
        <div class="d-flex mt-4 justify-content-between">

            <!-- Filter start -->
            <div class="fs-6 container d-flex align-items-start justify-content-between w-50 ms-0 gap-5">
                <select name="searchType" class="select" id="searchType">
                    <option selected="selected" value="keyword" id="keyword">關鍵字</option>
                    <option value="date" id="date">日期</option>
                    <option value="category" id="category">分類</option>
                </select>
                <form class="w-100 rounded" id="searchTypeForm" action="filter-blog.php">
                    <input type="text" class="form-control fs-6" id="typeKeyword" placeholder="Search..." aria-label="search with text input field" name="typeKeyword">
                    <div class="d-flex gap-4 align-items-start d-none" id="typeDate" name="typeDate">
                        <input type="date" class="form-control fs-6" name="fromDate" id="fromDate">
                        <span class="mt-2">至</span>
                        <input type="date" class="form-control fs-6" name="toDate" id="toDate">
                        <a id="filterDateBtn" class="btn btn-main-color "><i class="fas fa-search"></i></a>
                    </div>

                    <select class="select-category rounded d-none w-75" id="typeCategory" name="typeCategory">
                        <option selected="selected" value="all">全部分類</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category["id"] ?>"><?= $category["category_name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>

            </div>
            <!-- Filter end -->


            <div class="d-flex align-items-start gap-3 w-25 justify-content-between ">
                <!-- Post New Article Router-->
                <div class="d-flex align-items-end">
                    <a href="create-blog.php" class="btn btn-main-color btn-sm ">+
                        <span class="fs-6 ms-3">新增</span></a>
                </div>
                <!--------------------------->
                <div class="d-flex gap-2">
                    <div class="mt-2">顯示</div>
                    <form action="manage-blog.php" method="get" class="pageForm" class="text-center">
                        <select name="pageView" id="" class="display-page form-select mx-1" onchange="submit();">
                            <option value="5" <?php if ($pageView == '5') print 'selected '; ?>>5</option>
                            <option value="10" <?php if ($pageView == '10') print 'selected '; ?>>10</option>
                            <option value="15" <?php if ($pageView == '15') print 'selected '; ?>>15</option>

                        </select>
                    </form>
                    <div class="mt-2">筆</div>
                </div>
            </div>
        </div>

        <!-- Articles -->

        <table class="table h-0 mt-4 mb-0 text-center" id="table">
            <thead class="table-head">
                <tr>
                    <td class="col-1 text-start"><span class="d-flex justify-content-center align-items-center"> 日期 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act"><a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=1&status=<?= $status ?>" class="arrowBtn <?php if ($order == 1) echo "arrow-active" ?>"><i class="fas fa-sort-up arrow-color"></i></a> <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=2&status=<?= $status ?>" class="<?php if ($order == 2) echo "arrow-active" ?>"><i class="fas fa-sort-down arrow-color"></i></a></span></span></td>
                    <td class="col-3 text-start">文章標題</td>
                    <td class="col-1 text-start"><span class="d-flex justify-content-center align-items-center"> 分類 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act"><a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=3&status=<?= $status ?>" class="arrowBtn <?php if ($order == 3) echo "arrow-active" ?>"><i class="fas fa-sort-up arrow-color"></i></a> <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=4&status=<?= $status ?>" class="<?php if ($order == 4) echo "arrow-active" ?>"><i class="fas fa-sort-down arrow-color"></i></a></span></span></td>
                    <td class="col-1 text-start"><span class="d-flex justify-content-center align-items-center"> 狀態 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act"><a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=5&status=<?= $status ?>" class="arrowBtn <?php if ($order == 5) echo "arrow-active" ?>"><i class="fas fa-sort-up arrow-color"></i></a> <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=6&status=<?= $status ?>" class="<?php if ($order == 6) echo "arrow-active" ?>"><i class="fas fa-sort-down arrow-color"></i></a></span></span></td>
                    <td class="col-1 text-start"><span class="d-flex justify-content-center align-items-center"> 留言 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act"><a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=7&status=<?= $status ?>" class="arrowBtn <?php if ($order == 7) echo "arrow-active" ?>"><i class="fas fa-sort-up arrow-color"></i></a> <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=8&status=<?= $status ?>" class="<?php if ($order == 8) echo "arrow-active" ?>"><i class="fas fa-sort-down arrow-color"></i></a></span></span></td>
                    <td class="col-1 text-start"><span class="d-flex justify-content-center align-items-center"> 收藏 <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act"><a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=9&status=<?= $status ?>" class="arrowBtn <?php if ($order == 9) echo "arrow-active" ?>"><i class="fas fa-sort-up arrow-color"></i></a> <a href="manage-blog.php?page=<?= $page ?>&pageView=<?= $pageView ?>&order=10&status=<?= $status ?>" class="<?php if ($order == 10) echo "arrow-active" ?>"><i class="fas fa-sort-down arrow-color"></i></a></span></span></td>
                    <td class="col-1 text-end">刪除</td>
                </tr>
            </thead>

            <tbody id="tbody">
                <?php foreach ($blogStmt as $row) : ?>
                    <tr class="trHover border-bottom" class="articlesList" id="articlesList" data-id=<?= $row["id"] ?>>
                        <td class="text-start pb-2">
                            <?php
                            $date = new DateTime($row["create_time"]);
                            echo $date->format('Y-m-d');
                            ?>
                        </td>
                        <td class="text-start td-height article_title"><a style="color:#3F3F3F;" href="blog-page.php?id=<?= $row["id"] ?>"><?= $row["title"] ?></a></td>

                        <td><?= $row["category_name"] ?></td>
                        <td><?= $row["state"] ?></td>
                        <td><?= $row["comment_amount"] ?></td>
                        <td><?= $row["favorite_amount"] ?></td>
                        <td class="text-end"><i data-id=<?= $row["id"] ?> class="trash-btn trash fas fa-trash-alt"></i></td>
                        </div>
                    </tr>
                <?php endforeach; ?>
                <!-- spinner -->
                <div id="spinner" class="spinner-border position-absolute top-50 start-50 d-none" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </tbody>
        </table>
        <div class="mt-3 text-end">共 <?= $blogCount ?> 篇文章</div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-5">
                <div class="d-flex">
                    <li class="page-item">
                        <a class="page-link" href="manage-blog.php?page=<?= $PreviousPage ?>&pageView=<?= $pageView ?>&order=<?= $order ?>&status=<?= $status ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>

                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) echo "active" ?>"><a class="page-link" href="manage-blog.php?page=<?= $i ?>&pageView=<?= $pageView ?>&order=<?= $order ?>&status=<?= $status ?>"><?= $i ?></a></li>
                    <?php endfor; ?>

                    <li class="page-item">
                        <a class="page-link" href="manage-blog.php?page=<?= $nextPage ?>&pageView=<?= $pageView ?>&order=<?= $order ?>&status=<?= $status ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </div>
            </ul>
        </nav>
    </main>

<script>

    /**
     * 傳送 data set 的 id 來判斷要進入哪個葉面
     */

    $(function(){

        $("#searchType").on("change",function(){
            const value = $(this).val();
            switch (value) {
                case "keyword":
                    $("#typeKeyword").removeClass("d-none")
                    $("#typeDate").addClass("d-none")
                    $("#typeCategory").addClass("d-none")
                    break;
                case "date":
                    $("#typeKeyword").addClass("d-none")
                    $("#typeDate").removeClass("d-none")
                    $("#typeCategory").addClass("d-none")
                    break;
                case "category":
                    $("#typeKeyword").addClass("d-none")
                    $("#typeDate").addClass("d-none")
                    $("#typeCategory").removeClass("d-none")
                    break;
                default:
                    break;
            }
        })


>>>>>>> angus
        /**
         * 傳送 data set 的 id 來判斷要進入哪個葉面
         */

        $(function() {

            $("#searchType").on("change", function() {
                const value = $(this).val();
                switch (value) {
                    case "keyword":
                        $("#typeKeyword").removeClass("d-none")
                        $("#typeDate").addClass("d-none")
                        $("#typeCategory").addClass("d-none")
                        break;
                    case "date":
                        $("#typeKeyword").addClass("d-none")
                        $("#typeDate").removeClass("d-none")
                        $("#typeCategory").addClass("d-none")
                        break;
                    case "category":
                        $("#typeKeyword").addClass("d-none")
                        $("#typeDate").addClass("d-none")
                        $("#typeCategory").removeClass("d-none")
                        break;
                    default:
                        break;
                }
            })


            /**
             * 使用類別篩選事件
             */
            $("#typeCategory").on("change", function() {
                const value = $(this).val();
                const orderType = "<?= $orderType ?>"
                const start = "<?= $start ?>"
                const pageView = "<?= $pageView ?>"

                $.ajax({
                    url: "../../api/filterByCategory.php",
                    type: "POST",
                    data: {
                        value: value,
                        orderType: orderType,
                        start: start,
                        pageView: pageView,
                    },
                    beforeSend: function() {
                        $("#loadSpinner").show()
                    },
                    complete: function() {
                        $("#loadSpinner").hide()
                    },
                    success: function(data) {
                        console.log(data)
                        $("#tbody").html(data)
                    }
                })
            })


            /**
             * 使用關鍵字篩選事件
             */
            $("#typeKeyword").keyup(function() {
                const inputVal = $(this).val();
                const orderType = "<?= $orderType ?>"
                const start = "<?= $start ?>"
                const pageView = "<?= $pageView ?>"

                $.ajax({
                    url: "../../api/filterByKeyword.php",
                    type: "POST",
                    data: {
                        inputVal: inputVal,
                        orderType: orderType,
                        start: start,
                        pageView: pageView,
                    },
                    beforeSend: function() {
                        $("#loadSpinner").show()
                    },
                    complete: function() {
                        $("#loadSpinner").hide()
                    },
                    success: function(data) {
                        $("#tbody").html(data)
                    }
                })
            })


            /**
             * 使用日期篩選事件
             */
            $("#filterDateBtn").on("click", function() {
                const fromDate = $("#fromDate").val();
                const toDate = $("#toDate").val();
                const orderType = "<?= $orderType ?>"
                const start = "<?= $start ?>"
                const pageView = "<?= $pageView ?>"
                if (fromDate != '' || toDate != "") {
                    $.ajax({
                        url: "../../api/filterByDate.php",
                        method: "POST",
                        data: {
                            fromDate: fromDate,
                            toDate: toDate,
                            orderType: orderType,
                            start: start,
                            pageView: pageView
                        },
                        success: function(data) {
                            $("#tbody").html(data)
                        }
                    });
                }
            })


            $(".orderArrow").on("click", function(e) {
                const orderArrows = document.querySelectorAll(".orderArrow ");
                const target = e.target.id
                const order = $(this).data("order")
                $.ajax({
                    url: "../../api/blogSort.php",
                    method: "POST",
                    data: {
                        target_name: target,
                        order: order,
                    },
                    success: function(data) {
                        $("#table").html(data)
                    }
                });
            })


            const deleteBtns = document.querySelectorAll(".trash-btn");
            const articlesList = document.querySelector("#articlesList");
            const tbody = document.getElementById('tbody')

            for (let i = 0; i < deleteBtns.length; i++) {
                deleteBtns[i].addEventListener("click", (e) => {
                    let id = e.target.dataset.id;
                    const orderType = "<?= $orderType ?>"
                    const start = "<?= $start ?>"
                    const pageView = "<?= $pageView ?>"

                    $.ajax({
                        method: "POST",
                        url: "../../api/delete-blog.php",
                        data: {
                            blog_id: id,
                            orderType: orderType,
                            start: start,
                            pageView: pageView
                        },
                        beforeSend: function() {
                            $("#spinner").removeClass('d-none');
                        },
                        success: function(data) {
                            $("#tbody").html(data)
                            location.reload()
                        }
                    })
                })

            }


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




        })
    </script>
</body>

</html>
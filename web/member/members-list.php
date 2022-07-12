<?php
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

?>

<!doctype html>
<html lang="en">

<head>
    <title>members-list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
    <!-- css路徑調整 ============================================= -->

    <link rel="stylesheet" href="../../css/style.css">
    <!-- ========================================================= -->
    <style>
    :root {
        --bg-color: #eee6de;
        --main-color: #e65947;
        --line-color: #ddb9a2;
        --main-word-color: #3F3F3F;
        --header-hieght: 100px;
    }
    .title {
        font-size: 26px;
        color: var(--line-color);
    }
    .table {
        min-height: 200px;
    }
    .hover:hover{
        background: #E2E2E2;
        color: var(---main-word-color);
    }
    .page-item{
    font-weight: 700;
    }

    .page-link {
        color: var(--main-word-color);
    }

    .page-link:hover {
        color: var(--main-color);
    }

    .active>.page-link, .page-link.active {
        background: #fff;
        color: var(--main-color);
    }

    </style>
</head>

<body>
    <!-- 路徑調整 ============================================= -->
    <?php require("../main-menu.html");?>
    <?php require("do-members-list.php") ?>
    <!-- ====================================================== -->
    <main>
        <p class="title">會員管理</p>
        <div class="d-flex justify-content-between">
            <form action="members-list.php" method="get">
                <div class="row my-4">
                    <div class="col-6">
                        <input class="form-control mx-2" name="search" placeholder="請輸入會員帳號">
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-bg-color me-2">搜尋</button>
                        <a class="btn btn-bg-color" href="members-list.php">取消</a>
                    </div>
                </div>
            </form>
            <div class="d-flex align-items-center display-page-box">
                <p class="m-0">顯示&nbsp;&nbsp;</p>
                <form action="" method="get" class="pageForm" class="text-center">
                    <select name="pageView" class="display-page form-select mx-1 " id="pageView">
                        <option value="5" <?php if ($pageView == '5') print 'selected '; ?>> 5 </option>
                        <option value="10" <?php if ($pageView == '10') print 'selected '; ?>> 10 </option>
                    </select>
               </form>
                <p class="m-0">&nbsp;&nbsp;&nbsp;筆</p>
            </div>
        </div>
        <table class="table">
            <thead class="table-head">
                <tr class="text-center align-middle fw-bold">
                    <td>
                        <span class="d-flex justify-content-center align-items-center">編號
                        <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act">
                        <a href="<?=orderLink("1",$pageView,$order)?>" class="arrowBtn <?php if ($order == 1) echo "arrow-active" ?>">
                        <i class="fa-solid fa-caret-up arrow-color"></i></a>
                        <a href="<?=orderLink("2",$pageView,$order)?>" class="<?php if ($order == 2) echo "arrow-active" ?>">
                        <i class="fa-solid fa-caret-down arrow-color"></i>
                        </a></span></span>
                    </td>
                    <!-- <td class="col-2">會員編號 <a href="">
                        <i class="fa-solid fa-sort mx-2"></i></a></td> -->
                    <td class="col-1">帳號</td>
                    <td class="col-1">姓名</td>
                    <td class="col-4">地址</td>
                    <td class="col-2">電話</td>
                    <td>
                    <form action="members-list.php" method="GET">
                        <select class="count-bg text-center" aria-label="Default select example" name="state" onchange="submit(); ">
                            <option <?php if($state == "") print 'selected';?>>全部會員</option>
                            <option value="1" <?php if ($state == '1') print 'selected ';?>>一般會員</option>
                            <option value="2" <?php if ($state == '2') print 'selected ';?>>黑名單</option>
                        </select>
                    </form>
                    </td>
                    <td class="col-1">詳細資料</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $memberPageCount as $row): ?>
                <tr class="text-center align-middle hover">
                    <td><?=$row["id"]?></td>
                    <td><?=$row["account"]?></td>
                    <td><?=$row["name"]?></td>
                    <td><?=$row["address"]?></td>
                    <td><?=$row["phone"]?></td>
                    <td><?=$row["user_state_name"]?></td>
                    <!--路徑調整 ============================================= -->
                    <td><a class="btn btn-bg-color" href="member-list.php?id=
                    <?=$row["id"]?>">查看</a></td>
                    <!-- ===================================================== -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- 頁碼開始 -->
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-5">
                <div class="d-flex">
                    <li class="page-item">
                        <a class="page-link"
                            href="members-list.php?page=<?=$PreviousPage?>&pageView=
                            <?=$pageView?>&order=<?=$order?>"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for($i=1; $i<=$totalPage;$i++): ?>
                    <li class="page-item <?php if($page==$i)echo "active"?>">
                    <a class="page-link"
                            href="members-list.php?page=<?=$i?>&pageView=
                            <?=$pageView?>&order=<?=$order?>"><?=$i?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="members-list.php?page=<?=$nextPage?>
                            &pageView=<?=$pageView?>&order=<?=$order?>"
                            aria-label="Next">
                        <a class="page-link" href="<?=orderLink("nextPage",$pageView,$order)?>&<?= $PreviousPage ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) echo "active" ?>"><a class="page-link" href="<?=orderLink("nextPage",$pageView,$order)?>&page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="<?=orderLink("nextPage",$pageView,$order)?>&<?= $theNextPage ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </div>
                <li class="px-5 py-2">
                    第<?= $startItem ?>- <?= $endItem ?>筆,共 <?= $memberCount ?> 筆資料
                </li>
            </ul>
            </nav>
        <!-- 頁碼結束 -->
        </div>
</body>
<script>
        const pageView = document.querySelector("#pageView");
        pageView.addEventListener("change", function() {
            window.location.assign("<?= orderLink("pageView", $pageView, $order) ?>");
        })
</script>

</html>
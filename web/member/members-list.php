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

    <head>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
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

    main {
        /* padding: 30px 100px 0 300px;  */
    }
    </style>
</head>

<body>
    <!-- 路徑調整 ============================================= -->
    <?php require("../main-menu.html");?>
    <?php require("do-members-list.php") ?>
    <!-- ====================================================== -->
    <main>
        <div class="d-flex justify-content-between">
            <p class="title">會員管理</p>
            <div class="d-flex justify-content-between align-items-center display-page-box">
                <!-- 路徑調整 ============================================= -->
                <form action="members-list.php" method="GET">
                    <!-- ====================================================== -->
                    <p>顯示每頁
                        <select class="count-bg text-center" aria-label="Default select example" name="pageView"
                            onchange="submit();">
                            <option value="5" <?php if ($pageView == '5') print 'selected ';?>>5</option>
                            <option value="10" <?php if ($pageView == '10') print 'selected ';?>>10</option>
                        </select>
                        筆會員
                    </p>
                </form>
            </div>
        </div>
        <table class="table">
            <thead class="table-head">
                <tr class="text-center align-middle fw-bold">
                    <td>
                        <span class="d-flex justify-content-center align-items-center">會員編號
                            <span class="d-inline-flex flex-column justify-content-center p-0 ps-3 arrowBtn arrow-act">
                                <a href="members-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=1"
                                    class="arrowBtn <?php if($order==1)echo "arrow-active"?>"><i
                                        class="fa-solid fa-caret-up arrow-color"></i></a>
                                <a href="members-list.php?page=<?=$page?>&pageView=<?=$pageView?>&order=2"
                                    class="<?php if($order==2)echo "arrow-active"?>"><i
                                        class="fa-solid fa-caret-down arrow-color"></i></a>
                            </span>
                        </span>
                    </td>
                    <!-- <td class="col-2">會員編號 <a href="">
                        <i class="fa-solid fa-sort mx-2"></i></a></td> -->
                    <td class="col-1">帳號</td>
                    <td class="col-1">姓名</td>
                    <td class="col-4">地址</td>
                    <td class="col-2">電話</td>
                    <td class="col-1">狀態</td>
                    <td class="col-1">詳細資料</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                <tr class="text-center align-middle">
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
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example ">
                <ul class="pagination mt-4 px-5">
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
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mt-4 pt-2">第 <?=$startItem?> - <?=$endItem?> 筆 , 共 <?=$membersAllCount?> 筆資料</div>
        </div>
        </div>
</body>

</html>
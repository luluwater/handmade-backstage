<?php

if (!isset($_GET["id"])) {
    echo "沒有參數";
    exit;
}

$id = $_GET["id"];

require("../../db-connect.php");

$sql = "SELECT * FROM coupon WHERE id=:id";

$result = $db_host->prepare($sql);
$result->execute([":id" => $id]);
$row = $result->fetch();
$discountCount = $result->rowCount();

?>

<!doctype html>
<html lang="en">

<head>
    <title>優惠券-預覽-手手</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        form ul {
            position: relative;
            list-style-type: none;
            right: 30px;
        }

        form li {
            color: #3f3f3f;
        }

        .btn {
            color: #ffffff;
            font-size: 600;
        }

        .btn-cancel {
            background: #D7BAA5;
        }

        .btn-red {
            background: #D6624F;
        }

        .button {
            position: relative;
            right: 235px;
        }

        .state-title {
            position: relative;
            left: 800px;
        }

        select {
            position: relative;
            left: 115px;
        }

        .OFFSTYLE {
            padding-top: 1.5px;
        }

        .text-color {
            color: #D6624F;
        }

        .form-control:disabled,
        .form-control[readonly] {
            position: relative;
            background-color: transparent;
            border: transparent;
            right: 15px;
            color: #D6624F;
        }

        #coupon_active {
            color: #fff;
            background: var(--main-color);
        }

        #coupon_active a::before {
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
    <?php
    require("../main-menu.html");
    ?>
    <main>
        <?php if ($discountCount > 0) : ?>
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <p class="title">編輯完成</p>
                </div>
                <form action="coupon-doUpdate.php" method="POST" class="mb-3">
                    <div></div>
                    <ul>
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <li>活動名稱</li>
                        <li class="my-4 fw-bold text-color"><?= $row["name"] ?></li>
                        <li>活動簡介</li>
                        <li><textarea type="text" class="form-control my-3 fw-bold" style="width: 1200px; height:420px;" name="content" readonly><?= $row["content"] ?></textarea></li>

                        <div class="d-flex">
                            <div>
                                <li class="pt-4">折扣內容</li>
                                <div class="d-flex pe-4">
                                    <div class="d-flex">
                                        <li class="my-4 fw-bold text-color">
                                            <?php if ($row["discount_type_id"] == 1) print("折數 ") ?>
                                            <?php if ($row["discount_type_id"] == 1) print($row["coupon_discount"]) ?>
                                            <?php if ($row["discount_type_id"] == 2) print("滿 ") ?>
                                            <?php if ($row["discount_type_id"] == 2) print($row["pay"]) ?>
                                            <?php if ($row["discount_type_id"] == 2) print(" 折 ") ?>
                                            <?php if ($row["discount_type_id"] == 2) print($row["coupon_discount"]) ?>
                                        </li>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4">
                                <li class="pt-4">發放張數</li>
                                <li class="my-4 fw-bold text-color"><?= $row["amount"] ?></li>
                            </div>
                            <div class="ps-4">
                                <li class="pt-4">折扣碼</li>
                                <li class="my-4 fw-bold text-color"><?= $row["discount_code"] ?></li>
                            </div>
                        </div>
                        <li class="pt-4">活動期間</li>
                        <div class="d-flex">
                            <li class="my-4 fw-bold text-color"><?= $row["start_date"] ?></li>
                            <li>
                                <div class="pt-4 fw-bold text-color px-3">至</div>
                            </li>
                            <li class="my-4 fw-bold text-color"><?= $row["end_date"] ?></li>
                        </div>
                        <li>活動狀態</li>
                        <li class=" fw-bold text-color my-4">
                            <?php if ($row["state"] == 1) print("接下來") ?>
                            <?php if ($row["state"] == 2) print("進行中") ?>
                            <?php if ($row["state"] == 3) print("已結束") ?>
                        </li>
                    </ul>
                    <div class="text-end me-5 button">
                        <a href="coupon.php" class="btn btn-cancel mx-2">返回列表</a>
                    </div>
                </form>
            </div>
        <?php else : ?>
            CANNOT FIND THE USER
        <?php endif; ?>
    </main>
</body>

</html>
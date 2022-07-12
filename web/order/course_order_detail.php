<?php

$id = $_GET["id"];


if (!isset($id)) {
    header("location:course_order-list.php");
}




require_once("../../db-connect.php");


// *******確認是否擁有coupon_id******* //

$sqlCoupon = $db_host->prepare("SELECT coupon_id FROM course_order 
WHERE course_order.id = $id");

try {
    $sqlCoupon->execute();
    $couponIsset = $sqlCoupon->fetch(PDO::FETCH_ASSOC);
   
} catch (PDOException $e) {
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

// *******擁有的話 資料連接coupon資料庫******* //

$couponId = $couponIsset["coupon_id"];
if ($couponId!=""){
    $sqlJoin = ",coupon.discount_type_id,coupon.coupon_discount,coupon.pay";
    $JoinFrom = "JOIN coupon ON course_order.coupon_id = coupon.id";
    
}else{
    $sqlJoin = "";
    $JoinFrom = "";
}




// *******撈取訂單資料******* //

$sqlOrder = $db_host->prepare("SELECT course_order.*,user.account,order_staus.name AS stausName,payment.name AS paymentName $sqlJoin FROM course_order 
JOIN user ON course_order.user_id = user.id 
JOIN order_staus ON course_order.order_state_id = order_staus.id 
JOIN payment ON course_order.payment_id = payment.id
$JoinFrom
WHERE course_order.id = $id");





// *******撈取訂單明細******* //
$sql = $db_host->prepare("SELECT course_order_list.*,course.name AS courseName, course.category_id,category.category_en_name ,course_img.img_name FROM course_order_list 
JOIN course ON course_order_list.course_id = course.id 
JOIN category ON course.category_id = category.id 
JOIN course_img ON course.id = course_img.course_id  
WHERE course_order_list.order_id = $id");



try {
    $sqlOrder->execute();
    $orderRow = $sqlOrder->fetch(PDO::FETCH_ASSOC);
    // print_r($orderRow);

    $sql->execute();
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    $rowsCount = count($rows);
    // print_r($rows);
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

// *******將折價券低消設成數字******* //
$couponId != "" ? $couponPay = intval($orderRow["pay"]) : "";

?>

<!doctype html>
<html lang="en">

<head>
    <title>體驗課程 訂單明細</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/order-detail-style.css">


    <style>
        .table-w {
            width: 90%;
        }
    </style>

</head>

<body>
    <?php
    require("../main-menu.html");
    ?>
    <main>
        <!-- 顧客資料 -->
        <div class="row mx-5 my-3">
            <p class="col-1 boldWord">訂單編號</p>
            <p class="col-2"><?= $orderRow["id"] ?></p>
            <a href="course_order_edit.php?id=<?=$orderRow["id"]?>" class="btn btn-bg-color col-1 editBtn">修改資料</a>

        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 boldWord">訂單日期</p>
            <p class="col-auto"><?= $orderRow["create_time"] ?></p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 boldWord">訂購帳號</p>
            <p class="col-auto"><?= $orderRow["account"] ?></p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 boldWord">收件人</p>
            <p class="col-auto"><?= $orderRow["name"] ?></p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 boldWord">連絡電話</p>
            <p class="col-auto"><?= $orderRow["phone"] ?></p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 boldWord">付款方式</p>
            <p class="col-auto"><?= $orderRow["paymentName"] ?></p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 boldWord">訂單狀態</p>
            <p class="col-auto"><?= $orderRow["stausName"] ?></p>
        </div>


        <!-- 顧客資料結束 -->



        <div class="row mx-5 mb-3">
            <p class="col-1 boldWord">顧客備註</p>
            <div class="col-auto note pt-1"><?= $orderRow["note"] ?></div>

        </div>

        <!-- 顧客購買項目 -->

        <div class="d-flex justify-content-center">
            <table class="table table-hover mt-5 table-w">
                <thead class="order-th ">
                    <tr class="text-center order-title row">
                        <td class="col-1"></td>
                        <td class="col-3 boldWord">課程名稱</td>
                        <td class="col boldWord">預約日期</td>
                        <td class="col boldWord">人數</td>
                        <td class="col boldWord">單價</td>
                        <td class="col boldWord">小計</td>
                    </tr>
                </thead>
                <tbody>

                        <?php $orderId = "" ?>
                        <?php $thePrice = intval("") ?>
                        <?php $totalPrice = intval("") ?>
                        <?php foreach ($rows as $row) : ?>
                            <?php if ($orderId == $row["id"]) : ?>
                                <?php continue; ?>
                            <?php else : ?>
                    <tr class="text-center row detail-tr">
                        <td class="col-1"><img class="coursePic imgObject" src="../../img/course/course_<?= $row["category_en_name"] ?>_<?= $row["course_id"] ?>/<?= $row["img_name"] ?>" alt=""></td>
                        <td class="col-3"><?= $row["courseName"] ?></td>
                        <td class="col"><?= $row["date"] ?></td>
                        <td class="col"><?= $row["amount"] ?></td>
                        <td class="col">$<?= $row["price"] ?></td>
                        <td class="col">$<?= $row["amount"] * $row["price"] ?></td>
                    </tr>

                        <?php $orderId = $row["id"] ?>
                        <?php $thePrice = intval($row["amount"] * $row["price"])?>
                        <?php $totalPrice += $thePrice ?>
                        <?php endif; ?>
                        <?php endforeach ?>
                        

                    

                </tbody>
            </table>
        </div>
        <div class="text-end boldWord ">
            <div class="row mx-5 pe-5 mt-2 justify-content-end">
                <p class="col-2 boldWord ">訂單總金額</p>
                <p class="col-1 ">$<?= $totalPrice ?></p>
            </div>

            <div class="row mx-5  pe-5 justify-content-end">
                <p class="col-2 boldWord ">優惠券折扣</p>

                <?php if (($couponId!= "") && ($orderRow["discount_type_id"] == 1)) :?>
                    <?php $discountPercent = floatval($orderRow["coupon_discount"]*10)?>
                    <p class="col-1"><?= $discountPercent?> 折</p>
                <?php elseif (($couponId!= "") && ($orderRow["discount_type_id"] == 2) && ($totalPrice >= $couponPay)) :?>
                    <p class="col-1">$<?= $orderRow["coupon_discount"]?></p>
                <?php elseif (($couponId!= "") && ($orderRow["discount_type_id"] == 2) && ($totalPrice < $couponPay)) :?>
                <p class="col-1">$0</p>
                <?php else :?>
                    <p class="col-1">$0</p>
                <?php endif; ?>
                
            </div>

            <div class="row mx-5  pe-5 justify-content-end ">
                <p class="col-1 boldWord totalPrice pb-2">實付金額</p>

                <?php if (($couponId!= "") && ($orderRow["discount_type_id"] == 1)) :?>
                    <p class="col-1 totalPrice ">$<?= round($totalPrice * $discountPercent / 10) ?> </p>

                <?php elseif (($couponId!= "") && ($orderRow["discount_type_id"] == 2) && ($totalPrice >= $couponPay)) :?>
                    <?php $couponPrice = intval($orderRow["coupon_discount"])?>
                    <p class="col-1 totalPrice">$<?= $totalPrice - $couponPrice ?></p>

                <?php elseif (($couponId!= "") && ($orderRow["discount_type_id"] == 2) && ($totalPrice < $couponPay)) :?>
                    <p class="col-1 totalPrice">$<?= $totalPrice?></p>

                <?php else :?>
                    <p class="col-1 totalPrice">$<?= $totalPrice?></p>
                <?php endif; ?>






            </div>

            <div class="row mx-5 my-2 pe-5 justify-content-end">
                <a href="course_order-list.php" class="col-1 btn btn-bg-color mb-5 ">返回列表</a>
            </div>
        </div>
    </main>

</body>

</html>
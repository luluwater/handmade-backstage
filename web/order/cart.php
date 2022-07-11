<?php
session_start();
if (!isset($_SESSION["cart"])) {
    header("location: front-product.php");
}

require_once("../../db-connect.php");
$sqlMember = $db_host->prepare("SELECT user.*,user_discount.coupon_id AS userCoupon,coupon.name AS couponName, coupon.coupon_discount,coupon.discount_type_id FROM user
JOIN user_discount ON user.id = user_discount.user_id
JOIN coupon ON user_discount.coupon_id = coupon.id
WHERE user.id=10");

try {
    $sqlMember->execute();
    $rows = $sqlMember->fetch(PDO::FETCH_ASSOC);
    // print_r($rows);
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}


?>
<!doctype html>
<html lang="tw=Zh">

<head>
    <title>手手-購物車</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        :root {
            --bg-color: #eee6de;
            --main-color: #e65947;
            --line-color: #ddb9a2;
            --main-word-color: #3F3F3F;
            --thead-color: #d6624f;
            --header-hieght: 100px;
            --page-number-color: #3f3f3f;
        }

        .btn-main-color {
            background: var(--main-color);
            font-weight: bolder;
            color: white;

        }

        .btn:hover {
            color: var(--main-color);
            background: #fff;
            border-color: var(--main-color);
        }

        .btn-bg-color {
            background: var(--line-color);
            border: 1px solid var(--line-color);
            color: #fff;
            font-weight: 700;
        }
    </style>

</head>

<body>
    <div class="container">

        <div class="py-2 text-end">
            <a class="btn btn-info btn-bg-color" href="session-destroy.php">清空購物車</a>

            <a class="btn btn-main-color " href="front-product.php">繼續購物</a>
        </div>

        <form action="pay.php" class="row mb-4 align-items-center" method="post">

            <div class="row mx-5 mb-3">
                <p class="col-1 boldWord">訂購帳號</p>
                <p class="col-auto"><?= $rows["account"] ?></p>
            </div>

            <div class="row mx-5 mb-3 align-items-center">
                <p class="col-1 boldWord ">收件人</p>
                <p class="col-auto">
                    <input name="name" type="text" class="form-control" value="<?= $rows["name"] ?>">
                </p>
            </div>

            <div class="row mx-5 mb-3 align-items-center">
                <p class="col-1 boldWord">連絡電話</p>
                <p class="col-auto">
                    <input name="phone" type="text" class="form-control" value="<?= $rows["phone"] ?>">
                </p>
            </div>

            <div class="row mx-5 mb-3">
                <p class="col-1 boldWord">付款方式</p>
                <p class="col-3">
                    <select name="payment_id" id="" class="form-select searchState">
                        <option selected value="2">信用卡</option>
                    </select>
                </p>

            </div>

            <div class="row mx-5 mb-3">
                <p class="col-1 boldWord">使用折價券</p>
                <p class="col-3">
                    <select name="coupon_id" id="" class="form-select searchState">
                        <option selected value="<?= $rows["userCoupon"] ?>"><?= $rows["couponName"] ?></option>
                    </select>
                </p>

            </div>

            <div class="row mx-5 mb-3 mt-3">
                <p class="col-1 boldWord">顧客備註</p>
                <p class="col-5">
                    <textarea class="form-control" name="note" id="" rows="3"></textarea>

                </p>
            </div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>產品名稱</th>
                        <th>單價</th>
                        <th>數量</th>
                        <th>小計</th>
                    </tr>
                </thead>
                <input name="id" type="hidden" value="<?= $orderRow["id"] ?>">

                <?php
                $total = 0;
                $cartCount = 0;
                foreach ($_SESSION["cart"] as $item) :
                    $course_id = key($item);

                    $sql = $db_host->prepare("SELECT * FROM course WHERE id=$course_id");
                    $sql->execute();
                    $row = $sql->fetch(PDO::FETCH_ASSOC);


                    $subtotal = $row["price"] * current($item);
                    $total += $subtotal;


                ?>

                    <tr>
                        <td><?= $row["name"] ?></td>
                        <td class="text-end"><?= $row["price"] ?></td>
                        <td class="text-end"><?= current($item) ?></td>
                        <td class="text-end"><?= $subtotal ?></td>
                    </tr>

                <?php endforeach; ?>




            </table>
            <p class="text-end">總計:<span><?= $total ?></span></p>
            <p class="text-end">折價券優惠:

                <?php if ($rows["discount_type_id"] == 1) : ?>
                    <?php $discountPercent = floatval($rows["coupon_discount"] * 10) ?>
                    <span class="col-1"><?= $discountPercent ?> 折</span>
                <?php elseif ($rows["discount_type_id"] == 2) : ?>
                    <span class="col-1">$<?= $rows["coupon_discount"] ?></span>
                <?php elseif ($rows["discount_type_id"] == 2) : ?>
                    <span class="col-1">$0</span>
                <?php else : ?>
                    <span class="col-1">$0</span>
                <?php endif; ?>


            <p class="text-end">實付金額:

                <?php if ($rows["discount_type_id"] == 1) : ?>
                    <span class="col-1 totalPrice ">$<?= round($total * $discountPercent / 10) ?> </span>
                    <?php $total_amount = round($total * $discountPercent / 10) ?>
                <?php elseif ($rows["discount_type_id"] == 2) : ?>
                    <?php $couponPrice = intval($orderRow["coupon_discount"]) ?>
                    <span class="col-1 totalPrice">$<?= $total - $couponPrice ?></span>
                    <?php $total_amount = $total - $couponPrice ?>
                <?php elseif ($rows["discount_type_id"] == 2) : ?>
                    <span class="col-1 totalPrice">$<?= $total ?></span>
                    <?php $total_amount = $total ?>
                <?php else : ?>
                    <span class="col-1 totalPrice">$<?= $total ?></span>
                    <?php $total_amount = $total ?>
                <?php endif; ?>





            </p>

            <input name="total_amount" type="hidden" value="<?= $total_amount ?>">

            <div class="py-2 text-end">
                <button type="submit" class="btn btn-main-color ">結帳</button>
            </div>
    </div>




    </form>








</body>

</html>
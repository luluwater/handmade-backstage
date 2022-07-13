<?php
session_start();

if (!isset($_SESSION["cart"])) {
    echo "購物車不可為空";
    exit;
};

require_once("../../db-connect.php");
$user_id = 10;
$now = date('Y-m-d H:i:s');
$order_state_id = 3;
$valid = 1;
$name = $_POST["name"];
$phone = $_POST["phone"];
$payment_id = $_POST["payment_id"];
$coupon_id = $_POST["coupon_id"];
$note = $_POST["note"];
$total_amount = $_POST["total_amount"];


$sql = $db_host->prepare("INSERT INTO course_order (user_id, coupon_id, create_time,payment_id,total_amount,order_state_id,name,phone,note,valid) VALUES('$user_id', '$coupon_id',  '$now', '$payment_id', '$total_amount', '$order_state_id','$name', '$phone', '$note','$valid')");



try {
    $sql->execute();
    $order_id = $db_host->lastInsertId();
    // echo $order_id;

    foreach ($_SESSION["cart"] as $item) {
        $course_id = key($item);
        $amount = current($item);

        $sqlCart = $db_host->prepare("SELECT * FROM course WHERE id=$course_id");
        $sqlCart->execute();
        $course = $sqlCart->fetch(PDO::FETCH_ASSOC);
        $price = $course["price"];
        $date = $course["course_date"];


        $sqlDetail = $db_host->prepare("INSERT INTO course_order_list (order_id, course_id, amount,total_amount,price,date) VALUES ('$order_id','$course_id', '$amount', '$total_amount','$price','$date')");
        $sqlDetail->execute();
    }
    unset($_SESSION["cart"]); //訂單成立後清空購物車



} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}








?>

<!doctype html>
<html lang="en">

<head>
    <title>結帳頁面</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <style>


        .btn-main-color {
            background: #e65947;
            font-weight: bolder;
            color: white;

        }

        .btn:hover {
            color: #e65947;
            background: #fff;
            border-color: #e65947;
        }

    </style>
</head>

<body>
    <h1 class="text-center">訂單成立</h1>
    <div class="py-2 text-center">
        <a href="front-product.php" class="btn btn-main-color">回產品列表</a>
    </div>
</body>

</html>
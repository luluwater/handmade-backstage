<?php
require_once("../../db-connect.php");
session_start();

$sql = $db_host->prepare("SELECT course.*, category.category_name,category.category_en_name,course_img.img_name FROM course 
JOIN category ON course.category_id = category.id
JOIN course_img ON course.id = course_img.course_id ");

try {
    $sql->execute();
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    // print_r($rows);
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

?>

<!doctype html>
<html lang="tw-Zh">

<head>
    <title>手手-體驗課程商品</title>
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
            --header-hieght: 100px;
        }

        .object-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-count {
            width: 20px;
            height: 20px;
            background: orange;
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            font-size: 12px;
            right: -14px;
            top: -14px;
            border-radius: 50%;
        }

        .btn {
            color: #fff;
            background: var(--line-color);
        }

        .btn:hover,
        btn {
            color: #fff;
            background: var(--main-color);
            border-color: var(--main-color);
        }

        .btn-check:active+.btn,
        .btn-check:checked+.btn,
        .btn.active,
        .btn.show {
            color: #fff;
            background: var(--main-color);
            border-color: var(--main-color);
        }

        .btn-car {
            color: #fff;
            background: var(--main-color);
        }

        .btn-car:hover {
            color: #000;
            background: #FFF;
            border-color: #000;
        }

        .btn-check:focus+.btn,
        .btn:focus {
            color: #fff;
            background-color: var(--line-color);
            border-color: var(--line-color);
            outline: 0;
            box-shadow: none;
        }
    </style>

</head>

<body>

    <div class="container">
        <?php
        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
        ?>

        <div class="pt-5 pb-2 text-end">
            <a href="cart.php" class="btn btn-car position-relative">購物車<span class="cart-count" id="cartCount"><?= $cart_count ?></span></a>
        </div>

        <div class="row gy-4 d-flex justify-content-center mt-5">


            <?php $courseId = "" ?>
            <?php foreach ($rows as $row) : ?>
                <?php if ($courseId == $row["id"]) : ?>
                    <?php continue; ?>
                <?php else : ?>
                    <div class="col-md-4">
                        <div>
                            <figure class="ratio ratio-1x1 mb-2">
                                <img class="object-cover" src="../../img/course/course_<?= $row["category_en_name"] ?>_<?= $row["id"] ?>/<?= $row["img_name"] ?>" alt="">
                            </figure>
                            <h4 class="mb-2"><?= $row["name"] ?></h4>
                            <div class="text-end text-danger">$<?= $row["price"] ?></div>
                            <div class="py-2">
                                <div class="d-grid pb-3">
                                    <select name="course_date" id="" class="form-select searchState col-auto">
                                        <option value="<?= $row["course_date"] ?> selected "><?= $row["course_date"] ?></option>

                                    </select>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-cart" data-id="<?= $row["id"] ?>">加入購物車</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php $courseId = $row["id"] ?>
                <?php endif; ?>
            <?php endforeach; ?>




        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        const cartBtn = document.querySelectorAll(".btn-cart");
        const cartCountElem = document.querySelector("#cartCount");

        for (let i =0; i<cartBtn.length; i++){
        cartBtn[i].addEventListener("click",function(){
        //   console.log("click");
          let id = this.dataset.id;
          console.log(id);

          $.ajax({
            method: "POST",
            url: "./api/add-cart.php",
            dataType: "json",
            data: {
              course_id: id
            }
          })
          .done(function(response) {
            let cartCount = response.count;
            cartCountElem.innerText = response.count;
            // alert("加入購物車成功")

          }).fail(function(jqXHR, textStatus) {
            console.log("Request failed: " + textStatus);
          });


        })
    }
    </script>

</body>

</html>
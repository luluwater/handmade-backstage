
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <head><link rel="stylesheet" href="../../css/style.css"></head>
    <head><link rel="stylesheet" href="css/order-detail-style.css"></head>

  </head>
  <body>
    <?php
    require("../main-menu.html");
    ?>
    <main>
        <div class="row mx-5 my-3">
            <p class="col-1 dateName">訂單編號</p>
            <p class="col-auto">1</p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 dateName">訂單日期</p>
            <p class="col-auto">2022/07/07</p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 dateName">訂購帳號</p>
            <p class="col-auto">蔡依林</p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 dateName">收件人</p>
            <p class="col-auto">蔡依林</p>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 dateName">連絡電話</p>
            <p class="col-auto">09123456789</p>
        </div>

        <div class="row mx-5 mb-4 align-items-center">
            <label for="" class="col-1 dateName">訂單狀態</label>
            <select name="" id="" class="form-select mx-2 searchState col-auto">
                <option value="3">已付款</option>
                <option value="5">取消</option>
            </select>
        </div>

        <div class="row mx-5 mb-3">
            <p class="col-1 dateName">顧客備註</p>
            <div class="col-auto note pt-1">出貨請通知!!</div>

        </div>

        <div class="d-flex justify-content-center">
            <table class="table table-hover mt-5">
                <thead class="order-th ">
                    <tr class="text-center order-title">
                        <td>課程名稱</td>
                        <td>預約日期</td>
                        <td>人數</td>
                        <td>單價</td>
                        <td>小計</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>

                    </tr>

                </tbody>
            </table>
        </div>
    </main>

  </body>
</html>
<?php
require("../../db-connect.php");
session_start();

if(isset($_SESSION["account"])){
//連線路徑調整===========================================
    header("location: ../web/example.php");
//======================================================    
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>login-admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- css路徑調整 ============================================= -->
    <head><link rel="stylesheet" href="login-admin.css"></head>
<!-- ========================================================= -->
  </head>
  <body>
      <div class="card border-0 position-absolute"></div>
      <div class="display">
        <div class="logo mb-5 d-flex justify-content-center align-items-center">
            <h1 class="mx-2 fw-bold">登入</h1>
<!-- 圖片路徑調整 ============================================= -->
            <img class="object-cover" src="../../img/HANDMADE - LOGO-01.png" alt="">
<!-- ========================================================= -->
            <h1 class="mx-2 fw-bold">手手</h1>
        </div>


<!-- 瘋狂失敗晚點再來-->
        <!-- <?php if(isset($_SESSION["error"]) && $_SESSION["error"]["times"]>3): ?>    
            <h2 class="error-text text-center fw-bold">您已嘗試錯誤超過 3 次 <br> 請稍後再登入</h2>
        <?php else: ?> -->
<!-- 瘋狂失敗晚點再來-->



<!-- 路徑調整 ============================================= -->
        <form action="do-login-admin.php" method="post">
<!-- ====================================================== -->
            <div class="mb-5">
                <label class="mb-1" for="">管理者帳號</label>
                <input type="text" class="form-control" name="account">
            </div>
            <div class="mb-5">
                <label class="mb-1" for="">密碼</label>
                <input type="password" class="form-control" name="password">
            </div>
            <?php if(isset($_SESSION["error"])): ?>
                <div class="text-danger fw-bold text-center align-middle"><?=$_SESSION["error"]["message"]?></div>
            <?php endif; ?>
            <div>
                <div class="d-flex justify-content-center">
                    <a class="button btn btn-main-color" href="login-admin.php">取消</a>
                    <button class="button btn btn-main-color" type="submit">登入</button>
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>
  </body>
</html>
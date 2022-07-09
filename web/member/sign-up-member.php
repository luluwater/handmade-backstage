<?php
//session_start();
require("../../db-connect.php");
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>HANDMADE_singup</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <style>
  :root {
    --bg-color: #eee6de;
    --main-color: #e65947;
    --line-color: #ddb9a2;
    --main-word-color: #3F3F3F;
  }
  body {
    background: var(--bg-color);
  }
  .object-cover {
    object-fit: cover; 
    width: 200px;   
  }
  .display {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 600px;
  }
  .logo {
    color: var( --main-color);
  }
  .btn-main-color{
    background: var(--main-color);
    font-weight: bolder;
    color: white;
    padding: .5rem 1rem;
  }
  .button {
    margin: 25px;
  }
</style>
  </head>
  <body>
    <div class="display">
      <div class="logo d-flex justify-content-center align-items-center">
        <h1 class="mx-2 fw-bold">註冊</h1>
<!-- 圖片路徑調整  ============================================ -->
        <img class="object-cover" src="../../img/HANDMADE - LOGO-02.png" alt="">
<!-- ========================================================= -->
        <h1 class="mx-2 fw-bold">手手</h1>
      </div>
      <form action="do-signup-member.php" method="POST">
        <div class="mb-3 row">
          <label for="" class="col-2 col-form-label text-center">帳號</label>
          <div class="col-10">
            <input type="text" class="form-control" name="account" placeholder="Hello World">
          </div>
          <?php if(isset($_SESSION["user"]["account"])):?> 
            <div class="text-danger fw-bold text-end"><?=$_SESSION["user"]["account"]?>帳號已註冊</div>
          <?php endif; ?>

        </div>
        <div class="mb-3 row">
          <label for="" class="col-2 col-form-label text-center">姓名</label>
          <div class="col-10">
            <input type="text" class="form-control" name="name">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="" class="col-2 col-form-label text-center">密碼</label>
          <div class="col-10">
            <input type="password" class="form-control" name="password">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="" class="col-2 col-form-label text-center">確認</label>
          <div class="col-10">
            <input type="password" class="form-control" name="repassword" placeholder="請再次輸入密碼">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="" class="col-2 col-form-label text-center">性別</label>
          <div class="col-10">
            <select class="form-select" aria-label="Default select example" name="gender">
              <option value="female">female</option>
              <option value="male">male</option>
            </select>
          </div>  
        </div>
        <div class="mb-3 row">
          <label for="" class="col-2 col-form-label text-center">生日</label>
          <div class="col-10">
            <input type="date" class="form-control" name="birthday">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="" class="col-2 col-form-label text-center">地址</label>
          <div class="col-10">
            <input type="text" class="form-control" name="address">
          </div>
        </div>
        <div class="mb-3 row">
          <label class="col-2 col-form-label text-center">信箱</label>
          <div class="col-10">
            <input type="text" class="form-control" name="email">
          </div>
        </div>
          <?php if(isset($_SESSION["user"]["email"])):?> 
            <div class="text-danger fw-bold text-end"><?=$_SESSION["user"]["email"]?>信箱已註冊</div>
          <?php endif; ?>
        <div class="mb-3 row">
          <label class="col-2 col-form-label text-center">電話</label>
          <div class="col-10">
            <input type="number" class="form-control" name="phone">
          </div>
        </div>
        <div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-main-color mx-2">取消</button>
            <button class="btn btn-main-color mx-2" type="submit">註冊</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
<?php
require("../../db-connect.php");
session_start();

if(isset($_SESSION["account"])){
//連線路徑調整===========================================
    header("location: ../example.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
        width: 100px;
    }

    .display {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
    }

    .logo h1 {
        color: var(--main-color);
        margin: 0;
    }

    .btn-main-color {
        background: var(--main-color);
        font-weight: bolder;
        color: white;
        padding: .5rem 1rem;
    }

    .button {
        margin-top: 50px;
        margin: 20px;
    }

    .card {
        background: #fff;
        border-radius: 30px;
        height: 500px;
        width: 500px;
        z-index: -1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    </style>
</head>

<body>
    <div class="card border-0 position-absolute"></div>
    <div class="display">
        <div class="logo mb-5 d-flex justify-content-center align-items-center">
            <h1 class="mx-2 fw-bold">登入</h1>
            <!-- 圖片路徑調整 ============================================= -->
            <img class="object-cover" src="../../img/HANDMADE - LOGO-02.png" alt="">
            <!-- ========================================================= -->
            <h1 class="mx-2 fw-bold">手手</h1>
        </div>
        <!-- 路徑調整 ============================================= -->
        <form action="do-login-admin.php" method="post">
        <!-- ================================================= -->
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
    </div>
</body>

</html>
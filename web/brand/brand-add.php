<!doctype html>
<html lang="en">
  <head>
    <title>第二頁</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../css/style.css">
     <style>
        :root {
        --bg-color: #eee6de;
        --main-color: #e65947;
        --line-color: #ddb9a2;
        --main-word-color: #3F3F3F;
        --header-hieght: 100px;
    }
   h1{
    color:var(--line-color);
   }
    </style>
  </head>
    <?php
    require("../main-menu.html");
    ?>
    <main>
     <div class="d-flex justify-content-center align-items-center">
        <div class="panel">
            <h1 class="text-center">新增品牌類型</h1>
            <form action="do-insert.php" method="post">
                <!-- <div class="mb-2">
                    <label for="">序號</label>
                    <input type="text" class="form-control"
                    name="order"
                    >
                </div> -->
                <div class="mb-2">
                    <label for="">類型</label>
                    <input type="text" 
                    class="form-control"
                    name="category-type"
                    >
                </div>
                <div class="mb-2">
                    <label for="">英文名</label>
                    <input type="text" 
                    class="form-control"
                    name="category-type-en"
                    >
                </div>
                 <div class="d-flex justify-content-center">
                
                <a class="btn  btn-main-color" href="brand-list.php">返回</a>
                <button type="submit" class="btn ms-2  btn btn-main-color">送出</button>
                </div>
            </form>
        </div>
     </div>
  </body>
  </main>
</html>
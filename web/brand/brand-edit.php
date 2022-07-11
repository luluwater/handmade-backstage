<?php


require("../../db-connect.php");
// echo "成功";
// $sql="SELECT * FROM category WHERE id =$id AND valid=1";

// $result = $db_host->prepare($sql); //這邊是把資料撈出來 回傳物件 
//所以用result變數把物件接住 
// $userCount=$result->num_rows;//->取得有多少筆資料

?>
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
 
    </style>
  </head>
  <body>
    <?php
    require("../main-menu.html");
    ?>
    <main>
     
       <a class="button btn btn-main-color" 
        href="brand-detail.php">返回基本資料</a>
      <div class="text-end my-4">
        <table class="table align-items-center">
              <thead class="table-head">
                <tr class="text-center">
                  <td class="col-2">序號</td>
                  <td class="col-4">類型</td>
                  <td class="col-4">英文名</td>
                  <td class="col-2">詳細資料</td>
                </tr>
              </thead>
            
              <tbody class= text-center>
              
                <th class="pt-3"  name="name" 
                 class="me-4" type="checkbox">
                <?=$category["id"]?></th>
                <th class="pt-3" ><?=$category["category_name"]?></th>
                <th class="pt-3" ><?=$category["category_en_name"]?></th>
                <th><a class="btn btn-bg-color" 
                href="brand-detail.php">查看</a></th>
              </tbody>
         
        </table>
      </div>
   </main>
     </body>
</html>
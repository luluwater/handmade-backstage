<?php
require("../../db-connect.php");
// // 測試連線
// try{
//     $db_host=new PDO("mysql:host={$serverName};dbname={$dbname};charset=utf8",$username,$password);
//     echo "成功";
        
// }catch(PDOException $e){
//     echo "資料庫連線失敗";
//     echo "Error: ".$e->getMessage();
//     exit;
// }

$sql="SELECT * FROM store";
$stmt=$db_host->prepare($sql);//類似sql執行
$stmt->execute(); 
// $category_count=$result->num_rows;
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $storeAllCount =count($rows)

?>

<!doctype html>
<html lang="en">
  <head>
    <title>第一頁</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../css/style.css">
    <style>
      .title{
        color:var(--line-color);
        margin-top:5px;
        font-size:24px;
      }
      .delAndAdd{
        padding-top:60px;
      }
      .side{
        background:var(--bg-color); 
        border-radius:10%;
         /* margin-top:60px; */
          /* padding:5px 40px ; */
          color:black;
          border:1px solid var(--bg-color);
         
      }
      .btnClass {
        margin-top:50px;
        padding:10px;
        color:white;
        background: var( --line-color);
         border:1px solid var( --line-color);
         border-radius:10%;
      }
      .count-bg{
        margin-bottom:20px;
      }
      .btn-search{
        background: var( --line-color);
        border: 1px solid var(--line-color);
        border-radius:10%;
        padding:5px 20px ;
        color:white;
      }
      .footer{
        display:flex;
        justify-content:center;
        align-items:center;

      }
      .object-fit{
        width: 100%;
        height: 100%;
        object-fit:cover;
      }
    </style>
  </head>
  <body>
     <?php
    require("../main-menu.html");
    ?>
     <main>
             <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <p class="title">品牌管理</p>  
                <!-- <p>顯示 
                  <select class="count-bg text-center" aria-label="Default select example">
                    <option value="1" selected>6</option>
                    <option value="2">12</option>
                    <option value="3">18</option>
                    <option value="4">24</option>
                    <option value="5">30</option>
                  </select> 
                  筆數
                </p> -->
                  <!-- <p class="side">共筆資料 </p>  -->
            </div>
           
             <div class=" d-flex justify-content-between my-4">
                   <a class="title btnClass" href="brand-list.php">管理分類</a>
                <div class="delAndAdd ">
                    <a href="" class=" text-dark m-4"><i class="fa-solid fa-trash m-2"></i>刪除店家</a>
                    <a href="" class=" text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增店家</a>
                </div>     
            </div>
               <div class="row gy-4">
                   <?php foreach ($rows as $row) : ?>
                      <div class="col-md-4">
                        <div>
                         <figure class="ratio ratio-4x3 mb-2">
                            <img class="object-cover" src="imagesTest/store_img
                            <?= $row["img"] ?>" alt="">
                        </figure>
                        <div class="text-center"><?= $row["name"] ?></div>
                           <div class="py-2">
                             <div class="d-grid">
                               <button class="btn btn-info btn-cart" data-id="1">編輯</button>
                             </div>
                           </div>
                         </div>
                      </div>
                   <?php endforeach; ?>
                 </div>
            <div class="footer">
                <?php require("../mod/pagination.php") ?>
            </div>
          
         
    </main>
 
</html>
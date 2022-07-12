<?php
require("../../db-connect.php");

$sql = "SELECT store.* ,category.category_name FROM store
JOIN category ON store.category_id = category.id WHERE store.valid= 1 LIMIT 5";

$result= $db_host->prepare($sql);

try {
   $result->execute();  
  $rows=$result->fetchALL(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}


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
        color:var(--main-color);
        font-size:36px;
        margin-bottom:24px;
      }
      .delAndAdd{
        padding-top:24px;
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
        margin-top:60px;
        color:white;
        background: var( --line-color);
         border:1px solid var( --line-color);
         border-radius:10%;
         font-size:24px;
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
            <div class="d-flex justify-content-between mb-3">
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
           <!-- form 配呵input type="submit name=要輸入的職" -->
           <form action="do-store-delete.php" method="get">
        
             <div class=" d-flex justify-content-between my-4">
                    <a class=" d-flex align-content-center mb-4 btnClass" href="brand-list.php">管理分類</a>
                <div class="delAndAdd mt-3 ">
                  <input class=" -main-color m-4" name="delete" type="submit" value="刪除店家">
                    <a href="brand-List-detail.php" class=" text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增店家</a>
                </div>     
              </div>
          
               <div class="row gy-4">
                   <?php foreach ($rows as $row) : ?>
                      <div class="col-md-4">
                        <div>
                          <!-- 這邊的input吃到的是資料庫id 渲染顯示的地方 藉由軟刪除讓它顯示不見 -->
                          <input value="<?=$row["id"] ?>" name="checkbox" 
                            class="me-4" type="checkbox">
                         <figure class="ratio ratio-4x3 mb-2">
                             <img class=" border border-secondary object-cover" src="imagesTest/<?= $row["img"] ?>" alt="">
                        </figure>
                             <div class="text-center"><?= $row["name"] ?></div>
                             
                             <div class="text-center ">類型:&nbsp<?= $row["category_name"] ?>
                            </div>
                    
                          <div class=" d-flex  justify-content-center">                       
                           <a class="text-main-color m-2"
                            href="<?= $row["FB_url"] ?>">FB</a>
                           </div>

                           <div class="d-flex  justify-content-center">
                           <a class="text-main-color m-2" 
                           href="<?= $row["IG_url"] ?>">IG</a>
                            </div>
                            
                          </div>
                      </div>
                   <?php endforeach; ?>
                 
                 </div>
            </form>
                 
            <!-- <div class="footer">
               <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example ">
                <ul class="pagination mt-4 px-5">
                    <li class="page-item">
                        <a class="page-link"
                            href="store.php?page=<?=$PreviousPage?>&pageView=
                            <?=$pageView?>&order=<?=$order?>"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for($i=1; $i<=$totalPage;$i++): ?>
                    <li class="page-item <?php if($page==$i)echo "active"?>">
                    <a class="page-link"
                            href="store.php?page=<?=$i?>&pageView=
                            <?=$pageView?>&order=<?=$order?>"><?=$i?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="store.php?page=<?=$nextPage?>
                            &pageView=<?=$pageView?>&order=<?=$order?>"
                            aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mt-4 pt-2">第 <?=$startItem?> -
             <?=$endItem?> 筆 , 共
             <?=$membersAllCount?> 筆資料</div>
        </div>
        </div>
            </div>
          
          -->
    </main>
 
</html>
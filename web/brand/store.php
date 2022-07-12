<?php
require("../../db-connect.php");

//三源運算子 跟if else很像
$page=isset($_GET["page"]) ?$_GET["page"]:1;
$order = isset($_GET["order"]) ? $_GET["order"] : 1;
$perPage=5; //這邊我預設每個page分頁只會有5個店家
$start = ($page-1)*$perPage; 

// echo $start; //start 這個變數設成 點選分頁會-1 *現在顯示第幾個分頁 
$sql = "SELECT store.* ,category.category_name FROM store
JOIN category ON store.category_id = category.id WHERE 
store.valid= 1 LIMIT $start, $perPage"; //start設為第一個
$result= $db_host->prepare($sql);
$pageUserCount=$result->fetchALL(PDO::FETCH_ASSOC);
// var_dump($result);
$sqlStores="SELECT store.* FROM store";

$sqlAll= $db_host->prepare($sqlStores);


try {
   $sqlAll->execute();
   $stores=$sqlAll->fetchALL(PDO::FETCH_ASSOC);
   $result->execute();  
   $rows=$result->fetchALL(PDO::FETCH_ASSOC);
   $storeCount=count($stores);


} catch (PDOException $e) {
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}




// echo $storeCount;

// $pageUserCount = $result->num_rows;
//$pageUserCount 不是0才可以正常顯示一頁有幾個資料
//開始的筆數


$startItem = ($page - 1) * $perPage + 1;
$endItem = $page * $perPage;
if ($endItem > $storeCount) $endItem = $storeCount;
$totalPage = ceil($storeCount / $perPage);
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
$nextPage = (($page + 1) > $totalPage) ? $totalPage : ($page + 1);

// echo $page;
// echo $startItem; //顯示每頁的開頭數

// echo $endItem; //顯示每頁的尾數

// echo $totalPage;
// echo $storeCount; //所有店家總數 30 
// echo $perPage; // 顯示一個分頁有幾個店家
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
      
.page-item{
    font-weight: 700;
}

.page-link {
    color: var(--main-word-color);
}

.page-link:hover {
    color: var(--main-color);
}

.active>.page-link, .page-link.active {
    background: #fff;
    color: var(--main-color);
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
                            class="me-4 mb-3" type="checkbox">
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
       <div class="py-2 d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
          <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
            <li class="page-item
          <?php if ($page == $i) echo "active"; ?>
          ">
          <a name="" class="page-link" href="store.php?page=
          <?= $i ?>"><?= $i ?></a></li>
          <?php endfor; ?>
          <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
        </ul>
      </nav>
    </div>
    </main>
 
</html>
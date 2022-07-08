<?php
require_once("../db-connect.php");

$amount_limit=$_GET["amount-limit"]??5;
$page=$_GET["page"]??1;

$stmtCategory=$db_host->prepare("SELECT * FROM category");
$stmtCategory->execute();
$rowsCategory=$stmtCategory->fetchALL(PDO::FETCH_ASSOC);

$stmtAll=$db_host->prepare("SELECT * FROM course JOIN course_img ON course.id=course_img.course_id GROUP BY course_id");
$stmtAll->execute();
$courseAmount=count($stmtAll->fetchALL(PDO::FETCH_ASSOC));
// echo $courseAmount;
$start=($page-1)*$amount_limit;
if($courseAmount%$amount_limit===0)
$totalPage=floor($courseAmount/$amount_limit);
else
$totalPage=floor($courseAmount/$amount_limit)+1;

$stmt=$db_host->prepare("SELECT course.id,course_img.img_name,name,category.category_en_name,amount,price,sold_amount,state FROM course JOIN category ON course.category_id=category.id JOIN course_img ON course.id=course_img.course_id GROUP BY course_id LIMIT $start,$amount_limit");
$stmt->execute();    
$rows=$stmt->fetchALL(PDO::FETCH_ASSOC);




?>
<!doctype html>
<html lang="tw-zh">

<head>
    <title>課程管理-手手</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <p class="title">課程管理</p>
                <form action="course.php" method="get">
                <p>顯示 
                  <select id="amount-limit" class="count-bg text-center" name="amount-limit"  onchange="submit()">
                    <option value="5" <?= $select=$amount_limit==5?'selected':'' ?>>5</option>
                    <option value="10"<?= $select=$amount_limit==10?'selected':'' ?>>10</option>
                  </select> 
                  筆數
                </p>
                </form>                
            </div>
            <?php require("./mod/search-bar.php") ?>
            <div class="text-end my-4">
              <a href="" class="text-dark m-2"><i class="fa-solid fa-trash m-2"></i>下架課程</a>
              <a href="creat-new-product.php" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增課程</a>
              
            </div>
            <table class="table align-items-center">
              <thead class="table-head">
                <tr class="text-center">
                  <td class="col-1"><input type="checkbox" name="" id=""></td>
                  <td class="col">課程編號<i class="fa-solid fa-sort mx-2"></i></td>
                  <td class="col-3">課程名稱</td>
                  <td class="col-1">上線人數</td>
                  <td class="col-1">金額</td>
                  <td class="col-1">售出堂數</td>
                  <td class="col-1">上架</td>
                  <td class="col-1">收藏數<i class="fa-solid fa-sort mx-2"></i></td>
                  <td class="col-1">編輯</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach($rows as $row): ?>                              
                  <tr class="text-center">
                    <td><input type="checkbox" name="" id=""></td>
                    <td><?=$row["id"]?></td>
                    <td class="text-start">
                      <img class="previewImage-sm me-3" src="../img/course/course_<?=$row["category_en_name"]?>_<?=$row["id"]?>/<?=$row["img_name"]?>" alt="">
                      <?=$row["name"]?>
                    </td>
                    <td><?=$row["amount"]?></td>
                    <td><?=$row["price"]?></td>
                    <td><?=$row["sold_amount"]?></td>                    
                    <td><input type="checkbox" <?php if($row["state"]==1)print("checked") ?> disabled></td>
                    <td></td>
                    <td><a href="view-course.php?course=<?=$row["id"]?>"><i class="fa-solid fa-pen"></i></a></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="course.php?amount-limit=<?=$amount_limit?>&page=<?=$page-1<1?$page=1:$page-1?>" aria-label="Previous">
                        <span aria-hidden="true">
                            <</span>
                    </a>
                </li>
                  <?php for($i=1;$i<=$totalPage;$i++): ?>
                <li class="page-item"><a class="page-link active" href="course.php?amount-limit=<?=$amount_limit?>&page=<?=$i?>"><?=$i?></a></li>
                  <?php endfor; ?>
                    <a class="page-link" href="course.php?amount-limit=<?=$amount_limit?>&page=<?=$page+1>$totalPage?$page=$totalPage:$page=$page+1?>" aria-label="Next">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
            </ul>
            </nav>
        </div>
    </main>

    <script>
      
          
    </script>
</body>

</html>
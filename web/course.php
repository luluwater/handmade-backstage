<?php
require_once("../db-connect.php");
session_start();
if(!isset($_GET["type"])){
  echo "沒有帶商品類型參數";
  exit;
}
$type=$_GET["type"];

function orderLink($item,$cur_amount_limit,$orderType,$order,$orderState){
  $type=$_GET["type"];
  switch($item){
    case "state":
        $orderState=$orderState?0:1;
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState";
      break;
      case "nextPage":
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState";
        break;   
      case "amount-list":
        $cur_amount_limit=$cur_amount_limit==10?5:10;
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState";
        break;   
      default:
        if($orderType==$item){ 
          $order=$order=="ASC"?"DESC":"ASC";
        }else{
          $orderType=$item;
        }    
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState";  
      break;
  }
  if($item=="state"){
    
  }elseif($item=="nextPage"){
  }
  else{
   
  } 
}

$amount_limit=$_GET["amount-limit"]??5;
$page=$_GET["page"]??1;
$orderState=$_GET["orderState"]??1;
$orderStateType=$orderState?"DESC":"ASC";
$orderType=$_GET["orderType"]??"id";
$order=$_GET["order"]??"ASC";
// echo $orderType;

$secendOrder="$orderType $order";
$start=($page-1)*$amount_limit;


$stmtCategory=$db_host->prepare("SELECT * FROM category");
$stmtCategory->execute();
$rowsCategory=$stmtCategory->fetchALL(PDO::FETCH_ASSOC);

if($type=="course"){
  $stmtAll=$db_host->prepare("SELECT * FROM course JOIN course_img ON course.id=course_img.course_id GROUP BY course_id");
  $stmt=$db_host->prepare("SELECT course.id,course_img.img_name,name,category.category_en_name,amount,price,sold_amount,state FROM course 
  JOIN category ON course.category_id=category.id 
  JOIN course_img ON course.id=course_img.course_id 
  GROUP BY id 
  ORDER BY state $orderStateType ,$secendOrder
  LIMIT $start,$amount_limit");
}else if($type=="product"){
  $stmtAll=$db_host->prepare("SELECT * FROM product JOIN product_img ON product.id=product_img.product_id GROUP BY product_id");
  $stmt=$db_host->prepare("SELECT product.id,product_img.img_name,name,category.category_en_name,amount,price,sold_amount,state FROM product 
  JOIN category ON product.category_id=category.id 
  JOIN product_img ON product.id=product_img.product_id
  GROUP BY id
  ORDER BY state $orderStateType ,$secendOrder
  LIMIT $start,$amount_limit");
}


$stmtAll->execute();
$courseAmount=count($stmtAll->fetchALL(PDO::FETCH_ASSOC));
// echo $courseAmount;
if($courseAmount%$amount_limit===0)
$totalPage=floor($courseAmount/$amount_limit);
else
$totalPage=floor($courseAmount/$amount_limit)+1;



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
                <form action="course.php?" method="get">
                <p>顯示 
                  <select id="amount-limit" class="count-bg text-center" name="amount-limit" >
                    <option value="5" <?= $amount_limit==5?'selected':'' ?>>5</option>
                    <option value="10"<?= $amount_limit==10?'selected':'' ?>>10</option>
                  </select> 
                  筆數
                </p>
                </form>                
            </div>
            <form action="course.php" method="get">
            <div class="row  my-4">
                <div class="col-2">
                    <select class="form-select" name="searchType" aria-label="Default select example">
                        <option value="id" selected>課程編號</option>
                        <option value="name">課程名稱</option>
                        <option value="category">類別</option> 
                    </select>
                </div>
                <div class="col-6">
                    <input class="form-control" type="search" name="search" id="">
                </div>
                <div class="col-1">
                    <a href="" class="btn btn-bg-color">搜索</a>
                </div>
            </div>
            </form>
            <div class="text-end my-4">
              <a href="" class="text-dark m-2"><i class="fa-solid fa-trash m-2"></i>下架課程</a>
              <a href="creat-new-product.php" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增課程</a>
              
            </div>
            <table class="table align-items-center">
              <thead class="table-head">
                <tr class="text-center">
                  <td class="col-1">
                    <input type="checkbox" id="select-all" class="form-check-input">
                  </td>
                  <td class="col">課程編號                     
                    <a href="<?=orderLink("id",$amount_limit,$orderType,$order,$orderState)?>">
                    <i class="fa-solid fa-sort mx-2 text-dark"></i>
                  </a>
                  </td>
                  <td class="col-3">課程名稱</td>
                  <td class="col-1">上線人數</td>
                  <td class="col-1">金額</td>
                  <td class="col-1">售出堂數
                    <a href="<?=orderLink("sold_amount",$amount_limit,$orderType,$order,$orderState)?>">
                    <i class="fa-solid fa-sort mx-2 text-dark"></i>
                  </a>
                  </td>
                  <td class="col-1">上架
                    <a href="<?=orderLink("state",$amount_limit,$orderType,$order,$orderState)?>">
                    <i class="fa-solid fa-sort mx-2 text-dark"></i>
                  </a>
                  </td>
                  <td class="col-1">收藏數 
                    <a href="course.php?type=<?=$type?>&amount-limit=<?=$amount_limit?>">
                    <i class="fa-solid fa-sort mx-2 text-dark"></i>
                  </a>
                  </td>
                  <td class="col-1">編輯</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach($rows as $row): ?>                              
                  <tr class="text-center">
                    <td>
                      <input type="checkbox" class="check-select form-check-input" value="<?=$row["id"]?>" >
                    </td>
                    <td><?=$row["id"]?></td>
                    <td class="text-start align-items-center">                      
                      <img class="previewImage-sm me-3" src="../img/<?=$type?>/<?=$type?>_<?=$row["category_en_name"]?>_<?=$row["id"]?>/<?=$row["img_name"]?>" alt="">
                      <?=$row["name"]?>
                    </td>
                    <td><?=$row["amount"]?></td>
                    <td><?=$row["price"]?></td>
                    <td><?=$row["sold_amount"]?></td>                    
                    <td><input type="checkbox" class="form-check-input" <?php if($row["state"]==1)print("checked") ?> disabled></td>
                    <td></td>
                    <td><a class="text-dark" href="edit-product.php?type=<?=$type?>&id=<?=$row["id"]?>"><i class="fa-solid fa-pen"></i></a></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="<?=orderLink("nextPage",$amount_limit,$orderType,$order,$orderState)?>&page=<?=$page-1<1?$page=1:$page-1?>" aria-label="Previous">
                        <span aria-hidden="true"><</span>
                    </a>
                </li>
                  <?php for($i=1;$i<=$totalPage;$i++): ?>
                <li class="page-item"><a class="page-link <?=$i==$page?"active":""?>" href="<?=orderLink("nextPage",$amount_limit,$orderType,$order,$orderState)?>&page=<?=$i?>"><?=$i?></a></li>
                  <?php endfor; ?>
                    <a class="page-link" href="<?=orderLink("nextPage",$amount_limit,$orderType,$order,$orderState)?>&page=<?=$page+1>$totalPage?$page=$totalPage:$page=$page+1?>" aria-label="Next">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
            </ul>
            </nav>
        </div>
    </main>

    <script>
      const amount_limit_select=document.querySelector("#amount-limit");
      amount_limit_select.addEventListener("change",function(){
        window.location.assign("<?=orderLink("amount-list",$amount_limit,$orderType,$order,$orderState)?>"); 
        console.log("<?=$amount_limit?>");
      })
      const select_all=document.querySelector("#select-all");
      const selects=document.querySelectorAll(".check-select");
      let isSelectAll=false;
      select_all.addEventListener("change",function(){
        isSelectAll=!isSelectAll;
        // console.log(isSelectAll);
        if(isSelectAll){
          for(let checkbox of selects){
            checkbox.checked=true;
          }
        }else{
          for(let checkbox of selects){
            checkbox.checked=false;
          }
        }
      })
      
    </script>
</body>

</html>
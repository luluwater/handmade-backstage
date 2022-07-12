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
  $searchItems=$_GET["search"]??"";
  $searchText=$_GET["searchText"]??"";
  $searchType=$_GET["searchType"]??"";
  switch($item){
    case "state":
        $orderState=$orderState?0:1;
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState&searchText=$searchText&searchType=$searchType";
      break;
      case "nextPage":
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState&search=$searchItems&searchText=$searchText&searchType=$searchType";
        break;   
      case "amount-list":
        $cur_amount_limit=$cur_amount_limit==10?5:10;
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState&searchText=$searchText&searchType=$searchType";
        break;   
      default:
        if($orderType==$item){ 
          $order=$order=="ASC"?"DESC":"ASC";
        }else{
          $orderType=$item;
        }    
        return  "course.php?type=$type&amount-limit=$cur_amount_limit&orderType=$orderType&order=$order&orderState=$orderState&searchText=$searchText&searchType=$searchType";  
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
$searchText=$_GET["searchText"]??"";
$searchType=$_GET["searchType"]??"";
// echo $orderType;

$secendOrder="$orderType $order";
$start=($page-1)*$amount_limit;


$stmtCategory=$db_host->prepare("SELECT * FROM category");
$stmtCategory->execute();
$rowsCategory=$stmtCategory->fetchALL(PDO::FETCH_ASSOC);
if($searchText != "" && $searchType !=""){
  $sqlWhere="AND $searchType LIKE '%$searchText%'";
}else{
  $sqlWhere="";
}

if($type=="course"){
  $stmtAll=$db_host->prepare("SELECT *,category.category_name FROM course 
  JOIN course_img ON course.id=course_img.course_id 
  JOIN category ON course.category_id=category.id 
  WHERE isDelete=0 $sqlWhere
  GROUP BY course_id");

  $stmt=$db_host->prepare("SELECT course.id,course_img.img_name,name,category.category_en_name,amount,price,sold_amount,state,user_like FROM course 
  JOIN category ON course.category_id=category.id 
  JOIN course_img ON course.id=course_img.course_id
  WHERE isDelete=0 $sqlWhere
  GROUP BY id 
  ORDER BY state $orderStateType ,$secendOrder
  LIMIT $start,$amount_limit");
}else if($type=="product"){
  $stmtAll=$db_host->prepare("SELECT *,category.category_name FROM product 
  JOIN product_img ON product.id=product_img.product_id 
  JOIN category ON product.category_id=category.id
  WHERE isDelete=0 $sqlWhere
  GROUP BY product_id");
  
  $stmt=$db_host->prepare("SELECT product.id,product_img.img_name,name,category.category_en_name,amount,price,sold_amount,state,user_like FROM product 
  JOIN category ON product.category_id=category.id 
  JOIN product_img ON product.id=product_img.product_id
  WHERE isDelete=0 $sqlWhere  
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
        <link rel="stylesheet" href="./order/css/order-list-style.css">

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
            <form action="" method="get">
            <div class="row  my-4">
                <div class="col-2">
                    <select class="form-select" name="searchType" aria-label="Default select example">
                        <option value="<?=$type?>.id" selected>課程編號</option>
                        <option value="name">課程名稱</option>
                        <option value="category_name">類別</option> 
                    </select>
                </div>
                <div class="col-6">
                    <input class="form-control" type="search" name="searchText" id="searchText" required>
                </div>
                <div class="col-1">
                    <input type="hidden" name="type" value="<?=$type?>">
                    <button type="submit" class="btn btn-bg-color">搜索</button>
                </div>
            </div>
            </form>
            <form action="do-discontinued-state.php" method="post">
              <input type="hidden" name="type" value="<?=$_GET["type"]?>">
            <div class="text-end my-4">
              <button type="submit" class="m-2 border-0 bg-transparent up-down" name="上架"><i class="fa-solid fa-up-long m-2"></i>上架課程</button>
              <button type="submit" class="m-2 border-0 bg-transparent up-down" name="下架"><i class="fa-solid fa-down-long m-2"></i>下架課程</button>
              <a href="creat-new-product.php?type=<?=$type?>" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增課程</a>
              
            </div>
            <table class="table align-items-center">
              <thead class="table-head">
                <tr class="text-center">
                  <td class="col-1">
                    <input type="checkbox" id="select-all" class="form-check-input" autocomplete="off">
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
                    <a href="<?=orderLink("user_like",$amount_limit,$orderType,$order,$orderState)?>">
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
                      <input type="checkbox" class="check-select form-check-input" name="checked[]" value="<?=$row["id"]?>" autocomplete="off">
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
                    <td><?=$row["user_like"]?></td>
                    <td>
                      <a class="m-2 up-down" href="edit-product.php?type=<?=$type?>&id=<?=$row["id"]?>"><i class="fa-solid fa-pen"></i></a>
                      <a class="delete m-2 up-down" data-id="<?=$row["id"]?>"><i class="fa-solid fa-trash" ></i></a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
            </form>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="<?=orderLink("nextPage",$amount_limit,$orderType,$order,$orderState)?>&page=<?=$page-1<1?$page=1:$page-1?>" aria-label="Previous">
                        <span aria-hidden="true"><</span>
                    </a>
                </li>
                <?php
                  $maxPageLimit=$page+5>$totalPage?$totalPage:$page+5;
                  $minPageLimit=$totalPage>10?10:$totalPage;
                ?>
                <?= $page>5?"<li>...</li>":""?>
                <?php if($page>5): ?>                  
                  <?php for($i=$page-5;$i<=$maxPageLimit;$i++): ?>
                  <li class="page-item">
                    <a class="page-link <?=$i==$page?"active":""?>" href="<?=orderLink("nextPage",$amount_limit,$orderType,$order,$orderState)?>&page=<?=$i?>"><?=$i?></a>
                  </li>
                  <?php endfor; ?>                  
                <?php else: ?>
                <?php for($i=1;$i<=$minPageLimit;$i++): ?>
                  <li class="page-item">
                    <a class="page-link <?=$i==$page?"active":""?>" href="<?=orderLink("nextPage",$amount_limit,$orderType,$order,$orderState)?>&page=<?=$i?>"><?=$i?></a>
                  </li>
                <?php endfor; ?>
                <?php endif ?>
                <?= $page+5<$totalPage?"...":"" ?>
                    <a class="page-link" href="<?=orderLink("nextPage",$amount_limit,$orderType,$order,$orderState)?>&page=<?=$page+1>$totalPage?$page=$totalPage:$page=$page+1?>" aria-label="Next">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
            </ul>
            </nav>
        </div>
    </main>
    <div class="confirm d-none" id="confirm">
      <div class="popup d-flex align-items-center">
        <div class="close" id="close">X</div>
        <div class="content">
            <h3 class="confirm-h3 my-3">是否確定刪除?</h3>
            <a href="" class="btn btn-bg-color btn-cancel-color" id="cancelBtn">取消</a>
            <a href="" class="btn btn-main-color confirm-btn" id="confirm-btn">確認</a>
        </div>
      </div>
    </div>
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
      const confirm = document.querySelector("#confirm");
      const close = document.querySelector("#close");
      const deletes=document.querySelectorAll(".delete");
      close.addEventListener('click', () => {
        confirm.classList.add('d-none');
      })
      for(let deleteBtn of deletes)
        deleteBtn.addEventListener("click",function(){
        confirm.classList.remove('d-none');
        confirmBtn=confirm.querySelector("#confirm-btn");
        confirmBtn.setAttribute("href",`do-delete-product.php?type=<?=$type?>&id=${this.dataset.id}`);
      })

      
    </script>
</body>

</html>
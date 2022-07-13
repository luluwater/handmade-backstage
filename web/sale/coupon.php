<?php

require("../../db-connect.php");

//========== PAGE ==========
if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}



//取得每頁看到幾欄
$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']) : 5;

//每頁開始的id
$start = ($page - 1) * $pageView;

function orderLink($item, $cur_pageView, $sale_state_category)
{
  isset(($_GET["keyword"])) ?  $keyword = $_GET["keyword"] : $keyword = "";
  isset($_GET["sale_state_category"]) ? $sale_state_category = $_GET["sale_state_category"] : $_GET["sale_state_category"] = "";

  switch ($item) {
    case "nextPage":
      return  "coupon.php?&pageView=$cur_pageView&keyword=$keyword&sale_state_category=$sale_state_category";
      break;
    case "pageView":
      $cur_pageView = $cur_pageView == 10 ? 5 : 10;
      return  "coupon.php?&pageView=$cur_pageView&keyword=$keyword&sale_state_category=$sale_state_category";
      break;

    default:
      $sale_state_category = $item;

      return  "coupon.php?&pageView=$cur_pageView&keyword=$keyword&sale_state_category=$sale_state_category";
      break;
  }
}

isset($_GET["keyword"]) ?  $keyword = $_GET["keyword"] : $keyword = "";
isset($_GET["sale_state_category"]) ? $sale_state_category = $_GET["sale_state_category"] : $sale_state_category = $_GET["sale_state_category"] = "";


// 1=接下來 2=進行中 3=已結束
if ($keyword != "" && $sale_state_category == "") {
  $sqlWhere = "AND coupon.name LIKE '%$keyword%'";
} elseif ($keyword != "" && $sale_state_category == "1") {
  $sqlWhere = "AND coupon.state = 1 AND  coupon.name LIKE '%$keyword%' ";
} elseif ($keyword != "" && $sale_state_category == "2") {
  $sqlWhere = "AND coupon.state = 2 AND coupon.name LIKE '%$keyword%' ";
} elseif ($keyword != "" && $sale_state_category == "3") {
  $sqlWhere = "AND coupon.state = 3 AND coupon.name LIKE '%$keyword%' ";
} elseif ($sale_state_category == "1") {
  $sqlWhere = "AND coupon.state = 1";
} elseif ($sale_state_category == "2") {
  $sqlWhere = "AND coupon.state = 2";
} elseif ($sale_state_category == "3") {
  $sqlWhere = "AND coupon.state = 3";
} else {
  $sqlWhere = "";
}


//========== coupon 主要的資料表 & search ==========

$sql = $db_host->prepare("SELECT coupon.*, sale_state_category.name AS sale_state_name FROM coupon
JOIN sale_state_category ON coupon.state = sale_state_category.id  
WHERE coupon.state!=0 $sqlWhere  ORDER BY end_date DESC LIMIT $start , $pageView");

$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

$sqlAll = $db_host->prepare("SELECT * FROM coupon WHERE coupon.state!=0 $sqlWhere ");
$sqlAll->execute();
$rowsAll = $sqlAll->fetchAll(PDO::FETCH_ASSOC);
$discountAllCount = count($rowsAll);



//========== Page ==========
//開始的筆數
$startItem = ($page - 1) * $pageView + 1;
//結束的筆數
$endItem = $page * $pageView;
if ($endItem > $discountAllCount) $endItem = $discountAllCount;

//總筆數
$totalPage = ceil($discountAllCount / $pageView);

//上一頁
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
//下一頁
$nextPage = (($page + 1) > $totalPage) ? $totalPage : ($page + 1);


?>





<!doctype html>
<html lang="tw-zh">

<head>
  <title>優惠券-手手</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/style-sale.css">
  <style>
    tbody td {
      vertical-align: middle;
    }

    tbody td a {
      color: #D7BAA5;
    }

    tbody td a:hover {
      vertical-align: middle;
      color: #D6624F;
    }

    .active {
      background-color: #D6624F;
    }

    .page-item {
      font-weight: 700;
    }

    .page-link {
      color: var(--main-word-color);
    }

    .page-link:hover {
      color: var(--main-color);
    }

    .active>.page-link,
    .page-link.active {
      background: #fff;
      color: var(--main-color);
    }

    .actived {
      background-color: #D6624F;
    }

    .active {
      background: #fff;
    }

    tbody>tr:hover {
      background-color: #eeeeee;
    }

    .hide {
      display: none;
    }

    .popup {
      width: 500px;
      height: 150px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 5px rgba(0, 0, 0, .2);
      position: fixed;
      top: 0;
      bottom: 0;
      margin: auto;
      left: 0;
      right: 0;
      padding: 15px;
    }

    .popup h3 {
      font-size: 20px;
      margin: 20px auto;
      font-weight: bold;
    }

    .confirm {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 5;
    }

    .black-box {
      position: fixed;
      background: rgba(0, 0, 0, .5);
      width: 100%;
      height: 100%;
      z-index: 4;
      top: 0;
      left: 0;
    }
  </style>
</head>

<body>
  <?php
  require("../main-menu.html");
  ?>

  <main>

    <!-- ==================== state bar 狀態頁籤 ==================== -->
    <div class="mb-4">
      <div class="title">優惠券</div>
      <div><br></div>
      <div class="status-bar">
        <ul class="d-flex list-unstyled justify-content-around align-items-center m-0 h-100 ">
          <li class="status-button">
            <a href="coupon.php" class="status-a text-center fs-5
              <?php if ($sale_state_category == "") echo "actived"; ?>" name="all">全部活動</a>
          </li>
          <li class="status-button">
            <a class="status-a text-center fs-5
              <?php
              if ($sale_state_category == 1) echo "actived";
              ?>" href="<?= orderLink("1", $pageView, $sale_state_category) ?>">接下來</a>
          </li>
          <li class="status-button">
            <a class="status-a text-center fs-5
              <?php
              if ($sale_state_category == 2) echo "actived";
              ?>" href="<?= orderLink("2", $pageView, $sale_state_category) ?>">進行中</a>
          </li>
          <li class="status-button">
            <a class="status-a text-center fs-5
              <?php
              if ($sale_state_category == 3) echo "actived";
              ?>" href="<?= orderLink("3", $pageView, $sale_state_category) ?>">已結束</a>
          </li>
        </ul>
      </div>

      <div class="container-fluid">
        <!-- ==================== 每頁顯示幾筆 ==================== -->
        <div class="d-flex justify-content-between  mt-4">
          <p class="title"></p>
          <div class="d-flex justify-content-between align-items-center display-page-box">
            <p class="m-0">顯示&nbsp;&nbsp;</p>
            <form action="" method="get" class="pageForm" class="text-center">
              <select name="pageView" class="display-page form-select mx-1 " id="pageView">
                <option value="5" <?php if ($pageView == '5') print 'selected '; ?>> 5 </option>
                <option value="10" <?php if ($pageView == '10') print 'selected '; ?>> 10 </option>
              </select>
            </form>
            <p class="m-0">&nbsp;&nbsp;筆</p>
          </div>
          </form>

        </div>

        <!-- ==================== 搜尋、新增優惠券 ==================== -->
        <form action="coupon.php" method="get">
          <div class="row my-4">
            <div class="col-4">
              <input class="form-control mx-2 searchText" name="keyword" placeholder="活動名稱">
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-bg-color">搜尋</button>
            </div>
          </div>
        </form>
        <div class="text-end my-4">
          <a href="coupon-create.php" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增優惠券</a>
        </div>

        <!-- ==================== table ==================== -->
        <table class="table">
          <thead class="table-head">
            <tr class="text-center">
              <td class="col-2">折扣碼</td>
              <td class="col-3">優惠券名稱</td>
              <td class="col-2">折扣內容</td>
              <td class="col-3">活動期間</td>
              <td class="col-1">狀態</td>
              <td class="col-1">操作</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $row) : ?>
              <tr class="text-center">
                <td><?= $row["discount_code"] ?></td>
                <td><?= $row["name"] ?></td>
                <td>
                  <?php if ($row["discount_type_id"] == 1) : ?>
                    原價 x <?= $row["coupon_discount"] ?>
                  <?php elseif ($row["discount_type_id"] == 2) : ?>
                    滿 <?= $row["pay"] ?> 折 <?= $row["coupon_discount"] ?>
                  <?php endif; ?>
                </td>
                <td><?= $row["start_date"] ?> - <?= $row["end_date"] ?></td>
                <td><?= $row["sale_state_name"] ?></td>

                <!-- ==================== 編輯\刪除 ==================== -->
                <td>
                  <a href="coupon-edit.php?id=<?= $row["id"] ?>" name="edit">編輯</a><br>
                  <a class="delete-btn" data-id=<?= $row["id"] ?>>刪除</a><br>
                </td>
              </tr>
          </tbody>
        <?php endforeach; ?>
        <!-- 是否確定刪除盒子 -->
        <div class="confirm hide " id="confirm">
          <div class="popup">
            <div class="content text-center">
              <h3 class="confirm-h3">確定要刪除此活動嗎</h3>
              <div class="text-center">
                <a href="" class="mx-2 btn btn-bg-color btn-cancel-color" id="cancelBtn">我再想想！！！</a>
                <a href="" class="mx-2 btn btn-main-color " id="confirm-btn">我要刪除！！！</a>
              </div>
            </div>
          </div>
        </div>
        <!-- 是否確定刪除盒子 -->
        <div class="" id="black-box"></div>

        </table>
        <!-- ========== 分頁 ========== -->
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center mt-5">
            <div class="d-flex">
              <li class="page-item">
                <a class="page-link" href="<?= orderLink("nextPage", $pageView, $sale_state_category) ?>&page=<?= $page - 1 < 1 ? $page = 1 : $page - 1 ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                <li class="page-item <?php if ($page == $i) echo "active" ?>">
                  <a class="page-link" href="coupon.php?page=<?= $i ?>&pageView=<?= $pageView ?>&sale_state_category=<?= $sale_state_category ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>



              <li class="page-item">
                <a class="page-link" href="<?= orderLink("nextPage", $pageView, $sale_state_category) ?>&page=<?= $page + 1 > $totalPage ? $page = $totalPage : $page = $page + 1 ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </div>


            <li class="px-5 py-2">
              <?php if (!isset($_GET['keyword'])) : ?>
              <?php elseif ($_GET['keyword'] = $_GET["keyword"]) : ?>
                <div class="mpt-2 d-flex">關鍵字<p class="text-danger fw-bold">&nbsp;<?= $_GET['keyword'] ?>&nbsp;</p>的搜尋結果
                <?php else : ?>
                <?php endif; ?>
                第 <?= $startItem ?> - <?= $endItem ?>&nbsp; 筆 , 共 <?= $discountAllCount ?> 筆資料
            </li>
            <!-- 頁碼結束 -->
      </div>
    </div>
    </div>
  </main>
</body>

<script>
  const pageView = document.querySelector("#pageView");
  pageView.addEventListener("change", function() {
    window.location.assign("<?= orderLink("pageView", $pageView, $sale_state_category) ?>");
  })

  let deleteBtn = document.querySelectorAll(".delete-btn");
  let confirm = document.querySelector("#confirm");
  let confirmBtn = document.querySelector("#confirm-btn");
  let cancelBtn = document.querySelector("#cancelBtn");
  let blackBox = document.querySelector("#black-box");

  for (let i = 0; i < deleteBtn.length; i++) {
    deleteBtn[i].addEventListener('click', function() {
      let id = this.dataset.id;
      confirm.classList.remove('hide')
      blackBox.classList.add('black-box')
      confirm.classList.add('animate__animated')
      confirm.classList.add('animate__bounceIn')
      confirmBtn.href = `coupon-doDelete.php?id=${id}`
    })
  }

  confirmBtn.addEventListener('click', () => {
    confirm.classList.add('hide')
    blackBox.classList.remove('black-box')
    confirm.classList.remove('animate__bounceIn')



  })
  cancelBtn.addEventListener('click', () => {
    confirm.classList.add('hide')
    blackBox.classList.remove('black-box')
    confirm.classList.remove('animate__bounceIn')

  })
</script>

</html>
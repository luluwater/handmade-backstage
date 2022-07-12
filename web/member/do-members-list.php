<?php
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

if(isset($_GET["page"])){
    $page=$_GET["page"];
  }else{
    $page=1;
}

function orderLink($item, $cur_pageView, $order)
{
    isset(($_GET["search"])) ?  $search = $_GET["search"] : $search = "";
    isset($_GET["state"]) ? $state = $_GET["state"] : $_GET["state"] = "";

    switch ($item) {
        case "nextPage":
            return  "members-list.php?&pageView=$cur_pageView&order=$order&search=$search&state=$state";
            break;
        case "pageView":
            $cur_pageView = $cur_pageView == 10 ? 5 : 10;
            return  "members-list.php?&pageView=$cur_pageView&order=$order&search=$search&state=$state";
            break;
        
        default:
            $order=$item;
        
          return  "members-list.php?&pageView=$cur_pageView&order=$order&search=$search&state=$state";
        break;
    }
}

isset($_GET["search"])?  $search = $_GET["search"] : $search = "";
isset($_GET["state"]) ? $state = $_GET["state"] :$state = $_GET["state"] = "";

//取得每頁看到幾欄
$pageView = $_GET['pageView'] ?? 5;
//每頁開始的id
$start = ($page - 1) * $pageView;
//取得排序方式
$order = isset($_GET["order"]) ? $_GET["order"] : 1;

switch($order){
  case 1:
    $orderType = "id ASC";
    break;
  case 2:
    $orderType = "id DESC";
    break;

  default:
    $orderType = "id ASC";
}
// 1=一般會員 & 2=黑名單
if ($search!="" && $state ==""){
    $sqlWhere="WHERE user.account LIKE '%$search%'";
    echo "search";
  }elseif($search!="" && $state ==""){
    $sqlWhere="WHERE user.state = 1 AND  user.account LIKE '%$search%' ";
    echo "search",1;
  }elseif ($search!="" && $state =="2"){
    $sqlWhere="WHERE user.state = 2 AND user.account LIKE '%$search%' ";
    echo "search",2;
  }elseif ($state=="1"){
    $sqlWhere="WHERE user.state = 1";
    echo 1;
  }elseif ($state=="2"){
    $sqlWhere="WHERE user.state = 2";
    echo 2;
  } else {
    $sqlWhere =""; 
  }

//全部會員資料 & 搜尋
$sql = $db_host->prepare("SELECT user.*, user_state_category.name AS user_state_name FROM user
JOIN user_state_category ON user.state = user_state_category.id 
$sqlWhere
ORDER BY $orderType LIMIT $start, $pageView");
// echo $sql ;

$sql->execute();
$memberPageCount = $sql->fetchAll(PDO::FETCH_ASSOC);

$sqlAll = $db_host->prepare("SELECT * FROM user $sqlWhere");
$sqlAll->execute();
$rows = $sqlAll->fetchAll(PDO::FETCH_ASSOC);
$memberCount = count($rows);


//開始的筆數
$startItem = ($page - 1) * $pageView + 1;
//結束的筆數
$endItem = $page * $pageView;
if ($endItem > $memberCount) $endItem = $memberCount;
//總筆數
$totalPage = ceil($memberCount / $pageView);
//上一頁
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
//下一頁
$theNextPage = (($page + 1) > $totalPage) ? $totalPage : ($page + 1);

?>
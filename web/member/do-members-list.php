<?php
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

if(isset($_GET["page"])){
    $page=$_GET["page"];
  }else{
    $page=1;
}

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

//取得會員狀態頁面
$state = isset($_GET['state']) ? $_GET['state']: "全部會員";
if ($state!="全部會員"){
  $state = $_GET["state"];
  $sqlWhere="WHERE user.state =$state";
}else{
  $state="";
  $sqlWhere="";
}

//取得每頁看到幾欄
$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']) : 5;
//每頁開始的id
$start=($page-1)*$pageView;

//會員總數算頁數
$sqlAll = "SELECT * FROM user";
$resultAll= $db_host->prepare($sqlAll);
$resultAll->execute();
$rowsAll = $resultAll->fetchAll(PDO::FETCH_ASSOC);
$membersAllCount = count($rowsAll);

//會員狀態
$sqlState = "SELECT * FROM user_state_category" ;
$resultState= $db_host->prepare($sqlState);
$resultState->execute();
$rowsState = $resultState->fetchAll(PDO::FETCH_ASSOC);


//全部會員資料
$sql = "SELECT user.*, user_state_category.name AS user_state_name FROM user
JOIN user_state_category ON user.state = user_state_category.id $sqlWhere
ORDER BY $orderType LIMIT $start, $pageView"; //here
$result= $db_host->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$memberCount = count($rows);

//頁數開始的筆數
$startItem=($page-1)*$pageView+1;
//頁數結束的筆數
$endItem=$page*$pageView;
if($endItem>$membersAllCount) $endItem=$membersAllCount;
//無條件進位筆數
$totalPage = ceil( $membersAllCount / $pageView ); 
//上一頁
$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);
//下一頁
$nextPage = (($page + 1) >$totalPage) ? $totalPage: ($page + 1);

?>
<?php
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

//測試連線
// try{
//     $db_host=new PDO("mysql:host={$serverName};dbname={$dbname};charset=utf8",$username,$password);
//     echo "成功";
        
// }catch(PDOException $e){
//     echo "資料庫連線失敗";
//     echo "Error: ".$e->getMessage();
//     exit;
// }


if(isset($_GET["page"])){
    $page=$_GET["page"];
  }else{
    $page=1;
  }

//取得每頁看到幾欄
$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']):5;
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
JOIN user_state_category ON user.state = user_state_category.id LIMIT $start, $pageView";
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
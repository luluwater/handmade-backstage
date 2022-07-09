<?php

require("../../db-connect.php");


if(isset($_GET["page"])){
    $page=$_GET["page"];
  }else{
    $page=1;
}

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


$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']):5;
$start=($page-1)*$pageView;

$sqlAll = "SELECT * FROM user";
$resultAll= $db_host->prepare($sqlAll);
$resultAll->execute();
$rowsAll = $resultAll->fetchAll(PDO::FETCH_ASSOC);
$membersAllCount = count($rowsAll);

$sqlState = "SELECT * FROM user_state_category" ;
$resultState= $db_host->prepare($sqlState);
$resultState->execute();
$rowsState = $resultState->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT user.*, user_state_category.name AS user_state_name FROM user
JOIN user_state_category ON user.state = user_state_category.id ORDER BY $orderType LIMIT $start, $pageView";
$result= $db_host->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$memberCount = count($rows);

$startItem=($page-1)*$pageView+1;

$endItem=$page*$pageView;
if($endItem>$membersAllCount) $endItem=$membersAllCount;

$totalPage = ceil( $membersAllCount / $pageView ); 

$PreviousPage = (($page - 1) < 1) ? 1 : ($page - 1);

$nextPage = (($page + 1) >$totalPage) ? $totalPage: ($page + 1);
?>
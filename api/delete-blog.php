<?php
require_once("../db-connect.php");

if(isset($_POST["blog_id"])){

    $blog_id=$_POST["blog_id"];
    $orderType=$_POST["orderType"];
    $start=$_POST["start"];
    $pageView=$_POST["pageView"];
    $stmtDelete=$db_host->prepare("UPDATE blog SET valid=0 WHERE id='$blog_id'");
    $stmt=$db_host->prepare("SELECT blog.*,category.category_name FROM blog JOIN category ON  blog.category_id = category.id  WHERE blog.valid=1  ORDER BY $orderType LIMIT $start,$pageView");

}

    


try {
    $stmt->execute();
    $stmtDelete->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}


    echo json_encode($result);
  
    
    exit;

?>
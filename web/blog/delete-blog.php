<?php
<<<<<<< HEAD
// require_once("../../db-connect.php");



// $blog_id=$_POST["blog_id"];
    
// $stmtDelete=$db_host->prepare("UPDATE blog SET valid=0 WHERE id='$blog_id'");

// $stmt=$db_host->prepare("SELECT * FROM blog INNER JOIN category ON blog.id=category.id  WHERE blog.valid=1  ORDER BY create_time DESC");

// try {
//     $stmt->execute();
//     $stmtDelete->execute();
//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
//     echo "預處理陳述式執行失敗！ <br/>";
//     echo "Error: " . $e->getMessage() . "<br/>";
//     $db_host = NULL;
//     exit;
// }


//     echo json_encode($result);
//     header('Location:'. $_SERVER['HTTP_REFERER']);
//     exit;

?>



<?php
=======
>>>>>>> efc37a07a995910586736d8b5f8b6943bf49bad7
require_once("../../db-connect.php");

$id=$_GET["id"];
$PreviousPage=$_GET["page"];
$pageView=$_GET["pageView"];
$order=$_GET["order"];

<<<<<<< HEAD
echo $id;
echo $PreviousPage;
echo $pageView;
echo $order;

=======
>>>>>>> efc37a07a995910586736d8b5f8b6943bf49bad7
$sql = $db_host->prepare("UPDATE course_order SET valid=0 WHERE id='$id'");

try {
    $sql->execute();
    echo "刪除! <br/>";
    
} catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header('Location:'. $_SERVER['HTTP_REFERER']);


?>
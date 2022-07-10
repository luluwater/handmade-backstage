<?php
require_once("../db-connect.php");

if(isset($_POST["fromDate"],$_POST["toDate"])){

  $fromDate=$_POST["fromDate"];
  $toDate=$_POST["toDate"];
  $orderType=$_POST["orderType"];
  $start=$_POST["start"];
  $pageView=$_POST["pageView"];
 

 $stmtDate=$db_host->prepare("SELECT blog.*,category.category_name FROM blog JOIN category ON blog.category_id = category.id 
  WHERE create_time BETWEEN '$fromDate' AND '$toDate' AND blog.valid=1 ORDER BY  $orderType
  LIMIT $start,$pageView");
}
 
try {
    $stmtDate->execute();
    $dateQuery = $stmtDate->fetchAll(PDO::FETCH_ASSOC);
    $orderCount = count($dateQuery);
   

} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
?>


<?php  if ($dateQuery): ?>
<table class="table h-0 mt-4 mb-0 text-center">
    <tbody id="tbody">
        <?php foreach( $dateQuery as $row) :?>
            <tr class="trHover border-bottom">
                <td class="text-start pb-2">
                <?php      
                    $date=new DateTime($row["create_time"]);
                    echo $date->format('Y-m-d');
                    ?>
                </td>
                <td class="text-start td-height article_title"><a style="color:#3F3F3F;" class="" href="blog-page.php"><?=$row["title"]?></a></td>
                <td><?=$row["category_name"]?></td>
                <td><?=$row["state"]?></td>
                <td><?=$row["comment_amount"]?></td>
                <td><?=$row["favorite_amount"]?></td>
                <td class="text-end"><i class="fas fa-trash-alt"></i></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <div class="mt-3 text-center" style="margin-letft:500px">搜尋到 <?= $orderCount ?> 筆</div>
</table>
<?php else: ?>
    <h1 class="position-absolute top-50 start-50">無符合項目</h1>
<?php endif; ?>
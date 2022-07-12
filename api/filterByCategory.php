<?php

require_once("../db-connect.php");

if(isset($_POST["value"])){

    $value=$_POST["value"];
    $orderType=$_POST["orderType"];
    $start=$_POST["start"];
    $pageView=$_POST["pageView"];
    
    if($value=="all") {
        $stmtQuery=$db_host->prepare("SELECT blog.*,category.category_name FROM blog JOIN category ON blog.category_id = category.id WHERE valid=1  ORDER BY $orderType LIMIT $start,$pageView");
    }else{
         $stmtQuery=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id WHERE blog.category_id='$value' AND blog.valid=1 LIMIT $start,$pageView");
    }
}

try {
    $stmtQuery->execute();
    $categoryQuery = $stmtQuery->fetchAll(PDO::FETCH_ASSOC);
    $orderCount = count($categoryQuery);

} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
?>





<?php  if ($categoryQuery): ?>
<table class="table h-0 mt-4 mb-0 text-center">
    <tbody id="tbody">
        <?php foreach( $categoryQuery as $row) :?>
            <tr class="trHover border-bottom" data-id=<?=$row["id"]?>>
                <td class="text-start pb-2">
                <?php      
                    $date=new DateTime($row["create_time"]);
                    echo $date->format('Y-m-d');
                    ?>
                </td>
                <td class="text-start td-height article_title"><a style="color:#3F3F3F;" class="" href="edit-page.php?id=<?=$row["id"]?>"><?=$row["title"]?></a></td>
                <td><?=$row["category_name"]?></td>
                <td><?=$row["state"]?></td>
                <td><?=$row["comment_amount"]?></td>
                <td><?=$row["favorite_amount"]?></td>
                <td class="text-end"><i data-id=<?=$row["id"]?>  class="trash-btn trash fas fa-trash-alt"></i></td>
            </tr>
        <?php endforeach; ?>
   
    <div class="mt-3 text-center" style="margin-letft:500px">搜尋到 <?= $orderCount ?> 筆</div>

    <?php else :?>

<?php endif; ?>


<?php
require_once("../db-connect.php");


if(isset($_POST["target_name"])){


$order=$_POST["target_name"];
$sort=$_POST["order"];

if($sort=="desc"){
    $sort="asc";
}else{
    $sort="desc"; 
}

$stmtSort=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id ORDER BY ".$_POST["target_name"]. " ".$_POST["order"]." LIMIT 0,5");

}



try {
    $stmtSort->execute();
    $sortyQuery = $stmtSort->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
?>

<table class="table h-0 mt-4 mb-0 text-center" id="table">
            <thead class="table-head">
                <tr>
                    <td class="col-1 text-start">日期<i data-order=<?=$sort?> id="create_time" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-3 text-start">文章標題</td>
                    <td class="col-1">分類 <i data-order=<?=$sort?> id="category_id" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">狀態 <i data-order=<?=$sort?> id="state" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">留言數 <i data-order=<?=$sort?> id="comment_amount" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">收藏數 <i data-order=<?=$sort?> id="favorite_amount" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1 text-end">編輯</td>
                </tr>
            </thead>

            <tbody id="tbody">
                <?php foreach( $sortyQuery as $row) :?>
                <a href="create-blog.php">
                    <tr class="trHover border-bottom">
                        <td class="text-start pb-2">
                            <?php      
                            $date=new DateTime($row["create_time"]);
                            echo $date->format('Y-m-d');
                            ?>
                        </td>
                        <td class="text-start td-height"><?=$row["title"]?></td>
                        <td><?=$row["category_name"]?></td>
                        <td><?=$row["state"]?></td>
                        <td> <?=$row["comment_amount"]?></td>
                        <td> <?=$row["favorite_amount"]?></td>
                         <td class="text-end"><i class="fas fa-trash-alt"></i></td>
                    </tr>
                </a>
                <?php endforeach; ?>
            </tbody>

            <!-- Loading spinner -->
            <div class="spinner-border position-absolute top-50 start-50" style="display:none" id="loadSpinner" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
</table> 



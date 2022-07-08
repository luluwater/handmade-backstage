<?php

require_once("../db-connect.php");

if(isset($_POST["request"])){

    $request=$_POST["request"];
    if($request=="all") {
        $stmtQuery=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id LIMIT 0,5");
    }else{
         $stmtQuery=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id WHERE blog.category_id='$request' LIMIT 0,5");
    }
}

try {
    $stmtQuery->execute();
    $categoryQuery = $stmtQuery->fetchAll(PDO::FETCH_ASSOC);
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
                <td>55</td>
                <td>24</td>
                <td class="text-end"><i class="fas fa-pen"></i></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
<h1 class="position-absolute top-50 start-50" >請選擇分類條件</h1>
<?php endif; ?>




<?php

require_once("../db-connect.php");





if(isset($_POST["target_name"])){

    $order=$_POST["target_name"];

    switch ($order) {
        case 'orderByDate':
            $stmtSort=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id ORDER BY create_time ASC LIMIT 0,5");
            break;
        case 'orderByCategory':
              $stmtSort=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id ORDER BY category_id ASC LIMIT 0,5");
            break;
        case 'orderByStatus':
            $stmtSort=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id ORDER BY state ASC LIMIT 0,5");
            break;
        case 'orderByComment':
            $stmtSort=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id ORDER BY state ASC LIMIT 0,5");
            break;
        case 'orderByFavorite':
            
            break;
            
        default:
            
            break;
    }    
     
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


<?php  if ($sortyQuery): ?>
    <table class="table h-0 mt-4 mb-0 text-center">
        <tbody id="tbody">
            <?php foreach( $sortyQuery as $row) :?>
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


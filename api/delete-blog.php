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
    $orderCount = count($result);
    header('refresh:2; url=manage-blog.php');
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
    exit;

?>
    <table class="table h-0 mt-4 mb-0 text-center">
        <tbody id="tbody">
            <?php foreach( $result as $row) :?>
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
                <td><?=$row["comment_amount"]?></td>
                <td><?=$row["favorite_amount"]?></td>
                <td class="text-end"><i class="fas fa-trash-alt"></i></td>
            </tr>
            <?php endforeach; ?>
            <div class="mt-3 text-center" style="margin-letft:500px">搜尋到 <?= $orderCount ?> 筆</div>
        </tbody>
    </table>



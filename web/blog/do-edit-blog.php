<?php
require_once("../../db-connect.php");

$content=$_POST["content"];
$currentId=$_POST["currentId"];
$title=$_POST["title"];
$user=$_POST["user"];

$stmtBlog=$db_host->prepare("UPDATE blog SET content='$content' WHERE id='$currentId'");

try {
    $stmtBlog->execute();
    $blog = $stmtBlog->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

$db_host = NULL;
 
?>

<div id="test">
        <div id="editor" name="content">
            <?php
            echo $content;
        ?>
    </div>
</div>
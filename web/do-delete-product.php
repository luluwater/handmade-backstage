<?php
require("../db-connect.php");
$type=$_GET["type"];
$id=$_GET["id"];
echo $type;
echo $id;
// exit;
$stmt=$db_host->prepare("UPDATE $type SET isDelete=1 WHERE id = $id");
$stmt->execute([]);

echo "<script>history.go(-1)</script>";
?>
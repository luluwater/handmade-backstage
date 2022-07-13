<?php
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

if(isset($_SESSION["account"])){
    session_destroy();
}
header("location:login-admin.php");

?>

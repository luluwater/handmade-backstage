<?php
require("../../db-connect.php");
    if(!isset($_POST["store_img"])){
        echo "沒有帶資料";
        exit;
    }
    $store_img=$_POST["store_img"];
    $store_name=$_POST["store_name"];
    $intro=$_POST["intro"];
    $category=$_POST["category"];
    $MRT_station=$_POST["MRT_station"];
    $station_line=$_POST["station_line"];
    $route=$_POST["route"];
    $opening_hour=$_POST["opening_hour"];
    $IG_url=$_POST["IG_url"];
    $FB_url=$_POST["FB_url"];
    

    $sql="SELECT category_en_name FROM 
    category WHERE category.id = ?";
    $stmt=$db_host->prepare($sql);
    
    $stmtCategoryName->execute([$category]);
    $row=$stmtCategoryName->fetch();   
    $categoryName=$row["category_en_name"]; 
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
    $phone=$_POST["phone"];
    $opening_hour=$_POST["opening_hour"];
    $IG_url=$_POST["IG_url"];
    $FB_url=$_POST["FB_url"];
    

    $sql="INSERT INTO store 
    (name,intro,route,phone,opening_hour,FB_url,IG_url) 
    VALUES(:store_name,:intro,:route,:phone,
    :opening_hour,:IG_url,:FB_url)";
    $stmt=$db_host->prepare($sql);
    
    $sqlOther="INSERT INTO category
    (caregory)VALUES(:category)";
    $stmt1=$db_host->prepare($sqlOther);
    

    $sqlMrt="INSERT INTO mrt(MRT_station,station_line)
    VALUES(:MRT_station,:station_line)";
    $stmt2=$db_host->prepare($sqlMrt);
    try {
    $sql->execute([
        ":store_img"=>$store_img,
        ":stoer_name"=>$stoer_name,
        ":intro"=>$intro,
       
        ":MRT_station"=>$MRT_station,
        ":station_line"=>$station_line,
        ":route"=>$route,
        ":opening_hour"=>$opening_hour,
        ":IG_url"=>$IG_url,
        ":FB_url"=>$FB_url,


    ]);
   
    echo "修改完成";
   

    } catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
     }

     //更新完回到這頁
      header("location:store.php?id=$_POST[id]");





    ?>
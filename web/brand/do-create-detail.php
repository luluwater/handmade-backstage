<?php
require("../../db-connect.php");
require("../../api/upload-image.php");
    // if(!isset($_POST["intro"])){
    //     echo "沒有帶資料";
    //     exit;
    // }
    
    // $store_img=$_POST["store_img"];
    $store_name=$_POST["store_name"];
    $intro=$_POST["intro"];
    $address=$_POST["address"];
    $category_id=$_POST["category"];
    $MRT_station=$_POST["MRT_station"];
    // $station_line=$_POST["station_line"];
    $route=$_POST["route"];
    $phone=$_POST["phone"];
    $opening_hour=$_POST["opening_hour"];
    $IG_url=$_POST["IG_url"];
    $FB_url=$_POST["FB_url"];
     
    echo $MRT_station;
  



    $stmt=$db_host->prepare("INSERT INTO store 
    (name,intro,address,route,phone,opening_hour,IG_url,FB_url,category_id,mrt_station,valid) 
     VALUES (:store_name,:intro,:address,:route,:phone,
    :opening_hour,:IG_url,:FB_url,:category_id,:mrt_station,:valid)");





    try {
    $stmt->execute([
        // ":store_img"=>$store_img,
        ":store_name"=>$store_name,
        ":intro"=>$intro,
        ":address"=>$address,
        ":route"=>$route,
        ":phone"=>$phone,
        ":opening_hour"=>$opening_hour,
        ":IG_url"=>$IG_url,
        ":FB_url"=>$FB_url,
        ":category_id"=>$category_id,
        ":mrt_station"=>$MRT_station,
         ":valid"=>1,

    ]);
    uploadFileStore();
    $id=$db_host->lastInsertId();
    upStore_db($id);
    echo "修改完成";
   

    } catch (PDOException $e) {
    echo "預處理陳述式失敗! <br/>";
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
     }

    
      header("location:store.php?id=$_POST[id]");





    ?>
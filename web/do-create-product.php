<?php  
    if(!isset($_POST["product_name"])){
        echo "沒有帶資料";
        exit;
    }
    require("../db-connect.php");

    $productName=$_POST["product_name"];
    $intro=$_POST["intro"];
    $price=$_POST["price"];
    $amount=$_POST["amount"];
    $category=$_POST["category"];
    $store=$_POST["store"];
    $type=$_POST["type"];  
    $notice=$_POST["notice"];
    $now=date('Y-m-d H:i:s');

    $stmtCategoryName=$db_host->prepare("SELECT category_en_name FROM category WHERE category.id = ?");
    $stmtCategoryName->execute([$category]);
    $row=$stmtCategoryName->fetch();   
    $categoryName=$row["category_en_name"]; 
    
    require_once("../api/upload-image.php");

    if($type === "course"){
        $datetime=$_POST["datetime"];
        $hour=$_POST["hour"];
        $stmt=$db_host->prepare("INSERT INTO 
        course (store_id,category_id,create_time,name,intro,amount,price,note,course_date,course_time)
         VALUES (:store_id, :category_id, :create_time, :name, :intro, :amount, :price, :note, :datetime, :hour)");
        try{    
            $stmt->execute([
                ":store_id"=>$store,
                ":category_id"=>$category, 
                ":create_time"=>$now, 
                ":name"=>$productName, 
                ":intro"=>$intro, 
                ":amount"=>$amount, 
                ":price"=>$price, 
                ":note"=>$notice,                 
                ":datetime"=>$datetime, 
                ":hour"=>$hour
            ]);    
            echo "課程輸入成功"; 
        }catch (PDOException $e){
            echo "預處理陳述式執行失敗！ <br/>";
            echo "Error: " . $e->getMessage() . "<br/>";
            // $db_host = NULL;
            exit;
        }
        $course_id = $db_host->lastInsertId();
        upFileToDir($type,$categoryName,$course_id);
        upFileTo_db($type,$course_id);
    }else{
        $stmt=$db_host->prepare("INSERT INTO product (store_id,category_id,create_time,name,intro,amount,price,note) VALUES (:store_id, :category_id, :create_time, :name, :intro, :amount, :price, :note)");

        try{    
            $stmt->execute([
                ":store_id"=>$store,
                ":category_id"=>$category, 
                ":create_time"=>$now, 
                ":name"=>$productName, 
                ":intro"=>$intro, 
                ":amount"=>$amount, 
                ":price"=>$price, 
                ":note"=>$notice,                       
            ]);           
            echo "商品輸入成功";             
        }catch (PDOException $e){
            echo "預處理陳述式執行失敗！ <br/>";
            echo "Error: " . $e->getMessage() . "<br/>";
            // $db_host = NULL;
            exit;
        }
        $product_id = $db_host->lastInsertId();
        upFileToDir($type,$categoryName,$product_id);
        upFileTo_db($type,$product_id);
    }

    
    
    $id=$db_host->lastInsertId();
    
    






    $db_host = NULL;

    header("location: view-$type.php?$type=$id");
?>
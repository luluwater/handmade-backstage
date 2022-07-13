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
    $id=$_POST["id"];    
    $stmtCategoryName=$db_host->prepare("SELECT category_en_name FROM category WHERE category.id = ?");
    $stmtCategoryName->execute([$category]);
    $row=$stmtCategoryName->fetch();   
    $categoryName=$row["category_en_name"]; 
    $change=[];
    for($i=1;$i<=4;$i++){
        
        array_push($change,$_POST["change$i"]??"unchange");
    }
    print_r($change);
    
    require_once("../api/upload-image.php");

    if($type === "course"){
        $date=$_POST["date"];
        $time=$_POST["time"];
        $datetime=$date." ".$time;
        $hour=$_POST["hour"];
        $stmt=$db_host->prepare("UPDATE  course
        SET store_id=:store_id, category_id=:category_id, create_time=:create_time, name=:name, intro=:intro, amount=:amount, price=:price, note=:note, course_date=:datetime, course_time=:hour
        WHERE course.id=$id");
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
        upFileToDir($type,$categoryName,$id);
        updateFileTo_db($type,$id,$change);
    }else{
        $stmt=$db_host->prepare("UPDATE  product
        SET store_id=:store_id, category_id=:category_id, create_time=:create_time, name=:name, intro=:intro, amount=:amount, price=:price, note=:note
        WHERE product.id=$id");

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
        upFileToDir($type,$categoryName,$id);
        updateFileTo_db($type,$id,$change);
    }

    
    
    // $id=$db_host->lastInsertId();
    
    






    $db_host = NULL;

    header("location: view-$type.php?$type=$id");
?>
<?php  
    if(!isset($_POST["product_name"])){
        echo "沒有帶資料";
        exit;
    }
    require("../db-connect.php");

    function upFileToDir($dir){
        for($i=1;$i<=4;$i++){
            if($_FILES["product_img".$i]["error"]==0){
                if(move_uploaded_file($_FILES["product_img".$i]["tmp_name"],"./$dir/".$_FILES["product_img".$i]["name"])){
                    $fileName=$_FILES["product_img".$i]["name"];
                    $now=date('y-m-d H:i:s');
                    echo $fileName;                    
                    echo "success <br>";
                }else{
                    echo "fail";
                }
            }
        }
    }
    // function upFileTo_db(){
    //     $sql="INSERT INTO product_img (img_name,product_id) VALUES ('$fileName','product_id')";
    //                 if(global $conn->query($sql)===true){
    //                     echo "新資料輸入成功";
    //                 }else{
    //                     echo "Error: ".$sql;
    //                 }                    
    //                 // header("location: file-upload.php");
    // }

    $productName=$_POST["product_name"];
    $intro=$_POST["intro"];
    $price=$_POST["price"];
    $amount=$_POST["amount"];
    $category=$_POST["category"];
    $store=$_POST["store"];
    $type=$_POST["type"];  
    $notice=$_POST["notice"];
    $now=date('Y-m-d H:i:s');
   

    echo "productName: ".$productName."<br>";
    echo "intro: ".$intro."<br>";
    echo "price: ".$price."<br>";
    echo "category: ".$category."<br>";
    echo "store: ".$store."<br>";
    echo "type: ".$type."<br>";
    echo "notice: ".$notice."<br>";
    if($type === "體驗課程"){
        $datetime=$_POST["datetime"];
        $hour=$_POST["hour"];
        echo "datetime: ".$datetime."<br>";
        echo "hour:".$hour."<br>";

        $stmt=$db_host->prepare("INSERT INTO course (store_id,category_id,create_time,name,intro,amount,price,note,course_date,course_time) VALUES (:store_id, :category_id, :create_time, :name, :intro, :amount, :price, :note, :datetime, :hour)");

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
            $db_host = NULL;
            exit;
        }
    }else{
        $stmt=$db_host->prepare("INSERT INTO product (store_id,category_id,create_time,name,intro,amount,price,note) VALUES (:store_id, :category_id, :creat_time, :name, :intro, :amount, :price, :note)");

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
            $db_host = NULL;
            exit;
        }
    }

    
    

    
    $product_id = $db_host->lastInsertId();    

    upFileToDir("./test-img");







    $db_host = NULL;

    header("location:creat-new-product.php");
?>
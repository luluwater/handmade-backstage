<?php
function checkDir($route){
    return file_exists($route);
}
/**
 * 創建資料夾存放上傳的圖片
 * 資料夾路徑 ../img/$typeName/$typeName_$categoryName_$product_id/圖片名稱
 * 範例      ../img/product/product_metalwork_1/圖片名稱
 */
function upFileToDir($typeName,$categoryName,$product_id){
    $route='../img/'.$typeName.'/'.$typeName.'_'.$categoryName.'_'.$product_id;
    if(checkDir($route)){
        echo "存在";
    }else{
        mkdir($route,0777,true);
    }
    for($i=1;$i<=4;$i++){
        if($_FILES["product_img".$i]["error"]==0){
            if(move_uploaded_file($_FILES["product_img".$i]["tmp_name"],"$route/".$_FILES["product_img".$i]["name"])){
                $fileName=$_FILES["product_img".$i]["name"];
                $now=date('y-m-d H:i:s');
                echo "success <br>";
            }else{
                echo "fail move file<br>";
            }
        }else{
            // echo "fail file<br>";
        }
    }    
    
}


function upFileTo_db($typeName,$type_id){  
    require("../db-connect.php"); 
    switch($typeName){
        case "course":            
            $stmtImg=$db_host->prepare("INSERT INTO course_img(img_name,course_id) VALUES (:img_name, :course_id)");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];
                if($_FILES["product_img".$i]["error"]==0){                    
                    try{
                        $stmtImg->execute([
                            ":img_name"=>$fileName,
                            ":course_id"=>$type_id
                        ]);                        
                    }catch (PDOException $e){
                        echo "預處理陳述式執行失敗！ <br/>";
                        echo "Error: " . $e->getMessage() . "<br/>";
                        // $db_host = NULL;
                        exit;
                    }
                }
            }   
            break;
        case "product":
            $stmtImg=$db_host->prepare("INSERT INTO product_img(img_name,product_id) VALUES (:img_name, :product_id)");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];
                if($_FILES["product_img".$i]["error"]==0){
                    $stmtImg->execute([
                        ":img_name"=>$fileName,
                        ":product_id"=>$type_id
                    ]);
                }
            }
            break;
        case "store":
            $stmtImg=$db_host->prepare("INSERT INTO store_img(img_name,store_id) VALUES (:img_name, :store_id)");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];
                if($_FILES["product_img".$i]["error"]==0){
                    $stmtImg->execute([
                        ":img_name"=>$fileName,
                        ":store_id"=>$type_id
                    ]);
                }
            }
            break;
        case "blog":
            $stmtImg=$db_host->prepare("INSERT INTO blog_img(img_name,blog_id) VALUES (:img_name, :blog_id)");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];
                if($_FILES["product_img".$i]["error"]==0){
                    $stmtImg->execute([
                        ":img_name"=>$fileName,
                        ":blog_id"=>$type_id
                    ]);
                }
            }
            break;        
    }
}

function updateFileTo_db($typeName,$type_id,$change){
    require("../db-connect.php"); 
    switch($typeName){
        case "course":    
            $stmt=$db_host->prepare("SELECT * FROM course_img WHERE course_id=?");
            $stmt->execute([$type_id]);
            $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmtImg=$db_host->prepare("INSERT INTO course_img (id,img_name,course_id) VALUES (:img_id,:img_name,:course_id) ON DUPLICATE KEY UPDATE img_name=:img_name,course_id=:course_id");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];                
                if($_FILES["product_img".$i]["error"]==0){                    
                    try{
                        $stmtImg->execute([
                            ":img_name"=>$fileName,
                            ":course_id"=>$type_id,
                            ":img_id"=> $rows[$i-1]["id"]
                        ]);              
                        echo "圖片更新成功";          
                    }catch (PDOException $e){
                        echo "預處理陳述式執行失敗！ <br/>";
                        echo "Error: " . $e->getMessage() . "<br/>";
                        // $db_host = NULL;
                        exit;
                    }
                }else{
                    if($change[$i-1]=="del"){
                        echo $change[$i-1]."<hr>";
                        echo $rows[$i-1]["id"]."<hr>";

                        $stmtImgDel=$db_host->prepare("DELETE FROM course_img WHERE id=:img_id");
                        $stmtImgDel->execute([ 
                            ":img_id"=> $rows[$i-1]["id"]
                        ]);
                        echo "刪除";
                    }                    
                    
                    // echo "沒有圖片檔";
                }
            }   
            break;
        case "product":
            $stmt=$db_host->prepare("SELECT * FROM product_img WHERE product_id=?");
            $stmt->execute([$type_id]);
            $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmtImg=$db_host->prepare("INSERT INTO product_img (img_name,product_id) VALUES (:img_name,:product_id) ON DUPLICATE KEY UPDATE id=:img_id");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];                
                if($_FILES["product_img".$i]["error"]==0){   
                    try{
                        $stmtImg->execute([
                            ":img_name"=>$fileName,
                            ":product_id"=>$type_id,
                            ":img_id"=> $rows[$i-1]["id"]
                        ]);              
                        echo "圖片更新成功";          
                    }catch (PDOException $e){
                        echo "預處理陳述式執行失敗！ <br/>";
                        echo "Error: " . $e->getMessage() . "<br/>";
                        // $db_host = NULL;
                        exit;
                    }
                    
                }else{
                    if($change[$i-1]=="del"){
                        echo $change[$i-1]."<hr>";
                        echo $rows[$i-1]["id"]."<hr>";

                        $stmtImgDel=$db_host->prepare("DELETE FROM product_img WHERE id=:img_id");
                        $stmtImgDel->execute([ 
                            ":img_id"=> $rows[$i-1]["id"]
                        ]);
                        echo "刪除";
                    }                    
                    
                    // echo "沒有圖片檔";
                }
            }   

            
            break;
        case "store":
            $stmtImg=$db_host->prepare("INSERT INTO store_img(img_name,store_id) VALUES (:img_name, :store_id)");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];
                if($_FILES["product_img".$i]["error"]==0){
                    $stmtImg->execute([
                        ":img_name"=>$fileName,
                        ":store_id"=>$type_id
                    ]);
                }
            }
            break;
        case "blog":
            $stmtImg=$db_host->prepare("INSERT INTO blog_img(img_name,blog_id) VALUES (:img_name, :blog_id)");
            for($i=1;$i<=4;$i++){
                $fileName=$_FILES["product_img".$i]["name"];
                if($_FILES["product_img".$i]["error"]==0){
                    $stmtImg->execute([
                        ":img_name"=>$fileName,
                        ":blog_id"=>$type_id
                    ]);
                }
            }
            break;        
    }
}
?>
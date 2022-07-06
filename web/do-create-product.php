<?php  
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
    upFileToDir("./test-img");

    $productName=$_POST["product_name"];
    $intro=$_POST["intro"];
    $price=$_POST["price"];
    $category=$_POST["category"];
    $store=$_POST["store"];
    $type=$_POST["type"];  
    $notice=$_POST["notice"];

   

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
    }

    
    
   

?>
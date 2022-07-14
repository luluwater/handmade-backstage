<?php
// $type=$_GET["type"];
require_once("../../db-connect.php");

// $hi=$_POST["type"];
// echo $hi;
// $id=$_POST["id"];

$sqlStore="SELECT * FROM store";
$stmt1=$db_host->prepare($sqlStore);

$sql="SELECT * FROM  category  ";
$stmtCategory=$db_host->prepare($sql);

$sqlMrt="SELECT * FROM mrt";
$mrtAll=$db_host->prepare($sqlMrt);
// $sqlMrt="SELECT DISTINCT MRT_station FROM mrt";

$sqlMrtStation="SELECT DISTINCT MRT_station FROM mrt";
$mrt1=$db_host->prepare($sqlMrtStation);
// $sqlMrt2="SELECT * FROM mrt";
// $mrt2=$db_host->prepare($sqlMrt2);


try{    
    $stmtCategory->execute();
    $mrtAll->execute();
    $stmt1->execute();
    $mrt1->execute();

    $categories=$stmtCategory->fetchAll(PDO::FETCH_ASSOC);
    $mrts=$mrtAll->fetchAll(PDO::FETCH_ASSOC);
    $stmt12=$stmt1->fetchAll(PDO::FETCH_ASSOC);
    $MRT=$mrt1->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($rows);
    // var_dump($mrts);
    // var_dump($stmts);
   
}catch (PDOException $e){
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
$db_host = NULL;
?>
<!doctype html>
<html lang="en">

<head>
    <title>第三頁</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../css/style.css">

    <style>
        #brand_acitve {
            color: #fff;
            background: var(--main-color);
        }

        #brand_acitve a::before {
            content: "";
            height: 25px;
            width: 5px;
            background: #fff;
            position: absolute;
            top: 50%;
            transform: translate(-300%, -50%);
        }
    </style>

</head>

     <body>
       <?php
        require("../main-menu.html");
        ?>
        <main>
            <div class="container-fluid">
                <form action="do-create-detail.php" method="post"
                            enctype="multipart/form-data">
                            <div class="d-flex my-3">
                               <label class="col-1  me-1 " for="store_img">品牌Logo</label>
                                <div class="col-auto">
                                   <input class="d-none upload_image" type="file" name="store_img" accept="image/*" required>
                                    <img src=""
                                    class="previewImage object-cover" alt="" onerror="this.src='/HANDMADE/img/previewImage.jpg'" src="">
                                     <i class="fa-solid fa-xmark text-light position-absolute top-0 end-0 translate-end p-1 cancel-img"></i>
                                </div>
                            </div>
                       
                        <div class="my-3 row align-items-center">
                            <label class="col-1" for="store_name">品牌名稱</label>
                            <input class="col form-control" type="text" name="store_name" placeholder="請輸入商品名稱" required>
                        </div>
                        <div class="my-3 row align-items-center">
                            <label class="col-1" for="intro">品牌簡介</label>
                            <textarea  class="form-control col" name="intro" cols="30" rows="10" style="resize:none" placeholder="請輸入商品介紹" required></textarea>
                        </div>
                        
                        <div class="my-3 row justify-content-center">
                            <label class="col-1 " for="category">商品類型</label>
                            <select id="category" class="form-select col" aria-label="Default select example" name="category">
                                <?php foreach($categories as $row): ?> 
                                <option value="<?=$row["id"] ?>"><?=$row["category_name"] ?></option>
                                <?php endforeach; ?>
                               
                            </select>
                        </div>
                        <div class="my-3 row justify-content-between">
                            
                            <div class="col-5 d-flex pe-0  align-items-center">
                                <label class="col-2 me-2" for="MRT_station">
                                    捷運站</label>
                                <select id="MRT_station" class="form-select col" aria-label="Default select example" name="MRT_station">
                                    <?php foreach($mrts as $mrt): ?> 
                                    <option value="<?=$mrt["MRT_station"] ?>">
                                    <?=$mrt["station_name"]?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="my-3 row align-items-center">
                            <label class="col-1" for="address">地址</label>
                            <input class="col form-control" name="address" type="text" name="datetime">
                        </div>
                        </div>
                        <div class="my-3 row align-items-center">
                            <label class="col-1" for="route">交通方式</label>
                            <textarea class="form-control col" name="route" cols="30" rows="10" style="resize:none" placeholder="請輸入商品介紹" required></textarea>
                        </div>
                        <div class="my-3 row align-items-center">
                            <label class="col-1" for="phone">電話</label>
                            <input class="col form-control" name="phone" type="text" name="datetime">
                        </div>
                        <div class="my-3 row align-items-center">
                            <label class="col-1" for="opening_hour">營業時間</label>
                            <input class="col form-control" name="opening_hour" type="text">
                        </div>
                        <div class="my-3 row align-items-center">
                            <label class="col-1" for="IG_url">Instagram</label>
                            <input class="col form-control" name="IG_url" type="text">
                        </div>
                        <div class="my-3 row align-items-center">
                            <label class="col-1" for="FB_url">Facebook</label>
                            <input class="col 
                            form-control" type="text" name="FB_url" required>
                        </div>
                    <div class="my-5 d-flex justify-content-end">
                        <a href="store.php" class="ms-3 btn btn-bg-color">返回</a>
                        <button class="ms-3 btn btn-main-color" type="submit">儲存</button>
                    </div>
                </form>
            </div>
        </main>
        <script>
            const previewImages=document.querySelector(".previewImage");
        const upload_images=document.querySelector(".upload_image");
        const cancel_img=document.querySelector(".cancel-img");
        // const imgs_state=document.querySelector(".img-state");

        previewImages.addEventListener("click",function(){
                upload_images.click();
            })
            upload_images.addEventListener("change",function(){
                const myFile=this.files[0];                
                const img=previewImages;
                if(myFile==undefined){
                    cancel_img.click();
                    return;
                }
                const objUrl=URL.createObjectURL(myFile);
                // const state=imgs_state;
                img.src=objUrl;
                img.onload=()=>window.URL.revokeObjectURL(objUrl);  
                console.log(cancel_img);
                cancel_img.classList.remove("d-none");
                // state.value="new";
            })
            cancel_img.addEventListener("click",function(){
                this.classList.add("d-none");
                // const state=imgs_state;
                const imgFile=upload_images;
                const preImg=previewImages;
                imgFile.value="";
                preImg.setAttribute("src","/HANDMADE/img/previewImage.jpg");   
                // state.value="del";    
            }) 
        </script>
    </body>
</html>
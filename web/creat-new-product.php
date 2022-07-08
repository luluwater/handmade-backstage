<?php
require_once("../db-connect.php");
$stmt=$db_host->prepare("SELECT * FROM category");
$stmt_store=$db_host->prepare("SELECT store.id,store.name FROM store WHERE store.category_id = 1");

try{    
    $stmt->execute();
    $stmt_store->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows_store=$stmt_store->fetchAll(PDO::FETCH_ASSOC);
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
    <title>新增商品-手手</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
        <div class="container-fluid">
            <form action="do-create-product.php" method="post" enctype="multipart/form-data">
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="">圖片</label>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" name="product_img1" accept="image/*" required>
                        <img src="" class="previewImage object-cover" alt="圖片預覽" onerror="this.src='../img/previewImage.jpg';">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" name="product_img2" accept="image/*">
                        <img src="" class="previewImage object-cover" alt="圖片預覽" onerror="this.src='../img/previewImage.jpg';">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" name="product_img3" accept="image/*">
                        <img src="" class="previewImage object-cover" alt="圖片預覽" onerror="this.src='../img/previewImage.jpg';">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" name="product_img4" accept="image/*">
                        <img src="" class="previewImage object-cover" alt="圖片預覽" onerror="this.src='../img/previewImage.jpg';">
                    </div>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="product_name">名稱</label>
                    <input class="col form-control" type="text" name="product_name" placeholder="請輸入商品名稱" required>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="intro">簡介</label>
                    <textarea class="form-control col" name="intro" cols="30" rows="10" style="resize:none" placeholder="請輸入商品介紹" required></textarea>                   
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="price">價格</label>
                    <input class="col form-control" type="number" name="price" placeholder="請輸入商品價格" required>
                </div>                
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="amount">數量</label>
                    <input class="col form-control" type="number" name="amount" placeholder="請輸入商品數量" required>
                </div>                
                <div class="my-3 row justify-content-between">
                    <div class="col-5 d-flex align-items-center">
                        <label class="col-2 me-2" for="category">類別</label>
                        <select id="category" class="form-select col" aria-label="Default select example" name="category">
                        <?php foreach($rows as $row): ?>
                        <option value="<?=$row["id"] ?>"><?=$row["category_name"] ?></option>
                        <?php endforeach; ?>         
                        </select>
                    </div>
                    <div class="col-5 d-flex pe-0  align-items-center">
                        <label class="col-2 me-2" for="store">品牌</label>
                        <select  id="store" class="form-select col" aria-label="Default select example" name="store">
                        <?php foreach($rows_store as $row): ?>
                        <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-5 d-flex gy-3  align-items-center">
                        <label class="col-2 me-2" for="type">商品類型</label>
                        <select id="type" class="form-select col" aria-label="Default select example" name="type">
                        <option value="course">體驗課程</option>
                        <option value="product">實體商品</option>                    
                        </select>
                    </div>
                </div>                
                <!--  -->
                <div id="course">
                    <div class="my-3 row align-items-center">
                        <label class="col-1" for="datetime">課程日程</label>
                        <input class="col form-control" type="datetime-local" name="datetime">
                    </div>
                    <div class="my-3 row align-items-center">
                        <label class="col-1" for="hour">課程時常</label>
                        <input class="col form-control" type="number" step="0.5" min="0" name="hour" placeholder="請輸入課程時常" required>
                    </div>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="notice">注意事項</label>
                    <textarea class="form-control col" name="notice" cols="30" rows="10" style="resize:none" placeholder="請輸入商品注意事項" required></textarea>
                </div>
                <div class="my-5 d-flex justify-content-end">
                    <a href="product.php" class="ms-3 btn btn-bg-color">取消</a>
                    <button class="ms-3 btn btn-main-color" type="submit">儲存</button>                    
                </div>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script>
        const previewImages=document.querySelectorAll(".previewImage");
        const upload_images=document.querySelectorAll(".upload_image");
        for(let i=0;i<previewImages.length;i++){
            previewImages[i].addEventListener("click",function(){
                upload_images[i].click();
            })
            upload_images[i].addEventListener("change",function(){
                const myFile=this.files[0];                
                const img=previewImages[i];
                const objUrl=URL.createObjectURL(myFile);
                img.src=objUrl;
                img.onload=()=>window.URL.revokeObjectURL(objUrl);
            })
        }   
        
        const type=document.querySelector("#type");
        const course=document.querySelector("#course");
        type.addEventListener("change",function(){
            // console.log("type change");
            if(this.value=="體驗課程"){
                course.classList.remove("d-none");
            }else{
                course.classList.add("d-none");
            }
        })

        const category=document.querySelector("#category");
        const store=document.querySelector("#store");
        category.addEventListener("change",function(){
            // console.log("category change");
            categoryValue=this.value;
            // console.log(store.children);
            for(let i=store.children.length-1;i>=0;i-- ){
                store.removeChild(store[i]);
            }
            $.ajax({
            	method: "POST",  //or GET
            	url:  "../api/filte-store.php",
            	dataType: "json",
            	data: { category_id: categoryValue } //如果需要
            	})
            	.done(function( response ) {
                	console.log(response);
                    for(let result of response.stores){
                        html=document.createElement("option");
                        html.textContent=result.name;
                        html.setAttribute("value",result.id);
                        console.log(html);
                        store.prepend(html);
                    }                    
            	}).fail(function( jqXHR, textStatus ) {
                	console.log( "Request failed: " + textStatus );
            	});
        })
        
    </script>
  </body>
</html>
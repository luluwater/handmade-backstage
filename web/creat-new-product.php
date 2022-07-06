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
                        <img src="" class="previewImage object-cover" alt="圖片預覽">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" name="product_img2" accept="image/*">
                        <img src="" class="previewImage object-cover" alt="圖片預覽">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" name="product_img3" accept="image/*">
                        <img src="" class="previewImage object-cover" alt="圖片預覽">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" name="product_img4" accept="image/*">
                        <img src="" class="previewImage object-cover" alt="圖片預覽">
                    </div>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="">名稱</label>
                    <input class="col form-control" type="text">
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="">簡介</label>
                    <textarea class="form-control col" name="" id="" cols="30" rows="10" style="resize:none"></textarea>                   
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="">價格</label>
                    <input class="col form-control" type="number">
                </div>                
                <div class="my-3 row align-items-center justify-content-between">
                    <div class="col-5 d-flex">
                        <label class="col-2 me-2" for="">類別</label>
                        <select class="form-select col" aria-label="Default select example">
                        <option value="1">花藝</option>
                        <option value="2">金工</option>                    
                        </select>
                    </div>
                    <div class="col-5 d-flex pe-0">
                        <label class="col-2 me-2" for="">品牌</label>
                        <select class="form-select col" aria-label="Default select example">
                        <option value="1">store</option>
                        <option value="2">store</option>                    
                        </select>
                    </div>
                    <div class="col-5 d-flex gy-3">
                        <label class="col-2 me-2" for="">商品類型</label>
                        <select class="form-select col" aria-label="Default select example">
                        <option value="1">體驗課程</option>
                        <option value="2">實體商品</option>                    
                        </select>
                    </div>
                </div>                
                <!--  -->
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="">課程日程</label>
                    <input class="col form-control" type="date">
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="">課程時常</label>
                    <input class="col form-control" type="text">
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="">注意事項</label>
                    <textarea class="form-control col" name="" id="" cols="30" rows="10" style="resize:none"></textarea>
                </div>
                <div class="my-5 d-flex justify-content-end">
                    <a href="" class="ms-3 btn btn-bg-color">取消</a>
                    <button class="ms-3 btn btn-main-color" type="submit">儲存</button>                    
                </div>
            </form>
        </div>
    </main>

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
    </script>
  </body>
</html>
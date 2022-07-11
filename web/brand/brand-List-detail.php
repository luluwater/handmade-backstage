<!doctype html>
<html lang="en">
  <head>
    <title>第三頁</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
  

        <link rel="stylesheet" href="../../css/style.css">
   <style>
   </style>
  </head>
 <body>
   <?php
    require("../main-menu.html");
    ?>
    <main>
<<<<<<< HEAD
<<<<<<< HEAD
      <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">品牌名稱</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>
       <div class="mb-3 row">
        <select class="form-select" aria-label="Default select example">
                <option value="1" selected>選擇</option>
                <option value="2">類別</option>
                <option value="3">品牌</option>
                
            </select>
        <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example">
                <option value="1" selected>選擇</option>
                <option value="2">類別</option>
                <option value="3">品牌</option>
                
            </select>
        </div>
      </div>
      <div class="d-flex">
        <h6 class="me-4">品牌簡介</h6>
      <textarea name="" id="" cols="100" rows="10"></textarea>
      </div>
      
       <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
=======
       <div class="text-end mb-5 row">
          <p  class=" col-sm-2 ">品牌 Logo</p>
        <div class="col-sm-auto">
           <img class="object-cover" width=100, height=100, src="../imagesTest/spiderman.jpg" alt="">
=======
       <div class="container-fluid">
            <form action="do-create-product.php" method="post" 
              enctype="multipart/form-data">
               <div class="d-flex my-3">
                 <label class="col-1  me-1 " for="">品牌Logo</label>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" 
                        name="product_img1" accept="image/*" required>
                        <img src="" class="previewImage object-cover" 
                        alt="圖片預覽" onerror="">
                    </div>
              </div>
                <div class="my-3  row align-items-center">
                    <label class="col-1" for="">品牌圖片</label>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file"
                         name="product_img1" accept="image/*" required>
                        <img src="" class="previewImage object-cover"
                         alt="圖片預覽"onerror="">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file"
                         name="product_img2" accept="image/*">
                        <img src="" class="previewImage object-cover"
                         alt="圖片預覽" onerror="">
                    </div>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" 
                        name="product_img3" accept="image/*">
                        <img src="" class="previewImage object-cover" 
                        alt="圖片預覽" onerror="">
                    </div>
                    <div class="col-auto ">
                        <input class="d-none upload_image" type="file" 
                        name="product_img4" accept="image/*">
                        <img src="" class="previewImage object-cover"
                         alt="圖片預覽" onerror="">
                    </div>
                    <div class="d-flex mt-3">
                 <label class="col-1" for="">形象bn</label>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" 
                        name="product_img1" accept="image/*" required>
                        <img src="" class="previewImage object-cover"
                         alt="圖片預覽" onerror="">
                    </div>
              </div>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="product_name">品牌名稱</label>
                    <input class="col form-control" type="text" 
                    name="product_name" placeholder="請輸入商品名稱"
                    required>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="intro">品牌簡介</label>
                    <textarea class="form-control col" 
                    name="intro" cols="30" rows="10" 
                    style="resize:none" placeholder="請輸入商品介紹" 
                    required></textarea>                   
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1 " for="type">商品類型</label>
                        <select id="type" class="form-select col"
                         aria-label="Default select example" name="type">
                        <option value="course">金工</option>
                        <option value="product">陶藝</option> 
                        <option value="product">花藝</option>     
                        <option value="product">皮革</option>     
                        <option value="product">烘焙</option>
                        <option value="product">簇絨</option>                                    
                        </select>
                </div>
                <div class="my-3 row justify-content-between">
                    <div class="col-5 d-flex align-items-center">
                        <label class="col-2 me-2" for="category">捷運站點</label>
                        <select  id="store" class="form-select col"
                         aria-label="Default select example" 
                         name="store">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-5 d-flex pe-0  align-items-center">
                        <label class="col-2 me-2" for="store">捷運線</label>
                        <select  id="store" class="form-select col"
                         aria-label="Default select example" name="store">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                    </div>
                </div>                
                  <div class="my-3 row align-items-center">
                       <label class="col-1" for="intro">交通方式</label>
                       <textarea name="" class="form-control col" name="intro" 
                       cols="30" rows="10" style="resize:none"
                        placeholder="請輸入商品介紹" required></textarea>                   
                  </div>
                   <div class="my-3 row align-items-center">
                        <label class="col-1" for="datetime">電話</label>
                        <input class="col form-control" name="phone"
                        type="text" name="datetime">
                    </div>
                  <div class="my-3 row align-items-center">
                        <label class="col-1" for="datetime">營業時間</label>
                        <input class="col form-control" name="
                        opening_hour" type="text" name="datetime">
                    </div>
                    <div class="my-3 row align-items-center">
                        <label class="col-1" for="">Instagram</label>
                        <input class="col form-control" name="IG_url"
                          type="text" name="datetime">
                    </div>
                    <div class="my-3 row align-items-center">
                        <label class="col-1" for="">Facebook</label>
                        <input class="col 
                        form-control" type="text" name="FB_url" required>
                    </div>
                </div>
                
                <div class="my-5 d-flex justify-content-end">
                    <a href="product.php" class=
                    "ms-3 btn btn-bg-color">取消</a>
                    <button class="ms-3 btn btn-main-color"
                     type="submit">儲存</button>                    
                </div>
            </form>
>>>>>>> e1c026591102140645c3af6eb823c2cbb9458992
        </div>
    </main>

  
<<<<<<< HEAD
      
      <div class="text-end mb-5 row">
          <label for="inputPassword" class=" col-sm-2 col-form-label">品牌名稱</label>
>>>>>>> 722e6c2f0fef8e0ef02c4429c923afc417168f8e
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>
<<<<<<< HEAD
       <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
=======
    
      
       <div class="text-end mb-5  row">
          <label for="inputPassword" class="col-sm-2 col-form-label">品牌簡介</label>
        <div class="col-sm-10">
          
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>

       
     
     
     <div class="text-end mb-5  row">
        <label for="inputPassword" class="col-sm-2 col-form-label">類別</label>
          <div class="col-sm-10">
            <select class="col-sm-10 form-select" aria-label="Default select example">
                <option value="1" selected>選擇</option>
                <option value="2">類別</option>
                <option value="3">品牌</option>
            </select>
           </div>
      </div>
      
      <div class="text-end mb-5  row">
          <label for="inputPassword" class="col-sm-2 col-form-label">捷運站點</label>
        <div class=" d-flex justify-content-between col-sm-10">
          <select style="width:300px" class="col-sm-5 form-select" aria-label="Default select example">
                <option value="1" selected>選擇</option>
                <option value="2">類別</option>
                <option value="3">品牌</option>
             </select>
            <select style="width:300px" class="col-sm-5 form-select" aria-label="Default select example">
                <option value="1" selected>選擇</option>
                <option value="2">類別</option>
                <option value="3">品牌</option>
             </select>
        </div>
       </div>
     
       <div class="text-end mb-5 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">地址</label>
>>>>>>> 722e6c2f0fef8e0ef02c4429c923afc417168f8e
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>
<<<<<<< HEAD
       <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
=======
       <div class="text-end mb-5 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">交通方式</label>
>>>>>>> 722e6c2f0fef8e0ef02c4429c923afc417168f8e
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>
<<<<<<< HEAD
       <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
=======
       <div class="text-end mb-5 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">電話</label>
>>>>>>> 722e6c2f0fef8e0ef02c4429c923afc417168f8e
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>
<<<<<<< HEAD
=======
       </div>
       <div class="text-end mb-5 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">營業時間</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>
       </div>
       <div class="text-end mb-5 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Instagram</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>
             <div class="text-end mb-5 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Facebook</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword">
        </div>
      </div>


>>>>>>> 722e6c2f0fef8e0ef02c4429c923afc417168f8e
    </main>
=======
>>>>>>> e1c026591102140645c3af6eb823c2cbb9458992
   
 </body>
</html>
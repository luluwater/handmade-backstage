<?php 
// $type=$_GET["type"];
require_once("../../db-connect.php");


?>
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
       <div class="container-fluid">
            <form action="do-create-store.php" method="post" 
              enctype="multipart/form-data">
               <div class="d-flex my-3">
                 <label class="col-1  me-1 " for="store_img">品牌Logo</label>
                    <div class="col-auto">
                        <input class="d-none upload_image" type="file" 
                        name="store_img" accept="image/*" required>
                        <img src="" class="object-cover" 
                        alt="" onerror="">
                    </div>
              </div>
            
              </div>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="store_name">品牌名稱</label>
                    <input class="col form-control" type="text" 
                    name="store_name" placeholder="請輸入商品名稱"
                    required>
                </div>
                <div class="my-3 row align-items-center">
                    <label class="col-1" for="intro">品牌簡介</label>
                    <textarea class="form-control col" 
                    name="intro" cols="30" rows="10" 
                    style="resize:none" placeholder="請輸入商品介紹" 
                    required></textarea>                   
                </div>
                <div class="my-3 row justify-content-center">
                    <label class="col-1 " for="category">商品類型</label>
                        <select id="category" class="form-select col"
                         aria-label="Default select example" name="category">
                        <option value="category">金工</option>
                        <option value="category">陶藝</option> 
                        <option value="category">花藝</option>     
                        <option value="category">皮革</option>     
                        <option value="category">烘焙</option>
                        <option value="category">簇絨</option>                                    
                        </select>
                </div>
                <div class="my-3 row justify-content-between">
                    <div class="col-5 d-flex align-items-center">
                        <label class="col-2 me-2" for="MRT_station">捷運線</label>
                        <select  id="MRT_station" class="form-select col"
                         aria-label="Default select example" 
                         name="MRT_station">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-5 d-flex pe-0  align-items-center">
                        <label class="col-2 me-2" for="station_line">
                        捷運站</label>
                        <select  id="station_line" class="form-select col"
                         aria-label="Default select example" name="station_line">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                    </div>
                </div>                
                  <div class="my-3 row align-items-center">
                       <label class="col-1" for="route">交通方式</label>
                       <textarea  class="form-control col" name="route" 
                       cols="30" rows="10" style="resize:none"
                        placeholder="請輸入商品介紹" required></textarea>                   
                  </div>
                   <div class="my-3 row align-items-center">
                        <label class="col-1" for="phone">電話</label>
                        <input class="col form-control" name="phone"
                        type="text" name="datetime">
                    </div>
                  <div class="my-3 row align-items-center">
                        <label class="col-1" for="opening_hour">營業時間</label>
                        <input class="col form-control" name="opening_hour" 
                        type="text" >
                    </div>
                    <div class="my-3 row align-items-center">
                        <label class="col-1" for="IG_url">Instagram</label>
                        <input class="col form-control" name="IG_url"
                          type="text">
                    </div>
                    <div class="my-3 row align-items-center">
                        <label class="col-1" for="FB_url">Facebook</label>
                        <input class="col 
                        form-control" type="text" name="FB_url" required>
                    </div>
                </div>
                
                <div class="my-5 d-flex justify-content-end">
                    <a href="store.php" class=
                    "ms-3 btn btn-bg-color">返回</a>
                    <button class="ms-3 btn btn-main-color"
                     type="submit">儲存</button>                    
                </div>
            </form>

        </div>
    </main>




   
 </body>
</html>
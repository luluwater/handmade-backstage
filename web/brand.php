<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/style.css">
    <style>
      .title{
        color:var(--line-color);
        margin-top:5px;
        font-size:24px;
        .
      }
      .delAndAdd{
        padding-top:60px;
      }
      .side{
        background:var(--bg-color); 
        border-radius:10%;
         margin-top:40px;
          padding:5px 20px ;
          color:white;
          border:1px solid var(--bg-color);
         
      }
      .side:active{
           background: #000;
      }
      .count-bg{
        margin-bottom:20px;
      }
      .btn-search{
        background: var( --line-color);
        border: 1px solid var(--line-color);
        border-radius:10%;
        padding:5px 20px ;
        color:white;
      }
      .footer{
        display:flex;
        justify-content:center;
        align-items:center;

      }
    </style>
  </head>
  <body>
     <?php
    require("./main-menu.html");
    ?>
     <main>
             <div class="container-fluid">
            <div class="d-flex justify-content-between mb-3">
                <p class="title">課程管理</p>
                <p>顯示 
                  <select class="count-bg text-center" aria-label="Default select example">
                    <option value="1" selected>5</option>
                    <option value="2">10</option>
                  </select> 
                  筆數
                </p>
            </div>
            <?php require("./mod/search-category.php") ?>
           

             <div class=" d-flex justify-content-between my-4">
                <button class="side btn-bg-color ">管理分類</button>
                <div class="delAndAdd ">
                     <a href="" class=" text-dark m-4"><i class="fa-solid fa-trash m-2"></i>刪除產品</a>
                      <a href="" class="  text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增產品</a>
                </div>
                     
            
            </div>

        <div class="row gy-4">
            <div class="col-md-4">
                <div >
                    <input type="checkbox" value="1" name="Product_1"><br>
                    <figure class="ratio ratio-4x3 mb-2">
                       <img class="object-cover" src="../imagesTest/spiderman.jpg" alt="">
                    </figure>
                     <h2 class="mb-2 text-center h4">店家名稱</h2>

                    <div class="py-2">
                        <div class="d-grid">
                           <button class="btn btn-info btn-cart" data-id="1">編輯</button>
                       </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                <div >
                    <input type="checkbox" value="1" name="Product_1"><br>
                    <figure class="ratio ratio-4x3 mb-2">
                       <img class="object-cover" src="../imagesTest/spiderman.jpg" alt="">
                    </figure>
                     <h2 class="mb-2 text-center h4">店家名稱</h2>

                    <div class="py-2">
                        <div class="d-grid">
                           <button class="btn btn-info btn-cart" data-id="1">編輯</button>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div >
                    <input type="checkbox" value="1" name="Product_1"><br>
                    <figure class="ratio ratio-4x3 mb-2">
                       <img class="object-cover" src="../imagesTest/spiderman.jpg" alt="">
                    </figure>
                     <h2 class="mb-2 text-center h4">店家名稱</h2>

                    <div class="py-2">
                        <div class="d-grid">
                           <button class="btn btn-info btn-cart" data-id="1">編輯</button>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div >
                    <input type="checkbox" value="1" name="Product_1"><br>
                    <figure class="ratio ratio-4x3 mb-2">
                       <img class="object-cover" src="../imagesTest/spiderman.jpg" alt="">
                    </figure>
                     <h2 class="mb-2 text-center h4">店家名稱</h2>

                    <div class="py-2">
                        <div class="d-grid">
                           <button class="btn btn-info btn-cart" data-id="1">編輯</button>
                       </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                <div >
                    <input type="checkbox" value="1" name="Product_1"><br>
                    <figure class="ratio ratio-4x3 mb-2">
                       <img class="object-cover" src="../imagesTest/spiderman.jpg" alt="">
                    </figure>
                     <h2 class="mb-2 text-center h4">店家名稱</h2>

                    <div class="py-2">
                        <div class="d-grid">
                           <button class="btn btn-info btn-cart" data-id="1">編輯</button>
                       </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                <div >
                    <input type="checkbox" value="1" name="Product_1"><br>
                    <figure class="ratio ratio-4x3 mb-2">
                       <img class="object-cover" src="../imagesTest/spiderman.jpg" alt="">
                    </figure>
                     <h2 class="mb-2 text-center h4">店家名稱</h2>

                    <div class="py-2">
                        <div class="d-grid">
                           <button class="btn btn-info btn-cart" data-id="1">編輯</button>
                       </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <?php require("./mod/pagination.php") ?>
            </div>
          
         
    </main>
 
</html>
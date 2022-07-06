
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <head><link rel="stylesheet" href="../css/style.css"></head>
  </head>
  <body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
      <?php 
      require("./status-bar.html");
      ?>

    <div class="d-flex mt-5">

      <div class="container d-flex align-items-center justify-content-between w-50 ms-0">
        <select name="" class="select" >
          <option value="keyword">關鍵字</option>
          <option value="date">日期</option>
          <option value="category">分類</option>
        </select>
        <div class="input-group w-50">
          <span class="input-group-text" id="basic-addon1">@</span>
          <input type="text" class="form-control  " placeholder="Search..." aria-label="Username" aria-describedby="search blog">
        </div>
        <a href="" class="btn btn-info">搜尋</a>
      </div>

      <div class="d-flex"> 
        <div>發表新文章</div>
        <div>顯示??筆數</div>
      </div>
  </div>



    </main>

  </body>
</html>
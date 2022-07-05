<!doctype html>
<html lang="tw-zh">

<head>
    <title>商品管理-手手</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <p class="title">課程管理</p>
                <p>顯示 <span class="count-bg">10</span> 筆數</p>
            </div>
            <form action="">
                <div class="row  my-4">
                    <div class="col-2">
                        <select class="form-select" aria-label="Default select example">
                            <option value="1" selected>課程編號</option>
                            <option value="2">課程名稱</option>
                            <option value="3">類別</option>
                            <option value="4">金額</option>
                            <option value="5">上架</option>
                            <option value="6">下架</option>
                        </select>
                    </div>
                    <div class="col-6">
                    <input class="form-control"  type="search" name="search" id="">
                    </div>
                    <div class="col-1">
                    <a href="" class="btn btn-bg-color">搜索</a>
                    </div>
                </div>
            </form>
            <div class="text-end my-4">
              <a href="" class="text-dark m-2"><i class="fa-solid fa-trash m-2"></i>下架課程</a>
              <a href="" class="text-main-color m-2"><i class="fa-solid fa-square-plus m-2"></i>新增課程</a>
              
            </div>
            <table class="table">
              <thead class="table-head">
                <tr>
                  <td><input type="checkbox" name="" id=""></td>
                  <td>課程編號<i class="fa-solid fa-sort mx-2"></i></td>
                  <td>課程名稱</td>
                  <td>上線人數</td>
                  <td>金額</td>
                  <td>售出堂數</td>
                  <td>上架</td>
                  <td>收藏數<i class="fa-solid fa-sort mx-2"></i></td>
                  <td>編輯</td>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
              </ul>
            </div class="d-flex justify-content-center">
        </div>
    </main>
</body>

</html>
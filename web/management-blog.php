
<!doctype html>
<html lang="en">
  <head>
    <title>Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <head><link rel="stylesheet" href="../css/style.css"></head>

    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>

  </head>
  <body>
    <?php
    require("./main-menu.html");
    ?>
    <main>
        <?php 
        require("./mod/status-bar.php");
        ?>

        <div class="d-flex mt-4">

        <div class="fs-6 container d-flex align-items-center justify-content-between w-50 ms-0">
            
            <select name="" class="select" >
                <option selected="selected" value="keyword">關鍵字</option>
                <option  value="date">日期</option>
                <option value="category">分類</option>
            </select>
            
            <form  class="input-group w-50"  action="">
                <span class="input-group-text bg-white" id="basic-addon1">
                    <i class="fas fa-search"></i>
                </span>
                <input 
                    type="text"
                    type="<?php
                    /**
                    * 拿到上面 option 的 value 後用 switch 改變顯示方式。
                    * 
                    */
                     ?>" 
                    class="form-control fs-6  " placeholder="Search..." aria-label="Username" aria-describedby="search blog">
                    <a href="" type="submit" class="fs-6 btn btn-bg-color">搜索</a>
                    <!-- <select name="category" class="select-category" id="category" >
                        <option selected="selected" value="category">請選擇分類</option>
                        <option value="metalwork">金工</option>
                        <option value="pottery">陶藝</option>
                        <option value="floral">花藝</option>
                        <option value="leather">皮革</option>
                        <option value="tufting">簇絨</option>
                  </select> -->
            </form>
        </div>

        <div class="d-flex align-items-start w-25 justify-content-between"> 
            <div class="d-flex align-items-end">
                <a href="" class="btn btn-secondary btn-sm ">+</a>
                <span class="fs-6 ms-3">發表新文章</span>
            </div>
             <div class="fs-6" >顯示 
                <select class="count-bg text-center" aria-label="Default select example">
                    <option value="1" selected>5</option>
                    <option value="2">10</option>
                </select> 
                 筆
            </div>
        </div>
      </div>


      <table class="table mt-4 mb-0 text-center">
              <thead class="table-head">
                <tr>
                  <td class="col-1 text-start">日期</td>
                  <td class="col-3 text-start">文章標題</td>
                  <td class="col-1">分類</td>
                  <td class="col-1">狀態</td>
                  <td class="col-1">留言數</td>
                  <td class="col-1">收藏數</td>
                  <td class="col-1 text-end">編輯</td>
                </tr>
              </thead>
              <tbody>
                  <tr class="border-bottom">
                    <td class="text-start pb-2">2022/07/06</td>
                    <td class="text-start td-height">一次就上手！小紅書上最火「Tufting手作地毯」台灣也玩得到，做完立即讓你帶回家</td>
                    <td>金工</td>
                    <td><i class="fas fa-eye"></i></td>
                    <td>55</td>
                    <td>24</td>
                    <td class="text-end"><i class="fas fa-pen"></i></td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="text-start pb-2">2022/07/06</td>
                    <td class="text-start td-height">一次就上手！小紅書上最火「Tufting手作地毯」台灣也玩得到，做完立即讓你帶回家</td>
                    <td>金工</td>
                    <td><i class="fas fa-eye"></i></td>
                    <td>55</td>
                    <td>24</td>
                    <td class="text-end"><i class="fas fa-pen"></i></td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="text-start pb-2">2022/07/06</td>
                    <td class="text-start td-height">一次就上手！小紅書上最火「Tufting手作地毯」台灣也玩得到，做完立即讓你帶回家</td>
                    <td>金工</td>
                    <td><i class="fas fa-eye"></i></td>
                    <td>55</td>
                    <td>24</td>
                    <td class="text-end"><i class="fas fa-pen"></i></td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="text-start pb-2">2022/07/06</td>
                    <td class="text-start td-height">一次就上手！小紅書上最火「Tufting手作地毯」台灣也玩得到，做完立即讓你帶回家</td>
                    <td>金工</td>
                    <td><i class="fas fa-eye"></i></td>
                    <td>55</td>
                    <td>24</td>
                    <td class="text-end"><i class="fas fa-pen"></i></td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="text-start pb-2">2022/07/06</td>
                    <td class="text-start td-height">一次就上手！小紅書上最火「Tufting手作地毯」台灣也玩得到，做完立即讓你帶回家</td>
                    <td>金工</td>
                    <td><i class="fas fa-eye"></i></td>
                    <td>55</td>
                    <td>24</td>
                    <td class="text-end"><i class="fas fa-pen"></i></td>
                  </tr>
        
                
              </tbody>
    </table>

        <?php
        require("./mod/pagination.php")
        ?>

    </main>


  </body>
</html>
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
        <div class="container">
            <form class="w-100" action=""></form>
                <div class="mb-3">
                    <label for="blogTitle" class="form-label">文章標題</label>
                    <input type="text" required name="blogTitle" class="form-control" id="blogTitle">
                </div>
            </form>

            <div class="d-flex align-items-center gap-5 mb-4">
                <form class="w-75" action="">
                    <div class="mb-3">
                        <label for="pubilshTime" class="form-label">發表時間</label>
                        <input type="datetime-local" name="pubilshTime" required class="form-control" id="pubilshTime">
                    </div>
                </form>

                <form action="" class="d-flex align-items-center gap-2">
                    <h5 class="mb-0 ms-4">發表</h5>
                    <input type="checkbox" id="switch" class="switch" />
                    <label for="switch" class="switch-lable">
                        <span class="switch-txt" turnOn="On" turnOff="Off"></span>
                    </label>
                </form>

            </div>

            <div class="d-flex col-fuild row mb-5">
                <div class="col-4 d-flex gap-3">
                    <div>文章類型</div>
                    <select name="articleCategorty" class="w-50 rounded" id="articleCategorty" >
                            <option selected="selected" value="storeIntro">店家介紹</option>
                            <option value="">體驗課程</option>
                            <option value="newStore">新店報報</option>
                    </select>
                </div>
                <div class="col-4 d-flex gap-3">
                    <div>館別分類</div>
                    <select name="storeCategory" class="w-50 rounded" id="storeCategory" >
                            <option selected="selected" value="storeIntro">金工</option>
                            <option value="">花藝</option>
                    </select>
                </div>
                <div class="col-4 d-flex gap-3">
                    <div>相關店家</div>
                    <select name="category" class="w-50 rounded" id="category" >
                            <option selected="selected" value="storeIntro">轉角金工</option>
                            <option value="">以覺學</option>
                    </select>
                </div>
            </div>


            <h5  class="mb-3">文章編輯</h5>

            <form action="">
                <!-- <textarea id="editor" style="height:160px" name="editor" class="editor"> 123</textarea> -->
                <div class="input-field">
                    <label for="title">輸入標題</label>
                    <input type="text" name="article-title" id="title">
                </div>

                <textarea name="article-content" id="article-editor" cols="30" rows="10"></textarea>
                
                <div class="mt-4 d-flex justify-content-end gap-3">
                    <button class="btn btn-bg-color">預覽</button>
                    <input type="submit" value="儲存文章" name="submitData" class="btn btn-main-color"></input>
                </div>
            </form>


        </div>

    </main>

    <script src="./ckeditor/ckeditor.js"></script>
  
    <script>
      CKEDITOR.replace("article-editor")
    </script>
  </body>
</html>
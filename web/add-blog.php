<?php

require_once("../db-connect.php");

$stmt=$db_host->prepare("SELECT * FROM blog");



try {
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  

} catch (PDOException $e) {
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
    <title>Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <head><link rel="stylesheet" href="../css/style.css"></head>
    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

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

            <form action="preview-blog.php" method="post">
                <h5  class="mb-3">文章編輯</h5>

                <teatarea id="editor" name="content"><?=$rows["content"]?></teatarea>
                <div class="d-flex gap-3 mt-3 justify-content-end">
                    <button type="submit" class="btn btn-bg-color">預覽文章</button>
                    <button type="submit" class="btn btn-main-color">儲存文章</button>
                </div>
            </form>
        </div>

    </main>
    



    <script src="https://unpkg.com/ckeditor5/build/ckeditor5-dll.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-editor-classic/build/editor-classic.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-essentials/build/essentials.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-adapter-ckfinder/build/adapter-ckfinder.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-autoformat/build/autoformat.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-basic-styles/build/basic-styles.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-block-quote/build/block-quote.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-ckfinder/build/ckfinder.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-easy-image/build/easy-image.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-heading/build/heading.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-image/build/image.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-indent/build/indent.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-link/build/link.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-list/build/list.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-media-embed/build/media-embed.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-paste-from-office/build/paste-from-office.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-table/build/table.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-cloud-services/build/cloud-services.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-html-embed/build/html-embed.js"></script>
    <script src="./helper/editor.js"></script>

  </body>
</html>




<?php

require_once("../db-connect.php");

$stmt=$db_host->prepare("SELECT * FROM blog");
$stmtCategory=$db_host->prepare("SELECT * FROM category");
$stmtStore=$db_host->prepare("SELECT * FROM store");


try {
    $stmt->execute();
    $stmtCategory->execute();
    $stmtStore->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stores = $stmtStore->fetchAll(PDO::FETCH_ASSOC);
    $categories = $stmtCategory->fetchAll(PDO::FETCH_ASSOC);

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
        <form action="preview-blog.php" method="post">
                <div class="mb-3">
                    <label for="blogTitle" class="form-label">文章標題</label>
                    <input type="text" required name="blogTitle" class="form-control" id="blogTitle">
                </div>

                <div class="d-flex align-items-center gap-5 mb-4">
                    <div class="w-75">
                        <div class="mb-3">
                            <label for="pubilshTime" class="form-label">發表時間</label>
                            <input type="datetime-local" name="pubilshTime" required class="form-control" id="pubilshTime">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <h5 class="mb-0 ms-4">發表</h5>
                        <input name="isPublish" type="checkbox" id="switch" class="switch" />
                        <label for="switch" class="switch-lable">
                            <span class="switch-txt" turnOn="On" turnOff="Off"></span>
                        </label>
                    </div>    
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
                            <?php foreach($categories as $category): ?>
                                <option value="<?=$category["category_en_name"]?>"><?=$category["category_name"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-4 d-flex gap-3">
                        <div>相關店家</div>
                        <select name="category" class="w-50 rounded" id="category" >
                                <?php foreach($stores as $store): ?>
                                    <option value="storeIntro"><?=$store["name"]?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>  



                                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>


                    <h5  class="mb-3">文章編輯</h5>
                    
                    <textarea name="content" id="editor">
                        &lt;p&gt;&lt;/p&gt;
                    </textarea>
                    <div class="d-flex  gap-3 justify-content-end">

                        <a class="btn btn-bg-color mt-3 btn-lg"  href="" >預覽<a>
                        <input class="btn btn-main-color mt-3 btn-lg" type="submit" value="保存">
                    </div>
                </form>

        </div>
   
    </main>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
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




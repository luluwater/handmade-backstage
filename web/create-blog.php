<?php

/**
 * 因為只有 value 會透過 change 改變，所以只能取 value 
 * 的值，不過在這邊 value 會 === 數字，因此沒辦法把她 innerText 出來，
 * 解決方法，把 category_id 改成用 name ji4
 */

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
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>
    <!-- editor font family -->
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
            <form action="create-blog.php" method="post">
                    <div class="mb-3">
                        <label for="blogTitle" class="form-label">文章標題</label>
                        <input type="text" required name="blogTitle" class="form-control" id="blogTitle">
                    </div>

                    <div class="d-flex align-items-center gap-5 mb-4">
                        <div class="w-75">
                            <div class="mb-3">
                                <label for="publishTime" class="form-label">發表時間</label>
                                <input type="datetime-local" name="pubilshTime" required class="form-control" id="publishTime">
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

                    <!-- category schemes  -->
                    <div class="d-flex col-fuild row mb-5">
                        <!-- Article -->
                        <div class="col-4 d-flex gap-3">
                            <div>文章類型</div>
                            <select name="articleCategory" class="w-50 rounded" id="articleCategory" >
                                    <option selected="selected" value="店家介紹">店家介紹</option>
                                    <option value="體驗課程">體驗課程</option>
                                    <option value="新店報報">新店報報</option>
                            </select>
                        </div>
                        <!-- Category -->
                        <div class="col-4 d-flex gap-3">
                            <div>館別分類</div>
                            <select name="category" class="w-50 rounded" id="category">
                                <?php foreach($categories as $category): ?>
                                    <option data-name="<?=$category["category_name"]?>" name="<?=$category["category_name"]?>" value="<?=$category["id"]?>"><?=$category["category_name"]?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Related stores -->
                        <div class="col-4 d-flex gap-3">
                            <div>相關店家</div>
                                <select name="store" class="w-50 rounded" id="store" >
                                    <?php foreach($stores as $store): ?>
                                        <option name="<?=$store["name"]?>" value="<?=$store["name"]?>"><?=$store["name"]?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>  
                        <!-- CKeditor -->
                        <div class="d-flex justify-content-between mb-3">  
                            <h5 >文章編輯</h5>
                            <a id="preview" class="btn btn-bg-color " data-bs-toggle="modal" data-bs-target="#exampleModal">預覽</a>
                         </div>
                        <textarea name="content" id="editor">
                            2021下半年開始，在網路上出現一個名詞「Tufting」，中文名為俄羅斯刺繡。利用簇絨槍與紗線，就可做出療癒感十足的毛絨家飾品，像是地毯、杯墊、飾品、甚至是鏡子，隨心所欲地創造屬於自己的毛絨單品，最早從歐美開始流行，後來這把火延燒至韓國，甚至還在小紅書上爆紅。如今台灣也玩得到啦！編輯幫大家整理了5間Tufting工作室，皆有手作地毯課程可以體驗，看完趕緊揪好姐妹或另一半去體驗吧！
                            Tufting中文名為俄羅斯刺繡，製作原理很簡單，利用簇絨槍與紗線，透過手動或電動的方式將紗線穿入織物，讓紗線有如刺繡般緊緊縫製在織物上來完成一幅幅作品。縫製完畢後再使用電動剪毛機或剪刀剪斷或剪斷絨頭，讓作品呈現出毛絨感即可完成！簡單的道具和易上手的製作過程，搭配老師的現場協助，即使對手作一竅不通的人也能立刻上手。
                            <!-- &lt;p&gt;&lt;/p&gt; -->
                        </textarea>
                        <!-- submit button -->
                        
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="manage-blog.php" class="btn btn-bg-color mt-3 btn-lg ">返回</a>
                            <input class="btn btn-main-color mt-3 btn-lg" type="submit" value="儲存">    
                        </div>
                 
                     

                    </form>
                 
                
                <!-- Preview modal  -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content w-100 ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">預覽畫面</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="w-75 container modal-dialog">
                                <h2 class="my-4" id="modalTitle"></h2>    
                                <h5 id="modalUser">管理員 0001 </h5>
                                <p id="modalDate"><p>
                               <span id="modalExp" class="badge rounded-pill bg-warning text-dark"></span>
                                <span id="modalCategory" class="badge rounded-pill bg-secondary"></span>
                                <span id="modalStore" class="badge rounded-pill bg-success"></span>    
                                <hr>
                                <div id="modalArticle">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                <button type="button"  class="btn btn-main-color">儲存</button>
                               
                            </div>

                        </div>
                    </div>
                </div>
        </div>
   
    </main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

    <script>



            // Get value
            const blogTitleInput = document.getElementById("blogTitle")
            const publishTimeInput = document.getElementById("publishTime")
            const isPublishInput = document.getElementById("isPublish")
            const articleCategoryInput = document.getElementById("articleCategory")
            const categoryInput = document.getElementById("category")
            const storeInput = document.getElementById("store")
            const article = document.getElementById("editor")

            // set value
            const modalUser = document.getElementById("modalUser")
            const modalDate = document.getElementById("modalDate")
            const modalExp = document.getElementById("modalExp")
            const modalCategory = document.getElementById("modalCategory")
            const modalStore = document.getElementById("modalStore")
            const modalArticle = document.getElementById("modalArticle")
            const modalTitle= document.getElementById("modalTitle")

            const previewElem = document.getElementById("preview")
        
            previewElem.addEventListener("click",()=>{
                modalTitle.innerText=blogTitleInput.value
                modalExp.innerText=articleCategory.value
                modalCategory.innerText=categoryInput.value
                modalStore.innerText=storeInput.value

                modalArticle.innerText=article.firstChild.data
                
            
                modalDate.innerText=publishTimeInput.value
                modalArticle.innerText=article.value


            })



        const category=document.querySelector("#category");
        const store=document.querySelector("#store");

        categoryInput.addEventListener("change",function(){
            categoryValue=this.value;
    
            for(let i=store.children.length-1;i>=0;i-- ){
                store.removeChild(store[i]);
            }
            $.ajax({
            	method: "POST",  
            	url:  "../api/filte-store.php",
            	dataType: "json",
            	data: { category_id: categoryValue } 
            	})
            	.done(function( response ) {
                    for(let result of response.stores){
                        html=document.createElement("option");
                        html.textContent=result.name;
                        html.setAttribute("name",result.id,);
                        store.prepend(html);
                    }                    
            	}).fail(function( jqXHR, textStatus ) {
                	console.log( "Request failed: " + textStatus );
            	});
        })


    

        
    </script>


  </body>
</html>




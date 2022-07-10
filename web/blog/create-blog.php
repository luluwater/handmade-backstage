<?php
require_once("../../db-connect.php");

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
    <title>Create-Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/style.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>
    <!-- editor font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
 </head>
 <style>
    .ck-editor__editable[role="textbox"] {
      /* editing area */
      min-height: 200px;
    }

    .ck-content .image {
      /* block images */
      max-width: 80%;
      margin: 20px auto;
    }
    
 </style>

<body>



    <?php require("../main-menu.html");?>

    <main>
        <div class="container">



            <form action="do-create-blog.php" method="post">
                <div class="mb-3">
                    <label for="blogTitle" class="form-label">文章標題</label>
                    <input type="text" required name="blogTitle" class="form-control" id="blogTitle">
                </div>

                <div class="d-flex align-items-center gap-5 mb-4">
                    <div class="w-75">
                        <div class="mb-3">
                            <label for="publishTime" class="form-label">發表時間</label>
                            <input type="datetime-local" name="pubilshTime" required class="form-control"
                                id="publishTime">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <h5 class="mb-0 ms-4">發表</h5>
                        <input name="isPublish" type="checkbox" id="switch" class="switch d-none" />
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
                        <select name="articleCategory" class="w-50 rounded" id="articleCategory">
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
                            <option data-name="<?=$category["category_name"]?>" name="storeCategory"
                                value="<?=$category["id"]?>"><?=$category["category_name"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Related stores -->
                    <div class="col-4 d-flex gap-3">
                        <div>相關店家</div>
                        <select name="store" class="w-50 rounded" id="store">
                            <?php foreach($stores as $store): ?>
                            <option name="<?=$store["name"]?>" value="<?=$store["name"]?>"><?=$store["name"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- CKeditor -->
                <div class="d-flex justify-content-between mb-3">
                    <h5>文章編輯</h5>
                    <a id="preview" class="btn btn-bg-color " data-bs-toggle="modal"
                        data-bs-target="#exampleModal">預覽</a>
                </div>



                <!-- ****************************BLOG!!****************************** -->
                <textarea  id="atricle_editor" name="atricle_content">
                </textarea>
                <!-- ********************************************************** -->

                

                <!-- submit button -->
                <div class="d-flex gap-3 justify-content-end">
                    <a href="manage-blog.php" class="btn btn-bg-color mt-3 btn-lg ">返回</a>
                    <input class="btn btn-main-color mt-3 btn-lg" id="save" name="submit_data" type="submit" value="發布">
                </div>
            </form>

            


            <!-- Preview modal  -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content w-100 ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">預覽畫面</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="w-75 container modal-dialog">
                            <h2 class="my-4" id="modalTitle"></h2>
                            <h5 id="modalUser">管理員 0001 </h5>
                            <p id="modalDate">
                            <p>
                                <span id="modalExp" class="badge rounded-pill bg-warning text-dark"></span>
                                <span id="modalCategory" class="badge rounded-pill bg-secondary"></span>
                                <span id="modalStore" class="badge rounded-pill bg-success"></span>
                                <hr>
                            <div id="modalArticle">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                            <button type="button" class=" btn btn-main-color">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/super-build/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

CKEDITOR.ClassicEditor.create(document.getElementById("atricle_editor"), {
  toolbar: {
    items: [
      "exportPDF",
      "exportWord",
      "|",
      "findAndReplace",
      "selectAll",
      "|",
      "heading",
      "|",
      "bold",
      "italic",
      "strikethrough",
      "underline",
      "code",
      "subscript",
      "superscript",
      "removeFormat",
      "|",
      "bulletedList",
      "numberedList",
      "todoList",
      "|",
      "outdent",
      "indent",
      "|",
      "undo",
      "redo",
      "-",
      "fontSize",
      "fontFamily",
      "fontColor",
      "fontBackgroundColor",
      "highlight",
      "|",
      "alignment",
      "|",
      "link",
      "insertImage",
      "blockQuote",
      "insertTable",
      "mediaEmbed",
      "codeBlock",
      "htmlEmbed",
      "|",
      "specialCharacters",
      "horizontalLine",
      "pageBreak",
      "|",
      "textPartLanguage",
      "|",
      "sourceEditing",
    ],
    shouldNotGroupWhenFull: true,
  },
  list: {
    properties: {
      styles: true,
      startIndex: true,
      reversed: true,
    },
  },

  heading: {
    options: [
      { model: "paragraph", title: "Paragraph", class: "ck-heading_paragraph" },
      {
        model: "heading1",
        view: "h1",
        title: "Heading 1",
        class: "ck-heading_heading1",
      },
      {
        model: "heading2",
        view: "h2",
        title: "Heading 2",
        class: "ck-heading_heading2",
      },
      {
        model: "heading3",
        view: "h3",
        title: "Heading 3",
        class: "ck-heading_heading3",
      },
      {
        model: "heading4",
        view: "h4",
        title: "Heading 4",
        class: "ck-heading_heading4",
      },
      {
        model: "heading5",
        view: "h5",
        title: "Heading 5",
        class: "ck-heading_heading5",
      },
      {
        model: "heading6",
        view: "h6",
        title: "Heading 6",
        class: "ck-heading_heading6",
      },
    ],
  },

  placeholder: "開始寫文章吧!!",

  fontFamily: {
    options: [
      "default",
      "Arial, Helvetica, sans-serif",
      "Courier New, Courier, monospace",
      "Georgia, serif",
      "Lucida Sans Unicode, Lucida Grande, sans-serif",
      "Tahoma, Geneva, sans-serif",
      "Times New Roman, Times, serif",
      "Trebuchet MS, Helvetica, sans-serif",
      "Verdana, Geneva, sans-serif",
    ],
    supportAllValues: true,
  },

  fontSize: {
    options: [10, 12, 14, "default", 18, 20, 22],
    supportAllValues: true,
  },

  htmlSupport: {
    allow: [
      {
        name: /.*/,
        attributes: true,
        classes: true,
        styles: true,
      },
    ],
  },

  htmlEmbed: {
    showPreviews: true,
  },

  link: {
    decorators: {
      addTargetToExternalLinks: true,
      defaultProtocol: "https://",
      toggleDownloadable: {
        mode: "manual",
        label: "Downloadable",
        attributes: {
          download: "file",
        },
      },
    },
  },

  mention: {
    feeds: [
      {
        marker: "@",
        feed: [
          "@apple",
          "@bears",
          "@brownie",
          "@cake",
          "@cake",
          "@candy",
          "@canes",
          "@chocolate",
          "@cookie",
          "@cotton",
          "@cream",
          "@cupcake",
          "@danish",
          "@donut",
          "@dragée",
          "@fruitcake",
          "@gingerbread",
          "@gummi",
          "@ice",
          "@jelly-o",
          "@liquorice",
          "@macaroon",
          "@marzipan",
          "@oat",
          "@pie",
          "@plum",
          "@pudding",
          "@sesame",
          "@snaps",
          "@soufflé",
          "@sugar",
          "@sweet",
          "@topping",
          "@wafer",
        ],
        minimumCharacters: 1,
      },
    ],
  },
  removePlugins: [
    "CKBox",
    "CKFinder",
    "EasyImage",
    "RealTimeCollaborativeComments",
    "RealTimeCollaborativeTrackChanges",
    "RealTimeCollaborativeRevisionHistory",
    "PresenceList",
    "Comments",
    "TrackChanges",
    "TrackChangesData",
    "RevisionHistory",
    "Pagination",
    "WProofreader",
    "MathType",
  ],
});


    // CKEDITOR.replace('atricle_editor',{
    //     height:300,
    //     filebrowserBrowserUrl:"create-blog.php",
    //     filebrowserUploadUrl:"upload.php",
    //     filebrowserUploadMethod: "form"
    // });


    // Get value
    const blogTitleInput = document.getElementById("blogTitle")
    const publishTimeInput = document.getElementById("publishTime")
    const isPublishInput = document.getElementById("isPublish")
    const articleCategoryInput = document.getElementById("articleCategory")
    const categoryInput = document.getElementById("category")
    const storeInput = document.getElementById("store")
    const article = document.getElementById("atricle_editor")

    // set value
    const modalUser = document.getElementById("modalUser")
    const modalDate = document.getElementById("modalDate")
    const modalExp = document.getElementById("modalExp")
    const modalCategory = document.getElementById("modalCategory")
    const modalStore = document.getElementById("modalStore")
    const modalArticle = document.getElementById("modalArticle")
    const modalTitle = document.getElementById("modalTitle")

    const previewElem = document.getElementById("preview")

    previewElem.addEventListener("click", () => {
        modalTitle.innerText = blogTitleInput.value
        modalExp.innerText = articleCategory.value
        modalCategory.innerText = categoryInput.children[categoryInput.value - 1].innerText


        modalStore.innerText = storeInput.value


        modalArticle.innerText = article.firstChild.data
        modalDate.innerText = publishTimeInput.value
        modalArticle.innerText = article.value
    })

    categoryInput.addEventListener("change", function() {
        categoryValue = this.value;

        for (let i = store.children.length - 1; i >= 0; i--) {
            store.removeChild(store[i]);
        }
        $.ajax({
                method: "POST",
                url: "../../api/filte-store.php",
                dataType: "json",
                data: {
                    category_id: categoryValue
                }
            })
            .done(function(response) {
                for (let result of response.stores) {
                    html = document.createElement("option");
                    html.textContent = result.name;
                    html.setAttribute("name", result.id, );
                    store.prepend(html);
                }
            }).fail(function(jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
    })


    // $(document).ready(function(){
    //     $("#save").click(function(){
    //         var Content = CKEDITOR.instances['Content'].getData();
    //                 $.ajax({
    //     url: "do-create-blog.php",
    //     type: "POST",
    //     data: {
    //     Content: Content
    //     },
    //     cache: false,
    //     success: function(dataResult){
    //     var dataResult = JSON.parse(dataResult);
    //     if(dataResult.statusCode==200){

    //     $('#success').html('Data Saved successfully !');
    //     }
    //     else if(dataResult.statusCode==201){
    //     alert("Error occured !");
    //     }

    //     }
    //     });
    //     });
    //     CKEDITOR.replace('Content');
    // });
    </script>
</body>

</html>
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
              <input type="datetime-local" name="pubilshTime" required class="form-control" id="publishTime">
            </div>
          </div>

          <!-- <div class="d-flex align-items-center gap-2">
            <h5 class="mb-0 ms-4">發表</h5>
            <input name="isPublish" type="checkbox" id="switch" value="" class="switch d-none" />
            <label for="switch" class="switch-lable">
              <span class="switch-txt" turnOn="On" turnOff="Off"></span>
            </label>
          </div> -->
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
              <option data-name="<?=$category["category_name"]?>" name="storeCategory" value="<?=$category["id"]?>">
                <?=$category["category_name"]?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Related stores -->
          <div class="col-4 d-flex gap-3">
            <div>相關店家</div>
            <select name="store" class="w-50 rounded" id="store">
              <?php foreach($stores as $store): ?>
              <option name="<?=$store["name"]?>" value="<?=$store["id"]?>"><?=$store["name"]?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <!-- CKeditor -->
        <div class="d-flex justify-content-between mb-3">
          <h5>文章編輯</h5>
          <a id="preview" class="btn btn-bg-color " data-bs-toggle="modal" data-bs-target="#exampleModal">預覽</a>
        </div>



        <!-- ****************************BLOG!!****************************** -->
        <textarea id="atricle_editor" name="atricle_content">
             自大街向小巷復行數十步，不遠處的一扇門外，佈滿綠油油的中大型盆景，從石屎森林走進慢活叢林，逃離現實的「以覺學INTZUITION」工作室，到了。

                與友人走過門外的綠色小叢林推門而進，感覺有如進了魔戒中哈比人的小屋，眼前全木的裝潢和擺設，要與數分鐘前所置身的世界完全隔絕，「以覺學INTZUITION」工作室的環境、氣圍立即使人放鬆下來。
                溫柔的導師為我們每人送上了一杯茶，然後，慢慢地向我們介紹「以覺學INTZUITION」各個系列的首飾及器物，最大的共通點就是簡約但不簡單，而且堅持了所有的材質均100%可回收，不使用任何電鍍，全手工製作，另外，品牌著重「永續性」，強調給大家工藝的種子，各自種出自己的風景，可選擇金、銀、銅的「種子」，以鑄造及鍛造的工法栽培。不過最引人入勝的莫過於能親手製作一件獨一無二的、高難度又神秘的金屬飾品！

                「以覺學INTZUITION」工作室的環境，是先讓身心放緩，然後在認識品牌後，參與其中，樂在其中。導師讓我們先看部分製成品，簡介材質及過程，然後就為我們準備好原材料，體驗正式開始。眼前看著一條正方體的純銀原材料，腦裡可說是一片空白，如何才能讓一條約銀變成手鐲？到底扭紋是如何製成的？導師細緻地教導每一個步驟，先是練習如何使用刻字的工具，然後是用火槍將原材料軟化，再以工具輔助，製作紋路等等，製成自己想要的模樣，導師在製作過程中，會一直協助並講解，是溫柔、細心、一絲不苟的。這樣使製成品一方面飽含濃厚個性，另一方面又保證了質量；在這幽靜的空間，精神狀態得以放鬆，呼吸著植物氣息，聆聽著工具聲、呼吸聲，專注著自己用力又用心的製成品，喜歡、喜愛。

                在「以覺學INTZUITION」的三小時過去，獨一無二的專屬成品面世，這幾個小時的收獲，與環境中的一切互動，非單純的飾品製作，而是用心生活的體驗。工作室門外的自己，就先留在門外，遲下再見。
        </textarea>
        <!-- ********************************************************** -->

        <!-- submit button -->
        <div class="d-flex gap-3 justify-content-end">
          <a href="manage-blog.php" class="btn btn-bg-color mt-3 btn-lg ">返回</a>
          <input class="btn btn-main-color mt-3 btn-lg" id="publish" name="submit_data" type="submit" value="發布">
        </div>

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
              <p id="modalDate">
              <p>
                <span id="modalExp" class="badge rounded-pill bg-warning text-dark"></span>
                <span id="modalCategory" class="badge rounded-pill bg-secondary"></span>
                <span id="modalStore" class="badge rounded-pill bg-success"></span>
                <hr>
              <article id="modalArticle">
                自大街向小巷復行數十步，不遠處的一扇門外，佈滿綠油油的中大型盆景，從石屎森林走進慢活叢林，逃離現實的「以覺學INTZUITION」工作室，到了。

                與友人走過門外的綠色小叢林推門而進，感覺有如進了魔戒中哈比人的小屋，眼前全木的裝潢和擺設，要與數分鐘前所置身的世界完全隔絕，「以覺學INTZUITION」工作室的環境、氣圍立即使人放鬆下來。
                溫柔的導師為我們每人送上了一杯茶，然後，慢慢地向我們介紹「以覺學INTZUITION」各個系列的首飾及器物，最大的共通點就是簡約但不簡單，而且堅持了所有的材質均100%可回收，不使用任何電鍍，全手工製作，另外，品牌著重「永續性」，強調給大家工藝的種子，各自種出自己的風景，可選擇金、銀、銅的「種子」，以鑄造及鍛造的工法栽培。不過最引人入勝的莫過於能親手製作一件獨一無二的、高難度又神秘的金屬飾品！

                「以覺學INTZUITION」工作室的環境，是先讓身心放緩，然後在認識品牌後，參與其中，樂在其中。導師讓我們先看部分製成品，簡介材質及過程，然後就為我們準備好原材料，體驗正式開始。眼前看著一條正方體的純銀原材料，腦裡可說是一片空白，如何才能讓一條約銀變成手鐲？到底扭紋是如何製成的？導師細緻地教導每一個步驟，先是練習如何使用刻字的工具，然後是用火槍將原材料軟化，再以工具輔助，製作紋路等等，製成自己想要的模樣，導師在製作過程中，會一直協助並講解，是溫柔、細心、一絲不苟的。這樣使製成品一方面飽含濃厚個性，另一方面又保證了質量；在這幽靜的空間，精神狀態得以放鬆，呼吸著植物氣息，聆聽著工具聲、呼吸聲，專注著自己用力又用心的製成品，喜歡、喜愛。

                在「以覺學INTZUITION」的三小時過去，獨一無二的專屬成品面世，這幾個小時的收獲，與環境中的一切互動，非單純的飾品製作，而是用心生活的體驗。工作室門外的自己，就先留在門外，遲下再見。
              </article>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
              <input type="submit" name="save_data"  class=" btn btn-main-color" value="儲存">
            </div>
          </div>
        </div>
      </div>
    </div>

  </form>




    

  </main>


  <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/super-build/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
  </script>
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
      options: [{
          model: "paragraph",
          title: "Paragraph",
          class: "ck-heading_paragraph"
        },
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
      allow: [{
        name: /.*/,
        attributes: true,
        classes: true,
        styles: true,
      }, ],
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
      feeds: [{
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
      }, ],
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


    modalArticle.innerText = article.innerText

    modalDate.innerText = publishTimeInput.value
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
          html.setAttribute("value", result.id, );
          store.prepend(html);
        }
      }).fail(function(jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
      });
  })


  </script>
</body>

</html>
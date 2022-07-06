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
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
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

            <div id="editor">This is the initial editor content.</div>

        </div>

    </main>
    <script>
        ClassicEditor.create(document.getElementById("editor"), {
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing',
                        'imageStyle:block',
                        'imageStyle:side',
                        '|',
                        'toggleImageCaption',
                        'imageTextAlternative',
                        '|',
                        'linkImage'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                placeholder: 'Welcome to CKEditor 5!',
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                htmlEmbed: {
                    showPreviews: true
                },
            
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
        
              
            });
        </script>
    </script>
  </body>
</html>
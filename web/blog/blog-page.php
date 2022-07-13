<?php
require_once("../../db-connect.php");

$current_id=$_GET["id"];
$stmtBlog=$db_host->prepare("SELECT blog.*,category.category_name, store.* ,blog.id AS BLOG_ID FROM blog 
JOIN category ON blog.category_id = category.id 
JOIN store ON blog.store_id = store.id
WHERE blog.id=$current_id");

$stmtComments=$db_host->prepare("SELECT comment.*, user.* ,comment.id AS COMMENT_ID FROM comment 
JOIN user ON comment.user_id = user.id
WHERE comment.blog_id=$current_id AND valid=1");



try {
    $stmtBlog->execute();
    $blog = $stmtBlog->fetchAll(PDO::FETCH_ASSOC);
    $stmtComments->execute();
    $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Blog page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./style/blog.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<style>
.btn-bg-color,
.btn-cancel-color {
    background: var(--line-color);
    border: 1px solid var(--line-color);
    color: #fff;
    font-weight: 700;
}


.btn-bg-color:hover {
    background: var(--main-color);
    border: 1px solid var(--main-color);
    color: #fff;
}

svg{
  display:none;
}

</style>

<body>
    <header class="header ">
        <div class="d-flex align-items-center justify-content-around">
            <div class="d-flex gap-5 align-items-center">
                <h3 class="m-0 text-main-color">HANDMADE |</h3>
                <a href="" class="logo"><img class="object-cover" src="../../img/HANDMADE - LOGO-03.png" alt=""></a>
            </div>
        </div>
    </header>
    <div class="container mt-5 text-start w-50">
        <div class="d-flex justify-content-between">
            <div class="text-start "> 發布於
                <?php
                $date=new DateTime($blog[0]["create_time"]);
                echo  $date->format('M-d-Y H:i:s');
            ?>
            </div>
            <a href="edit-page.php?id=<?=$blog[0]["BLOG_ID"]?>"><i class="fas fa-edit"></i></a>
        </div>
        <div>
        </div>
        <input type="text" class="d-none" id="currentId" name="currentId" value="<?=$blog[0]["BLOG_ID"]?>">
        <h1 class="text-center my-4"><?=$blog[0]["title"]?></h1>
        <h5 id="user" class="text-center">by 黑色小花貓</h5>
        <div class="text-center my-4 d-flex justify-content-center gap-3">
            <span class="badge py-2 fs-6 px-3 bg-secondary"><?=$blog[0]["tag"]?></span>
            <span class="badge py-2 fs-6 px-3 bg-danger"><?=$blog[0]["category_name"]?></span>
            <span class="badge py-2 fs-6 px-3 bg-dark"><?=$blog[0]["name"]?></span>
        </div>
        <hr>

        <div id="editor" class="my-5" name="content">
            <?php
                    $newString=$blog[0]["content"];
                    echo $newString;
                    ?>
        </div>

        <input type="hidden" name="blogId" value="<?=$blog[0]["id"]?>">


        <div class="">
            <form action="create-comment.php">
                <h5>寫下您的想法</h5>
                <hr>
                <div class="d-flex justify-content-center my-5 flex-column gap-4">
                    <textarea name="commentContent" id="commentContent" cols="140" rows="10">

              </textarea>
                    <div class="d-flex justify-content-end">
                    <input type="submit" value="分享留言" name="submitComment" class="btn-bg-color btn btn-lg">
                    </div>
                </div>
            </form>
        </div>
   

    <h3> 留言列表</h3>
    <hr>
    <div id="commentsList">
        <?php foreach( $comments as $comment) :?>
        <div class="d-flex my-5 justify-content-center">
            <div class="card w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>留言</div>
                        <i class="fas fa-times-circle trash-btn" data-id="<?=$comment["COMMENT_ID"]?>"></i>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title "><?=$comment["content"] ?></h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <sapn class="card-title ">
                            <?php
                        $commentTime=new DateTime($comment["create_time"]);
                        echo  $commentTime->format('M-d-Y');
                    ?> </sapn>
                        <span class="card-text fw-bolder">- <?=$comment["name"]?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    </div>



    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/balloon/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</body>


<script>
const deleteBtns = document.querySelectorAll(".trash-btn");
const commentsList = document.getElementById('commentsList');

for (let i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener("click", (e) => {
        const id = e.target.dataset.id
        $.ajax({
            method: "POST",
            url: "do-delete-comment.php",
            data: {
                commentId: id,
            },
            beforeSend: function() {
                $("#spinner").removeClass('d-none');
            },
            success: function(data) {
                // $("#commentsList").html(data)
                location.reload()
                window.scrollTo(0, 0);
              
            }
        })
    })
}



</script>

</html>
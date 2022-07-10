<?php
require_once("../../db-connect.php");

$current_id=$_GET["id"];

$stmt=$db_host->prepare("SELECT * FROM blog WHERE id=$current_id");


try {
    $stmt->execute();
    $blog = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <link rel="stylesheet" href="../../css/style.css">
  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>


  <header class="header ">
    <div class="d-flex align-items-center justify-content-around">
      <div class="d-flex gap-5 align-items-center">
        <h3 class="m-0 text-main-color">HANDMADE |</h3>
        <a href="" class="logo"><img class="object-cover" src="../../img/HANDMADE - LOGO-03.png" alt=""></a>
      </div>


    </div>

  </header>

  <div class="container mt-5 text-center" style="">
    <div class="text-center text-center"> 發布於
      <?php
                $date=new DateTime($blog[0]["create_time"]);
                echo  $date->format('M-d-Y H:i:s');
            ?></div>


    <h3 class="text-center my-4"><?=$blog[0]["title"]?></h3>
    <h5>by 黑色小花貓</h5>
    <div class="text-center my-4">
      <span class="badge bg-secondary"><?=$blog[0]["title"]?></span>
      <span class="badge bg-secondary"><?=$blog[0]["title"]?></span>
      <span class="badge bg-secondary"><?=$blog[0]["title"]?></span>
    </div>
    <hr>

    <div id="editor">
      <img
        src="https://images.unsplash.com/photo-1600857544200-b2f666a9a2ec?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80 "
        class="img-thumbnail my-5 rounded w-75" style="width:" 200px" alt="...">
      <div class='text-start'>
        <article>
          <?=$blog[0]["content"]?>
        </article>
      </div>
    </div>

    <!-- <div class="d-flex mt-5 gap-5 justify-content-around">
      <div class="card" style="width: 18rem;">
        <img style="height: 200px   ;"
          src="https://images.unsplash.com/photo-1631125915902-d8abe9225ff2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8aGFuZG1hZGV8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
          class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <a href="#" class="btn btn-main-color">Go somewhere</a>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img style="height: 200px   ;"
          src="https://images.unsplash.com/photo-1615243639681-1208d685758a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8aGFuZG1hZGV8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
          class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <a href="#" class="btn btn-main-color">Go somewhere</a>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img style="height: 200px   ;"
          src="https://images.unsplash.com/photo-1586216583645-bf798306a3d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1188&q=80"
          class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <a href="#" class="btn btn-main-color">Go somewhere</a>
        </div>
      </div>
    </div> -->





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
      integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
      integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/balloon/ckeditor.js"></script>

</body>
<script>
BalloonEditor
  .create(document.querySelector('#editor'))
  .catch(error => {
    console.error(error);
  });
</script>

</html>
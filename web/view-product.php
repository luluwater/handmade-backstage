<?php
require_once("../db-connect.php");

$product_id=$_GET["product"]??0;


$stmt=$db_host->prepare("SELECT product.*,category.*,store.name AS store_name FROM product JOIN category ON product.category_id = category.id JOIN store ON product.store_id = store.id WHERE product.id = ?");
$stmtImg=$db_host->prepare("SELECT * FROM product_img WHERE product_img.product_id = ?");
try{    
    $stmt->execute([$product_id]);    
    $row=$stmt->fetch();        
    $stmtImg->execute([$product_id]);    
    $rowsImg=$stmtImg->fetchAll(PDO::FETCH_ASSOC);
    // print_r($row);   
}catch (PDOException $e){
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>商品-手手</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <?php    require("./main-menu.html");    ?>
  <main>
    <?php    
    if(!isset($_GET["product"]) || $row == null){
        echo "查無此商品";
        exit;
    }
    ?>
    <div class="container-fluid">
      <div class="my-3 row align-items-center">
        <label class="col-1" for="">圖片</label>
        <?php foreach($rowsImg as $img): ?>
        <div class="col-auto">
          <input class="d-none upload_image" type="file" name="product_img1" accept="image/*" required readonly>
          <img src="../img/product/product_<?= $row["category_en_name"].'_'.$product_id.'/'.$img["img_name"] ?>"
          class="previewImage object-cover" alt="圖片預覽" onerror="this.src='../img/previewImage.jpg';">
        </div>
        <?php endforeach; ?>
      </div>
      <div class="my-3 row align-items-center">
        <label class="col-1" for="product_name">名稱</label>
        <input class="col form-control" type="text" name="product_name" placeholder="請輸入商品名稱" required readonly
          value="<?= $row["name"] ?>">
      </div>
      <div class="my-3 row align-items-center">
        <label class="col-1" for="intro">簡介</label>
        <textarea class="form-control col" name="intro" cols="30" rows="10" style="resize:none" placeholder="請輸入商品介紹"
          required readonly><?= $row["intro"] ?></textarea>
      </div>
      <div class="my-3 row align-items-center">
        <label class="col-1" for="price">價格</label>
        <input class="col form-control" type="number" name="price" placeholder="請輸入商品價格" required readonly
          value="<?= $row["price"] ?>">
      </div>
      <div class="my-3 row align-items-center">
        <label class="col-1" for="amount">數量</label>
        <input class="col form-control" type="number" name="amount" placeholder="請輸入商品數量" required readonly
          value="<?= $row["amount"] ?>">
      </div>
      <div class="my-3 row justify-content-between">
        <div class="col-5 d-flex align-items-center">
          <label class="col-2 me-2" for="category">類別</label>
          <select id="category" class="form-select col" aria-label="Default select example" name="category" disabled>
            <option>
              <?= $row["category_name"] ?>
            </option>
          </select>
        </div>
        <div class="col-5 d-flex pe-0  align-items-center">
          <label class="col-2 me-2" for="store">品牌</label>
          <select id="store" class="form-select col" aria-label="Default select example" name="store" disabled>
            <option>
              <?= $row["store_name"] ?>
            </option>
          </select>
        </div>
        <div class="col-5 d-flex gy-3  align-items-center">
          <label class="col-2 me-2" for="type">商品類型</label>
          <select id="type" class="form-select col" aria-label="Default select example" name="type" disabled>
            <option value="product">實體商品</option>
          </select>
        </div>
      </div>
      <div class="my-3 row align-items-center">
        <label class="col-1" for="notice">注意事項</label>
        <textarea class="form-control col" name="notice" cols="30" rows="10" style="resize:none" placeholder="請輸入商品注意事項"
          required readonly><?= $row["note"] ?></textarea>
      </div>
      <div class="my-5 d-flex justify-content-end">
        <a href="course.php?type=product" class="ms-3 btn btn-bg-color">返回</a>
        <a href="edit-product.php?type=product&id=<?=$product_id?>" class="ms-3 btn btn-main-color">編輯</a>
      </div>
    </div>
  </main>
</body>

</html>
<?php


require("../../db-connect.php");

// $sql="SELECT * FROM category WHERE id =$id AND valid=1";
$id=$_GET["id"]; //設定id=get去取得的值

$sql="SELECT * FROM category WHERE id=$id AND valid=1";

$result = $db_host->prepare($sql);
try {
    $result->execute();
    $row = $result ->fetch(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>第二頁</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../css/style.css">
     <style>
        :root {
        --bg-color: #eee6de;
        --main-color: #e65947;
        --line-color: #ddb9a2;
        --main-word-color: #3F3F3F;
        --header-hieght: 100px;
    }
    
.title {
    font-size: 36px;
    color: var(--line-color);
    margin-bottom:20px;
}

.table-head {
    background-color: var(--line-color);
}

.blogs {
    margin-top: 100px;
}

.btn-members-list {
    margin-top: 60px;
    background: var(--main-color);
    font-weight: bolder;
    color: white;
    padding: .5rem 1rem;
}

.cancel-btn-line-color {
    background: var(--line-color);
}

.save-btn-main-color {
    background: var(--main-color);
}

.table {
    min-height: 200px;
}

.bg-mask {
    display: none;
    opacity: 0.5;
    background: var(--main-word-color);
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 1;
}

.edit-member-card {
    z-index: 2;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bolder;
    display: none;
    min-width: 600px;
}
.tabs {
    display: block;
}

.btn-main-color {
    background: var(--main-color);
    font-weight: bolder;
    color: white;
    padding: .5rem 1rem;
}
    </style>
  </head>
  <body>
    <?php
    require("../main-menu.html");
    ?>
    <main>
     <div class="mt-3 ms-3 container-fluid d-flex">
          
            <div class="member-card col-5">
                <p class="title fw-bold">基本資料</p>
                  <div class="mx-2">
                <a href="brand-detail.php?id=<?=$id?>" 
                class="me-2 btn  btn-main-color">返回</a>
                
                </div>
                <?php if($row>0): $result -> rowCount();?>
            <form action="do-update.php" method="get">
                <input type="hidden" name="id" class="form-control"
                    value="<?=$row["id"]?>">
                <table class="table table-borderless">
                    <tr>
                        <th class="pt-4">序號</th>
                        <td><?=$row["id"]?></td>
                    </tr>
                    <tr>
                        <th class="pt-3">類別</th>
                        <td><input type="text" name="categoryName" class="form-control"
                    value="<?=$row["category_name"]?>"></td>
                    </tr>
                    <tr>
                        <th class="pt-4">英文名字</th>
                        <td><input type="text" name="categoryNO1" class="form-control"
                    value="<?=$row["category_en_name"]?>"></td>
                    </tr>
            <?php endif; ?>
                </table>
                <div class="mx-2">
                <button type="submit" 
                class="me-2 btn  btn-main-color">儲存</ㄖ>
            </form>
                </div>
                <!-- form 表單要用 button sumbit送出送過去 才船的到 -->
            </div>
       </div>
    </main>
  </body>
</html>
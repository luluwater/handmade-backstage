
<?php


require("../../db-connect.php");
// $sql="SELECT * FROM category WHERE id =$id AND valid=1";
// $result = $db_host->prepare($sql);
// $userCount=$result->num_rows;
$id=$_GET["id"]; //去讓下方a標籤去取德get id 的變數 這樣才可顯示在網址上

$sql="SELECT * FROM store WHERE id=$id AND valid=1";

$result = $db_host->prepare($sql); //這邊是把資料撈出來 回傳物件 
//所以用result變數把物件接住 
// $userCount=$result->num_rows;//->取得有多少筆資料
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
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
     <link rel="stylesheet" href="../../css/style.css">
  </head>
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
    }
    th ,td{
        font-weight: bold;
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
  <body>
      <?php
    require("../main-menu.html");
    ?>
    <main>
        <div class="container-fluid ">
       <div class="mt-3 ms-3 container-fluid d-flex">
            <div class="member-card col-5">
                <p class="title fw-bold">基本資料</p>
                <?php if($row>0): $result -> rowCount();?>
                <table class="table table-borderless ">
                   <div class="row member-card ">
                    <tr>
                        <th class="col-2" >序號</th>
                        <td ><?=$row["id"]?></td>
                    </tr>
                     <tr>
                        <th class="col-2" >店家名稱</th>
                        <td><?=$row["name"]?></td>
                    </tr>
                     <tr>
                        <th class="col-2">自介</th>
                        <td><?=$row["intro"]?></td>
                    </tr>
                     <tr>
                        <th class="col-2" >地址</th>
                        <td><?=$row["address"]?></td>
                    </tr>
                    <tr>
                        <th class="col-2" >路線</th>
                        <td><?=$row["route"]?></td>
                    </tr>
                    <tr>
                        <th class="col-2" >電話</th>
                        <td><?=$row["phone"]?></td>
                    </tr>
                    <tr>
                        <th class="col-2">營業時間</th>
                        <td><?=$row["opening_hour"]?></td>
                    </tr>
                    <tr>
                        <th class="col-2">FB</th>
                        <td><a href=""></a><?=$row["FB_url"]?></td>
                    </tr>
                    <tr>
                        <th class="col-2">IG</th>
                        <td><?=$row["IG_url"]?></td>
                    </tr>
                    </div>
            <?php endif; ?>
                </table>
                <div class="mx-2 d-flex justify-content-center">
                <a href="store.php" 
                class="return-btn me-2 btn btn-members-list">返回店家</a>
                <!-- <a href="store-edit.php?id=<?=$id?>" 
                class="edit-btn btn btn-main-color me-2 btn-members-list"
                 >修改</a> -->
                </div>
          </div>
      </div>          
   </main>
  </body>
</html>
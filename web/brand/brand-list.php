<?php
//連線路徑調調整===========================================
// if(!isset($_POST["id"])){
//     echo "沒有帶資料";
//     exit;
// }
require("../../db-connect.php");
//=======================================================



// 測試連線
// try{
//     $db_host=new PDO("mysql:host={$serverName};dbname={$dbname};charset=utf8",$username,$password);
//     echo "成功";
        
// }catch(PDOException $e){
//     echo "資料庫連線失敗";
//     echo "Error: ".$e->getMessage();
//     exit;
// }
$id=$_GET["id"];
$sql = "SELECT * FROM category";
$result =$db_host->prepare($sql);
// $stmt->execute();
// $rows= $stmt ->fetchAll(PDO::FETECH_ASSOC);
// $result -> execute([":id"=> $id]);
// $rows = $result ->fetchAll();
// $member = $result -> rowCount();
try {
    $result->execute();
    $member = $result ->fetch(PDO::FETCH_ASSOC);
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
    th{
        border-bottom:1px solid gray;
    }
    </style>
  </head>
  <body>
    <?php
    require("../main-menu.html");
    // require("do-member.php");
    ?>
    <main>
      <div class="text-end my-4">
        <table class="table align-items-center">
              <thead class="table-head">
                <tr class="text-center">
                  <td class=" col-2">序號</td>
                  <td class="col-4">類型</td>
                  <td class="col-4">英文名</td>
                  <td class="col-2">詳細資料</td>
                </tr>
              </thead>
              <tbody class= text-center>
                <th class="pt-3" ><?=$member["id"]?></th>
                <th class="pt-3" ><?=$member["category_name"]?></th>
                <th class="pt-3" ><?=$member["category_en_name"]?></th>
                <th><a class="btn btn-bg-color" 
                href="brand-list.php?id=<?=$row["id"]?>">查看</a></th>
              </tbody>
        </table>
      </div>
                 <!-- 這邊點心曾可以跳到另一個畫面然後類似老師
                 user.php註冊方式 或是
                  create-user.php輸入值帶到sql然後按確定新增成功 
                 就可以在創建button案確定返回這一頁
                然後這一夜就會新增一個新的類別 
                然後刪除也一樣 會顯示刪除成功
                -->
         <div class="d-flex justify-content-around">
              <a class="button btn btn-main-color" href="do-Delete.php">刪除</a>
              <a class="button btn btn-main-color" href="do-Create.php">新增</a>
         </div>
     
    </main>
    
  </body>
</html>

<?php


require("../../db-connect.php");
// $sql="SELECT * FROM category WHERE id =$id AND valid=1";
// $result = $db_host->prepare($sql);
// $userCount=$result->num_rows;
$id=$_GET["id"]; //去讓下方a標籤去取德get id 的變數 這樣才可顯示在網址上

//選擇所有資料庫store所有的欄位，
//mrt只拿mrt.MRT_station,mrt.station_name 
//store 跟 mrt JOIN 再一起 on這邊是讓id=兩邊資料庫的id
//WHERE 就是指定條件 AND就是 或 
// $sql="SELECT store.* , mrt.MRT_station , mrt.station_name 
// FROM store JOIN mrt ON store.MRT_id=mrt.id 
// WHERE store.id=$id AND store.valid=1";

//JOHN 多個欄位表格
// SELECT man.man_id,man.man_name,xb.sex_name,zw_name,gz.money  
    // FROM man   
    //   LEFT JOIN zw ON man.zw_id=zw.zw_id   
    //   LEFT JOIN gz ON man.man_id=gz.man_id   
    //   LEFT JOIN xb ON gz.sex_id=xb.sex_id  

$sql="SELECT store.*, category.category_name 
FROM store JOIN category ON store.category_id=category.id
WHERE store.id=$id AND store.valid=1"; //這邊把AND valid=1拿掉才顯示得出來因為給的名稱不明確 可以不用LEFT可加可不加
//不知道是store or category 還是 mrt的 所以給他明確指定為store.valid

// $sqlContain= "SELECT category  FROM category  "

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
    .try{
        color:blue;
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
    #brand_acitve {
      color: #fff;
      background: var(--main-color);
    }

    #brand_acitve a::before {
      content: "";
      height: 25px;
      width: 5px;
      background: #fff;
      position: absolute;
      top: 50%;
      transform: translate(-300%, -50%);
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
                        <th class="col-2" >類別</th>
                        <td><?=$row["category_name"]?></td>
                    </tr>
                     <tr>
                        <th class="col-2" >店家名稱</th>
                        <td><?=$row["name"]?></td>
                    </tr>
                    <tr>
                        <th class="col-2" >捷運站</th>
                        <td><?=$row["mrt_station"]?></td>
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
                       
                        <td><a class="try"href="<?=$row["FB_url"]?>">
                        <?=$row["FB_url"]?></a></td>
                     
                    </tr>
                    <tr>
                        <th class="col-2">IG</th>
                        <!-- a標籤裡面再包一次就可以顯示網頁網址
                         因為主要style.css有把a隱藏所以要在下class樣式顯示出來
                         -->
                        <td><a class="try" href="<?=$row["IG_url"]?>">
                        <?=$row["IG_url"]?></a></td>
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
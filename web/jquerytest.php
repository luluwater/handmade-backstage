<?php

require_once("../db-connect.php");


// if(isset($_POST['searchType'])){
    
// }else{
//     $serchType="keyword";
// }

// if(isset($_POST["typeCategory"])){
//     $typeCategory=$_POST['typeCategory'];
// }else{
//     $typeCategory=null;
// }

// if(isset($_POST["typeKeyword"])){
//     $typeKeyword=$_POST['typeKeyword'];
// }else{
//     $typeKeyword=null;
// }

// if(isset($_POST["typeDate"])){
//     $typeCategory=$_POST['typeDate'];
// }else{
//     $typeCategory=null;
// }

// exit($serchType.$typeCategory.$typeKeyword);

$pageView = (isset($_GET['pageView'])) ? intval($_GET['pageView']) : 5;

echo $pageView;

$stmt=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id LIMIT 0,5");
$stmtCategory=$db_host->prepare("SELECT * FROM category");



try {
    $stmt->execute();
    $stmtCategory->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <head>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>

    <?php
    require("./main-menu.html");
    ?>

    <main>
        <?php 
        require("./mod/status-bar.php");
        ?>

        <div class="d-flex mt-4">

            <!-- Filter start -->

            <div class="fs-6 container d-flex align-items-start justify-content-between w-50 ms-0 gap-5">
           
                <form class="input-group" method="post" action="jquerytest.php">

                    <select name="filterWay" class="select" id="searchType" onchange="filter(this.value)">
                        <option selected="selected" value="keyword" id="keyword">關鍵字</option>
                        <option value="date" id="date">日期</option>
                        <option value="category" id="category">分類</option>
                    </select>
                    <input type="button" class="fs-6 btn btn-bg-color" id="submitButton" value="搜索">
           
                    
                    <span class="input-group-text bg-white" id="searchIcon">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control fs-6  d-none" id="typeKeyword" placeholder="Search..."
                        aria-label="search with text input field" aria-describedby="search blog" name="search">

                    <input type="date" class="form-control fs-6 " id="typeDate" placeholder="Search..."
                        aria-label="search with date input field" aria-describedby="search blog">

                    <select class="select-category rounded d-none" id="allCategory">
                        <option selected="selected" value="category">請選擇分類</option>
                        <?php foreach( $categories as $category) :?>
                        <option value="<?=$category["category_en_name"]?>"><?=$category["category_name"]?></option>
                        <?php endforeach; ?>
                    </select>
                </form> 
                  
          
            </div>
            <!-- Filter end -->


            <div class="d-flex align-items-center w-25 justify-content-between ">
                <!-- Post New Article Router-->
                <div class="d-flex align-items-end">
                    <a href="add-blog.php" class="btn btn-secondary btn-sm ">+
                    <span class="fs-6 ms-3">發表新文章</span></a>
                </div>
                <!--------------------------->

                <!--  Article Amount -->

                <div class="d-flex justify-content-between align-items-center display-page-box gap-3">
                    <p class="m-0 fs-5">顯示</p>
                    <form action="management-blog.php" method="get" class="pageForm" class="text-center">
                        <select name="pageView" id="" class="display-page form-select mt-2  " onchange="submit();">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </form>
                    <p class="m-0 fs-5">筆</p>
                </div>
                 <!--------------------------->

            </div>
        </div>

        <!-- Articles -->
        <table class="table h-0 mt-4 mb-0 text-center">
            <thead class="table-head">
                <tr>
                    <td class="col-1 text-start">日期<i class="fas fa-sort mx-2 trHover"></i></td>
                    <td class="col-3 text-start">文章標題</td>
                    <td class="col-1">分類 <i class="fas fa-sort mx-2 trHover"></i></td>
                    <td class="col-1">狀態 <i class="fas fa-sort mx-2 trHover"></i></td>
                    <td class="col-1">留言數 <i class="fas fa-sort mx-2 trHover"></i></td>
                    <td class="col-1">收藏數 <i class="fas fa-sort mx-2 trHover"></i></td>
                    <td class="col-1 text-end">編輯</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $rows as $row) :?>
                <tr class="trHover border-bottom">
                    <td class="text-start pb-2">
                        <?php      
                         $date=new DateTime($row["create_time"]);
                         echo $date->format('Y-m-d');
                         ?>
                    </td>
                    <td class="text-start td-height"><?=$row["title"]?></td>
                    <td><?=$row["category_name"]?></td>
                    <td><?=$row["state"]?></td>
                    <td>55</td>
                    <td>24</td>
                    <td class="text-end"><i class="fas fa-pen"></i></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <?php
        require("./mod/pagination.php")
        ?>
    </main>

    <script>


    function changeOption() {
        let select1 = document.getElementById('select-1');
        let option1 = select1.options[select1.selectedIndex].value;

        switch (option1) {
            case "keyword":

                document.getElementById("searchIcon").classList.remove('d-none');
                document.getElementById("textInput").classList.remove('d-none');
                document.getElementById("submitButton").classList.remove('d-none');
                document.getElementById("dateInput").classList.add('d-none');
                document.getElementById("allCategory").classList.add('d-none');
                break;
            case "date":
                document.getElementById("searchIcon").classList.add('d-none');
                document.getElementById("textInput").classList.add('d-none');
                document.getElementById("dateInput").classList.remove('d-none');
                document.getElementById("allCategory").classList.add('d-none');
                document.getElementById("submitButton").classList.add('d-none');
                break;
            case "category":
                document.getElementById("searchIcon").classList.add('d-none');
                document.getElementById("textInput").classList.add('d-none');
                document.getElementById("dateInput").classList.add('d-none');
                document.getElementById("allCategory").classList.remove('d-none');
                document.getElementById("submitButton").classList.add('d-none');
                break;

            default:
                break;
        }
    }

    /**
     * 我要把資料從前端 post 到 server 再透過 server 跟 db 溝通，改變資料庫
     * 排序的方式，最後渲染到前端
     * 
     * 1. 透過 jQuery 抓到 前端的 value
     * 2. 透過 ajax 把資料丟到 server 的 url 裡面
     * 3. 在 server url 裡面改變資料庫的排序方式
     * 4. 把新的排序方式透過 response?? 回傳到前端
     * 5. 把回傳的資料透過 innerText?? 塞入畫面 ?
     * 
     */




    $(function(){
        $("#submitButton").on("click",function(){
            // var searchTypeVal= $("#searchType").val();
            // var typeCategoryVal= $("#typeCategory").val();
            // var typeKeywordVal = $("#typeKeyword").val();
            // var typeDateVal =$("#typeDate").val();

        })

     })








    </script>

</body>

</html>
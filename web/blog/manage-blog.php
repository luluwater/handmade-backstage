<?php

require_once("../../db-connect.php");


$stmt=$db_host->prepare("SELECT * FROM blog JOIN category ON blog.category_id=category.id ORDER BY create_time DESC LIMIT 0,5");
$stmtCategory=$db_host->prepare("SELECT * FROM category");
/**
 * comment 資料表裡面的 
 * JOIN blog.id = blog_id，
 * 
 * 目標：找尋這篇部落格，COMMENT 的總數量 
 */

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
        <link rel="stylesheet" href="../../css/style.css">
    </head>

    <script src="https://kit.fontawesome.com/1e7f62b9cc.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>

    <?php require("../main-menu.html");?>

    <main>
        <?php 
        require("../mod/status-bar.php");
        ?>

        <div class="d-flex mt-4">

            <!-- Filter start -->
            <div class="fs-6 container d-flex align-items-start justify-content-between w-50 ms-0 gap-5">
                <select name="searchType" class="select" id="searchType">
                    <option selected="selected" value="keyword" id="keyword">關鍵字</option>
                    <option value="date" id="date">日期</option>
                    <option value="category" id="category">分類</option>
                </select>
                <form class="w-100 rounded" id="searchTypeForm" action="filter-blog.php">
                    <input
                        type="text" 
                        class="form-control fs-6" 
                        id="typeKeyword" 
                        placeholder="Search..."
                        aria-label="search with text input field" 
                        name="typeKeyword">
                    <div class="d-flex gap-4 align-items-center d-none" id="typeDate"   name="typeDate">
                    <input  type="date" 
                            class="form-control fs-6" 
                            name="fromDate" 
                            id="fromDate" 
                            aria-label="search with date input field">
                            ~
                    <input  type="date" 
                            class="form-control fs-6" 
                            name="toDate" 
                            id="toDate" 
                           aria-label="search with date input field">
                     <a id="filterDateBtn" class="btn btn-main-color m-0 ">搜尋</a>
                    </div>
                   
                    <select 
                        class="select-category rounded d-none" 
                        id="typeCategory" 
                        name="typeCategory">
                        <option selected="selected" value="all">全部分類</option>
                        <?php foreach( $categories as $category) :?>
                        <option value="<?=$category["id"]?>"><?=$category["category_name"]?></option>
                        <?php endforeach; ?>
                    </select>
                </form>

            </div>
            <!-- Filter end -->


            <div class="d-flex align-items-center w-25 justify-content-between ">
                <!-- Post New Article Router-->
                <div class="d-flex align-items-end">
                    <a href="create-blog.php" class="btn btn-secondary btn-sm ">+
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

        <table class="table h-0 mt-4 mb-0 text-center" id="table">
            <thead class="table-head">
                <tr>
                    <td  class="col-1 text-start">日期<i data-order="desc" id="create_time" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-3 text-start">文章標題</td>
                    <td  class="col-1">分類 <i data-order="desc" id="category_id"class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">狀態 <i data-order="desc" id="state" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">留言數 <i data-order="desc" id="comment_amount" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">收藏數 <i data-order="desc" id="favorite_amount" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1 text-end">刪除</td>
                </tr>
            </thead>

            <tbody id="tbody">
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
                    <td><?=$row["comment_amount"]?></td>
                    <td><?=$row["favorite_amount"]?></td>
                    <td class="text-end"><i class="fas fa-trash-alt"></i></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

            <!-- Loading spinner -->
            <div class="spinner-border position-absolute top-50 start-50" style="display:none" id="loadSpinner" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </table>

        <nav  aria-label="Page navigation" id="pagination" style="margin-top:50px">
            <ul class="pagination justify-content-center align-items-center ">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">
                            <</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
            </ul>
        </nav>
  

    </main>
<script>


  
    

    $(function(){

        $("#searchType").on("change",function(){
            const value = $(this).val();
    
            switch (value) {
                case "keyword":
                    $("#typeKeyword").removeClass("d-none")
                    $("#typeDate").addClass("d-none")
                    $("#typeCategory").addClass("d-none")
                    break;
                case "date":
                    $("#typeKeyword").addClass("d-none")
                    $("#typeDate").removeClass("d-none")
                    $("#typeCategory").addClass("d-none")
                    break;
                case "category":
                    $("#typeKeyword").addClass("d-none")
                    $("#typeDate").addClass("d-none")
                    $("#typeCategory").removeClass("d-none")
                    break;
                default:
                    break;
            }
        })

        /**
         * 使用類別篩選事件
         */
        $("#typeCategory").on("change",function(){
                const value = $(this).val();

                $.ajax({
                    url:"../../api/filterByCategory.php",
                    type:"POST",
                    data:"request=" + value,
                    beforeSend:function(){
                        $("#loadSpinner").show()
                    },
                    complete:function(){
                        $("#loadSpinner").hide()
                    },
                    success:function(data){
                        console.log(data)
                        $("#tbody").html(data)
                    }
                })
            })

 

            
        /**
         * 使用關鍵字篩選事件
         */
        $("#typeKeyword").keyup(function(){
            const inputVal = $(this).val();     
                $.ajax({
                    url:"../../api/filterByKeyword.php",
                    type:"POST",
                    data:"request=" + inputVal,
                    beforeSend:function(){
                        $("#loadSpinner").show()
                    },
                    complete:function(){
                        $("#loadSpinner").hide()
                    },
                    success:function(data){
                        $("#tbody").html(data)
                    }
                })
        })
        

        /**
         * 使用日期篩選事件
         */
        $("#filterDateBtn").on("click",function(){
            const fromDate=$("#fromDate").val();
            const toDate=$("#toDate").val();
            if(fromDate !='' || toDate !=""){
                $.ajax({
                    url:"../../api/filterByDate.php",
                    method:"POST",
                    data:{
                        fromDate:fromDate,
                        toDate:toDate
                    },
                    success:function(data){
                        $("#tbody").html(data)
                    }
                });
            }
        })


        $(".orderArrow").on("click",function(e){
            const orderArrows = document.querySelectorAll(".orderArrow ");
            const target=e.target.id
            const order=$(this).data("order")

            $.ajax({
                    url:"../../api/blogSort.php",
                    method:"POST",
                    data:{
                        target_name:target,
                        order:order,
                    },
                    success:function(data){
                        $("#table").html(data)
                }
            });
        })

        
        // function loadDate( page , query="")
        // {
        //     $.ajax({
        //         url:"../api/pagination.php",
        //         method:"POST",
        //         data:{page:page,query:query},
        //         success:function(data)
        //         {  
        //             console.log(data)
        //             $("#pagination").html(data);
        //         }
        //     })
        
        // }

        /**
         * 使用關鍵字篩選事件
         */
        // $("#typeKeyword").keyup(function(){
        //     const inputVal = $(this).val();     
        //     loadDate(1,inputVal)
        // })

    
})

    </script>
</body>

</html>
<?php

require_once("../db-connect.php");


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

            <div class="fs-6 container d-flex align-items-center justify-content-between w-50 ms-0 gap-5">

                <select name="filterWay" class="select" id="select-1" onChange="changeOption()">
                    <option selected="selected" value="keyword" id="keyword">關鍵字</option>
                    <option value="date" id="date">日期</option>
                    <option value="category" id="category">分類</option>
                </select>

                <form class="input-group" action="filter-blog.php">
                    <span class="input-group-text bg-white" id="searchIcon">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control fs-6" id="textInput" placeholder="Search..."
                        aria-label="search with text input field" aria-describedby="search blog" name="search">

                    <input type="date" class="form-control fs-6 d-none" id="dateInput" placeholder="Search..."
                        aria-label="search with date input field" aria-describedby="search blog">

                    <select class="select-category rounded d-none" id="allCategory">
                        <option selected="selected" value="category">請選擇分類</option>
                        <?php foreach( $categories as $category) :?>
                        <option value="<?=$category["category_en_name"]?>"><?=$category["category_name"]?></option>
                        <?php endforeach; ?>
                    </select>

                    <button  type="submit" class="fs-6 btn btn-bg-color" id="submitButton">搜索</button>
                </form>
            </div>

            <div class="d-flex align-items-start w-25 justify-content-between">
                <div class="d-flex align-items-end">
                    <a href="add-blog.php" class="btn btn-secondary btn-sm ">+
                        <span class="fs-6 ms-3">發表新文章</span></a>
                </div>
                <div class="fs-6">顯示
                    <select class="count-bg text-center" aria-label="Default select example">
                        <option value="1" selected>5</option>
                        <option value="2">10</option>
                    </select>
                    筆
                </div>
            </div>
        </div>

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
                    <td class="text-start pb-2"><?=$row["create_time"]?></td>
                    <td class="text-start td-height"><?=$row["title"]?></td>
                    <td><?=$row["category_name"]?></td>
                    <td><i class="fas fa-eye"></i></td>
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
                console.log(option1)
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
    </script>

</body>

</html>
<?php
//連線路徑調調整===========================================
require("../../db-connect.php");
//=======================================================

if (!isset($_GET["id"])) {
    header("location:members-list.php");
}

$id=$_GET["id"];

//個人
$sql = "SELECT user.*, user_state_category.name AS user_state_name FROM user
JOIN user_state_category ON user.state = user_state_category.id WHERE user.id = '$id'";
$result= $db_host->prepare($sql);
// print_r ($row);

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
    <title>members-list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c927f90642.js" crossorigin="anonymous"></script>
    <!-- css路徑調整 ============================================= -->

    <head>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <!-- ========================================================= -->
    <style>
    :root {
        --bg-color: #eee6de;
        --main-color: #e65947;
        --line-color: #ddb9a2;
        --main-word-color: #3F3F3F;
        --header-hieght: 100px;
    }

    .title {
        font-size: 26px;
        color: var(--main-word-color);
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
    </style>
</head>
<body>
    <!-- 路徑調整 ============================================= -->
    <?php require("../main-menu.html");?>
    <!-- ====================================================== -->
    <main>
        <div class="mt-3 ms-3 container-fluid d-flex">
            <div class="member-card col-5">
                <p class="title fw-bold">基本資料</p>
                <table class="table table-borderless">
                    <tr>
                        <th>會員編號</th>
                        <td><?=$member["id"]?></td>
                    </tr>
                    <tr>
                        <th>會員建立時間</th>
                        <td><?=$member["create_time"]?></td>
                    </tr>
                    <tr>
                        <th>帳號狀態</th>
                        <td><?=$member["user_state_name"]?></td>
                    </tr>
                    <tr>
                        <th>帳號</th>
                        <td><?=$member["account"]?></td>
                    </tr>
                    <tr>
                        <th>姓名</th>
                        <td><?=$member["name"]?></td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td><?=$member["gender"]?></td>
                    </tr>
                    <tr>
                        <th>信箱</th>
                        <td><?=$member["email"]?></td>
                    </tr>
                    <tr>
                        <th>地址</th>
                        <td><?=$member["address"]?></td>
                    </tr>
                    <tr>
                        <th>電話</th>
                        <td><?=$member["phone"]?></td>
                    </tr>
                </table>
                <div class="mx-2">
                    <!-- 路徑調整 ============================================= -->
                    <a href="members-list.php" class="return-btn me-2 btn btn-members-list">回到會員列表</a>
                    <!-- ====================================================== -->
                    <button class="edit-btn btn btn-main-color me-2 btn-members-list" type="submit">修改</button>
                </div>
            </div>
            <!-- 路徑調整 ============================================= -->
            
            <!-- ====================================================== -->
            <div class="bg-mask"></div>        
        <div class="edit-member-card">
        <div class="card d-flex p-2">
        <?php if($member>0): $result -> rowCount();?>
                <p class="title fw-bold text-center mt-3 mb-5">基本資料</p>
                <form action="do-update-member.php" method="post">
                <input name="id" type="hidden" value="<?=$member["id"]?>">
                    <table class="member-card-table table table-borderless">
                    <tr>
                        <th class="text-center">會員編號</th>
                        <td><?=$member["id"]?></td>
                    </tr>
                    <tr>
                        <th class="text-center">會員建立時間</th>
                        <td><?=$member["create_time"]?></td>
                    </tr>
                    <tr>
                        <th class="align-middle text-center">帳號狀態</th>
                        <td>
                            <select class="form-select" aria-label="Default select example" name="user_state_name" value="<?=$member["user_state_name"]?>">
                                <option value="1">一般會員</option>
                                <option value="2">黑名單</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">帳號</th>
                        <td><?=$member["account"]?></td>
                    </tr>
                    <tr>
                        <th class="align-middle text-center">姓名</th>
                        <td><input type="text" name="name" class="form-control" value="<?=$member["name"]?>"></td>
                    </tr>
                    <tr>
                        <th class="align-middle text-center">性別</th>
                        <td>
                            <select class="form-select" aria-label="Default select example" name="gender" value="<?=$member["gender"]?>">
                                <option value="female">female</option>
                                <option value="male">male</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle text-center">信箱</th>
                        <td><input type="email" name="email" class="form-control" value="<?=$member["email"]?>"></td>
                    </tr>
                    <tr>
                        <th class="align-middle text-center">地址</th>
                        <td><input type="text" name="address" class="form-control" value="<?=$member["address"]?>"></td>
                    </tr>
                    <tr>
                        <th class="align-middle text-center mb-5">電話</th>
                        <td><input type="text" name="phone" class="form-control" value="<?=$member["phone"]?>"></td>
                    </tr>
                </table>
                    <div class="button d-flex justify-content-end">
                        <a href="member-list.php?id=<?=$member["id"]?>" class="cancel-btn btn btn-main-color me-3 mb-5">取消</a>
                        <button class="save-btn btn btn-main-color mb-5 me-5" type="submit">儲存</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        </div>
    </main>
</body>
<script>
    let bgMask=document.querySelector(".bg-mask");
    let returnBtn=document.querySelector(".return-btn");
    let editBtn=document.querySelector(".edit-btn");
    let saveBtn=document.querySelector(".save-btn");
    let cancelBtn=document.querySelector(".cancel-btn");
    let editMemberCard=document.querySelector(".edit-member-card");
    let memberCard=document.querySelector(".member-card");
    let memberDetailsCard=document.querySelector(".member-details-card");

    editBtn.onclick=function(){
        bgMask.style.display="block";
        saveBtn.style.display="block";
        cancelBtn.style.display="block";
        editMemberCard.style.display="block";
        memberCard.style.display="none";
        returnBtn.style.display="none";
        memberDetailsCard.style.display="none";
}
    saveBtn.onclick=function(){
        bgMask.style.display="none";
        saveBtn.style.display="none";
        cancelBtn.style.display="none";
        editMemberCard.style.display="none";
}
</script>

</html>
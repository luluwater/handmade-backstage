<?php
require_once("../db-connect.php");

$limit=5;
$page=1;

if($_POST['page'] > 1 )
{
    $start = (($_POST["page"] -1 ) * $limit);
    $page = $_POST['page'];
}else{
    $start = 0;
}

$query = "SELECT * FROM blog ";

if($_POST['query'] != '')
{
    $query .='WHERE title LIKE "%'.str_replace(' ','%',$_POST["query"]).'%"';
}

$query .= 'ORDER BY id DESC ';
$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement=$db_host->prepare("$query");

try {
    $statement->execute();
    $totalData=$statement->rowCount();
    $statement=$db_host->prepare("$filter_query");
    $statement->execute();
    $dateQuery = $statement->fetchAll();
} catch (PDOException $e) {
        echo "預處理陳述式執行失敗！ <br/>";
        echo "Error: " . $e->getMessage() . "<br/>";
        $db_host = NULL;
        exit;
}




if($totalData > 0){
    foreach($dateQuery as $row)
    {
        $date=new DateTime($row["create_time"]);
        $newDate=$date->format('Y-m-d');
        $output ='
        <table class="table h-0 mt-4 mb-0 text-center" id="table">
            <thead class="table-head">
                <tr>
                    <td  class="orderArrow col-1 text-start">日期<i data-order="desc" id="create_time" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-3 text-start">文章標題</td>
                    <td  class="col-1">分類 <i data-order="desc" id="category_id"class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">狀態 <i data-order="desc" id="state" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">留言數 <i data-order="desc" id="user_id" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1">收藏數 <i data-order="desc" id="store_id" class="fas orderArrow fa-sort mx-2"></i></td>
                    <td class="col-1 text-end">刪除</td>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr class="trHover border-bottom">
                        <td class="text-start pb-2">'.$newDate.'</td>
                        <td class="text-start td-height">'.$row["title"].'</td>
                        <td>'.$row["category_id"].'</td>
                        <td>'.$row["state"].'</td>
                        <td>55</td>
                        <td>24</td>
                        <td class="text-end"><i class="fas fa-trash-alt"></i></td>
               
        ';
    }
}else{
    $output .='
        <div>沒有資料</div>
    ';
}

$output .='
    </tr>
     </tbody>
    <div class="spinner-border position-absolute top-50 start-50" style="display:none" id="loadSpinner" role="status">
     <span class="visually-hidden">Loading...</span>
    </div>
</table>

';




</ul>


</nav>
$totalLinks = ceil($totalData/$limit);

$pervious_link = '';
$next_link='';
$page_link='';

if($totalLinks > 4 ){
    if($page < 5 ){
        for($count = 1;$count<=5;$count++){
            $page_array[]=$count;
        }
        $page_array[]="...";
        $page_array[]=$totalLinks;
    }
    else{
        $endLimit = $totalLinks -5;
        if($page > $endLimit){
            $page_array[] = 1;
            $page_array[] = '...';
            for($count = $endLimit; $count<=$totalLinks;$count++){
                $page_array[]=$count;
            }  
        }
        else{
            $page_array[] = 1;
            $page_array[]="...";
            for($count = $page-1;$count<=$page+1;$count++)
            {
                $page_array[] = $count;
            }
            $page_array[]="...";
            $page_array[]=$totalLinks;
        }
    }

}
else
{
    for($count =1; $count<=$totalLinks;$count++){
        $page_array[]=$count;
    }
}

for($count=0;$count<count($page_array);$count++){
    if($page==$page_array[$count]){
        $page_link .='
            <nav  aria-label="Page navigation" id="pagination" style="margin-top:50px">
    <ul class="pagination justify-content-center align-items-center ">
        <li class="page-item"><a class="page-link active" href="#">'.$page_array[$count].'</a></li>
        ';

        $pervious_id=$page_array[$count]-1;

        if($pervious_id>0)
        {
            $pervious_link = '<li class="page-item"><a class="page-link" href="pagination.php" data-page_num="'.$pervious_id.'">Previous</a></li>';
        }else{
            $pervious_link = '<li class="page-item disabled"><a class="page-link " href="#">Previous</a></li>';
        }
        $next_id=$page_array[$count] + 1;
        if($next_id >= $totalLinks){
            $next_link=' <li class="page-item disabled"><a class="page-link " href="#">Next</a></li>';
        }
        else{
            $next_link='<li class="page-item"><a class="page-link" href="pagination.php" data-page_num="'.$next_id.'">Next</a></li>';
        }
    }
    else
    {
        if($page_array[$count]=='...'){
            $page_link .='
            <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
            ';
        }else{
            $page_link .='
            <li class="page-item"><a class="page-link" href="pagination.php" data-page_num="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
            ';

        }
    }


}

$output .='

</ul>
</nav>

'

$output .= $pervious_link . $page_link . $next_link;

echo $output;

?>



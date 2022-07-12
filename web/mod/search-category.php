

<form action="">
    <div class="row  my-4">
        <div class="col-2">
            <select class="form-select" aria-label="Default select example">
                <option value="1" selected>選擇</option>
                <option value="2">類別</option>
                <option value="3">品牌</option>

                
            </select>
        <div class="col-3">
           <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="products.php">類別</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="products.php?category=1">品牌</a>
            </li>
                      
                        <!-- <li class="nav-item">
                <a class="nav-link" href="products.php?category=2">DC Comics</a>
            </li> -->
        </ul>
        </div>
        <div class="col-7">
            <input class="form-control" type="search" name="search" id="">
        </div>
        <div class="col-2">
            <a href="" class="btn btn-bg-color">搜索</a>
        </div>
    </div>
</form>
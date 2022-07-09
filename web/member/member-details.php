<style>
.tabs  {
display: block;
}
.btn-main-color{
    background: var(--main-color);
    font-weight: bolder;
    color: white;
    padding: .5rem 1rem;
}
</style>
<div class="container">
    <div class="tabs mb-5">
        <button class="btn btn-main-color" type="submit">商品訂單</button>
        <button class="btn btn-main-color" type="submit">課程訂單</button>
        <button class="btn btn-main-color" type="submit">部落格</button>
    </div>
        <div class="tab-content col">
            <div class="content">
                <table class="table text-center">
                    <thead>
                        <tr class="table-head text-light">
                            <th>訂單編號</th>
                            <th>訂單日期</th>
                            <th>總金額</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-body">
                            <td>777</td>
                            <td>000000</td>
                            <td>NT$ 988</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="content" style="display: none">
            <table class="table text-center">
                <thead>
                    <tr class="table-head text-light">
                        <th>訂單編號</th>
                        <th>訂單日期</th>
                        <th>總金額</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-body">
                        <td>888</td>
                        <td>000000</td>
                        <td>NT$ 988</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="content" style="display: none">
            <table class="table text-center">
                <thead>
                    <tr class="table-head text-light">
                        <th>日期</th>
                        <th>文章標題</th>
                        <th>類別</th>
                        <th>分類</th>
                        <th>狀態</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-body align-items-center">
                        <td>2202/06/20</td>
                        <!-- text-truncate -->
                        <td>一器一花體驗分享</td>
                        <td>花藝</td>
                        <td>新店報報</td>
                        <td>on</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
      let tab = document.querySelectorAll("button");
      let content = document.querySelectorAll(".content");

      for (let i = 0; i < tab.length; i++) {
        tab[i].addEventListener("click", function (e) {
          e.preventDefault();
          contentDisplay(this);
        });
      }

      function contentDisplay(activeContent) {
        for (let i = 0; i < tab.length; i++) {
          if (tab[i] == activeContent) {
            tab[i].classList.add("active");
            content[i].style.display = "block";
          } else {
            tab[i].classList.remove("active");
            content[i].style.display = "none";
          }
        }
      }
</script>
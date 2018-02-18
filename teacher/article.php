<?php
if(isset($_COOKIE['user_type'])){
    if($_COOKIE['user_type']=='0'){
        $home_url = '../php/logout.php';
        header('Location: '.$home_url);
    }
    elseif ($_COOKIE['user_type']=='2'){
        $home_url = '../student/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
require_once("../include/article_teacher_header.html");
?>
<div class="content-warp" id="barba-wrapper" aria-live="polite">
    <div class="container list-container" style="visibility: visible;">
        <div class="row">
            <div class="col-md-12 main-content-timeline">
                <div id="addNewArticle">
                    <a class="btn btn-info" href="newArticle.php">新增文章</a>
                </div>
                <div class="input-group" id="searchContainer">
                    <input type="text" id="searchText" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-success" id="search">搜索</button>
                    </span>
                </div>

                <?php
                require_once('../php/mysqli_connect.php');
                $display = 10;
                if(isset($_GET['search_word']))// 获得搜索词
                {
                    $searchWord = $_GET['search_word'];
                }
                else{
                    $searchWord = "";
                }
                if(isset($_GET['page_num']) AND is_numeric($_GET['page_num']))//获得总页数
                {
                    $pages = $_GET['page_num'];
                }
                else
                {
                    $query = "select count(id) from article where title like '%$searchWord%'";
                    $result = @mysqli_query($dbc, $query);
                    $row = @mysqli_fetch_array($result, MYSQLI_NUM);	//从结果集$r得到数字数组
                    $record = $row[0];							//$row[0]即为count(id)
                    $pages = ceil($record / $display);			//计算总页数，ceil函数向上舍入为最接近的整数
                }
                if(isset($_GET['start']) && is_numeric($_GET['start']))//获得起始留言编号
                {
                    $start = $_GET['start'];
                }
                else
                {
                    $start = 0;		//如果首次载入页面，则起始编号为0
                }

                $query = "select id,title,content,DATE_FORMAT(article_date, '%M %d, %Y') as dr from article where title like '%$searchWord%' order by dr limit $start, $display";
                $result = @mysqli_query($dbc, $query);
                if($result){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                    {
                        echo '<div class="timeline-post">
                                <h4 class="post-title">
                                    <a href="./article_detail.php?id='.$row['id'].'" class="animation">'.$row['title'].'</a>
                                </h4>
                                <p>'.$row['content'].'...</p>
                                <p class="time">'.$row['dr'].'</p>
                            </div>';
                    }
                }

                //释放结果集
                if($result)
                    mysqli_free_result($result);

                //关闭数据库
                mysqli_close($dbc);

                //如果页数大于1，则显示分页
                if($pages > 1)
                {
                    $current_page = ($start / $display) + 1;

                    echo '<ul style="position: relative;left: 38%;" class="pagination">';
                    if($current_page != 1)	//当前页不是第一页，则显示向前连接
                    {
                        echo '<li><a href="article.php?search_word='.$searchWord.'&start=' . ($start - $display) . '&page_num=' . $pages . '">&laquo;</a></li>';
                    }
                    if($current_page <= 3)
                        $page_start = 1;
                    elseif ($current_page > $pages - 3)
                        $page_start = $pages - 4;
                    else
                        $page_start = $current_page - 2;
                    if ($pages <=5 )
                        $page_display = $pages;
                    else
                        $page_display = 5;
                    for ($i=$page_start;$i<($page_display+$page_start);$i++){
                        if ($i != $current_page)
                            echo '<li><a href="#">'.$i.'</a></li>';
                        else
                            echo '<li class="active"><a href="#">'.$i.'</a></li>';
                    }
                    if($current_page != $pages)	//当前页不是最后一页，则显示向后连接
                    {
                        echo '<li><a href="article.php?search_word='.$searchWord.'&start='.($start + $display).'&page_num='.$pages.'">&raquo;</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $("#search").click(function(){
        window.location.href="./article.php?search_word="+$("#searchText").val()
    });
</script>
<?php
require_once("../include/footer_teacher.html");
?>

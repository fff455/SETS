<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2017/12/14
 * Time: 20:50
 */
require_once('./php/mysqli_connect.php');

if (isset($_GET['id']) AND is_numeric($_GET['id']))//获得总页数
{
    $id = $_GET['id'];
    setcookie('article_id', $id);
} else {
    sleep(3);
    header('Location: ' . "./article.php");
}

$query = "select title,html from article where id=$id";
//echo $query;
$result = @mysqli_query($dbc, $query);
if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    echo "no result";
}

//释放结果集
if ($result)
    mysqli_free_result($result);
//关闭数据库
mysqli_close($dbc);
require_once('./include/article_index_header.html');
?>
<div class="content-warp" id="barba-wrapper" aria-live="polite">
    <div class="container list-container" style="visibility: visible;">
        <div class="row">
            <!--start main content aera-->
            <!-- <div>
                <button class="btn btn-info">新增文章</button>
            </div> -->
            <div class="col-md-12 main-content-timeline">
                <div class="timeline-post">
                    <div id="articleContainer">
                        <h3><?php echo $row['title']; ?></h3>
                        <?php echo $row['html']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".btn-editArticle").click(function () {
        $("#articleContainer").css("display", "none");
        $("#textareaContainer").css("display", "block");
        $(".btn-editArticle").css("display", "none");
    })
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2017/12/14
 * Time: 20:50
 */

require_once("./include/footer_index.html");
?>


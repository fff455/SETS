<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2017/12/14
 * Time: 20:50
 */
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
require_once('../php/mysqli_connect.php');

if (isset($_GET['id']) AND is_numeric($_GET['id']))//获得总页数
{
    $id = $_GET['id'];
    setcookie('article_id', $id, time()+3600,"/setsS/");
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
if (isset($_POST['deleteSubmit']))
{
//    echo "alert($id)";
//    setcookie('article_id', $id);
    $id=$_COOKIE['article_id'];
    echo "<script>console.log($id)</script>";
    $query = "delete from article where id=$id";
    echo "<script>console.log($query)</script>";
    $result = @mysqli_query($dbc, $query);
    if ($result) {
        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            添加文章成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
    } else {
        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            添加文章失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
    }
}
mysqli_close($dbc);
require_once('../include/article_teacher_header.html');
?>
<div class="content-warp" id="barba-wrapper" aria-live="polite">
    <div class="container list-container" style="visibility: visible;">
        <div class="row">
            <div class="col-md-12 main-content-timeline">
                <div class="timeline-post">
                    <div id="articleContainer">
                        <h3><?php echo $row['title']; ?></h3>
                        <?php echo $row['html']; ?>
                    </div>
                    <form action="addarticle.php" method="post">
                        <div id="textareaContainer">
                            <h3>文章标题：</h3>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>">
                            <h3>正文：</h3>
                            <textarea id="TextArea2" name="content" cols="20" rows="200"
                                      class="ckeditor"><?php echo $row['html']; ?></textarea>
                            <button class="btn btn-success" id="issueArticle" type="submit" name="submit">发布文章</button>
                        </div>
                    </form>
                    <button class="btn btn-danger btn-deleteArticle" data-toggle="modal" data-target="#myModal3">删除文章</button>
                    <button class="btn btn-primary btn-editArticle">编辑文章</button>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="modal-header  btn-warning">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel3">删除文章</h4>
                </div>
                <div class="modal-body">您确定删除当前文章吗？</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" name="deleteSubmit" class="btn btn-warning">确定</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(".btn-editArticle").click(function () {
        $("#articleContainer").css("display", "none");
        $("#textareaContainer").css("display", "block");
        $(".btn-editArticle").css("display", "none");
        $(".btn-deleteArticle").css("display", "none");
    })
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2017/12/14
 * Time: 20:50
 */

require_once("../include/footer_teacher.html");
?>


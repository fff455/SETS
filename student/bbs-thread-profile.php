<?php
/**
 * Created by PhpStorm.
 * User: momotani
 * Date: 2017/12/26
 * Time: 下午6:59
 */
if(isset($_COOKIE['user_type'])){
    if($_COOKIE['user_type']=='0'){
        $home_url = '../php/logout.php';
        header('Location: '.$home_url);
    }
    elseif ($_COOKIE['user_type']=='1'){
        $home_url = '../teacher/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
require_once('../php/mysqli_connect.php');

if (isset($_GET['id']) AND is_numeric($_GET['id']))
{
    $id = $_GET['id'];
} else {
    $id = $_POST['id'];
}

$query = "select id, owner, title, content, post_date from posts where id=$id";
$result = @mysqli_query($dbc, $query);
if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    echo "no result";
}

//释放结果集
if ($result)
    mysqli_free_result($result);

require_once('../include/bbs_student_header.html');
?>

<div id="body">
    <div class="container">
        <div class="card">
            <div class="card-block">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div class="col-md-12 main-content-timeline">
                        <div class="timeline-post" style="background-color: transparent">
                            <h3>标题：</h3>
                            <!-- <div class="input-group"> -->
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="text" name="title" class="form-control" value="<?php echo $row['title'];?>">
                            <!-- </div> -->
                            <h3>正文：</h3>
                            <textarea id="TextArea1" name="content" cols="20" rows="200" class="ckeditor"><?php echo $row['content']?></textarea>
                            <button class="btn btn-danger" type="submit" name="delete" id="issueArticle" style="float: left; left: 0px">删除</button>
                            <button class="btn btn-success" type="submit" name="submit" id="issueArticle" style="float: right; left: 0px">发布</button>
                        </div>
                    </div>
                </form>
                <?php
                require_once('../php/mysqli_connect.php');
                require_once ('../php/global.php');
                error_reporting(0);
                if(isset($_POST['submit']))
                {
                    date_default_timezone_set('PRC');
                    $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
                    $content = mysqli_real_escape_string($dbc, trim($_POST['content']));
                    $q = "update posts set title='$title' where id=$id";
                    $r = @mysqli_query($dbc, $q);
                    $q = "update posts set content='$content' where id=$id";
                    $r = @mysqli_query($dbc, $q);
                    if($r){
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                        编辑成功！</div></div></div>
                                 </div>
                                 <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                    else{
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                        编辑失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                 </div>
                                 <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                }
                if(isset($_POST['delete'])){
                    $q = "delete from posts where id=$id";
                    $r = @mysqli_query($dbc, $q);
                    $q = "delete from replys where post_id=$id";
                    $r = @mysqli_query($dbc, $q);
                    if($r){
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                        删除成功！</div></div></div>
                                 </div>
                                 <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                    else{
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                        删除失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                 </div>
                                 <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once("../include/footer_student.html");
?>

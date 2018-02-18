<?php
/**
 * Created by PhpStorm.
 * User: momotani
 * Date: 2017/12/26
 * Time: 下午4:50
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
require_once ("../include/bbs_teacher_header.html")
?>

<div class="content-warp" id="barba-wrapper" aria-live="polite">
        <div class="container list-container" style="visibility: visible;">
            <div class="row">
                <!--start main content aera-->
                <!-- <div>
                    <button class="btn btn-info">新增文章</button>
                </div> -->
                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div class="col-md-12 main-content-timeline">
                        <div class="timeline-post">
                            <h3>标题：</h3>
                            <!-- <div class="input-group"> -->
                            <input type="text" name="title" class="form-control">
                            <!-- </div> -->
                            <h3>正文：</h3>
                            <textarea id="TextArea1" name="content" cols="20" rows="200" class="ckeditor"></textarea>
                            <button class="btn btn-success" type="submit" name="submit" id="issueArticle">发布</button>
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
                    $time1 = date('Y-m-d H:i',time());
                    //获取用户的输入
                    $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
                    $content = mysqli_real_escape_string($dbc, trim($_POST['content']));
                    $owner = mysqli_real_escape_string($dbc, trim($_COOKIE['user_name']));
                    $q = "insert into posts(owner, title, content, post_date) values ('$owner','$title','$content','$time1')";
                    //执行sql语句，同样需要在前头加上 @ 符号
                    $r = @mysqli_query($dbc, $q);
                    if($r){
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            发帖成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                    else{
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            发帖失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

<?php
require_once ("../include/footer_teacher.html")
?>
<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2017/12/20
 * Time: 18:01
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
require_once("../include/manage_teacher_header.html");

require_once('../php/mysqli_connect.php');


?>
<div class="content-warp" id="barba-wrapper" aria-live="polite">
    <div class="container list-container" style="visibility: visible;">
        <div class="row">
                <div class="col-md-12 main-content-timeline">
                    <div class="timeline-post">
                        <h2>小组管理</h2>
                        <h3>为学生分配组号</h3>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<!--                        <form action="manage_new.php">-->
                            <div class="col-sm-2">学生ID：</div>
                            <div class="col-sm-3">
                                <select name="stu_id" class="form-control">
                                    <?php
                                    $query = "select sid,sname from student where sid not in (select id from groups)";
                                    $result = @mysqli_query($dbc, $query);
                                    if($result){
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                        {
                                            echo '<option>'.$row['sid'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">组号：</div>
                            <div class="col-sm-2">
                               <input type="text" name="group_id" class="form-control" />
                            </div>
                            <button type="submit" class="btn btn-success" name="alloc_submit">分配</button>
                        </form>

                        <h3>修改学生组号</h3>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <div class="col-sm-2">学生ID：</div>
                            <div class="col-sm-3">
                                <select name="stu_id" class="form-control">
                                    <?php
                                    $query = "select id,gid from groups";
                                    $result = @mysqli_query($dbc, $query);
                                    if($result){
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                        {
                                            echo '<option>'.$row['id'].' (目前组号：'.$row['gid'].')</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">新组号：</div>
                            <div class="col-sm-2">
                                <input type="text" name="group_id" class="form-control" />
                            </div>
                            <button type="submit" class="btn btn-success" name="modify_submit">修改</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 main-content-timeline">
                    <div class="timeline-post">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <h2>公告管理</h2>
                            <h3>目前公告</h3>
                            <textarea type="text" name="content" class="form-control">
                                <?php
                                $query = "select content from notice ORDER BY id DESC";
                                //echo $query;
                                $result = @mysqli_query($dbc, $query);
                                if ($result) {
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    $noticeContent=str_replace("<br />","", $row['content']);
                                    echo trim(preg_replace('/^[(\xc2\xa0)|\s]+/', '',$noticeContent));
                                } else {
                                    echo "";
                                }
                                ?>
                            </textarea>
                            <button class="btn btn-success" type="submit" name="notice_submit" id="issueArticle">更新公告</button>
                        </form>
                    </div>
                </div>
            <?php

            if(isset($_POST['alloc_submit']))
            {
                //获取用户的输入
                $sid = $_POST['stu_id'];
                $gid = $_POST['group_id'];
                $q = "select sname from student where sid='$sid'";
                $r = @mysqli_query($dbc, $q);
                if($r){
                    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                    $name = $row['sname'];
                    $q = "INSERT INTO groups VALUES ($sid,'$name',$gid)";
                    //执行sql语句，同样需要在前头加上 @ 符号
                    $r = @mysqli_query($dbc, $q);
                    if($r){
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            添加组号成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                    else{
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            添加组号失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                }


            }
            if(isset($_POST['modify_submit']))
            {
                //获取用户的输入
                $sid = explode(' ',$_POST['stu_id'])[0];
                $gid = $_POST['group_id'];
                $q = "UPDATE groups SET gid=$gid where id=$sid";
                echo $q;
                //执行sql语句，同样需要在前头加上 @ 符号
                $r = @mysqli_query($dbc, $q);
                if($r){
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            更新组号成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                }
                else{
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            更新组号失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                }

            }
            if(isset($_POST['notice_submit']))
            {
                //获取用户的输入
                $content = $_POST['content'];
                $content = str_replace("\n","<br />", $content);
                $q = "INSERT INTO notice(content,time) VALUES ('$content',NOW())";
//                echo $q;
                //执行sql语句，同样需要在前头加上 @ 符号
                $r = @mysqli_query($dbc, $q);
                if($r){
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            更新公告成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                }
                else{
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            更新公告失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                }

            }
            ?>
        </div>
    </div>
</div>
<script>
    $("#alloc_stu").click(function () {
        $(".dropdown-toggle").dropdown('toggle');
    })
//    $(function() {
//        $(".dropdown-toggle").dropdown('toggle');
//    });
</script>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_teacher.html");
?>

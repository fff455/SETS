<?php
/**
 * Created by PhpStorm.
 * User: momotani
 * Date: 2018/1/1
 * Time: 下午5:04
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

$sid = $_COOKIE['user_name'];
$imageid = $_COOKIE['user_id'] % 5 + 1;
$query5 = "select count(id) as num_p from posts where owner='$sid'";
$result5 = @mysqli_query($dbc, $query5);
$num_posts = 0;
if($result5){
    $row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC);
    $num_posts = $row5['num_p'];
}

$query6 = "select count(id) as num_r from replys where owner='$sid'";
$result6 = @mysqli_query($dbc, $query6);
$num_re = 0;
if($result6){
    $row6 = mysqli_fetch_array($result6, MYSQLI_ASSOC);
    $num_re = $row6['num_r'];
}

require_once('../include/bbs_teacher_header.html');
?>

<div id="body">
    <div class="container">
        <br>
        <div class="card">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <div style="width:90px;height:90px;margin:15px auto 15px;">
                    <?php echo '<img src= "../images/head'.(string)$imageid.'.png">'; ?>
                    </div>
                    <h4><b><?php echo $_COOKIE['user_name'];?></b></h4>
                </div>
                <div class="col-lg-10 row m-x-0" style="padding-top: 12px">
                    <div class="selef_center_div col-lg-10">
                        <span class="selef_center_num">主&nbsp;题&nbsp;数：</span>
                        <span><?php echo $num_posts;?></span>
                    </div>
                    <div class="selef_center_div col-lg-10">
                        <span class="selef_center_num">回&nbsp;帖&nbsp;数：</span>
                        <span><?php echo $num_re;?></span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <ul>
                    <li>
                        主题
                    </li>
                </ul>
            </div>

            <div class="card-block">
                <table class="table table-hover">
                    <tbody>
                    <?php

                    $query2 = "select id, owner, title, post_date from posts where owner='$sid' order by id desc";
                    $result2 = @mysqli_query($dbc, $query2);
                    if($result2){
                        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                            $post_id_temp = $row2['id'];
                            $query_temp = "select count(id) as num from replys where post_id=$post_id_temp";
                            $result_temp = @mysqli_query($dbc, $query_temp);
                            $num_reply = 0;
                            if($result_temp){
                                $row_temp = mysqli_fetch_array($result_temp, MYSQLI_ASSOC);
                                $num_reply = $row_temp['num'];
                            }

                            echo '<tr><td><span class="glyphicon glyphicon-envelope"></span><a href="bbs-thread-profile.php?id='.$row2['id'].'"> '.$row2['title'].'</a></td>
                                        <td width="80" class="text-small text-nowrap hidden-md-down">
                                            <span class="text-info">'.$row2['owner'].'</span>
                                            <br><span class="date text-grey hidden-md-down">'.$row2['post_date'].'</span>
                                        </td>
                                        <td width="80"><span><i class="icon-eye"></i> '.$num_reply.'</span></td>
                                    </tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <a role = "button" class="btn btn-block" style="background-color: whitesmoke" href="javascript:history.back()"> 返回 </a>
        </div>
    </div>
</div>

<?php
require_once("../include/footer_teacher.html");
?>

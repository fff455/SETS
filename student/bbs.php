<?php
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

require_once('../include/bbs_student_header.html');
?>

<div id="body">
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="bbs.php"><span class="glyphicon glyphicon-home"> 教学论坛</span></a></li>
            <a href="bbs-profile.php" role="button" class="btn btn-primary" style="float: right;
            color: #fff;"><span class="glyphicon glyphicon-user"></span> <?php echo $_COOKIE['user_name'];?></a>
            <a href="new-post.php" role="button" class="btn btn-primary" style="float: right;color: #fff;">发新帖</a>
        </ol>

        <div class="card">
            <div class="card-header">
                <ul>
                    <li>
                        最新主题
                    </li>
                </ul>
            </div>

            <div class="card-block">
                <table class="table table-hover">
                    <tbody>
                    <?php
                    require_once('../php/mysqli_connect.php');

                    $sid = $_COOKIE['user_id'];
                    $query3 = "select gid from groups where id=$sid";
                    $result3 = @mysqli_query($dbc, $query3);
                    $gid = 0;
                    if($result3) {
                        $gid = mysqli_fetch_array($result3, MYSQLI_ASSOC)['gid'];
                    }

                    $query2 = "select id, owner, title, post_date from posts where owner in (select name from groups where gid=$gid or gid=0)  order by id desc";
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

                            echo '<tr><td><span class="glyphicon glyphicon-envelope"></span><a href="bbs-thread.php?id='.$row2['id'].'"> '.$row2['title'].'</a></td>
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
    </div>
</div>

<?php
require_once("../include/footer_student.html");
?>
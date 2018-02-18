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

if (isset($_GET['id']) AND is_numeric($_GET['id']))
{
    $id = $_GET['id'];
} else {
    sleep(3);
    header('Location: ' . "./article.php");
}

$query = "select id, owner, title, content, post_date from posts where id=$id";
$result = @mysqli_query($dbc, $query);
if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    echo "no result";
}

$post_id_temp = $id;
$temp_name = $row['owner'];
$temp_query1 = "select sid from student WHERE sname= '$temp_name' ";
$temp_query2 = "select tid from teacher WHERE tname= '$temp_name' ";
$id_result = @mysqli_query($dbc, $temp_query1);
$temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
$temp_imageid = $temp_row['sid'] % 5 + 1;
if(!$temp_row){
    $id_result = @mysqli_query($dbc, $temp_query2);
    $temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
    $temp_imageid = $temp_row['tid'] % 5 + 1;
}
$query_temp = "select count(id) as num from replys where post_id=$post_id_temp";
$result_temp = @mysqli_query($dbc, $query_temp);
$num_reply = 0;
if($result_temp){
    $row_temp = mysqli_fetch_array($result_temp, MYSQLI_ASSOC);
    $num_reply = $row_temp['num'];
}

//释放结果集
if ($result)
    mysqli_free_result($result);

require_once('../include/bbs_teacher_header.html');
?>

<div id="body">
    <div class="container">
        <div class="card">
            <div class="card-block">
                <h3>
                    <?php echo $row['title'];?>
                </h3>
                <span class="username text-info">
                    <?php 
                        echo '<img src= "../images/head'.(string)$temp_imageid.'.png">'; ?>
                        <?php echo $row['owner'];?>
                    </span>
                <span class="date text-grey m-l-1">
                        <?php echo $row['post_date'];?>
                </span>
                <span class="text-grey"><i class="icon-eye"></i> <?php echo $num_reply;?></span>
                <hr>
                <div class="bbs-content">
                <?php echo $row['content']?>
                </div>
                <p style="line-height: 1"><br><br></p>
            </div>
        </div>

        <div class="card">
            <table class="table">
                <thead>

                <tr>
                    <th colspan="2">
                        <b>最新回复</b>
                    </th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    <td style="width: 20px;">
                        <div>
                            <span class="group group-101 m-r-xs"></span>
                        </div>
                    </td>
                </tr>
                <?php
                $post_id = $row['id'];
                $query = "select owner, content, reply_date from replys WHERE post_id= $post_id ";
                $result = @mysqli_query($dbc, $query);
                if($result){
                    while($row1 = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        $temp_name = $row1['owner'];
                        $temp_query1 = "select sid from student WHERE sname= '$temp_name' ";
                        $temp_query2 = "select tid from teacher WHERE tname= '$temp_name' ";
                        $id_result = @mysqli_query($dbc, $temp_query1);
                        $temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
                        $temp_imageid = $temp_row['sid'] % 5 + 1;
                        if(!$temp_row){
                            $id_result = @mysqli_query($dbc, $temp_query2);
                            $temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
                            $temp_imageid = $temp_row['tid'] % 5 + 1;
                        }
                        echo '<tr>
                    <td style="width: 20px;">
                        <div>
                            <span class="group group-101 m-r-xs"></span>
                        </div>
                    </td>
            <td class="p-x-0">
                <dl class="row small">
                    <dt>
                                        <img src= "../images/head'.(string)($temp_imageid).'.png">
                                        <span class="text-bold" style="font-size: 18px;padding-left: 13px;">
                                            '.$row1['owner'].'
                                        </span>
                        <span class="date text-grey m-l-sm">'.$row1['reply_date'].'</span>
                    </dt>
                </dl>
                <div class="message m-t-xs break-all">
                    '.$row1['content'].'
                </div>
            </td>
        </tr>';
                    }
                }


                //释放结果集
                if ($result)
                    mysqli_free_result($result);

                //关闭数据库
                mysqli_close($dbc);
                ?>
                <tr class="post">
                    <td class="td-avatar" aria-hidden="true">
                    </td>
                    <td class="p-l-0">
                        <form action="bbs-reply.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $row['id'];?>">
                            <textarea class="form-control" placeholder="内容" name="content"></textarea>
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary" style="float: right">　回帖　</button>
                        </form>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
require_once("../include/footer_teacher.html");
?>

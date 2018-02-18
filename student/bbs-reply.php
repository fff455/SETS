<?php
/**
 * Created by PhpStorm.
 * User: momotani
 * Date: 2017/12/26
 * Time: 下午7:51
 */

require_once '../php/mysqli_connect.php';

if(isset($_COOKIE['user_type'])){
    if($_COOKIE['user_type']=='0'){
        $home_url = '../php/logout.php';
        header('Location: '.$home_url);
    }
    else if($_COOKIE['user_type']=='2'){
        $home_url = '../student/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
error_reporting(0);
date_default_timezone_set('PRC');
$time1 = date('Y-m-d H:i',time());
$post_id = $_POST['post_id'];
$owner = $_COOKIE['user_name'];
$content = $_POST['content'];

$query = "insert into replys(post_id, owner, content, reply_date) VALUES ('$post_id','$owner','$content','$time1')";
$result = @mysqli_query($dbc, $query);
if($result){
}
else{
    echo 'failure';
}

$home_url = "./bbs-thread.php?id=".$post_id;
header('Location: '.$home_url);
?>
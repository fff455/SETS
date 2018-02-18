<?php
require_once('../php/mysqli_connect.php');

if(isset($_POST['submit']))
{
    //获取用户的输入
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
    $html = mysqli_real_escape_string($dbc, trim($_POST['content']));
    $content = substr(strip_tags($html),0,64);
//                unset($_POST['submitted']);
    //插入语句
    $q = "UPDATE article SET title='$title',html='$html',content='$content',article_date=now() WHERE id=$id";
    //执行sql语句，同样需要在前头加上 @ 符号
    $r = @mysqli_query($dbc, $q);
    if ($r){
        echo "<script>alert(\"success\")</script>";
//        $home_url = './article.php';
//        header('Location: '.$home_url);
    }
    else{
        echo "fail:".mysqli_error($dbc);
    }
//    sleep(3);
    $home_url = './article.php';
    header('Location: '.$home_url);
}
?>
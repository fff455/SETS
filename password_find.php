<?php
//插入连接数据库的相关信息
require_once './php/mysqli_connect.php';

$error_msg = "";
//判断用户是否已经设置cookie，如果未设置$_COOKIE['user_id']时，执行以下代码
if(!isset($_COOKIE['user_id'])){
    if(isset($_POST['submit'])){//判断用户是否提交登录表单，如果是则执行如下代码
//        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['id']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['pwd']));
//        echo $user_username;
//        echo $user_password;

        if(!empty($user_username)&&!empty($user_password)){
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT * FROM teacher WHERE tname = '$user_username' AND "."password = '$user_password'";
            //用用户名和密码进行查询
            $data = mysqli_query($dbc,$query);
            if(!$data){
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
            //若查到的记录正好为一条，则设置COOKIE，同时进行页面重定向
            else{
                if(mysqli_num_rows($data)==1){
                    $row = mysqli_fetch_array($data);
                    setcookie('user_id',$row['tid']);
                    setcookie('user_name',$row['tname']);
                    setcookie('user_type','1');
                    $home_url = './teacher/index.php';
                    header('Location: '.$home_url);
                }
                else if(mysqli_num_rows($data)==0){
                    $query = "SELECT * FROM student WHERE sname = '$user_username' AND "."password = '$user_password'";
                    $data = mysqli_query($dbc,$query);
                    if(!$data){
                        $error_msg = 'Sorry, you must enter a valid username and password to log in.';
                    }
                    //若查到的记录正好为一条，则设置COOKIE，同时进行页面重定向
                    else{
                        if(mysqli_num_rows($data)==1){
                            $row = mysqli_fetch_array($data);
                            setcookie('user_id',$row['sid']);
                            setcookie('user_name',$row['sname']);
                            setcookie('user_type','2');
                            $home_url = './student/index.php';
                            header('Location: '.$home_url);
                        }
                    }
                }
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
        echo $error_msg;
    }
}else{//如果用户已经登录，则直接跳转到已经登录页面
//    echo "enter else";
    if($_COOKIE['user_type']=='1')
        $home_url = './teacher/index.php';
    else if($_COOKIE['user_type']=='2')
        $home_url = './student/index.php';
    else
        $home_url = './index.php';
    header('Location: '.$home_url);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SETS密码找回</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/pricing.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="./css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/cookie.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
<!--    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">-->
    <link rel="stylesheet" href="./css/bootstrap.css">
<!--    <link rel="stylesheet" href="./css/font-awesome.min.css">-->
    <link rel="stylesheet" href="./css/form-elements.css">
    <link rel="stylesheet" href="./css/signup_style.css">

</head>

<body>

<!-- Top menu -->
<nav class="fh5co-nav" role="navigation" style="background-color: white">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="fh5co-logo"><a href="index.php"><i class="icon-study"></i> SETS. </a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="index.php#start">主页</a></li>
                        <li><a href="article.php">文章</a></li>
                        <li class="btn-cta" id="login" data-toggle="modal" data-target="#myModal2"><a href="#"><span>登录</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
</nav>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="modal-header btn-info">
                    <span class="heading modal-title" id="myModalLabe2">用户登录</span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control" name="id" id="inputEmail3" placeholder="用户名">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" class="form-control" name="pwd" id="inputPassword3" placeholder="密　码">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group">
                        <div class="main-checkbox">
                            <input type="checkbox" value="None" id="checkbox1" name="check" />
                            <label for="checkbox1"></label>
                        </div>
                        <span class="text">Remember me</span>
                        <button id="userLogin" type="submit" name="submit" class="btn-form-temp btn-info">登录</button>


                    </div>
                    <div class="modal-footer">
                        <div style="clear: both; float: left"><a href="password_find.php">忘记密码？</a></div>
                        <div style="float: right"><a href="signup.php">立即注册</a></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">

                    <form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="registration-form">
                        <?php
                        if(isset($_POST['refind_submit'])){//判断用户是否提交登录表单，如果是则执行如下代码
                            $username = $_COOKIE['refind_name'];

                            $query = "SELECT answer,password FROM user_signup WHERE name = '$username'";
//                            echo $query;
                            $result = @mysqli_query($dbc, $query);
                            if($result){
                                $row = @mysqli_fetch_array($result, MYSQLI_NUM);
                                if(count($row)>0){
                                    $answer = $row[0];
                                    $password = $row[1];
                                    if($_POST['form-answer']==$answer){
                                        echo '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                              <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                                 问题验证成功！<br />您的密码是'.$password.'</div></div></div>
                                              </div>
                                              <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                                    }
                                    else{
                                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                                        问题验证失败！</div></div></div>
                                                 </div>
                                                 <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                                    }
                                }
                                else{
                                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            找不到用户！<br /></div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                                }
                            }
                        }
                        ?>
                        <fieldset>
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>密码找回</h3>
                                    <p>Find password according to your information:</p>
                                </div>
                                <div class="form-top-right">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <div class="form-group">
                                    <label class="sr-only" for="form-name">用户名</label>
                                    <input type="text" name="form--name" placeholder="用户名..." class="form-first-name form-control" id="form-name">
                                </div>

                                <button type="submit" id="next" class="btn btn-next">下一步</button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>密码找回</h3>
                                    <p>Find password according to your information:</p>
                                </div>
                                <div class="form-top-right">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <?php
                                $name = $_COOKIE['refind_name'];
                                $query = "select question,answer,password from user_signup where name='$name'";
                                $result = @mysqli_query($dbc, $query);
                                if($result){
                                    $row = @mysqli_fetch_array($result, MYSQLI_NUM);
                                    if(count($row)>0){
//                                        echo var_dump($row);
                                        $question = $row[0];
                                        $answer = $row[1];
                                        echo '<div class="form-group">
                                                <label class="sr-only" for="form-repeat-password">密码找回问题</label>
                                                <h4>'.$question.'</h4>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="">密码找回问题答案</label>
                                                <input type="text" name="form-answer" placeholder="密码找回问题答案..."
                                                       class="form-control" id="form-answer">
                                            </div>
                                            <button type="submit" name="refind_submit" class="btn">找回密码</button>';
                                    }
                                    else{
//                                        echo '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
//                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
//                                            找不到用户！<br /></div></div></div>
//                                     </div>
//                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                                    }
                                }
                                ?>

                            </div>
                        </fieldset>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script>
    $("#form-name").blur(function(){
        document.cookie = "refind_name=" + $("#form-name").val();
    })
</script>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/jquery.backstretch.min.js"></script>
<script src="./js/retina-1.1.0.min.js"></script>
<script src="./js/signup.js"></script>

<!--[if lt IE 10]>
<script src="./js/placeholder.js"></script>
<![endif]-->

</body>

</html>

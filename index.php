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

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>软件工程教学网站</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

<!--	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">-->
<!--	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">-->

	<!-- Animate.css -->
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
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<div class="fh5co-loader" name="start"></div>

	<div id="page">
		<nav class="fh5co-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<div id="fh5co-logo"><a href="index.php"><i class="icon-study"></i> SETS. </a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a style="background-color: #5bc0de; color: white; padding: 10px;border-radius: 5px;" href="index.php#start">主页</a></li>
								<li><a href="article.php">文章</a></li>
								<li class="btn-cta" id="login" data-toggle="modal" data-target="#myModal2"><a href="#"><span>登录</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/img_bg_1.jpg);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center slider-text">
									<div class="slider-text-inner">
										<h1>浙江大学软件工程<br />教学系统</h1>
										<h2>计算机学院辅助教学系统</a></h2>
										<p><a class="btn btn-primary btn-lg" href="#">开始学习！</a></p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li style="background-image: url(images/img_bg_2.jpg);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center slider-text">
									<div class="slider-text-inner">
										<h1>软件需求工程、软件工程管理<br />教学资源</h1>
										<h2>帮助更多软件工程师生</h2>
										<p><a class="btn btn-primary btn-lg btn-learn" href="#">开始学习！</a></p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li style="background-image: url(images/img_bg_3.jpg);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center slider-text">
									<div class="slider-text-inner">
										<h1>教育的目的不在于知识<br />而是行动</h1>
										<h2>更加方便地切合课程</h2>
										<p><a class="btn btn-primary btn-lg btn-learn" href="#">开始学习！</a></p>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="sticky-bar">
				<button id="notice" class="btn btn-warning notice" data-toggle="modal" data-target="#myModal">
					<span class="glyphicon glyphicon-exclamation-sign"></span>
					<br  />公<br />告
				</button>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header btn-info">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">×</span>
			                </button>
								<h4 class="modal-title" id="myModalLabel">公告</h4>
							</div>
							<div class="modal-body">
                                <?php
                                require_once('./php/mysqli_connect.php');
                                $query = "select content from notice ORDER BY id DESC";
                                //echo $query;
                                $result = @mysqli_query($dbc, $query);
                                if ($result) {
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    echo $row['content'];
                                } else {
                                    echo "";
                                }

                                ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">我知道了</button>
							</div>
						</div>
					</div>
				</div>
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
										<i class="fa fa-user"></i>
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
			</div>
		</aside>

		<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" title="网站模板">网站模板</a></div>

		<div id="fh5co-course">

		</div>

		<div id="fh5co-testimonial" style="background-image: url(images/school.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2><span>课程介绍</span></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row animate-box">
							<div class="owl-carousel owl-carousel-fullwidth">
								<div class="item">
									<div class="testimony-slide active text-center">
										<div class="user" style="background-image: url(images/person1.jpg);"></div>
										<span>软件需求工程</span>
										<blockquote>
											<p>&ldquo;本课程的主要任务是在软件工程整体知识的基础上，深入学习并实践软件需求获取与管理的原理、方法和过程，学习并掌握使用UML工具对软件需求进行分析、表达与系统设计。课程内容包括两部分：一是需求获取和维护的过程和方法，包括需求提取、需求分析和建模、需求表达、需求确认、需求变更控制，以及相应的工具；二是UML概念、方法和工具。课程配合案例性实践环节进行教学。通过本课程的学习，应使学生掌握如何在软件工程的实践中完成复杂软件需求的获取、表达和维护能力，学会应用UML进行软件需求分析与设计的技术和方法，为掌握软件工程的系统全面的知识和技能打下坚实基础.&rdquo;</p>
										</blockquote>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide active text-center">
										<div class="user" style="background-image: url(images/person2.jpg);"></div>
										<span>软件工程管理</span>
										<blockquote>
											<p>&ldquo;软件工程管理是对软件项目开发生命周期全过程所有工程活动的管理。软件工程管理的主要任务有软件项目规划、分析、估算和评审，软件项目计划、实施及质量管理，软件开发的资源管理、过程管理、风险管理、服务管理等。软件工程管理主要涵盖以下内容：项目管理，过程管理以及战略管理、创新管理、产品管理、服务管理等.&rdquo;</p>
										</blockquote>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide active text-center">
										<div class="user" style="background-image: url(images/person3.jpg);"></div>
										<span>软件质量与测试</span>
										<blockquote>
											<p>&ldquo;本课程按软件测试的原理、技术和实践三部分组织内容，包括软件工程概述，软件测试和质量保证的基本概念、思想和方法，各种测试的方法和技巧，软件测试用例的设计；如何组织和管理软件测试项目、如何进行软件质量分析，最终建立全面的质量保证体系.&rdquo;</p>
										</blockquote>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-staff">
			<div class="container">
				<div class="row">
					<div class="col-md-3 text-center">
						<div class="staff">
							<div class="staff-img" style="background-image: url(images/staff-1.jpg);">
								<ul class="fh5co-social">
									<li>
										<h3>金波</h3></li>
								</ul>
							</div>
							<h3><a href="./teacher.html">金波</a></h3>
							<p>副教授，1971年6月生，工学博士。主要从事电液控制系统与深海机电装备的研究工作，共在国内外学术刊物与国际会议上发表论文60余篇，其中作为第一作者或通讯作者被SCI收录5篇，EI收录15篇，ISTP收录5篇。作为第一、二发明人获得国家发明专利、软件著作权共8项。作为主要完成人获得国家技术发明奖二等奖一项，省部级科技进步一等奖两项...</p>
						</div>
					</div>
					<div class="col-md-3 animate-box text-center">
						<div class="staff">
							<div class="staff-img" style="background-image: url(images/staff-2.jpg);">
								<ul class="fh5co-social">
									<li>
										<h3>刘玉生</h3></li>
								</ul>
							</div>
							<h3><a href="./teacher.html">刘玉生</a></h3>
							<p>博士，浙江大学计算机学院研究员，博士生导师，CAD&amp;CG国家重点实验室固定研究人员。1995年7月在浙江大学获硕士学位后赴澳门贺田工业有限公司从事机电产品的研发。1997年9月起在浙江大学机械制造及自动化专业攻读博士学位并于2000年9月毕业。同年10月进入浙江大学CAD&amp;CG国家重点实验室从事博士后研究，2002年10月出站后前往在香港城市大学继续从事博士后研究...</p>
						</div>
					</div>
					<div class="col-md-3 animate-box text-center">
						<div class="staff">
							<div class="staff-img" style="background-image: url(images/staff-3.jpg);">
								<ul class="fh5co-social">
									<li>
										<h3>邢卫</h3></li>
								</ul>
							</div>
							<h3><a href="./teacher.html">邢卫</a></h3>
							<p>浙江大学计算机科学与技术学院博士，副教授，硕士生导师。1992年起先后在浙江大学工业控制技术国家实验室、浙江大学信息学院控制科学与工程系、浙江大学计算机科学与技术学院任职；1994年晋升讲师，2000年12月晋升副教授；2011年2月至2012年7月作为援疆干部，任塔里木大学信息工程学院副院长，学校信息化工作领导小组办公室常务副主任...</p>
						</div>
					</div>
					<div class="col-md-3 animate-box text-center">
						<div class="staff">
							<div class="staff-img" style="background-image: url(images/staff-4.jpg);">
								<ul class="fh5co-social">
									<li>
										<h3>林海</h3></li>
								</ul>
							</div>
							<h3><a href="#">林海</a></h3>
							<p>主要从事计算机图形学、科学计算可视化、虚拟现实等方面的研究，承担国家自然科学基金项目三项，国家863科技计划项目二项，军工项目多项。目前的研究工作具体主要在：高分辨率多屏拼接显示技术;体数据可视化算法研究;医学数据可视化;基于CPU/GPU混合集群的大规模体数据可视化;基于图形加速的计算电磁学等方面。</p>
						</div>
					</div>
				</div>
			</div>
		</div>


    <?php
    require_once ("./include/message-box.php");
    ?>

        <br />
<?php
require_once ("./include/footer_index.html");
?>
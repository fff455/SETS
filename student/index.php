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
//print_r($_COOKIE);
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

<!--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">-->

    <!-- Animate.css -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../css/icomoon.css">
    <!-- Bootstrap  -->
    <!-- <link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.css"> -->

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="../css/flexslider.css">

    <!-- Pricing -->
    <link rel="stylesheet" href="../css/pricing.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
        <script src="../js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="fh5co-loader"></div>

<div id="page">
    <nav class="fh5co-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="fh5co-logo"><a href="index.html"><i class="icon-study"></i> SETS. </a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
                            <li class="active"><a style="background-color: #5bc0de; color: white; padding: 10px;border-radius: 5px;" href="index.php">主页</a></li>
                            <li><a href="homework.php">作业</a></li>
                            <li><a href="material.php">资料</a></li>
                            <li><a href="bbs.php">论坛</a></li>
                            <li><a href="article.php">文章</a></li>
                            <li style="position: relative; left: 100px"><span class="glyphicon glyphicon-user"></span></span> <?php print($_COOKIE['user_name']."  ")?></li>
                            <li class="btn btn-warning" style="position: relative; left: 110px" id="logout" data-toggle="modal" data-target="#myModal2"><span> 注销</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="fh5co-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(../images/img_bg_1.jpg);">
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
                <li style="background-image: url(../images/img_bg_2.jpg);">
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
                <li style="background-image: url(../images/img_bg_3.jpg);">
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
                            require_once('../php/mysqli_connect.php');
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
                        <form class="form-horizontal" action="../php/logout.php" method="post">
                            <div class="modal-header  btn-warning">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">注销登录</h4>
                            </div>
                            <div class="modal-body">您确定注销现在的登录吗？</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="submit" name="submit" class="btn btn-warning">确定</button>
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

    <div id="fh5co-testimonial" style="background-image: url(../images/school.jpg);">
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
                                    <div class="user" style="background-image: url(../images/person1.jpg);"></div>
                                    <a style="color: white" href="course.php?cid=1">软件需求工程</a>
                                    <blockquote>
                                        <p>&ldquo;本课程的主要任务是在软件工程整体知识的基础上，深入学习并实践软件需求获取与管理的原理、方法和过程，学习并掌握使用UML工具对软件需求进行分析、表达与系统设计。课程内容包括两部分：一是需求获取和维护的过程和方法，包括需求提取、需求分析和建模、需求表达、需求确认、需求变更控制，以及相应的工具；二是UML概念、方法和工具。课程配合案例性实践环节进行教学。通过本课程的学习，应使学生掌握如何在软件工程的实践中完成复杂软件需求的获取、表达和维护能力，学会应用UML进行软件需求分析与设计的技术和方法，为掌握软件工程的系统全面的知识和技能打下坚实基础.&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide active text-center">
                                    <div class="user" style="background-image: url(../images/person2.jpg);"></div>
                                    <a style="color: white" href="course.php?cid=2">软件工程管理</a>
                                    <blockquote>
                                        <p>&ldquo;软件工程管理是对软件项目开发生命周期全过程所有工程活动的管理。软件工程管理的主要任务有软件项目规划、分析、估算和评审，软件项目计划、实施及质量管理，软件开发的资源管理、过程管理、风险管理、服务管理等。软件工程管理主要涵盖以下内容：项目管理，过程管理以及战略管理、创新管理、产品管理、服务管理等.&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide active text-center">
                                    <div class="user" style="background-image: url(../images/person3.jpg);"></div>
                                    <a style="color: white" href="course.php?cid=3">软件质量与测试</a>
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
                        <div class="staff-img" style="background-image: url(../images/staff-1.jpg);">
                            <ul class="fh5co-social">
                                <li>
                                    <h3>金波</h3></li>
                            </ul>
                        </div>
                        <h3><a href="">金波</a></h3>
                        <p>副教授，1971年6月生，工学博士。主要从事电液控制系统与深海机电装备的研究工作，共在国内外学术刊物与国际会议上发表论文60余篇，其中作为第一作者或通讯作者被SCI收录5篇，EI收录15篇，ISTP收录5篇。作为第一、二发明人获得国家发明专利、软件著作权共8项。作为主要完成人获得国家技术发明奖二等奖一项，省部级科技进步一等奖两项...</p>
                    </div>
                </div>
                <div class="col-md-3 animate-box text-center">
                    <div class="staff">
                        <div class="staff-img" style="background-image: url(../images/staff-2.jpg);">
                            <ul class="fh5co-social">
                                <li>
                                    <h3>刘玉生</h3></li>
                            </ul>
                        </div>
                        <h3><a href="">刘玉生</a></h3>
                        <p>博士，浙江大学计算机学院研究员，博士生导师，CAD&amp;CG国家重点实验室固定研究人员。1995年7月在浙江大学获硕士学位后赴澳门贺田工业有限公司从事机电产品的研发。1997年9月起在浙江大学机械制造及自动化专业攻读博士学位并于2000年9月毕业。同年10月进入浙江大学CAD&amp;CG国家重点实验室从事博士后研究，2002年10月出站后前往在香港城市大学继续从事博士后研究...</p>
                    </div>
                </div>
                <div class="col-md-3 animate-box text-center">
                    <div class="staff">
                        <div class="staff-img" style="background-image: url(../images/staff-3.jpg);">
                            <ul class="fh5co-social">
                                <li>
                                    <h3>邢卫</h3></li>
                            </ul>
                        </div>
                        <h3><a href="">邢卫</a></h3>
                        <p>浙江大学计算机科学与技术学院博士，副教授，硕士生导师。1992年起先后在浙江大学工业控制技术国家实验室、浙江大学信息学院控制科学与工程系、浙江大学计算机科学与技术学院任职；1994年晋升讲师，2000年12月晋升副教授；2011年2月至2012年7月作为援疆干部，任塔里木大学信息工程学院副院长，学校信息化工作领导小组办公室常务副主任...</p>
                    </div>
                </div>
                <div class="col-md-3 animate-box text-center">
                    <div class="staff">
                        <div class="staff-img" style="background-image: url(../images/staff-4.jpg);">
                            <ul class="fh5co-social">
                                <li>
                                    <h3>林海</h3></li>
                            </ul>
                        </div>
                        <h3><a href="">林海</a></h3>
                        <p>主要从事计算机图形学、科学计算可视化、虚拟现实等方面的研究，承担国家自然科学基金项目三项，国家863科技计划项目二项，军工项目多项。目前的研究工作具体主要在：高分辨率多屏拼接显示技术;体数据可视化算法研究;医学数据可视化;基于CPU/GPU混合集群的大规模体数据可视化;基于图形加速的计算电磁学等方面。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="message-box">
        <?php
        //            $page_title = '留言板';
        $pages = 0;

        //包含上一级目录的数据库连接文件
        require_once('../php/mysqli_connect.php');

        if(isset($_POST['submitted']))
        {
            //获取用户的输入
            $n = mysqli_real_escape_string($dbc, trim($_POST['inputName']));
            $e = mysqli_real_escape_string($dbc, trim($_POST['inputEmail']));
            $c = mysqli_real_escape_string($dbc, trim($_POST['inputComment']));
//                unset($_POST['submitted']);
            //插入语句
            $q = "insert into comment_list(name, email, comment, comment_date) values('$n', '$e', '$c', now())";
            //执行sql语句，同样需要在前头加上 @ 符号
            $r = @mysqli_query($dbc, $q);
        }

        echo '<div>
                    <h2 style="position: relative;left: 25%;top: -30px;">留言板</h2>
                    </div>
                    <div class="col-lg-7">';

        $display = 5;	//每页留言数目

        if(isset($_GET['p']) AND is_numeric($_GET['p']))//获得总页数
        {
            $pages = $_GET['p'];
        }
        else
        {
            $q = "select count(id) from comment_list";
            $r = @mysqli_query($dbc, $q);
            $row = @mysqli_fetch_array($r, MYSQLI_NUM);	//从结果集$r得到数字数组
            $record = $row[0];							//$row[0]即为count(id)
            $pages = ceil($record / $display);			//计算总页数，ceil函数向上舍入为最接近的整数
        }
        if(isset($_GET['s']) && is_numeric($_GET['s']))//获得起始留言编号
        {
            $start = $_GET['s'];
        }
        else
        {
            $start = 0;		//如果首次载入页面，则起始编号为0
        }

        $q = "select name,comment,DATE_FORMAT(comment_date, '%M %d, %Y') as dr from comment_list order by dr limit $start, $display";
        $r = @mysqli_query($dbc, $q);
        if($r){
            $iter = 0;
            while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))//从结果集$r得到关联数组
            {
                echo '<div style="clear: both"><image src="../images/head'.($iter%5+1).'.png" style="" />
                            <div class="panel" style="position: relative;left: 50px;top: -50px;">
                            <div class="panel-body">
                            <h4 style="position: relative;top: -20px;">' . $row['name'] . '</h4>
                            <p style="color: #CDC9C9 ;position: relative;top: -20px;">'. $row['dr'] . '</p>
                            <h5 style="position: relative;top: -20px;">' . $row['comment'] . '</h5>
                            </div></div></div>';
                $iter++;
            }
        }

        //释放结果集
        if($r)
            mysqli_free_result($r);

        //关闭数据库
        mysqli_close($dbc);

        //如果页数大于1，则显示分页
        if($pages > 1)
        {
            $current_page = ($start / $display) + 1;

            echo '<ul class="pager" style="position: relative;top: -50px;">';
            if($current_page != 1)	//当前页不是第一页，则显示向前连接
            {
                echo '<li><a href="index.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a></li>';
            }
            if($current_page != $pages)	//当前页不是最后一页，则显示向后连接
            {
                echo '<li><a href="index.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a></li>';
            }
            echo '</ul>';
        }

        echo '</div>';//col-lg-6
        ?>

        <div class="leave-message col-lg-7">
            <form role="form" action="index.php" method="post" style="position: relative;left: 7%; top: -30px;">
                <label for="inputName" class="sr-only">姓名</label>
                <input type="text" name="inputName" class="form-control" placeholder="姓名" maxlength="20" required autofocus>
                <label for="inputEmail" class="sr-only">邮箱</label>
                <input type="email" name="inputEmail" class="form-control" placeholder="邮箱" maxlength="80" required>
                <label for="inputComment" class="sr-only">评论内容</label>
                <textarea class="form-control" name="inputComment" rows="5" placeholder="评论内容" maxlength="100" required></textarea>
                <button class="btn btn-lg btn-primary btn-block" type="submit">评论</button>
                <!-- 隐藏输入框，用于判断用户是否点击提交-->
                <input type = "hidden" name="submitted" value="TRUE">
            </form>
        </div>
    </div>




    <footer id="fh5co-footer" role="contentinfo" style="background-image: url(../images/img_bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-3 fh5co-widget">
                    <h3>友情链接</h3>
                    <ul class="fh5co-footer-links">
                        <li><a href="#"></a></li>
                        <li><a href="http://www.cc98.org">CC98</a></li>
                        <li><a href="http://cspo.zju.edu.cn/redir.php?catalog_id=2">浙江大学计算机学院</a></li>
                        <li><a href="http://www.cs.zju.edu.cn/se/">软件工程基础</a></li>
                        <li><a href="https://met.zju.edu.cn:8443/webapps/login/">学在浙里</a></li>
                    </ul>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                    <h3>网站向导</h3>
                    <ul class="fh5co-footer-links">
                        <li><a href="">此网站用于软件需求工程和软件工程管理课程教学使用。<br >
                                未登录的游客可以查看首页和文章，文章有老师发布的公共的文本，更多的信息敬请登录查看。<br />
                                学生可以通过自己的账号密码登录，学生登录后可以查看除首页、文章以外的作业、资料和论坛模块。作业中有老师发布的作业要求，资料中有老师上传的课程资料，学生在论坛模块可以进行小组内的交流。<br />
                                教师登录后可以发布和点评作业、上传课程资料、进入小组论坛进行指导、发布文章和对公告进行管理。</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="../js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<!-- <script src="./css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> -->
<!-- Waypoints -->
<script src="../js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="../js/jquery.stellar.min.js"></script>
<!-- Carousel -->
<script src="../js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="../js/jquery.flexslider-min.js"></script>
<!-- countTo -->
<script src="../js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="../js/jquery.magnific-popup.min.js"></script>
<script src="../js/magnific-popup-options.js"></script>
<!-- Count Down -->
<script src="../js/simplyCountdown.js"></script>
<script src="../js/layer/layer.js"></script>
<!-- Main -->
<script src="../js/main.js"></script>
<script>
    window.scrollTo(0,0);
    var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
</script>
</body>

</html>

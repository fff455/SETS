<div class="message-box">
            <?php
//            $page_title = '留言板';
            $pages = 0;

            //包含上一级目录的数据库连接文件
            require_once('./php/mysqli_connect.php');

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
                    echo '<div style="clear: both"><image src="./images/head'.($iter%5+1).'.png" style="" />
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
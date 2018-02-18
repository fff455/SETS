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
    elseif ($_COOKIE['user_type']=='1'){
        $home_url = '../teacher/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
require_once("../include/material_student_header.html");
?>
<div class="materialPane">
    <div class="timeline-post videoArea" style="height: 600px">
        <h2>课程视频资源</h2>
        <div class="form-inline">
            <div class="form-group col-sm-3">
                <div class="panel-group" id="videoList">
                    <div class="panel panel-info" data-toggle="collapse" data-parent="#videoList"
                         href="#requirementFile">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a>软件需求工程</a>
                            </h4>
                        </div>
                        <div id="requirementFile" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <?php
                                $query="SELECT vid,name,path FROM video WHERE path like '%/video/re/%' and valid=true";
                                $result = @mysqli_query($dbc, $query);
                                if($result){
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                    {
                                        $name=$row['name'];
                                        $id=$row['vid'];
                                        $name=str_replace(".mp4","",$name);
                                        echo '<p><a class="unwork_a" href="material.php?video_index='.$id.'">'.$name.'</a>&nbsp</p>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" data-toggle="collapse" data-parent="#videoList"
                         href="#managementFile">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a>软件工程管理</a>
                            </h4>
                        </div>
                        <div id="managementFile" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php
                                $query="SELECT vid,name,path FROM video WHERE path like '%/video/sem/%' and valid=true";
                                $result = @mysqli_query($dbc, $query);
                                if($result){
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                    {
                                        $name=$row['name'];
                                        $id=$row['vid'];
                                        $name=str_replace(".mp4","",$name);
                                        echo '<p><a class="unwork_a" href="./material.php?video_index='.$id.'">'.$name.'</a></p>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php
                if(isset($_GET['video_index']))// 获得搜索词
                {
                    $vid = $_GET['video_index'];
                    $query = "SELECT path from video where vid=$vid and valid=true";
                    $result = @mysqli_query($dbc, $query);
                    if ($result) {
                        $row = @mysqli_fetch_array($result, MYSQLI_NUM);
//                        echo var_dump($row);
                        if(count($row)>0){
                            $path=$row[0];
                            if(strpos($path,"/video/re/")!=false)
                                $img_path = "../images/img_re.jpg";
                            else
                                $img_path = "../images/img_sem.jpg";
                            echo '<video width="700" height="500" controls poster="'.$img_path.'">
                                    <source src="'.$path.'" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                        }
                    }
                }
                else{
                    $query = "SELECT path from video where path like '/video/re/' and valid=true";
                    $result = @mysqli_query($dbc, $query);
                    if ($result) {
                        $row = @mysqli_fetch_array($result, MYSQLI_NUM);
                        if(count($row)>0){
                            echo '<video width="800" height="500" controls poster="../images/img_re.jpg">
                                    <source src="'.$path.'" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                        }
                    }
                    else{
                        $query = "SELECT path from video where path like '/video/sem/' and valid=true";
                        $result = @mysqli_query($dbc, $query);
                        if ($result) {
                            $row = @mysqli_fetch_array($result, MYSQLI_NUM);
                            if(count($row)>0){
                                echo '<video width="800" height="500" controls poster="../images/img_sem.jpg">
                                    <source src="'.$path.'" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                            }
                        }
                    }
                }
                ?>

            </div>
        </div>
        <br />
    </div>
    <div class="timeline-post fileArea">
        <h2>课程资源</h2>
        <div class="panel-group" id="fileList">
            <div class="panel panel-info" data-toggle="collapse" data-parent="#fileList"
                 href="#requirementVideo">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a>软件需求工程</a>
                    </h4>
                </div>
                <div id="requirementVideo" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>上传日期</th>
                                <th>大小</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query="SELECT name,upload_time,size,path FROM file WHERE path like '%/file/re/%' and valid=true";
                            $result = @mysqli_query($dbc, $query);
                            //                            echo $query;
                            if($result){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                {
                                    $name=$row['name'];
                                    $time=$row["upload_time"];
                                    $size=$row["size"];
                                    $path=$row["path"];
                                    echo '<tr>
                                            <td>'.$name.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$size.'kb</td>
                                            <td><a style="color: white" href="../php/download_material.php?cata=re&file='.$name.'" class="btn btn-success unwork_a">下载</a>
                                            </td>
                                           </tr>';
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-info" data-toggle="collapse" data-parent="#fileList"
                 href="#managementVideo">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a>软件工程管理</a>
                    </h4>
                </div>
                <div id="managementVideo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>上传日期</th>
                                <th>大小</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query="SELECT name,upload_time,size,path FROM file WHERE path like '%/file/sem/%' and valid=true";
                            $result = @mysqli_query($dbc, $query);
                            //                            echo $query;
                            if($result){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                {
                                    $name=$row['name'];
                                    $time=$row["upload_time"];
                                    $size=$row["size"];
                                    $path=$row["path"];
//                                    $filename=str_replace("../material/file/sem/","",$path);
                                    echo '<tr>
                                            <td>'.$name.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$size.'kb</td>
                                            <td><a style="color: white" href="../php/download_material.php?cata=sem&file='.$name.'" class="btn btn-success unwork_a">下载</a>
                                            </td>
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
        <br />
    </div>
</div>
<script>
    $(".unwork_a").click(function(){
        window.location.href= this.href;
    });
    $(".btn_download").click(function(){
//        alert(this.attr('href'));
        window.location.href= this.href;
    });
</script>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_student.html");
?>

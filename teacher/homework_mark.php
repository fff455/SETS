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
    elseif ($_COOKIE['user_type']=='2'){
        $home_url = '../student/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
require_once("../include/homework_teacher_header.html");
require_once('../php/mysqli_connect.php');

parse_str($_SERVER['QUERY_STRING']);

$query1="select hw_name,deadline,summary from homework where hw_id=".$hw_id.";";
$queryresult1=mysqli_query($dbc, $query1);
$array1 = array();
if ($queryresult1) {
    $row = mysqli_fetch_array($queryresult1, MYSQLI_ASSOC);
        array_push($array1,$row);
} 
else {
    echo "no result";
}
$jarray1=json_encode($array1);

$query2="select handintime,hw_Index,grade,comment from student_homework where hw_id=".$hw_id." and sid=".$sid.";";
$queryresult2=mysqli_query($dbc, $query2);
if ($queryresult2) 
    $row = mysqli_fetch_array($queryresult2, MYSQLI_ASSOC);
else {
    echo "no result";
}
$jarray2=json_encode($row);

?>
<div class="teacherViewHomework container container-white">
    <div class="container-gray">
        <h3>点评</h3>
        <div class="container-gray" id="homeworkContent">

        </div>
    </div>
    <div class="container-gray" id="homeworkHref">

    </div>
    <div class="container-gray">
        <a class="pdf"  id="showHomework">预览作业</a>
    </div>
<form method="post" action="">
    <div class="container-gray" >
        <input type="text" name="setScore" value="评分">
    </div>

    <div class="container-white">
        <textarea id="commentArea" name="commentArea" class="ckeditor" rows="10" cols="150"></textarea>
        <script type="text/javascript"> CKEDITOR.replace('commentArea')</script>
        <button class="commitButton" id="commitComment" type="submit">提交</button>
    </div>
</form>
</div>
<style type="text/css">
    .tr_odd
    {
        background-color: #EBF2FE;
    }
    .tr_even
    {
        background: #B4CDE6;
    }
    .commitButton{
        display: inline-block;
        *display: inline;
        vertical-align: baseline;
        margin: 0 2px;
        outline: none;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        font: 14px/100% 微软雅黑, Helvetica, sans-serif;
        padding: .5em 2em .55em;
        text-shadow: 0 1px 1px rgba(0,0,0,.3);
        -webkit-border-radius: .5em;
        -moz-border-radius: .5em;
        border-radius: .5em;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        box-shadow: 0 1px 2px rgba(0,0,0,.2);
    }
    .chooseAllBox{
        padding-top: 12px;
        padding-left: 66%;
    }
    .container-gray{
        background: #F0F0F0;
        padding-top:12px;
        padding-bottom:12px;
        padding-left: 12px;
        padding-right: 12px;
        border:1px solid #ccc;
    }
    .container-white{
        padding-top: 12px;
        padding-bottom: 12px;
        border:1px solid #ccc;
    }

    input[type="text"],#btn1,#btn2{
        box-sizing: border-box;
        text-align:center;
        font-size:1.2em;
        height:1.8em;
        width: 9em;
        border-radius:4px;
        border:1px solid #c8cccf;
        color:#6a6f77;
        -web-kit-appearance:none;
        -moz-appearance: none;
        display:block;
        outline:0;
        padding:0 1em;
        text-decoration:none;

    }
    input[type="text"]:focus{
        border:1px solid #ff7496;
    }
</style>
<script type="text/javascript">

    var jarray1=<?php echo $jarray1?>;
    var hw_name=jarray1[0].hw_name;
    var summary=jarray1[0].summary;
    var deadline=jarray1[0].deadline;
    
    var jarray2=<?php echo $jarray2?>;
    var studentId=<?php echo $sid?>;
    var handinTime=jarray2.handintime;
    var hwLink=jarray2.hw_Index;
    //作业内容
    function setHomeworkContent(){
        var content=document.getElementById("homeworkContent");
        var innerH5_1=document.createElement('h5');
        innerH5_1.innerHTML=hw_name+" : "+summary;
        content.appendChild(innerH5_1);

        var innerH5_2=document.createElement('h5');
        innerH5_2.innerHTML=studentId;
        content.appendChild(innerH5_2);

        var innerH5_3=document.createElement('h5');
        innerH5_3.innerHTML="DDL: "+deadline;
        content.appendChild(innerH5_3);

        var innerFont_1=document.createElement('font');
        innerFont_1.innerHTML="提交时间 "+handinTime;
        innerFont_1.setAttribute('color','red');
        content.appendChild(innerFont_1);

        var link=document.createElement('a');
        var hwHref=document.getElementById('homeworkHref');
        link.setAttribute('href',hwLink);
        link.innerHTML=studentId+"_作业";
        hwHref.appendChild(link);

        var showHomework=document.getElementById('showHomework');
        showHomework.setAttribute('href',hwLink);
    }
    setHomeworkContent();


    //预览PDF文件
    $(function() {
        $('.pdf').media({width:450, height:350});
    });
    $('#showHomework').click(function(){
        $(".pdf").show();
    });


</script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_teacher.html");

  if(isset($_POST["setScore"])||isset($_POST["commentArea"]))
        {
            $sql="update student_homework set grade=".$_POST["setScore"].",comment='".$_POST["commentArea"]."' where hw_id=".$hw_id." and sid=".$sid.";";
            print_r($sql);
            $result=@mysqli_query($dbc,$sql);
            if (!$result) 
                echo "fail";
        }

?>

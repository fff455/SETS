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

$course_id=50001;

$tid=$_COOKIE['user_id'];
$query = "select hw_id,hw_name,deadline,summary from homework where course_id=".$course_id." and tid=".$tid." order by deadline;";
$array = array();
$queryresult = @mysqli_query($dbc, $query);
if ($queryresult) {
    while($row = mysqli_fetch_array($queryresult, MYSQLI_ASSOC))
    {
        array_push($array,$row);
    }
} 
else {
    echo "no result";
}

if ($queryresult)
    mysqli_free_result($queryresult);

$handinArray=array();
$queryHandin="select B.hw_id,count(sid) from student_homework as A join homework as B on A.hw_id=B.hw_id group by B.hw_id;";
$Handinresult=@mysqli_query($dbc,$queryHandin);
if($Handinresult)
    while($row = mysqli_fetch_array($Handinresult, MYSQLI_ASSOC))
    {
        array_push($handinArray,$row);
    }
    else {
    echo "no result";
}

for($i=0;$i<count($array);$i++){

    $array[$i]["count"]=0;
    for($j=0;$j<count($handinArray);$j++)
    {
        if($array[$i]['hw_id']==$handinArray[$j]['hw_id'])
            $array[$i]['count']=$handinArray[$j]['count(sid)'];
    }
}

$jarray=json_encode($array);

$queryCount="select count(sid) from course where course_id=".$course_id.";";
$Countresult = @mysqli_query($dbc, $queryCount);
if ($Countresult)
    $row = mysqli_fetch_array($Countresult, MYSQLI_ASSOC);
$studentNum=$row['count(sid)'];

?>
<style type="text/css">
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
    .tr_odd
    {
        background-color: #EBF2FE;
    }
    .tr_even
    {
        background: #B4CDE6;
    }
    .input_control{
        width:360px;
        margin:20px auto;
    }
    input[type="text"],#btn1,#btn2{
        box-sizing: border-box;
        text-align:center;
        font-size:1.4em;
        height:2.7em;
        border-radius:4px;
        border:1px solid #c8cccf;
        color:#6a6f77;
        -web-kit-appearance:none;
        -moz-appearance: none;
        display:block;
        outline:0;
        padding:0 1em;
        text-decoration:none;
        width:50%;
    }
    input[type="text"]:focus{
        border:1px solid #ff7496;
    }
    input[type="date"],#btn1,#btn2{
        box-sizing: border-box;
        text-align:center;
        font-size:1.4em;
        height:2.7em;
        border-radius:4px;
        border:1px solid #c8cccf;
        color:#6a6f77;
        -web-kit-appearance:none;
        -moz-appearance: none;
        display:block;
        outline:0;
        padding:0 1em;
        text-decoration:none;
        width:20%;
    }
    input[type="date"]:focus{
        border:1px solid #ff7496;
    }
    .uploadButton{
        text-decoration:none;  
        background:#d2e4fc;  
           
        padding: 10px 30px 10px 30px;  
        font-size:16px;  
        font-family: 微软雅黑,宋体,Arial,Helvetica,Verdana,sans-serif;  
         font-weight:bold;  
        border-radius:3px; 
        margin-left: 5px;
        margin-bottom: 5px;
        margin-top: 12px;
    }
</style>

<div>


    <div class="work-list container container-white">
        <div class="container-gray">
            <h3>查看所有作业</h3>
        </div>
        <div class="row-fluid container-gray">
            <div class="span12">
                <table class="table table-hover" id="homeworkTable">
                    <thead>
                    <tr>
                        <th>
                            序号
                        </th>
                        <th>
                            作业名称
                        </th>
                        <th>
                            截止时间
                        </th>
                        <th>
                            上交人数
                        </th>
                        <th>
                            全部人数
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
            <div class="container-gray">
                <h3>发布作业</h3>
                  <button class=" uploadButton" id="uploadAppend" onclick="uploadAppend()">上传附件</button>
                <form method="post" action="" enctype="multipart/form-data">
                        <p>&nbsp;作业名称<br />
                            <input  type="text" name="hw_name"/><br />
                            &nbsp;作业要求<br />
                            <input  type="text" name="summary"/><br />
                            &nbsp;截止日期<br />
                            <input  type="date" name="deadline"/></p>
                            <input type="file" id="appendFile" name="appendFile" value="" style="display:none">
                           

                        <p><button class="home-issue" contenteditable="true" type="submit">提交</button></p>
                </form>
            </div>

    </div>

    <script type="text/javascript">
        var jarray=<?php echo $jarray?>;
        var hw_id=new Array();
        var hwName=new Array();
        var deadline=new Array();
        var summary;
        var handinNum=new Array();
        var studentNum=<?php echo $studentNum?>;

        for(var count in jarray)
        {
            hw_id.push(jarray[count].hw_id);
            hwName.push(jarray[count].hw_name);
            deadline.push(jarray[count].deadline);
            handinNum.push(jarray[count].count);
        }

        function setHwTable(){
            for(var count in hwName)
            {
                var tableContent=document.createElement('tbody');
                tableContent.setAttribute('class','homeworkTableBody');

                if(count%2==0)
                    tableContent.setAttribute('class','tr_even');
                else
                    tableContent.setAttribute('class','tr_odd');
                tableContent.setAttribute('id','homeworkTableBody'+count);
                homeworkTable=document.getElementById('homeworkTable');
                homeworkTable.appendChild(tableContent);

                var text='<tr><td>'+count+'</td><td><a id="viewHwCount'+count+'">'+hwName[count]+'</a></td><td><font color=red>'+deadline[count]+'</font></td><td><font color=red>'+handinNum[count]+'</font></td><td>'+studentNum;
                tableContent.innerHTML+=text;
            }
        }
        setHwTable();

       
        function setHwHref(){
            for(var count in hw_id)
            {
                var thisId='viewHwCount'+count;
                var thisHw=document.getElementById(thisId);

                var thisUrl="./homework_detail.php?hw_id="+hw_id[count];
                thisHw.setAttribute('href',thisUrl);
            }
        }
        setHwHref();

        function uploadAppend(){
            document.getElementById("appendFile").click(); 
        }
    </script>

</div>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_teacher.html");    
    
        
        if(isset($_POST["hw_name"])&&isset($_POST["summary"])&&isset($_POST["deadline"]))
        {
            require_once('../php/randID.php');
            $sql="INSERT INTO homework (hw_id,hw_name, summary,deadline,course_id,tid) VALUES ('$resultNum','$_POST[hw_name]','$_POST[summary]','$_POST[deadline]','50001','".$tid."');";
            $result=@mysqli_query($dbc,$sql);

            if(isset($_FILES["appendFile"]))
            {
                if ($_FILES["appendFile"]["error"] > 0)
                {
                    echo "err：" . $_FILES["appendFile"]["error"] . "<br>";
                }
                else{
                    $hw_dir="../homework/" . $_FILES["appendFile"]["name"];
                    move_uploaded_file($_FILES["appendFile"]["tmp_name"], $hw_dir);
                    $sql="UPDATE homework set hasAppend=1, appendIndex='".$hw_dir."' where hw_id='".$resultNum."' ;";
                    $result=@mysqli_query($dbc,$sql);
                }
            }



            mysqli_close($dbc); 
        }

?>

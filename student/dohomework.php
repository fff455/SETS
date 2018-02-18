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
require_once("../include/homework_student_header.html");
require_once('../php/mysqli_connect.php');
parse_str($_SERVER['QUERY_STRING']);

$sid=$_COOKIE['user_id'];
$sname=$_COOKIE['user_name'];

$query1="select hw_name,deadline,summary,hasAppend,appendIndex from homework where hw_id=".$hw_id.";";
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

$array2=array();
$doneflag=0;
$query2="select * from student_homework where hw_id=".$hw_id." and sid=".$sid.";";
$queryresult2=mysqli_query($dbc,$query2);
if($queryresult2){
	if(mysqli_num_rows($queryresult2) >0)
	{
		$doneflag=1;
		$row = mysqli_fetch_array($queryresult2, MYSQLI_ASSOC);
        array_push($array2,$row);
	}
}
else {
    echo "no result";
}
 $jarray2=json_encode($array2);

?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
 <div class="container-fluid">
	

	<div class="teacherViewHomework container container-white">
		<div class="container-gray">
			<h3>提交作业</h3>
			<div class="container-gray" id="homeworkContent">
			
			</div>

			<div class="container-gray" id="commentContent">
			</div>
		</div>

		<div class="container-gray" id="homeworkHref">
			
		</div>
		<div>
			<button class=" uploadButton" id="uploadHomework" onclick="uploadHomework()">上传作业</button>
		
		</div>
		
		<div class="container-white">
		<label>&nbsp;&nbsp;&nbsp;在线作答</label>
	<form method="post" action="">
		<textarea id="commentArea" name="commentArea" class="ckeditor" rows="10" cols="150"></textarea>   
        <script type="text/javascript"> CKEDITOR.replace('commentArea')</script>
        <button class="commitButton" id="commitHomework" type="submit">提交</button>
    </form>
    <form method="post" style="display: none" action="" enctype="multipart/form-data">
    	<input type="file" id="inputFile" name="inputFile" value="">
    </form>
        </div>
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
	.uploadButton{
   		text-decoration:none;  
    	background:#d2e4fc;  
   		   
    	padding: 10px 30px 10px 30px;  
    	font-size:16px;  
    	font-family: 微软雅黑,宋体,Arial,Helvetica,Verdana,sans-serif;  
   		 font-weight:bold;  
    	border-radius:3px; 
    	margin-left: 10px;
    	margin-bottom: 12px;
    	margin-top: 12px;
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
			var studentName="<?php echo $sname?>";
			var doneflag=<?php echo $doneflag?>;
			var hasAppend=jarray1[0].hasAppend;
			var appendIndex=jarray1[0].appendIndex;

			//作业内容
			function setHomeworkContent(){

				var content=document.getElementById("homeworkContent");
				var innerH5_1=document.createElement('h5');
				innerH5_1.innerHTML=hw_name+" : "+summary;
				content.appendChild(innerH5_1);

				var innerH5_2=document.createElement('h5');
				innerH5_2.innerHTML="欢迎 : "+studentName;
				content.appendChild(innerH5_2);

				var innerFont_1=document.createElement('font');
				innerFont_1.innerHTML="DDL: "+deadline;
				innerFont_1.setAttribute('color','red');
				content.appendChild(innerFont_1);

				var innerFont_2=document.createElement('font');
				innerFont_2.setAttribute('color','red');
				if(doneflag==0){
					innerFont_2.innerHTML="</br></br>请提交该次作业</br></br>";
				}
				else{
					innerFont_2.innerHTML="</br></br>您已完成该次作业!</br></br>";
				}
				content.appendChild(innerFont_2);

				if(hasAppend==1)
				{
					var appendHref=document.createElement('a');
					appendHref.setAttribute('download',"");
					appendHref.setAttribute('href',appendIndex);
					appendHref.innerHTML="下载附件";
					content.appendChild(appendHref);
				}

				if(doneflag==1)
				{
					var jarray2=<?php echo $jarray2?>;
					var grade=jarray2[0].grade;
					var comment=jarray2[0].comment;

					var commentContent=document.getElementById('commentContent');
					var innerFont_3=document.createElement('font');
					innerFont_3.innerHTML="得分:"+grade;
					innerFont_3.setAttribute('color','red');
					commentContent.appendChild(innerFont_3);

					var innerH5_3=document.createElement('h5');
					innerH5_3.innerHTML="</br>评论:"+comment;
					commentContent.appendChild(innerH5_3);
				}

			}
			setHomeworkContent();

			function uploadHomework(){
				document.getElementById("inputFile").click(); 
			}

		$('[name="inputFile"]').change(function(){
　　　　  if($(this).val()){
　　　　    $(this).parent().submit();
　　　　   }
		});
		</script>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_student.html");
require_once('../php/randID.php');

if(isset($_POST["commentArea"]))
{
	$content=$_POST['commentArea'];
	$txt_dir = "../homework/".$resultNum.".txt";
	$file = fopen($txt_dir,"a+"); 
	fwrite($file,$content); 
	fclose($file);

	$time=date('Y-m-d H:i:s');
	$sql="INSERT INTO student_homework (hw_id,sid,handintime, hw_Index) VALUES ('$hw_id','$sid','$time','$txt_dir');";
            $result=@mysqli_query($dbc,$sql);
         mysqli_close($dbc); 
}

if(isset($_FILES["inputFile"]))
{
	if ($_FILES["inputFile"]["error"] > 0)
	{
    	echo "err：" . $_FILES["inputFile"]["error"] . "<br>";
	}
	$hw_dir="../homework/" . $_FILES["inputFile"]["name"];
	move_uploaded_file($_FILES["inputFile"]["tmp_name"], $hw_dir);
	
	$time=date('Y-m-d H:i:s');
	$sql="INSERT INTO student_homework (hw_id,sid,handintime, hw_Index) VALUES ('$hw_id','$sid','$time','$hw_dir');";
            $result=@mysqli_query($dbc,$sql);
         mysqli_close($dbc); 
}

?>
<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2018/1/1
 * Time: 20:26
 */
require_once('../php/mysqli_connect.php');

array('request'=>$_REQUEST);
if(empty($_FILES["file"])){
    $output=['error'=>'No files were processed.'];
    echo json_encode($output);
    return;
}
if ($_FILES["file"]["error"] > 0)
{
    $success=false;
    $output = ["error"=> $_FILES["file"]["error"]];
}
else
{
    $name = $_FILES["file"]["name"];
    $size = $_FILES["file"]["size"];
    $course = $_REQUEST["course"];
    if($course == "软件需求工程")
        $path = "../material/file/re/" . $name;
    else
        $path = "../material/file/sem/" . $name;
    $query="SELECT valid FROM file WHERE path='$path'";
    $result = @mysqli_query($dbc, $query);
    if ($result) {
        $row = @mysqli_fetch_array($result, MYSQLI_NUM);
        if(count($row)>0){
            $query="UPDATE file SET name'$name', size=$size, upload_time=NOW(), valid=true";
            $result = @mysqli_query($dbc, $query);
            if($result AND move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
                $output = [];
                $success=true;
            }
            else {
                $success=false;
//                echo mysqli_error($dbc);
                $output = ['error'=>'Database insert error!'];
            }
        }
        else{
            $query="INSERT INTO file(name,size,path,upload_time,valid) VALUES ('$name',$size,'$path',NOW(),false)";
            $result = @mysqli_query($dbc, $query);
            if ($result) {
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
                    $output = [];
                    $query="UPDATE file SET valid=true WHERE name='$name'";
                    $result = @mysqli_query($dbc, $query);
                    $success=true;
                }
                else{
                    $success=false;
                    $output = ['error'=>'No files were processed.'];
                }
            } else {
                $success=false;
//                echo mysqli_error($dbc);
                $output = ['error'=>'Database insert error!'];
            }
        }
    }


}
echo json_encode($output);
//echo var_dump($_FILES);
//$output = ['error'=>'No files were processed.'];
//$output=[];
//// return a json encoded response for plugin to process successfully
//echo json_encode($output);
?>
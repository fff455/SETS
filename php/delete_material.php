<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2018/1/2
 * Time: 22:30
 */
require_once('../php/mysqli_connect.php');
$filename = $_GET['file'];
$cata = $_GET['cata'];
$path = "../material/file/$cata/$filename";

$query = "update file set valid=false where path='$path'";
$result = @mysqli_query($dbc, $query);
if($result){
    header('Location: '.'../teacher/material.php');
}

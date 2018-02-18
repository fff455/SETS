<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2018/1/2
 * Time: 22:23
 */
$filename = $_GET['file'];
$cata = $_GET['cata'];
$path = "../material/file/$cata/$filename";
$file = $path;

if(!file_exists($file)) die("抱歉，文件不存在！");

$type = filetype($file);
$today = date("F j, Y, g:i a");
$time = time();
header("Content-type: $type");
header("Content-Disposition: attachment;filename=$filename");
header("Content-Transfer-Encoding: binary");
header('Pragma: no-cache');
header('Expires: 0');
// 发送文件内容
set_time_limit(0);
readfile($file);
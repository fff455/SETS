<?php
function trimall($str)//删除空格
{
    $qian=array(" ","　","\t","\n","\r","\r\n","\\r\\n");$hou=array("","","","","","","");
    return str_replace($qian,$hou,$str);
}
?>
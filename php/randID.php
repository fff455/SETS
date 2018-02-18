<?php

$number=range(1,100);
shuffle($number);
$subnumber = array_slice($number,0,5);
$resultNum=0;
foreach ($subnumber as $num){
    $resultNum=$resultNum*100+$num;
}

?>
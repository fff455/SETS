<?php

DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '123456');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'SETS');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not to MySQL:'.mysqli_connect_error());

?>
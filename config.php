<?php
	define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","test2");

$connect = new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die ("cannot connect to database") ;
$connect->set_charset("utf8");

?>
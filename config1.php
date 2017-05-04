<?php

define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","1234");
define("DATABASE","test");

HOSTNAME;
$dbhandle = mysql_connect(HOSTNAME,USERNAME,PASSWORD) or die ("no connect");
mysql_select_db(DATABASE) or die ("cannot connect to database") ;


?>
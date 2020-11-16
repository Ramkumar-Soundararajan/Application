<?php
$hostname = 'new-sg-fumigation.cehmmc7pkgr1.us-east-2.rds.amazonaws.com:4491';
$hostlogin = 'furisgdm';
$hostpassword = '#j$Ej23!9Sec$mCddD!Bz';
$databasename = 'rentokil_eti';

//Folder Name Change Only Necessary
$appfoldername = 'ETI';

$link = mysql_connect($hostname, $hostlogin, $hostpassword) or die('Could not connect Table : ' . mysql_error());
mysql_select_db($databasename) or die('Could not select database'. mysql_error());
mysql_set_charset('UTF8');


//echo $_SERVER['REQUEST_URI'] ; //To get full url. 
$currentworkingdomain = $_SERVER['SERVER_NAME']; //To get only server name.
$currentworkingdomain = 'http://'.$currentworkingdomain;

$applocation1 = $currentworkingdomain.'/'.$appfoldername; //Used inside excel export options on reports module.
$databasename = $databasename; //Used inside autoitemsearch2.php / autoitemsearch2purchase.php

?>

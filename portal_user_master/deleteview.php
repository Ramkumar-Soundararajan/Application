<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../../PORTAL/index.php");
include ("../db/db_connect.php");
$menu_title='Delete Technician';
if (isset($_REQUEST["user_id"])) { $user_id = $_REQUEST["user_id"]; } else { $user_id = ""; }
if($user_id != ''){
	$query1 = "update eti_portal_user set deleted = '1' where id = '$user_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
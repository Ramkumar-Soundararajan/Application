<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
$menu_title='Delete Country';
if (isset($_REQUEST["competitor_id"])) { $competitor_id = $_REQUEST["competitor_id"]; } else { $competitor_id = ""; }
if($competitor_id != ''){
	$query1 = "update eti_competitor set deleted = '1' where id = '$competitor_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
$menu_title='Delete Business';
if (isset($_REQUEST["business_id"])) { $business_id = $_REQUEST["business_id"]; } else { $business_id = ""; }
if($business_id != ''){
	$query1 = "update eti_business set deleted = '1' where id = '$business_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
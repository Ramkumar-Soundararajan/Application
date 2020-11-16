<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
$menu_title='Delete Country';
if (isset($_REQUEST["surveyor_id"])) { $surveyor_id = $_REQUEST["surveyor_id"]; } else { $surveyor_id = ""; }
if($surveyor_id != ''){
	$query1 = "update eti_surveyor set deleted = '1' where id = '$surveyor_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
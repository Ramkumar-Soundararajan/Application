<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
$menu_title='Delete Country';
if (isset($_REQUEST["industry_id"])) { $industry_id = $_REQUEST["industry_id"]; } else { $industry_id = ""; }
if($industry_id != ''){
	$query1 = "update eti_industry set deleted = '1' where id = '$industry_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
$menu_title='Delete Pest';
if (isset($_REQUEST["pest_id"])) { $pest_id = $_REQUEST["pest_id"]; } else { $pest_id = ""; }
if($pest_id != ''){
	$query1 = "update eti_pest set deleted = '1' where id = '$pest_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
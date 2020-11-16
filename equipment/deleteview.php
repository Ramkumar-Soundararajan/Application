<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
$menu_title='Delete Equipment';
if (isset($_REQUEST["equipment_id"])) { $equipment_id = $_REQUEST["equipment_id"]; } else { $equipment_id = ""; }
if($equipment_id != ''){
	$query1 = "update eti_equipment set deleted = '1' where id = '$equipment_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
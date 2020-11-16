<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../../PORTAL/index.php");
include ("../db/db_connect.php");
$menu_title='Delete Branch';
if (isset($_REQUEST["branch_id"])) { $branch_id = $_REQUEST["branch_id"]; } else { $branch_id = ""; }
if($branch_id != ''){
	$query1 = "update eti_branch_master set deleted = '1' where id = '$branch_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	header ("location:listview.php");
}	
?>
<?php
include ("../db/db_connect.php");
	$query122 = "select MAX(cast(serial_no as UNSIGNED)) as serial_no from eti_serial_no";
	$exec122 = mysql_query($query122) or die ("Error in Query122".mysql_error());
	$res122 = mysql_fetch_array($exec122);
	$serial_no = $res122['serial_no'];
	$current_y = date("Y");
	$current_m = date("m");
	if ($serial_no == ''){
	   $serial_no = '0001';
	} else{
	  $serial_no = $serial_no + 1;
	}
	echo $serial_no = sprintf("%04d", $serial_no); echo '<br>';
	
	echo $serial_number = $current_y.$current_m.$serial_no;
?>
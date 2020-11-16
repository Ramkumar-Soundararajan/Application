<?php
include ("../db/db_connect.php");
if(isset($_POST['filetype_a'])) {
	$filetype_a = $_POST['filetype_a'];
	$query1 = "select attachment_a from eti_sra where id = '$filetype_a'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$attachment_a = $res1['attachment_a'];
	unlink($attachment_a);
	$query2 = "update eti_sra set attachment_a = '' where id = '$filetype_a'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	echo '1'; exit;
}
if(isset($_POST['filetype_b'])) {
	$filetype_b = $_POST['filetype_b'];
	$query3 = "select attachment_b from eti_sra where id = '$filetype_b'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$attachment_b = $res3['attachment_b'];
	unlink($attachment_b);
	$query4 = "update eti_sra set attachment_b = '' where id = '$filetype_b'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	echo '1'; exit;
}
if(isset($_POST['filetype_c'])) {
	$filetype_c = $_POST['filetype_c'];
	$query5 = "select attachment_c from eti_sra where id = '$filetype_c'";
	$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
	$res5 = mysql_fetch_array($exec5);
	$attachment_c = $res5['attachment_c'];
	unlink($attachment_c);
	$query6 = "update eti_sra set attachment_c = '' where id = '$filetype_c'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	echo '1'; exit;
}
if(isset($_POST['filetype_d'])) {
	$filetype_d = $_POST['filetype_d'];
	$query7 = "select attachment_d from eti_sra where id = '$filetype_d'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$attachment_d = $res7['attachment_d'];
	unlink($attachment_d);
	$query8 = "update eti_sra set attachment_d = '' where id = '$filetype_d'";
	$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
	echo '1'; exit;
}
if(isset($_POST['filetype_e'])) {
	$filetype_e = $_POST['filetype_e'];
	$query9 = "select attachment_e from eti_sra where id = '$filetype_e'";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	$res9 = mysql_fetch_array($exec9);
	$attachment_e = $res9['attachment_e'];
	unlink($attachment_e);
	$query10 = "update eti_sra set attachment_e = '' where id = '$filetype_e'";
	$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
	echo '1'; exit;
}
?>
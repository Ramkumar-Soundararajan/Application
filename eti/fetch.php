<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
if (isset($_SESSION['userloginid']));
   $session_id = $_SESSION['userloginid'];
   $query12 = "select * from eti_portal_user where id = '$session_id'";
   $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
   $res12 = mysql_fetch_array($exec12);
   $access_rights = $res12['access_rights'];
   $country_id = $res12['country'];
   $branch_id = $res12['branch'];
  
	$path = '/ETI/eti/downloads/eti_pdf/';
	if ($access_rights == 0){
		$query2 = "select a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.form_status IN (3,4)";
	} else if ($access_rights == 1) {						
		$query2 = "select a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.created_by = '$session_id' and a.form_status IN (3,4)";
	} else if ($access_rights == 2 || $access_rights == 3) {
		$query2 = "select  a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where (a.form_status = 1 OR a.form_status = 2 OR a.form_status = 3 OR a.form_status = 4 OR a.form_status = 5) and b.approve_desc = 'Sent To Admin Team' and a.form_status IN (3,4)";
	} else if ($access_rights == 6) {						
		$query2 = "select a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.form_status IN (3,4)";
	}
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	while ($res2 = mysql_fetch_array($exec2)) {
		$data[] = $res2;
	}
	
	echo json_encode($data);
?>
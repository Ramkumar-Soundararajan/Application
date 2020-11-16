<?php 
include ("../db/db_connect.php");
$eti_id = $_POST['id'];
if(isset($_POST['id'])) {
	$eti_id = $_POST['id'];
    $query111 = "select approve_a,approve_a_name,approve_a_date_time,approve_b,approve_b_name,approve_b_date_time,approve_contract_admin,approve_contract_admin_name,approve_contract_admin_date_time,approve_condition,approve_condition_date_time,approve_condition_email,approve_condition_name from eti_approve_details where sra_id = '$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	$approve_a = $res111['approve_a'];
	$approve_a_name = $res111['approve_a_name'];
	$approve_a_date_time = $res111['approve_a_date_time'];
	$approve_a_date_time = strtotime($approve_a_date_time);
	$approve_a_date_time = date("d/m/y g:i A", $approve_a_date_time);
	
	$approve_b = $res111['approve_b'];
	$approve_b_name = $res111['approve_b_name'];
	$approve_b_date_time = $res111['approve_b_date_time'];
	$approve_b_date_time = strtotime($approve_b_date_time);
	$approve_b_date_time = date("d/m/y g:i A", $approve_b_date_time);
	
	$approve_contract_admin = $res111['approve_contract_admin'];
	$approve_contract_admin_name = $res111['approve_contract_admin_name'];
	$approve_contract_admin_date_time = $res111['approve_contract_admin_date_time'];
	$approve_contract_admin_date_time = strtotime($approve_contract_admin_date_time);
	$approve_contract_admin_date_time = date("d/m/y g:i A", $approve_contract_admin_date_time);
	
	$approve_condition = $res111['approve_condition'];
	$approve_condition_name = $res111['approve_condition_name'];
	$approve_condition_date_time = $res111['approve_condition_date_time'];
	$approve_condition_date_time = strtotime($approve_condition_date_time);
	$approve_condition_date_time = date("d/m/y g:i A", $approve_condition_date_time);
	
	if ($approve_a == 1) {
		$approve_a = 'Approved';
	} else if ($approve_a == 2) {
		$approve_a = 'Rejected';
	} else if ($approve_a == 3) {
		$approve_a = 'Clarification';
	} 
	
	if ($approve_b == 1) {
		$approve_b = 'Approved';
	} else if ($approve_b == 2) {
		$approve_b = 'Rejected';
	} else if ($approve_b == 3) {
		$approve_b = 'Clarification';
	}

	if ($approve_condition == 1) {
		$approve_condition = 'Approved';
	} else if ($approve_condition == 2) {
		$approve_condition = 'Rejected';
	} else if ($approve_condition == 3) {
		$approve_condition = 'Clarification';
	}
	
	if ($approve_contract_admin_name == 5){
		$approve_admin = 'Rejected';
	}
	$query333 = "select approve_desc,approve_date_time,approve_email_id,approve_name from eti_sra_status where sra_id = '$eti_id'";
	$exec333 = mysql_query($query333) or die ("Error in Query333".mysql_error());
	$res333 = mysql_fetch_array($exec333);
	$current_approve_desc = $res333['approve_desc'];
	$current_approve_date_time = $res333['approve_date_time'];
	$current_approve_date_time = strtotime($current_approve_date_time);
	$current_approve_date_time = date("d/m/y g:i A", $current_approve_date_time);
	$current_approve_email_id = $res333['approve_email_id'];
	$current_approve_name = $res333['approve_name'];
}
$html = '<html>
		<head></head>
		<body>
			<b>Approve Details:</b><br>
		<table>';
    if ($approve_condition_name != '') { $html .= '<tr><td>'.$approve_condition.' - '.$approve_condition_name.' ('.$approve_condition_date_time.')</td></tr>'; }		
	if ($approve_a_name != '') { $html .= '<tr><td>'.$approve_a.' - '.$approve_a_name.' ('.$approve_a_date_time.')</td></tr>'; }
	if ($approve_b_name != '') { $html .= '<tr><td>'.$approve_b.' - '.$approve_b_name.' ('.$approve_b_date_time.')</td></tr>'; } 
	if ($approve_contract_admin_name != '') { $html .= '<tr><td>Rejected - '.$approve_contract_admin_name.' ('.$approve_contract_admin_date_time.')</td></tr>'; } 
    $html.='</table><b>Clarification Details:</b><br><table>';
    $query222 = "select clarify_a_name,clarify_a_date_time,clarify_a_desc from eti_clarify_details where sra_id = '$eti_id'";
	$exec222 = mysql_query($query222) or die ("Error in Query222".mysql_error());
	while ($res222 = mysql_fetch_array($exec222)) {
	$clarify_a_date_time = $res222['clarify_a_date_time'];
	$clarify_a_date_time = strtotime($clarify_a_date_time);
	$clarify_a_date_time = date("d/m/y g:i A", $clarify_a_date_time);
	$html.='<tr><td>'.$res222['clarify_a_name'].' at '.$clarify_a_date_time.' - '.$res222['clarify_a_desc'].'</td></tr>'; }
	$html.='</table><b>Current Status:</b><br><table>';
	if ($current_approve_desc != '') { $html .= '<tr><td>'.$current_approve_desc.'</td></tr>'; }
	$html.='</table>';
echo $html;
?>
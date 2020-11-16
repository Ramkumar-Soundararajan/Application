<?php
session_start();
include ("../db/db_connect.php");
include ("../PHPMailer/class.phpmailer.php");
include ("../PHPMailer/class.smtp.php");
include ("../mpdf/mpdf.php");
include ("quickstart.php");
$server_path =  dirname(__FILE__);

$language_id = $_SESSION['language_id'];
  
  if($language_id == "EN"){
	  include("../language/english.php");
  } else if ($language_id == "TH") {
	  include("../language/test.php");
  }
  

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $dir .= $parts[$i] . "/";
}
$base_url = 'http://'.$dir;

if (isset($_POST['submit'])){
	$eti_id = $_POST['eti_id'];
	
	$query111 = "DELETE FROM eti_clarify_details where sra_id = '$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	
	$query112 = "DELETE FROM eti_approve_details where sra_id = '$eti_id'";
	$exec112 = mysql_query($query112) or die ("Error in Query112".mysql_error());
	
	$query113 = "DELETE FROM eti_sra_status where sra_id = '$eti_id'";
	$exec113 = mysql_query($query113) or die ("Error in Query113".mysql_error());
	
	$serial_number = $_POST['serial_number'];
	$competitor = $_POST['competitor'];
	$surveyor = $_POST['surveyor'];
	$contract_no = $_POST['contract_no'];
	$industry = $_POST['industry'];
    $eti_date = $_POST['eti_date'];
	$eti_time = $_POST['eti_time'];
	$eti_duration = $_POST['eti_duration'];
	$job_type = $_POST['job_type'];
	$business_type = $_POST['business_type'];
	//$name = mysql_real_escape_string($_POST['name']);
	$name = $_POST['name'];
	$pdf_name = $name;
	$name = mysql_real_escape_string($name);
	$existing_account = mysql_real_escape_string($_POST['existing_account']);
	$decision_maker = mysql_real_escape_string($_POST['decision_maker']);
	$whom_see = mysql_real_escape_string($_POST['whom_see']);
	$address_a = mysql_real_escape_string($_POST['address_a']);
	$address_b = mysql_real_escape_string($_POST['address_b']);
	$postcode_a = $_POST['postcode_a'];
	$tel_a = $_POST['tel_a'];
	$premises_address_a = mysql_real_escape_string($_POST['premises_address_a']);
	$premises_address_b = mysql_real_escape_string($_POST['premises_address_b']);
	$postcode_b = $_POST['postcode_b'];
	$tel_b = $_POST['tel_b'];
	$email = mysql_real_escape_string($_POST['email']);
	$billing_email = mysql_real_escape_string($_POST['billing_email']);
	$useremail = $_POST['useremail'];
	$infestation = $_POST['infestation'];
	$business_origin = $_POST['business_origin'];
	$referral_name = mysql_real_escape_string($_POST['referral_name']);
	$domestic = $_POST['domestic'];
	$industrial = $_POST['industrial'];
	$commercial = $_POST['commercial'];
	$site_plan_others = mysql_real_escape_string($_POST['site_plan_others']);
	$location = mysql_real_escape_string($_POST['location']);
	$lm = $_POST['lm'];
	$meter = $_POST['meter'];
	$surveyor_name = $_POST['surveyor_name'];
	$litre = $_POST['litre'];
	$chemical = $_POST['chemical'];
	$chemical_other_desc = mysql_real_escape_string($_POST['chemical_other_desc']);
	$sra = $_POST['sra'];
	$surveyor_code = $_POST['surveyor_code'];
	$industry_code = $_POST['industry_code'];
	$business_code = $_POST['business_code'];
	$business_origin_code = $_POST['business_origin_code'];
	$duration = $_POST['duration'];
	$job_duration = $_POST['job_duration'];
	$prospect_no = $_POST['prospect_no'];
	$page_source = $_POST['page_source'];
	
	//$amend = $_POST['amend'];
	
	if ($job_type == 'Product Sales' || $surveyor == 28 || $surveyor == 35){
		$amend = 'Yes';
	} else if ($job_type == 'Job'){
		$amend = '';
	} else if ($job_type == 'Contract'){
		$amend = $_POST['amend'];
	}
	
	if ($amend == 'Yes') {
		$form_status = 5;
	} else {
		$form_status = 1;
	}
	
	$pest_a = $_POST['pest_a'];
	$pest_b = $_POST['pest_b'];
	$pest_c = $_POST['pest_c'];
	$pest_d = $_POST['pest_d'];
	$pest_e = $_POST['pest_e'];
	$pest_f = $_POST['pest_f'];
	$pest_g = $_POST['pest_g'];
	$pest_h = $_POST['pest_h'];
	$pest_qty_a = $_POST['pest_qty_a'];
	$pest_qty_b = $_POST['pest_qty_b'];
	$pest_qty_c = $_POST['pest_qty_c'];
	$pest_qty_d = $_POST['pest_qty_d'];
	$pest_qty_e = $_POST['pest_qty_e'];
	$pest_qty_f = $_POST['pest_qty_f'];
	$pest_qty_g = $_POST['pest_qty_g'];
	$pest_qty_h = $_POST['pest_qty_h'];
	$condition1 = $_POST['condition1'];
	$condition2 = $_POST['condition2'];
	$condition3 = $_POST['condition3'];
	$condition4 = $_POST['condition4'];
	$condition5 = $_POST['condition5'];
	$condition6 = $_POST['condition6'];
	$condition7 = $_POST['condition7'];
	$condition8 = $_POST['condition8'];
	$condition_ref1 = $_POST['condition_ref1'];
	$condition_ref2 = $_POST['condition_ref2'];
	$condition_ref3 = $_POST['condition_ref3'];
	$condition_ref4 = $_POST['condition_ref4'];
	$condition_ref5 = $_POST['condition_ref5'];
	$condition_ref6 = $_POST['condition_ref6'];
	$condition_ref7 = $_POST['condition_ref7'];
	$condition_ref8 = $_POST['condition_ref8'];
	$instruction_a = mysql_real_escape_string($_POST['instruction_a']);
	$instruction_b = mysql_real_escape_string($_POST['instruction_b']);
	$instruction_c = mysql_real_escape_string($_POST['instruction_c']);
	$instruction_d = mysql_real_escape_string($_POST['instruction_d']);
	$instruction_e = mysql_real_escape_string($_POST['instruction_e']);
	$instruction_f = mysql_real_escape_string($_POST['instruction_f']);
	$instruction_g = mysql_real_escape_string($_POST['instruction_g']);
	$instruction_h = mysql_real_escape_string($_POST['instruction_h']);
	$preparation_a = $_POST['preparation_a'];
	$preparation_b = $_POST['preparation_b'];
	$preparation_c = $_POST['preparation_c'];
	$preparation_d = $_POST['preparation_d'];
	$preparation_e = $_POST['preparation_e'];
	$preparation_f = $_POST['preparation_f'];
	$preparation_g = $_POST['preparation_g'];
	$preparation_h = $_POST['preparation_h'];
	$unit_cost_a = $_POST['unit_cost_a'];
	$unit_cost_b = $_POST['unit_cost_b'];
	$unit_cost_c = $_POST['unit_cost_c'];
	$unit_cost_d = $_POST['unit_cost_d'];
	$unit_cost_e = $_POST['unit_cost_e'];
	$unit_cost_f = $_POST['unit_cost_f'];
	$unit_cost_g = $_POST['unit_cost_g'];
	$unit_cost_h = $_POST['unit_cost_h'];
	$qty_a = $_POST['qty_a'];
	$qty_b = $_POST['qty_b'];
	$qty_c = $_POST['qty_c'];
	$qty_d = $_POST['qty_d'];
	$qty_e = $_POST['qty_e'];
	$qty_f = $_POST['qty_f'];
	$qty_g = $_POST['qty_g'];
	$qty_h = $_POST['qty_h'];
	$tot_val_unit_a = $_POST['tot_val_unit_a'];
	$tot_val_unit_b = $_POST['tot_val_unit_b'];
	$tot_val_unit_c = $_POST['tot_val_unit_c'];
	$tot_val_unit_d = $_POST['tot_val_unit_d'];
	$tot_val_unit_e = $_POST['tot_val_unit_e'];
	$tot_val_unit_f = $_POST['tot_val_unit_f'];
	$tot_val_unit_g = $_POST['tot_val_unit_g'];
	$tot_val_unit_h = $_POST['tot_val_unit_h'];
	$unit_per_tmt_a = $_POST['unit_per_tmt_a'];
	$unit_per_tmt_b = $_POST['unit_per_tmt_b'];
	$unit_per_tmt_c = $_POST['unit_per_tmt_c'];
	$unit_per_tmt_d = $_POST['unit_per_tmt_d'];
	$unit_per_tmt_e = $_POST['unit_per_tmt_e'];
	$unit_per_tmt_f = $_POST['unit_per_tmt_f'];
	$unit_per_tmt_g = $_POST['unit_per_tmt_g'];
	$unit_per_tmt_h = $_POST['unit_per_tmt_h'];
	$tmt_per_annum_a = $_POST['tmt_per_annum_a'];
	$tmt_per_annum_b = $_POST['tmt_per_annum_b'];
	$tmt_per_annum_c = $_POST['tmt_per_annum_c'];
	$tmt_per_annum_d = $_POST['tmt_per_annum_d'];
	$tmt_per_annum_e = $_POST['tmt_per_annum_e'];
	$tmt_per_annum_f = $_POST['tmt_per_annum_f'];
	$tmt_per_annum_g = $_POST['tmt_per_annum_g'];
	$tmt_per_annum_h = $_POST['tmt_per_annum_h'];
	$val_per_annum_a = $_POST['val_per_annum_a'];
	$val_per_annum_b = $_POST['val_per_annum_b'];
	$val_per_annum_c = $_POST['val_per_annum_c'];
	$val_per_annum_d = $_POST['val_per_annum_d'];
	$val_per_annum_e = $_POST['val_per_annum_e'];
	$val_per_annum_f = $_POST['val_per_annum_f'];
	$val_per_annum_g = $_POST['val_per_annum_g'];
	$val_per_annum_h = $_POST['val_per_annum_h'];
	$pest_count_a = $_POST['pest_count_a'];
	$pest_count_b = $_POST['pest_count_b'];
	$pest_count_c = $_POST['pest_count_c'];
	$pest_count_d = $_POST['pest_count_d'];
	$pest_count_e = $_POST['pest_count_e'];
	$pest_count_f = $_POST['pest_count_f'];
	$pest_count_g = $_POST['pest_count_g'];
	$pest_count_h = $_POST['pest_count_h'];
	$shift_type_a = $_POST['shift_type_a'];
	$shift_type_b = $_POST['shift_type_b'];
	$shift_type_c = $_POST['shift_type_c'];
	$shift_type_d = $_POST['shift_type_d'];
	$per_hour_a = $_POST['per_hour_a'];
	$per_hour_b = $_POST['per_hour_b'];
	$per_hour_c = $_POST['per_hour_c'];
	$per_hour_d = $_POST['per_hour_d'];
	$no_hours_a = $_POST['no_hours_a'];
	$no_hours_b = $_POST['no_hours_b'];
	$no_hours_c = $_POST['no_hours_c'];
	$no_hours_d = $_POST['no_hours_d'];
	$total_hours_a = $_POST['total_hours_a'];
	$total_hours_b = $_POST['total_hours_b'];
	$total_hours_c = $_POST['total_hours_c'];
	$total_hours_d = $_POST['total_hours_d'];
	$tmt_hours_a = $_POST['tmt_hours_a'];
	$tmt_hours_b = $_POST['tmt_hours_b'];
	$tmt_hours_c = $_POST['tmt_hours_c'];
	$tmt_hours_d = $_POST['tmt_hours_d'];
	$tmt_annum_a = $_POST['tmt_annum_a'];
	$tmt_annum_b = $_POST['tmt_annum_b'];
	$tmt_annum_c = $_POST['tmt_annum_c'];
	$tmt_annum_d = $_POST['tmt_annum_d'];
	$labour_value_a = $_POST['labour_value_a'];
	$labour_value_b = $_POST['labour_value_b'];
	$labour_value_c = $_POST['labour_value_c'];
	$labour_value_d = $_POST['labour_value_d'];
	$labour_count_a = $_POST['labour_count_a'];
	$labour_count_b = $_POST['labour_count_b'];
	$labour_count_c = $_POST['labour_count_c'];
	$labour_count_d = $_POST['labour_count_d'];
	$type_a = mysql_real_escape_string($_POST['type_a']);
	$type_b = mysql_real_escape_string($_POST['type_b']);
	$other_unit_cost_a = $_POST['other_unit_cost_a'];
	$other_unit_cost_b = $_POST['other_unit_cost_b'];
	$other_item_a = $_POST['other_item_a'];
	$other_item_b = $_POST['other_item_b'];
	$other_tot_val_a = $_POST['other_tot_val_a'];
	$other_tot_val_b = $_POST['other_tot_val_b'];
	$other_tot_item_a = $_POST['other_tot_item_a'];
	$other_tot_item_b = $_POST['other_tot_item_b'];
	$other_tmt_annum_a = $_POST['other_tmt_annum_a'];
	$other_tmt_annum_b = $_POST['other_tmt_annum_b'];
	$other_tot_annum_a = $_POST['other_tot_annum_a'];
	$other_tot_annum_b = $_POST['other_tot_annum_b'];
	$other_count_a = $_POST['other_count_a'];
	$other_count_b = $_POST['other_count_b'];
	$created_by = $_POST['created_by'];
	$modify_by = $_POST['created_by'];
	$date_modify = date("Y-m-d");
	
	$query388 = "select employee_name,user_mail from eti_portal_user where id='$created_by'";
	$exec388 = mysql_query($query388) or die ("Error in Query388".mysql_error());
	$res388 = mysql_fetch_array($exec388);
	$employee_name = $res388['employee_name'];
	$employee_email = $res388['user_mail'];
	
	$total_unit = $_POST['total_unit'];
	$total_unit_annum = $_POST['total_unit_annum'];
	$total_labour = $_POST['total_labour'];
	$total_labour_annum = $_POST['total_labour_annum'];
	$other_total_a = $_POST['other_total_a'];
	$other_total_b = $_POST['other_total_b'];
	$treatment_a = $_POST['treatment_a'];
	$treatment_b = $_POST['treatment_b'];
	$total_annual_cost = $_POST['total_annual_cost'];
	$price_accept = $_POST['price_accept'];
	$price_accept_tax = $_POST['price_accept_tax'];
	$finance_note = mysql_real_escape_string($_POST['finance_note']);
	$service_note = mysql_real_escape_string($_POST['service_note']);
	$billing_frequency = $_POST['billing_frequency'];
	$credit_term = $_POST['credit_term'];
	$invoice_type = $_POST['invoice_type'];
	$invoice_attachment = $_POST['invoice_attachment'];
	$po_number = $_POST['po_number'];
	
	$total_unit_cost = $_POST['total_unit_cost'];
	$total_unit_cost_annum = $_POST['total_unit_cost_annum'];
	$fix_cost_total_labour = $_POST['fix_cost_total_labour'];
	$wfix_cost_total_labour = $_POST['wfix_cost_total_labour'];
	$fix_cost_total_labour_annum = $_POST['fix_cost_total_labour_annum'];
	$wfix_cost_total_labour_annum = $_POST['wfix_cost_total_labour_annum'];
	$total_percentage = $_POST['total_percentage'];
	$fix_percentage = $_POST['fix_percentage'];
	$wfix_percentage = $_POST['wfix_percentage'];
	
	$unit_selling_a = $_POST['unit_selling_a'];
	$unit_selling_b = $_POST['unit_selling_b'];
	$unit_selling_c = $_POST['unit_selling_c'];
	$unit_selling_d = $_POST['unit_selling_d'];
	$unit_selling_e = $_POST['unit_selling_e'];
	$unit_selling_f = $_POST['unit_selling_f'];
	$unit_selling_g = $_POST['unit_selling_g'];
	$unit_selling_h = $_POST['unit_selling_h'];
	
	$tot_val_cost_a = $_POST['tot_val_cost_a'];
	$tot_val_cost_b = $_POST['tot_val_cost_b'];
	$tot_val_cost_c = $_POST['tot_val_cost_c'];
	$tot_val_cost_d = $_POST['tot_val_cost_d'];
	$tot_val_cost_e = $_POST['tot_val_cost_e'];
	$tot_val_cost_f = $_POST['tot_val_cost_f'];
	$tot_val_cost_g = $_POST['tot_val_cost_g'];
	$tot_val_cost_h = $_POST['tot_val_cost_h'];
	
	$val_per_annum_cost_a = $_POST['val_per_annum_cost_a'];
	$val_per_annum_cost_b = $_POST['val_per_annum_cost_b'];
	$val_per_annum_cost_c = $_POST['val_per_annum_cost_c'];
	$val_per_annum_cost_d = $_POST['val_per_annum_cost_d'];
	$val_per_annum_cost_e = $_POST['val_per_annum_cost_e'];
	$val_per_annum_cost_f = $_POST['val_per_annum_cost_f'];
	$val_per_annum_cost_g = $_POST['val_per_annum_cost_g'];
	$val_per_annum_cost_h = $_POST['val_per_annum_cost_h'];
	
	$fix_cost_per_hour_a = $_POST['fix_cost_per_hour_a'];
	$fix_cost_per_hour_b = $_POST['fix_cost_per_hour_b'];
	$fix_cost_per_hour_c = $_POST['fix_cost_per_hour_c'];
	$fix_cost_per_hour_d = $_POST['fix_cost_per_hour_d'];
	
	$wfix_cost_per_hour_a = $_POST['wfix_cost_per_hour_a'];
	$wfix_cost_per_hour_b = $_POST['wfix_cost_per_hour_b'];
	$wfix_cost_per_hour_c = $_POST['wfix_cost_per_hour_c'];
	$wfix_cost_per_hour_d = $_POST['wfix_cost_per_hour_d'];
	
	$fix_cost_total_hours_a = $_POST['fix_cost_total_hours_a'];
	$fix_cost_total_hours_b = $_POST['fix_cost_total_hours_b'];
	$fix_cost_total_hours_c = $_POST['fix_cost_total_hours_c'];
	$fix_cost_total_hours_d = $_POST['fix_cost_total_hours_d'];
	
	$wfix_cost_total_hours_a = $_POST['wfix_cost_total_hours_a'];
	$wfix_cost_total_hours_b = $_POST['wfix_cost_total_hours_b'];
	$wfix_cost_total_hours_c = $_POST['wfix_cost_total_hours_c'];
	$wfix_cost_total_hours_d = $_POST['wfix_cost_total_hours_d'];
	
	$fix_cost_labour_value_a = $_POST['fix_cost_labour_value_a'];
	$fix_cost_labour_value_b = $_POST['fix_cost_labour_value_b'];
	$fix_cost_labour_value_c = $_POST['fix_cost_labour_value_c'];
	$fix_cost_labour_value_d = $_POST['fix_cost_labour_value_d'];
	
	$wfix_cost_labour_value_a = $_POST['wfix_cost_labour_value_a'];
	$wfix_cost_labour_value_b = $_POST['wfix_cost_labour_value_b'];
	$wfix_cost_labour_value_c = $_POST['wfix_cost_labour_value_c'];
	$wfix_cost_labour_value_d = $_POST['wfix_cost_labour_value_d'];
	
	$visit_annum_a = $_POST['visit_annum_a'];
	$visit_annum_b = $_POST['visit_annum_b'];
	$visit_annum_c = $_POST['visit_annum_c'];
	$visit_annum_d = $_POST['visit_annum_d'];
	$visit_annum_e = $_POST['visit_annum_e'];
	$visit_annum_f = $_POST['visit_annum_f'];
	$visit_annum_g = $_POST['visit_annum_g'];
	$visit_annum_h = $_POST['visit_annum_h'];
	
	$add_freq_a = $_POST['add_freq_a'];
	$add_freq_b = $_POST['add_freq_b'];
	$add_freq_c = $_POST['add_freq_c'];
	$add_freq_d = $_POST['add_freq_d'];
	$add_freq_e = $_POST['add_freq_e'];
	$add_freq_f = $_POST['add_freq_f'];
	$add_freq_g = $_POST['add_freq_g'];
	$add_freq_h = $_POST['add_freq_h'];
	
	$annual_value_a = $_POST['annual_value_a'];
	$annual_value_b = $_POST['annual_value_b'];
	$annual_value_c = $_POST['annual_value_c'];
	$annual_value_d = $_POST['annual_value_d'];
	$annual_value_e = $_POST['annual_value_e'];
	$annual_value_f = $_POST['annual_value_f'];
	$annual_value_g = $_POST['annual_value_g'];
	$annual_value_h = $_POST['annual_value_h'];
	
	$product_count_a = $_POST['product_count_a'];
	$product_count_b = $_POST['product_count_b'];
	$product_count_c = $_POST['product_count_c'];
	$product_count_d = $_POST['product_count_d'];
	$product_count_e = $_POST['product_count_e'];
	$product_count_f = $_POST['product_count_f'];
	$product_count_g = $_POST['product_count_g'];
	$product_count_h = $_POST['product_count_h'];
	
	$attachment_a_filename=basename( $_FILES['attachment_a']['name']);
	$attachment_b_filename=basename( $_FILES['attachment_b']['name']);
	$attachment_c_filename=basename( $_FILES['attachment_c']['name']);
	$attachment_d_filename=basename( $_FILES['attachment_d']['name']);
	$attachment_e_filename=basename( $_FILES['attachment_e']['name']);
	
	if($attachment_a_filename != ''){
		$query33 = "select attachment_a from eti_sra where id='$eti_id'";
		$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
		$res33 = mysql_fetch_array($exec33);
		$filepath_a = $res33['attachment_a'];
		unlink($filepath_a);
		$attachment_a_target = "attachments_a/";
		$attachment_a_target = $attachment_a_target.rand(1000,10000)."-".basename($_FILES['attachment_a']['name']);
		move_uploaded_file($_FILES['attachment_a']['tmp_name'], $attachment_a_target);
	} else {
		$query33 = "select attachment_a from eti_sra where id='$eti_id'";
		$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
		$res33 = mysql_fetch_array($exec33);
		$attachment_a_target = $res33['attachment_a'];
	}
	$attachment_a_target = mysql_real_escape_string($attachment_a_target);
	
	if($attachment_b_filename != ''){
		$query34 = "select attachment_b from eti_sra where id='$eti_id'";
		$exec34 = mysql_query($query34) or die ("Error in Query34".mysql_error());
		$res34 = mysql_fetch_array($exec34);
		$filepath_b = $res34['attachment_b'];
		unlink($filepath_b);
		$attachment_b_target = "attachments_b/";
		$attachment_b_target = $attachment_b_target.rand(1000,10000)."-".basename($_FILES['attachment_b']['name']);
		move_uploaded_file($_FILES['attachment_b']['tmp_name'], $attachment_b_target);
	} else {
		$query34 = "select attachment_b from eti_sra where id='$eti_id'";
		$exec34 = mysql_query($query34) or die ("Error in Query34".mysql_error());
		$res34 = mysql_fetch_array($exec34);
		$attachment_b_target = $res34['attachment_b'];
	}
	$attachment_b_target = mysql_real_escape_string($attachment_b_target);
	
	if($attachment_c_filename != ''){
		$query35 = "select attachment_c from eti_sra where id='$eti_id'";
		$exec35 = mysql_query($query35) or die ("Error in Query35".mysql_error());
		$res35 = mysql_fetch_array($exec35);
		$filepath_c = $res35['attachment_c'];
		unlink($filepath_c);
		$attachment_c_target = "attachments_c/";
		$attachment_c_target = $attachment_c_target.rand(1000,10000)."-".basename($_FILES['attachment_c']['name']);
		move_uploaded_file($_FILES['attachment_c']['tmp_name'], $attachment_c_target);
	} else {
		$query35 = "select attachment_c from eti_sra where id='$eti_id'";
		$exec35 = mysql_query($query35) or die ("Error in Query35".mysql_error());
		$res35 = mysql_fetch_array($exec35);
		$attachment_c_target = $res35['attachment_c'];
	}
	$attachment_c_target = mysql_real_escape_string($attachment_c_target);
	
	if($attachment_d_filename != ''){
		$query36 = "select attachment_d from eti_sra where id='$eti_id'";
		$exec36 = mysql_query($query36) or die ("Error in Query36".mysql_error());
		$res36 = mysql_fetch_array($exec36);
		$filepath_d = $res36['attachment_d'];
		unlink($filepath_d);
		$attachment_d_target = "attachments_d/";
		$attachment_d_target = $attachment_d_target.rand(1000,10000)."-".basename($_FILES['attachment_d']['name']);
		move_uploaded_file($_FILES['attachment_d']['tmp_name'], $attachment_d_target);
	} else {
		$query36 = "select attachment_d from eti_sra where id='$eti_id'";
		$exec36 = mysql_query($query36) or die ("Error in Query36".mysql_error());
		$res36 = mysql_fetch_array($exec36);
		$attachment_d_target = $res36['attachment_d'];
	}
	$attachment_d_target = mysql_real_escape_string($attachment_d_target);
	
	if($attachment_e_filename != ''){
		$query37 = "select attachment_e from eti_sra where id='$eti_id'";
		$exec37 = mysql_query($query37) or die ("Error in Query37".mysql_error());
		$res37 = mysql_fetch_array($exec37);
		$filepath_e = $res37['attachment_e'];
		unlink($filepath_e);
		$attachment_e_target = "attachments_e/";
		$attachment_e_target = $attachment_e_target.rand(1000,10000)."-".basename($_FILES['attachment_e']['name']);
		move_uploaded_file($_FILES['attachment_e']['tmp_name'], $attachment_e_target);
	} else {
		$query37 = "select attachment_e from eti_sra where id='$eti_id'";
		$exec37 = mysql_query($query37) or die ("Error in Query37".mysql_error());
		$res37 = mysql_fetch_array($exec37);
		$attachment_e_target = $res37['attachment_e'];
	}
	$attachment_e_target = mysql_real_escape_string($attachment_e_target);
	
	$query1 = "update eti_sra set serial_number = '$serial_number', competitor_id = '$competitor',surveyor_id = '$surveyor',contract_no = '$contract_no',industry_id = '$industry',eti_date = '$eti_date',eti_time = '$eti_time',eti_duration = '$eti_duration', job_type = '$job_type',business_type = '$business_type',name = '$name',existing_account = '$existing_account',decision_maker = '$decision_maker',whom_see = '$whom_see',address_a = '$address_a',address_b = '$address_b',postcode_a = '$postcode_a',tel_a = '$tel_a',premises_address_a = '$premises_address_a',premises_address_b = '$premises_address_b',postcode_b = '$postcode_b',tel_b = '$tel_b',email = '$email',billing_email = '$billing_email',useremail = '$useremail',infestation = '$infestation',business_origin = '$business_origin',referral_name = '$referral_name',modify_by = '$modify_by',form_status='$form_status',attachment_a='$attachment_a_target',attachment_b='$attachment_b_target',attachment_c='$attachment_c_target',attachment_d='$attachment_d_target',attachment_e='$attachment_e_target',sra='$sra',surveyor_code='$surveyor_code',business_code='$business_code',business_origin_code='$business_origin_code',industry_code='$industry_code',duration='$duration',job_duration='$job_duration',prospect_no='$prospect_no',amend='$amend',date_modify = '$date_modify',page_source='$page_source' where id = '$eti_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	
	$query2 = "update eti_site_plan set sra_id = '$eti_id',domestic = '$domestic', industrial = '$industrial',commercial = '$commercial',site_plan_others = '$site_plan_others',location = '$location',lm = '$lm',meter = '$meter',surveyor_name = '$surveyor_name',litre = '$litre',chemical = '$chemical',chemical_other_desc = '$chemical_other_desc' where sra_id = '$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	if($pest_a != ''){
		 $query40 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_a'";
		 $exec40 = mysql_query($query40) or die ("Error in Query40".mysql_error());
		 $res40 = mysql_fetch_array($exec40);
		 $check_product_id_a = $res40['id'];
		 if ($check_product_id_a != ''){
		$query41 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_a',qty='$pest_qty_a',instruction = '$instruction_a',visit_annum = '$visit_annum_a',add_freq = '$add_freq_a',
			       annual_value = '$annual_value_a',pest_condition = '$condition1',condition_ref = '$condition_ref1',product_count = '$product_count_a' where sra_id = '$eti_id' and product_count = '$product_count_a'";
		$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
		 } else {
			 $query42 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_a','$pest_qty_a','$instruction_a','$visit_annum_a','$add_freq_a','$annual_value_a','$condition1','$condition_ref1','$product_count_a')";
			 $exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
		 }
	}
	
	if($pest_b != ''){
		 $query43 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_b'";
		 $exec43 = mysql_query($query43) or die ("Error in Query43".mysql_error());
		 $res43 = mysql_fetch_array($exec43);
		 $check_product_id_b = $res43['id'];
		 if ($check_product_id_b != ''){
		$query44 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_b',qty='$pest_qty_b', instruction = '$instruction_b',visit_annum = '$visit_annum_b',add_freq = '$add_freq_b',
			       annual_value = '$annual_value_b',pest_condition = '$condition2',condition_ref = '$condition_ref2',product_count = '$product_count_b' where sra_id = '$eti_id' and product_count = '$product_count_b'";
		$exec44 = mysql_query($query44) or die ("Error in Query44".mysql_error());
		 } else {
			 $query45 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_b','$pest_qty_b','$instruction_b','$visit_annum_b','$add_freq_b','$annual_value_b','$condition2','$condition_ref2','$product_count_b')";
			 $exec45 = mysql_query($query45) or die ("Error in Query45".mysql_error());
		 }
	}
	
	if($pest_c != ''){
		 $query46 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_c'";
		 $exec46 = mysql_query($query46) or die ("Error in Query46".mysql_error());
		 $res46 = mysql_fetch_array($exec46);
		 $check_product_id_c = $res46['id'];
		 if ($check_product_id_c != ''){
		$query47 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_c',qty='$pest_qty_c',instruction = '$instruction_c',visit_annum = '$visit_annum_c',add_freq = '$add_freq_c',
			       annual_value = '$annual_value_c',pest_condition = '$condition3',condition_ref = '$condition_ref3',product_count = '$product_count_c' where sra_id = '$eti_id' and product_count = '$product_count_c'";
		$exec47 = mysql_query($query47) or die ("Error in Query47".mysql_error());
		 } else {
			 $query48 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_c','$pest_qty_c','$instruction_c','$visit_annum_c','$add_freq_c','$annual_value_c','$condition3','$condition_ref3','$product_count_c')";
			 $exec48 = mysql_query($query48) or die ("Error in Query48".mysql_error());
		 }
	}
	
	if($pest_d != ''){
		 $query49 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_d'";
		 $exec49 = mysql_query($query49) or die ("Error in Query49".mysql_error());
		 $res49 = mysql_fetch_array($exec49);
		 $check_product_id_d = $res49['id'];
		 if ($check_product_id_d != ''){
		$query50 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_d',qty='$pest_qty_d', instruction = '$instruction_d',visit_annum = '$visit_annum_d',add_freq = '$add_freq_d',
			       annual_value = '$annual_value_d',pest_condition = '$condition4',condition_ref = '$condition_ref4',product_count = '$product_count_d' where sra_id = '$eti_id' and product_count = '$product_count_d'";
		$exec50 = mysql_query($query50) or die ("Error in Query50".mysql_error());
		 } else {
			 $query51 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_d','$pest_qty_d','$instruction_d','$visit_annum_d','$add_freq_d','$annual_value_d','$condition4','$condition_ref4','$product_count_d')";
			 $exec51 = mysql_query($query51) or die ("Error in Query51".mysql_error());
		 }
	}
	
	if($pest_e != ''){
		 $query52 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_e'";
		 $exec52 = mysql_query($query52) or die ("Error in Query52".mysql_error());
		 $res52 = mysql_fetch_array($exec52);
		 $check_product_id_e = $res52['id'];
		 if ($check_product_id_e != ''){
		$query53 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_e',qty='$pest_qty_e', instruction = '$instruction_e',visit_annum = '$visit_annum_e',add_freq = '$add_freq_e',
			       annual_value = '$annual_value_e',pest_condition = '$condition5',condition_ref = '$condition_ref5',product_count = '$product_count_e' where sra_id = '$eti_id' and product_count = '$product_count_e'";
		$exec53 = mysql_query($query53) or die ("Error in Query53".mysql_error());
		 } else {
			 $query54 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_e','$pest_qty_e','$instruction_e','$visit_annum_e','$add_freq_e','$annual_value_e','$condition5','$condition_ref5','$product_count_e')";
			 $exec54 = mysql_query($query54) or die ("Error in Query54".mysql_error());
		 }
	}
	
	if($pest_f != ''){
		 $query55 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_f'";
		 $exec55 = mysql_query($query55) or die ("Error in Query55".mysql_error());
		 $res55 = mysql_fetch_array($exec55);
		 $check_product_id_f = $res55['id'];
		 if ($check_product_id_f != ''){
		$query56 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_f',qty='$pest_qty_f', instruction = '$instruction_f',visit_annum = '$visit_annum_f',add_freq = '$add_freq_f',
			       annual_value = '$annual_value_f',pest_condition = '$condition6',condition_ref = '$condition_ref6',product_count = '$product_count_f' where sra_id = '$eti_id' and product_count = '$product_count_f'";
		$exec56 = mysql_query($query56) or die ("Error in Query56".mysql_error());
		 } else {
			 $query57 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_f','$pest_qty_f','$instruction_f','$visit_annum_f','$add_freq_f','$annual_value_f','$condition6','$condition_ref6','$product_count_f')";
			 $exec57 = mysql_query($query57) or die ("Error in Query57".mysql_error());
		 }
	}
	if($pest_g != ''){
		 $query58 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_g'";
		 $exec58 = mysql_query($query58) or die ("Error in Query58".mysql_error());
		 $res58 = mysql_fetch_array($exec58);
		 $check_product_id_g = $res58['id'];
		 if ($check_product_id_g != ''){
		$query59 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_g',qty='$pest_qty_g', instruction = '$instruction_g',visit_annum = '$visit_annum_g',add_freq = '$add_freq_g',
			       annual_value = '$annual_value_g',pest_condition = '$condition7',condition_ref = '$condition_ref7',product_count = '$product_count_g' where sra_id = '$eti_id' and product_count = '$product_count_g'";
		$exec59 = mysql_query($query59) or die ("Error in Query59".mysql_error());
		 } else {
			 $query60 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_g','$pest_qty_g','$instruction_g','$visit_annum_g','$add_freq_g','$annual_value_g','$condition7','$condition_ref7','$product_count_g')";
			 $exec60 = mysql_query($query60) or die ("Error in Query60".mysql_error());
		 }
	}
	
	if($pest_h != ''){
		 $query61 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_h'";
		 $exec61 = mysql_query($query61) or die ("Error in Query61".mysql_error());
		 $res61 = mysql_fetch_array($exec61);
		 $check_product_id_h = $res61['id'];
		 if ($check_product_id_h != ''){
		$query62 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_h',qty='$pest_qty_h', instruction = '$instruction_h',visit_annum = '$visit_annum_h',add_freq = '$add_freq_h',
			       annual_value = '$annual_value_h',pest_condition = '$condition8',condition_ref = '$condition_ref8',product_count = '$product_count_h' where sra_id = '$eti_id' and product_count = '$product_count_h'";
		$exec62 = mysql_query($query62) or die ("Error in Query62".mysql_error());
		 } else {
			 $query63 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,pest_condition,condition_ref,product_count) 
	           values('$eti_id','$pest_h','$pest_qty_h','$instruction_h','$visit_annum_h','$add_freq_h','$annual_value_h','$condition8','$condition_ref8','$product_count_h')";
			 $exec63 = mysql_query($query63) or die ("Error in Query63".mysql_error());
		 }
	}
	
	if($preparation_a != ''){
		 $query18 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_a'";
		 $exec18 = mysql_query($query18) or die ("Error in Query18".mysql_error());
		 $res18 = mysql_fetch_array($exec18);
		 $check_sra_id_a = $res18['id'];
		 if ($check_sra_id_a != ''){
		$query3 = "update eti_pest_details set sra_id = '$eti_id',preparation_id = '$preparation_a',unit_cost = '$unit_cost_a',qty = '$qty_a',
			   tot_val_unit = '$tot_val_unit_a',unit_per_tmt = '$unit_per_tmt_a',tmt_per_annum = '$tmt_per_annum_a',val_per_annum = '$val_per_annum_a',
			   pest_count = '$pest_count_a',unit_selling = '$unit_selling_a',tot_val_cost = '$tot_val_cost_a',
			   val_per_annum_cost = '$val_per_annum_cost_a' where sra_id = '$eti_id' and pest_count = '$pest_count_a'";
		$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
		 } else {
			 $query3 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_a','$unit_cost_a','$qty_a','$tot_val_unit_a','$unit_per_tmt_a',
			          '$tmt_per_annum_a','$val_per_annum_a','$pest_count_a','$unit_selling_a','$tot_val_cost_a','$val_per_annum_cost_a')";
			 $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
		 }
	}
	
	if($preparation_b != ''){
		 $query19 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_b'";
		 $exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
		 $res19 = mysql_fetch_array($exec19);
		 $check_sra_id_b = $res19['id'];
		 if ($check_sra_id_b != ''){
		$query4 = "update eti_pest_details set sra_id = '$eti_id',preparation_id = '$preparation_b',unit_cost = '$unit_cost_b',qty = '$qty_b',
			   tot_val_unit = '$tot_val_unit_b',unit_per_tmt = '$unit_per_tmt_b',tmt_per_annum = '$tmt_per_annum_b',val_per_annum = '$val_per_annum_b',
			   pest_count = '$pest_count_b',unit_selling = '$unit_selling_b',tot_val_cost = '$tot_val_cost_b',
			   val_per_annum_cost = '$val_per_annum_cost_b' where sra_id = '$eti_id' and pest_count = '$pest_count_b'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		 } else {
		$query4 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_b','$unit_cost_b','$qty_b','$tot_val_unit_b','$unit_per_tmt_b',
			          '$tmt_per_annum_b','$val_per_annum_b','$pest_count_b','$unit_selling_b','$tot_val_cost_b','$val_per_annum_cost_b')";
	    $exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		 }
	}
	
	if($preparation_c != ''){
		 $query20 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_c'";
		 $exec20 = mysql_query($query20) or die ("Error in Query20".mysql_error());
		 $res20 = mysql_fetch_array($exec20);
		 $check_sra_id_c = $res20['id'];
		 if ($check_sra_id_c != ''){
		$query5 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_c',unit_cost = '$unit_cost_c',qty = '$qty_c',
			   tot_val_unit = '$tot_val_unit_c',unit_per_tmt = '$unit_per_tmt_c',tmt_per_annum = '$tmt_per_annum_c',val_per_annum = '$val_per_annum_c',
			   pest_count = '$pest_count_c',unit_selling = '$unit_selling_c',tot_val_cost = '$tot_val_cost_c',
			   val_per_annum_cost = '$val_per_annum_cost_c' where sra_id = '$eti_id' and pest_count = '$pest_count_c'";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		 } else {
		$query5 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_c','$unit_cost_c','$qty_c','$tot_val_unit_c','$unit_per_tmt_c',
			          '$tmt_per_annum_c','$val_per_annum_c','$pest_count_c','$unit_selling_c','$tot_val_cost_c','$val_per_annum_cost_c')";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		 }
	}
	
	if($preparation_d != ''){
		 $query21 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_d'";
		 $exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
		 $res21 = mysql_fetch_array($exec21);
		 $check_sra_id_d = $res21['id'];
		 if ($check_sra_id_d != ''){
		$query6 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_d',unit_cost = '$unit_cost_d',qty = '$qty_d',
			   tot_val_unit = '$tot_val_unit_d',unit_per_tmt = '$unit_per_tmt_d',tmt_per_annum = '$tmt_per_annum_d',val_per_annum = '$val_per_annum_d',
			   pest_count = '$pest_count_d',unit_selling = '$unit_selling_d',tot_val_cost = '$tot_val_cost_d',
			   val_per_annum_cost = '$val_per_annum_cost_d' where sra_id = '$eti_id' and pest_count = '$pest_count_d'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		 } else {
			$query6 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_d','$unit_cost_d','$qty_d','$tot_val_unit_d','$unit_per_tmt_d',
			          '$tmt_per_annum_d','$val_per_annum_d','$pest_count_d','$unit_selling_d','$tot_val_cost_d','$val_per_annum_cost_d')";
			$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		 }
	}
	
	if($preparation_e != ''){
		 $query22 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_e'";
		 $exec22 = mysql_query($query22) or die ("Error in Query22".mysql_error());
		 $res22 = mysql_fetch_array($exec22);
		 $check_sra_id_e = $res22['id'];
		 if ($check_sra_id_e != ''){
		$query7 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_e',unit_cost = '$unit_cost_e',qty = '$qty_e',
			   tot_val_unit = '$tot_val_unit_e',unit_per_tmt = '$unit_per_tmt_e',tmt_per_annum = '$tmt_per_annum_e',val_per_annum = '$val_per_annum_e',
			   pest_count = '$pest_count_e',unit_selling = '$unit_selling_e',tot_val_cost = '$tot_val_cost_e',
			   val_per_annum_cost = '$val_per_annum_cost_e' where sra_id = '$eti_id' and pest_count = '$pest_count_e'";
		$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
		 } else {
			 $query7 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_e','$unit_cost_e','$qty_e','$tot_val_unit_e','$unit_per_tmt_e',
			          '$tmt_per_annum_e','$val_per_annum_e','$pest_count_e','$unit_selling_e','$tot_val_cost_e','$val_per_annum_cost_e')";
			$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
		 }
	}
	
	if($preparation_f != ''){
		 $query23 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_f'";
		 $exec23 = mysql_query($query23) or die ("Error in Query23".mysql_error());
		 $res23 = mysql_fetch_array($exec23);
		 $check_sra_id_f = $res23['id'];
		 if ($check_sra_id_f != ''){
		$query8 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_f',unit_cost = '$unit_cost_f',qty = '$qty_f',
			   tot_val_unit = '$tot_val_unit_f',unit_per_tmt='$unit_per_tmt_f',tmt_per_annum = '$tmt_per_annum_f',val_per_annum = '$val_per_annum_f',
			   pest_count = '$pest_count_f',unit_selling = '$unit_selling_f',tot_val_cost = '$tot_val_cost_f',
			   val_per_annum_cost = '$val_per_annum_cost_f' where sra_id = '$eti_id' and pest_count = '$pest_count_f'";
		$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
		 } else {
			$query8 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_f','$unit_cost_f','$qty_f','$tot_val_unit_f','$unit_per_tmt_f',
			          '$tmt_per_annum_f','$val_per_annum_f','$pest_count_f','$unit_selling_f','$tot_val_cost_f','$val_per_annum_cost_f')";
			$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
		 }
	}
	
	if($preparation_g != ''){
		$query24 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_g'";
		 $exec24 = mysql_query($query24) or die ("Error in Query24".mysql_error());
		 $res24 = mysql_fetch_array($exec24);
		 $check_sra_id_g = $res24['id'];
		 if ($check_sra_id_g != ''){
		$query9 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_g',unit_cost = '$unit_cost_g',qty = '$qty_g',
			   tot_val_unit = '$tot_val_unit_g',unit_per_tmt='$unit_per_tmt_g',tmt_per_annum = '$tmt_per_annum_g',val_per_annum = '$val_per_annum_g',
			   pest_count = '$pest_count_g',unit_selling = '$unit_selling_g',tot_val_cost = '$tot_val_cost_g',
			   val_per_annum_cost = '$val_per_annum_cost_g' where sra_id = '$eti_id' and pest_count = '$pest_count_g'";
		$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
		 } else {
			 $query9 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_g','$unit_cost_g','$qty_g','$tot_val_unit_g','$unit_per_tmt_g',
			          '$tmt_per_annum_g','$val_per_annum_g','$pest_count_g','$unit_selling_g','$tot_val_cost_g','$val_per_annum_cost_g')";
	        $exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
		 }
	}
	
	if($preparation_h != ''){
		 $query25 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_h'";
		 $exec25 = mysql_query($query25) or die ("Error in Query25".mysql_error());
		 $res25 = mysql_fetch_array($exec25);
		 $check_sra_id_h = $res25['id'];
		 if ($check_sra_id_h != ''){
		$query10 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_h',unit_cost = '$unit_cost_h',qty = '$qty_h',
			   tot_val_unit = '$tot_val_unit_h',unit_per_tmt='$unit_per_tmt_h',tmt_per_annum = '$tmt_per_annum_h',val_per_annum = '$val_per_annum_h',
			   pest_count = '$pest_count_h',unit_selling = '$unit_selling_h',tot_val_cost = '$tot_val_cost_h',
			   val_per_annum_cost = '$val_per_annum_cost_h' where sra_id = '$eti_id' and pest_count = '$pest_count_h'";
		$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
		 } else {
			$query10 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_h','$unit_cost_h','$qty_h','$tot_val_unit_h','$unit_per_tmt_h',
			          '$tmt_per_annum_h','$val_per_annum_h','$pest_count_h','$unit_selling_h','$tot_val_cost_h','$val_per_annum_cost_h')";
			$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
		 }
	}
	if($shift_type_a != ''){
		$query26 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_a'";
		 $exec26 = mysql_query($query26) or die ("Error in Query26".mysql_error());
		 $res26 = mysql_fetch_array($exec26);
		 $check_shift_id_a = $res26['id'];
		 if ($check_shift_id_a != ''){
		$query11 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_a', per_hour = '$per_hour_a', 
	           no_hours = '$no_hours_a',total_hours = '$total_hours_a',tmt_hours = '$tmt_hours_a',
			   tmt_annum = '$tmt_annum_a',labour_value = '$labour_value_a',labour_count = '$labour_count_a',
			   fix_cost_per_hour = '$fix_cost_per_hour_a',wfix_cost_per_hour = '$wfix_cost_per_hour_a',fix_cost_total_hours = '$fix_cost_total_hours_a',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_a',fix_cost_labour_value = '$fix_cost_labour_value_a',wfix_cost_labour_value = '$wfix_cost_labour_value_a'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_a'";
		$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
		 } else {
	    $query11 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_a','$per_hour_a','$no_hours_a','$total_hours_a','$tmt_hours_a','$tmt_annum_a',
			          '$labour_value_a','$labour_count_a','$fix_cost_per_hour_a','$wfix_cost_per_hour_a','$fix_cost_total_hours_a',
					  '$wfix_cost_total_hours_a','$fix_cost_labour_value_a','$wfix_cost_labour_value_a')";
		$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
		 }
	}
	
	if($shift_type_b != ''){
		$query27 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_b'";
		 $exec27 = mysql_query($query27) or die ("Error in Query27".mysql_error());
		 $res27 = mysql_fetch_array($exec27);
		 $check_shift_id_b = $res27['id'];
		 if ($check_shift_id_b != ''){
		$query12 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_b', per_hour = '$per_hour_b', 
	           no_hours = '$no_hours_b',total_hours = '$total_hours_b',tmt_hours = '$tmt_hours_b',
			   tmt_annum = '$tmt_annum_b',labour_value = '$labour_value_b',labour_count = '$labour_count_b',
			   fix_cost_per_hour = '$fix_cost_per_hour_b',wfix_cost_per_hour = '$wfix_cost_per_hour_b',fix_cost_total_hours = '$fix_cost_total_hours_b',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_b',fix_cost_labour_value = '$fix_cost_labour_value_b',wfix_cost_labour_value = '$wfix_cost_labour_value_b'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_b'";
		$exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
		 } else {
			 $query12 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_b','$per_hour_b','$no_hours_b','$total_hours_b','$tmt_hours_b','$tmt_annum_b',
			          '$labour_value_b','$labour_count_b','$fix_cost_per_hour_b','$wfix_cost_per_hour_b','$fix_cost_total_hours_b',
					  '$wfix_cost_total_hours_b','$fix_cost_labour_value_b','$wfix_cost_labour_value_b')";
			$exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
		 }
	}
	
	if($shift_type_c != ''){
		$query28 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_c'";
		 $exec28 = mysql_query($query28) or die ("Error in Query27".mysql_error());
		 $res28 = mysql_fetch_array($exec28);
		 $check_shift_id_c = $res28['id'];
		 if ($check_shift_id_c != ''){
		$query13 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_c', per_hour = '$per_hour_c', 
	           no_hours = '$no_hours_c',total_hours = '$total_hours_c',tmt_hours = '$tmt_hours_c',
			   tmt_annum = '$tmt_annum_c',labour_value = '$labour_value_c',labour_count = '$labour_count_c',
			   fix_cost_per_hour = '$fix_cost_per_hour_c',wfix_cost_per_hour = '$wfix_cost_per_hour_c',fix_cost_total_hours = '$fix_cost_total_hours_c',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_c',fix_cost_labour_value = '$fix_cost_labour_value_c',wfix_cost_labour_value = '$wfix_cost_labour_value_c'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_c'";
		$exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
		 } else {
			 $query13 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_c','$per_hour_c','$no_hours_c','$total_hours_c','$tmt_hours_c','$tmt_annum_c',
			          '$labour_value_c','$labour_count_c','$fix_cost_per_hour_c','$wfix_cost_per_hour_c','$fix_cost_total_hours_c',
					  '$wfix_cost_total_hours_c','$fix_cost_labour_value_c','$wfix_cost_labour_value_c')";
			$exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
		 }
	}
	
	if($shift_type_d != ''){
		$query29 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_d'";
		 $exec29 = mysql_query($query29) or die ("Error in Query29".mysql_error());
		 $res29 = mysql_fetch_array($exec29);
		 $check_shift_id_d = $res29['id'];
		 if ($check_shift_id_d != ''){
		$query14 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_d', per_hour = '$per_hour_d', 
	           no_hours = '$no_hours_d',total_hours = '$total_hours_d',tmt_hours = '$tmt_hours_d',
			   tmt_annum = '$tmt_annum_d',labour_value = '$labour_value_d',labour_count = '$labour_count_d',
			   fix_cost_per_hour = '$fix_cost_per_hour_d',wfix_cost_per_hour = '$wfix_cost_per_hour_d',fix_cost_total_hours = '$fix_cost_total_hours_d',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_d',fix_cost_labour_value = '$fix_cost_labour_value_d',wfix_cost_labour_value = '$wfix_cost_labour_value_d'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_d'";
		$exec14 = mysql_query($query14) or die ("Error in Query14".mysql_error());
		 } else {
			$query14 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_d','$per_hour_d','$no_hours_d','$total_hours_d','$tmt_hours_d','$tmt_annum_d',
			          '$labour_value_d','$labour_count_d','$fix_cost_per_hour_d','$wfix_cost_per_hour_d','$fix_cost_total_hours_d',
					  '$wfix_cost_total_hours_d','$fix_cost_labour_value_d','$wfix_cost_labour_value_d')";
			$exec14 = mysql_query($query14) or die ("Error in Query14".mysql_error());
		 }
	}
	
	if($type_a != '') {
		 $query30 = "select id from eti_other_details where sra_id = '$eti_id' and other_count = '$other_count_a'";
		 $exec30 = mysql_query($query30) or die ("Error in Query30".mysql_error());
		 $res30 = mysql_fetch_array($exec30);
		 $check_type_id_a = $res30['id'];
		 if ($check_type_id_a != ''){
		$query15 = "update eti_other_details set sra_id = '$eti_id',type = '$type_a', other_unit_cost = '$other_unit_cost_a', 
	           other_item = '$other_item_a',other_tot_val = '$other_tot_val_a',other_tot_item = '$other_tot_item_a',
			   other_tmt_annum = '$other_tmt_annum_a',other_tot_annum = '$other_tot_annum_a',other_count = '$other_count_a'
			   where sra_id = '$eti_id' and other_count = '$other_count_a'";
		$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
		 } else {
		$query15 = "insert into eti_other_details (sra_id,type,other_unit_cost,other_item,other_tot_val,other_tot_item,
		            other_tmt_annum,other_tot_annum,other_count) 
					values('$eti_id','$type_a','$other_unit_cost_a','$other_item_a','$other_tot_val_a','$other_tot_item_a',
					'$other_tmt_annum_a','$other_tot_annum_a','$other_count_a')";
		$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
		 }
	}
	
	if($type_b != '') {
		 $query31 = "select id from eti_other_details where sra_id = '$eti_id' and other_count = '$other_count_b'";
		 $exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
		 $res31 = mysql_fetch_array($exec31);
		 $check_type_id_b = $res31['id'];
		 if ($check_type_id_b != ''){
		$query16 = "update eti_other_details set sra_id = '$eti_id',type = '$type_b', other_unit_cost = '$other_unit_cost_b', 
				   other_item = '$other_item_b',other_tot_val = '$other_tot_val_b',other_tot_item = '$other_tot_item_b',
				   other_tmt_annum = '$other_tmt_annum_b',other_tot_annum = '$other_tot_annum_b',other_count = '$other_count_b'
				   where sra_id = '$eti_id' and other_count = '$other_count_b'";
		$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
		 } else {
		$query16 = "insert into eti_other_details (sra_id,type,other_unit_cost,other_item,other_tot_val,other_tot_item,other_tmt_annum,other_tot_annum,
	                                            other_count) 
	           values('$eti_id','$type_b','$other_unit_cost_b','$other_item_b','$other_tot_val_b','$other_tot_item_b','$other_tmt_annum_b',
			          '$other_tot_annum_b','$other_count_b')";
		$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
		 }
	}
	
	$query17 = "update eti_total_details set total_unit = '$total_unit', total_unit_annum = '$total_unit_annum', 
	           total_labour = '$total_labour',total_labour_annum = '$total_labour_annum',other_total_a = '$other_total_a',
			   other_total_b = '$other_total_b',treatment_a = '$treatment_a',treatment_b = '$treatment_b',
			   total_annual_cost = '$total_annual_cost',price_accept = '$price_accept',price_accept_tax = '$price_accept_tax',
			   finance_note = '$finance_note',service_note = '$service_note',billing_frequency = '$billing_frequency',credit_term='$credit_term',invoice_type = '$invoice_type',invoice_attachment='$invoice_attachment',po_number = '$po_number',total_unit_cost = '$total_unit_cost',total_unit_cost_annum = '$total_unit_cost_annum',fix_cost_total_labour = '$fix_cost_total_labour',
			   wfix_cost_total_labour = '$wfix_cost_total_labour',fix_cost_total_labour_annum = '$fix_cost_total_labour_annum',wfix_cost_total_labour_annum = '$wfix_cost_total_labour_annum',
			   total_percentage = '$total_percentage',fix_percentage = '$fix_percentage',wfix_percentage = '$wfix_percentage'
			   where sra_id = '$eti_id'";
	$exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
	
	$query181 = "select competitor_name from eti_competitor where id='$competitor'";
	$exec181 = mysql_query($query181) or die ("Error in Query181".mysql_error());
	$res181 = mysql_fetch_array($exec181);
	$competitor_name = $res181['competitor_name'];
	
	$query191 = "select surveyor_name from eti_surveyor where id='$surveyor'";
	$exec191 = mysql_query($query191) or die ("Error in Query191".mysql_error());
	$res191 = mysql_fetch_array($exec191);
	$surveyor_name = $res191['surveyor_name'];
	
	$query201 = "select industry_name from eti_industry where id='$industry'";
	$exec201 = mysql_query($query201) or die ("Error in Query201".mysql_error());
	$res201 = mysql_fetch_array($exec201);
	$industry_name = $res201['industry_name'];
	
	$query211 = "select business_name from eti_business where id='$business_origin'";
	$exec211 = mysql_query($query211) or die ("Error in Query211".mysql_error());
	$res211 = mysql_fetch_array($exec211);
	$business_name = $res211['business_name'];
	
	$query221 = "select pest_name from eti_pest where id='$pest_a'";
	$exec221 = mysql_query($query221) or die ("Error in Query221".mysql_error());
	$res221 = mysql_fetch_array($exec221);
	$pest_name_a = $res221['pest_name'];
	
	$query231 = "select pest_name from eti_pest where id='$pest_b'";
	$exec231 = mysql_query($query231) or die ("Error in Query231".mysql_error());
	$res231 = mysql_fetch_array($exec231);
	$pest_name_b = $res231['pest_name'];
	
	$query241 = "select pest_name from eti_pest where id='$pest_c'";
	$exec241 = mysql_query($query241) or die ("Error in Query241".mysql_error());
	$res241 = mysql_fetch_array($exec241);
	$pest_name_c = $res241['pest_name'];
	
	$query251 = "select pest_name from eti_pest where id='$pest_d'";
	$exec251 = mysql_query($query251) or die ("Error in Query251".mysql_error());
	$res251 = mysql_fetch_array($exec251);
	$pest_name_d = $res251['pest_name'];
	
	$query261 = "select pest_name from eti_pest where id='$pest_e'";
	$exec261 = mysql_query($query261) or die ("Error in Query261".mysql_error());
	$res261 = mysql_fetch_array($exec261);
	$pest_name_e = $res261['pest_name'];
	
	$query271= "select pest_name from eti_pest where id='$pest_f'";
	$exec271 = mysql_query($query271) or die ("Error in Query271".mysql_error());
	$res271 = mysql_fetch_array($exec271);
	$pest_name_f = $res271['pest_name'];
	
	$query281 = "select pest_name from eti_pest where id='$pest_g'";
	$exec281 = mysql_query($query281) or die ("Error in Query281".mysql_error());
	$res281 = mysql_fetch_array($exec281);
	$pest_name_g = $res281['pest_name'];
	
	$query291 = "select pest_name from eti_pest where id='$pest_h'";
	$exec291 = mysql_query($query291) or die ("Error in Query291".mysql_error());
	$res291 = mysql_fetch_array($exec291);
	$pest_name_h = $res291['pest_name'];
	
	$query301 = "select equipment_name from eti_equipment where id='$preparation_a'";
	$exec301 = mysql_query($query301) or die ("Error in Query301".mysql_error());
	$res301 = mysql_fetch_array($exec301);
	$equipment_name_a = $res301['equipment_name'];
	
	$query311 = "select equipment_name from eti_equipment where id='$preparation_b'";
	$exec311 = mysql_query($query311) or die ("Error in Query311".mysql_error());
	$res311 = mysql_fetch_array($exec311);
	$equipment_name_b = $res311['equipment_name'];
	
	$query321 = "select equipment_name from eti_equipment where id='$preparation_c'";
	$exec321 = mysql_query($query321) or die ("Error in Query321".mysql_error());
	$res321= mysql_fetch_array($exec321);
	$equipment_name_c = $res321['equipment_name'];
	
	$query331 = "select equipment_name from eti_equipment where id='$preparation_d'";
	$exec331 = mysql_query($query331) or die ("Error in Query331".mysql_error());
	$res331 = mysql_fetch_array($exec331);
	$equipment_name_d = $res331['equipment_name'];
	
	$query341 = "select equipment_name from eti_equipment where id='$preparation_e'";
	$exec341 = mysql_query($query341) or die ("Error in Query341".mysql_error());
	$res341 = mysql_fetch_array($exec341);
	$equipment_name_e = $res341['equipment_name'];
	
	$query351 = "select equipment_name from eti_equipment where id='$preparation_f'";
	$exec351 = mysql_query($query351) or die ("Error in Query351".mysql_error());
	$res351 = mysql_fetch_array($exec351);
	$equipment_name_f = $res351['equipment_name'];
	
	$query361 = "select equipment_name from eti_equipment where id='$preparation_g'";
	$exec361 = mysql_query($query361) or die ("Error in Query361".mysql_error());
	$res361 = mysql_fetch_array($exec361);
	$equipment_name_g = $res361['equipment_name'];
	
	$query371 = "select equipment_name from eti_equipment where id='$preparation_h'";
	$exec371 = mysql_query($query371) or die ("Error in Query371".mysql_error());
	$res371 = mysql_fetch_array($exec371);
	$equipment_name_h = $res371['equipment_name'];
	
	if($total_percentage < 0) {
		$percentage_text = 'Negative';
		//$profit_text = 'Less';
		$percentage = $percentage_text.' ('.abs($total_percentage).'%)';
	} else if ($total_percentage > 0) {
		$percentage_text = 'Positive';
		//$profit_text = 'More';
		$percentage = $percentage_text.' ('.abs($total_percentage).'%)';
	} else if ($total_percentage == 0) {
		$percentage = 'Equivalent';
	} 
	
	if($fix_percentage < 0) {
		$percentage_text = 'Negative';
		//$profit_text = 'Less';
		$fpercentage = $percentage_text.' ('.abs($fix_percentage).'%)';
	} else if ($fix_percentage > 0) {
		$percentage_text = 'Positive';
		//$profit_text = 'More';
		$fpercentage = $percentage_text.' ('.abs($fix_percentage).'%)';
	} else if ($fix_percentage == 0) {
		$fpercentage = 'Equivalent';
	}
	
	if($wfix_percentage < 0) {
		$percentage_text = 'Negative';
		//$profit_text = 'Less';
		$wfpercentage = $percentage_text.' ('.abs($wfix_percentage).'%)';
	} else if ($wfix_percentage > 0) {
		$percentage_text = 'Positive';
		//$profit_text = 'More';
		$wfpercentage = $percentage_text.' ('.abs($wfix_percentage).'%)';
	} else if ($wfix_percentage == 0) {
		$wfpercentage = 'Equivalent';
	}
	
	$html = '<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
table.customer_details {
    border: 1px solid black;
    border-collapse: collapse;
}

.customer_details td {
    border: 1px solid black;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="30%" style="color:#0000BB; ">
	<span style="font-weight: bold; font-size: 14pt;">
		<img src="rentokil_logo.jpg" alt="TPA" width="100">
	</span></td>
<td width="70%" style="text-align: left;"><span style="font-weight: bold; font-size: 10pt;">Electronics Treatment Instruction (ETI)</span></td>
</tr></table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->
<div style="font-weight: bold; background-color: #EEEEEE;">'.$sra_lbl.':</div><br>
<table class="customer_details" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$serial_number_lbl.'</td>
		<td>'.$serial_number.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$competitor_lbl.'</td>
		<td>'.$competitor_name.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$surveyor_lbl.'</td>
		<td>'.$surveyor_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$contract_no_lbl.'</td>
		<td>'.$contract_no.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$industry_lbl.'</td>
		<td>'.$industry_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$eti_date_lbl.'</td>
		<td>'.$eti_date.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$eti_time_lbl.'</td>
		<td>'.$eti_time.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$eti_duration_lbl.'</td>
		<td>'.$eti_duration.' '.$job_type.' '.$business_type.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$name_lbl.'</td>
		<td>'.$pdf_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$existing_account_lbl.'</td>
		<td>'.$existing_account.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$decision_maker_lbl.'</td>
		<td>'.$decision_maker.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$whom_see_lbl.'</td>
		<td>'.$whom_see.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$address_a_lbl.'</td>
		<td>'.$address_a.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$address_b_lbl.'</td>
		<td>'.$address_b.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$postcode_a_lbl.'</td>
		<td>'.$postcode_a.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$tel_a_lbl.'</td>
		<td>'.$tel_a.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_address_a_lbl.'</td>
		<td>'.$premises_address_a.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_address_b_lbl.'</td>
		<td>'.$premises_address_b.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_postcode_a_lbl.'</td>
		<td>'.$postcode_b.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_tel_a_lbl.'</td>
		<td>'.$tel_b.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$email_lbl .'</td>
		<td>'.$email.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$infestation_lbl.'</td>
		<td>'.$infestation.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$business_origin_lbl.'</td>
		<td>'.$business_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$referral_name_lbl.'</td>
		<td>'.$referral_name.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$sra_sra_lbl.'</td>
		<td>'.$sra.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$billing_email_lbl.'</td>
		<td>'.$billing_email.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$prospect_no_lbl.'</td>
		<td>'.$prospect_no.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;"></td>
		<td></td>
	</tr>
</table>

<br />

<div style="font-weight: bold; background-color: #EEEEEE;">'.$site_map_lbl.':</div><br>
<table class="customer_details" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$domestic_lbl.'</td>
		<td>'.$domestic.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$industrial_lbl.'</td>
		<td>'.$industrial.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$commercial_lbl.'</td>
		<td>'.$commercial.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$others_lbl.'</td>
		<td>'.$site_plan_others.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$location_lbl.'</td>
		<td>'.$location.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$area_treatment_lbl.'</td>
		<td>'.$lm.' LM '.$meter.' m<sup>2</sup></td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$surveyor_lbl.'</td>
		<td>'.$surveyor_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$litre_lbl.'</td>
		<td>'.$litre.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$chemical_lbl.'</td>
		<td>'.$chemical.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$others_lbl.'</td>
		<td>'.$chemical_other_desc.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$finance_note_lbl.'</td>
		<td>'.$finance_note.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$service_note_lbl.'</td>
		<td>'.$service_note.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$billing_frequency_lbl.'</td>
		<td>'.$billing_frequency.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$invoice_type_lbl.'</td>
		<td>'.$invoice_type.'</td>
	</tr>
</table>
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
	<thead>
		<tr>
			<td width="15%">'.$pest_lbl.'</td>
			<td width="10%">'.$qty_lbl.'</td>
			<td width="15%">'.$instruction_lbl.'</td>
			<td width="10%">'.$visit_annum_lbl.'</td>
			<td width="10%">'.$add_freq_lbl.'</td>
			<td width="10%">'.$annual_value_lbl.'</td>
		</tr>
	</thead>
	<tbody>';
if ($pest_a != '') {

	$html .= ' <tr>
		<td>'.$pest_name_a.'</td>
		<td>'.$pest_qty_a.'</td>
		<td>'.$instruction_a.'</td>
		<td class="cost">'.$visit_annum_a.'</td>
		<td class="cost">'.$add_freq_a.'</td>
		<td class="cost">'.$annual_value_a.'</td>
</tr>'; } if ($pest_b != '') {
	$html .= ' <tr>
		<td>'.$pest_name_b.'</td>
		<td>'.$pest_qty_b.'</td>
		<td>'.$instruction_b.'</td>
		<td class="cost">'.$visit_annum_b.'</td>
		<td class="cost">'.$add_freq_b.'</td>
		<td class="cost">'.$annual_value_b.'</td>
</tr>'; } if ($pest_c != '') {
	$html .= ' <tr>
		<td>'.$pest_name_c.'</td>
		<td>'.$pest_qty_c.'</td>
		<td>'.$instruction_c.'</td>
		<td class="cost">'.$visit_annum_c.'</td>
		<td class="cost">'.$add_freq_c.'</td>
		<td class="cost">'.$annual_value_c.'</td>
</tr>'; } if ($pest_d != '') {
	$html .= ' <tr>
		<td>'.$pest_name_d.'</td>
		<td>'.$pest_qty_d.'</td>
		<td>'.$instruction_d.'</td>
		<td class="cost">'.$visit_annum_d.'</td>
		<td class="cost">'.$add_freq_d.'</td>
		<td class="cost">'.$annual_value_d.'</td>
</tr>'; } if ($pest_e != '') {
	$html .= ' <tr>
		<td>'.$pest_name_e.'</td>
		<td>'.$pest_qty_e.'</td>
		<td>'.$instruction_e.'</td>
		<td class="cost">'.$visit_annum_e.'</td>
		<td class="cost">'.$add_freq_e.'</td>
		<td class="cost">'.$annual_value_e.'</td>
</tr>'; } if ($pest_f != '') {
	$html .= ' <tr>
		<td>'.$pest_name_f.'</td>
		<td>'.$pest_qty_f.'</td>
		<td>'.$instruction_f.'</td>
		<td class="cost">'.$visit_annum_f.'</td>
		<td class="cost">'.$add_freq_f.'</td>
		<td class="cost">'.$annual_value_f.'</td>
</tr>'; } if ($pest_g != '') {
	$html .= ' <tr>
		<td>'.$pest_name_g.'</td>
		<td>'.$pest_qty_g.'</td>
		<td>'.$instruction_g.'</td>
		<td class="cost">'.$visit_annum_g.'</td>
		<td class="cost">'.$add_freq_g.'</td>
		<td class="cost">'.$annual_value_g.'</td>
</tr>'; } if ($pest_h != '') {
	$html .= ' <tr>
		<td>'.$pest_name_h.'</td>
		<td>'.$pest_qty_h.'</td>
		<td>'.$instruction_h.'</td>
		<td class="cost">'.$visit_annum_h.'</td>
		<td class="cost">'.$add_freq_h.'</td>
		<td class="cost">'.$annual_value_h.'</td>
</tr>'; }
	$html .= ' 
</tbody>
</table>
<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
	<tr>
		<td width="15%">'.$preparations_lbl.'</td>
		<td width="10%">'.$unit_cost_lbl.'</td>
		<td width="10%">'.$qty_lbl.'</td>
		<td width="10%">'.$tot_val_unit_lbl.'</td>
		<td width="10%">'.$units_per_tmt_lbl.'</td>
		<td width="10%">'.$tmt_per_annum_lbl.'</td>
		<td width="10%">'.$val_per_annum_lbl.'</td>
	</tr>
</thead>
<tbody>';
if ($preparation_a != '') {

	$html .= ' <tr>
		<td>'.$equipment_name_a.'</td>
		<td class="cost">S&#036; '.$unit_cost_a.'</td>
		<td class="cost">'.$qty_a.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_a.'</td>
		<td class="cost">'.$unit_per_tmt_a.'</td>
		<td class="cost">'.$tmt_per_annum_a.'</td>
		<td class="cost">S&#036; '.$val_per_annum_a.'</td>
</tr>'; } if ($preparation_b != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_b.'</td>
		<td class="cost">S&#036; '.$unit_cost_b.'</td>
		<td class="cost">'.$qty_b.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_b.'</td>
		<td class="cost">'.$unit_per_tmt_b.'</td>
		<td class="cost">'.$tmt_per_annum_b.'</td>
		<td class="cost">S&#036; '.$val_per_annum_b.'</td>
</tr>'; } if ($preparation_c != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_c.'</td>
		<td class="cost">S&#036; '.$unit_cost_c.'</td>
		<td class="cost">'.$qty_c.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_c.'</td>
		<td class="cost">'.$unit_per_tmt_c.'</td>
		<td class="cost">'.$tmt_per_annum_c.'</td>
		<td class="cost">S&#036; '.$val_per_annum_c.'</td>
</tr>'; } if ($preparation_d != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_d.'</td>
		<td class="cost">S&#036; '.$unit_cost_d.'</td>
		<td class="cost">'.$qty_d.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_d.'</td>
		<td class="cost">'.$unit_per_tmt_d.'</td>
		<td class="cost">'.$tmt_per_annum_d.'</td>
		<td class="cost">S&#036; '.$val_per_annum_d.'</td>
</tr>'; } if ($preparation_e != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_e.'</td>
		<td class="cost">S&#036; '.$unit_cost_e.'</td>
		<td class="cost">'.$qty_e.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_e.'</td>
		<td class="cost">'.$unit_per_tmt_e.'</td>
		<td class="cost">'.$tmt_per_annum_e.'</td>
		<td class="cost">S&#036; '.$val_per_annum_e.'</td>
</tr>'; } if ($preparation_f != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_f.'</td>
		<td class="cost">S&#036; '.$unit_cost_f.'</td>
		<td class="cost">'.$qty_f.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_f.'</td>
		<td class="cost">'.$unit_per_tmt_f.'</td>
		<td class="cost">'.$tmt_per_annum_f.'</td>
		<td class="cost">S&#036; '.$val_per_annum_f.'</td>
</tr>'; } if ($preparation_g != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_g.'</td>
		<td class="cost">S&#036; '.$unit_cost_g.'</td>
		<td class="cost">'.$qty_g.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_g.'</td>
		<td class="cost">'.$unit_per_tmt_g.'</td>
		<td class="cost">'.$tmt_per_annum_g.'</td>
		<td class="cost">S&#036; '.$val_per_annum_g.'</td>
</tr>'; } if ($preparation_h != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_h.'</td>
		<td class="cost">S&#036; '.$unit_cost_h.'</td>
		<td class="cost">'.$qty_h.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_h.'</td>
		<td class="cost">'.$unit_per_tmt_h.'</td>
		<td class="cost">'.$tmt_per_annum_h.'</td>
		<td class="cost">S&#036; '.$val_per_annum_h.'</td>
</tr>'; }
	$html .= ' <tr>
		<td class="totals" colspan="3" align="right">'.$total_preparation_lbl.'</td>
		<td class="totals cost" align="right">S&#036; '.$total_unit.'</td>
		<td class="totals cost"></td>
		<td class="totals cost"></td>
		<td class="totals cost" align="right">S&#036; '.$total_unit_annum.'</td>
	</tr>
</tbody>
</table> <br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">	
<thead>
	<tr>
		<td width="15%">'.$labour_lbl.'</td>
		<td width="15%">'.$shift_type_lbl.'</td>
		<td width="15%">'.$per_hour_lbl.'</td>
		<td width="10%">'.$no_hours_lbl.'</td>
		<td width="10%">'.$total_hours_lbl.'</td>
		<td width="10%">'.$tmt_hours_lbl.'</td>
		<td width="10%">'.$tmt_annum_lbl.'</td>
		<td width="10%">'.$labour_value_lbl.'</td>
	</tr>
</thead>
<tbody>';
if ($shift_type_a != '') {

	$html .= '
	<tr>
		<td>'.$main_frequency_lbl.'</td>
		<td>'.$shift_type_a.'</td>
		<td class="cost">'.$per_hour_a.'</td>
		<td class="cost">'.$no_hours_a.'</td>
		<td class="cost">'.$total_hours_a.'</td>
		<td class="cost">'.$tmt_hours_a.'</td>
		<td class="cost">'.$tmt_annum_a.'</td>
		<td class="cost">'.$labour_value_a.'</td>
	</tr>'; } if ($shift_type_b != '') {
	$html .= '
	<tr>
		<td>'.$add_fre_a_lbl.'</td>
		<td>'.$shift_type_b.'</td>
		<td class="cost">'.$per_hour_b.'</td>
		<td class="cost">'.$no_hours_b.'</td>
		<td class="cost">'.$total_hours_b.'</td>
		<td class="cost">'.$tmt_hours_b.'</td>
		<td class="cost">'.$tmt_annum_b.'</td>
		<td class="cost">'.$labour_value_b.'</td>
	</tr>'; } if ($shift_type_c != '') {
	$html .= '
	<tr>
		<td>'.$add_fre_b_lbl.'</td>
		<td>'.$shift_type_c.'</td>
		<td class="cost">'.$per_hour_c.'</td>
		<td class="cost">'.$no_hours_c.'</td>
		<td class="cost">'.$total_hours_c.'</td>
		<td class="cost">'.$tmt_hours_c.'</td>
		<td class="cost">'.$tmt_annum_c.'</td>
		<td class="cost">'.$labour_value_c.'</td>
	</tr>'; } if ($shift_type_d != '') {
	$html .= '
	<tr>
		<td>'.$overtime_rate_lbl.'</td>
		<td>'.$shift_type_d.'</td>
		<td class="cost">'.$per_hour_d.'</td>
		<td class="cost">'.$no_hours_d.'</td>
		<td class="cost">'.$total_hours_d.'</td>
		<td class="cost">'.$tmt_hours_d.'</td>
		<td class="cost">'.$tmt_annum_d.'</td>
		<td class="cost">'.$labour_value_d.'</td>
	</tr>'; }
	$html .= '
	<tr>
		<td class="totals" colspan="3" align="right">'.$total_labour_lbl.'</td>
		<td class="totals cost" colspan="2" align="right">S&#036; '.$total_labour.'</td>
		<td class="totals cost"></td>
		<td class="totals cost" colspan="2" align="right">S&#036; '.$total_labour_annum.'</td>
	</tr>
</tbody>
<!-- END ITEMS HERE -->
	
</table> <br />
<div style="font-weight: bold; background-color: #EEEEEE;">'.$other_item_lbl.'</div><br>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
	<thead>
		<tr>
			<td width="15%">'.$type_lbl.'</td>
			<td width="15%">'.$unit_cost_lbl.'</td>
			<td width="15%">'.$no_items_lbl.'</td>
			<td width="10%">'.$oth_tot_val_lbl.'</td>
			<td width="10%">'.$oth_item_tmt_lbl.'</td>
			<td width="10%">'.$oth_tmt_annum_lbl.'</td>
			<td width="10%">'.$oth_tot_per_annum_lbl.'</td>
		</tr>
	</thead>
	<tbody>';
	if ($type_a != '') {
	$html .= '
		<tr>
			<td>'.$type_a.'</td>
			<td class="cost">'.$other_unit_cost_a.'</td>
			<td class="cost">'.$other_item_a.'</td>
			<td class="cost">S&#036; '.$other_tot_val_a.'</td>
			<td class="cost">S&#036; '.$other_tot_item_a.'</td>
			<td class="cost">S&#036; '.$other_tmt_annum_a.'</td>
			<td class="cost">S&#036; '.$other_tot_annum_a.'</td>
	</tr>'; } if ($type_b != '') {
	$html .= '
		<tr>
			<td>'.$type_b.'</td>
			<td class="cost">'.$other_unit_cost_b.'</td>
			<td class="cost">'.$other_item_b.'</td>
			<td class="cost">S&#036; '.$other_tot_val_b.'</td>
			<td class="cost">S&#036; '.$other_tot_item_b.'</td>
			<td class="cost">S&#036; '.$other_tmt_annum_b.'</td>
			<td class="cost">S&#036; '.$other_tot_annum_b.'</td>
	</tr>'; }
	$html .= '
		<tr>
			<td class="blanktotal" colspan="2" align="right">'.$other_total_lbl.'</td>
			<td class="blanktotal" colspan="2" align="right">S&#036; '.$other_total_a.'</td>
			<td class="blanktotal"></td>
			<td class="blanktotal" colspan="2" align="right">S&#036; '.$other_total_b.'</td>
		</tr>
		<tr>
			<td class="blanktotal" colspan="2" align="right">'.$treatment_a_lbl.'</td>
			<td class="blanktotal" colspan="2" align="right">S&#036; '.$treatment_a.'</td>
			<td class="blanktotal">'.$treatment_b_lbl.'</td>
			<td class="blanktotal" colspan="2" align="right">S&#036; '.$treatment_b.'</td>
		</tr>
		<tr>
			<td class="blanktotal" colspan="2" align="right">'.$total_annual_cost_lbl.'</td>
			<td class="blanktotal" colspan="2" align="right">S&#036; '.$total_annual_cost.'</td>
			<td class="blanktotal">'.$price_tax_lbl.'</td>
			<td class="blanktotal" colspan="2" align="right">S&#036; '.$price_accept.'</td>
		</tr>
		<tr>
			<td class="blanktotal" colspan="5" align="right">'.$price_accept_tax_lbl.'</td>
			<td class="blanktotal" colspan="2" align="right">S&#036; '.$price_accept_tax.'</td>
		</tr>
		<tr>
			<td class="blanktotal" colspan="5" align="right">'.$gm_lbl.'</td>
			<td class="blanktotal" colspan="2">'.$percentage.'</td>
		</tr>
	</tbody>

</table>

</body>
</html>';
		$mpdf=new mPDF('c','A4','','',20,15,25,25,10,10);
		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Rentokil Initial Singapore Pte Ltd. - ETI");
		$mpdf->SetAuthor("Rentokil Initial Singapore Pte Ltd.");
		$mpdf->SetWatermarkText("Rentokil");
		$mpdf->showWatermarkText = true;
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');
        //$mpdf->mirrorMargins = 1;		
		$mpdf->autoScriptToLang = true; 
		$mpdf->autoLangToFont = true;
		$mpdf->useAdobeCJK = true;
		$mpdf->WriteHTML($html);
		$path = $server_path.'/downloads/eti_pdf/';
		$id_name= "ETI - ".$serial_number;
		$actual_path = $path.$id_name.".pdf";

		$mpdf->Output($actual_path,'F');
		
		if($invoice_type != 'Advance (Normal)' || $invoice_attachment != 'None' || ($credit_term == '45 Days' || $credit_term == '60 Days' || $credit_term == '90 Days' || $credit_term == '120 Days') || ($billing_frequency == 'Monthly' && $price_accept <= 2000)){
			if($invoice_type != 'Advance (Normal)') {
				$condition_reason_a = "Invoice Type: $invoice_type<br>";
			}
			if($invoice_attachment != 'None') {
				$condition_reason_b = "Invoice Attachment: $invoice_attachment<br>";
			}
			if($credit_term != '15 Days' || $credit_term != '30 Days') {
				$condition_reason_c = "Credit Terms: $credit_term<br>";
			}
			if($billing_frequency == 'Monthly' && $price_accept <= 2000) {
				$condition_reason_d = 'Billing Frequency: Monthly & Price accepted Less than or equal to S$2000<br>';
			}
			$condition = 'Condition';
			$business_id = '0';
			$level = '0';
			$add_type = 'TO';
			$query38 = "select id,name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level='$level' and business_type='$business_id' and add_type='$add_type'";
			$exec38 = mysql_query($query38) or die ("Error in Query38".mysql_error());
			$res38= mysql_fetch_array($exec38);
			$email = $res38['email'];
			$email_name = $res38['name'];
			$email_id = $res38['id'];
			$body  = '<html>
		          <head>
				  <style>
				  .link_button {
					display: inline-block;
					width: 115px;
					height: 25px;
					background: #4E9CAF;
					padding: 10px;
					text-align: center;
					border-radius: 5px;
					color: white;
					font-weight: bold;
					}
				  </style>
				  </head>
					<body>
						<div>
						<b>Dear '.$email_name.',</b>
						</div> <br /> 
						<div>Please find below the ETI for your approval. Details are as below.</div> <br />
						<div><b>Customer Name :</b> '.$name.'</div>
						<div><b>Contract / Job Value :</b> '.$price_accept.'</div>
						<div><b>Customer Type :</b> '.$industry_name.'</div><br />
						<div>Product Details:</div><br />'; if ($pest_a != '') {
						$body .= '<div>'.$pest_name_a.' - '.$visit_annum_a.' - '.$annual_value_a.'</div>'; } if ($pest_b != '') {
						$body .= '<div>'.$pest_name_b.' - '.$visit_annum_b.' - '.$annual_value_b.'</div>'; } if ($pest_c != '') {
						$body .= '<div>'.$pest_name_c.' - '.$visit_annum_c.' - '.$annual_value_c.'</div>'; } if ($pest_d != '') {
						$body .= '<div>'.$pest_name_d.' - '.$visit_annum_d.' - '.$annual_value_d.'</div>'; } if ($pest_e != '') {
						$body .= '<div>'.$pest_name_e.' - '.$visit_annum_e.' - '.$annual_value_e.'</div>'; } if ($pest_f != '') {
						$body .= '<div>'.$pest_name_f.' - '.$visit_annum_f.' - '.$annual_value_f.'</div>'; } if ($pest_g != '') {
						$body .= '<div>'.$pest_name_g.' - '.$visit_annum_g.' - '.$annual_value_g.'</div>'; } if ($pest_h != '') {
						$body .= '<div>'.$pest_name_h.' - '.$visit_annum_h.' - '.$annual_value_h.'</div><br />'; } 
						$body .= '<br /><div><b>Reason :</b><br>'.$condition_reason_a.' '.$condition_reason_b.' '.$condition_reason_c.' '.$condition_reason_d.'</div><br />
						<div>
							<a class="link_button" href="'.$base_url.'approve_condition.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Approve</a>
							<a class="link_button" href="'.$base_url.'reject_condition.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Reject</a>
							<a class="link_button" href="'.$base_url.'clarify_condition.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Clarification</a>
						</div><br />
						<div> 
							<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b>
						</div>
					</body>
				</html>';
			$subject = "ETI/".$employee_name." - ".substr($name,0,30)." - ".$eti_date." - ".$postcode_b." for your approval";
			
			$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPDebug = 0;
			$mail->Mailer = "smtp";
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->Username = "speedasia-sg@rentokil-initial.com"; // SMTP username
			$mail->Password = "hczpdrjeurqfargw"; // SMTP password 
			$mail->Priority = 1;
			$from_email = 'speedasia-sg@rentokil-initial.com';
			$from_name = 'Speedasia ETI';
			$visitor_email = 'speedasia-sg@rentokil-initial.com';
			$mail->AddAddress($email,$email_name);
			//$mail->AddCC('krishnadas.warrier@rentokil-initial.com','Krishnadas');
			//$mail->AddCC('pc-eti-sg@rentokil-initial.com','PC ETI');
			//$mail->AddCC($email_cc,$email_name_cc);
			$mail->SetFrom($from_email, $from_name);
			$mail->AddReplyTo($from_email,$from_name);
			$mail->Subject  = $subject;
			$mail->MsgHTML($body);
			$path = $server_path.'/downloads/eti_pdf/';
			$id_name= "ETI - ".$serial_number;
			$actual_path = $path.$id_name.".pdf";
			$mail->AddAttachment($actual_path);
			if($attachment_a_target != ''){
			$attachement_a = $server_path.'/'.$attachment_a_target;
			$mail->AddAttachment($attachement_a);
			}
			if($attachment_b_target != ''){
			$attachement_b = $server_path.'/'.$attachment_b_target;
			$mail->AddAttachment($attachement_b);
			}
			if($attachment_c_target != ''){
			$attachement_c = $server_path.'/'.$attachment_c_target;
			$mail->AddAttachment($attachement_c);
			}
			if($attachment_d_target != ''){
			$attachement_d = $server_path.'/'.$attachment_d_target;
			$mail->AddAttachment($attachement_d);
			}
			if($attachment_e_target != ''){
			$attachement_e = $server_path.'/'.$attachment_e_target;
			$mail->AddAttachment($attachement_e);
			}
			$mail->Send();
			$sra_status = 'Pending at '.$email_name;
			$current_date = date('Y-m-d H:i:s');
			
			$query444 = "select id from eti_sra_status where sra_id='$eti_id'";
			$exec444 = mysql_query($query444) or die ("Error in Query444".mysql_error());
			$res444 = mysql_fetch_array($exec444);
			$sra_id = $res444['id'];
			if ($sra_id != '') {
				$query433 = "update eti_sra_status set approve_desc = '$sra_status', approve_date_time = '$current_date',approve_email_id='$email',approve_name='$email_name', user_id='$email_id' where id = '$sra_id'";
				$exec433 = mysql_query($query433) or die ("Error in Query433".mysql_error());
			} else {
				$query433 = "insert into eti_sra_status (sra_id,approve_desc,approve_date_time,approve_email_id,approve_name,user_id) 
				values('$eti_id','$sra_status','$current_date','$email','$email_name','$email_id')";
				$exec433 = mysql_query($query433) or die ("Error in Query433".mysql_error());
			}
			
			
			$drive = new GoogleDrive();
			$query434 = "select id,serial_number,google_drive from eti_sra where id='$eti_id'";
			$exec434 = mysql_query($query434) or die ("Error in Query434".mysql_error());
			$res434= mysql_fetch_array($exec434);
			$drive_serial_number = $res434['serial_number'];
			$fileId  = $res434['google_drive'];
			if ($fileId != '') {
				$file = $drive->removeFileFromFolder($fileId);
				$file = $drive->upload('downloads/eti_pdf/','ETI - '.$drive_serial_number.'.pdf');
				$google_drive_fileid = $file->id;
				$query435 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
				$exec435 = mysql_query($query435) or die ("Error in Query435".mysql_error());
			} else {
				$file = $drive->upload('downloads/eti_pdf/','ETI - '.$drive_serial_number.'.pdf');
				$google_drive_fileid = $file->id;
				$query435 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
				$exec435 = mysql_query($query435) or die ("Error in Query435".mysql_error());
			}
		} else {
		if ($fix_percentage >= 50) {
			$condition = 'Greater Than 50';
			$business_id = '0';
			$add_type = 'TO';
			$level = '0';
			$query381 = "select id,name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level='$level' and business_type='$business_id' and add_type='$add_type'";
			$exec381 = mysql_query($query381) or die ("Error in Query381".mysql_error());
			$res381= mysql_fetch_array($exec381);
			$email = $res381['email'];
			$email_name = $res381['name'];
			$email_id = $res381['id'];
			$body  = '<html>
		          <head>
				  <style>
				  .link_button {
					display: inline-block;
					width: 115px;
					height: 25px;
					background: #4E9CAF;
					padding: 10px;
					text-align: center;
					border-radius: 5px;
					color: white;
					font-weight: bold;
					}
				  </style>
				  </head>
					<body>
						<div>
						<b>Dear '.$email_name.',</b>
						</div> <br /> 
						<div>Please find attached the ETI for contract creation.</div> <br />
						<div><b>Customer Name :</b> '.$pdf_name.'</div>
						<div><b>Contract / Job Value:</b>'.$price_accept.'</div>
						<div><b>Customer Type :</b> '.$industry_name.'</div><br />
						<div><b>Gross Margin 1 :</b> '.$percentage.'</div><br />
						<div>
							<a class="link_button" href="'.$base_url.'reject_admin_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Reject</a>
						</div><br />
						<div> 
							<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b>
						</div>
					</body>
				</html>';
			$subject = "ETI/".$employee_name." - ".substr($pdf_name,0,30)." - ".$eti_date." - ".$postcode_b." for your action";
			$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPDebug = 0;
			$mail->Mailer = "smtp";
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->Username = "speedasia-sg@rentokil-initial.com"; // SMTP username
			$mail->Password = "hczpdrjeurqfargw"; // SMTP password 
			$Mail->Priority = 1;
			$from_email = 'speedasia-sg@rentokil-initial.com';
			$from_name = 'Speedasia ETI';
			$mail->AddAddress($email,$email_name);
			//$mail->AddAddress('desmond.wong@rentokil-initial.com','Desmond');
			//$mail->AddCC('krishnadas.warrier@rentokil-initial.com','Krishnadas');
			//$mail->AddCC('pc-eti-sg@rentokil-initial.com','PC ETI');
			$mail->SetFrom($from_email, $from_name);
			$mail->AddReplyTo($from_email,$from_name);
			$mail->Subject  = $subject;
			$mail->MsgHTML($body);   
			$path = $server_path.'/downloads/eti_pdf/';
			$id_name= "ETI - ".$serial_number;
			$actual_path = $path.$id_name.".pdf";
			$mail->AddAttachment($actual_path);
			if($attachment_a_target != ''){
			$attachement_a = $server_path.'/'.$attachment_a_target;
			$mail->AddAttachment($attachement_a);
			}
			if($attachment_b_target != ''){
			$attachement_b = $server_path.'/'.$attachment_b_target;
			$mail->AddAttachment($attachement_b);
			}
			if($attachment_c_target != ''){
			$attachement_c = $server_path.'/'.$attachment_c_target;
			$mail->AddAttachment($attachement_c);
			}
			if($attachment_d_target != ''){
			$attachement_d = $server_path.'/'.$attachment_d_target;
			$mail->AddAttachment($attachement_d);
			}
			if($attachment_e_target != ''){
			$attachement_e = $server_path.'/'.$attachment_e_target;
			$mail->AddAttachment($attachement_e);
			}
			$mail->Send();
			
			$current_date = date('Y-m-d H:i:s');
			
			$query444 = "select id from eti_sra_status where sra_id='$eti_id'";
			$exec444 = mysql_query($query444) or die ("Error in Query444".mysql_error());
			$res444 = mysql_fetch_array($exec444);
			$sra_id = $res444['id'];
			if ($sra_id != '') {
				$query433 = "update eti_sra_status set approve_desc = 'Sent To Admin Team', approve_date_time = '$current_date',
				approve_email_id='$email',approve_name='$email_name', user_id='$email_id' where id = '$sra_id'";
				$exec433 = mysql_query($query433) or die ("Error in Query433".mysql_error());
			} else {
				$query433 = "insert into eti_sra_status (sra_id,approve_desc,approve_date_time,approve_email_id,approve_name,user_id) 
				values('$eti_id','Sent To Admin Team','$current_date','$email','$email_name','$email_id')";
				$exec433 = mysql_query($query433) or die ("Error in Query433".mysql_error());
			}
			
			$drive = new GoogleDrive();
			$query434 = "select id,serial_number,google_drive from eti_sra where id='$eti_id'";
			$exec434 = mysql_query($query434) or die ("Error in Query434".mysql_error());
			$res434= mysql_fetch_array($exec434);
			$drive_serial_number = $res434['serial_number'];
			$fileId  = $res434['google_drive'];
			if ($fileId != '') {
				$file = $drive->removeFileFromFolder($fileId);
				$file = $drive->upload('downloads/eti_pdf/','ETI - '.$drive_serial_number.'.pdf');
				$google_drive_fileid = $file->id;
				$query435 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
				$exec435 = mysql_query($query435) or die ("Error in Query435".mysql_error());
			} else {
				$file = $drive->upload('downloads/eti_pdf/','ETI - '.$drive_serial_number.'.pdf');
				$google_drive_fileid = $file->id;
				$query435 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
				$exec435 = mysql_query($query435) or die ("Error in Query435".mysql_error());
			}
			
		} else if ($fix_percentage < 50) {
			$condition = 'Less Than 50';
			$business_id = '0';
			$add_type = 'TO';
			$level = '1';
			$query381 = "select id,name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level='$level' and business_type='$business_id' and add_type='$add_type'";
			$exec381 = mysql_query($query381) or die ("Error in Query381".mysql_error());
			$res381= mysql_fetch_array($exec381);
			$email = $res381['email'];
			$email_name = $res381['name'];
			$email_id = $res381['id'];
			$body  = '<html>
		          <head>
				  <style>
				  .link_button {
					display: inline-block;
					width: 115px;
					height: 25px;
					background: #4E9CAF;
					padding: 10px;
					text-align: center;
					border-radius: 5px;
					color: white;
					font-weight: bold;
					}
				  </style>
				  </head>
					<body>
						<div>
						<b>Dear '.$email_name.',</b>
						</div> <br /> 
						<div>Please find below the ETI for your approval. Details are as below.</div> <br />
						<div><b>Customer Name :</b> '.$pdf_name.'</div>
						<div><b>Contract / Job Value :</b> '.$price_accept.'</div>
						<div><b>Customer Type :</b> '.$industry_name.'</div><br />
						<div>Product Details:</div><br />'; if ($pest_a != '') {
						$body .= '<div>'.$pest_name_a.' - '.$visit_annum_a.' - '.$annual_value_a.'</div>'; } if ($pest_b != '') {
						$body .= '<div>'.$pest_name_b.' - '.$visit_annum_b.' - '.$annual_value_b.'</div>'; } if ($pest_c != '') {
						$body .= '<div>'.$pest_name_c.' - '.$visit_annum_c.' - '.$annual_value_c.'</div>'; } if ($pest_d != '') {
						$body .= '<div>'.$pest_name_d.' - '.$visit_annum_d.' - '.$annual_value_d.'</div>'; } if ($pest_e != '') {
						$body .= '<div>'.$pest_name_e.' - '.$visit_annum_e.' - '.$annual_value_e.'</div>'; } if ($pest_f != '') {
						$body .= '<div>'.$pest_name_f.' - '.$visit_annum_f.' - '.$annual_value_f.'</div>'; } if ($pest_g != '') {
						$body .= '<div>'.$pest_name_g.' - '.$visit_annum_g.' - '.$annual_value_g.'</div>'; } if ($pest_h != '') {
						$body .= '<div>'.$pest_name_h.' - '.$visit_annum_h.' - '.$annual_value_h.'</div><br />'; } 
						$body .= '<br /><div><b>Gross Margin 1 :</b> '.$percentage.'</div>
						<div><b>Gross Margin 2 :</b> '.$fpercentage.'</div>
						<div><b>Gross Margin without Fixed Costs  :</b> '.$wfpercentage.'</div> <br />
						 <div>
							<a class="link_button" href="'.$base_url.'approve_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Approve</a>
							<a class="link_button" href="'.$base_url.'reject_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Reject</a>
							<a class="link_button" href="'.$base_url.'clarify_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Clarification</a>
						 </div><br />
						 <div> 
						<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b></div>
					</body>
				</html>';
			$subject = "ETI/".$employee_name." - ".substr($pdf_name,0,30)." - ".$eti_date." - ".$postcode_b." for your approval";
			$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPDebug = 0;
			$mail->Mailer = "smtp";
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->Username = "speedasia-sg@rentokil-initial.com"; // SMTP username
			$mail->Password = "hczpdrjeurqfargw"; // SMTP password 
			$Mail->Priority = 1;
			$from_email = 'speedasia-sg@rentokil-initial.com';
			$from_name = 'Speedasia ETI';
			$mail->AddAddress($email,$email_name);
			//$mail->AddCC('krishnadas.warrier@rentokil-initial.com','Krishnadas');
			//$mail->AddCC('pc-eti-sg@rentokil-initial.com','PC ETI');
			//$mail->AddCC($email_cc,$email_name_cc);
			$mail->SetFrom($from_email, $from_name);
			$mail->AddReplyTo($from_email,$from_name);
			$mail->Subject  = $subject;
			$mail->MsgHTML($body);   
			$path = $server_path.'/downloads/eti_pdf/';
			$id_name= "ETI - ".$serial_number;
			$actual_path = $path.$id_name.".pdf";
			$mail->AddAttachment($actual_path);
			if($attachment_a_target != ''){
			$attachement_a = $server_path.'/'.$attachment_a_target;
			$mail->AddAttachment($attachement_a);
			}
			if($attachment_b_target != ''){
			$attachement_b = $server_path.'/'.$attachment_b_target;
			$mail->AddAttachment($attachement_b);
			}
			if($attachment_c_target != ''){
			$attachement_c = $server_path.'/'.$attachment_c_target;
			$mail->AddAttachment($attachement_c);
			}
			if($attachment_d_target != ''){
			$attachement_d = $server_path.'/'.$attachment_d_target;
			$mail->AddAttachment($attachement_d);
			}
			if($attachment_e_target != ''){
			$attachement_e = $server_path.'/'.$attachment_e_target;
			$mail->AddAttachment($attachement_e);
			}
			$mail->Send();
			
			$add_type_cc = 'CC';
			$query391 = "select name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level='$level' and business_type='$business_id' and add_type='$add_type_cc'";
			$exec391 = mysql_query($query391) or die ("Error in Query391".mysql_error());
			$res391 = mysql_fetch_array($exec391);
			$email_cc = $res391['email'];
			$email_name_cc = $res391['name'];
			$body  = '<html>
		          <head>
				  <style>
				  .link_button {
					display: inline-block;
					width: 115px;
					height: 25px;
					background: #4E9CAF;
					padding: 10px;
					text-align: center;
					border-radius: 5px;
					color: white;
					font-weight: bold;
					}
				  </style>
				  </head>
					<body>
						<div>
						<b>Dear '.$email_name_cc.',</b>
						</div> <br /> 
						<div>Please find below the ETI for your approval. Details are as below.</div> <br />
						<div><b>Customer Name :</b> '.$pdf_name.'</div>
						<div><b>Contract / Job Value :</b> '.$price_accept.'</div>
						<div><b>Customer Type :</b> '.$industry_name.'</div><br />
						<div>Product Details:</div><br />'; if ($pest_a != '') {
						$body .= '<div>'.$pest_name_a.' - '.$visit_annum_a.' - '.$annual_value_a.'</div>'; } if ($pest_b != '') {
						$body .= '<div>'.$pest_name_b.' - '.$visit_annum_b.' - '.$annual_value_b.'</div>'; } if ($pest_c != '') {
						$body .= '<div>'.$pest_name_c.' - '.$visit_annum_c.' - '.$annual_value_c.'</div>'; } if ($pest_d != '') {
						$body .= '<div>'.$pest_name_d.' - '.$visit_annum_d.' - '.$annual_value_d.'</div>'; } if ($pest_e != '') {
						$body .= '<div>'.$pest_name_e.' - '.$visit_annum_e.' - '.$annual_value_e.'</div>'; } if ($pest_f != '') {
						$body .= '<div>'.$pest_name_f.' - '.$visit_annum_f.' - '.$annual_value_f.'</div>'; } if ($pest_g != '') {
						$body .= '<div>'.$pest_name_g.' - '.$visit_annum_g.' - '.$annual_value_g.'</div>'; } if ($pest_h != '') {
						$body .= '<div>'.$pest_name_h.' - '.$visit_annum_h.' - '.$annual_value_h.'</div><br />'; } 
						$body .= '<br /><div><b>Gross Margin 1 :</b> '.$percentage.'</div>
						<div><b>Gross Margin 2 :</b> '.$fpercentage.'</div>
						<div><b>Gross Margin without Fixed Costs  :</b> '.$wfpercentage.'</div> <br />
						 <div> 
						<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b></div>
					</body>
				</html>';
			$subject = "ETI/".$employee_name." - ".substr($pdf_name,0,30)." - ".$eti_date." - ".$postcode_b." for your reference";
			$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPDebug = 0;
			$mail->Mailer = "smtp";
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->Username = "speedasia-sg@rentokil-initial.com"; // SMTP username
			$mail->Password = "hczpdrjeurqfargw"; // SMTP password 
			$Mail->Priority = 1;
			$from_email = 'speedasia-sg@rentokil-initial.com';
			$from_name = 'Speedasia ETI';
			$mail->AddAddress($email_cc,$email_name_cc);
			//$mail->AddCC($email_cc,$email_name_cc);
			$mail->SetFrom($from_email, $from_name);
			$mail->AddReplyTo($from_email,$from_name);
			$mail->Subject  = $subject;
			$mail->MsgHTML($body);   
			$path = $server_path.'/downloads/eti_pdf/';
			$id_name= "ETI - ".$serial_number;
			$actual_path = $path.$id_name.".pdf";
			$mail->AddAttachment($actual_path);
			if($attachment_a_target != ''){
			$attachement_a = $server_path.'/'.$attachment_a_target;
			$mail->AddAttachment($attachement_a);
			}
			if($attachment_b_target != ''){
			$attachement_b = $server_path.'/'.$attachment_b_target;
			$mail->AddAttachment($attachement_b);
			}
			if($attachment_c_target != ''){
			$attachement_c = $server_path.'/'.$attachment_c_target;
			$mail->AddAttachment($attachement_c);
			}
			if($attachment_d_target != ''){
			$attachement_d = $server_path.'/'.$attachment_d_target;
			$mail->AddAttachment($attachement_d);
			}
			if($attachment_e_target != ''){
			$attachement_e = $server_path.'/'.$attachment_e_target;
			$mail->AddAttachment($attachement_e);
			}
			$mail->Send();
			
		    $sra_status = 'Pending at '.$email_name;
			$current_date = date('Y-m-d H:i:s');
			
			$query444 = "select id from eti_sra_status where sra_id='$eti_id'";
			$exec444 = mysql_query($query444) or die ("Error in Query444".mysql_error());
			$res444 = mysql_fetch_array($exec444);
			$sra_id = $res444['id'];
			if ($sra_id != '') {
				$query433 = "update eti_sra_status set approve_desc = '$sra_status', approve_date_time = '$current_date',
				approve_email_id='$email',approve_name='$email_name', user_id='$email_id' where id = '$sra_id'";
				$exec433 = mysql_query($query433) or die ("Error in Query433".mysql_error());
			} else {
				$query433 = "insert into eti_sra_status (sra_id,approve_desc,approve_date_time,approve_email_id,approve_name,user_id) 
				values('$eti_id','$sra_status','$current_date','$email','$email_name','$email_id')";
				$exec433 = mysql_query($query433) or die ("Error in Query433".mysql_error());
			}
			
			$drive = new GoogleDrive();
			$query434 = "select id,serial_number,google_drive from eti_sra where id='$eti_id'";
			$exec434 = mysql_query($query434) or die ("Error in Query434".mysql_error());
			$res434= mysql_fetch_array($exec434);
			$drive_serial_number = $res434['serial_number'];
			$fileId  = $res434['google_drive'];
			if ($fileId != '') {
				$file = $drive->removeFileFromFolder($fileId);
				$file = $drive->upload('downloads/eti_pdf/','ETI - '.$drive_serial_number.'.pdf');
				$google_drive_fileid = $file->id;
				$query435 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
				$exec435 = mysql_query($query435) or die ("Error in Query435".mysql_error());
			} else {
				$file = $drive->upload('downloads/eti_pdf/','ETI - '.$drive_serial_number.'.pdf');
				$google_drive_fileid = $file->id;
				$query435 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
				$exec435 = mysql_query($query435) or die ("Error in Query435".mysql_error());
			}
		}
	}
	header ("location:listview.php?st=1");
	
} else if (isset($_POST['save'])){
	$eti_id = $_POST['eti_id'];
	
	$query111 = "DELETE FROM eti_clarify_details where sra_id = '$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	
	$query112 = "DELETE FROM eti_approve_details where sra_id = '$eti_id'";
	$exec112 = mysql_query($query112) or die ("Error in Query112".mysql_error());
	
	$query113 = "DELETE FROM eti_sra_status where sra_id = '$eti_id'";
	$exec113 = mysql_query($query113) or die ("Error in Query113".mysql_error());
	
	$serial_number = $_POST['serial_number'];
	$competitor = $_POST['competitor'];
	$surveyor = $_POST['surveyor'];
	$contract_no = $_POST['contract_no'];
	$industry = $_POST['industry'];
    $eti_date = $_POST['eti_date'];
	$eti_time = $_POST['eti_time'];
	$eti_duration = $_POST['eti_duration'];
	$job_type = $_POST['job_type'];
	$business_type = $_POST['business_type'];
	$name = mysql_real_escape_string($_POST['name']);
	$existing_account = mysql_real_escape_string($_POST['existing_account']);
	$decision_maker = mysql_real_escape_string($_POST['decision_maker']);
	$whom_see = mysql_real_escape_string($_POST['whom_see']);
	$address_a = mysql_real_escape_string($_POST['address_a']);
	$address_b = mysql_real_escape_string($_POST['address_b']);
	$postcode_a = $_POST['postcode_a'];
	$tel_a = $_POST['tel_a'];
	$premises_address_a = mysql_real_escape_string($_POST['premises_address_a']);
	$premises_address_b = mysql_real_escape_string($_POST['premises_address_b']);
	$postcode_b = $_POST['postcode_b'];
	$tel_b = $_POST['tel_b'];
	$email = mysql_real_escape_string($_POST['email']);
	$billing_email = mysql_real_escape_string($_POST['billing_email']);
	$useremail = $_POST['useremail'];
	$infestation = $_POST['infestation'];
	$business_origin = $_POST['business_origin'];
	$referral_name = mysql_real_escape_string($_POST['referral_name']);
	$domestic = $_POST['domestic'];
	$industrial = $_POST['industrial'];
	$commercial = $_POST['commercial'];
	$site_plan_others = mysql_real_escape_string($_POST['site_plan_others']);
	$location = mysql_real_escape_string($_POST['location']);
	$lm = $_POST['lm'];
	$meter = $_POST['meter'];
	$surveyor_name = $_POST['surveyor_name'];
	$litre = $_POST['litre'];
	$chemical = $_POST['chemical'];
	$chemical_other_desc = mysql_real_escape_string($_POST['chemical_other_desc']);
	$sra = $_POST['sra'];
	$surveyor_code = $_POST['surveyor_code'];
	$industry_code = $_POST['industry_code'];
	$business_code = $_POST['business_code'];
	$business_origin_code = $_POST['business_origin_code'];
	$duration = $_POST['duration'];
	$job_duration = $_POST['job_duration'];
	$prospect_no = $_POST['prospect_no'];
	$page_source = $_POST['page_source'];
	
	//$amend = $_POST['amend'];
	if ($job_type == 'Product Sales' || $surveyor ==28 || $surveyor == 35){
		$amend = 'Yes';
	} else if ($job_type == 'Job'){
		$amend = '';
	} else if ($job_type == 'Contract'){
		$amend = $_POST['amend'];
	}
	
	$pest_a = $_POST['pest_a'];
	$pest_b = $_POST['pest_b'];
	$pest_c = $_POST['pest_c'];
	$pest_d = $_POST['pest_d'];
	$pest_e = $_POST['pest_e'];
	$pest_f = $_POST['pest_f'];
	$pest_g = $_POST['pest_g'];
	$pest_h = $_POST['pest_h'];
	$pest_qty_a = $_POST['pest_qty_a'];
	$pest_qty_b = $_POST['pest_qty_b'];
	$pest_qty_c = $_POST['pest_qty_c'];
	$pest_qty_d = $_POST['pest_qty_d'];
	$pest_qty_e = $_POST['pest_qty_e'];
	$pest_qty_f = $_POST['pest_qty_f'];
	$pest_qty_g = $_POST['pest_qty_g'];
	$pest_qty_h = $_POST['pest_qty_h'];
	$instruction_a = mysql_real_escape_string($_POST['instruction_a']);
	$instruction_b = mysql_real_escape_string($_POST['instruction_b']);
	$instruction_c = mysql_real_escape_string($_POST['instruction_c']);
	$instruction_d = mysql_real_escape_string($_POST['instruction_d']);
	$instruction_e = mysql_real_escape_string($_POST['instruction_e']);
	$instruction_f = mysql_real_escape_string($_POST['instruction_f']);
	$instruction_g = mysql_real_escape_string($_POST['instruction_g']);
	$instruction_h = mysql_real_escape_string($_POST['instruction_h']);
	$preparation_a = $_POST['preparation_a'];
	$preparation_b = $_POST['preparation_b'];
	$preparation_c = $_POST['preparation_c'];
	$preparation_d = $_POST['preparation_d'];
	$preparation_e = $_POST['preparation_e'];
	$preparation_f = $_POST['preparation_f'];
	$preparation_g = $_POST['preparation_g'];
	$preparation_h = $_POST['preparation_h'];
	$unit_cost_a = $_POST['unit_cost_a'];
	$unit_cost_b = $_POST['unit_cost_b'];
	$unit_cost_c = $_POST['unit_cost_c'];
	$unit_cost_d = $_POST['unit_cost_d'];
	$unit_cost_e = $_POST['unit_cost_e'];
	$unit_cost_f = $_POST['unit_cost_f'];
	$unit_cost_g = $_POST['unit_cost_g'];
	$unit_cost_h = $_POST['unit_cost_h'];
	$qty_a = $_POST['qty_a'];
	$qty_b = $_POST['qty_b'];
	$qty_c = $_POST['qty_c'];
	$qty_d = $_POST['qty_d'];
	$qty_e = $_POST['qty_e'];
	$qty_f = $_POST['qty_f'];
	$qty_g = $_POST['qty_g'];
	$qty_h = $_POST['qty_h'];
	$tot_val_unit_a = $_POST['tot_val_unit_a'];
	$tot_val_unit_b = $_POST['tot_val_unit_b'];
	$tot_val_unit_c = $_POST['tot_val_unit_c'];
	$tot_val_unit_d = $_POST['tot_val_unit_d'];
	$tot_val_unit_e = $_POST['tot_val_unit_e'];
	$tot_val_unit_f = $_POST['tot_val_unit_f'];
	$tot_val_unit_g = $_POST['tot_val_unit_g'];
	$tot_val_unit_h = $_POST['tot_val_unit_h'];
	$unit_per_tmt_a = $_POST['unit_per_tmt_a'];
	$unit_per_tmt_b = $_POST['unit_per_tmt_b'];
	$unit_per_tmt_c = $_POST['unit_per_tmt_c'];
	$unit_per_tmt_d = $_POST['unit_per_tmt_d'];
	$unit_per_tmt_e = $_POST['unit_per_tmt_e'];
	$unit_per_tmt_f = $_POST['unit_per_tmt_f'];
	$unit_per_tmt_g = $_POST['unit_per_tmt_g'];
	$unit_per_tmt_h = $_POST['unit_per_tmt_h'];
	$tmt_per_annum_a = $_POST['tmt_per_annum_a'];
	$tmt_per_annum_b = $_POST['tmt_per_annum_b'];
	$tmt_per_annum_c = $_POST['tmt_per_annum_c'];
	$tmt_per_annum_d = $_POST['tmt_per_annum_d'];
	$tmt_per_annum_e = $_POST['tmt_per_annum_e'];
	$tmt_per_annum_f = $_POST['tmt_per_annum_f'];
	$tmt_per_annum_g = $_POST['tmt_per_annum_g'];
	$tmt_per_annum_h = $_POST['tmt_per_annum_h'];
	$val_per_annum_a = $_POST['val_per_annum_a'];
	$val_per_annum_b = $_POST['val_per_annum_b'];
	$val_per_annum_c = $_POST['val_per_annum_c'];
	$val_per_annum_d = $_POST['val_per_annum_d'];
	$val_per_annum_e = $_POST['val_per_annum_e'];
	$val_per_annum_f = $_POST['val_per_annum_f'];
	$val_per_annum_g = $_POST['val_per_annum_g'];
	$val_per_annum_h = $_POST['val_per_annum_h'];
	$pest_count_a = $_POST['pest_count_a'];
	$pest_count_b = $_POST['pest_count_b'];
	$pest_count_c = $_POST['pest_count_c'];
	$pest_count_d = $_POST['pest_count_d'];
	$pest_count_e = $_POST['pest_count_e'];
	$pest_count_f = $_POST['pest_count_f'];
	$pest_count_g = $_POST['pest_count_g'];
	$pest_count_h = $_POST['pest_count_h'];
	$shift_type_a = $_POST['shift_type_a'];
	$shift_type_b = $_POST['shift_type_b'];
	$shift_type_c = $_POST['shift_type_c'];
	$shift_type_d = $_POST['shift_type_d'];
	$per_hour_a = $_POST['per_hour_a'];
	$per_hour_b = $_POST['per_hour_b'];
	$per_hour_c = $_POST['per_hour_c'];
	$per_hour_d = $_POST['per_hour_d'];
	$no_hours_a = $_POST['no_hours_a'];
	$no_hours_b = $_POST['no_hours_b'];
	$no_hours_c = $_POST['no_hours_c'];
	$no_hours_d = $_POST['no_hours_d'];
	$total_hours_a = $_POST['total_hours_a'];
	$total_hours_b = $_POST['total_hours_b'];
	$total_hours_c = $_POST['total_hours_c'];
	$total_hours_d = $_POST['total_hours_d'];
	$tmt_hours_a = $_POST['tmt_hours_a'];
	$tmt_hours_b = $_POST['tmt_hours_b'];
	$tmt_hours_c = $_POST['tmt_hours_c'];
	$tmt_hours_d = $_POST['tmt_hours_d'];
	$tmt_annum_a = $_POST['tmt_annum_a'];
	$tmt_annum_b = $_POST['tmt_annum_b'];
	$tmt_annum_c = $_POST['tmt_annum_c'];
	$tmt_annum_d = $_POST['tmt_annum_d'];
	$labour_value_a = $_POST['labour_value_a'];
	$labour_value_b = $_POST['labour_value_b'];
	$labour_value_c = $_POST['labour_value_c'];
	$labour_value_d = $_POST['labour_value_d'];
	$labour_count_a = $_POST['labour_count_a'];
	$labour_count_b = $_POST['labour_count_b'];
	$labour_count_c = $_POST['labour_count_c'];
	$labour_count_d = $_POST['labour_count_d'];
	$type_a = mysql_real_escape_string($_POST['type_a']);
	$type_b = mysql_real_escape_string($_POST['type_b']);
	$other_unit_cost_a = $_POST['other_unit_cost_a'];
	$other_unit_cost_b = $_POST['other_unit_cost_b'];
	$other_item_a = $_POST['other_item_a'];
	$other_item_b = $_POST['other_item_b'];
	$other_tot_val_a = $_POST['other_tot_val_a'];
	$other_tot_val_b = $_POST['other_tot_val_b'];
	$other_tot_item_a = $_POST['other_tot_item_a'];
	$other_tot_item_b = $_POST['other_tot_item_b'];
	$other_tmt_annum_a = $_POST['other_tmt_annum_a'];
	$other_tmt_annum_b = $_POST['other_tmt_annum_b'];
	$other_tot_annum_a = $_POST['other_tot_annum_a'];
	$other_tot_annum_b = $_POST['other_tot_annum_b'];
	$other_count_a = $_POST['other_count_a'];
	$other_count_b = $_POST['other_count_b'];
	$created_by = $_POST['created_by'];
	$modify_by = $_POST['created_by'];
	$date_modify = date("Y-m-d");
	
	$total_unit = $_POST['total_unit'];
	$total_unit_annum = $_POST['total_unit_annum'];
	$total_labour = $_POST['total_labour'];
	$total_labour_annum = $_POST['total_labour_annum'];
	$other_total_a = $_POST['other_total_a'];
	$other_total_b = $_POST['other_total_b'];
	$treatment_a = $_POST['treatment_a'];
	$treatment_b = $_POST['treatment_b'];
	$total_annual_cost = $_POST['total_annual_cost'];
	$price_accept = $_POST['price_accept'];
	$price_accept_tax = $_POST['price_accept_tax'];
	$finance_note = mysql_real_escape_string($_POST['finance_note']);
	$service_note = mysql_real_escape_string($_POST['service_note']);
	$billing_frequency = $_POST['billing_frequency'];
	$credit_term = $_POST['credit_term'];
	$invoice_type = $_POST['invoice_type'];
	$invoice_attachment = $_POST['invoice_attachment'];
	$po_number = $_POST['po_number'];
	
	$total_unit_cost = $_POST['total_unit_cost'];
	$total_unit_cost_annum = $_POST['total_unit_cost_annum'];
	$fix_cost_total_labour = $_POST['fix_cost_total_labour'];
	$wfix_cost_total_labour = $_POST['wfix_cost_total_labour'];
	$fix_cost_total_labour_annum = $_POST['fix_cost_total_labour_annum'];
	$wfix_cost_total_labour_annum = $_POST['wfix_cost_total_labour_annum'];
	$total_percentage = $_POST['total_percentage'];
	$fix_percentage = $_POST['fix_percentage'];
	$wfix_percentage = $_POST['wfix_percentage'];
	
	$unit_selling_a = $_POST['unit_selling_a'];
	$unit_selling_b = $_POST['unit_selling_b'];
	$unit_selling_c = $_POST['unit_selling_c'];
	$unit_selling_d = $_POST['unit_selling_d'];
	$unit_selling_e = $_POST['unit_selling_e'];
	$unit_selling_f = $_POST['unit_selling_f'];
	$unit_selling_g = $_POST['unit_selling_g'];
	$unit_selling_h = $_POST['unit_selling_h'];
	
	$tot_val_cost_a = $_POST['tot_val_cost_a'];
	$tot_val_cost_b = $_POST['tot_val_cost_b'];
	$tot_val_cost_c = $_POST['tot_val_cost_c'];
	$tot_val_cost_d = $_POST['tot_val_cost_d'];
	$tot_val_cost_e = $_POST['tot_val_cost_e'];
	$tot_val_cost_f = $_POST['tot_val_cost_f'];
	$tot_val_cost_g = $_POST['tot_val_cost_g'];
	$tot_val_cost_h = $_POST['tot_val_cost_h'];
	
	$val_per_annum_cost_a = $_POST['val_per_annum_cost_a'];
	$val_per_annum_cost_b = $_POST['val_per_annum_cost_b'];
	$val_per_annum_cost_c = $_POST['val_per_annum_cost_c'];
	$val_per_annum_cost_d = $_POST['val_per_annum_cost_d'];
	$val_per_annum_cost_e = $_POST['val_per_annum_cost_e'];
	$val_per_annum_cost_f = $_POST['val_per_annum_cost_f'];
	$val_per_annum_cost_g = $_POST['val_per_annum_cost_g'];
	$val_per_annum_cost_h = $_POST['val_per_annum_cost_h'];
	
	$fix_cost_per_hour_a = $_POST['fix_cost_per_hour_a'];
	$fix_cost_per_hour_b = $_POST['fix_cost_per_hour_b'];
	$fix_cost_per_hour_c = $_POST['fix_cost_per_hour_c'];
	$fix_cost_per_hour_d = $_POST['fix_cost_per_hour_d'];
	
	$wfix_cost_per_hour_a = $_POST['wfix_cost_per_hour_a'];
	$wfix_cost_per_hour_b = $_POST['wfix_cost_per_hour_b'];
	$wfix_cost_per_hour_c = $_POST['wfix_cost_per_hour_c'];
	$wfix_cost_per_hour_d = $_POST['wfix_cost_per_hour_d'];
	
	$fix_cost_total_hours_a = $_POST['fix_cost_total_hours_a'];
	$fix_cost_total_hours_b = $_POST['fix_cost_total_hours_b'];
	$fix_cost_total_hours_c = $_POST['fix_cost_total_hours_c'];
	$fix_cost_total_hours_d = $_POST['fix_cost_total_hours_d'];
	
	$wfix_cost_total_hours_a = $_POST['wfix_cost_total_hours_a'];
	$wfix_cost_total_hours_b = $_POST['wfix_cost_total_hours_b'];
	$wfix_cost_total_hours_c = $_POST['wfix_cost_total_hours_c'];
	$wfix_cost_total_hours_d = $_POST['wfix_cost_total_hours_d'];
	
	$fix_cost_labour_value_a = $_POST['fix_cost_labour_value_a'];
	$fix_cost_labour_value_b = $_POST['fix_cost_labour_value_b'];
	$fix_cost_labour_value_c = $_POST['fix_cost_labour_value_c'];
	$fix_cost_labour_value_d = $_POST['fix_cost_labour_value_d'];
	
	$wfix_cost_labour_value_a = $_POST['wfix_cost_labour_value_a'];
	$wfix_cost_labour_value_b = $_POST['wfix_cost_labour_value_b'];
	$wfix_cost_labour_value_c = $_POST['wfix_cost_labour_value_c'];
	$wfix_cost_labour_value_d = $_POST['wfix_cost_labour_value_d'];
	
	$visit_annum_a = $_POST['visit_annum_a'];
	$visit_annum_b = $_POST['visit_annum_b'];
	$visit_annum_c = $_POST['visit_annum_c'];
	$visit_annum_d = $_POST['visit_annum_d'];
	$visit_annum_e = $_POST['visit_annum_e'];
	$visit_annum_f = $_POST['visit_annum_f'];
	$visit_annum_g = $_POST['visit_annum_g'];
	$visit_annum_h = $_POST['visit_annum_h'];
	
	$add_freq_a = $_POST['add_freq_a'];
	$add_freq_b = $_POST['add_freq_b'];
	$add_freq_c = $_POST['add_freq_c'];
	$add_freq_d = $_POST['add_freq_d'];
	$add_freq_e = $_POST['add_freq_e'];
	$add_freq_f = $_POST['add_freq_f'];
	$add_freq_g = $_POST['add_freq_g'];
	$add_freq_h = $_POST['add_freq_h'];
	
	$annual_value_a = $_POST['annual_value_a'];
	$annual_value_b = $_POST['annual_value_b'];
	$annual_value_c = $_POST['annual_value_c'];
	$annual_value_d = $_POST['annual_value_d'];
	$annual_value_e = $_POST['annual_value_e'];
	$annual_value_f = $_POST['annual_value_f'];
	$annual_value_g = $_POST['annual_value_g'];
	$annual_value_h = $_POST['annual_value_h'];
	
	$product_count_a = $_POST['product_count_a'];
	$product_count_b = $_POST['product_count_b'];
	$product_count_c = $_POST['product_count_c'];
	$product_count_d = $_POST['product_count_d'];
	$product_count_e = $_POST['product_count_e'];
	$product_count_f = $_POST['product_count_f'];
	$product_count_g = $_POST['product_count_g'];
	$product_count_h = $_POST['product_count_h'];
	
	$attachment_a_filename=basename( $_FILES['attachment_a']['name']);
	$attachment_b_filename=basename( $_FILES['attachment_b']['name']);
	$attachment_c_filename=basename( $_FILES['attachment_c']['name']);
	$attachment_d_filename=basename( $_FILES['attachment_d']['name']);
	$attachment_e_filename=basename( $_FILES['attachment_e']['name']);
	
	if($attachment_a_filename != ''){
		$query33 = "select attachment_a from eti_sra where id='$eti_id'";
		$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
		$res33 = mysql_fetch_array($exec33);
		$filepath_a = $res33['attachment_a'];
		unlink($filepath_a);
		$attachment_a_target = "attachments_a/";
		$attachment_a_target = $attachment_a_target.rand(1000,10000)."-".basename($_FILES['attachment_a']['name']);
		move_uploaded_file($_FILES['attachment_a']['tmp_name'], $attachment_a_target);
	} else {
		$query33 = "select attachment_a from eti_sra where id='$eti_id'";
		$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
		$res33 = mysql_fetch_array($exec33);
		$attachment_a_target = $res33['attachment_a'];
	}
	$attachment_a_target = mysql_real_escape_string($attachment_a_target);
	
	if($attachment_b_filename != ''){
		$query34 = "select attachment_b from eti_sra where id='$eti_id'";
		$exec34 = mysql_query($query34) or die ("Error in Query34".mysql_error());
		$res34 = mysql_fetch_array($exec34);
		$filepath_b = $res34['attachment_b'];
		unlink($filepath_b);
		$attachment_b_target = "attachments_b/";
		$attachment_b_target = $attachment_b_target.rand(1000,10000)."-".basename($_FILES['attachment_b']['name']);
		move_uploaded_file($_FILES['attachment_b']['tmp_name'], $attachment_b_target);
	} else {
		$query34 = "select attachment_b from eti_sra where id='$eti_id'";
		$exec34 = mysql_query($query34) or die ("Error in Query34".mysql_error());
		$res34 = mysql_fetch_array($exec34);
		$attachment_b_target = $res34['attachment_b'];
	}
	$attachment_b_target = mysql_real_escape_string($attachment_b_target);
	
	if($attachment_c_filename != ''){
		$query35 = "select attachment_c from eti_sra where id='$eti_id'";
		$exec35 = mysql_query($query35) or die ("Error in Query35".mysql_error());
		$res35 = mysql_fetch_array($exec35);
		$filepath_c = $res35['attachment_c'];
		unlink($filepath_c);
		$attachment_c_target = "attachments_c/";
		$attachment_c_target = $attachment_c_target.rand(1000,10000)."-".basename($_FILES['attachment_c']['name']);
		move_uploaded_file($_FILES['attachment_c']['tmp_name'], $attachment_c_target);
	} else {
		$query35 = "select attachment_c from eti_sra where id='$eti_id'";
		$exec35 = mysql_query($query35) or die ("Error in Query35".mysql_error());
		$res35 = mysql_fetch_array($exec35);
		$attachment_c_target = $res35['attachment_c'];
	}
	$attachment_c_target = mysql_real_escape_string($attachment_c_target);
	
	if($attachment_d_filename != ''){
		$query36 = "select attachment_d from eti_sra where id='$eti_id'";
		$exec36 = mysql_query($query36) or die ("Error in Query36".mysql_error());
		$res36 = mysql_fetch_array($exec36);
		$filepath_d = $res36['attachment_d'];
		unlink($filepath_d);
		$attachment_d_target = "attachments_d/";
		$attachment_d_target = $attachment_d_target.rand(1000,10000)."-".basename($_FILES['attachment_d']['name']);
		move_uploaded_file($_FILES['attachment_d']['tmp_name'], $attachment_d_target);
	} else {
		$query36 = "select attachment_d from eti_sra where id='$eti_id'";
		$exec36 = mysql_query($query36) or die ("Error in Query36".mysql_error());
		$res36 = mysql_fetch_array($exec36);
		$attachment_d_target = $res36['attachment_d'];
	}
	$attachment_d_target = mysql_real_escape_string($attachment_d_target);
	
	if($attachment_e_filename != ''){
		$query37 = "select attachment_e from eti_sra where id='$eti_id'";
		$exec37 = mysql_query($query37) or die ("Error in Query37".mysql_error());
		$res37 = mysql_fetch_array($exec37);
		$filepath_e = $res37['attachment_e'];
		unlink($filepath_e);
		$attachment_e_target = "attachments_e/";
		$attachment_e_target = $attachment_e_target.rand(1000,10000)."-".basename($_FILES['attachment_e']['name']);
		move_uploaded_file($_FILES['attachment_e']['tmp_name'], $attachment_e_target);
	} else {
		$query37 = "select attachment_e from eti_sra where id='$eti_id'";
		$exec37 = mysql_query($query37) or die ("Error in Query37".mysql_error());
		$res37 = mysql_fetch_array($exec37);
		$attachment_e_target = $res37['attachment_e'];
	}
	$attachment_e_target = mysql_real_escape_string($attachment_e_target);
	
	$query1 = "update eti_sra set serial_number = '$serial_number', competitor_id = '$competitor', 
	           surveyor_id = '$surveyor',contract_no = '$contract_no',industry_id = '$industry',
			   eti_date = '$eti_date',eti_time = '$eti_time',eti_duration = '$eti_duration',
			   job_type = '$job_type',business_type = '$business_type',name = '$name',
			   existing_account = '$existing_account',decision_maker = '$decision_maker',whom_see = '$whom_see',address_a = '$address_a',address_b = '$address_b',postcode_a = '$postcode_a',
			   tel_a = '$tel_a',premises_address_a = '$premises_address_a',premises_address_b = '$premises_address_b',postcode_b = '$postcode_b',tel_b = '$tel_b',email = '$email',billing_email = '$billing_email',useremail = '$useremail',infestation = '$infestation',business_origin = '$business_origin',referral_name = '$referral_name',modify_by = '$modify_by',form_status='0',attachment_a='$attachment_a_target',attachment_b='$attachment_b_target',attachment_c='$attachment_c_target',attachment_d='$attachment_d_target',attachment_e='$attachment_e_target',sra='$sra',surveyor_code='$surveyor_code',business_code='$business_code',business_origin_code='$business_origin_code',industry_code='$industry_code',duration='$duration',job_duration='$job_duration',prospect_no='$prospect_no',amend='$amend',date_modify = '$date_modify',page_source='$page_source'			   
			   where id = '$eti_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	
	$query2 = "update eti_site_plan set sra_id = '$eti_id',domestic = '$domestic', industrial = '$industrial', 
	           commercial = '$commercial',site_plan_others = '$site_plan_others',location = '$location',
			   lm = '$lm',meter = '$meter',surveyor_name = '$surveyor_name',
			   litre = '$litre',chemical = '$chemical',chemical_other_desc = '$chemical_other_desc'
			   where sra_id = '$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	if($pest_a != ''){
		 $query40 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_a'";
		 $exec40 = mysql_query($query40) or die ("Error in Query40".mysql_error());
		 $res40 = mysql_fetch_array($exec40);
		 $check_product_id_a = $res40['id'];
		 if ($check_product_id_a != ''){
		$query41 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_a',qty='$pest_qty_a', instruction = '$instruction_a',visit_annum = '$visit_annum_a',add_freq = '$add_freq_a',
			       annual_value = '$annual_value_a',product_count = '$product_count_a' where sra_id = '$eti_id' and product_count = '$product_count_a'";
		$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
		 } else {
			 $query42 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_a','$pest_qty_a','$instruction_a','$visit_annum_a','$add_freq_a','$annual_value_a','$product_count_a')";
			 $exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
		 }
	}
	
	if($pest_b != ''){
		 $query43 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_b'";
		 $exec43 = mysql_query($query43) or die ("Error in Query43".mysql_error());
		 $res43 = mysql_fetch_array($exec43);
		 $check_product_id_b = $res43['id'];
		 if ($check_product_id_b != ''){
		$query44 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_b',qty='$pest_qty_b', instruction = '$instruction_b',visit_annum = '$visit_annum_b',add_freq = '$add_freq_b',
			       annual_value = '$annual_value_b',product_count = '$product_count_b' where sra_id = '$eti_id' and product_count = '$product_count_b'";
		$exec44 = mysql_query($query44) or die ("Error in Query44".mysql_error());
		 } else {
			 $query45 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_b','$pest_qty_b','$instruction_b','$visit_annum_b','$add_freq_b','$annual_value_b','$product_count_b')";
			 $exec45 = mysql_query($query45) or die ("Error in Query45".mysql_error());
		 }
	}
	
	if($pest_c != ''){
		 $query46 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_c'";
		 $exec46 = mysql_query($query46) or die ("Error in Query46".mysql_error());
		 $res46 = mysql_fetch_array($exec46);
		 $check_product_id_c = $res46['id'];
		 if ($check_product_id_c != ''){
		$query47 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_c',qty='$pest_qty_c', instruction = '$instruction_c',visit_annum = '$visit_annum_c',add_freq = '$add_freq_c',
			       annual_value = '$annual_value_c',product_count = '$product_count_c' where sra_id = '$eti_id' and product_count = '$product_count_c'";
		$exec47 = mysql_query($query47) or die ("Error in Query47".mysql_error());
		 } else {
			 $query48 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_c','$pest_qty_c','$instruction_c','$visit_annum_c','$add_freq_c','$annual_value_c','$product_count_c')";
			 $exec48 = mysql_query($query48) or die ("Error in Query48".mysql_error());
		 }
	}
	
	if($pest_d != ''){
		 $query49 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_d'";
		 $exec49 = mysql_query($query49) or die ("Error in Query49".mysql_error());
		 $res49 = mysql_fetch_array($exec49);
		 $check_product_id_d = $res49['id'];
		 if ($check_product_id_d != ''){
		$query50 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_d',qty='$pest_qty_d', instruction = '$instruction_d',visit_annum = '$visit_annum_d',add_freq = '$add_freq_d',
			       annual_value = '$annual_value_d',product_count = '$product_count_d' where sra_id = '$eti_id' and product_count = '$product_count_d'";
		$exec50 = mysql_query($query50) or die ("Error in Query50".mysql_error());
		 } else {
			 $query51 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_d','$pest_qty_d','$instruction_d','$visit_annum_d','$add_freq_d','$annual_value_d','$product_count_d')";
			 $exec51 = mysql_query($query51) or die ("Error in Query51".mysql_error());
		 }
	}
	
	if($pest_e != ''){
		 $query52 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_e'";
		 $exec52 = mysql_query($query52) or die ("Error in Query52".mysql_error());
		 $res52 = mysql_fetch_array($exec52);
		 $check_product_id_e = $res52['id'];
		 if ($check_product_id_e != ''){
		$query53 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_e',qty='$pest_qty_e', instruction = '$instruction_e',visit_annum = '$visit_annum_e',add_freq = '$add_freq_e',
			       annual_value = '$annual_value_e',product_count = '$product_count_e' where sra_id = '$eti_id' and product_count = '$product_count_e'";
		$exec53 = mysql_query($query53) or die ("Error in Query53".mysql_error());
		 } else {
			 $query54 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_e','$pest_qty_e','$instruction_e','$visit_annum_e','$add_freq_e','$annual_value_e','$product_count_e')";
			 $exec54 = mysql_query($query54) or die ("Error in Query54".mysql_error());
		 }
	}
	
	if($pest_f != ''){
		 $query55 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_f'";
		 $exec55 = mysql_query($query55) or die ("Error in Query55".mysql_error());
		 $res55 = mysql_fetch_array($exec55);
		 $check_product_id_f = $res55['id'];
		 if ($check_product_id_f != ''){
		$query56 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_f',qty='$pest_qty_f', instruction = '$instruction_f',visit_annum = '$visit_annum_f',add_freq = '$add_freq_f',
			       annual_value = '$annual_value_f',product_count = '$product_count_f' where sra_id = '$eti_id' and product_count = '$product_count_f'";
		$exec56 = mysql_query($query56) or die ("Error in Query56".mysql_error());
		 } else {
			 $query57 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_f','$pest_qty_f','$instruction_f','$visit_annum_f','$add_freq_f','$annual_value_f','$product_count_f')";
			 $exec57 = mysql_query($query57) or die ("Error in Query57".mysql_error());
		 }
	}
	if($pest_g != ''){
		 $query58 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_g'";
		 $exec58 = mysql_query($query58) or die ("Error in Query58".mysql_error());
		 $res58 = mysql_fetch_array($exec58);
		 $check_product_id_g = $res58['id'];
		 if ($check_product_id_g != ''){
		$query59 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_g',qty='$pest_qty_g', instruction = '$instruction_g',visit_annum = '$visit_annum_g',add_freq = '$add_freq_g',
			       annual_value = '$annual_value_g',product_count = '$product_count_g' where sra_id = '$eti_id' and product_count = '$product_count_g'";
		$exec59 = mysql_query($query59) or die ("Error in Query59".mysql_error());
		 } else {
			 $query60 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_g','$pest_qty_g','$instruction_g','$visit_annum_g','$add_freq_g','$annual_value_g','$product_count_g')";
			 $exec60 = mysql_query($query60) or die ("Error in Query60".mysql_error());
		 }
	}
	
	if($pest_h != ''){
		 $query61 = "select id from eti_product_details where sra_id = '$eti_id' and product_count = '$product_count_h'";
		 $exec61 = mysql_query($query61) or die ("Error in Query61".mysql_error());
		 $res61 = mysql_fetch_array($exec61);
		 $check_product_id_h = $res61['id'];
		 if ($check_product_id_h != ''){
		$query62 = "update eti_product_details set sra_id = '$eti_id',pest_id = '$pest_h',qty='$pest_qty_h', instruction = '$instruction_h',visit_annum = '$visit_annum_h',add_freq = '$add_freq_h',
			       annual_value = '$annual_value_h',product_count = '$product_count_h' where sra_id = '$eti_id' and product_count = '$product_count_h'";
		$exec62 = mysql_query($query62) or die ("Error in Query62".mysql_error());
		 } else {
			 $query63 = "insert into eti_product_details (sra_id,pest_id,qty,instruction,visit_annum,add_freq,annual_value,product_count) 
	           values('$eti_id','$pest_h','$pest_qty_h','$instruction_h','$visit_annum_h','$add_freq_h','$annual_value_h','$product_count_h')";
			 $exec63 = mysql_query($query63) or die ("Error in Query63".mysql_error());
		 }
	}
	
	if($preparation_a != ''){
		 $query18 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_a'";
		 $exec18 = mysql_query($query18) or die ("Error in Query18".mysql_error());
		 $res18 = mysql_fetch_array($exec18);
		 $check_sra_id_a = $res18['id'];
		 if ($check_sra_id_a != ''){
		$query3 = "update eti_pest_details set sra_id = '$eti_id',preparation_id = '$preparation_a',unit_cost = '$unit_cost_a',qty = '$qty_a',
			   tot_val_unit = '$tot_val_unit_a',unit_per_tmt = '$unit_per_tmt_a',tmt_per_annum = '$tmt_per_annum_a',val_per_annum = '$val_per_annum_a',
			   pest_count = '$pest_count_a',unit_selling = '$unit_selling_a',tot_val_cost = '$tot_val_cost_a',
			   val_per_annum_cost = '$val_per_annum_cost_a' where sra_id = '$eti_id' and pest_count = '$pest_count_a'";
		$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
		 } else {
			 $query3 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_a','$unit_cost_a','$qty_a','$tot_val_unit_a','$unit_per_tmt_a',
			          '$tmt_per_annum_a','$val_per_annum_a','$pest_count_a','$unit_selling_a','$tot_val_cost_a','$val_per_annum_cost_a')";
			 $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
		 }
	}
	
	if($preparation_b != ''){
		 $query19 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_b'";
		 $exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
		 $res19 = mysql_fetch_array($exec19);
		 $check_sra_id_b = $res19['id'];
		 if ($check_sra_id_b != ''){
		$query4 = "update eti_pest_details set sra_id = '$eti_id',preparation_id = '$preparation_b',unit_cost = '$unit_cost_b',qty = '$qty_b',
			   tot_val_unit = '$tot_val_unit_b',unit_per_tmt='$unit_per_tmt_b',tmt_per_annum = '$tmt_per_annum_b',val_per_annum = '$val_per_annum_b',
			   pest_count = '$pest_count_b',unit_selling = '$unit_selling_b',tot_val_cost = '$tot_val_cost_b',
			   val_per_annum_cost = '$val_per_annum_cost_b' where sra_id = '$eti_id' and pest_count = '$pest_count_b'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		 } else {
		$query4 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_b','$unit_cost_b','$qty_b','$tot_val_unit_b','$unit_per_tmt_b',
			          '$tmt_per_annum_b','$val_per_annum_b','$pest_count_b','$unit_selling_b','$tot_val_cost_b','$val_per_annum_cost_b')";
	    $exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		 }
	}
	
	if($preparation_c != ''){
		 $query20 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_c'";
		 $exec20 = mysql_query($query20) or die ("Error in Query20".mysql_error());
		 $res20 = mysql_fetch_array($exec20);
		 $check_sra_id_c = $res20['id'];
		 if ($check_sra_id_c != ''){
		$query5 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_c',unit_cost = '$unit_cost_c',qty = '$qty_c',
			   tot_val_unit = '$tot_val_unit_c',unit_per_tmt = '$unit_per_tmt_c',tmt_per_annum = '$tmt_per_annum_c',val_per_annum = '$val_per_annum_c',
			   pest_count = '$pest_count_c',unit_selling = '$unit_selling_c',tot_val_cost = '$tot_val_cost_c',
			   val_per_annum_cost = '$val_per_annum_cost_c' where sra_id = '$eti_id' and pest_count = '$pest_count_c'";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		 } else {
		$query5 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_c','$unit_cost_c','$qty_c','$tot_val_unit_c','$unit_per_tmt_c',
			          '$tmt_per_annum_c','$val_per_annum_c','$pest_count_c','$unit_selling_c','$tot_val_cost_c','$val_per_annum_cost_c')";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		 }
	}
	
	if($preparation_d != ''){
		 $query21 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_d'";
		 $exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
		 $res21 = mysql_fetch_array($exec21);
		 $check_sra_id_d = $res21['id'];
		 if ($check_sra_id_d != ''){
		$query6 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_d',unit_cost = '$unit_cost_d',qty = '$qty_d',
			   tot_val_unit = '$tot_val_unit_d',unit_per_tmt = '$unit_per_tmt_d',tmt_per_annum = '$tmt_per_annum_d',val_per_annum = '$val_per_annum_d',
			   pest_count = '$pest_count_d',unit_selling = '$unit_selling_d',tot_val_cost = '$tot_val_cost_d',
			   val_per_annum_cost = '$val_per_annum_cost_d' where sra_id = '$eti_id' and pest_count = '$pest_count_d'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		 } else {
			$query6 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_d','$unit_cost_d','$qty_d','$tot_val_unit_d','$unit_per_tmt_d',
			          '$tmt_per_annum_d','$val_per_annum_d','$pest_count_d','$unit_selling_d','$tot_val_cost_d','$val_per_annum_cost_d')";
			$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		 }
	}
	
	if($preparation_e != ''){
		 $query22 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_e'";
		 $exec22 = mysql_query($query22) or die ("Error in Query22".mysql_error());
		 $res22 = mysql_fetch_array($exec22);
		 $check_sra_id_e = $res22['id'];
		 if ($check_sra_id_e != ''){
		$query7 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_e',unit_cost = '$unit_cost_e',qty = '$qty_e',
			   tot_val_unit = '$tot_val_unit_e',unit_per_tmt = '$unit_per_tmt_e',tmt_per_annum = '$tmt_per_annum_e',val_per_annum = '$val_per_annum_e',
			   pest_count = '$pest_count_e',unit_selling = '$unit_selling_e',tot_val_cost = '$tot_val_cost_e',
			   val_per_annum_cost = '$val_per_annum_cost_e' where sra_id = '$eti_id' and pest_count = '$pest_count_e'";
		$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
		 } else {
			 $query7 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_e','$unit_cost_e','$qty_e','$tot_val_unit_e','$unit_per_tmt_e',
			          '$tmt_per_annum_e','$val_per_annum_e','$pest_count_e','$unit_selling_e','$tot_val_cost_e','$val_per_annum_cost_e')";
			$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
		 }
	}
	
	if($preparation_f != ''){
		 $query23 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_f'";
		 $exec23 = mysql_query($query23) or die ("Error in Query23".mysql_error());
		 $res23 = mysql_fetch_array($exec23);
		 $check_sra_id_f = $res23['id'];
		 if ($check_sra_id_f != ''){
		$query8 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_f',unit_cost = '$unit_cost_f',qty = '$qty_f',
			   tot_val_unit = '$tot_val_unit_f',unit_per_tmt='$unit_per_tmt_f',tmt_per_annum = '$tmt_per_annum_f',val_per_annum = '$val_per_annum_f',
			   pest_count = '$pest_count_f',unit_selling = '$unit_selling_f',tot_val_cost = '$tot_val_cost_f',
			   val_per_annum_cost = '$val_per_annum_cost_f' where sra_id = '$eti_id' and pest_count = '$pest_count_f'";
		$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
		 } else {
			$query8 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_f','$unit_cost_f','$qty_f','$tot_val_unit_f','$unit_per_tmt_f',
			          '$tmt_per_annum_f','$val_per_annum_f','$pest_count_f','$unit_selling_f','$tot_val_cost_f','$val_per_annum_cost_f')";
			$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
		 }
	}
	
	if($preparation_g != ''){
		$query24 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_g'";
		 $exec24 = mysql_query($query24) or die ("Error in Query24".mysql_error());
		 $res24 = mysql_fetch_array($exec24);
		 $check_sra_id_g = $res24['id'];
		 if ($check_sra_id_g != ''){
		$query9 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_g',unit_cost = '$unit_cost_g',qty = '$qty_g',
			   tot_val_unit = '$tot_val_unit_g',unit_per_tmt='$unit_per_tmt_g',tmt_per_annum = '$tmt_per_annum_g',val_per_annum = '$val_per_annum_g',
			   pest_count = '$pest_count_g',unit_selling = '$unit_selling_g',tot_val_cost = '$tot_val_cost_g',
			   val_per_annum_cost = '$val_per_annum_cost_g' where sra_id = '$eti_id' and pest_count = '$pest_count_g'";
		$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
		 } else {
			 $query9 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_g','$unit_cost_g','$qty_g','$tot_val_unit_g','$unit_per_tmt_g',
			          '$tmt_per_annum_g','$val_per_annum_g','$pest_count_g','$unit_selling_g','$tot_val_cost_g','$val_per_annum_cost_g')";
	        $exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
		 }
	}
	
	if($preparation_h != ''){
		 $query25 = "select id from eti_pest_details where sra_id = '$eti_id' and pest_count = '$pest_count_h'";
		 $exec25 = mysql_query($query25) or die ("Error in Query25".mysql_error());
		 $res25 = mysql_fetch_array($exec25);
		 $check_sra_id_h = $res25['id'];
		 if ($check_sra_id_h != ''){
		$query10 = "update eti_pest_details set sra_id = '$eti_id', 
	           preparation_id = '$preparation_h',unit_cost = '$unit_cost_h',qty = '$qty_h',
			   tot_val_unit = '$tot_val_unit_h',unit_per_tmt = '$unit_per_tmt_h',tmt_per_annum = '$tmt_per_annum_h',val_per_annum = '$val_per_annum_h',
			   pest_count = '$pest_count_h',unit_selling = '$unit_selling_h',tot_val_cost = '$tot_val_cost_h',
			   val_per_annum_cost = '$val_per_annum_cost_h' where sra_id = '$eti_id' and pest_count = '$pest_count_h'";
		$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
		 } else {
			$query10 = "insert into eti_pest_details (sra_id,preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,
	                                      val_per_annum,pest_count,unit_selling,tot_val_cost,val_per_annum_cost) 
	           values('$eti_id','$preparation_h','$unit_cost_h','$qty_h','$tot_val_unit_h','$unit_per_tmt_h',
			          '$tmt_per_annum_h','$val_per_annum_h','$pest_count_h','$unit_selling_h','$tot_val_cost_h','$val_per_annum_cost_h')";
			$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
		 }
	}
	
	if($shift_type_a != ''){
		$query26 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_a'";
		 $exec26 = mysql_query($query26) or die ("Error in Query26".mysql_error());
		 $res26 = mysql_fetch_array($exec26);
		 $check_shift_id_a = $res26['id'];
		 if ($check_shift_id_a != ''){
		$query11 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_a', per_hour = '$per_hour_a', 
	           no_hours = '$no_hours_a',total_hours = '$total_hours_a',tmt_hours = '$tmt_hours_a',
			   tmt_annum = '$tmt_annum_a',labour_value = '$labour_value_a',labour_count = '$labour_count_a',
			   fix_cost_per_hour = '$fix_cost_per_hour_a',wfix_cost_per_hour = '$wfix_cost_per_hour_a',fix_cost_total_hours = '$fix_cost_total_hours_a',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_a',fix_cost_labour_value = '$fix_cost_labour_value_a',wfix_cost_labour_value = '$wfix_cost_labour_value_a'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_a'";
		$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
		 } else {
	    $query11 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_a','$per_hour_a','$no_hours_a','$total_hours_a','$tmt_hours_a','$tmt_annum_a',
			          '$labour_value_a','$labour_count_a','$fix_cost_per_hour_a','$wfix_cost_per_hour_a','$fix_cost_total_hours_a',
					  '$wfix_cost_total_hours_a','$fix_cost_labour_value_a','$wfix_cost_labour_value_a')";
		$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
		 }
	}
	
	if($shift_type_b != ''){
		$query27 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_b'";
		 $exec27 = mysql_query($query27) or die ("Error in Query27".mysql_error());
		 $res27 = mysql_fetch_array($exec27);
		 $check_shift_id_b = $res27['id'];
		 if ($check_shift_id_b != ''){
		$query12 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_b', per_hour = '$per_hour_b', 
	           no_hours = '$no_hours_b',total_hours = '$total_hours_b',tmt_hours = '$tmt_hours_b',
			   tmt_annum = '$tmt_annum_b',labour_value = '$labour_value_b',labour_count = '$labour_count_b',
			   fix_cost_per_hour = '$fix_cost_per_hour_b',wfix_cost_per_hour = '$wfix_cost_per_hour_b',fix_cost_total_hours = '$fix_cost_total_hours_b',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_b',fix_cost_labour_value = '$fix_cost_labour_value_b',wfix_cost_labour_value = '$wfix_cost_labour_value_b'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_b'";
		$exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
		 } else {
			 $query12 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_b','$per_hour_b','$no_hours_b','$total_hours_b','$tmt_hours_b','$tmt_annum_b',
			          '$labour_value_b','$labour_count_b','$fix_cost_per_hour_b','$wfix_cost_per_hour_b','$fix_cost_total_hours_b',
					  '$wfix_cost_total_hours_b','$fix_cost_labour_value_b','$wfix_cost_labour_value_b')";
			$exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
		 }
	}
	
	if($shift_type_c != ''){
		$query28 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_c'";
		 $exec28 = mysql_query($query28) or die ("Error in Query27".mysql_error());
		 $res28 = mysql_fetch_array($exec28);
		 $check_shift_id_c = $res28['id'];
		 if ($check_shift_id_c != ''){
		$query13 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_c', per_hour = '$per_hour_c', 
	           no_hours = '$no_hours_c',total_hours = '$total_hours_c',tmt_hours = '$tmt_hours_c',
			   tmt_annum = '$tmt_annum_c',labour_value = '$labour_value_c',labour_count = '$labour_count_c',
			   fix_cost_per_hour = '$fix_cost_per_hour_c',wfix_cost_per_hour = '$wfix_cost_per_hour_c',fix_cost_total_hours = '$fix_cost_total_hours_c',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_c',fix_cost_labour_value = '$fix_cost_labour_value_c',wfix_cost_labour_value = '$wfix_cost_labour_value_c'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_c'";
		$exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
		 } else {
			 $query13 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_c','$per_hour_c','$no_hours_c','$total_hours_c','$tmt_hours_c','$tmt_annum_c',
			          '$labour_value_c','$labour_count_c','$fix_cost_per_hour_c','$wfix_cost_per_hour_c','$fix_cost_total_hours_c',
					  '$wfix_cost_total_hours_c','$fix_cost_labour_value_c','$wfix_cost_labour_value_c')";
			$exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
		 }
	}
	
	if($shift_type_d != ''){
		$query29 = "select id from eti_labour_details where sra_id = '$eti_id' and labour_count = '$labour_count_d'";
		 $exec29 = mysql_query($query29) or die ("Error in Query29".mysql_error());
		 $res29 = mysql_fetch_array($exec29);
		 $check_shift_id_d = $res29['id'];
		 if ($check_shift_id_d != ''){
		$query14 = "update eti_labour_details set sra_id = '$eti_id',shift_type = '$shift_type_d', per_hour = '$per_hour_d', 
	           no_hours = '$no_hours_d',total_hours = '$total_hours_d',tmt_hours = '$tmt_hours_d',
			   tmt_annum = '$tmt_annum_d',labour_value = '$labour_value_d',labour_count = '$labour_count_d',
			   fix_cost_per_hour = '$fix_cost_per_hour_d',wfix_cost_per_hour = '$wfix_cost_per_hour_d',fix_cost_total_hours = '$fix_cost_total_hours_d',
			   wfix_cost_total_hours = '$wfix_cost_total_hours_d',fix_cost_labour_value = '$fix_cost_labour_value_d',wfix_cost_labour_value = '$wfix_cost_labour_value_d'
			   where sra_id = '$eti_id' and labour_count = '$labour_count_d'";
		$exec14 = mysql_query($query14) or die ("Error in Query14".mysql_error());
		 } else {
			$query14 = "insert into eti_labour_details (sra_id,shift_type,per_hour,no_hours,total_hours,tmt_hours,tmt_annum,labour_value,
	                                            labour_count,fix_cost_per_hour,wfix_cost_per_hour,fix_cost_total_hours,wfix_cost_total_hours,
												fix_cost_labour_value,wfix_cost_labour_value) 
	           values('$eti_id','$shift_type_d','$per_hour_d','$no_hours_d','$total_hours_d','$tmt_hours_d','$tmt_annum_d',
			          '$labour_value_d','$labour_count_d','$fix_cost_per_hour_d','$wfix_cost_per_hour_d','$fix_cost_total_hours_d',
					  '$wfix_cost_total_hours_d','$fix_cost_labour_value_d','$wfix_cost_labour_value_d')";
			$exec14 = mysql_query($query14) or die ("Error in Query14".mysql_error());
		 }
	}
	
	if($type_a != '') {
		 $query30 = "select id from eti_other_details where sra_id = '$eti_id' and other_count = '$other_count_a'";
		 $exec30 = mysql_query($query30) or die ("Error in Query30".mysql_error());
		 $res30 = mysql_fetch_array($exec30);
		 $check_type_id_a = $res30['id'];
		 if ($check_type_id_a != ''){
		$query15 = "update eti_other_details set sra_id = '$eti_id',type = '$type_a', other_unit_cost = '$other_unit_cost_a', 
	           other_item = '$other_item_a',other_tot_val = '$other_tot_val_a',other_tot_item = '$other_tot_item_a',
			   other_tmt_annum = '$other_tmt_annum_a',other_tot_annum = '$other_tot_annum_a',other_count = '$other_count_a'
			   where sra_id = '$eti_id' and other_count = '$other_count_a'";
		$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
		 } else {
		$query15 = "insert into eti_other_details (sra_id,type,other_unit_cost,other_item,other_tot_val,other_tot_item,
		            other_tmt_annum,other_tot_annum,other_count) 
					values('$eti_id','$type_a','$other_unit_cost_a','$other_item_a','$other_tot_val_a','$other_tot_item_a',
					'$other_tmt_annum_a','$other_tot_annum_a','$other_count_a')";
		$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
		 }
	}
	
	if($type_b != '') {
		 $query31 = "select id from eti_other_details where sra_id = '$eti_id' and other_count = '$other_count_b'";
		 $exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
		 $res31 = mysql_fetch_array($exec31);
		 $check_type_id_b = $res31['id'];
		 if ($check_type_id_b != ''){
		$query16 = "update eti_other_details set sra_id = '$eti_id',type = '$type_b', other_unit_cost = '$other_unit_cost_b', 
				   other_item = '$other_item_b',other_tot_val = '$other_tot_val_b',other_tot_item = '$other_tot_item_b',
				   other_tmt_annum = '$other_tmt_annum_b',other_tot_annum = '$other_tot_annum_b',other_count = '$other_count_b'
				   where sra_id = '$eti_id' and other_count = '$other_count_b'";
		$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
		 } else {
		$query16 = "insert into eti_other_details (sra_id,type,other_unit_cost,other_item,other_tot_val,other_tot_item,other_tmt_annum,other_tot_annum,
	                                            other_count) 
	           values('$eti_id','$type_b','$other_unit_cost_b','$other_item_b','$other_tot_val_b','$other_tot_item_b','$other_tmt_annum_b',
			          '$other_tot_annum_b','$other_count_b')";
		$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
		 }
	}
	
	$query17 = "update eti_total_details set total_unit = '$total_unit', total_unit_annum = '$total_unit_annum', 
	           total_labour = '$total_labour',total_labour_annum = '$total_labour_annum',other_total_a = '$other_total_a',
			   other_total_b = '$other_total_b',treatment_a = '$treatment_a',treatment_b = '$treatment_b',
			   total_annual_cost = '$total_annual_cost',price_accept = '$price_accept',price_accept_tax = '$price_accept_tax',
			   finance_note = '$finance_note',service_note = '$service_note',billing_frequency = '$billing_frequency',credit_term='$credit_term',invoice_type='$invoice_type',invoice_attachment = '$invoice_attachment',po_number = '$po_number',total_unit_cost = '$total_unit_cost',total_unit_cost_annum = '$total_unit_cost_annum',fix_cost_total_labour = '$fix_cost_total_labour',
			   wfix_cost_total_labour = '$wfix_cost_total_labour',fix_cost_total_labour_annum = '$fix_cost_total_labour_annum',wfix_cost_total_labour_annum = '$wfix_cost_total_labour_annum',
			   total_percentage = '$total_percentage',fix_percentage = '$fix_percentage',wfix_percentage = '$wfix_percentage'
			   where sra_id = '$eti_id'";
	$exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
	header ("location:listview.php");
}
?>
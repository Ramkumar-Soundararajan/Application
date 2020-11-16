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
	$infestation = $_POST['infestation'];
	$business_origin = $_POST['business_origin'];
	$referral_name = mysql_real_escape_string($_POST['referral_name']);
	//$sra = $_POST['sra'];
	$surveyor_code = $_POST['surveyor_code'];
	$business_code = $_POST['business_code'];
	$industry_code = $_POST['industry_code'];
	$business_origin_code = $_POST['business_origin_code'];
	$duration = $_POST['duration'];
	$job_duration = $_POST['job_duration'];
	$prospect_no = $_POST['prospect_no'];
	$page_source = $_POST['page_source'];
	
	$query1 = "select * from eti_sra where id='$eti_id'";
    $exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$act_competitor = $res1['competitor_id'];
	$act_surveyor = $res1['surveyor_id'];
	$act_contract_no = $res1['contract_no'];
	$act_industry = $res1['industry_id'];
	$act_eti_date = $res1['eti_date'];
	$act_eti_time = $res1['eti_time'];
	$act_eti_duration = $res1['eti_duration'];
	$act_job_type = $res1['job_type'];
	$act_business_type = $res1['business_type'];
	$act_name = $res1['name'];
	$act_existing_account = $res1['existing_account'];
	$act_decision_maker = $res1['decision_maker'];
	$act_whom_see = $res1['whom_see'];
	$act_address_a = $res1['address_a'];
	$act_address_b = $res1['address_b'];
	$act_postcode_a = $res1['postcode_a'];
	$act_tel_a = $res1['tel_a'];
	$act_premises_address_a = $res1['premises_address_a'];
	$act_premises_address_b = $res1['premises_address_b'];
	$act_postcode_b = $res1['postcode_b'];
	$act_tel_b = $res1['tel_b'];
	$act_email = $res1['email'];
	$act_billing_email = $res1['billing_email'];
	$act_infestation = $res1['infestation'];
	$act_business_origin = $res1['business_origin'];
	$act_referral_name = $res1['referral_name'];
	$act_surveyor_code = $res1['surveyor_code'];
	$act_business_code = $res1['business_code'];
	$act_business_origin_code = $res1['business_origin_code'];
	$act_duration = $res1['duration'];
	$act_job_duration = $res1['job_duration'];
	$act_industry_code = $res1['industry_code'];
	$act_prospect_no = $res1['prospect_no'];
	//$act_sra = $res1['sra'];
	
	if($act_competitor == $competitor) {$up_competitor = $act_competitor; }else{$up_competitor = $competitor;}
	if($act_surveyor == $surveyor) {$up_surveyor = $act_surveyor; }else{$up_surveyor = $surveyor;}
	if($act_contract_no == $contract_no) {$up_contract_no = $act_contract_no; }else{$up_contract_no = $contract_no;}
	if($act_industry == $industry) {$up_industry = $act_industry; }else{$up_industry = $industry;}
	if($act_eti_date == $eti_date) {$up_eti_date = $act_eti_date; }else{$up_eti_date = $eti_date;}
	if($act_eti_time == $eti_time) {$up_eti_time = $act_eti_time; }else{$up_eti_time = $eti_time;}
	if($act_eti_duration == $eti_duration) {$up_eti_duration = $act_eti_duration; }else{$up_eti_duration = $eti_duration;}
	if($act_job_type == $job_type) {$up_job_type = $act_job_type; }else{$up_job_type = $job_type;}
	if($act_business_type == $business_type) {$up_business_type = $act_business_type; }else{$up_business_type = $business_type;}
	if($act_name == $name) {$up_name = $act_name; }else{$up_name = $name;}
	if($act_existing_account == $existing_account) {$up_existing_account = $act_existing_account; }else{$up_existing_account = $existing_account;}
	if($act_decision_maker == $decision_maker) {$up_decision_maker = $act_decision_maker; }else{$up_decision_maker = $decision_maker;}
	if($act_whom_see == $whom_see) {$up_whom_see = $act_whom_see; }else{$up_whom_see = $whom_see;}
	if($act_address_a == $address_a) {$up_address_a = $act_address_a; }else{$up_address_a = $address_a;}
	if($act_address_b == $address_b) {$up_address_b = $act_address_b; }else{$up_address_b = $address_b;}
	if($act_postcode_a == $postcode_a) {$up_postcode_a = $act_postcode_a; }else{$up_postcode_a = $postcode_a;}
	if($act_tel_a == $tel_a) {$up_tel_a = $act_tel_a; }else{$up_tel_a = $tel_a;}
	if($act_premises_address_a == $premises_address_a) {$up_premises_address_a = $act_premises_address_a; }else{$up_premises_address_a = $premises_address_a;}
	if($act_premises_address_b == $premises_address_b) {$up_premises_address_b = $act_premises_address_b; }else{$up_premises_address_b = $premises_address_b;}
	if($act_postcode_b == $postcode_b) {$up_postcode_b = $act_postcode_b; }else{$up_postcode_b = $postcode_b;}
	if($act_tel_b == $tel_b) {$up_tel_b = $act_tel_b; }else{$up_tel_b = $tel_b;}
	if($act_email == $email) {$up_email = $act_email; }else{$up_email = $email;}
	if($act_billing_email == $billing_email) {$up_billing_email = $act_billing_email; }else{$up_billing_email = $billing_email;}
	if($act_infestation == $infestation) {$up_infestation = $act_infestation; }else{$up_infestation = $infestation;}
	if($act_business_origin == $business_origin) {$up_business_origin = $act_business_origin; }else{$up_business_origin = $business_origin;}
	if($act_referral_name == $referral_name) {$up_referral_name = $act_referral_name; }else{$up_referral_name = $referral_name;}
	if($act_surveyor_code == $surveyor_code) {$up_surveyor_code = $act_surveyor_code; }else{$up_surveyor_code = $surveyor_code;}
	if($act_business_code == $business_code) {$up_business_code = $act_business_code; }else{$up_business_code = $business_code;}
	if($act_industry_code == $industry_code) {$up_industry_code = $act_industry_code; }else{$up_industry_code = $industry_code;}
	if($act_business_origin_code == $business_origin_code) {$up_business_origin_code = $act_business_origin_code; }else{$up_business_origin_code = $business_origin_code;}
	if($act_duration == $duration) {$up_duration = $act_duration; }else{$up_duration = $duration;}
	if($act_job_duration == $job_duration) {$up_job_duration = $act_job_duration; }else{$up_job_duration = $job_duration;}
	if($act_prospect_no == $prospect_no) {$up_prospect_no = $act_prospect_no; }else{$up_prospect_no = $prospect_no;}
	//if($act_sra == $sra) {$up_sra = $act_sra; }else{$up_sra = $sra;}
   $pdf_up_name = $up_name;
   $up_name = $up_name;
   $up_existing_account = mysql_real_escape_string($up_existing_account);
   $up_decision_maker = mysql_real_escape_string($up_decision_maker);
   $up_whom_see = mysql_real_escape_string($up_whom_see);
   $up_address_a = mysql_real_escape_string($up_address_a);
   $up_address_b = mysql_real_escape_string($up_address_b);
   $up_premises_address_a = mysql_real_escape_string($up_premises_address_a);
   $up_premises_address_b = mysql_real_escape_string($up_premises_address_b);
   $up_email = mysql_real_escape_string($up_email);
   $up_billing_email = mysql_real_escape_string($up_billing_email);
   $up_referral_name = mysql_real_escape_string($up_referral_name);
  $query2 = "update eti_sra set competitor_id = '$up_competitor', 
	           surveyor_id = '$up_surveyor',contract_no = '$up_contract_no',industry_id = '$up_industry',
			   eti_date = '$up_eti_date',eti_time = '$up_eti_time',eti_duration = '$up_eti_duration',
			   job_type = '$up_job_type',business_type = '$up_business_type',name = '$up_name',
			   existing_account = '$up_existing_account',decision_maker = '$up_decision_maker',
			   whom_see = '$up_whom_see',address_a = '$up_address_a',address_b = '$up_address_b',
			   postcode_a = '$up_postcode_a',tel_a = '$up_tel_a',premises_address_a = '$up_premises_address_a',premises_address_b = '$up_premises_address_b',postcode_b = '$up_postcode_b',tel_b = '$up_tel_b',email = '$up_email',billing_email = '$up_billing_email',infestation = '$up_infestation',business_origin = '$up_business_origin',referral_name = '$up_referral_name',surveyor_code = '$up_surveyor_code',business_code = '$up_business_code',business_origin_code='$up_business_origin_code',industry_code = '$up_industry_code',duration = '$up_duration',job_duration = '$up_job_duration',prospect_no = '$up_prospect_no',page_source = '$page_source' where id = '$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	if($contract_no != '') {
		
	$query3 = "select * from eti_sra where id='$eti_id'";
    $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$serial_number = $res3['serial_number'];
	$competitor_id = $res3['competitor_id'];
	$surveyor_id = $res3['surveyor_id'];
	$contract_no = $res3['contract_no'];
	$industry_id = $res3['industry_id'];
	$eti_date = $res3['eti_date'];
	$eti_time = $res3['eti_time'];
	$eti_duration = $res3['eti_duration'];
	$job_type = $res3['job_type'];
	$business_type = $res3['business_type'];
	$name = $res3['name'];
	$existing_account = $res3['existing_account'];
	$decision_maker = $res3['decision_maker'];
	$whom_see = $res3['whom_see'];
	$address_a = $res3['address_a'];
	$address_b = $res3['address_b'];
	$postcode_a = $res3['postcode_a'];
	$tel_a = $res3['tel_a'];
	$premises_address_a = $res3['premises_address_a'];
	$premises_address_b = $res3['premises_address_b'];
	$postcode_b = $res3['postcode_b'];
	$tel_b = $res3['tel_b'];
	$email = $res3['email'];
	$billing_email = $res3['billing_email'];
	$infestation = $res3['infestation'];
	$business_origin = $res3['business_origin'];
	$referral_name = $res3['referral_name'];
	$useremail = $res3['useremail'];
	$created_by = $res3['created_by'];
	$attachment_a_target = $res3['attachment_a'];
	$attachment_b_target = $res3['attachment_b'];
	$attachment_c_target = $res3['attachment_c'];
	$attachment_d_target = $res3['attachment_d'];
	$attachment_e_target = $res3['attachment_e'];
	$sra = $res3['sra'];
	
	$query388 = "select employee_name,user_mail from eti_portal_user where id='$created_by'";
	$exec388 = mysql_query($query388) or die ("Error in Query388".mysql_error());
	$res388 = mysql_fetch_array($exec388);
	$employee_name = $res388['employee_name'];
	$employee_email = $res388['user_mail'];
	
	$query4 = "select * from eti_site_plan where sra_id='$eti_id'";
    $exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$domestic = $res4['domestic'];
	$industrial = $res4['industrial'];
	$commercial = $res4['commercial'];
	$site_plan_others = $res4['site_plan_others'];
	$location = $res4['location'];
	$lm = $res4['lm'];
	$meter = $res4['meter'];
	$surveyor_name = $res4['surveyor_name'];
	$litre = $res4['litre'];
	$chemical = $res4['chemical'];
	$chemical_other_desc = $res4['chemical_other_desc'];
	
	$query5 = "select * from eti_total_details where sra_id='$eti_id'";
    $exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
	$res5 = mysql_fetch_array($exec5);
	$total_unit = $res5['total_unit'];
	$total_unit_annum = $res5['total_unit_annum'];
	$total_labour = $res5['total_labour'];
	$total_labour_annum = $res5['total_labour_annum'];
	$other_total_a = $res5['other_total_a'];
	$other_total_b = $res5['other_total_b'];
	$treatment_a = $res5['treatment_a'];
	$treatment_b = $res5['treatment_b'];
	$total_annual_cost = $res5['total_annual_cost'];
	$price_accept = $res5['price_accept'];
	$price_accept_tax = $res5['price_accept_tax'];
	$finance_note = $res5['finance_note'];
	$service_note = $res5['service_note'];
	$billing_frequency = $res5['billing_frequency'];
	$credit_term = $res5['credit_term'];
	$invoice_type = $res5['invoice_type'];
	$invoice_attachment = $res5['invoice_attachment'];
	$po_number = $res5['po_number'];
	$total_unit_cost = $res5['total_unit_cost'];
	$total_unit_cost_annum = $res5['total_unit_cost_annum'];
	$fix_cost_total_labour = $res5['fix_cost_total_labour'];
	$wfix_cost_total_labour = $res5['wfix_cost_total_labour'];
	$fix_cost_total_labour_annum = $res5['fix_cost_total_labour_annum'];
	$wfix_cost_total_labour_annum = $res5['wfix_cost_total_labour_annum'];
	$total_percentage = $res5['total_percentage'];
	$fix_percentage = $res5['fix_percentage'];
	$wfix_percentage = $res5['wfix_percentage'];
	
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
	
	$query6 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=1";
    $exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$res6 = mysql_fetch_array($exec6);
	$pest_a = $res6['pest_id'];
	$pest_qty_a = $res6['qty'];
	$instruction_a = $res6['instruction'];
	$visit_annum_a = $res6['visit_annum'];
	$add_freq_a = $res6['add_freq'];
	$annual_value_a = $res6['annual_value'];
	
	$query7 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=2";
    $exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$pest_b = $res7['pest_id'];
	$pest_qty_b = $res7['qty'];
	$instruction_b = $res7['instruction'];
	$visit_annum_b = $res7['visit_annum'];
	$add_freq_b = $res7['add_freq'];
	$annual_value_b = $res7['annual_value'];
	
	$query8 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=3";
    $exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
	$res8 = mysql_fetch_array($exec8);
	$pest_c = $res8['pest_id'];
	$pest_qty_c = $res8['qty'];
	$instruction_c = $res8['instruction'];
	$visit_annum_c = $res8['visit_annum'];
	$add_freq_c = $res8['add_freq'];
	$annual_value_c = $res8['annual_value'];
	
	$query9 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=4";
    $exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	$res9 = mysql_fetch_array($exec9);
	$pest_d = $res9['pest_id'];
	$pest_qty_d = $res9['qty'];
	$instruction_d = $res9['instruction'];
	$visit_annum_d = $res9['visit_annum'];
	$add_freq_d = $res9['add_freq'];
	$annual_value_d = $res9['annual_value'];
	
	$query10 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=5";
    $exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
	$res10 = mysql_fetch_array($exec10);
	$pest_e = $res10['pest_id'];
	$pest_qty_e = $res10['qty'];
	$instruction_e = $res10['instruction'];
	$visit_annum_e = $res10['visit_annum'];
	$add_freq_e = $res10['add_freq'];
	$annual_value_e = $res10['annual_value'];
	
	$query11 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=6";
    $exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
	$res11 = mysql_fetch_array($exec11);
	$pest_f = $res11['pest_id'];
	$pest_qty_f = $res11['qty'];
	$instruction_f = $res11['instruction'];
	$visit_annum_f = $res11['visit_annum'];
	$add_freq_f = $res11['add_freq'];
	$annual_value_f = $res11['annual_value'];
	
	$query12 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=7";
    $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
	$res12 = mysql_fetch_array($exec12);
	$pest_g = $res12['pest_id'];
	$pest_qty_g = $res12['qty'];
	$instruction_g = $res12['instruction'];
	$visit_annum_g = $res12['visit_annum'];
	$add_freq_g = $res12['add_freq'];
	$annual_value_g = $res12['annual_value'];
	
	$query13 = "select pest_id,qty,instruction,visit_annum,add_freq,annual_value from eti_product_details where sra_id='$eti_id' and product_count=8";
    $exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
	$res13 = mysql_fetch_array($exec13);
	$pest_h = $res13['pest_id'];
	$pest_qty_h = $res13['qty'];
	$instruction_h = $res13['instruction'];
	$visit_annum_h = $res13['visit_annum'];
	$add_freq_h = $res13['add_freq'];
	$annual_value_h = $res13['annual_value'];
	
	$query14 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=1";
    $exec14 = mysql_query($query14) or die ("Error in Query14".mysql_error());
	$res14 = mysql_fetch_array($exec14);
	$preparation_a = $res14['preparation_id'];
	$unit_cost_a = $res14['unit_cost'];
	$qty_a = $res14['qty'];
	$tot_val_unit_a = $res14['tot_val_unit'];
	$unit_per_tmt_a = $res14['unit_per_tmt'];
	$tmt_per_annum_a = $res14['tmt_per_annum'];
	$val_per_annum_a = $res14['val_per_annum'];
	$unit_selling_a = $res14['unit_selling'];
	$tot_val_cost_a = $res14['tot_val_cost'];
	$val_per_annum_cost_a = $res14['val_per_annum_cost'];
	
	$query15 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=2";
    $exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
	$res15 = mysql_fetch_array($exec15);
	$preparation_b = $res15['preparation_id'];
	$unit_cost_b = $res15['unit_cost'];
	$qty_b = $res15['qty'];
	$tot_val_unit_b = $res15['tot_val_unit'];
	$unit_per_tmt_b = $res15['unit_per_tmt'];
	$tmt_per_annum_b = $res15['tmt_per_annum'];
	$val_per_annum_b = $res15['val_per_annum'];
	$unit_selling_b = $res15['unit_selling'];
	$tot_val_cost_b = $res15['tot_val_cost'];
	$val_per_annum_cost_b = $res15['val_per_annum_cost'];
	
	$query16 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=3";
    $exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
	$res16 = mysql_fetch_array($exec16);
	$preparation_c = $res16['preparation_id'];
	$unit_cost_c = $res16['unit_cost'];
	$qty_c = $res16['qty'];
	$tot_val_unit_c = $res16['tot_val_unit'];
	$unit_per_tmt_c = $res16['unit_per_tmt'];
	$tmt_per_annum_c = $res16['tmt_per_annum'];
	$val_per_annum_c = $res16['val_per_annum'];
	$unit_selling_c = $res16['unit_selling'];
	$tot_val_cost_c = $res16['tot_val_cost'];
	$val_per_annum_cost_c = $res16['val_per_annum_cost'];
	
	$query17 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=4";
    $exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
	$res17 = mysql_fetch_array($exec17);
	$preparation_d = $res17['preparation_id'];
	$unit_cost_d = $res17['unit_cost'];
	$qty_d = $res17['qty'];
	$tot_val_unit_d = $res17['tot_val_unit'];
	$unit_per_tmt_d = $res17['unit_per_tmt'];
	$tmt_per_annum_d = $res17['tmt_per_annum'];
	$val_per_annum_d = $res17['val_per_annum'];
	$unit_selling_d = $res17['unit_selling'];
	$tot_val_cost_d = $res17['tot_val_cost'];
	$val_per_annum_cost_d = $res17['val_per_annum_cost'];
	
	$query18 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=5";
    $exec18 = mysql_query($query18) or die ("Error in Query18".mysql_error());
	$res18 = mysql_fetch_array($exec18);
	$preparation_e = $res18['preparation_id'];
	$unit_cost_e = $res18['unit_cost'];
	$qty_e = $res18['qty'];
	$tot_val_unit_e = $res18['tot_val_unit'];
	$unit_per_tmt_e = $res18['unit_per_tmt'];
	$tmt_per_annum_e = $res18['tmt_per_annum'];
	$val_per_annum_e = $res18['val_per_annum'];
	$unit_selling_e = $res18['unit_selling'];
	$tot_val_cost_e = $res18['tot_val_cost'];
	$val_per_annum_cost_e = $res18['val_per_annum_cost'];
	
	$query19 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=6";
    $exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
	$res19 = mysql_fetch_array($exec19);
	$preparation_f = $res19['preparation_id'];
	$unit_cost_f = $res19['unit_cost'];
	$qty_f = $res19['qty'];
	$tot_val_unit_f = $res19['tot_val_unit'];
	$unit_per_tmt_f = $res19['unit_per_tmt'];
	$tmt_per_annum_f = $res19['tmt_per_annum'];
	$val_per_annum_f = $res19['val_per_annum'];
	$unit_selling_f = $res19['unit_selling'];
	$tot_val_cost_f = $res19['tot_val_cost'];
	$val_per_annum_cost_f = $res19['val_per_annum_cost'];
	
	$query20 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=7";
    $exec20 = mysql_query($query20) or die ("Error in Query20".mysql_error());
	$res20 = mysql_fetch_array($exec20);
	$preparation_g = $res20['preparation_id'];
	$unit_cost_g = $res20['unit_cost'];
	$qty_g = $res20['qty'];
	$tot_val_unit_g = $res20['tot_val_unit'];
	$unit_per_tmt_g = $res20['unit_per_tmt'];
	$tmt_per_annum_g = $res20['tmt_per_annum'];
	$val_per_annum_g = $res20['val_per_annum'];
	$unit_selling_g = $res20['unit_selling'];
	$tot_val_cost_g = $res20['tot_val_cost'];
	$val_per_annum_cost_g = $res20['val_per_annum_cost'];
	
	$query21 = "select preparation_id,unit_cost,qty,tot_val_unit,unit_per_tmt,tmt_per_annum,val_per_annum,unit_selling,tot_val_cost,val_per_annum_cost from eti_pest_details where sra_id='$eti_id' and pest_count=8";
    $exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
	$res21 = mysql_fetch_array($exec21);
	$preparation_h = $res21['preparation_id'];
	$unit_cost_h = $res21['unit_cost'];
	$qty_h = $res21['qty'];
	$tot_val_unit_h = $res21['tot_val_unit'];
	$unit_per_tmt_h = $res21['unit_per_tmt'];
	$tmt_per_annum_h = $res21['tmt_per_annum'];
	$val_per_annum_h = $res21['val_per_annum'];
	$unit_selling_h = $res21['unit_selling'];
	$tot_val_cost_h = $res21['tot_val_cost'];
	$val_per_annum_cost_h = $res21['val_per_annum_cost'];
	
	$query22 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count=1";
    $exec22 = mysql_query($query22) or die ("Error in Query22".mysql_error());
	$res22 = mysql_fetch_array($exec22);
	$shift_type_a = $res22['shift_type'];
	$per_hour_a = $res22['per_hour'];
	$no_hours_a = $res22['no_hours'];
	$total_hours_a = $res22['total_hours'];
	$tmt_hours_a = $res22['tmt_hours'];
	$tmt_annum_a = $res22['tmt_annum'];
	$labour_value_a = $res22['labour_value'];
	$fix_cost_per_hour_a = $res22['fix_cost_per_hour'];
	$wfix_cost_per_hour_a = $res22['wfix_cost_per_hour'];
	$fix_cost_total_hours_a = $res22['fix_cost_total_hours'];
	$wfix_cost_total_hours_a = $res22['wfix_cost_total_hours'];
	$fix_cost_labour_value_a = $res22['fix_cost_labour_value'];
	$wfix_cost_labour_value_a = $res22['wfix_cost_labour_value'];
	
	$query23 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count=2";
    $exec23 = mysql_query($query23) or die ("Error in Query23".mysql_error());
	$res23 = mysql_fetch_array($exec23);
	$shift_type_b = $res23['shift_type'];
	$per_hour_b = $res23['per_hour'];
	$no_hours_b = $res23['no_hours'];
	$total_hours_b = $res23['total_hours'];
	$tmt_hours_b = $res23['tmt_hours'];
	$tmt_annum_b = $res23['tmt_annum'];
	$labour_value_b = $res23['labour_value'];
	$fix_cost_per_hour_b = $res23['fix_cost_per_hour'];
	$wfix_cost_per_hour_b = $res23['wfix_cost_per_hour'];
	$fix_cost_total_hours_b = $res23['fix_cost_total_hours'];
	$wfix_cost_total_hours_b = $res23['wfix_cost_total_hours'];
	$fix_cost_labour_value_b = $res23['fix_cost_labour_value'];
	$wfix_cost_labour_value_b = $res23['wfix_cost_labour_value'];
	
	$query24 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count=3";
    $exec24 = mysql_query($query24) or die ("Error in Query24".mysql_error());
	$res24 = mysql_fetch_array($exec24);
	$shift_type_c = $res24['shift_type'];
	$per_hour_c = $res24['per_hour'];
	$no_hours_c = $res24['no_hours'];
	$total_hours_c = $res24['total_hours'];
	$tmt_hours_c = $res24['tmt_hours'];
	$tmt_annum_c = $res24['tmt_annum'];
	$labour_value_c = $res24['labour_value'];
	$fix_cost_per_hour_c = $res24['fix_cost_per_hour'];
	$wfix_cost_per_hour_c = $res24['wfix_cost_per_hour'];
	$fix_cost_total_hours_c = $res24['fix_cost_total_hours'];
	$wfix_cost_total_hours_c = $res24['wfix_cost_total_hours'];
	$fix_cost_labour_value_c = $res24['fix_cost_labour_value'];
	$wfix_cost_labour_value_c = $res24['wfix_cost_labour_value'];
	
	$query25 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count=4";
    $exec25 = mysql_query($query25) or die ("Error in Query24".mysql_error());
	$res25 = mysql_fetch_array($exec25);
	$shift_type_d = $res25['shift_type'];
	$per_hour_d = $res25['per_hour'];
	$no_hours_d = $res25['no_hours'];
	$total_hours_d = $res25['total_hours'];
	$tmt_hours_d = $res25['tmt_hours'];
	$tmt_annum_d = $res25['tmt_annum'];
	$labour_value_d = $res25['labour_value'];
	$fix_cost_per_hour_d = $res25['fix_cost_per_hour'];
	$wfix_cost_per_hour_d = $res25['wfix_cost_per_hour'];
	$fix_cost_total_hours_d = $res25['fix_cost_total_hours'];
	$wfix_cost_total_hours_d = $res25['wfix_cost_total_hours'];
	$fix_cost_labour_value_d = $res25['fix_cost_labour_value'];
	$wfix_cost_labour_value_d = $res25['wfix_cost_labour_value'];
	
	$query26 = "select * from eti_other_details where sra_id='$eti_id' and other_count=1";
    $exec26 = mysql_query($query26) or die ("Error in Query26".mysql_error());
	$res26 = mysql_fetch_array($exec26);
	$type_a = $res26['type'];
	$other_unit_cost_a = $res26['other_unit_cost'];
	$other_item_a = $res26['other_item'];
	$other_tot_val_a = $res26['other_tot_val'];
	$other_tot_item_a = $res26['other_tot_item'];
	$other_tmt_annum_a = $res26['other_tmt_annum'];
	$other_tot_annum_a = $res26['other_tot_annum'];
	
	$query27 = "select * from eti_other_details where sra_id='$eti_id' and other_count=2";
    $exec27 = mysql_query($query27) or die ("Error in Query27".mysql_error());
	$res27 = mysql_fetch_array($exec27);
	$type_b = $res27['type'];
	$other_unit_cost_b = $res27['other_unit_cost'];
	$other_item_b = $res27['other_item'];
	$other_tot_val_b = $res27['other_tot_val'];
	$other_tot_item_b = $res27['other_tot_item'];
	$other_tmt_annum_b = $res27['other_tmt_annum'];
	$other_tot_annum_b = $res27['other_tot_annum'];
	
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
	
	$query181 = "select competitor_name from eti_competitor where id='$up_competitor'";
	$exec181 = mysql_query($query181) or die ("Error in Query181".mysql_error());
	$res181 = mysql_fetch_array($exec181);
	$competitor_name = $res181['competitor_name'];
	
	$query191 = "select surveyor_name from eti_surveyor where id='$up_surveyor'";
	$exec191 = mysql_query($query191) or die ("Error in Query191".mysql_error());
	$res191 = mysql_fetch_array($exec191);
	$surveyor_name = $res191['surveyor_name'];
	
	$query201 = "select industry_name from eti_industry where id='$up_industry'";
	$exec201 = mysql_query($query201) or die ("Error in Query201".mysql_error());
	$res201 = mysql_fetch_array($exec201);
	$industry_name = $res201['industry_name'];
	
	$query211 = "select business_name from eti_business where id='$up_business_origin'";
	$exec211 = mysql_query($query211) or die ("Error in Query211".mysql_error());
	$res211 = mysql_fetch_array($exec211);
	$business_name = $res211['business_name'];
		
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
		<td>'.$up_contract_no.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$industry_lbl.'</td>
		<td>'.$industry_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$eti_date_lbl.'</td>
		<td>'.$up_eti_date.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$eti_time_lbl.'</td>
		<td>'.$up_eti_time.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$eti_duration_lbl.'</td>
		<td>'.$up_eti_duration.' '.$up_job_type.' '.$up_business_type.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$name_lbl.'</td>
		<td>'.$pdf_up_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$existing_account_lbl.'</td>
		<td>'.$up_existing_account.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$decision_maker_lbl.'</td>
		<td>'.$up_decision_maker.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$whom_see_lbl.'</td>
		<td>'.$up_whom_see.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$address_a_lbl.'</td>
		<td>'.$up_address_a.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$address_b_lbl.'</td>
		<td>'.$up_address_b.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$postcode_a_lbl.'</td>
		<td>'.$up_postcode_a.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$tel_a_lbl.'</td>
		<td>'.$up_tel_a.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_address_a_lbl.'</td>
		<td>'.$up_premises_address_a.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_address_b_lbl.'</td>
		<td>'.$up_premises_address_b.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_postcode_a_lbl.'</td>
		<td>'.$up_postcode_b.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$premises_tel_a_lbl.'</td>
		<td>'.$up_tel_b.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$email_lbl .'</td>
		<td>'.$up_email.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$infestation_lbl.'</td>
		<td>'.$up_infestation.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$business_origin_lbl.'</td>
		<td>'.$business_name.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$referral_name_lbl.'</td>
		<td>'.$up_referral_name.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$sra_sra_lbl.'</td>
		<td>'.$sra.'</td>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$billing_email_lbl.'</td>
		<td>'.$billing_email.'</td>
	</tr>
	<tr>
		<td style="font-weight: bold; background-color: #EEEEEE;">'.$prospect_no_lbl.'</td>
		<td>'.$up_prospect_no.'</td>
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
		<td class="cost">S&#036; '.$unit_per_tmt_a.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_a.'</td>
		<td class="cost">S&#036; '.$val_per_annum_a.'</td>
</tr>'; } if ($preparation_b != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_b.'</td>
		<td class="cost">S&#036; '.$unit_cost_b.'</td>
		<td class="cost">'.$qty_b.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_b.'</td>
		<td class="cost">S&#036; '.$unit_per_tmt_b.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_b.'</td>
		<td class="cost">S&#036; '.$val_per_annum_b.'</td>
</tr>'; } if ($preparation_c != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_c.'</td>
		<td class="cost">S&#036; '.$unit_cost_c.'</td>
		<td class="cost">'.$qty_c.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_c.'</td>
		<td class="cost">S&#036; '.$unit_per_tmt_c.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_c.'</td>
		<td class="cost">S&#036; '.$val_per_annum_c.'</td>
</tr>'; } if ($preparation_d != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_d.'</td>
		<td class="cost">S&#036; '.$unit_cost_d.'</td>
		<td class="cost">'.$qty_d.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_d.'</td>
		<td class="cost">S&#036; '.$unit_per_tmt_d.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_d.'</td>
		<td class="cost">S&#036; '.$val_per_annum_d.'</td>
</tr>'; } if ($preparation_e != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_e.'</td>
		<td class="cost">S&#036; '.$unit_cost_e.'</td>
		<td class="cost">'.$qty_e.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_e.'</td>
		<td class="cost">S&#036; '.$unit_per_tmt_e.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_e.'</td>
		<td class="cost">S&#036; '.$val_per_annum_e.'</td>
</tr>'; } if ($preparation_f != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_f.'</td>
		<td class="cost">S&#036; '.$unit_cost_f.'</td>
		<td class="cost">'.$qty_f.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_f.'</td>
		<td class="cost">S&#036; '.$unit_per_tmt_f.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_f.'</td>
		<td class="cost">S&#036; '.$val_per_annum_f.'</td>
</tr>'; } if ($preparation_g != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_g.'</td>
		<td class="cost">S&#036; '.$unit_cost_g.'</td>
		<td class="cost">'.$qty_g.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_g.'</td>
		<td class="cost">S&#036; '.$unit_per_tmt_g.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_g.'</td>
		<td class="cost">S&#036; '.$val_per_annum_g.'</td>
</tr>'; } if ($preparation_h != '') {
	$html .= ' <tr>
		<td>'.$equipment_name_h.'</td>
		<td class="cost">S&#036; '.$unit_cost_h.'</td>
		<td class="cost">'.$qty_h.'</td>
		<td class="cost">S&#036; '.$tot_val_unit_h.'</td>
		<td class="cost">S&#036; '.$unit_per_tmt_h.'</td>
		<td class="cost">S&#036; '.$tmt_per_annum_h.'</td>
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
		
		$query381 = "select name,email from eti_approve_matrix where mail_condition='Complete'";
	    $exec381 = mysql_query($query381) or die ("Error in Query381".mysql_error());
		$res381= mysql_fetch_array($exec381);
		$email_name_to = $res381['name'];
		$email_to = $res381['email'];
			
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
						<b>Dear '.$email_name_to.',</b>
						</div> <br /> 
						<div>Please find the '.$contract_no.' for the below ETI.</div> <br />
						<div><b>Customer Name :</b> '.$pdf_up_name.'</div>
						<div><b>Contract / Job Number:</b> '.$contract_no.'</div>
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
						$body .= '<br /><div><b>Gross Margin 1 :</b> '.$percentage.'</div><br />
						<div> 
							<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b>
						</div>
					</body>
				</html>';
		$subject = "ETI/".$employee_name." - ".substr($pdf_up_name,0,30)." - ".$eti_date." - ".$postcode_b." for your action";
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
		$mail->AddAddress($email_to,$email_name_to);
		//$mail->AddCC('pc-eti-sg@rentokil-initial.com','PC ETI');
		$mail->AddCC('enquiry.sg@rentokil.com','Enquiry SG');
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
		
		$date_completed = date("Y-m-d");
		
		$query222 = "update eti_sra set form_status = 3,date_completed='$date_completed' where id = '$eti_id'";
		$exec222 = mysql_query($query222) or die ("Error in Query222".mysql_error());
		
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
	header ("location:listview.php");
} else if (isset($_POST['save'])){
	$eti_id = $_POST['eti_id'];
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
	$infestation = $_POST['infestation'];
	$business_origin = $_POST['business_origin'];
	$referral_name = mysql_real_escape_string($_POST['referral_name']);
	$surveyor_code = $_POST['surveyor_code'];
	$business_code = $_POST['business_code'];
	$industry_code = $_POST['industry_code'];
	$business_origin_code = $_POST['business_origin_code'];
	$duration = $_POST['duration'];
	$job_duration = $_POST['job_duration'];
	$prospect_no = $_POST['prospect_no'];
	$sra = $_POST['sra'];
	$page_source = $_POST['page_source'];
	
	$query1 = "select * from eti_sra where id='$eti_id'";
    $exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
    $act_competitor = $res1['competitor_id'];
    $act_surveyor = $res1['surveyor_id'];
	$act_contract_no = $res1['contract_no'];
	$act_industry = $res1['industry_id'];
	$act_eti_date = $res1['eti_date'];
	$act_eti_time = $res1['eti_time'];
	$act_eti_duration = $res1['eti_duration'];
	$act_job_type = $res1['job_type'];
	$act_business_type = $res1['business_type'];
	$act_name = $res1['name'];
	$act_existing_account = $res1['existing_account'];
	$act_decision_maker = $res1['decision_maker'];
	$act_whom_see = $res1['whom_see'];
	$act_address_a = $res1['address_a'];
	$act_address_b = $res1['address_b'];
	$act_postcode_a = $res1['postcode_a'];
	$act_tel_a = $res1['tel_a'];
	$act_premises_address_a = $res1['premises_address_a'];
	$act_premises_address_b = $res1['premises_address_b'];
	$act_postcode_b = $res1['postcode_b'];
	$act_tel_b = $res1['tel_b'];
	$act_email = $res1['email'];
	$act_billing_email = $res1['billing_email'];
	$act_infestation = $res1['infestation'];
	$act_business_origin = $res1['business_origin'];
	$act_referral_name = $res1['referral_name'];
	$act_surveyor_code = $res1['surveyor_code'];
	$act_business_code = $res1['business_code'];
	$act_business_origin_code = $res1['business_origin_code'];
	$act_duration = $res1['duration'];
	$act_job_duration = $res1['job_duration'];
	$act_industry_code = $res1['industry_code'];
	$act_prospect_no = $res1['prospect_no'];
	
	if($act_competitor == $competitor) {$up_competitor = $act_competitor; }else{$up_competitor = $competitor;}
	if($act_surveyor == $surveyor) {$up_surveyor = $act_surveyor; }else{$up_surveyor = $surveyor;}
	if($act_contract_no == $contract_no) {$up_contract_no = $act_contract_no; }else{$up_contract_no = $contract_no;}
	if($act_industry == $industry) {$up_industry = $act_industry; }else{$up_industry = $industry;}
	if($act_eti_date == $eti_date) {$up_eti_date = $act_eti_date; }else{$up_eti_date = $eti_date;}
	if($act_eti_time == $eti_time) {$up_eti_time = $act_eti_time; }else{$up_eti_time = $eti_time;}
	if($act_eti_duration == $eti_duration) {$up_eti_duration = $act_eti_duration; }else{$up_eti_duration = $eti_duration;}
	if($act_job_type == $job_type) {$up_job_type = $act_job_type; }else{$up_job_type = $job_type;}
	if($act_business_type == $business_type) {$up_business_type = $act_business_type; }else{$up_business_type = $business_type;}
	if($act_name == $name) {$up_name = $act_name; }else{$up_name = $name;}
	if($act_existing_account == $existing_account) {$up_existing_account = $act_existing_account; }else{$up_existing_account = $existing_account;}
	if($act_decision_maker == $decision_maker) {$up_decision_maker = $act_decision_maker; }else{$up_decision_maker = $decision_maker;}
	if($act_whom_see == $whom_see) {$up_whom_see = $act_whom_see; }else{$up_whom_see = $whom_see;}
	if($act_address_a == $address_a) {$up_address_a = $act_address_a; }else{$up_address_a = $address_a;}
	if($act_address_b == $address_b) {$up_address_b = $act_address_b; }else{$up_address_b = $address_b;}
	if($act_postcode_a == $postcode_a) {$up_postcode_a = $act_postcode_a; }else{$up_postcode_a = $postcode_a;}
	if($act_tel_a == $tel_a) {$up_tel_a = $act_tel_a; }else{$up_tel_a = $tel_a;}
	if($act_premises_address_a == $premises_address_a) {$up_premises_address_a = $act_premises_address_a; }else{$up_premises_address_a = $premises_address_a;}
	if($act_premises_address_b == $premises_address_b) {$up_premises_address_b = $act_premises_address_b; }else{$up_premises_address_b = $premises_address_b;}
	if($act_postcode_b == $postcode_b) {$up_postcode_b = $act_postcode_b; }else{$up_postcode_b = $postcode_b;}
	if($act_tel_b == $tel_b) {$up_tel_b = $act_tel_b; }else{$up_tel_b = $tel_b;}
	if($act_email == $email) {$up_email = $act_email; }else{$up_email = $email;}
	if($act_billing_email == $billing_email) {$up_billing_email = $act_billing_email; }else{$up_billing_email = $billing_email;}
	if($act_infestation == $infestation) {$up_infestation = $act_infestation; }else{$up_infestation = $infestation;}
	if($act_business_origin == $business_origin) {$up_business_origin = $act_business_origin; }else{$up_business_origin = $business_origin;}
	if($act_referral_name == $referral_name) {$up_referral_name = $act_referral_name; }else{$up_referral_name = $referral_name;}
	if($act_surveyor_code == $surveyor_code) {$up_surveyor_code = $act_surveyor_code; }else{$up_surveyor_code = $surveyor_code;}
	if($act_business_code == $business_code) {$up_business_code = $act_business_code; }else{$up_business_code = $business_code;}
	if($act_industry_code == $industry_code) {$up_industry_code = $act_industry_code; }else{$up_industry_code = $industry_code;}
	if($act_business_origin_code == $business_origin_code) {$up_business_origin_code = $act_business_origin_code; }else{$up_business_origin_code = $business_origin_code;}
	if($act_duration == $duration) {$up_duration = $act_duration; }else{$up_duration = $duration;}
	if($act_job_duration == $job_duration) {$up_job_duration = $act_job_duration; }else{$up_job_duration = $job_duration;}
	if($act_prospect_no == $prospect_no) {$up_prospect_no = $act_prospect_no; }else{$up_prospect_no = $prospect_no;}
	
	$pdf_up_name = $up_name;
	$up_name = $up_name;
	$up_existing_account = mysql_real_escape_string($up_existing_account);
	$up_decision_maker = mysql_real_escape_string($up_decision_maker);
	$up_whom_see = mysql_real_escape_string($up_whom_see);
	$up_address_a = mysql_real_escape_string($up_address_a);
	$up_address_b = mysql_real_escape_string($up_address_b);
	$up_premises_address_a = mysql_real_escape_string($up_premises_address_a);
	$up_premises_address_b = mysql_real_escape_string($up_premises_address_b);
	$up_email = mysql_real_escape_string($up_email);
	$up_billing_email = mysql_real_escape_string($up_billing_email);
	$up_referral_name = mysql_real_escape_string($up_referral_name);
   
   $query2 = "update eti_sra set competitor_id = '$up_competitor', 
	           surveyor_id = '$up_surveyor',contract_no = '$up_contract_no',industry_id = '$up_industry',
			   eti_date = '$up_eti_date',eti_time = '$up_eti_time',eti_duration = '$up_eti_duration',
			   job_type = '$up_job_type',business_type = '$up_business_type',name = '$up_name',
			   existing_account = '$up_existing_account',decision_maker = '$up_decision_maker',
			   whom_see = '$up_whom_see',address_a = '$up_address_a',address_b = '$up_address_b',
			   postcode_a = '$up_postcode_a',tel_a = '$up_tel_a',premises_address_a = '$up_premises_address_a',
			   premises_address_b = '$up_premises_address_b',postcode_b = '$up_postcode_b',tel_b = '$up_tel_b',
			   email = '$up_email',billing_email = '$up_billing_email',infestation = '$up_infestation',business_origin = '$up_business_origin',
			   referral_name = '$up_referral_name',surveyor_code = '$up_surveyor_code',business_code = '$up_business_code',business_origin_code='$up_business_origin_code',industry_code = '$up_industry_code',duration = '$up_duration',job_duration = '$up_job_duration',prospect_no = '$up_prospect_no',page_source = '$page_source' where id = '$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	header ("location:listview.php");
}
?>
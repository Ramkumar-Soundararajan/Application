<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../../PORTAL/index.php");
include ("../db/db_connect.php");
   $eti_id = base64_decode($_GET['eti_id']);
   
   $session_id = $_SESSION['userloginid'];
   $query12 = "select user_mail from eti_portal_user where id = '$session_id'";
   $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
   $res12 = mysql_fetch_array($exec12);
   $user_mail = $res12['user_mail'];
   $menu_title='Add ETI';
   
   if($eti_id !='') {
	$query1 = "select * from eti_sra where id='$eti_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$serial_number =  $res1['serial_number'];
	$comp_id =  $res1['competitor_id'];
	$surv_id =  $res1['surveyor_id'];
	$contract_no =  $res1['contract_no'];
	$indus_id =  $res1['industry_id'];
	$eti_date =  $res1['eti_date'];
	$eti_time =  $res1['eti_time'];
	$eti_duration =  $res1['eti_duration'];
	$job_type =  $res1['job_type'];
	$business_type =  $res1['business_type'];
	$name =  $res1['name'];
	$existing_account =  $res1['existing_account'];
	$decision_maker =  $res1['decision_maker'];
	$whom_see =  $res1['whom_see'];
	$address_a =  $res1['address_a'];
	$address_b =  $res1['address_b'];
	$postcode_a =  $res1['postcode_a'];
	$tel_a =  $res1['tel_a'];
	$premises_address_a =  $res1['premises_address_a'];
	$premises_address_b =  $res1['premises_address_b'];
	$postcode_b =  $res1['postcode_b'];
	$tel_b =  $res1['tel_b'];
	$email =  $res1['email'];
	$billing_email =  $res1['billing_email'];
	$infestation =  $res1['infestation'];
	$business_origin =  $res1['business_origin'];
	$referral_name =  $res1['referral_name'];
	$useremail =  $res1['useremail'];
	$sra =  $res1['sra'];
	$surveyor_code = $res1['surveyor_code'];
	$industry_code = $res1['industry_code'];
	$business_code = $res1['business_code'];
	$business_origin_code = $res1['business_origin_code'];
	$duration = $res1['duration'];
	$job_duration = $res1['job_duration'];
	$prospect_no = $res1['prospect_no'];
	$amend = $res1['amend'];
	
	$attachment_a = $res1['attachment_a'];
	$attachment_b = $res1['attachment_b']; 
	$attachment_c = $res1['attachment_c']; 
	$attachment_d = $res1['attachment_d']; 
	$attachment_e = $res1['attachment_e']; 
	$filename_a = str_replace("attachments_a/","",$attachment_a);
	$filename_b = str_replace("attachments_b/","",$attachment_b);
	$filename_c = str_replace("attachments_c/","",$attachment_c);
	$filename_d = str_replace("attachments_d/","",$attachment_d);
	$filename_e = str_replace("attachments_e/","",$attachment_e);
	
	$query2 = "select * from eti_site_plan where sra_id='$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$domestic =  $res2['domestic'];
	$industrial =  $res2['industrial'];
	$commercial =  $res2['commercial'];
	$site_plan_others =  $res2['site_plan_others'];
	$location =  $res2['location'];
	$lm =  $res2['lm'];
	$meter =  $res2['meter'];
	$surve_name =  $res2['surveyor_name'];
	$litre =  $res2['litre'];
	$chemical =  $res2['chemical'];
	$chemical_other_desc =  $res2['chemical_other_desc'];
	
	$query3 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='1'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$preparation_id_aa = $res3['preparation_id'];
	$unit_cost_aa = $res3['unit_cost'];
	$qty_aa = $res3['qty'];
	$tot_val_unit_aa = $res3['tot_val_unit'];
	$unit_per_tmt_aa = $res3['unit_per_tmt'];
	$tmt_per_annum_aa = $res3['tmt_per_annum'];
	$val_per_annum_aa = $res3['val_per_annum'];
	$pest_count_aa = $res3['pest_count'];
	$unit_selling_aa = $res3['unit_selling'];
	$tot_val_cost_aa = $res3['tot_val_cost'];
	$val_per_annum_cost_aa = $res3['val_per_annum_cost'];
	
	$query4 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='2'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$preparation_id_bb = $res4['preparation_id'];
	$unit_cost_bb = $res4['unit_cost'];
	$qty_bb = $res4['qty'];
	$tot_val_unit_bb = $res4['tot_val_unit'];
	$unit_per_tmt_bb = $res4['unit_per_tmt'];
	$tmt_per_annum_bb = $res4['tmt_per_annum'];
	$val_per_annum_bb = $res4['val_per_annum'];
	$pest_count_bb = $res4['pest_count'];
	$unit_selling_bb = $res4['unit_selling'];
	$tot_val_cost_bb = $res4['tot_val_cost'];
	$val_per_annum_cost_bb = $res4['val_per_annum_cost'];
	
	$query5 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='3'";
	$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
	$res5 = mysql_fetch_array($exec5);
	$preparation_id_cc = $res5['preparation_id'];
	$unit_cost_cc = $res5['unit_cost'];
	$qty_cc = $res5['qty'];
	$tot_val_unit_cc = $res5['tot_val_unit'];
	$unit_per_tmt_cc = $res5['unit_per_tmt'];
	$tmt_per_annum_cc = $res5['tmt_per_annum'];
	$val_per_annum_cc = $res5['val_per_annum'];
	$pest_count_cc = $res5['pest_count'];
	$unit_selling_cc = $res5['unit_selling'];
	$tot_val_cost_cc = $res5['tot_val_cost'];
	$val_per_annum_cost_cc = $res5['val_per_annum_cost'];
	
	$query6 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='4'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$res6 = mysql_fetch_array($exec6);
	$preparation_id_dd = $res6['preparation_id'];
	$unit_cost_dd = $res6['unit_cost'];
	$qty_dd = $res6['qty'];
	$tot_val_unit_dd = $res6['tot_val_unit'];
	$unit_per_tmt_dd = $res6['unit_per_tmt'];
	$tmt_per_annum_dd = $res6['tmt_per_annum'];
	$val_per_annum_dd = $res6['val_per_annum'];
	$pest_count_dd = $res6['pest_count'];
	$unit_selling_dd = $res6['unit_selling'];
	$tot_val_cost_dd = $res6['tot_val_cost'];
	$val_per_annum_cost_dd = $res6['val_per_annum_cost'];
	
	$query7 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='5'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$preparation_id_ee = $res7['preparation_id'];
	$unit_cost_ee = $res7['unit_cost'];
	$qty_ee = $res7['qty'];
	$tot_val_unit_ee = $res7['tot_val_unit'];
	$unit_per_tmt_ee = $res7['unit_per_tmt'];
	$tmt_per_annum_ee= $res7['tmt_per_annum'];
	$val_per_annum_ee = $res7['val_per_annum'];
	$pest_count_ee = $res7['pest_count'];
	$unit_selling_ee = $res7['unit_selling'];
	$tot_val_cost_ee = $res7['tot_val_cost'];
	$val_per_annum_cost_ee = $res7['val_per_annum_cost'];
	
	$query8 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='6'";
	$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
	$res8 = mysql_fetch_array($exec8);
	$preparation_id_ff = $res8['preparation_id'];
	$unit_cost_ff = $res8['unit_cost'];
	$qty_ff = $res8['qty'];
	$tot_val_unit_ff = $res8['tot_val_unit'];
	$unit_per_tmt_ff = $res8['unit_per_tmt'];
	$tmt_per_annum_ff= $res8['tmt_per_annum'];
	$val_per_annum_ff = $res8['val_per_annum'];
	$pest_count_ff = $res8['pest_count'];
	$unit_selling_ff = $res8['unit_selling'];
	$tot_val_cost_ff = $res8['tot_val_cost'];
	$val_per_annum_cost_ff = $res8['val_per_annum_cost'];
	
	$query9 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='7'";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	$res9 = mysql_fetch_array($exec9);
	$preparation_id_gg = $res9['preparation_id'];
	$unit_cost_gg = $res9['unit_cost'];
	$qty_gg = $res9['qty'];
	$tot_val_unit_gg = $res9['tot_val_unit'];
	$unit_per_tmt_gg = $res9['unit_per_tmt'];
	$tmt_per_annum_gg= $res9['tmt_per_annum'];
	$val_per_annum_gg = $res9['val_per_annum'];
	$pest_count_gg = $res9['pest_count'];
	$unit_selling_gg = $res9['unit_selling'];
	$tot_val_cost_gg = $res9['tot_val_cost'];
	$val_per_annum_cost_gg = $res9['val_per_annum_cost'];
	
	$query10 = "select * from eti_pest_details where sra_id='$eti_id' and pest_count='8'";
	$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
	$res10 = mysql_fetch_array($exec10);
	$preparation_id_hh = $res10['preparation_id'];
	$unit_cost_hh = $res10['unit_cost'];
	$qty_hh = $res10['qty'];
	$tot_val_unit_hh = $res10['tot_val_unit'];
	$unit_per_tmt_hh = $res10['unit_per_tmt'];
	$tmt_per_annum_hh= $res10['tmt_per_annum'];
	$val_per_annum_hh = $res10['val_per_annum'];
	$pest_count_hh = $res10['pest_count'];
	$unit_selling_hh = $res10['unit_selling'];
	$tot_val_cost_hh = $res10['tot_val_cost'];
	$val_per_annum_cost_hh = $res10['val_per_annum_cost'];
	
	$query11 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count='1'";
	$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
	$res11 = mysql_fetch_array($exec11);
	$shift_type_aa = $res11['shift_type'];
	$per_hour_aa = $res11['per_hour'];
	$no_hours_aa = $res11['no_hours'];
	$total_hours_aa = $res11['total_hours'];
	$tmt_hours_aa = $res11['tmt_hours'];
	$tmt_annum_aa = $res11['tmt_annum'];
	$labour_value_aa = $res11['labour_value'];
	$labour_count_aa = $res11['labour_count'];
	$fix_cost_per_hour_aa = $res11['fix_cost_per_hour'];
	$wfix_cost_per_hour_aa = $res11['wfix_cost_per_hour'];
	$fix_cost_total_hours_aa = $res11['fix_cost_total_hours'];
	$wfix_cost_total_hours_aa = $res11['wfix_cost_total_hours'];
	$fix_cost_labour_value_aa = $res11['fix_cost_labour_value'];
	$wfix_cost_labour_value_aa = $res11['wfix_cost_labour_value'];
	
	$query13 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count='2'";
	$exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
	$res13 = mysql_fetch_array($exec13);
	$shift_type_bb = $res13['shift_type'];
	$per_hour_bb = $res13['per_hour'];
	$no_hours_bb = $res13['no_hours'];
	$total_hours_bb = $res13['total_hours'];
	$tmt_hours_bb = $res13['tmt_hours'];
	$tmt_annum_bb = $res13['tmt_annum'];
	$labour_value_bb = $res13['labour_value'];
	$labour_count_bb = $res13['labour_count'];
	$fix_cost_per_hour_bb = $res13['fix_cost_per_hour'];
	$wfix_cost_per_hour_bb = $res13['wfix_cost_per_hour'];
	$fix_cost_total_hours_bb = $res13['fix_cost_total_hours'];
	$wfix_cost_total_hours_bb = $res13['wfix_cost_total_hours'];
	$fix_cost_labour_value_bb = $res13['fix_cost_labour_value'];
	$wfix_cost_labour_value_bb = $res13['wfix_cost_labour_value'];
	
	$query14 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count='3'";
	$exec14 = mysql_query($query14) or die ("Error in Query14".mysql_error());
	$res14 = mysql_fetch_array($exec14);
	$shift_type_cc = $res14['shift_type'];
	$per_hour_cc = $res14['per_hour'];
	$no_hours_cc = $res14['no_hours'];
	$total_hours_cc = $res14['total_hours'];
	$tmt_hours_cc = $res14['tmt_hours'];
	$tmt_annum_cc = $res14['tmt_annum'];
	$labour_value_cc = $res14['labour_value'];
	$labour_count_cc = $res14['labour_count'];
	$fix_cost_per_hour_cc = $res14['fix_cost_per_hour'];
	$wfix_cost_per_hour_cc = $res14['wfix_cost_per_hour'];
	$fix_cost_total_hours_cc = $res14['fix_cost_total_hours'];
	$wfix_cost_total_hours_cc = $res14['wfix_cost_total_hours'];
	$fix_cost_labour_value_cc = $res14['fix_cost_labour_value'];
	$wfix_cost_labour_value_cc = $res14['wfix_cost_labour_value'];
	
	$query15 = "select * from eti_labour_details where sra_id='$eti_id' and labour_count='4'";
	$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
	$res15 = mysql_fetch_array($exec15);
	$shift_type_dd = $res15['shift_type'];
	$per_hour_dd = $res15['per_hour'];
	$no_hours_dd = $res15['no_hours'];
	$total_hours_dd = $res15['total_hours'];
	$tmt_hours_dd = $res15['tmt_hours'];
	$tmt_annum_dd = $res15['tmt_annum'];
	$labour_value_dd = $res15['labour_value'];
	$labour_count_dd = $res15['labour_count'];
	$fix_cost_per_hour_dd = $res15['fix_cost_per_hour'];
	$wfix_cost_per_hour_dd = $res15['wfix_cost_per_hour'];
	$fix_cost_total_hours_dd = $res15['fix_cost_total_hours'];
	$wfix_cost_total_hours_dd = $res15['wfix_cost_total_hours'];
	$fix_cost_labour_value_dd = $res15['fix_cost_labour_value'];
	$wfix_cost_labour_value_dd = $res15['wfix_cost_labour_value'];
	
	$query16 = "select * from eti_other_details where sra_id='$eti_id' and other_count='1'";
	$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
	$res16 = mysql_fetch_array($exec16);
	$type_aa = $res16['type'];
	$other_unit_cost_aa = $res16['other_unit_cost'];
	$other_item_aa = $res16['other_item'];
	$other_tot_val_aa = $res16['other_tot_val'];
	$other_tot_item_aa = $res16['other_tot_item'];
	$other_tmt_annum_aa = $res16['other_tmt_annum'];
	$other_tot_annum_aa = $res16['other_tot_annum'];
	$other_count_aa = $res16['other_count'];
	
	$query17 = "select * from eti_other_details where sra_id='$eti_id' and other_count='2'";
	$exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
	$res17 = mysql_fetch_array($exec17);
	$type_bb = $res17['type'];
	$other_unit_cost_bb = $res17['other_unit_cost'];
	$other_item_bb = $res17['other_item'];
	$other_tot_val_bb = $res17['other_tot_val'];
	$other_tot_item_bb = $res17['other_tot_item'];
	$other_tmt_annum_bb = $res17['other_tmt_annum'];
	$other_tot_annum_bb = $res17['other_tot_annum'];
	$other_count_bb = $res17['other_count'];
	
	$query18 = "select * from eti_total_details where sra_id='$eti_id'";
	$exec18 = mysql_query($query18) or die ("Error in Query18".mysql_error());
	$res18 = mysql_fetch_array($exec18);
	$total_unit = $res18['total_unit'];
	$total_unit_annum = $res18['total_unit_annum'];
	$total_labour = $res18['total_labour'];
	$total_labour_annum = $res18['total_labour_annum'];
	$other_total_a = $res18['other_total_a'];
	$other_total_b = $res18['other_total_b'];
	$treatment_a = $res18['treatment_a'];
	$treatment_b = $res18['treatment_b'];
	$total_annual_cost = $res18['total_annual_cost'];
	$price_accept = $res18['price_accept'];
	$price_accept_tax = $res18['price_accept_tax'];
	$finance_note = $res18['finance_note'];
	$service_note = $res18['service_note'];
	$billing_frequency = $res18['billing_frequency'];
	$credit_term = $res18['credit_term'];
	$invoice_type = $res18['invoice_type'];
	$invoice_attachment = $res18['invoice_attachment'];
	$po_number = $res18['po_number'];
	$total_unit_cost = $res18['total_unit_cost'];
	$total_unit_cost_annum = $res18['total_unit_cost_annum'];
	$fix_cost_total_labour = $res18['fix_cost_total_labour'];
	$wfix_cost_total_labour = $res18['wfix_cost_total_labour'];
	$fix_cost_total_labour_annum = $res18['fix_cost_total_labour_annum'];
	$wfix_cost_total_labour_annum = $res18['wfix_cost_total_labour_annum'];
	$total_percentage = $res18['total_percentage'];
	$fix_percentage = $res18['fix_percentage'];
	$wfix_percentage = $res18['wfix_percentage'];
	
	$query19 = "select * from eti_product_details where sra_id='$eti_id' and product_count='1'";
	$exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
	$res19 = mysql_fetch_array($exec19);
	$pest_id_aa = $res19['pest_id'];
	$pest_qty_aa = $res19['qty'];
	$instruction_aa = $res19['instruction'];
	$visit_annum_aa = $res19['visit_annum'];
	$add_freq_aa = $res19['add_freq'];
	$annual_value_aa = $res19['annual_value'];
	$product_count_aa = $res19['product_count'];
	
	$query20 = "select * from eti_product_details where sra_id='$eti_id' and product_count='2'";
	$exec20 = mysql_query($query20) or die ("Error in Query20".mysql_error());
	$res20 = mysql_fetch_array($exec20);
	$pest_id_bb = $res20['pest_id'];
	$pest_qty_bb = $res20['qty'];
	$instruction_bb = $res20['instruction'];
	$visit_annum_bb = $res20['visit_annum'];
	$add_freq_bb = $res20['add_freq'];
	$annual_value_bb = $res20['annual_value'];
	$product_count_bb = $res20['product_count'];
	
	$query21 = "select * from eti_product_details where sra_id='$eti_id' and product_count='3'";
	$exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
	$res21 = mysql_fetch_array($exec21);
	$pest_id_cc = $res21['pest_id'];
	$pest_qty_cc = $res21['qty'];
	$instruction_cc = $res21['instruction'];
	$visit_annum_cc = $res21['visit_annum'];
	$add_freq_cc = $res21['add_freq'];
	$annual_value_cc = $res21['annual_value'];
	$product_count_cc = $res21['product_count'];
	
	$query22 = "select * from eti_product_details where sra_id='$eti_id' and product_count='4'";
	$exec22 = mysql_query($query22) or die ("Error in Query22".mysql_error());
	$res22 = mysql_fetch_array($exec22);
	$pest_id_dd = $res22['pest_id'];
	$pest_qty_dd = $res22['qty'];
	$instruction_dd = $res22['instruction'];
	$visit_annum_dd = $res22['visit_annum'];
	$add_freq_dd = $res22['add_freq'];
	$annual_value_dd = $res22['annual_value'];
	$product_count_dd = $res22['product_count'];
	
	$query23 = "select * from eti_product_details where sra_id='$eti_id' and product_count='5'";
	$exec23 = mysql_query($query23) or die ("Error in Query23".mysql_error());
	$res23 = mysql_fetch_array($exec23);
	$pest_id_ee = $res23['pest_id'];
	$pest_qty_ee = $res23['qty'];
	$instruction_ee = $res23['instruction'];
	$visit_annum_ee = $res23['visit_annum'];
	$add_freq_ee = $res23['add_freq'];
	$annual_value_ee = $res23['annual_value'];
	$product_count_ee = $res23['product_count'];
	
	$query24 = "select * from eti_product_details where sra_id='$eti_id' and product_count='6'";
	$exec24 = mysql_query($query24) or die ("Error in Query24".mysql_error());
	$res24 = mysql_fetch_array($exec24);
	$pest_id_ff = $res24['pest_id'];
	$pest_qty_ff = $res24['qty'];
	$instruction_ff = $res24['instruction'];
	$visit_annum_ff = $res24['visit_annum'];
	$add_freq_ff = $res24['add_freq'];
	$annual_value_ff = $res24['annual_value'];
	$product_count_ff = $res24['product_count'];
	
	$query25 = "select * from eti_product_details where sra_id='$eti_id' and product_count='7'";
	$exec25 = mysql_query($query25) or die ("Error in Query25".mysql_error());
	$res25 = mysql_fetch_array($exec25);
	$pest_id_gg = $res25['pest_id'];
	$pest_qty_gg = $res25['qty'];
	$instruction_gg = $res25['instruction'];
	$visit_annum_gg = $res25['visit_annum'];
	$add_freq_gg = $res25['add_freq'];
	$annual_value_gg = $res25['annual_value'];
	$product_count_gg = $res25['product_count'];
	
	$query26 = "select * from eti_product_details where sra_id='$eti_id' and product_count='8'";
	$exec26 = mysql_query($query26) or die ("Error in Query26".mysql_error());
	$res26 = mysql_fetch_array($exec26);
	$pest_id_hh = $res26['pest_id'];
	$pest_qty_hh = $res26['qty'];
	$instruction_hh = $res26['instruction'];
	$visit_annum_hh = $res26['visit_annum'];
	$add_freq_hh = $res26['add_freq'];
	$annual_value_hh = $res26['annual_value'];
	$product_count_hh = $res26['product_count'];
   }
  
if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 1)
{
	echo '<script type="text/javascript">'; 
	echo 'alert("ETI for Submitted Successfully & Email Sent to Approver!!");'; 
	echo 'window.location.href = "addview.php";';
	echo '</script>';
}
?>
<style>
	.div-inline{
    
    display:inline-block;
}
</style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Edit ETI</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!--<link rel="stylesheet" href="../plugins/select2/select2.min.css"> -->
  <link rel="shortcut icon" type="image/png" href="../images/rentokil_logo.png"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <?php include ('../includes/header.php');?>
  </header>
  <aside class="main-sidebar">
    <?php include ('../includes/sidebar.php'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        ETI
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $sra_lbl; ?></h3>
            </div>
    <form action="updateadminaction.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" autocomplete="off"> 
        <div class="box-body">
		  <div class="row">
			<div class="col-md-3">
              <div class="form-group">
			  </div>
			</div>
			<div class="col-md-3">
              <div class="form-group">
			  </div>
			</div>
			<div class="col-md-3">
              <div class="form-group">
			  </div>
			</div>
			<div class="col-md-3">
				 <div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="amend" name="amend" value="Yes" <?php if($amend == 'Yes'){ echo 'checked'; } ?> disabled> <b><?php echo $amend_lbl; ?></b>
						</label>
					</div>
				  </div>
			</div>
		 </div>
          <div class="row">
			<div class="col-md-3">
              <div class="form-group">
                <label><?php echo $serial_number_lbl; ?></label>
                <input type="text" class="form-control" name="serial_number" id="serial_number" value="<?php echo $serial_number; ?>" placeholder="Serial Number"  readonly>
                <input type="hidden" class="form-control" name="eti_id" id="eti_id" value="<?php echo $eti_id; ?>" placeholder="Serial Number"  readonly>
                <input type="hidden" class="form-control" name="page_source" id="page_source" value="4" placeholder="4"  readonly>
              </div>
            </div>
            <div class="col-md-3">
             <div class="form-group">
                <label><?php echo $competitor_lbl; ?> <span style="color:red">*</span></label>
				<select class="form-control select2" style="width: 100%;" name="competitor" id="competitor" required>
				    <option value="">Please choose Competitor</option>
					<?php
					$query7 = "select id,competitor_name from eti_competitor order by competitor_name";
					$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
					while ($res7 = mysql_fetch_array($exec7))
					{
					$competitor_id = $res7["id"];
					$competitor_name = $res7["competitor_name"];
					if($competitor_id === $comp_id){
						echo '<option value="' .$comp_id.'" selected="selected" />'.$competitor_name.'</option>';
					} else {
						echo '<option value ="'.$competitor_id.'">'.$competitor_name.'</option>';
					}
					}
					?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $surveyor_lbl; ?> <span style="color:red">*</span></label>
				<select class="form-control select2" style="width: 100%;" name="surveyor" id="surveyor" required>
					<option value="">Please choose Surveyor</option>
					<?php
					$query8 = "select id,surveyor_name,employee_id from eti_surveyor where deleted = 0 order by surveyor_name";
					$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
					while ($res8 = mysql_fetch_array($exec8))
					{
					$surveyor_id = $res8["id"];
					$surveyor_name = $res8["surveyor_name"];
					$employee_id = $res8["employee_id"];
					if ($surveyor_id === $surv_id) {
						echo '<option value="' .$surv_id.'" selected="selected" />'.$surveyor_name.'</option>';
					} else {
						echo '<option value ="'.$surveyor_id.'">'.$surveyor_name.'</option>';
					}
					}
					?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $contract_no_lbl; ?></label>
                <input type="text" class="form-control" name="contract_no" id="contract_no" value="<?php echo $contract_no;?>" placeholder="Contract No" >
              </div>
            </div>
          </div>
		  <div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $industry_lbl; ?> <span style="color:red">*</span></label>
                <select class="form-control select2" style="width: 100%;" name="industry" id="industry" required>
					<option value="">Please choose Industrial</option>
					<?php
					$query9 = "select id,industry_name from eti_industry order by industry_name";
					$exec9 = mysql_query($query9) or die ("Error in Query8".mysql_error());
					while ($res9 = mysql_fetch_array($exec9))
					{
					$industry_id = $res9["id"];
					$industry_name = $res9["industry_name"];
					if ($industry_id === $indus_id) {
						echo '<option value="' .$indus_id.'" selected="selected" />'.$industry_name.'</option>';
					} else {
						echo '<option value ="'.$industry_id.'">'.$industry_name.'</option>';
					}
					}
					?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $eti_date_lbl; ?> <span style="color:red">*</span></label>
                <input type="date" class="form-control" name="eti_date" id="eti_date" value="<?php echo $eti_date; ?>" placeholder="Contract No" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $eti_time_lbl; ?> <span style="color:red">*</span></label>
                <select class="form-control" name="eti_time" id="eti_time" required>
					<option value="">Please choose Time</option>
					<option value="01:00am" <?php if($eti_time == '01:00am') { echo 'selected="selected"'; }?>>01:00am</option>
					<option value="02:00am" <?php if($eti_time == '02:00am') { echo 'selected="selected"'; }?>>02:00am</option>
					<option value="03:00am" <?php if($eti_time == '03:00am') { echo 'selected="selected"'; }?>>03:00am</option>
					<option value="04:00am" <?php if($eti_time == '04:00am') { echo 'selected="selected"'; }?>>04:00am</option>
					<option value="05:00am" <?php if($eti_time == '05:00am') { echo 'selected="selected"'; }?>>05:00am</option>
					<option value="06:00am" <?php if($eti_time == '06:00am') { echo 'selected="selected"'; }?>>06:00am</option>
					<option value="07:00am" <?php if($eti_time == '07:00am') { echo 'selected="selected"'; }?>>07:00am</option>
					<option value="08:00am" <?php if($eti_time == '08:00am') { echo 'selected="selected"'; }?>>08:00am</option>
					<option value="09:00am" <?php if($eti_time == '09:00am') { echo 'selected="selected"'; }?>>09:00am</option>
					<option value="10:00am" <?php if($eti_time == '10:00am') { echo 'selected="selected"'; }?>>10:00am</option>
					<option value="11:00am" <?php if($eti_time == '11:00am') { echo 'selected="selected"'; }?>>11:00am</option>
					<option value="12:00pm" <?php if($eti_time == '12:00pm') { echo 'selected="selected"'; }?>>12:00pm</option>
					<option value="01:00pm" <?php if($eti_time == '01:00pm') { echo 'selected="selected"'; }?>>01:00pm</option>
					<option value="02:00pm" <?php if($eti_time == '02:00pm') { echo 'selected="selected"'; }?>>02:00pm</option>
					<option value="03:00pm" <?php if($eti_time == '03:00pm') { echo 'selected="selected"'; }?>>03:00pm</option>
					<option value="04:00pm" <?php if($eti_time == '04:00pm') { echo 'selected="selected"'; }?>>04:00pm</option>
					<option value="05:00pm" <?php if($eti_time == '05:00pm') { echo 'selected="selected"'; }?>>05:00pm</option>
					<option value="06:00pm" <?php if($eti_time == '06:00pm') { echo 'selected="selected"'; }?>>06:00pm</option>
					<option value="07:00pm" <?php if($eti_time == '07:00pm') { echo 'selected="selected"'; }?>>07:00pm</option>
					<option value="08:00pm" <?php if($eti_time == '08:00pm') { echo 'selected="selected"'; }?>>08:00pm</option>
					<option value="09:00pm" <?php if($eti_time == '09:00pm') { echo 'selected="selected"'; }?>>09:00pm</option>
					<option value="10:00pm" <?php if($eti_time == '10:00pm') { echo 'selected="selected"'; }?>>10:00pm</option>
					<option value="11:00pm" <?php if($eti_time == '11:00pm') { echo 'selected="selected"'; }?>>11:00pm</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $eti_duration_lbl; ?> <span style="color:red">*</span></label>
                <select class="form-control" style="width:32%; display: inline;" name="eti_duration" id="eti_duration" required>
					<option value="">Please choose Duration</option>
					<option value="1 Hour" <?php if($eti_duration == '1 Hour') { echo 'selected="selected"'; }?>>1 Hour</option>
					<option value="2 Hours" <?php if($eti_duration == '2 Hours') { echo 'selected="selected"'; }?>>2 Hours</option>
					<option value="3 Hours" <?php if($eti_duration == '3 Hours') { echo 'selected="selected"'; }?>>3 Hours</option>
					<option value="4 Hours" <?php if($eti_duration == '4 Hours') { echo 'selected="selected"'; }?>>4 Hours</option>
					<option value="5 Hours" <?php if($eti_duration == '5 Hours') { echo 'selected="selected"'; }?>>5 Hours</option>
					<option value="6 Hours" <?php if($eti_duration == '6 Hours') { echo 'selected="selected"'; }?>>6 Hours</option>
					<option value="7 Hours" <?php if($eti_duration == '7 Hours') { echo 'selected="selected"'; }?>>7 Hours</option>
					<option value="8 Hours" <?php if($eti_duration == '8 Hours') { echo 'selected="selected"'; }?>>8 Hours</option>
					<option value="1 Day" <?php if($eti_duration == '1 Day') { echo 'selected="selected"'; }?>>1 Day</option>
					<option value="2 Days" <?php if($eti_duration == '2 Days') { echo 'selected="selected"'; }?>>2 Days</option>
					<option value="3 Days" <?php if($eti_duration == '3 Days') { echo 'selected="selected"'; }?>>3 Days</option>
					<option value="4 Days" <?php if($eti_duration == '4 Days') { echo 'selected="selected"'; }?>>4 Days</option>
					<option value="5 Days & Above" <?php if($eti_duration == '5 Days & Above') { echo 'selected="selected"'; }?>>5 Days & Above</option>
				</select>
				<select class="form-control" style="width:32%; display:inline;" name="job_type" id="job_type" required>
					<option value="">Please choose Job Type</option>
					<option value="Contract" <?php if($job_type == 'Contract') { echo 'selected="selected"'; }?>>Contract</option>
					<option value="Job" <?php if($job_type == 'Job') { echo 'selected="selected"'; }?>>Job</option>
					<option value="Product Sales" <?php if($job_type == 'Product Sales') { echo 'selected="selected"'; }?>>Product Sales</option>
				</select>
				<select class="form-control" style="width:32%; display: inline;" name="business_type" id="business_type" required>
					<option value="">Please choose Business Type</option>
					<option value="New Business" <?php if($business_type == 'New Business') { echo 'selected="selected"'; }?>>New Business</option>
					<option value="Additional" <?php if($business_type == 'Additional') { echo 'selected="selected"'; }?>>Additional</option>
					<option value="Re-negotiated" <?php if($business_type == 'Re-negotiated') { echo 'selected="selected"'; }?>>Re-negotiated</option>
				</select>
              </div>
            </div>	
		  </div>
		  <div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $name_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Name" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $existing_account_lbl; ?></label>
                <input type="text" class="form-control" name="existing_account" id="existing_account" value="<?php echo $existing_account; ?>" placeholder="Existing Account No" >
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $decision_maker_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="decision_maker" id="decision_maker" value="<?php echo $decision_maker; ?>" placeholder="Decision Maker" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $whom_see_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="whom_see" id="whom_see" value="<?php echo $whom_see; ?>" placeholder="Whom to See" required>
              </div>
            </div>
		  </div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $address_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" maxlength="40" name="address_a" id="address_a" value="<?php echo htmlentities($address_a); ?>" placeholder="Address" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $address_b_lbl; ?></label>
                <input type="text" class="form-control" maxlength="40" name="address_b" id="address_b" value="<?php echo htmlentities($address_b); ?>" placeholder="Address">
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $postcode_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="postcode_a" id="postcode_a" value="<?php echo $postcode_a; ?>" placeholder="Postcode" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $tel_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="tel_a" id="tel_a" value="<?php echo $tel_a; ?>" placeholder="Telephone" required>
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_address_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" maxlength="40" name="premises_address_a" id="premises_address_a" value="<?php echo htmlentities($premises_address_a); ?>" placeholder="Address" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_address_b_lbl; ?></label>
                <input type="text" class="form-control" maxlength="40" name="premises_address_b" id="premises_address_b" value="<?php echo htmlentities($premises_address_b); ?>" placeholder="Address">
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_postcode_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="postcode_b" id="postcode_b" value="<?php echo $postcode_b; ?>" placeholder="Postcode" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_tel_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="tel_b" id="tel_b" placeholder="Telephone" value="<?php echo $tel_b; ?>" required>
				<div class="checkbox">
                      <label>
                        <input type="checkbox" id="same_address" name="same_address"> <?php echo $same_address_lbl; ?>
                      </label>
                </div>
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $email_lbl; ?> <span style="color:red">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" multiple pattern="^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?,)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$" required>
                <input type="hidden" class="form-control" name="useremail" id="useremail" placeholder="Email" value="<?php echo $user_mail;?>">
                <input type="hidden" class="form-control" name="created_by" id="created_by" placeholder="Email" value="<?php echo $session_id;?>">
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $infestation_lbl; ?> <span style="color:red">*</span></label>
				<select class="form-control" name="infestation" id="infestation" required>
					<option value="">Please choose Degree of Infestation</option>
					<option value="Light" <?php if($infestation == 'Light') { echo 'selected="selected"'; }?>>Light</option>
					<option value="Medium" <?php if($infestation == 'Medium') { echo 'selected="selected"'; }?>>Medium</option>
					<option value="Heavy" <?php if($infestation == 'Heavy') { echo 'selected="selected"'; }?>>Heavy</option>
					<option value="NIL" <?php if($infestation == 'NIL') { echo 'selected="selected"'; }?>>NIL</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $business_origin_lbl; ?> <span style="color:red">*</span></label>
				<select class="form-control select2" style="width: 100%;" name="business_origin" id="business_origin" required>
					<option value="">Please choose Business Origin</option>
					<?php
					$query10 = "select id,business_name from eti_business order by business_name";
					$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
					while ($res10 = mysql_fetch_array($exec10))
					{
					$business_id = $res10["id"];
					$business_name = $res10["business_name"];
					if ($business_id === $business_origin) {
						echo '<option value="' .$business_origin.'" selected="selected" />'.$business_name.'</option>';
					} else {
						echo '<option value ="'.$business_id.'">'.$business_name.'</option>';
					}
					}
					?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $referral_name_lbl; ?></label>
                <input type="text" class="form-control" name="referral_name" id="referral_name" value="<?php echo $referral_name; ?>" placeholder="Referral Name" >
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $sra_sra_lbl; ?> <span style="color:red">*</span></label>
					<input type="text" class="form-control" style="width:90%; display: inline;" name="sra" id="sra" value="<?php echo $sra; ?>" placeholder="SRA" readonly>
					<!-- <input type="hidden" class="form-control" style="width:90%; display: inline;" name="sra_validation" id="sra_validation" placeholder="SRA" required> -->
				</div>
			</div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $duration_lbl; ?> <span style="color:red">*</span></label>
				<select class="form-control" name="duration" id="duration" required>
					<option value="Continuous" <?php if($duration == 'Continuous') { echo 'selected="selected"'; }?>>Continuous</option>
					<option value="Limited Contract" <?php if($duration == 'Limited Contract') { echo 'selected="selected"'; }?>>Limited Contract</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $job_duration_lbl; ?></label>
				<select class="form-control" name="job_duration" id="job_duration">
					<?php if ($job_type == "Job") {
						$query784 = "select job_duration from eti_job_duration where deleted = 0";
						$exec784 = mysql_query($query784) or die ("Error in query784".mysql_error());
						while ($res784 = mysql_fetch_array($exec784))
						{
						$job_duration_aa = $res784["job_duration"]; ?>
						<option value ="<?php echo $job_duration_aa; ?>" <?php if ($job_duration == $job_duration_aa ) { echo 'selected="selected"';} ?>><?php echo $job_duration_aa; ?></option>
					<?php } } else { ?>
					<option value="">Please Choose Job Duration</option>
					<?php } ?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $surveyor_code_lbl; ?></label>
                <input type="text" class="form-control" name="surveyor_code" id="surveyor_code" placeholder="Surveyor Code" value="<?php echo $surveyor_code; ?>" readonly>
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $billing_email_lbl; ?></label>
                <input type="email" class="form-control" name="billing_email" id="billing_email" placeholder="Billing Email" value="<?php echo $billing_email; ?>" multiple pattern="^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?,)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $business_code_lbl; ?></label>
                <input type="text" class="form-control" name="business_code" id="business_code" placeholder="Business Code" value="<?php echo $business_code; ?>" readonly>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $industry_code_lbl; ?></label>
                <input type="text" class="form-control" name="industry_code" id="industry_code" placeholder="Surveyor Code" value="<?php echo $industry_code; ?>" readonly>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $business_origin_code_lbl; ?></label>
                <input type="text" class="form-control" name="business_origin_code" id="business_origin_code" placeholder="Business Origin Detail Code" value="<?php echo $business_origin_code; ?>" readonly>
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $prospect_no_lbl; ?></label><span style="color:red">*</span>
                <input type="text" class="form-control" name="prospect_no" id="prospect_no" placeholder="Prospect Number" value="<?php echo $prospect_no; ?>" required readonly>
              </div>
            </div>
		</div>
        </div>
		
		<div class="box-header">
            <h3 class="box-title"><?php echo $site_map_lbl; ?> <small>(<?php echo $property_information_lbl; ?>)</small></h3>
        </div>
		<div class="box-body">
			<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $domestic_lbl; ?></label>
                <select class="form-control" name="domestic" id="domestic" disabled>
					<option value="">Please choose Domestic</option>
					<option value="Bungalow" <?php if($domestic == 'Bungalow') { echo 'selected="selected"'; }?>>Bungalow</option>
					<option value="Clustered Housing" <?php if($domestic == 'Clustered Housing') { echo 'selected="selected"'; }?>>Clustered Housing</option>
					<option value="Condominium" <?php if($domestic == 'Condominium') { echo 'selected="selected"'; }?>>Condominium</option>
					<option value="Private Apartment" <?php if($domestic == 'Private Apartment') { echo 'selected="selected"'; }?>>Private Apartment</option>
					<option value="Semi Detached" <?php if($domestic == 'Semi Detached') { echo 'selected="selected"'; }?>>Semi Detached</option>
					<option value="Terrance" <?php if($domestic == 'Terrance') { echo 'selected="selected"'; }?>>Terrance</option>
					<option value="Townhouse" <?php if($domestic == 'Townhouse') { echo 'selected="selected"'; }?>>Townhouse</option>
					<option value="Walkup Apartment" <?php if($domestic == 'Walkup Apartment') { echo 'selected="selected"'; }?>>Walkup Apartment</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $industrial_lbl; ?></label>
                <select class="form-control" name="industrial" id="industrial" disabled>
					<option value="">Please choose Industry</option>
					<option value="Flatted Factory" <?php if($industrial == 'Flatted Factory') { echo 'selected="selected"'; }?>>Flatted Factory</option>
					<option value="Landed Factory" <?php if($industrial == 'Landed Factory') { echo 'selected="selected"'; }?>>Landed Factory</option>
					<option value="Warehouse" <?php if($industrial == 'Warehouse') { echo 'selected="selected"'; }?>>Warehouse</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $commercial_lbl; ?></label>
                <select class="form-control" name="commercial" id="commercial" disabled>
					<option value="">Please choose Commercial</option>
					<option value="Cinema/Theater" <?php if($commercial == 'Cinema/Theater') { echo 'selected="selected"'; }?>>Cinema/Theater</option>
					<option value="Food Court" <?php if($commercial == 'Food Court') { echo 'selected="selected"'; }?>>Food Court</option>
					<option value="Hotel" <?php if($commercial == 'Hotel') { echo 'selected="selected"'; }?>>Hotel</option>
					<option value="Office Building" <?php if($commercial == 'Office Building') { echo 'selected="selected"'; }?>>Office Building</option>
					<option value="Restaurant" <?php if($commercial == 'Restaurant') { echo 'selected="selected"'; }?>>Restaurant</option>
					<option value="Retail Shop" <?php if($commercial == 'Retail Shop') { echo 'selected="selected"'; }?>>Retail Shop</option>
					<option value="Shop House" <?php if($commercial == 'Shop House') { echo 'selected="selected"'; }?>>Shop House</option>
					<option value="Shopping Mall" <?php if($commercial == 'Shopping Mall') { echo 'selected="selected"'; }?>>Shopping Mall</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $others_lbl; ?></label>
                <input type="text" class="form-control" name="site_plan_others" id="site_plan_others" value="<?php echo $site_plan_others; ?>" placeholder="Others" readonly>
              </div>
            </div>
			</div>
			<div class="row">
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $location_lbl; ?></label>
					<input type="text" class="form-control" name="location" id="location" value="<?php echo $location; ?>" placeholder="Location of Site" readonly>
				  </div>
				</div>
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $area_treatment_lbl; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="text" class="form-control" name="lm" id="lm" value="<?php echo $lm; ?>" style="display:inline-block;width:35%;" readonly><div style="display:inline-block;width:14%;">&nbsp;<?php echo $lm_lbl; ?></div>
					<input type="text" class="form-control" name="meter" id="meter" value="<?php echo $meter; ?>" style="display:inline-block;width:35%;" readonly><div style="display:inline-block;width:14%;">&nbsp;<?php echo $meter_lbl; ?><sup>2</sup></div>
				  </div>
				</div>
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $surveyor_lbl; ?></label>
					<input type="text" class="form-control" name="surveyor_name" id="surveyor_name" value="<?php echo $surve_name; ?>" placeholder="Surveyor Name" readonly>
				  </div>
				</div>
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $litre_lbl; ?></label>
					<input type="text" class="form-control" name="litre" id="litre" value="<?php echo $litre; ?>" placeholder="No. of Liters" readonly>
				  </div>
				</div>
			</div>
			<div class="row">
			 <div class="col-md-3">
			 <label> <?php echo $chemical_lbl; ?> &nbsp;&nbsp; </label>
				<label><input type="radio" name="chemical" id="chemical" value="Premise 200 SC" <?php if($chemical == 'Premise 200 SC') { echo 'checked'; } ?> disabled>&nbsp;<?php echo $chemical_premise_lbl; ?></label>
			 </div>
			 <div class="col-md-3">
				 <label></label>
				<label><input type="radio" name="chemical" id="chemical" value="Optigrad termite liquid" <?php if($chemical == 'Optigrad termite liquid') { echo 'checked'; } ?> disabled>&nbsp;<?php echo $chemical_optigrad_lbl; ?> </label>
			 </div>
			 <div class="col-md-3">
				 <label></label>
				<label><input type="radio" name="chemical" id="chemical" value="Ultrathor" <?php if($chemical == 'Wazary 10 FL') { echo 'checked'; } ?> disabled>&nbsp;<?php echo $chemical_wazary_lbl; ?></label>
			 </div>
			 <div class="col-md-3">
				 <label></label>
				<label><input type="radio" name="chemical" id="chemical" value="Altriset" <?php if($chemical == 'Agenda 10 SC') { echo 'checked'; } ?> disabled>&nbsp;<?php echo $chemical_agenda_lbl; ?></label>
			 </div>
			  <div class="col-md-3">
				<label>
					<input type="checkbox" name="chemical_other"  id="chemical_other" <?php if($chemical_other_desc != ''){ echo 'checked'; } ?> disabled>&nbsp;<?php echo $chemical_others_lbl; ?>
					<input type="text" style="width:75%; display:inline;" class="form-control" name="chemical_other_desc" id="chemical_other_desc" value="<?php echo $chemical_other_desc; ?>" readonly>
				</label>
			 </div>
			</div> <br>
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label><?php echo $pest_lbl; ?></label>
						<select class="form-control select2" style="width: 100%;" name="pest_a" id="pest_a" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query100 = "select id,pest_name from eti_pest order by pest_name";
							$exec100 = mysql_query($query100) or die ("Error in Query100".mysql_error());
							while ($res100 = mysql_fetch_array($exec100))
							{
							$pest_id_a = $res100["id"];
							$pest_name_a = $res100["pest_name"];
							if ($pest_id_a === $pest_id_aa) {
								echo '<option value="' .$pest_id_aa.'" selected="selected" />'.$pest_name_a.'</option>';
							} else {
								echo '<option value ="'.$pest_id_a.'">'.$pest_name_a.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $qty_lbl; ?></label>
						<input type="text" class="form-control" name="pest_qty_a" id="pest_qty_a" value="<?php echo $pest_qty_aa; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $instruction_lbl; ?></label>
						<input type="text" class="form-control" name="instruction_a" id="instruction_a" value="<?php echo $instruction_aa; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $visit_annum_lbl; ?></label><br>
						<select class="form-control" name="visit_annum_a" id="visit_annum_a" disabled>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query777 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query777 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec777 = mysql_query($query777) or die ("Error in query777".mysql_error());
								while ($res777 = mysql_fetch_array($exec777))
								{
								$visit_frequency_aa = $res777["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_aa; ?>" <?php if ($visit_annum_aa == $visit_frequency_aa) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_aa; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $add_freq_lbl; ?></label>
						<input type="text" class="form-control" name="add_freq_a" id="add_freq_a" value="<?php echo $add_freq_aa; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $annual_value_lbl; ?></label>
						<input type="number" min="0" class="form-control" name="annual_value_a" id="annual_value_a" value="<?php echo $annual_value_aa; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_a" id="product_count_a" value="1" placeholder="" readonly>
				  </div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_b" id="pest_b" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query101 = "select id,pest_name from eti_pest order by pest_name";
							$exec101 = mysql_query($query101) or die ("Error in Query101".mysql_error());
							while ($res101 = mysql_fetch_array($exec101))
							{
							$pest_id_b = $res101["id"];
							$pest_name_b = $res101["pest_name"];
							if ($pest_id_b === $pest_id_bb) {
								echo '<option value="' .$pest_id_bb.'" selected="selected" />'.$pest_name_b.'</option>';
							} else {
								echo '<option value ="'.$pest_id_b.'">'.$pest_name_b.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_b" id="pest_qty_b" value="<?php echo $pest_qty_bb; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_b" id="instruction_b" value="<?php echo $instruction_bb; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="visit_annum_b" id="visit_annum_b" disabled>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query778 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query778 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec778 = mysql_query($query778) or die ("Error in query778".mysql_error());
								while ($res778 = mysql_fetch_array($exec778))
								{
								$visit_frequency_bb = $res778["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_bb; ?>" <?php if ($visit_annum_bb == $visit_frequency_bb ) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_bb; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_b" id="add_freq_b" value="<?php echo $add_freq_bb; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_b" id="annual_value_b" value="<?php echo $annual_value_bb; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_b" id="product_count_b" value="2" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_c" id="pest_c" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query102 = "select id,pest_name from eti_pest order by pest_name";
							$exec102 = mysql_query($query102) or die ("Error in Query102".mysql_error());
							while ($res102 = mysql_fetch_array($exec102))
							{
							$pest_id_c = $res102["id"];
							$pest_name_c = $res102["pest_name"];
							if ($pest_id_c === $pest_id_cc) {
								echo '<option value="' .$pest_id_cc.'" selected="selected" />'.$pest_name_c.'</option>';
							} else {
								echo '<option value ="'.$pest_id_c.'">'.$pest_name_c.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_c" id="pest_qty_c" value="<?php echo $pest_qty_cc; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_c" id="instruction_c" value="<?php echo $instruction_cc; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="visit_annum_c" id="visit_annum_c" disabled>
							<option value="">Visit</option>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query779 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query779 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec779 = mysql_query($query779) or die ("Error in query779".mysql_error());
								while ($res779 = mysql_fetch_array($exec779))
								{
								$visit_frequency_cc = $res779["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_cc; ?>" <?php if ($visit_annum_cc == $visit_frequency_cc ) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_cc; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_c" id="add_freq_c" value="<?php echo $add_freq_cc; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_c" id="annual_value_c" value="<?php echo $annual_value_cc; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_c" id="product_count_c" value="3" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_d" id="pest_d" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query103 = "select id,pest_name from eti_pest order by pest_name";
							$exec103 = mysql_query($query103) or die ("Error in Query103".mysql_error());
							while ($res103 = mysql_fetch_array($exec103))
							{
							$pest_id_d = $res103["id"];
							$pest_name_d = $res103["pest_name"];
							if ($pest_id_d === $pest_id_dd) {
								echo '<option value="' .$pest_id_dd.'" selected="selected" />'.$pest_name_d.'</option>';
							} else {
								echo '<option value ="'.$pest_id_d.'">'.$pest_name_d.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_d" id="pest_qty_d" value="<?php echo $pest_qty_dd; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_d" id="instruction_d" value="<?php echo $instruction_dd; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="visit_annum_d" id="visit_annum_d" disabled>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query780 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query780 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec780 = mysql_query($query780) or die ("Error in query780".mysql_error());
								while ($res780 = mysql_fetch_array($exec780))
								{
								$visit_frequency_dd = $res780["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_dd; ?>" <?php if ($visit_annum_dd == $visit_frequency_dd ) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_dd; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_d" id="add_freq_d" value="<?php echo $add_freq_dd; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_d" id="annual_value_d" value="<?php echo $annual_value_dd; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_d" id="product_count_d" value="4" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_e" id="pest_e" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query104 = "select id,pest_name from eti_pest order by pest_name";
							$exec104 = mysql_query($query104) or die ("Error in Query104".mysql_error());
							while ($res104 = mysql_fetch_array($exec104))
							{
							$pest_id_e = $res104["id"];
							$pest_name_e = $res104["pest_name"];
							if ($pest_id_e === $pest_id_ee) {
								echo '<option value="' .$pest_id_ee.'" selected="selected" />'.$pest_name_e.'</option>';
							} else {
								echo '<option value ="'.$pest_id_e.'">'.$pest_name_e.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_e" id="pest_qty_e" value="<?php echo $pest_qty_ee; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_e" id="instruction_e" value="<?php echo $instruction_ee; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="visit_annum_e" id="visit_annum_e" disabled>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query781 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query781 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec781 = mysql_query($query781) or die ("Error in query781".mysql_error());
								while ($res781 = mysql_fetch_array($exec781))
								{
								$visit_frequency_ee = $res781["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_ee; ?>" <?php if ($visit_annum_ee == $visit_frequency_ee ) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_ee; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_e" id="add_freq_e" value="<?php echo $add_freq_ee; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_e" id="annual_value_e" value="<?php echo $annual_value_ee; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_e" id="product_count_e" value="5" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_f" id="pest_f" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query105 = "select id,pest_name from eti_pest order by pest_name";
							$exec105 = mysql_query($query105) or die ("Error in Query105".mysql_error());
							while ($res105 = mysql_fetch_array($exec105))
							{
							$pest_id_f = $res105["id"];
							$pest_name_f = $res105["pest_name"];
							if ($pest_id_f === $pest_id_ff) {
								echo '<option value="' .$pest_id_ff.'" selected="selected" />'.$pest_name_f.'</option>';
							} else {
								echo '<option value ="'.$pest_id_f.'">'.$pest_name_f.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_f" id="pest_qty_f" value="<?php echo $pest_qty_ff; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_f" id="instruction_f" value="<?php echo $instruction_ff; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="visit_annum_f" id="visit_annum_f" disabled>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query782 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query782 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec782 = mysql_query($query782) or die ("Error in query782".mysql_error());
								while ($res782 = mysql_fetch_array($exec782))
								{
								$visit_frequency_ff = $res782["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_ff; ?>" <?php if ($visit_annum_ff == $visit_frequency_ff ) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_ff; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_f"  id="add_freq_f" value="<?php echo $add_freq_ff; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_f" id="annual_value_f" value="<?php echo $annual_value_ff; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_f" id="product_count_f" value="6" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_g" id="pest_g" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query106 = "select id,pest_name from eti_pest order by pest_name";
							$exec106 = mysql_query($query106) or die ("Error in Query106".mysql_error());
							while ($res106 = mysql_fetch_array($exec106))
							{
							$pest_id_g = $res106["id"];
							$pest_name_g = $res106["pest_name"];
							if ($pest_id_g === $pest_id_gg) {
								echo '<option value="' .$pest_id_gg.'" selected="selected" />'.$pest_name_g.'</option>';
							} else {
								echo '<option value ="'.$pest_id_g.'">'.$pest_name_g.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_g" id="pest_qty_g" value="<?php echo $pest_qty_gg; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_g" id="instruction_g" value="<?php echo $instruction_gg; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="visit_annum_g" id="visit_annum_g" disabled>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query783 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query783 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec783 = mysql_query($query783) or die ("Error in query783".mysql_error());
								while ($res783 = mysql_fetch_array($exec783))
								{
								$visit_frequency_gg = $res783["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_gg; ?>" <?php if ($visit_annum_gg == $visit_frequency_gg ) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_gg; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_g" id="add_freq_g" value="<?php echo $add_freq_gg; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_g" id="annual_value_g" value="<?php echo $annual_value_gg; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_g" id="product_count_g" value="7" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_h" id="pest_h" disabled>
							<option value="">Please choose Pest</option>
							<?php
							$query107 = "select id,pest_name from eti_pest order by pest_name";
							$exec107 = mysql_query($query107) or die ("Error in Query107".mysql_error());
							while ($res107= mysql_fetch_array($exec107))
							{
							$pest_id_h = $res107["id"];
							$pest_name_h = $res107["pest_name"];
							if ($pest_id_h === $pest_id_hh) {
								echo '<option value="' .$pest_id_hh.'" selected="selected" />'.$pest_name_h.'</option>';
							} else {
								echo '<option value ="'.$pest_id_h.'">'.$pest_name_h.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_h" id="pest_qty_h" value="<?php echo $pest_qty_hh; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_h" id="instruction_h" value="<?php echo $instruction_hh; ?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="visit_annum_h" id="visit_annum_h" disabled>
							<option value ="">Visit</option>
							<?php if ($job_type == "Contract") {
								$query784 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
								} else {
								$query784 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
								}									
								$exec784 = mysql_query($query784) or die ("Error in query784".mysql_error());
								while ($res784 = mysql_fetch_array($exec784))
								{
								$visit_frequency_hh = $res784["visit_frequency"]; ?>
							<option value ="<?php echo $visit_frequency_hh; ?>" <?php if ($visit_annum_hh == $visit_frequency_hh ) { echo 'selected="selected"';} ?>><?php echo $visit_frequency_hh; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_h" value="<?php echo $add_freq_hh; ?>" id="add_freq_h" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_h" id="annual_value_h" value="<?php echo $annual_value_hh; ?>" placeholder="" readonly>
						<input type="hidden" class="form-control" name="product_count_h" id="product_count_h" value="8" placeholder="" readonly>
				  </div>
				</div>
			</div> <br>
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $preparations_lbl; ?></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_a" id="preparation_a" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query110 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec110 = mysql_query($query110) or die ("Error in Query110".mysql_error());
							while ($res110 = mysql_fetch_array($exec110))
							{
							$equipment_id_a = $res110["id"];
							$equipment_name_a = $res110["equipment_name"];
							if ($equipment_id_a === $preparation_id_aa) {
								echo '<option value="' .$preparation_id_aa.'" selected="selected" />'.$equipment_name_a.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_a.'">'.$equipment_name_a.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $unit_cost_lbl; ?></label>
						<input type="text" class="form-control" name="unit_cost_a" id="unit_cost_a" value="<?php echo $unit_cost_aa;?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_a" id="unit_selling_a" value="<?php echo $unit_selling_aa;?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $qty_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="qty_a" id="qty_a" value="<?php echo $qty_aa; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $tot_val_unit_lbl; ?></label>
						<input type="text" class="form-control" name="tot_val_unit_a" id="tot_val_unit_a" value="<?php echo $tot_val_unit_aa;?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_a" id="tot_val_cost_a" value="<?php echo $tot_val_cost_aa; ?>" style="text-align:right" placeholder="S$" readonly>
						
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $units_per_tmt_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_a" id="unit_per_tmt_a" value="<?php echo $unit_per_tmt_aa; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $tmt_per_annum_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_a" id="tmt_per_annum_a" value="<?php echo $tmt_per_annum_aa; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $val_per_annum_lbl; ?></label>
						<input type="text" class="form-control" name="val_per_annum_a" id="val_per_annum_a" value="<?php echo $val_per_annum_aa; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_a" id="val_per_annum_cost_a" value="<?php echo $val_per_annum_cost_aa; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_a" id="pest_count_a" value="1" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_b" id="preparation_b" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query111 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
							while ($res111 = mysql_fetch_array($exec111))
							{
							$equipment_id_b = $res111["id"];
							$equipment_name_b = $res111["equipment_name"];
							if ($equipment_id_b === $preparation_id_bb) {
								echo '<option value="' .$preparation_id_bb.'" selected="selected" />'.$equipment_name_b.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_b.'">'.$equipment_name_b.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_b" id="unit_cost_b" value="<?php echo $unit_cost_bb; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_b" id="unit_selling_b" value="<?php echo $unit_selling_bb; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="qty_b" id="qty_b" value="<?php echo $qty_bb; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_b" id="tot_val_unit_b" value="<?php echo $tot_val_unit_bb; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_b" id="tot_val_cost_b" value="<?php echo $tot_val_cost_bb; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_b" id="unit_per_tmt_b" value="<?php echo $unit_per_tmt_bb; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_b" id="tmt_per_annum_b" value="<?php echo $tmt_per_annum_bb; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_b" id="val_per_annum_b" value="<?php echo $val_per_annum_bb; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_b" id="val_per_annum_cost_b" value="<?php echo $val_per_annum_cost_bb; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_b" id="pest_count_b" value="2" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_c" id="preparation_c" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query112 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec112 = mysql_query($query112) or die ("Error in Query112".mysql_error());
							while ($res112 = mysql_fetch_array($exec112))
							{
							$equipment_id_c = $res112["id"];
							$equipment_name_c = $res112["equipment_name"];
							if ($equipment_id_c === $preparation_id_cc) {
								echo '<option value="' .$preparation_id_cc.'" selected="selected" />'.$equipment_name_c.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_c.'">'.$equipment_name_c.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_c" id="unit_cost_c" value="<?php echo $unit_cost_cc; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_c" id="unit_selling_c" value="<?php echo $unit_selling_cc; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="qty_c" id="qty_c" value="<?php echo $qty_cc; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_c" id="tot_val_unit_c" value="<?php echo $tot_val_unit_cc; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_c" id="tot_val_cost_c" value="<?php echo $tot_val_cost_cc; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_c" id="unit_per_tmt_c" value="<?php echo $unit_per_tmt_cc; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_c" id="tmt_per_annum_c" value="<?php echo $tmt_per_annum_cc; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_c" id="val_per_annum_c" value="<?php echo $val_per_annum_cc; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_c" id="val_per_annum_cost_c" value="<?php echo $val_per_annum_cost_cc; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_c" id="pest_count_c" value="3" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_d" id="preparation_d" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query113 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec113 = mysql_query($query113) or die ("Error in Query113".mysql_error());
							while ($res113 = mysql_fetch_array($exec113))
							{
							$equipment_id_d = $res113["id"];
							$equipment_name_d = $res113["equipment_name"];
							if ($equipment_id_d === $preparation_id_dd) {
								echo '<option value="' .$preparation_id_dd.'" selected="selected" />'.$equipment_name_d.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_d.'">'.$equipment_name_d.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_d" id="unit_cost_d" value="<?php echo $unit_cost_dd; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_d" id="unit_selling_d" value="<?php echo $unit_selling_dd; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="qty_d" id="qty_d" value="<?php echo $qty_dd; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_d" id="tot_val_unit_d" value="<?php echo $tot_val_unit_dd; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_d" id="tot_val_cost_d" value="<?php echo $tot_val_cost_dd; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_d" id="unit_per_tmt_d" value="<?php echo $unit_per_tmt_dd; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_d" id="tmt_per_annum_d" value="<?php echo $tmt_per_annum_dd; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_d" id="val_per_annum_d" value="<?php echo $val_per_annum_dd; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_d" id="val_per_annum_cost_d" value="<?php echo $val_per_annum_cost_dd; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_d" id="pest_count_d" value="4" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_e" id="preparation_e" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query114 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec114 = mysql_query($query114) or die ("Error in Query114".mysql_error());
							while ($res114 = mysql_fetch_array($exec114))
							{
							$equipment_id_e = $res114["id"];
							$equipment_name_e = $res114["equipment_name"];
							if ($equipment_id_e === $preparation_id_ee) {
								echo '<option value="' .$preparation_id_ee.'" selected="selected" />'.$equipment_name_e.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_e.'">'.$equipment_name_e.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_e" id="unit_cost_e" value="<?php echo $unit_cost_ee; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_e" id="unit_selling_e" value="<?php echo $unit_selling_ee; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="qty_e" id="qty_e" value="<?php echo $qty_ee; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_e" id="tot_val_unit_e" value="<?php echo $tot_val_unit_ee; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_e" id="tot_val_cost_e" value="<?php echo $tot_val_cost_ee; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_e" id="unit_per_tmt_e" value="<?php echo $unit_per_tmt_ee; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_e" id="tmt_per_annum_e" value="<?php echo $tmt_per_annum_ee; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_e" id="val_per_annum_e" value="<?php echo $val_per_annum_ee; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_e" id="val_per_annum_cost_e" value="<?php echo $val_per_annum_cost_ee; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_e" id="pest_count_e" value="5" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_f" id="preparation_f" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query115 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec115 = mysql_query($query115) or die ("Error in Query115".mysql_error());
							while ($res115 = mysql_fetch_array($exec115))
							{
							$equipment_id_f = $res115["id"];
							$equipment_name_f = $res115["equipment_name"];
							if ($equipment_id_f === $preparation_id_ff) {
								echo '<option value="' .$preparation_id_ff.'" selected="selected" />'.$equipment_name_f.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_f.'">'.$equipment_name_f.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_f" id="unit_cost_f" value="<?php echo $unit_cost_ff; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_f" id="unit_selling_f" value="<?php echo $unit_selling_ff; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="qty_f" id="qty_f" value="<?php echo $qty_ff; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_f" id="tot_val_unit_f" value="<?php echo $tot_val_unit_ff; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_f" id="tot_val_cost_f" value="<?php echo $tot_val_cost_ff; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_f" id="unit_per_tmt_f" value="<?php echo $unit_per_tmt_ff; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_f" id="tmt_per_annum_f" value="<?php echo $tmt_per_annum_ff; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_f" id="val_per_annum_f" value="<?php echo $val_per_annum_ff; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_f" id="val_per_annum_cost_f" value="<?php echo $val_per_annum_cost_ff; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_f" id="pest_count_f" value="6" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_g" id="preparation_g" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query116 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec116 = mysql_query($query116) or die ("Error in Query115".mysql_error());
							while ($res116 = mysql_fetch_array($exec116))
							{
							$equipment_id_g = $res116["id"];
							$equipment_name_g = $res116["equipment_name"];
							if ($equipment_id_g === $preparation_id_gg) {
								echo '<option value="' .$preparation_id_gg.'" selected="selected" />'.$equipment_name_g.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_g.'">'.$equipment_name_g.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_g" id="unit_cost_g" value="<?php echo $unit_cost_gg; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_g" id="unit_selling_g" value="<?php echo $unit_selling_gg; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="qty_g" id="qty_g" value="<?php echo $qty_gg; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_g" id="tot_val_unit_g" value="<?php echo $tot_val_unit_gg; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_g" id="tot_val_cost_g" value="<?php echo $tot_val_cost_gg; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_g" id="unit_per_tmt_g" value="<?php echo $unit_per_tmt_gg; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_g" id="tmt_per_annum_g" value="<?php echo $tmt_per_annum_gg; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_g" id="val_per_annum_g" value="<?php echo $val_per_annum_gg; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_g" id="val_per_annum_cost_g" value="<?php echo $val_per_annum_cost_gg; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_g" id="pest_count_g" value="7" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_h" id="preparation_h" disabled>
							<option value="">Please choose Preparation</option>
							<?php
							$query117 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec117 = mysql_query($query117) or die ("Error in Query117".mysql_error());
							while ($res117 = mysql_fetch_array($exec117))
							{
							$equipment_id_h = $res117["id"];
							$equipment_name_h = $res117["equipment_name"];
							if ($equipment_id_h === $preparation_id_hh) {
								echo '<option value="' .$preparation_id_hh.'" selected="selected" />'.$equipment_name_h.'</option>';
							} else {
								echo '<option value ="'.$equipment_id_h.'">'.$equipment_name_h.'</option>';
							}
							}
							?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_h" id="unit_cost_h" value="<?php echo $unit_cost_hh; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_h" id="unit_selling_h" value="<?php echo $unit_selling_hh; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="qty_h" id="qty_h" value="<?php echo $qty_hh; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_h" id="tot_val_unit_h" value="<?php echo $tot_val_unit_hh; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_h" id="tot_val_cost_h" value="<?php echo $tot_val_cost_hh; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="unit_per_tmt_h" id="unit_per_tmt_h" value="<?php echo $unit_per_tmt_hh; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_h" id="tmt_per_annum_h" value="<?php echo $tmt_per_annum_hh; ?>" style="text-align:right" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_h" id="val_per_annum_h" value="<?php echo $val_per_annum_hh; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_h" id="val_per_annum_cost_h" value="<?php echo $val_per_annum_cost_hh; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_h" id="pest_count_h" value="8" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $total_preparation_lbl; ?></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="total_unit" id="total_unit" value="<?php echo $total_unit; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="total_unit_cost" id="total_unit_cost" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="total_unit_annum" id="total_unit_annum" value="<?php echo $total_unit_annum; ?>" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="total_unit_cost_annum" id="total_unit_cost_annum" value="<?php echo $total_unit_cost_annum; ?>" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
			</div> <br>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
					<label><u><?php echo $labour_lbl; ?></u></label><br>
						<b><?php echo $main_frequency_lbl; ?></b>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $shift_type_lbl; ?></label>
						<select class="form-control" name="shift_type_a" id="shift_type_a" disabled>
							<option value="">Please choose Shift Type</option>
							<option value="Normal" <?php if($shift_type_aa == 'Normal') { echo 'selected="selected"'; }?> >Normal</option>
							<option value="Evening Shift" <?php if($shift_type_aa == 'Evening Shift') { echo 'selected="selected"'; }?>>Evening Shift</option>
							<option value="Public Holiday/Sunday" <?php if($shift_type_aa == 'Public Holiday/Sunday') { echo 'selected="selected"'; }?>>Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $per_hour_lbl; ?></label>
						<input type="text" class="form-control" name="per_hour_a" id="per_hour_a" value="<?php echo $per_hour_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_a" id="fix_cost_per_hour_a" value="<?php echo $fix_cost_per_hour_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_a" id="wfix_cost_per_hour_a" value="<?php echo $wfix_cost_per_hour_aa;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $no_hours_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="no_hours_a" value="<?php echo $no_hours_aa;?>" id="no_hours_a" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $total_hours_lbl; ?></label>
						<input type="text" class="form-control" name="total_hours_a" id="total_hours_a" value="<?php echo $total_hours_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_a" id="fix_cost_total_hours_a" value="<?php echo $fix_cost_total_hours_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_a" id="wfix_cost_total_hours_a" value="<?php echo $wfix_cost_total_hours_aa;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $tmt_hours_lbl; ?></label>
						<input type="time" class="form-control" name="tmt_hours_a" id="tmt_hours_a" value="<?php echo $tmt_hours_aa;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $tmt_annum_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="tmt_annum_a" id="tmt_annum_a" value="<?php echo $tmt_annum_aa;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $labour_value_lbl; ?></label>
						<input type="text" class="form-control" name="labour_value_a" id="labour_value_a" value="<?php echo $labour_value_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_a" id="fix_cost_labour_value_a" value="<?php echo $fix_cost_labour_value_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_a" id="wfix_cost_labour_value_a" value="<?php echo $wfix_cost_labour_value_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="labour_count_a" id="labour_count_a" value="1" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
					<label></label><br>
						<b><?php echo $add_fre_a_lbl; ?></b>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="shift_type_b" id="shift_type_b" disabled>
							<option value="">Please choose Shift Type</option>
							<option value="Normal" <?php if($shift_type_bb == 'Normal') { echo 'selected="selected"'; }?> >Normal</option>
							<option value="Evening Shift" <?php if($shift_type_bb == 'Evening Shift') { echo 'selected="selected"'; }?>>Evening Shift</option>
							<option value="Public Holiday/Sunday" <?php if($shift_type_bb == 'Public Holiday/Sunday') { echo 'selected="selected"'; }?>>Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="per_hour_b" id="per_hour_b" value="<?php echo $per_hour_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_b" id="fix_cost_per_hour_b" value="<?php echo $fix_cost_per_hour_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_b" id="wfix_cost_per_hour_b" value="<?php echo $wfix_cost_per_hour_bb;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="no_hours_b" id="no_hours_b" value="<?php echo $no_hours_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_hours_b" id="total_hours_b" value="<?php echo $total_hours_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_b" id="fix_cost_total_hours_b" value="<?php echo $fix_cost_total_hours_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_b" id="wfix_cost_total_hours_b" value="<?php echo $wfix_cost_total_hours_bb;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="time" class="form-control" name="tmt_hours_b" id="tmt_hours_b" value="<?php echo $tmt_hours_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="tmt_annum_b" id="tmt_annum_b" value="<?php echo $tmt_annum_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="labour_value_b" id="labour_value_b" value="<?php echo $labour_value_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_b" id="fix_cost_labour_value_b" value="<?php echo $fix_cost_labour_value_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_b" id="wfix_cost_labour_value_b" value="<?php echo $wfix_cost_labour_value_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="labour_count_b" id="labour_count_b" value="2" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
					<label></label><br>
						<b><?php echo $add_fre_b_lbl; ?></b>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="shift_type_c" id="shift_type_c" disabled>
							<option value="">Please choose Shift Type</option>
							<option value="Normal" <?php if($shift_type_cc == 'Normal') { echo 'selected="selected"'; }?> >Normal</option>
							<option value="Evening Shift" <?php if($shift_type_cc == 'Evening Shift') { echo 'selected="selected"'; }?>>Evening Shift</option>
							<option value="Public Holiday/Sunday" <?php if($shift_type_cc == 'Public Holiday/Sunday') { echo 'selected="selected"'; }?>>Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="per_hour_c" id="per_hour_c" value="<?php echo $per_hour_cc;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_c" id="fix_cost_per_hour_c" value="<?php echo $fix_cost_per_hour_cc;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_c" id="wfix_cost_per_hour_c" value="<?php echo $wfix_cost_per_hour_cc;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="no_hours_c" id="no_hours_c" value="<?php echo $no_hours_cc;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_hours_c" id="total_hours_c" value="<?php echo $total_hours_cc;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_c" id="fix_cost_total_hours_c" value="<?php echo $fix_cost_total_hours_cc;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_c" id="wfix_cost_total_hours_c" value="<?php echo $wfix_cost_total_hours_cc;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="time" class="form-control" name="tmt_hours_c" id="tmt_hours_c" value="<?php echo $tmt_hours_cc;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="tmt_annum_c" id="tmt_annum_c" value="<?php echo $tmt_annum_cc;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="labour_value_c" id="labour_value_c" value="<?php echo $labour_value_cc;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_c" id="fix_cost_labour_value_c" value="<?php echo $fix_cost_labour_value_cc;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_c" id="wfix_cost_labour_value_c" value="<?php echo $wfix_cost_labour_value_cc;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="labour_count_c" id="labour_count_c" placeholder="S$" value="3">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
					<label></label><br>
						<b><?php echo $overtime_rate_lbl; ?></b>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label><br>
						<select class="form-control" name="shift_type_d" id="shift_type_d" disabled>
							<option value="">Please choose Shift Type</option>
							<option value="Normal" <?php if($shift_type_dd == 'Normal') { echo 'selected="selected"'; }?> >Normal</option>
							<option value="Evening Shift" <?php if($shift_type_dd == 'Evening Shift') { echo 'selected="selected"'; }?>>Evening Shift</option>
							<option value="Public Holiday/Sunday" <?php if($shift_type_dd == 'Public Holiday/Sunday') { echo 'selected="selected"'; }?>>Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="per_hour_d" id="per_hour_d" value="<?php echo $per_hour_dd; ?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_d" id="fix_cost_per_hour_d" value="<?php echo $fix_cost_per_hour_dd; ?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_d" id="wfix_cost_per_hour_d" value="<?php echo $wfix_cost_per_hour_dd; ?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="no_hours_d" id="no_hours_d" value="<?php echo $no_hours_dd;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_hours_d" id="total_hours_d" value="<?php echo $total_hours_dd;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_d" id="fix_cost_total_hours_d" value="<?php echo $fix_cost_total_hours_dd;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_d" id="wfix_cost_total_hours_d" value="<?php echo $wfix_cost_total_hours_dd;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="time" class="form-control" name="tmt_hours_d" id="tmt_hours_d" value="<?php echo $tmt_hours_dd;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="tmt_annum_d" id="tmt_annum_d" value="<?php echo $tmt_annum_dd;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="labour_value_d" id="labour_value_d" value="<?php echo $labour_value_dd;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_d" id="fix_cost_labour_value_d" value="<?php echo $fix_cost_labour_value_dd;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_d" id="wfix_cost_labour_value_d" value="<?php echo $wfix_cost_labour_value_dd;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="labour_count_d" id="labour_count_d" placeholder="S$" value="4">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
					<label></label>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<label></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<label><?php echo $total_labour_lbl; ?></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_labour" id="total_labour" value="<?php echo $total_labour;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_labour" id="fix_cost_total_labour" value="<?php echo $fix_cost_total_labour;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_labour" id="wfix_cost_total_labour" value="<?php echo $wfix_cost_total_labour;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_labour_annum" id="total_labour_annum" value="<?php echo $total_labour_annum;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_labour_annum" id="fix_cost_total_labour_annum" value="<?php echo $fix_cost_total_labour_annum;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_labour_annum" id="wfix_cost_total_labour_annum" value="<?php echo $wfix_cost_total_labour_annum;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="box-header">
					<h3 class="box-title"><?php echo $other_item_lbl; ?></h3>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $type_lbl; ?></label>
						<input type="text" class="form-control" name="type_a" id="type_a" value="<?php echo $type_aa;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $unit_cost_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_unit_cost_a" id="other_unit_cost_a" value="<?php echo $other_unit_cost_aa;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $no_items_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_item_a" id="other_item_a" value="<?php echo $other_item_aa;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $oth_tot_val_lbl; ?></label>
						<input type="text" class="form-control" name="other_tot_val_a" id="other_tot_val_a" value="<?php echo $other_tot_val_aa;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $oth_item_tmt_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_tot_item_a" id="other_tot_item_a" value="<?php echo $other_tot_item_aa;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $oth_tmt_annum_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_tmt_annum_a" id="other_tmt_annum_a" value="<?php echo $other_tmt_annum_aa;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $oth_tot_per_annum_lbl; ?></label>
						<input type="text" class="form-control" name="other_tot_annum_a" id="other_tot_annum_a" value="<?php echo $other_tot_annum_aa;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="other_count_a" id="other_count_a" placeholder="" value="1">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="type_b" id="type_b" value="<?php echo $type_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_unit_cost_b" id="other_unit_cost_b" value="<?php echo $other_unit_cost_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_item_b" id="other_item_b" value="<?php echo $other_item_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="other_tot_val_b" id="other_tot_val_b" value="<?php echo $other_tot_val_bb;?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_tot_item_b" id="other_tot_item_b" value="<?php echo $other_tot_item_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_tmt_annum_b" id="other_tmt_annum_b" value="<?php echo $other_tmt_annum_bb;?>" placeholder="" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="other_tot_annum_b" id="other_tot_annum_b" value="<?php echo $other_tot_annum_bb;?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="other_count_b" id="other_count_b" placeholder="" value="2">
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group" style="text-align:right;">
						<label><?php echo $other_total_lbl; ?></label><br>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="other_total_a" id="other_total_a" value="<?php echo $other_total_a; ?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
				  </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="other_total_b" id="other_total_b" value="<?php echo $other_total_b; ?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group" style="text-align:right;">
						<label><?php echo $treatment_a_lbl; ?></label><br>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="treatment_a" id="treatment_a" value="<?php echo $treatment_a; ?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group" style="text-align:right;">
						<label><?php echo $treatment_b_lbl; ?></label><br>
				  </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="treatment_b" id="treatment_b" value="<?php echo $treatment_b; ?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<label></label>
				  </div>
				</div>
			</div>
			<div class="row">
			<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group" style="text-align:right;">
						<label></label><br>
						<label><?php echo $total_annual_cost_lbl; ?></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_annual_cost" id="total_annual_cost" value="<?php echo $total_annual_cost; ?>" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group" style="text-align:right;">
						<label></label><br>
						<label><?php echo $price_accept_lbl; ?><small><?php echo $execusive_lbl; ?></small></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="price_accept" id="price_accept" value="<?php echo $price_accept; ?>" placeholder="S$" style="text-align:right" readonly>
							<div style="text-align: center;">
								<span id="percentage_result"style="color:red;" ></span>
							</div>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<div class="form-group">
						<label></label><br>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group" style="text-align:right;">
						<label></label><br>
						<label><?php echo $price_accept_lbl; ?><small><?php echo $tax_lbl; ?></small></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="price_accept_tax" id="price_accept_tax" value="<?php echo $price_accept_tax; ?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" min="1" class="form-control" name="total_percentage" id="total_percentage" value="<?php echo $total_percentage; ?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" min="1" class="form-control" name="fix_percentage" id="fix_percentage" value="<?php echo $fix_percentage; ?>" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" min="1" class="form-control" name="wfix_percentage" id="wfix_percentage" value="<?php echo $wfix_percentage; ?>" placeholder="S$" style="text-align:right" readonly>
							<div style="text-align: center;">
								
							</div>
				  </div>
				</div>
			</div>
			
			<div class="row" id="actual_gm">
			<div class="col-md-3">
					<div class="form-group">
						<label></label><br>
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label><br>
						<label></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<label><?php echo $actual_gm_lbl; ?></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<span id="actual_gm_result" style="color:red;" ></span>
							<div style="text-align: center;">
								
							</div>
				  </div>
				</div>
			</div>
			
			<div class="row" id="gm_wo">
			<div class="col-md-3">
					<div class="form-group">
						<label></label><br>
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label><br>
						<label></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<label><?php echo $gm_wo_lbl; ?></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<span id="gm_wo_result" style="color:red;" ></span>
							<div style="text-align: center;">
								
							</div>
				  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $finance_note_lbl; ?></label><br>
						<textarea class="form-control" id="finance_note" name="finance_note" rows="3" readonly><?php echo $finance_note; ?></textarea>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $service_note_lbl; ?></label><br>
						<textarea class="form-control" id="service_note" name="service_note" rows="3" readonly><?php echo $service_note; ?></textarea>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $billing_frequency_lbl; ?><span style="color:red">*</span></label><br>
						<select name="billing_frequency" id="billing_frequency" class="form-control" required disabled>
							<option value="">Please Choose Billing Frequency</option>
							<option value="Annually" <?php if($billing_frequency == 'Annually') { echo 'selected="selected"'; }?>>Annually</option>
							<option value="Bi Annually" <?php if($billing_frequency == 'Bi Annually') { echo 'selected="selected"'; }?>>Bi Annually</option>
							<option value="Monthly" <?php if($billing_frequency == 'Monthly') { echo 'selected="selected"'; }?>>Monthly</option>
							<option value="Bi-Monthly" <?php if($billing_frequency == 'Bi-Monthly') { echo 'selected="selected"'; }?>>Bi-Monthly</option>
							<option value="Quarterly" <?php if($billing_frequency == 'Quarterly') { echo 'selected="selected"'; }?>>Quarterly</option>
							<option value="Visit Trigger" <?php if($billing_frequency == 'Visit Trigger') { echo 'selected="selected"'; }?>>Visit Trigger</option>
							<option value="Visit Trigger Monthly" <?php if($billing_frequency == 'Visit Trigger Monthly') { echo 'selected="selected"'; }?>>Visit Trigger Monthly</option>
							<option value="One Time Invoice (Job)" <?php if($billing_frequency == 'One Time Invoice (Job)') { echo 'selected="selected"'; }?>>One Time Invoice (Job)</option>
							<option value="Progressive Billing(ST)" <?php if($billing_frequency == 'Progressive Billing(ST)') { echo 'selected="selected"'; }?>>Progressive Billing(ST)</option>
						</select>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $credit_term_lbl; ?></label><span style="color:red">*</span><br>
						<select name="credit_term" id="credit_term" class="form-control" required disabled>
							<option value="15 Days" <?php if($credit_term == '15 Days') { echo 'selected="selected"'; }?>>15 Days</option>
							<option value="30 Days" <?php if($credit_term == '30 Days' || $credit_term == '') { echo 'selected="selected"'; }?>>30 Days</option>
							<option value="45 Days" <?php if($credit_term == '45 Days') { echo 'selected="selected"'; }?>>45 Days</option>
							<option value="60 Days" <?php if($credit_term == '60 Days') { echo 'selected="selected"'; }?>>60 Days</option>
							<option value="90 Days" <?php if($credit_term == '90 Days') { echo 'selected="selected"'; }?>>90 Days</option>
							<option value="120 Days" <?php if($credit_term == '120 Days') { echo 'selected="selected"'; }?>>120 Days</option>
							<option value="Immediate Payment" <?php if($credit_term == 'Immediate Payment') { echo 'selected="selected"'; }?>>Immediate Payment</option>
						</select>
				  </div>
				</div>
				
			</div>
			<div class="row">
			     <div class="col-md-3">
					<div class="form-group">
						<label><?php echo $invoice_type_lbl; ?></label><span style="color:red">*</span><br>
						<select name="invoice_type" id="invoice_type" class="form-control" required disabled>
							<option value="">Please Choose Invoice Type</option>
							<option value="Advance (Normal)" <?php if($invoice_type == 'Advance (Normal)') { echo 'selected="selected"'; }?>>Advance (Normal)</option>
							<option value="Visit Triggered" <?php if($invoice_type == 'Visit Triggered') { echo 'selected="selected"'; }?>>Visit Triggered</option>
							<option value="Visit Triggered Monthly" <?php if($invoice_type == 'Visit Triggered Monthly') { echo 'selected="selected"'; }?>>Visit Triggered Monthly</option>
							<option value="Visit Triggered Quarterly" <?php if($invoice_type == 'Visit Triggered Quarterly') { echo 'selected="selected"'; }?>>Visit Triggered Quarterly</option>
							<option value="Progressive Billing (ST)" <?php if($invoice_type == 'Progressive Billing (ST)') { echo 'selected="selected"'; }?>>Progressive Billing (ST)</option>
						</select>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $invoice_attachment_lbl; ?></label><br>
						<select name="invoice_attachment" id="invoice_attachment" class="form-control" disabled>
							<option value="None" <?php if($invoice_attachment == 'None') { echo 'selected="selected"'; }?>>None</option>
							<option value="Service Docket (with Stamp)" <?php if($invoice_attachment == 'Service Docket (with Stamp)') { echo 'selected="selected"'; }?>>Service Docket (with Stamp)</option>
							<option value="Service Docket" <?php if($invoice_attachment == 'Service Docket') { echo 'selected="selected"'; }?>>Service Docket</option>
							<option value="Others" <?php if($invoice_attachment == 'Others') { echo 'selected="selected"'; }?>>Others</option>
						</select>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $po_number_lbl; ?></label>
						<input type="text" class="form-control" name="po_number" id="po_number" placeholder="PO Number" value="<?php echo $po_number; ?>" readonly>
					</div>
				</div>
			    <div class="col-md-3">
					<div class="form-group">
					<label>Attachment 1:</label>
					<input type="file" name="attachment_a" id="attachment_a" class="form-control" disabled>
					<?php if($attachment_a != '') { ?><div id="file_a"><a href="<?php echo $attachment_a; ?>" download><?php echo $filename_a; ?></a></div> <?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 2:</label>
					<input type="file" name="attachment_b" id="attachment_b" class="form-control" disabled>
					<?php if($attachment_b != '') { ?><div id="file_b"><a href="<?php echo $attachment_b; ?>" download><?php echo $filename_b; ?></a></div><?php } ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 3:</label>
					<input type="file" name="attachment_c" id="attachment_c" class="form-control" disabled>
					<?php if($attachment_c != '') { ?><div id="file_c"><a href="<?php echo $attachment_c; ?>" download><?php echo $filename_c; ?></a></div><?php } ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 4:</label>
					<input type="file" name="attachment_d" id="attachment_d" class="form-control" disabled>
					<?php if($attachment_d != '') { ?><div id="file_d"><a href="<?php echo $attachment_d; ?>" download><?php echo $filename_d; ?></a></div><?php } ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 5:</label>
					<input type="file" name="attachment_e" id="attachment_e" class="form-control" disabled>
					<?php if($attachment_e != '') { ?><div id="file_e"><a href="<?php echo $attachment_e; ?>" download><?php echo $filename_e; ?></a>&nbsp;&nbsp;<i class="fa fa-times" onclick="delete_file_e();"></i></div><?php } ?>
					</div>
				</div>
			</div>
		</div>
			
          </div>
        </div>
		<div class="box-footer">
                <button type="submit" name="save" id="save" class="btn btn-success pull-center"><?php echo $update_lbl; ?></button>
				<span id="save_processing" class="pull-left" style="display:none;"><img src="../images/update_e.gif" id="loading_img" width="35"/>Processing...</span>
                <button type="submit" name="submit" id="submit" class="btn btn-info pull-right"><?php echo $submit_lbl; ?></button>
				<span id="submit_processing" class="pull-right" style="display:none;"><img src="../images/update_e.gif" id="loading_img" width="35"/>Processing...</span>
          </div>
      </div>
	</form>
    </section>
 
  </div>

  <footer class="main-footer">
	<?php include ('../includes/footer.php'); ?>
  </footer>
  
  <div class="control-sidebar-bg"></div>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../plugins/ajax/ajax.js"></script>
<script src="../plugins/ajax/jquery-3.2.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<!--<script src="../plugins/select2/select2.full.min.js"></script>-->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="../plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
	$('#datepicker1').datepicker({
      autoclose: true
    });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
  
  $(document).ready(function(){
	  $("#actual_gm").hide();
	  $("#gm_wo").hide();
	  $("#preparation_a").change(function(){
		  var x = document.getElementById("preparation_a").value;
		  var qty_a = document.getElementById("qty_a").value;
		  var tmt_per_annum_a = document.getElementById("tmt_per_annum_a").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_a:x},
			success: function(result) {
				if (result){
					$('#unit_cost_a').val(result.selling_price);
					$('#unit_selling_a').val(result.cost_price);
				    if (qty_a != '') {
						var tot_val_unit_a = (result.selling_price * qty_a).toFixed(2);
						$('#tot_val_unit_a').val(tot_val_unit_a);
                        var tot_val_cost_a = (result.cost_price * qty_a).toFixed(2);
						$('#tot_val_cost_a').val(tot_val_cost_a);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_a != '') {
						var val_per_annum_a = (result.selling_price * qty_a * tmt_per_annum_a).toFixed(2);
						$('#val_per_annum_a').val(val_per_annum_a);
                        var val_per_annum_cost_a = (result.cost_price * qty_a * tmt_per_annum_a).toFixed(2);
						$('#val_per_annum_cost_a').val(val_per_annum_cost_a);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#preparation_b").change(function(){
		  var x = document.getElementById("preparation_b").value;
		  var qty_b = document.getElementById("qty_b").value;
          var tmt_per_annum_b = document.getElementById("tmt_per_annum_b").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_b:x},
			success: function(result) {
				if (result){
					$('#unit_cost_b').val(result.selling_price);
					$('#unit_selling_b').val(result.cost_price);
					if (qty_b != '') {
						var tot_val_unit_b = (result.selling_price * qty_b).toFixed(2);
						$('#tot_val_unit_b').val(tot_val_unit_b);
                        var tot_val_cost_b = (result.cost_price * qty_b).toFixed(2);
						$('#tot_val_cost_b').val(tot_val_cost_b);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_b != '') {
						var val_per_annum_b = (result.selling_price * qty_b * tmt_per_annum_b).toFixed(2);
						$('#val_per_annum_b').val(val_per_annum_b);
                        var val_per_annum_cost_b = (result.cost_price * qty_b * tmt_per_annum_b).toFixed(2);
						$('#val_per_annum_cost_b').val(val_per_annum_cost_b);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#preparation_c").change(function(){
		  var x = document.getElementById("preparation_c").value;
		  var qty_c = document.getElementById("qty_c").value;
		  var tmt_per_annum_c = document.getElementById("tmt_per_annum_c").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_c:x},
			success: function(result) {
				if (result){
					$('#unit_cost_c').val(result.selling_price);
					$('#unit_selling_c').val(result.cost_price);
					if (qty_c != '') {
						var tot_val_unit_c = (result.selling_price * qty_c).toFixed(2);
						$('#tot_val_unit_c').val(tot_val_unit_c);
                        var tot_val_cost_c = (result.cost_price * qty_c).toFixed(2);
						$('#tot_val_cost_c').val(tot_val_cost_c);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_c != '') {
						var val_per_annum_c = (result.selling_price * qty_c * tmt_per_annum_c).toFixed(2);
						$('#val_per_annum_c').val(val_per_annum_c);
                        var val_per_annum_cost_c = (result.cost_price * qty_c * tmt_per_annum_c).toFixed(2);
						$('#val_per_annum_cost_c').val(val_per_annum_cost_c);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#preparation_d").change(function(){
		  var x = document.getElementById("preparation_d").value;
		  var qty_d = document.getElementById("qty_d").value;
          var tmt_per_annum_d = document.getElementById("tmt_per_annum_d").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_d:x},
			success: function(result) {
				if (result){
					$('#unit_cost_d').val(result.selling_price);
					$('#unit_selling_d').val(result.cost_price);
					if (qty_d != '') {
						var tot_val_unit_d = (result.selling_price * qty_d).toFixed(2);
						$('#tot_val_unit_d').val(tot_val_unit_d);
                        var tot_val_cost_d = (result.cost_price * qty_d).toFixed(2);
						$('#tot_val_cost_d').val(tot_val_cost_d);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_d != '') {
						var val_per_annum_d = (result.selling_price * qty_d * tmt_per_annum_d).toFixed(2);
						$('#val_per_annum_d').val(val_per_annum_d);
                        var val_per_annum_cost_d = (result.cost_price * qty_d * tmt_per_annum_d).toFixed(2);
						$('#val_per_annum_cost_d').val(val_per_annum_cost_d);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#preparation_e").change(function(){
		  var x = document.getElementById("preparation_e").value;
		  var qty_e = document.getElementById("qty_e").value;
          var tmt_per_annum_e = document.getElementById("tmt_per_annum_e").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_e:x},
			success: function(result) {
				if (result){
					$('#unit_cost_e').val(result.selling_price);
					$('#unit_selling_e').val(result.cost_price);
					if (qty_e != '') {
						var tot_val_unit_e = (result.selling_price * qty_e).toFixed(2);
						$('#tot_val_unit_e').val(tot_val_unit_e);
                        var tot_val_cost_e = (result.cost_price * qty_e).toFixed(2);
						$('#tot_val_cost_e').val(tot_val_cost_e);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_e != '') {
						var val_per_annum_e = (result.selling_price * qty_e * tmt_per_annum_e).toFixed(2);
						$('#val_per_annum_e').val(val_per_annum_e);
                        var val_per_annum_cost_e = (result.cost_price * qty_e * tmt_per_annum_e).toFixed(2);
						$('#val_per_annum_cost_e').val(val_per_annum_cost_e);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#preparation_f").change(function(){
		  var x = document.getElementById("preparation_f").value;
		  var qty_f = document.getElementById("qty_f").value;
          var tmt_per_annum_f = document.getElementById("tmt_per_annum_f").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_f:x},
			success: function(result) {
				if (result){
					$('#unit_cost_f').val(result.selling_price);
					$('#unit_selling_f').val(result.cost_price);
					if (qty_f != '') {
						var tot_val_unit_f = (result.selling_price * qty_f).toFixed(2);
						$('#tot_val_unit_f').val(tot_val_unit_f);
                        var tot_val_cost_f = (result.cost_price * qty_f).toFixed(2);
						$('#tot_val_cost_f').val(tot_val_cost_f);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_f != '') {
						var val_per_annum_f = (result.selling_price * qty_f * tmt_per_annum_f).toFixed(2);
						$('#val_per_annum_f').val(val_per_annum_f);
                        var val_per_annum_cost_f = (result.cost_price * qty_f * tmt_per_annum_f).toFixed(2);
						$('#val_per_annum_cost_f').val(val_per_annum_cost_f);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#preparation_g").change(function(){
		  var x = document.getElementById("preparation_g").value;
		  var qty_g = document.getElementById("qty_g").value;
          var tmt_per_annum_g = document.getElementById("tmt_per_annum_g").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_g:x},
			success: function(result) {
				if (result){
					$('#unit_cost_g').val(result.selling_price);
					$('#unit_selling_g').val(result.cost_price);
					if (qty_g != '') {
						var tot_val_unit_g = (result.selling_price * qty_g).toFixed(2);
						$('#tot_val_unit_g').val(tot_val_unit_g);
                        var tot_val_cost_g = (result.cost_price * qty_g).toFixed(2);
						$('#tot_val_cost_g').val(tot_val_cost_g);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_g != '') {
						var val_per_annum_g = (result.selling_price * qty_g * tmt_per_annum_g).toFixed(2);
						$('#val_per_annum_g').val(val_per_annum_g);
                        var val_per_annum_cost_g = (result.cost_price * qty_g * tmt_per_annum_g).toFixed(2);
						$('#val_per_annum_cost_g').val(val_per_annum_cost_g);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#preparation_h").change(function(){
		  var x = document.getElementById("preparation_h").value;
		  var qty_h = document.getElementById("qty_h").value;
          var tmt_per_annum_h = document.getElementById("tmt_per_annum_h").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {preparation_h:x},
			success: function(result) {
				if (result){
					$('#unit_cost_h').val(result.selling_price);
					$('#unit_selling_h').val(result.cost_price);
					if (qty_h != '') {
						var tot_val_unit_h = (result.selling_price * qty_h).toFixed(2);
						$('#tot_val_unit_h').val(tot_val_unit_h);
                        var tot_val_cost_h = (result.cost_price * qty_h).toFixed(2);
						$('#tot_val_cost_h').val(tot_val_cost_h);
                        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
						var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
						var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
						var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
						var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
						var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
						var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
						var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
						var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
						$('#total_unit').val(total_unit);
						
						var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
						var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
						var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
						var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
						var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
						var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
						var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
						var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
						var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
						$('#total_unit_cost').val(total_unit_cost);
						
						var total_unit = document.getElementById("total_unit").value;
						var total_labour = document.getElementById("total_labour").value;
						var other_total_a = document.getElementById("other_total_a").value;
						var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
						$('#treatment_a').val(treatment_a);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);						
					}
					if (tmt_per_annum_h != '') {
						var val_per_annum_h = (result.selling_price * qty_h * tmt_per_annum_h).toFixed(2);
						$('#val_per_annum_h').val(val_per_annum_h);
                        var val_per_annum_cost_h = (result.cost_price * qty_h * tmt_per_annum_h).toFixed(2);
						$('#val_per_annum_cost_h').val(val_per_annum_cost_h);
                        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
						var val_per_annum_b = document.getElementById("val_per_annum_b").value;
						var val_per_annum_c = document.getElementById("val_per_annum_c").value;
						var val_per_annum_d = document.getElementById("val_per_annum_d").value;
						var val_per_annum_e = document.getElementById("val_per_annum_e").value;
						var val_per_annum_f = document.getElementById("val_per_annum_f").value;
						var val_per_annum_g = document.getElementById("val_per_annum_g").value;
						var val_per_annum_h = document.getElementById("val_per_annum_h").value;
						var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
						$('#total_unit_annum').val(total_unit_annum);
						
						var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
						var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
						var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
						var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
						var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
						var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
						var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
						var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
						var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
						$('#total_unit_cost_annum').val(total_unit_cost_annum);
						
						var total_unit_annum = document.getElementById("total_unit_annum").value;		
						var total_labour_annum = document.getElementById("total_labour_annum").value;		
						var other_total_b = document.getElementById("other_total_b").value;
						var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
						$('#treatment_b').val(treatment_b);
						
						var treatment_a = document.getElementById("treatment_a").value;
						var treatment_b = document.getElementById("treatment_b").value;
						var total_annual_cost = Number(treatment_a) + Number(treatment_b);
						$('#total_annual_cost').val(total_annual_cost);
						}
					}
				}
			});
	  });
	  $("#annual_value_a,#annual_value_b,#annual_value_c,#annual_value_d,#annual_value_e,#annual_value_f,#annual_value_g,#annual_value_h").blur(function(){
		var annual_value_a = document.getElementById("annual_value_a").value;
		var annual_value_b = document.getElementById("annual_value_b").value;
		var annual_value_c = document.getElementById("annual_value_c").value;
		var annual_value_d = document.getElementById("annual_value_d").value;
		var annual_value_e = document.getElementById("annual_value_e").value;
		var annual_value_f = document.getElementById("annual_value_f").value;
		var annual_value_g = document.getElementById("annual_value_g").value;
		var annual_value_h = document.getElementById("annual_value_h").value;
		var price_accept = Number(annual_value_a) + Number(annual_value_b) + Number(annual_value_c) + Number(annual_value_d) + Number(annual_value_e) + Number(annual_value_f) + Number(annual_value_g) + Number(annual_value_h);
		$('#price_accept').val(price_accept);
	  });
	  $("#qty_a").blur(function(){
        var unit_cost_a = document.getElementById("unit_cost_a").value;
        var unit_selling_a = document.getElementById("unit_selling_a").value; 
        var qty_a = document.getElementById("qty_a").value;
		var tot_val_unit_a = (unit_cost_a * qty_a).toFixed(2);
		var tot_val_cost_a = (unit_selling_a * qty_a).toFixed(2);
		$('#tot_val_unit_a').val(tot_val_unit_a);
		$('#tot_val_cost_a').val(tot_val_cost_a);
		
        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#qty_b").blur(function(){
        var unit_cost_b = document.getElementById("unit_cost_b").value;
		var unit_selling_b = document.getElementById("unit_selling_b").value;
        var qty_b = document.getElementById("qty_b").value;
		var tot_val_unit_b = (unit_cost_b * qty_b).toFixed(2);
		var tot_val_cost_b = (unit_selling_b * qty_b).toFixed(2);
		$('#tot_val_unit_b').val(tot_val_unit_b);
		$('#tot_val_cost_b').val(tot_val_cost_b);
		
        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#qty_c").blur(function(){
        var unit_cost_c = document.getElementById("unit_cost_c").value;
		var unit_selling_c = document.getElementById("unit_selling_c").value;
        var qty_c = document.getElementById("qty_c").value;
		var tot_val_unit_c = (unit_cost_c * qty_c).toFixed(2);
		var tot_val_cost_c = (unit_selling_c * qty_c).toFixed(2);
		$('#tot_val_unit_c').val(tot_val_unit_c);
		$('#tot_val_cost_c').val(tot_val_cost_c);
		
        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#qty_d").blur(function(){
        var unit_cost_d = document.getElementById("unit_cost_d").value;
		var unit_selling_d = document.getElementById("unit_selling_d").value;
        var qty_d = document.getElementById("qty_d").value;
		var tot_val_unit_d = (unit_cost_d * qty_d).toFixed(2);
		var tot_val_cost_d = (unit_selling_d * qty_d).toFixed(2);
		$('#tot_val_unit_d').val(tot_val_unit_d);
		$('#tot_val_cost_d').val(tot_val_cost_d);
		
		var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#qty_e").blur(function(){
        var unit_cost_e = document.getElementById("unit_cost_e").value;
		var unit_selling_e = document.getElementById("unit_selling_e").value;
        var qty_e = document.getElementById("qty_e").value;
		var tot_val_unit_e = (unit_cost_e * qty_e).toFixed(2);
		var tot_val_cost_e = (unit_selling_e * qty_e).toFixed(2);
		$('#tot_val_unit_e').val(tot_val_unit_e);
		$('#tot_val_cost_e').val(tot_val_cost_e);
		
         var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#qty_f").blur(function(){
        var unit_cost_f = document.getElementById("unit_cost_f").value;
		var unit_selling_f = document.getElementById("unit_selling_f").value;
        var qty_f = document.getElementById("qty_f").value;
		var tot_val_unit_f = (unit_cost_f * qty_f).toFixed(2);
		var tot_val_cost_f = (unit_selling_f * qty_f).toFixed(2);
		$('#tot_val_unit_f').val(tot_val_unit_f);
		$('#tot_val_cost_f').val(tot_val_cost_f);
		
        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#qty_g").blur(function(){
        var unit_cost_g = document.getElementById("unit_cost_g").value;
		var unit_selling_g = document.getElementById("unit_selling_g").value;
        var qty_g = document.getElementById("qty_g").value;
		var tot_val_unit_g = (unit_cost_g * qty_g).toFixed(2);
		var tot_val_cost_g = (unit_selling_g * qty_g).toFixed(2);
		$('#tot_val_unit_g').val(tot_val_unit_g);
		$('#tot_val_cost_g').val(tot_val_cost_g);
		
        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#qty_h").blur(function(){
        var unit_cost_h = document.getElementById("unit_cost_h").value;
		var unit_selling_h = document.getElementById("unit_selling_h").value;
        var qty_h = document.getElementById("qty_h").value;
		var tot_val_unit_h = (unit_cost_h * qty_h).toFixed(2);
		var tot_val_cost_h = (unit_selling_h * qty_h).toFixed(2);
		$('#tot_val_unit_h').val(tot_val_unit_h);
		$('#tot_val_cost_h').val(tot_val_cost_h);
		
        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var total_unit = Number(tot_val_unit_a) + Number(tot_val_unit_b) + Number(tot_val_unit_c) + Number(tot_val_unit_d) + Number(tot_val_unit_e) + Number(tot_val_unit_f) + Number(tot_val_unit_g) + Number(tot_val_unit_h);
		$('#total_unit').val(total_unit);
		
		var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
		var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
		var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
		var total_unit_cost = Number(tot_val_cost_a) + Number(tot_val_cost_b) + Number(tot_val_cost_c) + Number(tot_val_cost_d) + Number(tot_val_cost_e) + Number(tot_val_cost_f) + Number(tot_val_cost_g) + Number(tot_val_cost_h);
		$('#total_unit_cost').val(total_unit_cost);
		
		var total_unit = document.getElementById("total_unit").value;
		var total_labour = document.getElementById("total_labour").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_unit) + Number(total_labour)+Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#tmt_per_annum_a").blur(function(){
        var tot_val_unit_a = document.getElementById("tot_val_unit_a").value;
        var tot_val_cost_a = document.getElementById("tot_val_cost_a").value;
        var tmt_per_annum_a = document.getElementById("tmt_per_annum_a").value;
		var val_per_annum_a = (tot_val_unit_a * tmt_per_annum_a).toFixed(2);
		var val_per_annum_cost_a = (tot_val_cost_a * tmt_per_annum_a).toFixed(2);
		$('#val_per_annum_a').val(val_per_annum_a);
		$('#val_per_annum_cost_a').val(val_per_annum_cost_a);
		
        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
        var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#tmt_per_annum_b").blur(function(){
        var tot_val_unit_b = document.getElementById("tot_val_unit_b").value;
		 var tot_val_cost_b = document.getElementById("tot_val_cost_b").value;
        var tmt_per_annum_b = document.getElementById("tmt_per_annum_b").value;
		var val_per_annum_b = (tot_val_unit_b * tmt_per_annum_b).toFixed(2);
		var val_per_annum_cost_b = (tot_val_cost_b * tmt_per_annum_b).toFixed(2);
		$('#val_per_annum_b').val(val_per_annum_b);
		$('#val_per_annum_cost_b').val(val_per_annum_cost_b);
		
        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
        var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#tmt_per_annum_c").blur(function(){
        var tot_val_unit_c = document.getElementById("tot_val_unit_c").value;
		var tot_val_cost_c = document.getElementById("tot_val_cost_c").value;
        var tmt_per_annum_c = document.getElementById("tmt_per_annum_c").value;
		var val_per_annum_c = (tot_val_unit_c * tmt_per_annum_c).toFixed(2);
		var val_per_annum_cost_c = (tot_val_cost_c * tmt_per_annum_c).toFixed(2);
		$('#val_per_annum_c').val(val_per_annum_c);
		$('#val_per_annum_cost_c').val(val_per_annum_cost_c);
		
        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
        var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#tmt_per_annum_d").blur(function(){
        var tot_val_unit_d = document.getElementById("tot_val_unit_d").value;
		 var tot_val_cost_d = document.getElementById("tot_val_cost_d").value;
        var tmt_per_annum_d = document.getElementById("tmt_per_annum_d").value;
		var val_per_annum_d = (tot_val_unit_d * tmt_per_annum_d).toFixed(2);
		var val_per_annum_cost_d = (tot_val_cost_d * tmt_per_annum_d).toFixed(2);
		$('#val_per_annum_d').val(val_per_annum_d);
		$('#val_per_annum_cost_d').val(val_per_annum_cost_d);
		
        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
        var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#tmt_per_annum_e").blur(function(){
        var tot_val_unit_e = document.getElementById("tot_val_unit_e").value;
		var tot_val_cost_e = document.getElementById("tot_val_cost_e").value;
        var tmt_per_annum_e = document.getElementById("tmt_per_annum_e").value;
		var val_per_annum_e = (tot_val_unit_e * tmt_per_annum_e).toFixed(2);
		var val_per_annum_cost_e = (tot_val_cost_e * tmt_per_annum_e).toFixed(2);
		$('#val_per_annum_e').val(val_per_annum_e);
		$('#val_per_annum_cost_e').val(val_per_annum_cost_e);
		
        var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
        var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#tmt_per_annum_f").blur(function(){
        var tot_val_unit_f = document.getElementById("tot_val_unit_f").value;
		var tot_val_cost_f = document.getElementById("tot_val_cost_f").value;
        var tmt_per_annum_f = document.getElementById("tmt_per_annum_f").value;
		var val_per_annum_f = (tot_val_unit_f * tmt_per_annum_f).toFixed(2);
		var val_per_annum_cost_f = (tot_val_cost_f * tmt_per_annum_f).toFixed(2);
		$('#val_per_annum_f').val(val_per_annum_f); 
		$('#val_per_annum_cost_f').val(val_per_annum_cost_f);
		
		var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
		var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	   $("#tmt_per_annum_g").blur(function(){
        var tot_val_unit_g = document.getElementById("tot_val_unit_g").value;
		var tot_val_cost_g = document.getElementById("tot_val_cost_g").value;
        var tmt_per_annum_g = document.getElementById("tmt_per_annum_g").value;
		var val_per_annum_g = (tot_val_unit_g * tmt_per_annum_g).toFixed(2);
		var val_per_annum_cost_g = (tot_val_cost_g * tmt_per_annum_g).toFixed(2);
		$('#val_per_annum_g').val(val_per_annum_g);
        $('#val_per_annum_cost_g').val(val_per_annum_cost_g);
		
		var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
		var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#tmt_per_annum_h").blur(function(){
        var tot_val_unit_h = document.getElementById("tot_val_unit_h").value;
		var tot_val_cost_h = document.getElementById("tot_val_cost_h").value;
        var tmt_per_annum_h = document.getElementById("tmt_per_annum_h").value;
		var val_per_annum_h = (tot_val_unit_h * tmt_per_annum_h).toFixed(2);
		var val_per_annum_cost_h = (tot_val_cost_h * tmt_per_annum_h).toFixed(2);
		$('#val_per_annum_h').val(val_per_annum_h);
		$('#val_per_annum_cost_h').val(val_per_annum_cost_h);
		
		var val_per_annum_a = document.getElementById("val_per_annum_a").value;
        var val_per_annum_b = document.getElementById("val_per_annum_b").value;
        var val_per_annum_c = document.getElementById("val_per_annum_c").value;
        var val_per_annum_d = document.getElementById("val_per_annum_d").value;
        var val_per_annum_e = document.getElementById("val_per_annum_e").value;
        var val_per_annum_f = document.getElementById("val_per_annum_f").value;
        var val_per_annum_g = document.getElementById("val_per_annum_g").value;
        var val_per_annum_h = document.getElementById("val_per_annum_h").value;
		var total_unit_annum = Number(val_per_annum_a) + Number(val_per_annum_b) + Number(val_per_annum_c) + Number(val_per_annum_d) + Number(val_per_annum_e) + Number(val_per_annum_f) + Number(val_per_annum_g) + Number(val_per_annum_h);
		$('#total_unit_annum').val(total_unit_annum);
		
		var val_per_annum_cost_a = document.getElementById("val_per_annum_cost_a").value;
		var val_per_annum_cost_b = document.getElementById("val_per_annum_cost_b").value;
		var val_per_annum_cost_c = document.getElementById("val_per_annum_cost_c").value;
		var val_per_annum_cost_d = document.getElementById("val_per_annum_cost_d").value;
		var val_per_annum_cost_e = document.getElementById("val_per_annum_cost_e").value;
		var val_per_annum_cost_f = document.getElementById("val_per_annum_cost_f").value;
		var val_per_annum_cost_g = document.getElementById("val_per_annum_cost_g").value;
		var val_per_annum_cost_h = document.getElementById("val_per_annum_cost_h").value;
		var total_unit_cost_annum = Number(val_per_annum_cost_a) + Number(val_per_annum_cost_b) + Number(val_per_annum_cost_c) + Number(val_per_annum_cost_d) + Number(val_per_annum_cost_e) + Number(val_per_annum_cost_f) + Number(val_per_annum_cost_g) + Number(val_per_annum_cost_h);
		$('#total_unit_cost_annum').val(total_unit_cost_annum);
		
        var total_unit_annum = document.getElementById("total_unit_annum").value;		
        var total_labour_annum = document.getElementById("total_labour_annum").value;		
        var other_total_b = document.getElementById("other_total_b").value;
		var treatment_b = Number(total_unit_annum) + Number(total_labour_annum) + Number(other_total_b);
		$('#treatment_b').val(treatment_b);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#same_address").change(function() {
      if(this.checked) {
		  var address_a = document.getElementById("address_a").value;
		  var address_b = document.getElementById("address_b").value;
		  var postcode_a = document.getElementById("postcode_a").value;
		  var tel_a = document.getElementById("tel_a").value;
          $('#premises_address_a').val(address_a);
          $('#premises_address_b').val(address_b);
          $('#postcode_b').val(postcode_a);
          $('#tel_b').val(tel_a);
        } else {
		  $('#premises_address_a').val('');
          $('#premises_address_b').val('');
          $('#postcode_b').val('');
          $('#tel_b').val('');
		}
      });
	  $("#shift_type_a").change(function() {
		var shift_type_a = document.getElementById("shift_type_a").value;
        if (shift_type_a == 'Normal') {
			$('#per_hour_a').val('65');
			$('#fix_cost_per_hour_a').val('35');
			$('#wfix_cost_per_hour_a').val('20');
			
			var per_hour_a = document.getElementById("per_hour_a").value;
			var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
			var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
			var no_hours_a = document.getElementById("no_hours_a").value;
			
			if (no_hours_a != '') {
			var	total_hours_a = per_hour_a * no_hours_a;
			$('#total_hours_a').val(total_hours_a);
			
			var	fix_cost_total_hours_a = fix_cost_per_hour_a * no_hours_a;
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			
			var	wfix_cost_total_hours_a = wfix_cost_per_hour_a * no_hours_a;
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			var tmt_hours_a = document.getElementById("tmt_hours_a").value;
			var tmt_annum_a = document.getElementById("tmt_annum_a").value;
			if (tmt_hours_a != '' && tmt_annum_a != '') {
				var labour_value_a = per_hour_a * tmt_hours_a * tmt_annum_a;
				$('#labour_value_a').val(labour_value_a);
				var	fix_cost_labour_value_a = fix_cost_per_hour_a * tmt_hours_a * tmt_annum_a;
			    $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
			    var	wfix_cost_labour_value_a = wfix_cost_per_hour_a * tmt_hours_a * tmt_annum_a;
			    $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_a == 'Evening Shift') {
			$('#per_hour_a').val('85');
			$('#fix_cost_per_hour_a').val('47');
			$('#wfix_cost_per_hour_a').val('32');
			
			var per_hour_a = document.getElementById("per_hour_a").value;
			var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
			var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
			var no_hours_a = document.getElementById("no_hours_a").value;
			
			if (no_hours_a != '') {
			var	total_hours_a = per_hour_a * no_hours_a;
			$('#total_hours_a').val(total_hours_a);
			
			var	fix_cost_total_hours_a = fix_cost_per_hour_a * no_hours_a;
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			
			var	wfix_cost_total_hours_a = wfix_cost_per_hour_a * no_hours_a;
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			var tmt_hours_a = document.getElementById("tmt_hours_a").value;
			var tmt_annum_a = document.getElementById("tmt_annum_a").value;
			if (tmt_hours_a != '' && tmt_annum_a != '') {
				var labour_value_a = per_hour_a * tmt_hours_a * tmt_annum_a;
				$('#labour_value_a').val(labour_value_a);
				var	fix_cost_labour_value_a = fix_cost_per_hour_a * tmt_hours_a * tmt_annum_a;
			    $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
			    var	wfix_cost_labour_value_a = wfix_cost_per_hour_a * tmt_hours_a * tmt_annum_a;
			    $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_a == 'Public Holiday/Sunday') {
			$('#per_hour_a').val('125');
			$('#fix_cost_per_hour_a').val('51');
			$('#wfix_cost_per_hour_a').val('36');
			$('#total_hours_a').val('200');
			
			var per_hour_a = document.getElementById("per_hour_a").value;
			var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
			var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
			var no_hours_a = document.getElementById("no_hours_a").value;
			
			if (no_hours_a != '') {
			var	total_hours_a = per_hour_a * no_hours_a;
			if (total_hours_a > 200){
				$('#total_hours_a').val(total_hours_a);
			} else {
				$('#total_hours_a').val('200');
			}
			
			var	fix_cost_total_hours_a = fix_cost_per_hour_a * no_hours_a;
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			
			var	wfix_cost_total_hours_a = wfix_cost_per_hour_a * no_hours_a;
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			var tmt_hours_a = document.getElementById("tmt_hours_a").value;
			var tmt_annum_a = document.getElementById("tmt_annum_a").value;
			if (tmt_hours_a != '' && tmt_annum_a != '') {
				var labour_value_a = per_hour_a * tmt_hours_a * tmt_annum_a;
				$('#labour_value_a').val(labour_value_a);
				var	fix_cost_labour_value_a = fix_cost_per_hour_a * tmt_hours_a * tmt_annum_a;
			    $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
			    var	wfix_cost_labour_value_a = wfix_cost_per_hour_a * tmt_hours_a * tmt_annum_a;
			    $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
		}	 		
	  });
	  $("#shift_type_b").change(function() {
		var shift_type_b = document.getElementById("shift_type_b").value;
        if (shift_type_b == 'Normal') {
			$('#per_hour_b').val('65');
			$('#fix_cost_per_hour_b').val('35');
			$('#wfix_cost_per_hour_b').val('20');
			
			var per_hour_b = document.getElementById("per_hour_b").value;
			var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
			var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
			var no_hours_b = document.getElementById("no_hours_b").value;
			
			if (no_hours_b != '') {
			var	total_hours_b = per_hour_b * no_hours_b;
			$('#total_hours_b').val(total_hours_b);
			
			var	fix_cost_total_hours_b = fix_cost_per_hour_b * no_hours_b;
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			
			var	wfix_cost_total_hours_b = wfix_cost_per_hour_b * no_hours_b;
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_b = document.getElementById("tmt_hours_b").value;
			var tmt_annum_b = document.getElementById("tmt_annum_b").value;
			if (tmt_hours_b != '' && tmt_annum_b != '') {
				var labour_value_b = per_hour_b * tmt_hours_b * tmt_annum_b;
				$('#labour_value_b').val(labour_value_b);
				var	fix_cost_labour_value_b = fix_cost_per_hour_b * tmt_hours_b * tmt_annum_b;
			    $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
			    var	wfix_cost_labour_value_b = wfix_cost_per_hour_b * tmt_hours_b * tmt_annum_b;
			    $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
				
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_b == 'Evening Shift') {
			$('#per_hour_b').val('85');
			$('#fix_cost_per_hour_b').val('47');
			$('#wfix_cost_per_hour_b').val('32');
			
			var per_hour_b = document.getElementById("per_hour_b").value;
			var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
			var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
			var no_hours_b = document.getElementById("no_hours_b").value;
			
			if (no_hours_b != '') {
			var	total_hours_b = per_hour_b * no_hours_b;
			$('#total_hours_b').val(total_hours_b);
			
			var	fix_cost_total_hours_b = fix_cost_per_hour_b * no_hours_b;
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			
			var	wfix_cost_total_hours_b = wfix_cost_per_hour_b * no_hours_b;
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_b = document.getElementById("tmt_hours_b").value;
			var tmt_annum_b = document.getElementById("tmt_annum_b").value;
			if (tmt_hours_b != '' && tmt_annum_b != '') {
				var labour_value_b = per_hour_b * tmt_hours_b * tmt_annum_b;
				$('#labour_value_b').val(labour_value_b);
				var	fix_cost_labour_value_b = fix_cost_per_hour_b * tmt_hours_b * tmt_annum_b;
			    $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
			    var	wfix_cost_labour_value_b = wfix_cost_per_hour_b * tmt_hours_b * tmt_annum_b;
			    $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
				
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_b == 'Public Holiday/Sunday') {
			$('#per_hour_b').val('125');
			$('#fix_cost_per_hour_b').val('51');
			$('#wfix_cost_per_hour_b').val('36');
			$('#total_hours_b').val('200');
			
			var per_hour_b = document.getElementById("per_hour_b").value;
			var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
			var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
			var no_hours_b = document.getElementById("no_hours_b").value;
			
			if (no_hours_b != '') {
			var	total_hours_b = per_hour_b * no_hours_b;
			if(total_hours_b >200) {
			    $('#total_hours_b').val(total_hours_b);
			} else {
				$('#total_hours_b').val('200');
			}
			
			var	fix_cost_total_hours_b = fix_cost_per_hour_b * no_hours_b;
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			
			var	wfix_cost_total_hours_b = wfix_cost_per_hour_b * no_hours_b;
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_b = document.getElementById("tmt_hours_b").value;
			var tmt_annum_b = document.getElementById("tmt_annum_b").value;
			if (tmt_hours_b != '' && tmt_annum_b != '') {
				var labour_value_b = per_hour_b * tmt_hours_b * tmt_annum_b;
				$('#labour_value_b').val(labour_value_b);
				var	fix_cost_labour_value_b = fix_cost_per_hour_b * tmt_hours_b * tmt_annum_b;
			    $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
			    var	wfix_cost_labour_value_b = wfix_cost_per_hour_b * tmt_hours_b * tmt_annum_b;
			    $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
				
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
		}	 		
	  });
	  $("#shift_type_c").change(function() {
		var shift_type_c = document.getElementById("shift_type_c").value;
        if (shift_type_c == 'Normal') {
			$('#per_hour_c').val('65');
			$('#fix_cost_per_hour_c').val('35');
			$('#wfix_cost_per_hour_c').val('20');
			
			var per_hour_c = document.getElementById("per_hour_c").value;
			var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
			var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
			var no_hours_c = document.getElementById("no_hours_c").value;
			
			if (no_hours_c != '') {
			var	total_hours_c = per_hour_c * no_hours_c;
			$('#total_hours_c').val(total_hours_c);
			
			var	fix_cost_total_hours_c = fix_cost_per_hour_c * no_hours_c;
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			
			var	wfix_cost_total_hours_c = wfix_cost_per_hour_c * no_hours_c;
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_c = document.getElementById("tmt_hours_c").value;
			var tmt_annum_c = document.getElementById("tmt_annum_c").value;
			if (tmt_hours_c != '' && tmt_annum_c != '') {
				var labour_value_c = per_hour_c * tmt_hours_c * tmt_annum_c;
				$('#labour_value_c').val(labour_value_c);
				var	fix_cost_labour_value_c = fix_cost_per_hour_c * tmt_hours_c * tmt_annum_c;
			    $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
			    var	wfix_cost_labour_value_c = wfix_cost_per_hour_c * tmt_hours_c * tmt_annum_c;
			    $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_c == 'Evening Shift') {
			$('#per_hour_c').val('85');
			$('#fix_cost_per_hour_c').val('47');
			$('#wfix_cost_per_hour_c').val('32');
			
			var per_hour_c = document.getElementById("per_hour_c").value;
			var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
			var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
			var no_hours_c = document.getElementById("no_hours_c").value;
			
			if (no_hours_c != '') {
			var	total_hours_c = per_hour_c * no_hours_c;
			$('#total_hours_c').val(total_hours_c);
			
			var	fix_cost_total_hours_c = fix_cost_per_hour_c * no_hours_c;
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			
			var	wfix_cost_total_hours_c = wfix_cost_per_hour_c * no_hours_c;
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_c = document.getElementById("tmt_hours_c").value;
			var tmt_annum_c = document.getElementById("tmt_annum_c").value;
			if (tmt_hours_c != '' && tmt_annum_c != '') {
				var labour_value_c = per_hour_c * tmt_hours_c * tmt_annum_c;
				$('#labour_value_c').val(labour_value_c);
				var	fix_cost_labour_value_c = fix_cost_per_hour_c * tmt_hours_c * tmt_annum_c;
			    $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
			    var	wfix_cost_labour_value_c = wfix_cost_per_hour_c * tmt_hours_c * tmt_annum_c;
			    $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_c == 'Public Holiday/Sunday') {
			$('#per_hour_c').val('125');
			$('#fix_cost_per_hour_c').val('51');
			$('#wfix_cost_per_hour_c').val('36');
			$('#total_hours_c').val('200');
			
			var per_hour_c = document.getElementById("per_hour_c").value;
			var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
			var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
			var no_hours_c = document.getElementById("no_hours_c").value;
			
			if (no_hours_c != '') {
			var	total_hours_c = per_hour_c * no_hours_c;
			if (total_hours_c > 200) {
				$('#total_hours_c').val(total_hours_c);
			} else {
				$('#total_hours_c').val('200');
			}
			
			var	fix_cost_total_hours_c = fix_cost_per_hour_c * no_hours_c;
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			
			var	wfix_cost_total_hours_c = wfix_cost_per_hour_c * no_hours_c;
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_c = document.getElementById("tmt_hours_c").value;
			var tmt_annum_c = document.getElementById("tmt_annum_c").value;
			if (tmt_hours_c != '' && tmt_annum_c != '') {
				var labour_value_c = per_hour_c * tmt_hours_c * tmt_annum_c;
				$('#labour_value_c').val(labour_value_c);
				var	fix_cost_labour_value_c = fix_cost_per_hour_c * tmt_hours_c * tmt_annum_c;
			    $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
			    var	wfix_cost_labour_value_c = wfix_cost_per_hour_c * tmt_hours_c * tmt_annum_c;
			    $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
		}	 		
	  });
	  $("#shift_type_d").change(function() {
		var shift_type_d = document.getElementById("shift_type_d").value;
        if (shift_type_d == 'Normal') {
			$('#per_hour_d').val('65');
			$('#fix_cost_per_hour_d').val('35');
			$('#wfix_cost_per_hour_d').val('20');
			
			var per_hour_d = document.getElementById("per_hour_d").value;
			var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
			var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
			var no_hours_d = document.getElementById("no_hours_d").value;
			
			if (no_hours_d != '') {
			var	total_hours_d = per_hour_d * no_hours_d;
			$('#total_hours_d').val(total_hours_d);
			
			var	fix_cost_total_hours_d = fix_cost_per_hour_d * no_hours_d;
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			
			var	wfix_cost_total_hours_d = wfix_cost_per_hour_d * no_hours_d;
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_d = document.getElementById("tmt_hours_d").value;
			var tmt_annum_d = document.getElementById("tmt_annum_d").value;
			if (tmt_hours_d != '' && tmt_annum_d != '') {
				var labour_value_d = per_hour_d * tmt_hours_d * tmt_annum_d;
				$('#labour_value_d').val(labour_value_d);
				var	fix_cost_labour_value_d = fix_cost_per_hour_d * tmt_hours_d * tmt_annum_d;
			    $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
			    var	wfix_cost_labour_value_d = wfix_cost_per_hour_d * tmt_hours_d * tmt_annum_d;
			    $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_d == 'Evening Shift') {
			$('#per_hour_d').val('85');
			$('#fix_cost_per_hour_d').val('47');
			$('#wfix_cost_per_hour_d').val('32');
			
			var per_hour_d = document.getElementById("per_hour_d").value;
			var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
			var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
			var no_hours_d = document.getElementById("no_hours_d").value;
			
			if (no_hours_d != '') {
			var	total_hours_d = per_hour_d * no_hours_d;
			$('#total_hours_d').val(total_hours_d);
			
			var	fix_cost_total_hours_d = fix_cost_per_hour_d * no_hours_d;
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			
			var	wfix_cost_total_hours_d = wfix_cost_per_hour_d * no_hours_d;
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_d = document.getElementById("tmt_hours_d").value;
			var tmt_annum_d = document.getElementById("tmt_annum_d").value;
			if (tmt_hours_d != '' && tmt_annum_d != '') {
				var labour_value_d = per_hour_d * tmt_hours_d * tmt_annum_d;
				$('#labour_value_d').val(labour_value_d);
				var	fix_cost_labour_value_d = fix_cost_per_hour_d * tmt_hours_d * tmt_annum_d;
			    $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
			    var	wfix_cost_labour_value_d = wfix_cost_per_hour_d * tmt_hours_d * tmt_annum_d;
			    $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
			
		} else if (shift_type_d == 'Public Holiday/Sunday') {
			$('#per_hour_d').val('125');
			$('#fix_cost_per_hour_d').val('51');
			$('#wfix_cost_per_hour_d').val('36');
			$('#total_hours_d').val('200');
			
			var per_hour_d = document.getElementById("per_hour_d").value;
			var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
			var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
			var no_hours_d = document.getElementById("no_hours_d").value;
			
			if (no_hours_d != '') {
			var	total_hours_d = per_hour_d * no_hours_d;
			if(total_hours_d > 200){
				$('#total_hours_d').val(total_hours_d);
			} else {
				$('#total_hours_d').val('200');
			}
			
			var	fix_cost_total_hours_d = fix_cost_per_hour_d * no_hours_d;
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			
			var	wfix_cost_total_hours_d = wfix_cost_per_hour_d * no_hours_d;
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
			$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
			
			var total_labour = document.getElementById("total_labour").value;
			var total_unit = document.getElementById("total_unit").value;
			var other_total_a = document.getElementById("other_total_a").value;
			var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
			$('#treatment_a').val(treatment_a);
			
			var treatment_a = document.getElementById("treatment_a").value;
			var treatment_b = document.getElementById("treatment_b").value;
			var total_annual_cost = Number(treatment_a) + Number(treatment_b);
			$('#total_annual_cost').val(total_annual_cost);
			}
			
			var tmt_hours_d = document.getElementById("tmt_hours_d").value;
			var tmt_annum_d = document.getElementById("tmt_annum_d").value;
			if (tmt_hours_d != '' && tmt_annum_d != '') {
				var labour_value_d = per_hour_d * tmt_hours_d * tmt_annum_d;
				$('#labour_value_d').val(labour_value_d);
				var	fix_cost_labour_value_d = fix_cost_per_hour_d * tmt_hours_d * tmt_annum_d;
			    $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
			    var	wfix_cost_labour_value_d = wfix_cost_per_hour_d * tmt_hours_d * tmt_annum_d;
			    $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
				  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
				  
				  var total_labour_annum = document.getElementById("total_labour_annum").value;
				  var total_unit_annum = document.getElementById("total_unit_annum").value;
				  var other_total_b = document.getElementById("other_total_b").value;
				  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
				  $('#treatment_b').val(treatment_b);
				  
				  var treatment_a = document.getElementById("treatment_a").value;
				  var treatment_b = document.getElementById("treatment_b").value;
				  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
				  $('#total_annual_cost').val(total_annual_cost);
			}
		}	 		
	  });
	  $("#no_hours_a").blur(function(){
        var shift_type_a = document.getElementById("shift_type_a").value;
        var per_hour_a = document.getElementById("per_hour_a").value;
        var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
        var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
        var no_hours_a = document.getElementById("no_hours_a").value;
		if (shift_type_a == 'Public Holiday/Sunday') {
			var total_hours_a = per_hour_a * no_hours_a;
			if (total_hours_a < 200) {
				total_hours_a = '200';
			}
			$('#total_hours_a').val(total_hours_a);
			var fix_cost_total_hours_a = fix_cost_per_hour_a * no_hours_a;
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			var wfix_cost_total_hours_a = wfix_cost_per_hour_a * no_hours_a;
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
		} else {
			var total_hours_a = per_hour_a * no_hours_a;
			$('#total_hours_a').val(total_hours_a);
			var fix_cost_total_hours_a = fix_cost_per_hour_a * no_hours_a;
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			var wfix_cost_total_hours_a = wfix_cost_per_hour_a * no_hours_a;
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
		}
		
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
		$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
		
		var total_labour = document.getElementById("total_labour").value;
		var total_unit = document.getElementById("total_unit").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#no_hours_b").blur(function(){
        var shift_type_b = document.getElementById("shift_type_b").value;
        var per_hour_b = document.getElementById("per_hour_b").value;
		var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
        var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
        var no_hours_b = document.getElementById("no_hours_b").value;
		if (shift_type_b == 'Public Holiday/Sunday') {
			var total_hours_b = per_hour_b * no_hours_b;
			if (total_hours_b < 200) {
				total_hours_b = '200';
			}
			$('#total_hours_b').val(total_hours_b);
			var fix_cost_total_hours_b = fix_cost_per_hour_b * no_hours_b;
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			var wfix_cost_total_hours_b = wfix_cost_per_hour_b * no_hours_b;
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
		} else {
			var total_hours_b = per_hour_b * no_hours_b;
			$('#total_hours_b').val(total_hours_b);
			var fix_cost_total_hours_b = fix_cost_per_hour_b * no_hours_b;
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			var wfix_cost_total_hours_b = wfix_cost_per_hour_b * no_hours_b;
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
		}
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
		$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
		
        var total_labour = document.getElementById("total_labour").value;
		var total_unit = document.getElementById("total_unit").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#no_hours_c").blur(function(){
        var shift_type_c = document.getElementById("shift_type_c").value;
        var per_hour_c = document.getElementById("per_hour_c").value;
		var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
        var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
        var no_hours_c = document.getElementById("no_hours_c").value;
		if (shift_type_c == 'Public Holiday/Sunday') {
			var total_hours_c = per_hour_c * no_hours_c;
			if (total_hours_c < 200) {
				total_hours_c = '200';
			}
			$('#total_hours_c').val(total_hours_c);
			var fix_cost_total_hours_c = fix_cost_per_hour_c * no_hours_c;
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			var wfix_cost_total_hours_c = wfix_cost_per_hour_c * no_hours_c;
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
		} else {
			var total_hours_c = per_hour_c * no_hours_c;
			$('#total_hours_c').val(total_hours_c);
			var fix_cost_total_hours_c = fix_cost_per_hour_c * no_hours_c;
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			var wfix_cost_total_hours_c = wfix_cost_per_hour_c * no_hours_c;
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
		}
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
		$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
		
        var total_labour = document.getElementById("total_labour").value;
		var total_unit = document.getElementById("total_unit").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  
	  $("#no_hours_d").blur(function(){
        var shift_type_d = document.getElementById("shift_type_d").value;
        var per_hour_d = document.getElementById("per_hour_d").value;
		var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
        var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
        var no_hours_d = document.getElementById("no_hours_d").value;
		if (shift_type_d == 'Public Holiday/Sunday') {
			var total_hours_d = per_hour_d * no_hours_d;
			if (total_hours_d < 200) {
				total_hours_d = '200';
			}
			$('#total_hours_d').val(total_hours_d);
			var fix_cost_total_hours_d = fix_cost_per_hour_d * no_hours_d;
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			var wfix_cost_total_hours_d = wfix_cost_per_hour_d * no_hours_d;
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
		} else {
			var total_hours_d = per_hour_d * no_hours_d;
			$('#total_hours_d').val(total_hours_d);
			var fix_cost_total_hours_d = fix_cost_per_hour_d * no_hours_d;
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			var wfix_cost_total_hours_d = wfix_cost_per_hour_d * no_hours_d;
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
		}
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d);
		$('#wfix_cost_total_labour').val(wfix_cost_total_labour);
		
        var total_labour = document.getElementById("total_labour").value;
		var total_unit = document.getElementById("total_unit").value;
		var other_total_a = document.getElementById("other_total_a").value;
		var treatment_a = Number(total_labour) + Number(total_unit) + Number(other_total_a);
		$('#treatment_a').val(treatment_a);
		
		var treatment_a = document.getElementById("treatment_a").value;
		var treatment_b = document.getElementById("treatment_b").value;
		var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		$('#total_annual_cost').val(total_annual_cost);		
	  });
	  $("#tmt_annum_a").blur(function(){
		  var tmt_hours_a = document.getElementById("tmt_hours_a").value;
		  var tmt_annum_a = document.getElementById("tmt_annum_a").value;
		  var per_hour_a = document.getElementById("per_hour_a").value;
		  if (per_hour_a == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_a = tmt_hours_a * tmt_annum_a * per_hour_a;
		  $('#labour_value_a').val(labour_value_a);
		  
		  var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
		  var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
		  var fix_cost_labour_value_a = tmt_hours_a * tmt_annum_a * fix_cost_per_hour_a;
		  $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
		  var wfix_cost_labour_value_a = tmt_hours_a * tmt_annum_a * wfix_cost_per_hour_a;
		  $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
		  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
		  
		  var total_labour_annum = document.getElementById("total_labour_annum").value;
		  var total_unit_annum = document.getElementById("total_unit_annum").value;
		  var other_total_b = document.getElementById("other_total_b").value;
		  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
		  $('#treatment_b').val(treatment_b);
		  
		  var treatment_a = document.getElementById("treatment_a").value;
		  var treatment_b = document.getElementById("treatment_b").value;
		  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		  $('#total_annual_cost').val(total_annual_cost);	
	  });
	  $("#tmt_annum_b").blur(function(){
		  var tmt_hours_b = document.getElementById("tmt_hours_b").value;
		  var tmt_annum_b = document.getElementById("tmt_annum_b").value;
		  var per_hour_b = document.getElementById("per_hour_b").value;
		  if (per_hour_b == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_b = tmt_hours_b * tmt_annum_b * per_hour_b;
		  $('#labour_value_b').val(labour_value_b);
		  
		  var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
		  var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
		  var fix_cost_labour_value_b = tmt_hours_b * tmt_annum_b * fix_cost_per_hour_b;
		  $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
		  var wfix_cost_labour_value_b = tmt_hours_b * tmt_annum_b * wfix_cost_per_hour_b;
		  $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
		  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
		  
		  var total_labour_annum = document.getElementById("total_labour_annum").value;
		  var total_unit_annum = document.getElementById("total_unit_annum").value;
		  var other_total_b = document.getElementById("other_total_b").value;
		  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
		  $('#treatment_b').val(treatment_b);
		  
		  var treatment_a = document.getElementById("treatment_a").value;
		  var treatment_b = document.getElementById("treatment_b").value;
		  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		  $('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#tmt_annum_c").blur(function(){
		  var tmt_hours_c = document.getElementById("tmt_hours_c").value;
		  var tmt_annum_c = document.getElementById("tmt_annum_c").value;
		  var per_hour_c = document.getElementById("per_hour_c").value;
		  if (per_hour_c == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_c = tmt_hours_c * tmt_annum_c * per_hour_c;
		  $('#labour_value_c').val(labour_value_c);
		  
		  var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
		  var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
		  var fix_cost_labour_value_c = tmt_hours_c * tmt_annum_c * fix_cost_per_hour_c;
		  $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
		  var wfix_cost_labour_value_c = tmt_hours_c * tmt_annum_c * wfix_cost_per_hour_c;
		  $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
		  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
		  
		  var total_labour_annum = document.getElementById("total_labour_annum").value;
		  var total_unit_annum = document.getElementById("total_unit_annum").value;
		  var other_total_b = document.getElementById("other_total_b").value;
		  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
		  $('#treatment_b').val(treatment_b);
		  
		  var treatment_a = document.getElementById("treatment_a").value;
		  var treatment_b = document.getElementById("treatment_b").value;
		  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		  $('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#tmt_annum_d").blur(function(){
		  var tmt_hours_d = document.getElementById("tmt_hours_d").value;
		  var tmt_annum_d = document.getElementById("tmt_annum_d").value;
		  var per_hour_d = document.getElementById("per_hour_d").value;
		  if (per_hour_d == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_d = tmt_hours_d * tmt_annum_d * per_hour_d;
		  $('#labour_value_d').val(labour_value_d);
		  
		  var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
		  var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
		  var fix_cost_labour_value_d = tmt_hours_d * tmt_annum_d * fix_cost_per_hour_d;
		  $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
		  var wfix_cost_labour_value_d = tmt_hours_d * tmt_annum_d * wfix_cost_per_hour_d;
		  $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d);
		  $('#wfix_cost_total_labour_annum').val(wfix_cost_total_labour_annum);
		  
		  var total_labour_annum = document.getElementById("total_labour_annum").value;
		  var total_unit_annum = document.getElementById("total_unit_annum").value;
		  var other_total_b = document.getElementById("other_total_b").value;
		  var treatment_b = Number(total_labour_annum) + Number(total_unit_annum) + Number(other_total_b);
		  $('#treatment_b').val(treatment_b);
		  
		  var treatment_a = document.getElementById("treatment_a").value;
		  var treatment_b = document.getElementById("treatment_b").value;
		  var total_annual_cost = Number(treatment_a) + Number(treatment_b);
		  $('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#other_item_a").blur(function(){
		  var other_unit_cost_a = document.getElementById("other_unit_cost_a").value; 
		  var other_item_a = document.getElementById("other_item_a").value;
          var other_tot_val_a = other_unit_cost_a * other_item_a;
          $('#other_tot_val_a').val(other_tot_val_a);
          var other_tot_val_a = document.getElementById("other_tot_val_a").value;
		  var other_tot_val_b = document.getElementById("other_tot_val_b").value;
		  var other_total_a = Number(other_tot_val_a) + Number(other_tot_val_b);
          $('#other_total_a').val(other_total_a);
          var other_total_a = document.getElementById("other_total_a").value;		  
          var total_labour = document.getElementById("total_labour").value;		  
          var total_unit = document.getElementById("total_unit").value;
          var treatment_a = Number(other_total_a) + Number(total_labour) + Number(total_unit);
          $('#treatment_a').val(treatment_a);
          var treatment_a = document.getElementById("treatment_a").value;		  
          var treatment_b = document.getElementById("treatment_b").value;
          var total_annual_cost = Number(treatment_a) + Number(treatment_b);
          $('#total_annual_cost').val(total_annual_cost);		  
	  });
	  $("#other_item_b").blur(function(){
		  var other_unit_cost_b = document.getElementById("other_unit_cost_b").value; 
		  var other_item_b = document.getElementById("other_item_b").value;
          var other_tot_val_b = other_unit_cost_b * other_item_b;
          $('#other_tot_val_b').val(other_tot_val_b);
          var other_tot_val_a = document.getElementById("other_tot_val_a").value;
		  var other_tot_val_b = document.getElementById("other_tot_val_b").value;
		  var other_total_a = Number(other_tot_val_a) + Number(other_tot_val_b);
          $('#other_total_a').val(other_total_a);
          var other_total_a = document.getElementById("other_total_a").value;		  
          var total_labour = document.getElementById("total_labour").value;		  
          var total_unit = document.getElementById("total_unit").value;
          var treatment_a = Number(other_total_a) + Number(total_labour) + Number(total_unit);
          $('#treatment_a').val(treatment_a);
          var treatment_a = document.getElementById("treatment_a").value;		  
          var treatment_b = document.getElementById("treatment_b").value;
          var total_annual_cost = Number(treatment_a) + Number(treatment_b);
          $('#total_annual_cost').val(total_annual_cost);		  
	  });
	  $("#other_tmt_annum_a").blur(function(){
		  var other_tmt_annum_a = document.getElementById("other_tmt_annum_a").value; 
		  var other_tot_item_a = document.getElementById("other_tot_item_a").value;
		  var other_unit_cost_a = document.getElementById("other_unit_cost_a").value;
          var other_tot_annum_a = other_tmt_annum_a * other_tot_item_a * other_unit_cost_a;
          $('#other_tot_annum_a').val(other_tot_annum_a);
          var other_tot_annum_a = document.getElementById("other_tot_annum_a").value;
		  var other_tot_annum_b = document.getElementById("other_tot_annum_b").value;
          var other_total_b = Number(other_tot_annum_a) + Number(other_tot_annum_b);
		  $('#other_total_b').val(other_total_b);
          var other_total_b = document.getElementById("other_total_b").value;		  
          var total_labour_annum = document.getElementById("total_labour_annum").value;		  
          var total_unit_annum = document.getElementById("total_unit_annum").value;
          var treatment_b = Number(other_total_b) + Number(total_labour_annum) + Number(total_unit_annum);
          $('#treatment_b').val(treatment_b);
		  var treatment_b = document.getElementById("treatment_b").value;
		  var treatment_a = document.getElementById("treatment_a").value;
		  var total_annual_cost = Number(treatment_b) + Number(treatment_a);
		  $('#total_annual_cost').val(total_annual_cost);
	  });
	  $("#other_tmt_annum_b").blur(function(){
		  var other_tmt_annum_b = document.getElementById("other_tmt_annum_b").value; 
		  var other_tot_item_b = document.getElementById("other_tot_item_b").value;
		  var other_unit_cost_b = document.getElementById("other_unit_cost_b").value;
          var other_tot_annum_b = other_tmt_annum_b * other_tot_item_b * other_unit_cost_b;
          $('#other_tot_annum_b').val(other_tot_annum_b);
          var other_tot_annum_a = document.getElementById("other_tot_annum_a").value;
		  var other_tot_annum_b = document.getElementById("other_tot_annum_b").value;
          var other_total_b = Number(other_tot_annum_a) + Number(other_tot_annum_b);
		  $('#other_total_b').val(other_total_b);
          var other_total_b = document.getElementById("other_total_b").value;		  
          var total_labour_annum = document.getElementById("total_labour_annum").value;		  
          var total_unit_annum = document.getElementById("total_unit_annum").value;
          var treatment_b = Number(other_total_b) + Number(total_labour_annum) + Number(total_unit_annum);
          $('#treatment_b').val(treatment_b);
		  var treatment_b = document.getElementById("treatment_b").value;
		  var treatment_a = document.getElementById("treatment_a").value;
		  var total_annual_cost = Number(treatment_b) + Number(treatment_a);
		  $('#total_annual_cost').val(total_annual_cost);		  
	  });
	  $("#other_unit_cost_a").blur(function(){
		  
		  var other_unit_cost_a = document.getElementById("other_unit_cost_a").value; 
		  var other_item_a = document.getElementById("other_item_a").value;
		  var other_tot_item_a = document.getElementById("other_tot_item_a").value;
		  var other_tmt_annum_a = document.getElementById("other_tmt_annum_a").value;
		  if (other_item_a != ''){
			  other_tot_val_a = other_unit_cost_a * other_item_a;
			  $('#other_tot_val_a').val(other_tot_val_a);
		  }
		  if (other_tot_item_a != '' && other_tmt_annum_a != '') {
			  other_tot_annum_a = other_unit_cost_a * other_tot_item_a * other_tmt_annum_a;
			  $('#other_tot_annum_a').val(other_tot_annum_a);
		  }
		  var other_tot_val_a = document.getElementById("other_tot_val_a").value;
		  var other_tot_val_b = document.getElementById("other_tot_val_b").value;
		  var other_tot_annum_a = document.getElementById("other_tot_annum_a").value;
		  var other_tot_annum_b = document.getElementById("other_tot_annum_b").value;
		  var other_total_a = Number(other_tot_val_a) + Number(other_tot_val_b);
		  $('#other_total_a').val(other_total_a);
		  var other_total_b = Number(other_tot_annum_a) + Number(other_tot_annum_b);
		  $('#other_total_b').val(other_total_b);
	  });
	  $("#annual_value_a,#annual_value_b,#annual_value_c,#annual_value_d,#annual_value_e,#annual_value_f,#annual_value_g,#annual_value_h,#qty_a,#qty_b,#qty_c,#qty_d,#qty_e,#qty_f,#qty_g,#qty_h,#tmt_per_annum_a,#tmt_per_annum_b,#tmt_per_annum_c,#tmt_per_annum_d,#tmt_per_annum_e,#tmt_per_annum_f,#tmt_per_annum_g,#tmt_per_annum_h,#no_hours_a,#no_hours_b,#no_hours_c,#no_hours_d,#no_hours_e,#no_hours_f,#no_hours_g,#no_hours_h,#tmt_annum_a,#tmt_annum_b,#tmt_annum_c,#tmt_annum_d,#tmt_annum_e,#tmt_annum_f,#tmt_annum_g,#tmt_annum_h,#other_item_a,#other_item_b,#other_tmt_annum_a,#other_tmt_annum_b,#tmt_hours_a,#tmt_hours_b,#tmt_hours_c,#tmt_hours_d,#unit_per_tmt_a,#unit_per_tmt_b,#unit_per_tmt_c,#unit_per_tmt_d,#unit_per_tmt_e,#unit_per_tmt_f,#unit_per_tmt_g,#unit_per_tmt_h,#other_unit_cost_a,#other_unit_cost_b,#other_tot_item_a,#other_tot_item_b").blur(function(){
		  var total_annual_cost = document.getElementById("total_annual_cost").value;
		  var price_accept = document.getElementById("price_accept").value;
		  
		  var total_unit_cost = document.getElementById("total_unit_cost").value;
		  var total_unit_cost_annum = document.getElementById("total_unit_cost_annum").value;
		  var fix_cost_total_labour = document.getElementById("fix_cost_total_labour").value;
		  var fix_cost_total_labour_annum = document.getElementById("fix_cost_total_labour_annum").value;
		  var wfix_cost_total_labour = document.getElementById("wfix_cost_total_labour").value;
		  var wfix_cost_total_labour_annum = document.getElementById("wfix_cost_total_labour_annum").value;
		  var other_total_a = document.getElementById("other_total_a").value;
		  var other_total_b = document.getElementById("other_total_b").value;
		  
		  var fix_cost_total = Number(total_unit_cost)+Number(total_unit_cost_annum)+Number(fix_cost_total_labour)+Number(fix_cost_total_labour_annum)+Number(other_total_a)+Number(other_total_b);
		  var wfix_cost_total = Number(total_unit_cost)+Number(total_unit_cost_annum)+Number(wfix_cost_total_labour)+Number(wfix_cost_total_labour_annum)+Number(other_total_a)+Number(other_total_b);
		  
		  if (price_accept == fix_cost_total) {
              var fix_per_res = 'Equivalent';
		  } else if (price_accept != fix_cost_total) {
			  var fix_cost_value = Math.floor(((Number(price_accept) - Number(fix_cost_total)) / Number(price_accept)) * 100);
			  $('#fix_percentage').val(fix_cost_value);
			  if (fix_cost_value < 0) {
				  var fix_price_res = 'Negative';
				  var fix_profit =  'Less';
				  var fix_cost_value = Math.abs(fix_cost_value);
				  var fix_per_res = fix_price_res +' ' + '(' + fix_cost_value+'%' + ' ' + fix_profit + ')';
			  } else {
				  var fix_price_res = 'Positive';
				  var fix_profit =  'More';
				  var fix_cost_value = Math.abs(fix_cost_value);
				  var fix_per_res = fix_price_res +' ' + '(' + fix_cost_value+'%' + ' ' + fix_profit + ')';
			  }
			  $("#actual_gm_result").text(fix_per_res);
		  }
		  
		  if (price_accept == wfix_cost_total) {
              var wfix_per_res = 'Equivalent';
		  } else if (price_accept != wfix_cost_total) {
			  var wfix_cost_value = Math.floor(((Number(price_accept) - Number(wfix_cost_total)) / Number(price_accept)) * 100);
			  $('#wfix_percentage').val(wfix_cost_value);
			  if (wfix_cost_value < 0) {
				  var wfix_price_res = 'Negative';
				  var wfix_profit =  'Less';
				  var wfix_cost_value = Math.abs(wfix_cost_value);
				  var wfix_per_res = wfix_price_res +' ' + '(' + wfix_cost_value+'%' + ' ' + wfix_profit + ')';
			  } else {
				  var wfix_price_res = 'Positive';
				  var wfix_profit =  'More';
				  var wfix_cost_value = Math.abs(wfix_cost_value);
				  var wfix_per_res = wfix_price_res +' ' + '(' + wfix_cost_value+'%' + ' ' + wfix_profit + ')';
			  }
			  $("#gm_wo_result").text(wfix_per_res);
		  }
		  
		  if (price_accept == total_annual_cost) {
              var price_res = 'Equivalent';
		  } else if (price_accept != total_annual_cost) {
			  var percentage = Math.floor(((Number(price_accept) - Number(total_annual_cost)) / Number(price_accept)) * 100);
			  $('#total_percentage').val(percentage);
			  if (percentage < 0) {
				  var price_res = 'Negative';
				  var profit =  'Less';
				  var percentage = Math.abs(percentage);
				  var price_res = price_res +' ' + '(' + percentage+'%' + ' ' + profit + ')';
			  } else {
				  var price_res = 'Positive';
				  var profit =  'More';
				  var percentage = Math.abs(percentage);
				  var price_res = price_res +' ' + '(' + percentage+'%' + ' ' + profit + ')';
			  }
			  $("#percentage_result").text(price_res);
		  }
		  
		  var price_accept_tax = Number(((price_accept * 7) / 100)) + Number(price_accept);
		  $('#price_accept_tax').val(price_accept_tax);
		  
		  $("#actual_gm").hide();
	      $("#gm_wo").hide();
	  });
	   $("#surveyor").change(function(){
		  var surve = $(this).find("option:selected").text();
		  $('#surveyor_name').val(surve);
		  var surveyor_id = document.getElementById("surveyor").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {surveyor_id:surveyor_id},
			success: function(result) {
				if (result){
					$('#surveyor_code').val(result.employee_id);
				}
			}
		});
	  });
	  $("#industry").change(function(){
		  var industry_id = document.getElementById("industry").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {industry_id:industry_id},
			success: function(result) {
				if (result){
					$('#industry_code').val(result.industry_code);
			}
		}
		});
	  });
	  $("#business_origin").change(function(){
		  var business_id = document.getElementById("business_origin").value;
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: 'json',
			data: {business_id:business_id},
			success: function(result) {
				if (result){
					$('#business_code').val(result.business_code);
			}
		}
		});
	  });
	  
	  $("#job_type").change(function(){
	     //var job_type = $(this).val();
		 var job_type_a = $(this).val();
		 /* if (job_type != "") {
			 $.ajax({
				url:"ajax.php",
				data:{job_type:job_type},
				type:'POST',
				success:function(response) {
				  var resp = $.trim(response);
					  $("#visit_annum_a").html(resp);
					  $("#visit_annum_b").html(resp);
					  $("#visit_annum_c").html(resp);
					  $("#visit_annum_d").html(resp);
					  $("#visit_annum_e").html(resp);
					  $("#visit_annum_f").html(resp);
					  $("#visit_annum_g").html(resp);
					  $("#visit_annum_h").html(resp);
				}
			  });
		 } */
		 
		 if (job_type_a != "") {
			 $.ajax({
				url:"ajax.php",
				data:{job_type_a:job_type_a},
				type:'POST',
				success:function(response) {	
					var resp = $.trim(response);
					if (job_type_a == 'Job') {
						$("#job_duration").html(resp);
						$("#job_duration").prop("disabled", false);
					} else {
						$("#job_duration").html(resp);
						$("#job_duration").prop("disabled", true);
					}
					  //$("#job_duration").html(resp);
				}
			  });
		 }
			 //$("#visit_annum_a option[value='1']").hide();
	 });
	  
	 /*  $("#other_total_a").live('change',function(e){
		  alert('asdasd'); return false;
	  }); */
	  
  });
  function validateForm() {
	   document.getElementById("submit").style.display = "none";
       document.getElementById("submit_processing").style.display="";
	   document.getElementById("save").style.display = "none";
       document.getElementById("save_processing").style.display="";
       return true;
   }
</script>
</body>
</html>

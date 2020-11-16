<?php
session_start();
include ("../db/db_connect.php");
include ("../PHPMailer/class.phpmailer.php");
include ("../PHPMailer/class.smtp.php");
$server_path =  dirname(__FILE__);

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $dir .= $parts[$i] . "/";
}
$base_url = 'http://'.$dir;

if (isset($_REQUEST["eti_id"])) { $eti_id = base64_decode($_REQUEST["eti_id"]); } else { $eti_id = ""; }
if (isset($_REQUEST["email"])) { $email = base64_decode($_REQUEST["email"]); } else { $email = ""; }
if (isset($_REQUEST["email_name"])) { $email_name = base64_decode($_REQUEST["email_name"]); } else { $email_name = ""; }

    $query111 = "select approve_condition from eti_approve_details where sra_id='$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
    $approve_condition = $res111['approve_condition'];
	if($approve_condition == 1){
		header ("location:message.php?st=".base64_encode(4));
		exit;
	}
	
if ($_POST){
	$approve_level_desc_a = $_POST['approve_level_desc_a'];
	$eti_id = $_POST['eti'];
	$email = $_POST['email'];
	$email_name = $_POST['email_name'];
	$current_date = date('Y-m-d H:i:s');
	
	$query = "select id from eti_approve_details where sra_id='$eti_id'";
	$exec = mysql_query($query) or die ("Error in Query".mysql_error());
	$res = mysql_fetch_array($exec);
	$sra_id = $res['id'];
	
	if ($sra_id != '') {
			$query1 = "update eti_approve_details set approve_condition = '1', approve_condition_desc = '$approve_level_desc_a',
			   approve_condition_date_time='$current_date',approve_condition_email='$email', approve_condition_name='$email_name' where id = '$sra_id'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	} else {
		$query6 = "insert into eti_approve_details (sra_id,approve_condition,approve_condition_desc,approve_condition_date_time,approve_condition_email,approve_condition_name) 
				values('$eti_id','1','$approve_level_desc_a','$current_date','$email','$email_name')";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	}
	
	$query2 = "select total_percentage,fix_percentage,wfix_percentage,price_accept from eti_total_details where sra_id='$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$total_percentage = $res2['total_percentage'];
	$fix_percentage = $res2['fix_percentage'];
	$wfix_percentage = $res2['wfix_percentage'];
	$price_accept = $res2['price_accept'];
	
	$query41 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '1'";
	$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
	$res41 = mysql_fetch_array($exec41);
    $pest_id_a = $res41['pest_id'];
    $visit_annum_a = $res41['visit_annum'];
    $annual_value_a = $res41['annual_value'];
	
	$query42 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '2'";
	$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
	$res42 = mysql_fetch_array($exec42);
    $pest_id_b = $res42['pest_id'];
    $visit_annum_b = $res42['visit_annum'];
    $annual_value_b = $res42['annual_value'];
	
	$query43 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '3'";
	$exec43 = mysql_query($query43) or die ("Error in Query43".mysql_error());
	$res43 = mysql_fetch_array($exec43);
    $pest_id_c = $res43['pest_id'];
    $visit_annum_c = $res43['visit_annum'];
    $annual_value_c = $res43['annual_value'];
	
	$query44 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '4'";
	$exec44 = mysql_query($query44) or die ("Error in Query44".mysql_error());
	$res44 = mysql_fetch_array($exec44);
    $pest_id_d = $res44['pest_id'];
    $visit_annum_d = $res44['visit_annum'];
    $annual_value_d = $res44['annual_value'];
	
	$query45 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '5'";
	$exec45 = mysql_query($query45) or die ("Error in Query45".mysql_error());
	$res45 = mysql_fetch_array($exec45);
    $pest_id_e = $res45['pest_id'];
    $visit_annum_e = $res45['visit_annum'];
    $annual_value_e = $res45['annual_value'];
	
	$query46 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '6'";
	$exec46 = mysql_query($query46) or die ("Error in Query46".mysql_error());
	$res46 = mysql_fetch_array($exec46);
    $pest_id_f = $res46['pest_id'];
    $visit_annum_f = $res46['visit_annum'];
    $annual_value_f = $res46['annual_value'];
	
	$query47 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '7'";
	$exec47 = mysql_query($query47) or die ("Error in Query47".mysql_error());
	$res47 = mysql_fetch_array($exec47);
    $pest_id_g = $res47['pest_id'];
    $visit_annum_g = $res47['visit_annum'];
    $annual_value_g = $res47['annual_value'];
	
	$query48 = "select pest_id,visit_annum,annual_value from eti_product_details where sra_id = '$eti_id' and product_count = '8'";
	$exec48 = mysql_query($query48) or die ("Error in Query48".mysql_error());
	$res48 = mysql_fetch_array($exec48);
    $pest_id_h = $res48['pest_id'];
    $visit_annum_h = $res48['visit_annum'];
    $annual_value_h = $res48['annual_value'];
	
	$query49 = "select pest_name from eti_pest where id = '$pest_id_a'";
	$exec49 = mysql_query($query49) or die ("Error in Query49".mysql_error());
	$res49 = mysql_fetch_array($exec49);
    $pest_name_a = $res49['pest_name'];
	
	$query50 = "select pest_name from eti_pest where id = '$pest_id_b'";
	$exec50 = mysql_query($query50) or die ("Error in Query50".mysql_error());
	$res50 = mysql_fetch_array($exec50);
    $pest_name_b = $res50['pest_name'];
	
	$query51 = "select pest_name from eti_pest where id = '$pest_id_c'";
	$exec51 = mysql_query($query51) or die ("Error in Query51".mysql_error());
	$res51 = mysql_fetch_array($exec51);
    $pest_name_c = $res51['pest_name'];
	
	$query52 = "select pest_name from eti_pest where id = '$pest_id_d'";
	$exec52 = mysql_query($query52) or die ("Error in Query52".mysql_error());
	$res52 = mysql_fetch_array($exec52);
    $pest_name_d = $res52['pest_name'];
	
	$query53 = "select pest_name from eti_pest where id = '$pest_id_e'";
	$exec53 = mysql_query($query53) or die ("Error in Query53".mysql_error());
	$res53 = mysql_fetch_array($exec53);
    $pest_name_e = $res53['pest_name'];
	
	$query54 = "select pest_name from eti_pest where id = '$pest_id_f'";
	$exec54 = mysql_query($query54) or die ("Error in Query54".mysql_error());
	$res54 = mysql_fetch_array($exec54);
    $pest_name_f = $res54['pest_name'];
	
	$query55 = "select pest_name from eti_pest where id = '$pest_id_g'";
	$exec55 = mysql_query($query55) or die ("Error in Query55".mysql_error());
	$res55 = mysql_fetch_array($exec55);
    $pest_name_g = $res55['pest_name'];
	
	$query56 = "select pest_name from eti_pest where id = '$pest_id_h'";
	$exec56 = mysql_query($query56) or die ("Error in Query56".mysql_error());
	$res56 = mysql_fetch_array($exec56);
    $pest_name_h = $res56['pest_name'];
		 
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
		$profit_text = 'Less';
		$fpercentage = $percentage_text.' ('.abs($fix_percentage).'%)';
	} else if ($fix_percentage > 0) {
		$percentage_text = 'Positive';
		$profit_text = 'More';
		$fpercentage = $percentage_text.' ('.abs($fix_percentage).'%)';
	} else if ($fix_percentage == 0) {
		$fpercentage = 'Equivalent';
	}
	
	if($wfix_percentage < 0) {
		$percentage_text = 'Negative';
		$profit_text = 'Less';
		$wfpercentage = $percentage_text.' ('.abs($wfix_percentage).'%)';
	} else if ($wfix_percentage > 0) {
		$percentage_text = 'Positive';
		$profit_text = 'More';
		$wfpercentage = $percentage_text.' ('.abs($wfix_percentage).'%)';
	} else if ($wfix_percentage == 0) {
		$wfpercentage = 'Equivalent';
	}
	
	$query3 = "select business_type,serial_number,name,industry_id,created_by,postcode_b,eti_date,attachment_a,attachment_b,attachment_c,attachment_d,attachment_e from eti_sra where id='$eti_id'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$business_type = $res3['business_type'];
	$serial_number = $res3['serial_number'];
	$industry_id = $res3['industry_id'];
	$name = $res3['name'];
	$created_by = $res3['created_by'];
	$postcode_b = $res3['postcode_b'];
	$eti_date = $res3['eti_date'];
	$eti_date = strtotime($eti_date);
    $eti_date = date("d-m-Y", $eti_date);
	$attachment_a_target = $res3['attachment_a'];
	$attachment_b_target = $res3['attachment_b'];
	$attachment_c_target = $res3['attachment_c'];
	$attachment_d_target = $res3['attachment_d'];
	$attachment_e_target = $res3['attachment_e'];
	
	$query388 = "select employee_name,user_mail from eti_portal_user where id='$created_by'";
	$exec388 = mysql_query($query388) or die ("Error in Query388".mysql_error());
	$res388 = mysql_fetch_array($exec388);
	$employee_name = $res388['employee_name'];
	$employee_email = $res388['user_mail'];
	
	$query33 = "select industry_name from eti_industry where id='$industry_id'";
	$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
	$res33 = mysql_fetch_array($exec33);
	$industry_name = $res33['industry_name'];
	
	$query34 = "select approve_condition_name,approve_condition_date_time,approve_b_name,approve_b_date_time from eti_approve_details where sra_id='$eti_id'";
	$exec34 = mysql_query($query34) or die ("Error in Query34".mysql_error());
	$res34 = mysql_fetch_array($exec34);
	$approve_condition_name = $res34['approve_condition_name'];
	$approve_condition_date_time = $res34['approve_condition_date_time'];
	
	if($fix_percentage >= 50){
		$condition = 'Greater Than 50';
		$business_id = '0';
		$add_type = 'TO';
		$level = '0';
			
		$query4 = "select id,name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level = '$level' and business_type='$business_id' and add_type='$add_type'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		$res4 = mysql_fetch_array($exec4);
		$email = $res4['email'];
		$email_name = $res4['name'];
		$email_id = $res4['id'];
		
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
						<div><b>Customer Name :</b> '.$name.'</div>
						<div><b>Contract / Job Value:</b>'.$price_accept.'</div>
						<div><b>Customer Type :</b> '.$industry_name.'</div><br />
						<div><b>Gross Margin 1 :</b> '.$percentage.'</div><br />
						<div>Below is the approval summary:</div> <br />
						<div>Approved By: '.$approve_condition_name.' : '.$approve_condition_date_time.'</div><br />
						<div>
							<a class="link_button" href="'.$base_url.'reject_admin_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Reject</a>
						</div><br />
						<div> 
							<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b>
						</div>
					</body>
				</html>';
		//$subject = "ETI - ".$serial_number." - ".$name." for your action";
		$subject = "ETI/".$employee_name." - ".substr($name,0,30)." - ".$eti_date." - ".$postcode_b." for your action";
		$approve_desc = 'Sent To Admin Team';
		
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
		
	} else if ($fix_percentage < 50){
		    $condition = 'Less Than 50';
			$business_id = '0';
			$level = '1';
			$add_type = 'TO';
			
			$query5 = "select id,name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level = '$level' and business_type='$business_id' and add_type='$add_type'";
			$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
			$res5= mysql_fetch_array($exec5);
			$email = $res5['email'];
			$email_name = $res5['name'];
			$email_id = $res5['id'];
			
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
						<div>Product Details:</div><br />'; if ($pest_id_a != '') {
						$body .= '<div>'.$pest_name_a.' - '.$visit_annum_a.' - '.$annual_value_a.'</div>'; } if ($pest_id_b != '') {
						$body .= '<div>'.$pest_name_b.' - '.$visit_annum_b.' - '.$annual_value_b.'</div>'; } if ($pest_id_c != '') {
						$body .= '<div>'.$pest_name_c.' - '.$visit_annum_c.' - '.$annual_value_c.'</div>'; } if ($pest_id_d != '') {
						$body .= '<div>'.$pest_name_d.' - '.$visit_annum_d.' - '.$annual_value_d.'</div>'; } if ($pest_id_e != '') {
						$body .= '<div>'.$pest_name_e.' - '.$visit_annum_e.' - '.$annual_value_e.'</div>'; } if ($pest_id_f != '') {
						$body .= '<div>'.$pest_name_f.' - '.$visit_annum_f.' - '.$annual_value_f.'</div>'; } if ($pest_id_g != '') {
						$body .= '<div>'.$pest_name_g.' - '.$visit_annum_g.' - '.$annual_value_g.'</div>'; } if ($pest_id_h != '') {
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
			//$subject = "ETI - ".$serial_number." - ".$name." for your approval";
			$subject = "ETI/".$employee_name." - ".substr($name,0,30)." - ".$eti_date." - ".$postcode_b." for your approval";
			$approve_desc = 'Pending at '.$email_name;
			
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
			$query39 = "select name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level='$level' and business_type='$business_id' and add_type='$add_type_cc'";
			$exec39 = mysql_query($query39) or die ("Error in Query39".mysql_error());
			$res39= mysql_fetch_array($exec39);
			$email_cc = $res39['email'];
			$email_name_cc = $res39['name'];
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
						<div><b>Customer Name :</b> '.$name.'</div>
						<div><b>Contract / Job Value :</b> '.$price_accept.'</div>
						<div><b>Customer Type :</b> '.$industry_name.'</div><br />
						<div>Product Details:</div><br />'; if ($pest_id_a != '') {
						$body .= '<div>'.$pest_name_a.' - '.$visit_annum_a.' - '.$annual_value_a.'</div>'; } if ($pest_id_b != '') {
						$body .= '<div>'.$pest_name_b.' - '.$visit_annum_b.' - '.$annual_value_b.'</div>'; } if ($pest_id_c != '') {
						$body .= '<div>'.$pest_name_c.' - '.$visit_annum_c.' - '.$annual_value_c.'</div>'; } if ($pest_id_d != '') {
						$body .= '<div>'.$pest_name_d.' - '.$visit_annum_d.' - '.$annual_value_d.'</div>'; } if ($pest_id_e != '') {
						$body .= '<div>'.$pest_name_e.' - '.$visit_annum_e.' - '.$annual_value_e.'</div>'; } if ($pest_id_f != '') {
						$body .= '<div>'.$pest_name_f.' - '.$visit_annum_f.' - '.$annual_value_f.'</div>'; } if ($pest_id_g != '') {
						$body .= '<div>'.$pest_name_g.' - '.$visit_annum_g.' - '.$annual_value_g.'</div>'; } if ($pest_id_h != '') {
						$body .= '<div>'.$pest_name_h.' - '.$visit_annum_h.' - '.$annual_value_h.'</div><br />'; } 
						$body .= '<br /><div><b>Gross Margin 1 :</b> '.$percentage.'</div>
						<div><b>Gross Margin 2 :</b> '.$fpercentage.'</div>
						<div><b>Gross Margin without Fixed Costs  :</b> '.$wfpercentage.'</div> <br />
						 <div> 
						<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b></div>
					</body>
				</html>';
			$subject = "ETI/".$employee_name." - ".substr($name,0,30)." - ".$eti_date." - ".$postcode_b." for your reference";
			
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
			$visitor_email = 'speedasia-sg@rentokil-initial.com';
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
	}
	
		/* $mail = new PHPMailer();
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
		$mail->SetFrom($from_email, $from_name);
		$mail->AddReplyTo($from_email,$from_name);
		$mail->Subject  = $subject;
		$mail->MsgHTML($body);   
		$path = $server_path.'/downloads/eti_pdf/';
		$id_name= "ETI - ".$serial_number;
		$actual_path = $path.$id_name.".pdf";
		$mail->AddAttachment($actual_path);
		$mail->Send(); */
		
	$current_date = date('Y-m-d H:i:s');	
	$query111 = "update eti_sra_status set approve_desc = '$approve_desc', approve_date_time = '$current_date',
			   approve_email_id='$email',approve_name='$email_name', user_id='$email_id' where sra_id = '$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	
	header ("location:message.php?st=".base64_encode(1));
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Approve</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="shortcut icon" type="image/png" href="../images/rentokil_logo.png"/>
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<br><br><br><br><br><br><br>
<div class="example-modal">
        <div class="modal modal-primary">
          <div class="modal-dialog">
		    <form action="approve_condition.php" name="approve" id="approve" onsubmit="return validateForm()" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                  <span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title">Approve</h4>
              </div>
              <div class="modal-body">
			    <input type="hidden" class="form-control" name="eti" id="eti" value="<?php echo $eti_id; ?>">
			    <input type="hidden" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
			    <input type="hidden" class="form-control" name="email_name" id="email_name" value="<?php echo $email_name; ?>">
                <textarea class="form-control" name="approve_level_desc_a" id="approve_level_desc_a" rows="3" placeholder="Enter ..."></textarea>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>-->
                <button type="submit" name="submit" id="submit" class="btn btn-outline">Approve</button>
              </div>
            </div>
			</form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
</body>

      <!-- /.example-modal -->
<!-- /.center -->
<script>
/* function validateForm() {
	var x = document.forms["approve"]["approve_level_desc_a"].value;
    if (x == "") {
        alert("Please provide Description to Approve!!");
        return false;
    }
} */
</script>
<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
</body>
</html>

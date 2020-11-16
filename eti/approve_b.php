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
	if ($eti_id != '') {
		$query111 = "select approve_b from eti_approve_details where sra_id='$eti_id'";
		$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
		$res111 = mysql_fetch_array($exec111);
		$approve_b = $res111['approve_b'];
		if($approve_b == 1){
			header ("location:message.php?st=".base64_encode(4));
			exit;
		}
	}
if (isset($_POST['submit'])){
	//echo 'asdd'; exit;
	$approve_level_desc_b = $_POST['approve_level_desc_b'];
	$eti_id = $_POST['eti'];
	$email = $_POST['email'];
	$email_name = $_POST['email_name'];
	$current_date = date('Y-m-d H:i:s');
	
	$query = "select id from eti_approve_details where sra_id='$eti_id'";
	$exec = mysql_query($query) or die ("Error in Query".mysql_error());
	$res = mysql_fetch_array($exec);
	$sra_id = $res['id'];
	if ($sra_id != '') {
    $query1 = "update eti_approve_details set approve_b = '1', approve_b_desc = '$approve_level_desc_b',
			   approve_b_date_time='$current_date',approve_b_email='$email', approve_b_name='$email_name' where id = '$sra_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	} else {
	$query6 = "insert into eti_approve_details (sra_id,approve_b,approve_b_date_time,approve_b_email,approve_b_name) 
				values('$eti_id','1','$current_date','$email','$email_name')";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	}
	
    //$query1 = "update eti_sra set approve_level_b = '1', approve_level_desc_b = '$approve_level_desc_b' where id = '$eti_id'";
	//$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	
	$query2 = "select total_percentage,fix_percentage,price_accept from eti_total_details where sra_id='$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$fix_percentage = $res2['fix_percentage'];
	$total_percentage = $res2['total_percentage'];
	$price_accept = $res2['price_accept'];
	
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
	
	$query3 = "select business_type,serial_number,name,industry_id,created_by,postcode_b,eti_date,attachment_a,attachment_b,attachment_c,attachment_d,attachment_e from eti_sra where id='$eti_id'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$business_type = $res3['business_type'];
	$serial_number = $res3['serial_number'];
	$name = $res3['name'];
	$industry_id = $res3['industry_id'];
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
	
	$query34 = "select approve_a_name,approve_a_date_time,approve_b_name,approve_b_date_time from eti_approve_details where sra_id='$eti_id'";
	$exec34 = mysql_query($query34) or die ("Error in Query34".mysql_error());
	$res34 = mysql_fetch_array($exec34);
	$approve_a_name = $res34['approve_a_name'];
	$approve_a_date_time = $res34['approve_a_date_time'];
	$approve_b_name = $res34['approve_b_name'];
	$approve_b_date_time = $res34['approve_b_date_time'];
	
	if($fix_percentage < 20){
		$condition = 'Less Than 20';
		$business_id = '0';
		$level = '0';
		$add_type = 'TO';
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
						<div><b>Below is the approval summary</b></div><br />
						<div><b>Approved By:</b> '.$approve_a_name.' : '.$approve_a_date_time.'</div>
						<div><b>Approved By:</b> '.$approve_b_name.' : '.$approve_b_date_time.'</div><br />
						<div><b>Gross Margin 1 :</b> '.$percentage.'</div><br />
						<div>
							<a class="link_button" href="'.$base_url.'reject_admin_b.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Reject</a>
						</div><br />
						<div> 
							<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b>
						</div>
					</body>
				</html>';
			//$subject = "ETI - ".$serial_number." - ".$name." for your action";
			$subject = "ETI/".$employee_name." - ".substr($name,0,30)." - ".$eti_date." - ".$postcode_b." for your action";
			$approve_desc = 'Sent To Admin Team';
	}
	
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
		    <form action="approve_b.php" name="approve" id="approve" method="post">
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
                <textarea class="form-control" name="approve_level_desc_b" id="approve_level_desc_b" rows="3" placeholder="Enter ..."></textarea>
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
</html>

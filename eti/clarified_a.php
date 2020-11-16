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
if (isset($_REQUEST["clarify_email"])) { $clarify_email = base64_decode($_REQUEST["clarify_email"]); } else { $clarify_email = ""; }
if (isset($_REQUEST["clarify_name"])) { $clarify_name = base64_decode($_REQUEST["clarify_name"]); } else { $clarify_name = ""; }

$query111 = "select approve_a from eti_approve_details where sra_id='$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
    $approve_a = $res111['approve_a'];
	if($approve_a == 4){
		header ("location:message.php?st=".base64_encode(6));
		exit;
	}
	
/* $query121 = "select employee_name,user_mail from eti_portal_user a, eti_sra b where a.id = b.created_by and b.id= '$eti_id'";
$exec121 = mysql_query($query121) or die ("Error in Query121".mysql_error());
$res121 = mysql_fetch_array($exec121);
$employee_name = $res121['employee_name'];
$employee_user_mail = $res121['user_mail']; */

if ($_POST){
	$clarify_level_desc_a = $_POST['clarify_level_desc_a'];
	$eti_id = $_POST['eti'];
	$email = $_POST['email'];
	$email_name = $_POST['email_name'];
	$clarify_email = $_POST['clarify_email'];
	$clarify_name = $_POST['clarify_name'];
	$current_date = date('Y-m-d H:i:s');
	
    $query = "select id from eti_approve_details where sra_id='$eti_id'";
	$exec = mysql_query($query) or die ("Error in Query".mysql_error());
	$res = mysql_fetch_array($exec);
	$sra_id = $res['id'];
	
	if ($sra_id != '') {
    $query1 = "update eti_approve_details set approve_a = '4', approve_a_desc = '$clarify_level_desc_a',
			   approve_a_date_time='$current_date',approve_a_email='$clarify_email', approve_a_name='$clarify_name' where id = '$sra_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	} /*else {
	$query6 = "insert into eti_approve_details (sra_id,approve_a,approve_a_desc,approve_a_date_time,approve_a_email,approve_a_name) 
				values('$eti_id','3','$clarify_level_desc_a','$current_date','$email','$email_name')";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	} */
	
	$query78 = "select count(id) as chat_count from eti_clarify_details where sra_id='$eti_id'";
	$exec78 = mysql_query($query78) or die ("Error in Query78".mysql_error());
	$res78 = mysql_fetch_array($exec78);
	$chat_count = $res78['chat_count'] + 1;
	
	$query66 = "insert into eti_clarify_details (sra_id,clarify_a,clarify_a_desc,clarify_a_date_time,clarify_a_email,clarify_a_name,chat_count,clarify_level) 
				values('$eti_id','3','$clarify_level_desc_a','$current_date','$clarify_email','$clarify_name','$chat_count','1')";
	$exec66 = mysql_query($query66) or die ("Error in Query66".mysql_error());
	
	$query2 = "select total_percentage,fix_percentage from eti_total_details where sra_id='$eti_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$fix_percentage = $res2['fix_percentage'];
	$total_percentage = $res2['total_percentage'];
	
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
	
	$query3 = "select business_type,name,serial_number,eti_date,created_by,postcode_b,attachment_a,attachment_b,attachment_c,attachment_d,attachment_e from eti_sra where id='$eti_id'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$business_type = $res3['business_type'];
	$serial_number = $res3['serial_number'];
	$name = $res3['name'];
	$eti_date = $res3['eti_date'];
	$eti_date = strtotime($eti_date);
    $eti_date = date("d-m-Y", $eti_date);
	$created_by = $res3['created_by'];
	$postcode_b = $res3['postcode_b'];
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
		
		$body ='<html>
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
						<b>Hi,</b>
						</div> <br /> 
						<div>Please find ETI PDF attached below.</div> <br />
						<div><b>GM:</b> '.$percentage.'</div> <br />
						<div><b>Description:</b> '.$clarify_level_desc_a.'</div> <br />
						<div>
							<a class="link_button" href="'.$base_url.'approve_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Approve</a>
							<a class="link_button" href="'.$base_url.'reject_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Reject</a>
							<a class="link_button" href="'.$base_url.'clarify_a.php?eti_id='.base64_encode($eti_id).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name).'" target="_blank">Clarification</a>
						 </div><br/>
						 <div> 
						<b>Regards,<br /> Rentokil Intial Pvt Ltd.</b></div>
					</body>
				</html>';
	$subject = "ETI Request Form (".$employee_name." - ".substr($name,0,30)." - ".$eti_date." - ".$postcode_b.")";
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
	
	$approve_desc = 'Clarified By '.$clarify_name.' To '.$email_name;
	$query111 = "update eti_sra_status set approve_desc = '$approve_desc', approve_date_time = '$current_date',
			   approve_email_id='$clarify_email',approve_name='$clarify_name', user_id='' where sra_id = '$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	
	header ("location:message.php?st=".base64_encode(3));
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Clarify</title>
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
		    <form action="clarified_a.php" name="clarify" id="clarify" onsubmit="return validateForm()" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                  <span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title">Clarification</h4>
              </div>
              <div class="modal-body">
			    <input type="hidden" class="form-control" name="eti" id="eti" value="<?php echo $eti_id; ?>">
				<input type="hidden" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
			    <input type="hidden" class="form-control" name="email_name" id="email_name" value="<?php echo $email_name; ?>">
			    <input type="hidden" class="form-control" name="clarify_email" id="clarify_email" value="<?php echo $clarify_email; ?>">
			    <input type="hidden" class="form-control" name="clarify_name" id="clarify_name" value="<?php echo $clarify_name; ?>">
                <textarea class="form-control" name="clarify_level_desc_a" id="clarify_level_desc_a" rows="3" placeholder="Enter ..." required></textarea>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>-->
                <button type="submit" name="submit" id="submit" class="btn btn-outline">Clarify</button>
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
</body>
</html>

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

    $query111 = "select approve_desc from eti_sra_status where sra_id='$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
    $approve_desc = $res111['approve_desc'];
	if($approve_desc == 'Rejected By Admin'){
		header ("location:message.php?st=".base64_encode(5));
		exit;
	}
	
if ($_POST){
	$reject_level_desc_b = mysql_real_escape_string($_POST['reject_level_desc_b']);
	$eti_id = $_POST['eti'];
	$email = $_POST['email'];
	$email_name = $_POST['email_name'];
	$current_date = date('Y-m-d H:i:s');
	
	$query144 = "select id from eti_portal_user where user_mail='$email'";
	$exec144 = mysql_query($query144) or die ("Error in Query144".mysql_error());
	$res144 = mysql_fetch_array($exec144);
	$user_id = $res144['id'];
	
    $query = "select id from eti_approve_details where sra_id='$eti_id'";
	$exec = mysql_query($query) or die ("Error in Query".mysql_error());
	$res = mysql_fetch_array($exec);
	$sra_id = $res['id'];
	
	if ($sra_id != '') {
    $query1 = "update eti_approve_details set approve_contract_admin = '5', approve_contract_admin_desc = '$reject_level_desc_b',
			   approve_contract_admin_date_time='$current_date',approve_contract_admin_email='$email', approve_contract_admin_name='$email_name' where id = '$sra_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	} else {
	$query6 = "insert into eti_approve_details (sra_id,approve_contract_admin,approve_contract_admin_desc,approve_contract_admin_date_time,approve_contract_admin_email,approve_contract_admin_name) 
				values('$eti_id','5','$reject_level_desc_b','$current_date','$email','$email_name')";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	}
	
	$approve_desc = 'Rejected By Admin';
	$query111 = "update eti_sra_status set approve_desc = '$approve_desc', approve_date_time = '$current_date',
			   approve_email_id='$email',approve_name='$email_name', user_id='$user_id' where sra_id = '$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	
	$query122 = "update eti_sra set form_status = 0 where id = '$eti_id'";
	$exec122 = mysql_query($query122) or die ("Error in Query122".mysql_error());
	
	$query133 = "select a.serial_number,a.name,a.eti_date,a.postcode_b,b.employee_name,b.user_mail,a.attachment_a,a.attachment_b,a.attachment_c,a.attachment_d,a.attachment_e from eti_sra a, eti_portal_user b where a.id='$eti_id' and a.created_by = b.id";
	$exec133 = mysql_query($query133) or die ("Error in Query133".mysql_error());
	$res133 = mysql_fetch_array($exec133);
	$serial_number = $res133['serial_number'];
	$name = $res133['name'];
	$eti_date = $res133['eti_date'];
	$postcode_b = $res133['postcode_b'];
	$employee_name = $res133['employee_name'];
	$employee_mail = $res133['user_mail'];
	$attachment_a_target = $res133['attachment_a'];
	$attachment_b_target = $res133['attachment_b'];
	$attachment_c_target = $res133['attachment_c'];
	$attachment_d_target = $res133['attachment_d'];
	$attachment_e_target = $res133['attachment_e'];
	
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
						<b>Dear '.$employee_name.',</b>
						</div> <br /> 
						<div>The ETI (Serial No. '.$serial_number.') has been send back to you with below comments for your action. Please update the ETI and re-submit for processing.</div> <br />
						<div><b>Comments :</b> '.$reject_level_desc_a.'</div><br />
						<div> 
							<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b>
						</div>
					</body>
				</html>';
			$subject = "ETI/".$employee_name." - ".substr($name,0,30)." - ".$eti_date." - ".$postcode_b." needs your action";
			
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
			$mail->AddAddress($employee_mail,$employee_name);
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
	
	header ("location:message.php?st=".base64_encode(2));
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Reject</title>
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
		    <form action="reject_admin_b.php" name="reject" id="reject" onsubmit="return validateForm()" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                  <span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title">Reject</h4>
              </div>
              <div class="modal-body">
			    <input type="hidden" class="form-control" name="eti" id="eti" value="<?php echo $eti_id; ?>">
				<input type="hidden" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
			    <input type="hidden" class="form-control" name="email_name" id="email_name" value="<?php echo $email_name; ?>">
                <textarea class="form-control" name="reject_level_desc_b" id="reject_level_desc_b" rows="3" placeholder="Enter ..." required></textarea>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>-->
                <button type="submit" name="submit" id="submit" class="btn btn-outline">Reject</button>
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
function validateForm() {
	var x = document.forms["reject"]["reject_level_desc_b"].value;
    if (x == "") {
        alert("Please provide Description to Reject!!");
        return false;
    }
}
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

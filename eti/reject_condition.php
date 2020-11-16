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
	if($approve_condition == 2){
		header ("location:message.php?st=".base64_encode(5));
		exit;
	}
	
if ($_POST){
	$reject_level_desc_a = $_POST['reject_level_desc_a'];
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
    $query1 = "update eti_approve_details set approve_condition = '2', approve_condition_desc = '$reject_level_desc_a',approve_condition_date_time='$current_date',approve_condition_email='$email', approve_condition_name='$email_name' where id = '$sra_id'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	} else {
	$query6 = "insert into eti_approve_details (sra_id,approve_condition,approve_condition_desc,approve_condition_date_time,approve_condition_email,approve_condition_name)values('$eti_id','2','$reject_level_desc_a','$current_date','$email','$email_name')";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	}
	$approve_desc = 'Rejected By '.$email_name;
	$query111 = "update eti_sra_status set approve_desc = '$approve_desc', approve_date_time = '$current_date',
			   approve_email_id='$email',approve_name='$email_name', user_id='$user_id' where sra_id = '$eti_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
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
		    <form action="reject_condition.php" name="reject" id="reject" onsubmit="return validateForm()" method="post">
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
                <textarea class="form-control" name="reject_level_desc_a" id="reject_level_desc_a" rows="3" placeholder="Enter ..." required></textarea>
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
	var x = document.forms["reject"]["reject_level_desc_a"].value;
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

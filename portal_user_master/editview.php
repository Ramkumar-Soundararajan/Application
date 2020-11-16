<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../../PORTAL/index.php");
include ("../db/db_connect.php");
//require '../PHPMailer/class.phpmailer.php'; // path to the PHPMailer class
//require '../PHPMailer/class.smtp.php';
$menu_title='Add Portal User';
if (isset($_REQUEST["user_id"])) { $user_id = $_REQUEST["user_id"]; } else { $user_id = ""; }
if($user_id != ''){
	$query2 = "select * from eti_portal_user where id='$user_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$user_mail =  $res2['user_mail'];
	$user_pass =  $res2['user_pass'];
	$employee_code =  $res2['employee_code'];
	$employee_name =  $res2['employee_name'];
	$branch = $res2['branch'];
	$countryy = $res2['country'];
	$access_right = $res2['access_rights'];
	$id  =  $res2['id'];
	
	$query12 = "select country_name from eti_country_master where id= '$countryy'";
	$exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
	$res12 = mysql_fetch_array($exec12);
	
	$countryy_name = $res12['country_name'];
	
	$query13 = "select branch_name from eti_branch_master where id= '$branch' and business_code = 'D'";
	$exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
	$res13 = mysql_fetch_array($exec13);
}else{
	$user_mail =  '';
	$user_pass =  '';
	$employee_name =  '';
	$employee_code =  '';
	$branch = '';
	$countryy = '';
	$access_right =  '';
	$id = '';
}
if ($_POST){
	$user_id = $_POST['user_id'];
	$user_mail = $_POST['user_mail'];
	$user_pass = $_POST['user_pass'];
	$employee_name = $_POST['employee_name'];
	$employee_code = $_POST['employee_code'];
	$branch = $_POST['branch'];
	$country = $_POST['country'];
	$access_rights = $_POST['access_rights'];
	
	
	function RandNumber($e)
	{
		for($i=0;$i<$e;$i++){
		$rand =  $rand .  rand(0, 9); 
	}
	return $rand;
	}
  		 $pwd = RandNumber(3);
		 $password="Ren".$pwd."!to!";
	
	if($user_id == ''){
		$query1 = "insert into eti_portal_user (user_mail,user_pass,employee_name,employee_code,branch,country,access_rights,deleted) 
				values('$user_mail','$password','$employee_name','$employee_code','$branch','$country','$access_rights','0')";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				
		/* $mail = new PHPMailer();
        $mail->IsSMTP();  // telling the class to use SMTP
        $mail->SMTPDebug = 0;
        $mail->Mailer = "smtp";
        $mail->Host = "ssl://smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = "speedasia-in@rentokil-initial.com"; // SMTP username
        $mail->Password = "@Process_01"; // SMTP password 
        $Mail->Priority = 1;
		//$email = 'ramkumar.soundararajan@rentokil-initial.com';
		$visitor_email = 'speedasia-in@rentokil-initial.com';
        $mail->AddAddress($user_mail,"Ramkumar");
        $mail->SetFrom($visitor_email, $name);
        $mail->AddReplyTo($visitor_email,$name);
		$user_message = "<div style='width:654px;' >
<div style='padding-left:20px;'>
<p>Dear $employee_name, </p>
<p>Welcome to TPA Portal. Here's your login details.</p>
</div>
<div style='margin-left:20px; border-bottom:#FF0000 solid 2px; width:620px;'>
<p ><strong>Username :</strong>$user_mail</p>
<p><strong>Password :</strong>$password</p>
<p>Please Login to http://ec2-13-59-168-169.us-east-2.compute.amazonaws.com/PORTAL/</p></div>
<br/>
<div style='width:654px;margin-left:20px;'><strong>Further Details Please Contact :</strong><br /><br />
<strong>E-Mail ID :</strong><a href='#'> prakash.venugopal@rentokil-initial.com</a></div></div>";
        
		
		$mail->Subject  = "Rentokil TPA Portal";
        $mail->Body     = $user_message;
		$mail->IsHTML(true);
        $mail->WordWrap = 50;  
        $mail->Send();
         if(!$mail->Send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
        echo 'Message has been sent.';
        } */
			header ("location:listview.php"); 
	} else {
		$query5 = "update eti_portal_user set user_mail = '$user_mail', user_pass =  '$user_pass', employee_name = '$employee_name', employee_code = '$employee_code',
				   branch = '$branch',  country='$country', access_rights = '$access_rights', deleted='0' where id = '$id'";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		header ("location:listview.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Portal User Master</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
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
        Portal User Master
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
              <h3 class="box-title">Add Portal User</h3>
            </div>
    <form action="editview.php" method="post"> 
        <div class="box-body">
          <div class="row">
			<div class="col-md-6">
              <div class="form-group">
                <label>User Email</label>
                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $id; ?>">
                <input type="text" class="form-control" name="user_mail" id="user_mail" value="<?php echo $user_mail; ?>" placeholder="User Email" required="required">
              </div>
			   <div class="form-group">
                <label>Employee Name</label>
                <input type="text" class="form-control" name="employee_name" id="employee_name" value="<?php echo $employee_name; ?>" placeholder="Employee Name" required="required">
              </div>
			  <div class="form-group">
                <label>Country</label>
                <select class="form-control select2" style="width: 100%;" name="country" id="country" required="required">
					<?php if ($countryy != '' || $countryy_name != '') {
						echo '<option value="'.$countryy.'" selected="selected">'.$countryy_name.'</option>';
					}else{
						echo '<option value="" selected="selected">Please Choose Country</option>';
					}
					?>
					<?php
					$query7 = "select id,country_name from eti_country_master order by country_name";
					$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
					while ($res7 = mysql_fetch_array($exec7))
					{
					$country_id = $res7["id"];
					$country_name = $res7["country_name"];
					?>
                  <option value ="<?php echo $country_id; ?>"><?php echo $country_name; ?></option>
					<?php } ?>
                </select>
              </div>
			   <div class="form-group">
                <label>Access Rights</label>
					<select class="form-control select2" style="width: 100%;" name="access_rights" id="access_rights">
					<?php if ($access_right == '') { ?>
					   <option value="">Please Choose Rights</option>
					   <option value="1">Sales</option>
					   <option value="2">Contract Admin</option>
					   <option value="4">IT Admin</option>
					   <option value="5">Reporting</option>
					<?php } else if ($access_right == '1') { ?>
					   <option value="">Please Choose Rights</option>
					   <option value="1" selected="selected">Sales</option>
					   <option value="2">Contract Admin</option>
					   <option value="4">IT Admin</option>
					   <option value="5">Reporting</option>
					   <?php } else if ($access_right == '2') { ?>
					   <option value="">Please Choose Rights</option>
					   <option value="1">Sales</option>
					   <option value="2" selected="selected">Contract Admin</option>
					   <option value="4">IT Admin</option>
					   <option value="5">Reporting</option>
					<?php } else if ($access_right == '4') {?>
					   <option value="">Please Choose Rights</option>
					   <option value="1">Sales</option>
					   <option value="2">Contract Admin</option>
					   <option value="4" selected="selected">IT Admin</option>
					   <option value="5">Reporting</option>
					<?php } else if ($access_right == '5') {?>
					   <option value="">Please Choose Rights</option>
					   <option value="1">Sales</option>
					   <option value="2">Contract Admin</option>
					   <option value="4">IT Admin</option>
					   <option value="5" selected="selected">Reporting</option>
					<?php } ?>
					</select>
              </div>
            </div>
            <div class="col-md-6">
			 <div class="form-group">
                <label>User Password</label>
                <input type="password" class="form-control" name="user_pass" id="user_pass" value="<?php echo $user_pass; ?>" placeholder="User Password" readonly>
              </div>
			  <div class="form-group">
                <label>Employee Code</label>
                <input type="text" class="form-control" name="employee_code" id="employee_code" value="<?php echo $employee_code; ?>" placeholder="Employee Code" required="required">
              </div>
			  <div class="form-group">
                <label>Branch</label>
                <select class="form-control select2" style="width: 100%;" name="branch" id="branch" required="required">
					<?php if ($branch != '' || $res13['branch_name'] != '') {
						echo '<option value="'.$branch.'" selected="selected">'.$res13['branch_name'].'</option>';
					}else{
						echo '<option value="" selected="selected">Please Choose Branch</option>';
					}
					?>
					<?php
					$query6 = "select id,branch_name from eti_branch_master where business_code = 'D' order by branch_name";
					$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
					while ($res6 = mysql_fetch_array($exec6))
					{
					$branch_id = $res6["id"];
					$branch_name = $res6["branch_name"];
					?>
                  <option value="<?php echo $branch_id;?>"><?php echo $branch_name; ?></option>
					<?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
	
          </div>
        </div>
		<div class="box-footer">
                <button type="submit" name="cancel" id="cancel" class="btn btn-default">Cancel</button>
                <button type="submit" name="submit" id="submit" class="btn btn-info pull-right">Submit</button>
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
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/select2/select2.full.min.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
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
</script>
</body>
</html>

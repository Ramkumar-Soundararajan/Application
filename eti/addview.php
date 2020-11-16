<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");

   include ("../db/db_connect.php");
   $session_id = $_SESSION["userloginid"];
   $query12 = "select user_mail,access_rights from eti_portal_user where id = '$session_id'";
   $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
   $res12 = mysql_fetch_array($exec12);
   $user_mail = $res12['user_mail'];
   $access_rights = $res12['access_rights'];
   $menu_title='Add ETI';
   
   $query122 = "select max(serial_no) as serial_no from eti_serial_no";
   $exec122 = mysql_query($query122) or die ("Error in Query122".mysql_error());
   $res122 = mysql_fetch_array($exec122);
   $serial_no = $res122['serial_no'];
   
   if ($serial_no == ''){
	   $serial_no = '0001';
   } else{
	   $serial_no = $serial_no + 1;
   }
   $serial_no = sprintf("%04d", $serial_no);
   
   $current_y = date("Y");
   $current_m = date("m");
   $serial_number = $current_y.$current_m.$serial_no;
   
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
  <title>ETI | Add ETI</title>
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
  <!--<link rel="stylesheet" href="telephone/css/intlTelInput.css">
 
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">-->
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
    <form action="addaction.php" name="addview" id="addview" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" autocomplete="off"> 
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
					<div class="checkbox">
						<label>
							<input type="checkbox" id="trial" name="trial" class="trial" value="Yes"> <b><?php echo $trial_lbl; ?></b>
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				 <div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="amend" name="amend" value="Yes"> <b><?php echo $amend_lbl; ?></b>
						</label>
					</div>
				  </div>
			</div>
		 </div>
          <div class="row">
			<div class="col-md-3">
              <div class="form-group">
                <label><?php echo $serial_number_lbl; ?></label>
                <input type="text" class="form-control" name="serial_number" id="serial_number" value="<?php //echo $serial_number; ?>" placeholder="Serial Number"  readonly>
                <input type="hidden" class="form-control" name="serial_no" id="serial_no" value="<?php //echo $serial_no; ?>" placeholder="Serial Number"  readonly>
                <input type="hidden" class="form-control" name="page_source" id="page_source" value="1" placeholder="1"  readonly>
              </div>
            </div>
            <div class="col-md-3">
             <div class="form-group">
                <label><?php echo $competitor_lbl; ?></label><span style="color:red">*</span>
				<select class="form-control select2" style="width: 100%;" name="competitor" id="competitor" required>
					<option value="">Please choose Competitor</option>
					<?php
					$query7 = "select id,competitor_name from eti_competitor order by competitor_name";
					$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
					while ($res7 = mysql_fetch_array($exec7))
					{
					$competitor_id = $res7["id"];
					$competitor_name = $res7["competitor_name"];
					?>
					<option value ="<?php echo $competitor_id; ?>"><?php echo $competitor_name; ?></option>
					<?php } ?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $surveyor_lbl; ?></label><span style="color:red">*</span>
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
					?>
					<option value ="<?php echo $surveyor_id; ?>"><?php echo $surveyor_name; ?></option>
					<?php } ?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $contract_no_lbl; ?></label>
                <input type="text" class="form-control" name="contract_no" id="contract_no" placeholder="Contract No" <?php if ($access_rights != 2){ echo 'readonly';} ?>>
              </div>
            </div>
          </div>
		  <div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $industry_lbl; ?></label><span style="color:red">*</span>
                <select class="form-control select2" style="width: 100%;" name="industry" id="industry" required>
					<option value="">Please choose Industrial</option>
					<?php
					$query9 = "select id,industry_name from eti_industry order by industry_name";
					$exec9 = mysql_query($query9) or die ("Error in Query8".mysql_error());
					while ($res9 = mysql_fetch_array($exec9))
					{
					$industry_id = $res9["id"];
					$industry_name = $res9["industry_name"];
					?>
					<option value ="<?php echo $industry_id; ?>"><?php echo $industry_name; ?></option>
					<?php } ?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $eti_date_lbl; ?> <span style="color:red">*</span></label>
                <input type="date" class="form-control" name="eti_date" id="eti_date" placeholder="Contract No" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $eti_time_lbl; ?> <span style="color:red">*</span></label>
                <select class="form-control" name="eti_time" id="eti_time" required>
					<option value="">Please choose Time</option>
					<option value="01:00am">01:00am</option>
					<option value="02:00am">02:00am</option>
					<option value="03:00am">03:00am</option>
					<option value="04:00am">04:00am</option>
					<option value="05:00am">05:00am</option>
					<option value="06:00am">06:00am</option>
					<option value="07:00am">07:00am</option>
					<option value="08:00am">08:00am</option>
					<option value="09:00am">09:00am</option>
					<option value="10:00am">10:00am</option>
					<option value="11:00am">11:00am</option>
					<option value="12:00pm">12:00pm</option>
					<option value="01:00pm">01:00pm</option>
					<option value="02:00pm">02:00pm</option>
					<option value="03:00pm">03:00pm</option>
					<option value="04:00pm">04:00pm</option>
					<option value="05:00pm">05:00pm</option>
					<option value="06:00pm">06:00pm</option>
					<option value="07:00pm">07:00pm</option>
					<option value="08:00pm">08:00pm</option>
					<option value="09:00pm">09:00pm</option>
					<option value="10:00pm">10:00pm</option>
					<option value="11:00pm">11:00pm</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $eti_duration_lbl; ?> <span style="color:red">*</span></label>
                <select class="form-control" style="width:32%; display: inline;" name="eti_duration" id="eti_duration" required>
					<option value="">Please choose Duration</option>
					<option value="1 Hour">1 Hour</option>
					<option value="2 Hours">2 Hours</option>
					<option value="3 Hours">3 Hours</option>
					<option value="4 Hours">4 Hours</option>
					<option value="5 Hours">5 Hours</option>
					<option value="6 Hours">6 Hours</option>
					<option value="7 Hours">7 Hours</option>
					<option value="8 Hours">8 Hours</option>
					<option value="1 Day">1 Day</option>
					<option value="2 Days">2 Days</option>
					<option value="3 Days">3 Days</option>
					<option value="4 Days">4 Days</option>
					<option value="5 Days & Above">5 Days & Above</option>
				</select>
				<select class="form-control" style="width:32%; display:inline;" name="job_type" id="job_type" required>
					<option value="">Please choose Job Type</option>
					<option value="Contract">Contract</option>
					<option value="Job">Job</option>
					<option value="Product Sales">Product Sales</option>
				</select>
				<select class="form-control" style="width:32%; display: inline;" name="business_type" id="business_type" required>
					<option value="">Please choose Business Type</option>
					<option value="New Business">New Business</option>
					<option value="Additional">Additional</option>
					<option value="Re-negotiated">Re-negotiated</option>
				</select>
              </div>
            </div>	
		  </div>
		  <div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $name_lbl; ?> <span style="color:red">*</span></label>
					<div class="input-group">
						<select name="salutation" class="form-control" id="salutation" style="width:30%;" required>
							<option value="">Please choose Salutation</option>
							<option value="Mr.">Mr.</option>
							<option value="Ms.">Ms.</option>
							<option value="Dr.">Dr.</option>
							<option value="Mdm.">Mdm.</option>
							<option value="Mrs.">Mrs.</option>
						</select>
						<input type="text" class="form-control" name="name" id="name" style="width:70%;" placeholder="Name" required>
					</div>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $existing_account_lbl; ?></label>
                <input type="text" class="form-control" name="existing_account" id="existing_account" placeholder="Existing Account No" >
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $decision_maker_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="decision_maker" id="decision_maker" placeholder="Decision Maker" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $whom_see_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="whom_see" id="whom_see" placeholder="Whom to See" required>
              </div>
            </div>
		  </div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $address_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" maxlength="40" class="form-control" name="address_a" id="address_a" placeholder="Address" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $address_b_lbl; ?></label>
                <input type="text" maxlength="40" class="form-control" name="address_b" id="address_b" placeholder="Address">
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $postcode_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="postcode_a" id="postcode_a" placeholder="Postcode" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $tel_a_lbl; ?> <span style="color:red">*</span></label>
				<div class="input-group">
					<select name="country_code_a" class="form-control" id="country_code_a" style="width:30%;" required>
						<option value="+65">+65</option>
					</select>
					<input type="tel" class="form-control" style="width:70%;" name="tel_a" id="tel_a" placeholder="Billing Telephone" required>
				</div>
				<!-- <span id="valid-msg-a" class="hide">✓</span>
				<span id="error-msg-a" class="hide">X</span> -->
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_address_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" maxlength="40" class="form-control" name="premises_address_a" id="premises_address_a" placeholder="Address" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_address_b_lbl; ?></label>
                <input type="text" maxlength="40" class="form-control" name="premises_address_b" id="premises_address_b" placeholder="Address">
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_postcode_a_lbl; ?> <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="postcode_b" id="postcode_b" placeholder="Postcode" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $premises_tel_a_lbl; ?> <span style="color:red">*</span></label>
				<div class="input-group">
					<select name="country_code_b" class="form-control" id="country_code_b" style="width:30%;" required>
						<option value="+65">+65</option>
					</select>
                <input type="tel" class="form-control" style="width:70%;" name="tel_b" id="tel_b" placeholder="Premise Telephone" required>
				</div>
				<!-- <span id="valid-msg-b" class="hide">✓</span>
				<span id="error-msg-b" class="hide">X</span> -->
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
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" multiple pattern="^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?,)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$" required>
                <input type="hidden" class="form-control" name="useremail" id="useremail" placeholder="Email" value="<?php echo $user_mail;?>">
                <input type="hidden" class="form-control" name="created_by" id="created_by" placeholder="Email" value="<?php echo $session_id;?>">
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $infestation_lbl; ?> <span style="color:red">*</span></label>
				<select class="form-control" name="infestation" id="infestation" required>
					<option value="">Please choose Degree of Infestation</option>
					<option value="Light">Light</option>
					<option value="Medium">Medium</option>
					<option value="Heavy">Heavy</option>
					<option value="NIL">NIL</option>
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
					?>
					<option value ="<?php echo $business_id; ?>"><?php echo $business_name; ?></option>
					<?php } ?>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $referral_name_lbl; ?></label>
                <input type="text" class="form-control" name="referral_name" id="referral_name" placeholder="Referral Name" >
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $sra_sra_lbl; ?> <span style="color:red">*</span></label>
					<input type="text" class="form-control" style="width:90%; display: inline;" name="sra" id="sra" placeholder="SRA" required>&nbsp;&nbsp;<span style="width:10%; display: inline;" id="sra_status"></span>
					<input type="hidden" class="form-control" style="width:90%; display: inline;" name="sra_validation" id="sra_validation" placeholder="SRA" required>
				</div>
			</div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $duration_lbl; ?> <span style="color:red">*</span></label>
				<select class="form-control" name="duration" id="duration" required>
					<option value="Continuous">Continuous</option>
					<option value="Limited Contract">Limited Contract</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $job_duration_lbl; ?></label>
				<select class="form-control" name="job_duration" id="job_duration">
					<option value="">Please choose Job Duration</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $surveyor_code_lbl; ?></label><span style="color:red">*</span>
                <input type="text" class="form-control" name="surveyor_code" id="surveyor_code" placeholder="Surveyor Code" readonly>
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $billing_email_lbl; ?></label>
                <input type="email" class="form-control" name="billing_email" id="billing_email" placeholder="Billing Email" multiple pattern="^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?,)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $business_code_lbl; ?></label><span style="color:red">*</span>
                <input type="text" class="form-control" name="business_code" id="business_code" placeholder="Business Code" readonly>
              </div>
            </div>
		    <div class="col-md-3">
             <div class="form-group">
                <label><?php echo $industry_code_lbl; ?></label> <span style="color:red">*</span>
                <input type="text" class="form-control" name="industry_code" id="industry_code" placeholder="Industry Code" readonly>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $business_origin_code_lbl; ?></label>
                <input type="text" class="form-control" name="business_origin_code" id="business_origin_code" placeholder="Business Origin Detail Code" readonly>
              </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $prospect_no_lbl; ?></label><span style="color:red">*</span>
                <input type="number" class="form-control" style="width:90%; display: inline;" name="prospect_no" id="prospect_no" placeholder="Prospect Number" maxlength = "6" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" required>&nbsp;&nbsp;<span style="width:10%; display: inline;" id="prospect_no_status"></span>
				<input type="hidden" class="form-control" style="width:90%; display: inline;" name="prospect_no_validation" id="prospect_no_validation" placeholder="Prospect Number" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $coordinate_x_lbl; ?></label><span style="color:red">*</span>
                <input type="number" class="form-control" name="coordinate_x" id="coordinate_x" step="any" min="103.6" max="104.1" placeholder="Coordinate X" required>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $coordinate_y_lbl; ?></label><span style="color:red">*</span>
                <input type="number" class="form-control" name="coordinate_y" id="coordinate_y" step="any" min="1.20" max="1.47" placeholder="Coordinate Y" required>
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
                <select class="form-control" name="domestic" id="domestic" >
					<option value="">Please choose Domestic</option>
					<option value="Bungalow">Bungalow</option>
					<option value="Clustered Housing">Clustered Housing</option>
					<option value="Condominium">Condominium</option>
					<option value="Private Apartment">Private Apartment</option>
					<option value="Semi Detached">Semi Detached</option>
					<option value="Terrance">Terrance</option>
					<option value="Townhouse">Townhouse</option>
					<option value="Walkup Apartment">Walkup Apartment</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $industrial_lbl; ?></label>
                <select class="form-control" name="industrial" id="industrial" >
					<option value="">Please choose Industry</option>
					<option value="Flatted Factory">Flatted Factory</option>
					<option value="Landed Factory">Landed Factory</option>
					<option value="Warehouse">Warehouse</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $commercial_lbl; ?></label>
                <select class="form-control" name="commercial" id="commercial" >
					<option value="">Please choose Commercial</option>
					<option value="Cinema/Theater">Cinema/Theater</option>
					<option value="Food Court">Food Court</option>
					<option value="Hotel">Hotel</option>
					<option value="Office Building">Office Building</option>
					<option value="Restaurant">Restaurant</option>
					<option value="Retail Shop">Retail Shop</option>
					<option value="Shop House">Shop House</option>
					<option value="Shopping Mall">Shopping Mall</option>
				</select>
              </div>
            </div>
			<div class="col-md-3">
             <div class="form-group">
                <label><?php echo $others_lbl; ?></label>
                <input type="text" class="form-control" name="site_plan_others" id="site_plan_others" placeholder="Others" >
              </div>
            </div>
			</div>
			<div class="row">
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $location_lbl; ?></label>
					<input type="text" class="form-control" name="location" id="location" placeholder="Location of Site" >
				  </div>
				</div>
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $area_treatment_lbl; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="text" class="form-control" name="lm" id="lm" style="display:inline-block;width:35%;" ><div style="display:inline-block;width:14%;">&nbsp;<?php echo $lm_lbl; ?></div>
					<input type="text" class="form-control" name="meter" id="meter" style="display:inline-block;width:35%;" ><div style="display:inline-block;width:14%;">&nbsp;<?php echo $meter_lbl; ?><sup>2</sup></div>
				  </div>
				</div>
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $surveyor_lbl; ?></label>
					<input type="text" class="form-control" name="surveyor_name" id="surveyor_name" placeholder="Surveyor Name" readonly>
				  </div>
				</div>
				<div class="col-md-3">
				 <div class="form-group">
					<label><?php echo $litre_lbl; ?></label>
					<input type="text" class="form-control" name="litre" id="litre" placeholder="No. of Liters" >
				  </div>
				</div>
			</div>
			<div class="row">
			 <div class="col-md-3">
			 <label> <?php echo $chemical_lbl; ?> &nbsp;&nbsp; </label>
				<label><input type="radio" name="chemical" id="chemical" value="Premise 200 SC">&nbsp;<?php echo $chemical_premise_lbl; ?></label>
			 </div>
			 <div class="col-md-3">
				 <label></label>
				<label><input type="radio" name="chemical" id="chemical" value="Optigrad termite liquid">&nbsp;<?php echo $chemical_optigrad_lbl; ?> </label>
			 </div>
			 <div class="col-md-3">
				 <label></label>
				<label><input type="radio" name="chemical" id="chemical" value="Ultrathor">&nbsp;<?php echo $chemical_wazary_lbl; ?></label>
			 </div>
			 <div class="col-md-3">
				 <label></label>
				<label><input type="radio" name="chemical" id="chemical" value="Altriset">&nbsp;<?php echo $chemical_agenda_lbl; ?></label>
			 </div>
			  <div class="col-md-3">
				<label>
					<input type="checkbox" name="chemical_other"  id="chemical_other">&nbsp;<?php echo $chemical_others_lbl; ?>
					<input type="text" style="width:75%; display:inline;" class="form-control" name="chemical_other_desc" id="chemical_other_desc">
				</label>
			 </div>
			</div> <br>
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label><?php echo $pest_lbl; ?></label>
						<select class="form-control select2" style="width: 100%;" name="pest_a" id="pest_a">
							<option value="">Please choose Pest</option>
							<?php
							$query100 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec100 = mysql_query($query100) or die ("Error in Query100".mysql_error());
							while ($res100 = mysql_fetch_array($exec100))
							{
							$pest_id_a = $res100["id"];
							$pest_name_a = $res100["pest_name"];
							?>
							<option value ="<?php echo $pest_id_a; ?>"><?php echo $pest_name_a; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $qty_lbl; ?></label>
						<input type="text" class="form-control" name="pest_qty_a" id="pest_qty_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $instruction_lbl; ?></label>
						<input type="text" class="form-control" name="instruction_a" id="instruction_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $visit_annum_lbl; ?></label>
						<select class="form-control" name="visit_annum_a" id="visit_annum_a" >
							<option value="">Visit</option>
							<!-- <option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option> -->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $add_freq_lbl; ?></label>
						<input type="text" class="form-control" name="add_freq_a" id="add_freq_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $annual_value_lbl; ?></label>
						<input type="number" min="0" class="form-control" name="annual_value_a" id="annual_value_a" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_a" id="product_count_a" value="1" placeholder="" >
						<input type="hidden" class="form-control" name="condition1" id="condition1" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref1" id="condition_ref1" value="" placeholder="">
				  </div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_b" id="pest_b" >
							<option value="">Please choose Pest</option>
							<?php
							$query101 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec101 = mysql_query($query101) or die ("Error in Query101".mysql_error());
							while ($res101 = mysql_fetch_array($exec101))
							{
							$pest_id_b = $res101["id"];
							$pest_name_b = $res101["pest_name"];
							?>
							<option value ="<?php echo $pest_id_b; ?>"><?php echo $pest_name_b; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_b" id="pest_qty_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_b" id="instruction_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<select class="form-control" name="visit_annum_b" id="visit_annum_b" >
							<option value="">Visit</option>
							<!--<option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option> -->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_b" id="add_freq_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_b" id="annual_value_b" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_b" id="product_count_b" value="2" placeholder="" >
						<input type="hidden" class="form-control" name="condition2" id="condition2" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref2" id="condition_ref2" value="" placeholder="">
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_c" id="pest_c" >
							<option value="">Please choose Pest</option>
							<?php
							$query102 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec102 = mysql_query($query102) or die ("Error in Query102".mysql_error());
							while ($res102 = mysql_fetch_array($exec102))
							{
							$pest_id_c = $res102["id"];
							$pest_name_c = $res102["pest_name"];
							?>
							<option value ="<?php echo $pest_id_c; ?>"><?php echo $pest_name_c; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_c" id="pest_qty_c" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_c" id="instruction_c" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<select class="form-control" name="visit_annum_c" id="visit_annum_c" >
							<option value="">Visit</option>
							<!--<option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option> -->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_c" id="add_freq_c" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_c" id="annual_value_c" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_c" id="product_count_c" value="3" placeholder="" >
						<input type="hidden" class="form-control" name="condition3" id="condition3" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref3" id="condition_ref3" value="" placeholder="">
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_d" id="pest_d" >
							<option value="">Please choose Pest</option>
							<?php
							$query103 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec103 = mysql_query($query103) or die ("Error in Query103".mysql_error());
							while ($res103 = mysql_fetch_array($exec103))
							{
							$pest_id_d = $res103["id"];
							$pest_name_d = $res103["pest_name"];
							?>
							<option value ="<?php echo $pest_id_d; ?>"><?php echo $pest_name_d; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_d" id="pest_qty_d" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_d" id="instruction_d" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<select class="form-control" name="visit_annum_d" id="visit_annum_d" >
							<option value="">Visit</option>
							<!--<option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option> -->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_d" id="add_freq_d" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_d" id="annual_value_d" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_d" id="product_count_d" value="4" placeholder="" >
						<input type="hidden" class="form-control" name="condition4" id="condition4" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref4" id="condition_ref4" value="" placeholder="">
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_e" id="pest_e" >
							<option value="">Please choose Pest</option>
							<?php
							$query104 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec104 = mysql_query($query104) or die ("Error in Query104".mysql_error());
							while ($res104 = mysql_fetch_array($exec104))
							{
							$pest_id_e = $res104["id"];
							$pest_name_e = $res104["pest_name"];
							?>
							<option value ="<?php echo $pest_id_e; ?>"><?php echo $pest_name_e; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_e" id="pest_qty_e" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_e" id="instruction_e" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<select class="form-control" name="visit_annum_e" id="visit_annum_e" >
							<option value="">Visit</option>
							<!--<option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option> -->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_e" id="add_freq_e" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_e" id="annual_value_e" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_e" id="product_count_e" value="5" placeholder="" >
						<input type="hidden" class="form-control" name="condition5" id="condition5" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref5" id="condition_ref5" value="" placeholder="">
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_f" id="pest_f" >
							<option value="">Please choose Pest</option>
							<?php
							$query105 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec105 = mysql_query($query105) or die ("Error in Query105".mysql_error());
							while ($res105 = mysql_fetch_array($exec105))
							{
							$pest_id_f = $res105["id"];
							$pest_name_f = $res105["pest_name"];
							?>
							<option value ="<?php echo $pest_id_f; ?>"><?php echo $pest_name_f; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_f" id="pest_qty_f" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_f" id="instruction_f" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<select class="form-control" name="visit_annum_f" id="visit_annum_f" >
							<option value="">Visit</option>
							<!--<option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option> -->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_f" id="add_freq_f" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_f" id="annual_value_f" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_f" id="product_count_f" value="6" placeholder="" >
						<input type="hidden" class="form-control" name="condition6" id="condition6" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref6" id="condition_ref6" value="" placeholder="">
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_g" id="pest_g" >
							<option value="">Please choose Pest</option>
							<?php
							$query106 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec106 = mysql_query($query106) or die ("Error in Query106".mysql_error());
							while ($res106 = mysql_fetch_array($exec106))
							{
							$pest_id_g = $res106["id"];
							$pest_name_g = $res106["pest_name"];
							?>
							<option value ="<?php echo $pest_id_g; ?>"><?php echo $pest_name_g; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_g" id="pest_qty_g" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_g" id="instruction_g" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<select class="form-control" name="visit_annum_g" id="visit_annum_g" >
							<option value="">Visit</option>
							<!--<option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option>-->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_g" id="add_freq_g" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_g" id="annual_value_g" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_g" id="product_count_g" value="7" placeholder="" >
						<input type="hidden" class="form-control" name="condition7" id="condition7" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref7" id="condition_ref7" value="" placeholder="">
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label></label>
						<select class="form-control select2" style="width: 100%;" name="pest_h" id="pest_h" >
							<option value="">Please choose Pest</option>
							<?php
							$query107 = "select id,pest_name from eti_pest where deleted = 0 order by pest_name";
							$exec107 = mysql_query($query107) or die ("Error in Query107".mysql_error());
							while ($res107= mysql_fetch_array($exec107))
							{
							$pest_id_h = $res107["id"];
							$pest_name_h = $res107["pest_name"];
							?>
							<option value ="<?php echo $pest_id_h; ?>"><?php echo $pest_name_h; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="pest_qty_h" id="pest_qty_h" placeholder="" >
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="instruction_h" id="instruction_h" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<select class="form-control" name="visit_annum_h" id="visit_annum_h" >
							<option value="">Visit</option>
							<!--<option value="1 X 12">1 X 12</option>
							<option value="2 X 12">2 X 12</option>
							<option value="3 X 12">3 X 12</option>
							<option value="4 X 12">4 X 12</option>
							<option value="6 X 12">6 X 12</option>
							<option value="8 X 12">8 X 12</option>
							<option value="12 X 12">12 X 12</option>
							<option value="24 X 12">24 X 12</option>
							<option value="26 X 12">26 X 12</option>
							<option value="36 X 12">36 X 12</option>
							<option value="40 X 12">40 X 12</option>
							<option value="48 X 12">48 X 12</option>
							<option value="52 X 12">52 X 12</option>
							<option value="104 X 12">104 X 12</option>
							<option value="156 X 12">156 X 12</option>-->
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="add_freq_h" id="add_freq_h" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="0" class="form-control" name="annual_value_h" id="annual_value_h" placeholder="" step="any">
						<input type="hidden" class="form-control" name="product_count_h" id="product_count_h" value="8" placeholder="" >
						<input type="hidden" class="form-control" name="condition8" id="condition8" value="" placeholder="">
						<input type="hidden" class="form-control" name="condition_ref8" id="condition_ref8" value="" placeholder="">
				  </div>
				</div>
			</div> <br>
			
			<div class="row">
				
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $preparations_lbl; ?></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_a" id="preparation_a" >
							<option value="">Please choose Preparation</option>
							<?php
							$query110 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec110 = mysql_query($query110) or die ("Error in Query110".mysql_error());
							while ($res110 = mysql_fetch_array($exec110))
							{
							$equipment_id_a = $res110["id"];
							$equipment_name_a = $res110["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_a; ?>"><?php echo $equipment_name_a; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $unit_cost_lbl; ?></label>
						<input type="text" class="form-control" name="unit_cost_a" id="unit_cost_a" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_a" id="unit_selling_a" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $qty_lbl; ?></label>
						<input type="number" class="form-control" name="qty_a" id="qty_a" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $tot_val_unit_lbl; ?></label>
						<input type="text" class="form-control" name="tot_val_unit_a" id="tot_val_unit_a" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_a" id="tot_val_cost_a" style="text-align:right" placeholder="S$" readonly>
						
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $units_per_tmt_lbl; ?></label>
						<input type="number" class="form-control" name="unit_per_tmt_a" id="unit_per_tmt_a" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $tmt_per_annum_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_a" id="tmt_per_annum_a" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $val_per_annum_lbl; ?></label>
						<input type="text" class="form-control" name="val_per_annum_a" id="val_per_annum_a" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_a" id="val_per_annum_cost_a" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_a" id="pest_count_a" value="1" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_b" id="preparation_b" >
							<option value="">Please choose Preparation</option>
							<?php
							$query111 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
							while ($res111 = mysql_fetch_array($exec111))
							{
							$equipment_id_b = $res111["id"];
							$equipment_name_b = $res111["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_b; ?>"><?php echo $equipment_name_b; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_b" id="unit_cost_b" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_b" id="unit_selling_b" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="qty_b" id="qty_b" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_b" id="tot_val_unit_b" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_b" id="tot_val_cost_b" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="unit_per_tmt_b" id="unit_per_tmt_b" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_b" id="tmt_per_annum_b" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_b" id="val_per_annum_b" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_b" id="val_per_annum_cost_b" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_b" id="pest_count_b" value="2" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_c" id="preparation_c" >
							<option value="">Please choose Preparation</option>
							<?php
							$query112 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec112 = mysql_query($query112) or die ("Error in Query112".mysql_error());
							while ($res112 = mysql_fetch_array($exec112))
							{
							$equipment_id_c = $res112["id"];
							$equipment_name_c = $res112["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_c; ?>"><?php echo $equipment_name_c; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_c" id="unit_cost_c" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_c" id="unit_selling_c" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="qty_c" id="qty_c" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_c" id="tot_val_unit_c" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_c" id="tot_val_cost_c" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="unit_per_tmt_c" id="unit_per_tmt_c" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_c" id="tmt_per_annum_c" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_c" id="val_per_annum_c" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_c" id="val_per_annum_cost_c" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_c" id="pest_count_c" value="3" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_d" id="preparation_d" >
							<option value="">Please choose Preparation</option>
							<?php
							$query113 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec113 = mysql_query($query113) or die ("Error in Query113".mysql_error());
							while ($res113 = mysql_fetch_array($exec113))
							{
							$equipment_id_d = $res113["id"];
							$equipment_name_d = $res113["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_d; ?>"><?php echo $equipment_name_d; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_d" id="unit_cost_d" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_d" id="unit_selling_d" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="qty_d" id="qty_d" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_d" id="tot_val_unit_d" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_d" id="tot_val_cost_d" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="unit_per_tmt_d" id="unit_per_tmt_d" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_d" id="tmt_per_annum_d" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_d" id="val_per_annum_d" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_d" id="val_per_annum_cost_d" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_d" id="pest_count_d" value="4" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_e" id="preparation_e" >
							<option value="">Please choose Preparation</option>
							<?php
							$query114 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec114 = mysql_query($query114) or die ("Error in Query114".mysql_error());
							while ($res114 = mysql_fetch_array($exec114))
							{
							$equipment_id_e = $res114["id"];
							$equipment_name_e = $res114["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_e; ?>"><?php echo $equipment_name_e; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_e" id="unit_cost_e" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_e" id="unit_selling_e" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="qty_e" id="qty_e" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_e" id="tot_val_unit_e" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_e" id="tot_val_cost_e" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="unit_per_tmt_e" id="unit_per_tmt_e" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_e" id="tmt_per_annum_e" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_e" id="val_per_annum_e" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_e" id="val_per_annum_cost_e" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_e" id="pest_count_e" value="5" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_f" id="preparation_f" >
							<option value="">Please choose Preparation</option>
							<?php
							$query115 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec115 = mysql_query($query115) or die ("Error in Query115".mysql_error());
							while ($res115 = mysql_fetch_array($exec115))
							{
							$equipment_id_f = $res115["id"];
							$equipment_name_f = $res115["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_f; ?>"><?php echo $equipment_name_f; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_f" id="unit_cost_f" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_f" id="unit_selling_f" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="qty_f" id="qty_f" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_f" id="tot_val_unit_f" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_f" id="tot_val_cost_f" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="unit_per_tmt_f" id="unit_per_tmt_f" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_f" id="tmt_per_annum_f" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_f" id="val_per_annum_f" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_f" id="val_per_annum_cost_f" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_f" id="pest_count_f" value="6" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_g" id="preparation_g" >
							<option value="">Please choose Preparation</option>
							<?php
							$query116 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec116 = mysql_query($query116) or die ("Error in Query115".mysql_error());
							while ($res116 = mysql_fetch_array($exec116))
							{
							$equipment_id_g = $res116["id"];
							$equipment_name_g = $res116["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_g; ?>"><?php echo $equipment_name_g; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_g" id="unit_cost_g" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_g" id="unit_selling_g" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="qty_g" id="qty_g" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_g" id="tot_val_unit_g" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_g" id="tot_val_cost_g" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="unit_per_tmt_g" id="unit_per_tmt_g" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_g" id="tmt_per_annum_g" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_g" id="val_per_annum_g" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_g" id="val_per_annum_cost_g" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_g" id="pest_count_g" value="7" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label></label>
						<select class="form-control select2" style="width: 100%;" name="preparation_h" id="preparation_h" >
							<option value="">Please choose Preparation</option>
							<?php
							$query117 = "select id,equipment_name from eti_equipment where deleted = 0 order by equipment_name";
							$exec117 = mysql_query($query117) or die ("Error in Query117".mysql_error());
							while ($res117 = mysql_fetch_array($exec117))
							{
							$equipment_id_h = $res117["id"];
							$equipment_name_h = $res117["equipment_name"];
							?>
							<option value ="<?php echo $equipment_id_h; ?>"><?php echo $equipment_name_h; ?></option>
							<?php } ?>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="unit_cost_h" id="unit_cost_h" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="unit_selling_h" id="unit_selling_h" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="qty_h" id="qty_h" style="text-align:right" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="tot_val_unit_h" id="tot_val_unit_h" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="tot_val_cost_h" id="tot_val_cost_h" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" class="form-control" name="unit_per_tmt_h" id="unit_per_tmt_h" style="text-align:right" placeholder="" step='0.01'>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="tmt_per_annum_h" id="tmt_per_annum_h" style="text-align:right" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="val_per_annum_h" id="val_per_annum_h" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="val_per_annum_cost_h" id="val_per_annum_cost_h" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="pest_count_h" id="pest_count_h" value="8" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
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
						<input type="text" class="form-control" name="total_unit" id="total_unit" style="text-align:right" placeholder="S$" readonly>
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
						<input type="text" class="form-control" name="total_unit_annum" id="total_unit_annum" style="text-align:right" placeholder="S$" readonly>
						<input type="hidden" class="form-control" name="total_unit_cost_annum" id="total_unit_cost_annum" style="text-align:right" placeholder="S$" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group"></div>
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
						<select class="form-control" name="shift_type_a" id="shift_type_a" >
							<option value="">Please choose Shift Type</option>
							<option value="Normal">Normal</option>
							<option value="Evening Shift">Evening Shift</option>
							<option value="Public Holiday/Sunday">Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $per_hour_lbl; ?></label>
						<input type="text" class="form-control" name="per_hour_a" id="per_hour_a" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_a" id="fix_cost_per_hour_a" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_a" id="wfix_cost_per_hour_a" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $no_hours_lbl; ?></label>
						<input type="number" class="form-control" name="no_hours_a" id="no_hours_a" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $total_hours_lbl; ?></label>
						<input type="text" class="form-control" name="total_hours_a" id="total_hours_a" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_a" id="fix_cost_total_hours_a" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_a" id="wfix_cost_total_hours_a" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $tmt_hours_lbl; ?></label>
						<input type="time" class="form-control" name="tmt_hours_a" id="tmt_hours_a" placeholder="">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $tmt_annum_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="tmt_annum_a" id="tmt_annum_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $labour_value_lbl; ?></label>
						<input type="text" class="form-control" name="labour_value_a" id="labour_value_a" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_a" id="fix_cost_labour_value_a" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_a" id="wfix_cost_labour_value_a" placeholder="S$" style="text-align:right" readonly>
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
						<select class="form-control" name="shift_type_b" id="shift_type_b" >
							<option value="">Please choose Shift Type</option>
							<option value="Normal">Normal</option>
							<option value="Evening Shift">Evening Shift</option>
							<option value="Public Holiday/Sunday">Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="per_hour_b" id="per_hour_b" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_b" id="fix_cost_per_hour_b" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_b" id="wfix_cost_per_hour_b" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" class="form-control" name="no_hours_b" id="no_hours_b" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_hours_b" id="total_hours_b" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_b" id="fix_cost_total_hours_b" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_b" id="wfix_cost_total_hours_b" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="time" class="form-control" name="tmt_hours_b" id="tmt_hours_b" placeholder="">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="tmt_annum_b" id="tmt_annum_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="labour_value_b" id="labour_value_b" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_b" id="fix_cost_labour_value_b" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_b" id="wfix_cost_labour_value_b" placeholder="S$" style="text-align:right" readonly>
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
						<select class="form-control" name="shift_type_c" id="shift_type_c" >
							<option value="">Please choose Shift Type</option>
							<option value="Normal">Normal</option>
							<option value="Evening Shift">Evening Shift</option>
							<option value="Public Holiday/Sunday">Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="per_hour_c" id="per_hour_c" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_c" id="fix_cost_per_hour_c" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_c" id="wfix_cost_per_hour_c" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" class="form-control" name="no_hours_c" id="no_hours_c" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_hours_c" id="total_hours_c" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_c" id="fix_cost_total_hours_c" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_c" id="wfix_cost_total_hours_c" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="time" class="form-control" name="tmt_hours_c" id="tmt_hours_c" placeholder="">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="tmt_annum_c" id="tmt_annum_c" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="labour_value_c" id="labour_value_c" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_c" id="fix_cost_labour_value_c" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_c" id="wfix_cost_labour_value_c" placeholder="S$" style="text-align:right" readonly>
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
						<select class="form-control" name="shift_type_d" id="shift_type_d" >
							<option value="">Please choose Shift Type</option>
							<option value="Normal">Normal</option>
							<option value="Evening Shift">Evening Shift</option>
							<option value="Public Holiday/Sunday">Public Holiday/Sunday</option>
						</select>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="per_hour_d" id="per_hour_d" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_per_hour_d" id="fix_cost_per_hour_d" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_per_hour_d" id="wfix_cost_per_hour_d" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" class="form-control" name="no_hours_d" id="no_hours_d" placeholder="" step="0.01">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="total_hours_d" id="total_hours_d" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_hours_d" id="fix_cost_total_hours_d" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_hours_d" id="wfix_cost_total_hours_d" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label><br>
						<input type="time" class="form-control" name="tmt_hours_d" id="tmt_hours_d" placeholder="">
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="number" min="1" class="form-control" name="tmt_annum_d" id="tmt_annum_d" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label><br>
						<input type="text" class="form-control" name="labour_value_d" id="labour_value_d" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_labour_value_d" id="fix_cost_labour_value_d" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_labour_value_d" id="wfix_cost_labour_value_d" placeholder="S$" style="text-align:right" readonly>
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
						<input type="text" class="form-control" name="total_labour" id="total_labour" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_labour" id="fix_cost_total_labour" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_labour" id="wfix_cost_total_labour" placeholder="S$" style="text-align:right" readonly>
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
						<input type="text" class="form-control" name="total_labour_annum" id="total_labour_annum" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="fix_cost_total_labour_annum" id="fix_cost_total_labour_annum" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="wfix_cost_total_labour_annum" id="wfix_cost_total_labour_annum" placeholder="S$" style="text-align:right" readonly>
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
						<input type="text" class="form-control" name="type_a" id="type_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $unit_cost_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_unit_cost_a" id="other_unit_cost_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $no_items_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_item_a" id="other_item_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $oth_tot_val_lbl; ?></label>
						<input type="text" class="form-control" name="other_tot_val_a" id="other_tot_val_a" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $oth_item_tmt_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_tot_item_a" id="other_tot_item_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label><?php echo $oth_tmt_annum_lbl; ?></label>
						<input type="number" min="1" class="form-control" name="other_tmt_annum_a" id="other_tmt_annum_a" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label><?php echo $oth_tot_per_annum_lbl; ?></label>
						<input type="text" class="form-control" name="other_tot_annum_a" id="other_tot_annum_a" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="other_count_a" id="other_count_a" placeholder="" value="1">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="type_b" id="type_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_unit_cost_b" id="other_unit_cost_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_item_b" id="other_item_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="other_tot_val_b" id="other_tot_val_b" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_tot_item_b" id="other_tot_item_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="other_tmt_annum_b" id="other_tmt_annum_b" placeholder="" >
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="other_tot_annum_b" id="other_tot_annum_b" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" class="form-control" name="other_count_b" id="other_count_b" placeholder="" value="2">
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group" style="text-align:right;">
						<label><?php echo $other_total_lbl; ?></label><br>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="other_total_a" id="other_total_a" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="other_total_b" id="other_total_b" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group" style="text-align:right;">
						<label><?php echo $treatment_a_lbl; ?></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="treatment_a" id="treatment_a" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group" style="text-align:right;">
						<label><?php echo $treatment_b_lbl; ?></label><br>
				  </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="treatment_b" id="treatment_b" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label></label>
						<label></label>
				  </div>
				</div>
			</div>
			<div class="row">
			<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<label></label>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group" style="text-align:right;">
						<label></label>
						<label><?php echo $total_annual_cost_lbl; ?></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="text" class="form-control" name="total_annual_cost" id="total_annual_cost" placeholder="S$" style="text-align:right" readonly>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group" style="text-align:right;">
						<label></label>
						<label><?php echo $price_accept_lbl; ?><small><?php echo $execusive_lbl; ?></small></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="price_accept" id="price_accept" placeholder="S$" style="text-align:right" readonly>
							<div style="text-align:center;">
								<span id="percentage_result"style="color:red;" ></span>
							</div>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<div class="form-group">
						<label></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<label><?php echo $price_accept_lbl; ?><small><?php echo $tax_lbl; ?></small></label>
				  </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label></label>
						<input type="number" min="1" class="form-control" name="price_accept_tax" id="price_accept_tax" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" min="1" class="form-control" name="total_percentage" id="total_percentage" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" min="1" class="form-control" name="fix_percentage" id="fix_percentage" placeholder="S$" style="text-align:right" readonly>
						<input type="hidden" min="1" class="form-control" name="wfix_percentage" id="wfix_percentage" placeholder="S$" style="text-align:right" readonly>
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
						<textarea class="form-control" id="finance_note" name="finance_note" rows="3" placeholder="Enter ..."></textarea>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $service_note_lbl; ?></label><br>
						<textarea class="form-control" id="service_note" name="service_note" rows="3" placeholder="Enter ..."></textarea>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $billing_frequency_lbl; ?><span style="color:red">*</span></label><br>
						<select name="billing_frequency" id="billing_frequency" class="form-control" required>
							<option value="Annually">Annually</option>
							<option value="Bi Annually">Bi Annually</option>
							<option value="Monthly" selected="selected">Monthly</option>
							<option value="Bi-Monthly">Bi-Monthly</option>
							<option value="Quarterly">Quarterly</option>
							<option value="Job (Select Invoice Type)">Job (Select Invoice Type)</option>
							<!--<option value="Visit Trigger">Visit Trigger</option>
							<option value="Visit Trigger Monthly">Visit Trigger Monthly</option>
							<option value="One Time Invoice">One Time Invoice</option>
							<option value="Progressive Billing(ST)">Progressive Billing(ST)</option>-->
						</select>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $credit_term_lbl; ?></label><span style="color:red">*</span><br>
						<select name="credit_term" id="credit_term" class="form-control" required>
							<option value="15 Days">15 Days</option>
							<option value="30 Days" selected="selected">30 Days</option>
							<option value="45 Days">45 Days</option>
							<option value="60 Days">60 Days</option>
							<option value="90 Days">90 Days</option>
							<option value="120 Days">120 Days</option>
							<option value="Immediate Payment">Immediate Payment</option>
						</select>
				  </div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-3">
					<div class="form-group">
						<label><?php echo $invoice_type_lbl; ?></label><span style="color:red">*</span><br>
						<select name="invoice_type" id="invoice_type" class="form-control" required>
							<option value="">Please Choose Invoice Type</option>
							<option value="Advance (Normal)">Advance (Normal)</option>
							<option value="Visit Triggered">Visit Triggered</option>
							<option value="Visit Triggered Monthly">Visit Triggered Monthly</option>
							<option value="Visit Triggered Quarterly">Visit Triggered Quarterly</option>
							<option value="Progressive Billing (ST)">Progressive Billing (ST)</option>
						</select>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $invoice_attachment_lbl; ?></label><br>
						<select name="invoice_attachment" id="invoice_attachment" class="form-control">
							<option value="None">None</option>
							<option value="Service Docket (with Stamp)">Service Docket (with Stamp)</option>
							<option value="Service Docket">Service Docket</option>
							<option value="Others">Others</option>
						</select>
				  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $po_number_lbl; ?></label>
						<input type="text" class="form-control" name="po_number" id="po_number" placeholder="PO Number">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 1:</label>
					<input type="file" name="attachment_a" id="attachment_a" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 2:</label>
					<input type="file" name="attachment_b" id="attachment_b" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 3:</label>
					<input type="file" name="attachment_c" id="attachment_c" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 4:</label>
					<input type="file" name="attachment_d" id="attachment_d" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Attachment 5:</label>
					<input type="file" name="attachment_e" id="attachment_e" class="form-control">
					</div>
				</div>
			</div>
		</div>
			
          </div>
        </div>
		<div class="box-footer">
                <button type="submit" name="save" id="save" class="btn btn-success pull-center" ><?php echo $save_lbl; ?></button>
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
<!--<script src="../plugins/select2/select2.full.min.js"></script> -->
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
<!-- <script src="telephone/js/intlTelInput.js"></script> -->

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
		endDate: '+0d',
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
		$('#trial').on('click', function(){
			var chkArray = [];
			$(".trial:checked").each(function() {
				chkArray.push($(this).val());
			});
			if(chkArray == 'Yes') {
				$('#prospect_no').val('');
				$('#prospect_no').attr("readonly",true);
				$('#prospect_no').prop("required",false);
			} else {
				$('#prospect_no').attr("readonly",false);
				$('#prospect_no').prop("required",true);
			}
		});
		$("#preparation_a").change(function(){
		  var x = document.getElementById("preparation_a").value;
		  var qty_a = document.getElementById("qty_a").value;
		  var unit_per_tmt_a = document.getElementById("unit_per_tmt_a").value;
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
						var val_per_annum_a = (result.selling_price * unit_per_tmt_a * tmt_per_annum_a).toFixed(2);
						$('#val_per_annum_a').val(val_per_annum_a);
                        var val_per_annum_cost_a = (result.cost_price * unit_per_tmt_a * tmt_per_annum_a).toFixed(2);
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
					total_percentage();
				}
				
			});
	  });
	  $("#preparation_b").change(function(){
		  var x = document.getElementById("preparation_b").value;
		  var qty_b = document.getElementById("qty_b").value;
		  var unit_per_tmt_b = document.getElementById("unit_per_tmt_b").value;
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
						var val_per_annum_b = (result.selling_price * unit_per_tmt_b * tmt_per_annum_b).toFixed(2);
						$('#val_per_annum_b').val(val_per_annum_b);
                        var val_per_annum_cost_b = (result.cost_price * unit_per_tmt_b * tmt_per_annum_b).toFixed(2);
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
					total_percentage();
				}
			});
	  });
	  $("#preparation_c").change(function(){
		  var x = document.getElementById("preparation_c").value;
		  var qty_c = document.getElementById("qty_c").value;
		  var unit_per_tmt_c = document.getElementById("unit_per_tmt_c").value;
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
						var val_per_annum_c = (result.selling_price * unit_per_tmt_c * tmt_per_annum_c).toFixed(2);
						$('#val_per_annum_c').val(val_per_annum_c);
                        var val_per_annum_cost_c = (result.cost_price * unit_per_tmt_c * tmt_per_annum_c).toFixed(2);
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
					total_percentage();
				}
			});
	  });
	  $("#preparation_d").change(function(){
		  var x = document.getElementById("preparation_d").value;
		  var qty_d = document.getElementById("qty_d").value;
		  var unit_per_tmt_d = document.getElementById("unit_per_tmt_d").value;
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
						var val_per_annum_d = (result.selling_price * unit_per_tmt_d * tmt_per_annum_d).toFixed(2);
						$('#val_per_annum_d').val(val_per_annum_d);
                        var val_per_annum_cost_d = (result.cost_price * unit_per_tmt_d * tmt_per_annum_d).toFixed(2);
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
					total_percentage();
				}
			});
	  });
	  $("#preparation_e").change(function(){
		  var x = document.getElementById("preparation_e").value;
		  var qty_e = document.getElementById("qty_e").value;
		  var unit_per_tmt_e = document.getElementById("unit_per_tmt_e").value;
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
						var val_per_annum_e = (result.selling_price * unit_per_tmt_e * tmt_per_annum_e).toFixed(2);
						$('#val_per_annum_e').val(val_per_annum_e);
                        var val_per_annum_cost_e = (result.cost_price * unit_per_tmt_e * tmt_per_annum_e).toFixed(2);
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
					total_percentage();
				}
			});
	  });
	  $("#preparation_f").change(function(){
		  var x = document.getElementById("preparation_f").value;
		  var qty_f = document.getElementById("qty_f").value;
		  var unit_per_tmt_f = document.getElementById("unit_per_tmt_f").value;
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
						var val_per_annum_f = (result.selling_price * unit_per_tmt_f * tmt_per_annum_f).toFixed(2);
						$('#val_per_annum_f').val(val_per_annum_f);
                        var val_per_annum_cost_f = (result.cost_price * unit_per_tmt_f * tmt_per_annum_f).toFixed(2);
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
					total_percentage();
				}
			});
	  });
	  $("#preparation_g").change(function(){
		  var x = document.getElementById("preparation_g").value;
		  var qty_g = document.getElementById("qty_g").value;
		  var unit_per_tmt_g = document.getElementById("unit_per_tmt_g").value;
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
						var val_per_annum_g = (result.selling_price * unit_per_tmt_g * tmt_per_annum_g).toFixed(2);
						$('#val_per_annum_g').val(val_per_annum_g);
                        var val_per_annum_cost_g = (result.cost_price * unit_per_tmt_g * tmt_per_annum_g).toFixed(2);
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
					total_percentage();
				}
			});
	  });
	  $("#preparation_h").change(function(){
		  var x = document.getElementById("preparation_h").value;
		  var qty_h = document.getElementById("qty_h").value;
		  var unit_per_tmt_h = document.getElementById("unit_per_tmt_h").value;
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
						var val_per_annum_h = (result.selling_price * unit_per_tmt_h * tmt_per_annum_h).toFixed(2);
						$('#val_per_annum_h').val(val_per_annum_h);
                        var val_per_annum_cost_h = (result.cost_price * unit_per_tmt_h * tmt_per_annum_h).toFixed(2);
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
					total_percentage();
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
		$('#unit_per_tmt_a').val(qty_a);
		
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
		
		total_percentage();
	  });
	  $("#qty_b").blur(function(){
        var unit_cost_b = document.getElementById("unit_cost_b").value;
		var unit_selling_b = document.getElementById("unit_selling_b").value;
        var qty_b = document.getElementById("qty_b").value;
		var tot_val_unit_b = (unit_cost_b * qty_b).toFixed(2);
		var tot_val_cost_b = (unit_selling_b * qty_b).toFixed(2);
		$('#tot_val_unit_b').val(tot_val_unit_b);
		$('#tot_val_cost_b').val(tot_val_cost_b);
		$('#unit_per_tmt_b').val(qty_b);
		
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
		
		total_percentage();
	  });
	  $("#qty_c").blur(function(){
        var unit_cost_c = document.getElementById("unit_cost_c").value;
		var unit_selling_c = document.getElementById("unit_selling_c").value;
        var qty_c = document.getElementById("qty_c").value;
		var tot_val_unit_c = (unit_cost_c * qty_c).toFixed(2);
		var tot_val_cost_c = (unit_selling_c * qty_c).toFixed(2);
		$('#tot_val_unit_c').val(tot_val_unit_c);
		$('#tot_val_cost_c').val(tot_val_cost_c);
		$('#unit_per_tmt_c').val(qty_c);
		
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

		total_percentage();
	  });
	  $("#qty_d").blur(function(){
        var unit_cost_d = document.getElementById("unit_cost_d").value;
		var unit_selling_d = document.getElementById("unit_selling_d").value;
        var qty_d = document.getElementById("qty_d").value;
		var tot_val_unit_d = (unit_cost_d * qty_d).toFixed(2);
		var tot_val_cost_d = (unit_selling_d * qty_d).toFixed(2);
		$('#tot_val_unit_d').val(tot_val_unit_d);
		$('#tot_val_cost_d').val(tot_val_cost_d);
		$('#unit_per_tmt_d').val(qty_d);
		
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
		
		total_percentage();
	  });
	  $("#qty_e").blur(function(){
        var unit_cost_e = document.getElementById("unit_cost_e").value;
		var unit_selling_e = document.getElementById("unit_selling_e").value;
        var qty_e = document.getElementById("qty_e").value;
		var tot_val_unit_e = (unit_cost_e * qty_e).toFixed(2);
		var tot_val_cost_e = (unit_selling_e * qty_e).toFixed(2);
		$('#tot_val_unit_e').val(tot_val_unit_e);
		$('#tot_val_cost_e').val(tot_val_cost_e);
		$('#unit_per_tmt_e').val(qty_e);
		
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
		
		total_percentage();
	  });
	  $("#qty_f").blur(function(){
        var unit_cost_f = document.getElementById("unit_cost_f").value;
		var unit_selling_f = document.getElementById("unit_selling_f").value;
        var qty_f = document.getElementById("qty_f").value;
		var tot_val_unit_f = (unit_cost_f * qty_f).toFixed(2);
		var tot_val_cost_f = (unit_selling_f * qty_f).toFixed(2);
		$('#tot_val_unit_f').val(tot_val_unit_f);
		$('#tot_val_cost_f').val(tot_val_cost_f);
		$('#unit_per_tmt_f').val(qty_f);
		
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
		
		total_percentage();
	  });
	  $("#qty_g").blur(function(){
        var unit_cost_g = document.getElementById("unit_cost_g").value;
		var unit_selling_g = document.getElementById("unit_selling_g").value;
        var qty_g = document.getElementById("qty_g").value;
		var tot_val_unit_g = (unit_cost_g * qty_g).toFixed(2);
		var tot_val_cost_g = (unit_selling_g * qty_g).toFixed(2);
		$('#tot_val_unit_g').val(tot_val_unit_g);
		$('#tot_val_cost_g').val(tot_val_cost_g);
		$('#unit_per_tmt_g').val(qty_g);
		
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
		
		total_percentage();
	  });
	  $("#qty_h").blur(function(){
        var unit_cost_h = document.getElementById("unit_cost_h").value;
		var unit_selling_h = document.getElementById("unit_selling_h").value;
        var qty_h = document.getElementById("qty_h").value;
		var tot_val_unit_h = (unit_cost_h * qty_h).toFixed(2);
		var tot_val_cost_h = (unit_selling_h * qty_h).toFixed(2);
		$('#tot_val_unit_h').val(tot_val_unit_h);
		$('#tot_val_cost_h').val(tot_val_cost_h);
		$('#unit_per_tmt_h').val(qty_h);
		
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
		
		total_percentage();
	  });
	  $("#tmt_per_annum_a").blur(function(){
        var unit_cost_a = document.getElementById("unit_cost_a").value;
        var unit_selling_a = document.getElementById("unit_selling_a").value;
        var tmt_per_annum_a = document.getElementById("tmt_per_annum_a").value;
        var unit_per_tmt_a = document.getElementById("unit_per_tmt_a").value;
		var val_per_annum_a = (unit_cost_a * unit_per_tmt_a * tmt_per_annum_a).toFixed(2);
		var val_per_annum_cost_a = (unit_selling_a * unit_per_tmt_a * tmt_per_annum_a).toFixed(2);
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
        var unit_cost_b = document.getElementById("unit_cost_b").value;
        var unit_selling_b = document.getElementById("unit_selling_b").value;
        var tmt_per_annum_b = document.getElementById("tmt_per_annum_b").value;
		var unit_per_tmt_b = document.getElementById("unit_per_tmt_b").value;
		var val_per_annum_b = (unit_cost_b * unit_per_tmt_b * tmt_per_annum_b).toFixed(2);
		var val_per_annum_cost_b = (unit_selling_b * unit_per_tmt_b * tmt_per_annum_b).toFixed(2);
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
        var unit_cost_c = document.getElementById("unit_cost_c").value;
        var unit_selling_c = document.getElementById("unit_selling_c").value;
        var tmt_per_annum_c = document.getElementById("tmt_per_annum_c").value;
		var unit_per_tmt_c = document.getElementById("unit_per_tmt_c").value;
		var val_per_annum_c = (unit_cost_c * unit_per_tmt_c * tmt_per_annum_c).toFixed(2);
		var val_per_annum_cost_c = (unit_selling_c * unit_per_tmt_c * tmt_per_annum_c).toFixed(2);
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
        var unit_cost_d = document.getElementById("unit_cost_d").value;
        var unit_selling_d = document.getElementById("unit_selling_d").value;
        var tmt_per_annum_d = document.getElementById("tmt_per_annum_d").value;
		var unit_per_tmt_d = document.getElementById("unit_per_tmt_d").value;
		var val_per_annum_d = (unit_cost_d * unit_per_tmt_d * tmt_per_annum_d).toFixed(2);
		var val_per_annum_cost_d = (unit_selling_d * unit_per_tmt_d * tmt_per_annum_d).toFixed(2);
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
        var unit_cost_e = document.getElementById("unit_cost_e").value;
        var unit_selling_e = document.getElementById("unit_selling_e").value;
        var tmt_per_annum_e = document.getElementById("tmt_per_annum_e").value;
		var unit_per_tmt_e = document.getElementById("unit_per_tmt_e").value;
		var val_per_annum_e = (unit_cost_e * unit_per_tmt_e * tmt_per_annum_e).toFixed(2);
		var val_per_annum_cost_e = (unit_selling_e * unit_per_tmt_e * tmt_per_annum_e).toFixed(2);
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
        var unit_cost_f = document.getElementById("unit_cost_f").value;
        var unit_selling_f = document.getElementById("unit_selling_f").value;
        var tmt_per_annum_f = document.getElementById("tmt_per_annum_f").value;
		var unit_per_tmt_f = document.getElementById("unit_per_tmt_f").value;
		var val_per_annum_f = (unit_cost_f * unit_per_tmt_f * tmt_per_annum_f).toFixed(2);
		var val_per_annum_cost_f = (unit_selling_f * unit_per_tmt_f * tmt_per_annum_f).toFixed(2);
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
        var unit_cost_g = document.getElementById("unit_cost_g").value;
        var unit_selling_g = document.getElementById("unit_selling_g").value;
        var tmt_per_annum_g = document.getElementById("tmt_per_annum_g").value;
		var unit_per_tmt_g = document.getElementById("unit_per_tmt_g").value;
		var val_per_annum_g = (unit_cost_g * unit_per_tmt_g * tmt_per_annum_g).toFixed(2);
		var val_per_annum_cost_g = (unit_selling_g * unit_per_tmt_g * tmt_per_annum_g).toFixed(2);
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
        var unit_cost_h = document.getElementById("unit_cost_h").value;
        var unit_selling_h = document.getElementById("unit_selling_h").value;
        var tmt_per_annum_h = document.getElementById("tmt_per_annum_h").value;
		var unit_per_tmt_h = document.getElementById("unit_per_tmt_h").value;
		var val_per_annum_h = (unit_cost_h * unit_per_tmt_h * tmt_per_annum_h).toFixed(2);
		var val_per_annum_cost_h = (unit_selling_h * unit_per_tmt_h * tmt_per_annum_h).toFixed(2);
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
	  
	  $("#unit_per_tmt_a").blur(function(){
        var unit_cost_a = document.getElementById("unit_cost_a").value;
        var unit_selling_a = document.getElementById("unit_selling_a").value;
        var tmt_per_annum_a = document.getElementById("tmt_per_annum_a").value;
        var unit_per_tmt_a = document.getElementById("unit_per_tmt_a").value;
		var val_per_annum_a = (unit_cost_a * unit_per_tmt_a * tmt_per_annum_a).toFixed(2);
		var val_per_annum_cost_a = (unit_selling_a * unit_per_tmt_a * tmt_per_annum_a).toFixed(2);
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
	  
	  $("#unit_per_tmt_b").blur(function(){
        var unit_cost_b = document.getElementById("unit_cost_b").value;
        var unit_selling_b = document.getElementById("unit_selling_b").value;
        var tmt_per_annum_b = document.getElementById("tmt_per_annum_b").value;
		var unit_per_tmt_b = document.getElementById("unit_per_tmt_b").value;
		var val_per_annum_b = (unit_cost_b * unit_per_tmt_b * tmt_per_annum_b).toFixed(2);
		var val_per_annum_cost_b = (unit_selling_b * unit_per_tmt_b * tmt_per_annum_b).toFixed(2);
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
	  $("#unit_per_tmt_c").blur(function(){
        var unit_cost_c = document.getElementById("unit_cost_c").value;
        var unit_selling_c = document.getElementById("unit_selling_c").value;
        var tmt_per_annum_c = document.getElementById("tmt_per_annum_c").value;
		var unit_per_tmt_c = document.getElementById("unit_per_tmt_c").value;
		var val_per_annum_c = (unit_cost_c * unit_per_tmt_c * tmt_per_annum_c).toFixed(2);
		var val_per_annum_cost_c = (unit_selling_c * unit_per_tmt_c * tmt_per_annum_c).toFixed(2);
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
	  $("#unit_per_tmt_d").blur(function(){
        var unit_cost_d = document.getElementById("unit_cost_d").value;
        var unit_selling_d = document.getElementById("unit_selling_d").value;
        var tmt_per_annum_d = document.getElementById("tmt_per_annum_d").value;
		var unit_per_tmt_d = document.getElementById("unit_per_tmt_d").value;
		var val_per_annum_d = (unit_cost_d * unit_per_tmt_d * tmt_per_annum_d).toFixed(2);
		var val_per_annum_cost_d = (unit_selling_d * unit_per_tmt_d * tmt_per_annum_d).toFixed(2);
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
	  $("#unit_per_tmt_e").blur(function(){
        var unit_cost_e = document.getElementById("unit_cost_e").value;
        var unit_selling_e = document.getElementById("unit_selling_e").value;
        var tmt_per_annum_e = document.getElementById("tmt_per_annum_e").value;
		var unit_per_tmt_e = document.getElementById("unit_per_tmt_e").value;
		var val_per_annum_e = (unit_cost_e * unit_per_tmt_e * tmt_per_annum_e).toFixed(2);
		var val_per_annum_cost_e = (unit_selling_e * unit_per_tmt_e * tmt_per_annum_e).toFixed(2);
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
	  $("#unit_per_tmt_f").blur(function(){
        var unit_cost_f = document.getElementById("unit_cost_f").value;
        var unit_selling_f = document.getElementById("unit_selling_f").value;
        var tmt_per_annum_f = document.getElementById("tmt_per_annum_f").value;
		var unit_per_tmt_f = document.getElementById("unit_per_tmt_f").value;
		var val_per_annum_f = (unit_cost_f * unit_per_tmt_f * tmt_per_annum_f).toFixed(2);
		var val_per_annum_cost_f = (unit_selling_f * unit_per_tmt_f * tmt_per_annum_f).toFixed(2);
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
	   $("#unit_per_tmt_g").blur(function(){
        var unit_cost_g = document.getElementById("unit_cost_g").value;
        var unit_selling_g = document.getElementById("unit_selling_g").value;
        var tmt_per_annum_g = document.getElementById("tmt_per_annum_g").value;
		var unit_per_tmt_g = document.getElementById("unit_per_tmt_g").value;
		var val_per_annum_g = (unit_cost_g * unit_per_tmt_g * tmt_per_annum_g).toFixed(2);
		var val_per_annum_cost_g = (unit_selling_g * unit_per_tmt_g * tmt_per_annum_g).toFixed(2);
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
	  $("#unit_per_tmt_h").blur(function(){
        var unit_cost_h = document.getElementById("unit_cost_h").value;
        var unit_selling_h = document.getElementById("unit_selling_h").value;
        var tmt_per_annum_h = document.getElementById("tmt_per_annum_h").value;
		var unit_per_tmt_h = document.getElementById("unit_per_tmt_h").value;
		var val_per_annum_h = (unit_cost_h * unit_per_tmt_h * tmt_per_annum_h).toFixed(2);
		var val_per_annum_cost_h = (unit_selling_h * unit_per_tmt_h * tmt_per_annum_h).toFixed(2);
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
			var	total_hours_a = (per_hour_a * no_hours_a).toFixed(2);
			$('#total_hours_a').val(total_hours_a);
			
			var	fix_cost_total_hours_a = (fix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			
			var	wfix_cost_total_hours_a = (wfix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_a_split = tmt_hours_a.split(':'); 
			var tmt_hours_a_split_mm = (tmt_hours_a_split[1]/60).toFixed(2);
			tmt_hours_a = +tmt_hours_a_split[0] + +tmt_hours_a_split_mm;
			var tmt_annum_a = document.getElementById("tmt_annum_a").value;
			if (tmt_hours_a != '' && tmt_annum_a != '') {
				var labour_value_a = (per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(labour_value_a)) {
				var labour_value_a = '0.00';
				}
				$('#labour_value_a').val(labour_value_a);
				var	fix_cost_labour_value_a = (fix_cost_per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(fix_cost_labour_value_a)) {
				var fix_cost_labour_value_a = '0.00';
				}
			    $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
			    var	wfix_cost_labour_value_a = (wfix_cost_per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(wfix_cost_labour_value_a)) {
				var wfix_cost_labour_value_a = '0.00';
				}
			    $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
				  var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			var	total_hours_a = (per_hour_a * no_hours_a).toFixed(2);
			$('#total_hours_a').val(total_hours_a);
			
			var	fix_cost_total_hours_a = (fix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			
			var	wfix_cost_total_hours_a = (wfix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_a_split = tmt_hours_a.split(':'); 
			var tmt_hours_a_split_mm = (tmt_hours_a_split[1]/60).toFixed(2);
			tmt_hours_a = +tmt_hours_a_split[0] + +tmt_hours_a_split_mm;
			var tmt_annum_a = document.getElementById("tmt_annum_a").value;
			if (tmt_hours_a != '' && tmt_annum_a != '') {
				var labour_value_a = (per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(labour_value_a)) {
				var labour_value_a = '0.00';
				}
				$('#labour_value_a').val(labour_value_a);
				var	fix_cost_labour_value_a = (fix_cost_per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(fix_cost_labour_value_a)) {
				var fix_cost_labour_value_a = '0.00';
				}
			    $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
			    var	wfix_cost_labour_value_a = (wfix_cost_per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(wfix_cost_labour_value_a)) {
				var wfix_cost_labour_value_a = '0.00';
				}
			    $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			$('#total_hours_a').val('200.00');
			
			var per_hour_a = document.getElementById("per_hour_a").value;
			var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
			var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
			var no_hours_a = document.getElementById("no_hours_a").value;
			
			if (no_hours_a != '') {
			var	total_hours_a = (per_hour_a * no_hours_a).toFixed(2);
			if (total_hours_a > 200){
				$('#total_hours_a').val(total_hours_a);
			} else {
				$('#total_hours_a').val('200.00');
			}
			
			var	fix_cost_total_hours_a = (fix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			
			var	wfix_cost_total_hours_a = (wfix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_a_split = tmt_hours_a.split(':'); 
			var tmt_hours_a_split_mm = (tmt_hours_a_split[1]/60).toFixed(2);
			tmt_hours_a = +tmt_hours_a_split[0] + +tmt_hours_a_split_mm;
			var tmt_annum_a = document.getElementById("tmt_annum_a").value;
			if (tmt_hours_a != '' && tmt_annum_a != '') {
				var labour_value_a = (per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(labour_value_a)) {
				var labour_value_a = '0.00';
				}
				$('#labour_value_a').val(labour_value_a);
				var	fix_cost_labour_value_a = (fix_cost_per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(fix_cost_labour_value_a)) {
				var fix_cost_labour_value_a = '0.00';
				}
			    $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
			    var	wfix_cost_labour_value_a = (wfix_cost_per_hour_a * tmt_hours_a * tmt_annum_a).toFixed(2);
				if(isNaN(wfix_cost_labour_value_a)) {
				var wfix_cost_labour_value_a = '0.00';
				}
			    $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
		total_percentage();
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
			var	total_hours_b = (per_hour_b * no_hours_b).toFixed(2);
			$('#total_hours_b').val(total_hours_b);
			
			var	fix_cost_total_hours_b = (fix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			
			var	wfix_cost_total_hours_b = (wfix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_b_split = tmt_hours_b.split(':'); 
			var tmt_hours_b_split_mm = (tmt_hours_b_split[1]/60).toFixed(2);
			tmt_hours_b = +tmt_hours_b_split[0] + +tmt_hours_b_split_mm;
			var tmt_annum_b = document.getElementById("tmt_annum_b").value;
			if (tmt_hours_b != '' && tmt_annum_b != '') {
				var labour_value_b = (per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(labour_value_b)) {
					var labour_value_b = '0.00';
				}
				$('#labour_value_b').val(labour_value_b);
				var	fix_cost_labour_value_b = (fix_cost_per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(fix_cost_labour_value_b)) {
					var fix_cost_labour_value_b = '0.00';
				}
			    $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
			    var	wfix_cost_labour_value_b = (wfix_cost_per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(wfix_cost_labour_value_b)) {
					var wfix_cost_labour_value_b = '0.00';
				}
			    $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
				
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			var	total_hours_b = (per_hour_b * no_hours_b).toFixed(2);
			$('#total_hours_b').val(total_hours_b);
			
			var	fix_cost_total_hours_b = (fix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			
			var	wfix_cost_total_hours_b = (wfix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_b_split = tmt_hours_b.split(':'); 
			var tmt_hours_b_split_mm = (tmt_hours_b_split[1]/60).toFixed(2);
			tmt_hours_b = +tmt_hours_b_split[0] + +tmt_hours_b_split_mm;
			var tmt_annum_b = document.getElementById("tmt_annum_b").value;
			if (tmt_hours_b != '' && tmt_annum_b != '') {
				var labour_value_b = (per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(labour_value_b)) {
					var labour_value_b = '0.00';
				}
				$('#labour_value_b').val(labour_value_b);
				var	fix_cost_labour_value_b = (fix_cost_per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(fix_cost_labour_value_b)) {
					var fix_cost_labour_value_b = '0.00';
				}
			    $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
			    var	wfix_cost_labour_value_b = (wfix_cost_per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(wfix_cost_labour_value_b)) {
					var wfix_cost_labour_value_b = '0.00';
				}
			    $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
				
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			$('#total_hours_b').val('200.00');
			
			var per_hour_b = document.getElementById("per_hour_b").value;
			var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
			var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
			var no_hours_b = document.getElementById("no_hours_b").value;
			
			if (no_hours_b != '') {
			var	total_hours_b = (per_hour_b * no_hours_b).toFixed(2);
			if(total_hours_b >200) {
			    $('#total_hours_b').val(total_hours_b);
			} else {
				$('#total_hours_b').val('200.00');
			}
			
			var	fix_cost_total_hours_b = (fix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			
			var	wfix_cost_total_hours_b = (wfix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_b_split = tmt_hours_b.split(':'); 
			var tmt_hours_b_split_mm = (tmt_hours_b_split[1]/60).toFixed(2);
			tmt_hours_b = +tmt_hours_b_split[0] + +tmt_hours_b_split_mm;
			var tmt_annum_b = document.getElementById("tmt_annum_b").value;
			if (tmt_hours_b != '' && tmt_annum_b != '') {
				var labour_value_b = (per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(labour_value_b)) {
					var labour_value_b = '0.00';
				}
				$('#labour_value_b').val(labour_value_b);
				var	fix_cost_labour_value_b = (fix_cost_per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(fix_cost_labour_value_b)) {
					var fix_cost_labour_value_b = '0.00';
				}
			    $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
			    var	wfix_cost_labour_value_b = (wfix_cost_per_hour_b * tmt_hours_b * tmt_annum_b).toFixed(2);
				if(isNaN(wfix_cost_labour_value_b)) {
					var wfix_cost_labour_value_b = '0.00';
				}
			    $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
				
				var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
		total_percentage();		
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
			var	total_hours_c = (per_hour_c * no_hours_c).toFixed(2);
			$('#total_hours_c').val(total_hours_c);
			
			var	fix_cost_total_hours_c = (fix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			
			var	wfix_cost_total_hours_c = (wfix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_c_split = tmt_hours_c.split(':'); 
			var tmt_hours_c_split_mm = (tmt_hours_c_split[1]/60).toFixed(2);
			tmt_hours_c = +tmt_hours_c_split[0] + +tmt_hours_c_split_mm;
			var tmt_annum_c = document.getElementById("tmt_annum_c").value;
			if (tmt_hours_c != '' && tmt_annum_c != '') {
				var labour_value_c = (per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(labour_value_c)) {
					var labour_value_c = '0.00';
				}
				$('#labour_value_c').val(labour_value_c);
				var	fix_cost_labour_value_c = (fix_cost_per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(fix_cost_labour_value_c)) {
					var fix_cost_labour_value_c = '0.00';
				}
			    $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
			    var	wfix_cost_labour_value_c = (wfix_cost_per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(wfix_cost_labour_value_c)) {
					var wfix_cost_labour_value_c = '0.00';
				}
			    $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			var	total_hours_c = (per_hour_c * no_hours_c).toFixed(2);
			$('#total_hours_c').val(total_hours_c);
			
			var	fix_cost_total_hours_c = (fix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			
			var	wfix_cost_total_hours_c = (wfix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_c_split = tmt_hours_c.split(':'); 
			var tmt_hours_c_split_mm = (tmt_hours_c_split[1]/60).toFixed(2);
			tmt_hours_c = +tmt_hours_c_split[0] + +tmt_hours_c_split_mm;
			var tmt_annum_c = document.getElementById("tmt_annum_c").value;
			if (tmt_hours_c != '' && tmt_annum_c != '') {
				var labour_value_c = (per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(labour_value_c)) {
					var labour_value_c = '0.00';
				}
				$('#labour_value_c').val(labour_value_c);
				var	fix_cost_labour_value_c = (fix_cost_per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(fix_cost_labour_value_c)) {
					var fix_cost_labour_value_c = '0.00';
				}
			    $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
			    var	wfix_cost_labour_value_c = (wfix_cost_per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(wfix_cost_labour_value_c)) {
					var wfix_cost_labour_value_c = '0.00';
				}
			    $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			$('#total_hours_c').val('200.00');
			
			var per_hour_c = document.getElementById("per_hour_c").value;
			var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
			var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
			var no_hours_c = document.getElementById("no_hours_c").value;
			
			if (no_hours_c != '') {
			var	total_hours_c = (per_hour_c * no_hours_c).toFixed(2);
			if (total_hours_c > 200) {
				$('#total_hours_c').val(total_hours_c);
			} else {
				$('#total_hours_c').val('200.00');
			}
			
			var	fix_cost_total_hours_c = (fix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			
			var	wfix_cost_total_hours_c = (wfix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_c_split = tmt_hours_c.split(':'); 
			var tmt_hours_c_split_mm = (tmt_hours_c_split[1]/60).toFixed(2);
			tmt_hours_c = +tmt_hours_c_split[0] + +tmt_hours_c_split_mm;
			var tmt_annum_c = document.getElementById("tmt_annum_c").value;
			if (tmt_hours_c != '' && tmt_annum_c != '') {
				var labour_value_c = (per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(labour_value_c)) {
					var labour_value_c = '0.00';
				}
				$('#labour_value_c').val(labour_value_c);
				var	fix_cost_labour_value_c = (fix_cost_per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(fix_cost_labour_value_c)) {
					var fix_cost_labour_value_c = '0.00';
				}
			    $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
			    var	wfix_cost_labour_value_c = (wfix_cost_per_hour_c * tmt_hours_c * tmt_annum_c).toFixed(2);
				if(isNaN(wfix_cost_labour_value_c)) {
					var wfix_cost_labour_value_c = '0.00';
				}
			    $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
		total_percentage();
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
			var	total_hours_d = (per_hour_d * no_hours_d).toFixed(2);
			$('#total_hours_d').val(total_hours_d);
			
			var	fix_cost_total_hours_d = (fix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			
			var	wfix_cost_total_hours_d = (wfix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_d_split = tmt_hours_d.split(':'); 
			var tmt_hours_d_split_mm = (tmt_hours_d_split[1]/60).toFixed(2);
			tmt_hours_d = +tmt_hours_d_split[0] + +tmt_hours_d_split_mm;
			var tmt_annum_d = document.getElementById("tmt_annum_d").value;
			if (tmt_hours_d != '' && tmt_annum_d != '') {
				var labour_value_d = (per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(labour_value_d)) {
					var labour_value_d = '0.00';
				}
				$('#labour_value_d').val(labour_value_d);
				var	fix_cost_labour_value_d = (fix_cost_per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(fix_cost_labour_value_d)) {
					var fix_cost_labour_value_d = '0.00';
				}
			    $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
			    var	wfix_cost_labour_value_d = (wfix_cost_per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(wfix_cost_labour_value_d)) {
					var wfix_cost_labour_value_d = '0.00';
				}
			    $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			var	total_hours_d = (per_hour_d * no_hours_d).toFixed(2);
			$('#total_hours_d').val(total_hours_d);
			
			var	fix_cost_total_hours_d = (fix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			
			var	wfix_cost_total_hours_d = (wfix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_d_split = tmt_hours_d.split(':'); 
			var tmt_hours_d_split_mm = (tmt_hours_d_split[1]/60).toFixed(2);
			tmt_hours_d = +tmt_hours_d_split[0] + +tmt_hours_d_split_mm;
			var tmt_annum_d = document.getElementById("tmt_annum_d").value;
			if (tmt_hours_d != '' && tmt_annum_d != '') {
				var labour_value_d = (per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(labour_value_d)) {
					var labour_value_d = '0.00';
				}
				$('#labour_value_d').val(labour_value_d);
				var	fix_cost_labour_value_d = (fix_cost_per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(fix_cost_labour_value_d)) {
					var fix_cost_labour_value_d = '0.00';
				}
			    $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
			    var	wfix_cost_labour_value_d = (wfix_cost_per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(wfix_cost_labour_value_d)) {
					var wfix_cost_labour_value_d = '0.00';
				}
			    $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
			$('#total_hours_d').val('200.00');
			
			var per_hour_d = document.getElementById("per_hour_d").value;
			var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
			var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
			var no_hours_d = document.getElementById("no_hours_d").value;
			
			if (no_hours_d != '') {
			var	total_hours_d = (per_hour_d * no_hours_d).toFixed(2);
			if(total_hours_d > 200){
				$('#total_hours_d').val(total_hours_d);
			} else {
				$('#total_hours_d').val('200.00');
			}
			
			var	fix_cost_total_hours_d = (fix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			
			var	wfix_cost_total_hours_d = (wfix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
			
			var total_hours_a = document.getElementById("total_hours_a").value;
			var total_hours_b = document.getElementById("total_hours_b").value;
			var total_hours_c = document.getElementById("total_hours_c").value;
			var total_hours_d = document.getElementById("total_hours_d").value;
			var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
			$('#total_labour').val(total_labour);
			
			var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
			var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
			var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
			var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
			var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
			$('#fix_cost_total_labour').val(fix_cost_total_labour);
			
			var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
			var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
			var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
			var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
			var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var tmt_hours_d_split = tmt_hours_d.split(':'); 
			var tmt_hours_d_split_mm = (tmt_hours_d_split[1]/60).toFixed(2);
			tmt_hours_d = +tmt_hours_d_split[0] + +tmt_hours_d_split_mm;
			var tmt_annum_d = document.getElementById("tmt_annum_d").value;
			if (tmt_hours_d != '' && tmt_annum_d != '') {
				var labour_value_d = (per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(labour_value_d)) {
					var labour_value_d = '0.00';
				}
				$('#labour_value_d').val(labour_value_d);
				var	fix_cost_labour_value_d = (fix_cost_per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(fix_cost_labour_value_d)) {
					var fix_cost_labour_value_d = '0.00';
				}
			    $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
			    var	wfix_cost_labour_value_d = (wfix_cost_per_hour_d * tmt_hours_d * tmt_annum_d).toFixed(2);
				if(isNaN(wfix_cost_labour_value_d)) {
					var wfix_cost_labour_value_d = '0.00';
				}
			    $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
				
				 var labour_value_a = document.getElementById("labour_value_a").value;
				  var labour_value_b = document.getElementById("labour_value_b").value;
				  var labour_value_c = document.getElementById("labour_value_c").value;
				  var labour_value_d = document.getElementById("labour_value_d").value;
				  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
				  $('#total_labour_annum').val(total_labour_annum);
				  
				  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
				  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
				  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
				  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
				  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
				  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
				  
				  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
				  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
				  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
				  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
				  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
		total_percentage();
	  });
	  $("#no_hours_a").blur(function(){
        var shift_type_a = document.getElementById("shift_type_a").value;
        var per_hour_a = document.getElementById("per_hour_a").value;
        var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
        var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
        var no_hours_a = document.getElementById("no_hours_a").value;
		if (shift_type_a == 'Public Holiday/Sunday') {
			var total_hours_a = (per_hour_a * no_hours_a).toFixed(2);
			if (total_hours_a < 200) {
				total_hours_a = '200.00';
			}
			$('#total_hours_a').val(total_hours_a);
			var fix_cost_total_hours_a = (fix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			var wfix_cost_total_hours_a = (wfix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
		} else {
			var total_hours_a = (per_hour_a * no_hours_a).toFixed(2);
			$('#total_hours_a').val(total_hours_a);
			var fix_cost_total_hours_a = (fix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#fix_cost_total_hours_a').val(fix_cost_total_hours_a);
			var wfix_cost_total_hours_a = (wfix_cost_per_hour_a * no_hours_a).toFixed(2);
			$('#wfix_cost_total_hours_a').val(wfix_cost_total_hours_a);
		}
		
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var total_hours_b = (per_hour_b * no_hours_b).toFixed(2);
			if (total_hours_b < 200) {
				total_hours_b = '200.00';
			}
			$('#total_hours_b').val(total_hours_b);
			var fix_cost_total_hours_b = (fix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			var wfix_cost_total_hours_b = (wfix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
		} else {
			var total_hours_b = (per_hour_b * no_hours_b).toFixed(2);
			$('#total_hours_b').val(total_hours_b);
			var fix_cost_total_hours_b = (fix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#fix_cost_total_hours_b').val(fix_cost_total_hours_b);
			var wfix_cost_total_hours_b = (wfix_cost_per_hour_b * no_hours_b).toFixed(2);
			$('#wfix_cost_total_hours_b').val(wfix_cost_total_hours_b);
		}
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var total_hours_c = (per_hour_c * no_hours_c).toFixed(2);
			if (total_hours_c < 200) {
				total_hours_c = '200.00';
			}
			$('#total_hours_c').val(total_hours_c);
			var fix_cost_total_hours_c = (fix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			var wfix_cost_total_hours_c = (wfix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
		} else {
			var total_hours_c = (per_hour_c * no_hours_c).toFixed(2);
			$('#total_hours_c').val(total_hours_c);
			var fix_cost_total_hours_c = (fix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#fix_cost_total_hours_c').val(fix_cost_total_hours_c);
			var wfix_cost_total_hours_c = (wfix_cost_per_hour_c * no_hours_c).toFixed(2);
			$('#wfix_cost_total_hours_c').val(wfix_cost_total_hours_c);
		}
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
			var total_hours_d = (per_hour_d * no_hours_d).toFixed(2);
			if (total_hours_d < 200) {
				total_hours_d = '200.00';
			}
			$('#total_hours_d').val(total_hours_d);
			var fix_cost_total_hours_d = (fix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			var wfix_cost_total_hours_d = (wfix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
		} else {
			var total_hours_d = (per_hour_d * no_hours_d).toFixed(2);
			$('#total_hours_d').val(total_hours_d);
			var fix_cost_total_hours_d = (fix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#fix_cost_total_hours_d').val(fix_cost_total_hours_d);
			var wfix_cost_total_hours_d = (wfix_cost_per_hour_d * no_hours_d).toFixed(2);
			$('#wfix_cost_total_hours_d').val(wfix_cost_total_hours_d);
		}
		var total_hours_a = document.getElementById("total_hours_a").value;
		var total_hours_b = document.getElementById("total_hours_b").value;
		var total_hours_c = document.getElementById("total_hours_c").value;
		var total_hours_d = document.getElementById("total_hours_d").value;
		var total_labour = (Number(total_hours_a) + Number(total_hours_b) + Number(total_hours_c) + Number(total_hours_d)).toFixed(2);
		$('#total_labour').val(total_labour);
		
		var fix_cost_total_hours_a = document.getElementById("fix_cost_total_hours_a").value;
		var fix_cost_total_hours_b = document.getElementById("fix_cost_total_hours_b").value;
		var fix_cost_total_hours_c = document.getElementById("fix_cost_total_hours_c").value;
		var fix_cost_total_hours_d = document.getElementById("fix_cost_total_hours_d").value;
		var fix_cost_total_labour = (Number(fix_cost_total_hours_a) + Number(fix_cost_total_hours_b) + Number(fix_cost_total_hours_c) + Number(fix_cost_total_hours_d)).toFixed(2);
		$('#fix_cost_total_labour').val(fix_cost_total_labour);
		
		var wfix_cost_total_hours_a = document.getElementById("wfix_cost_total_hours_a").value;
		var wfix_cost_total_hours_b = document.getElementById("wfix_cost_total_hours_b").value;
		var wfix_cost_total_hours_c = document.getElementById("wfix_cost_total_hours_c").value;
		var wfix_cost_total_hours_d = document.getElementById("wfix_cost_total_hours_d").value;
		var wfix_cost_total_labour = (Number(wfix_cost_total_hours_a) + Number(wfix_cost_total_hours_b) + Number(wfix_cost_total_hours_c) + Number(wfix_cost_total_hours_d)).toFixed(2);
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
		  var tmt_hours_a_split = tmt_hours_a.split(':'); 
		  var tmt_hours_a_split_mm = (tmt_hours_a_split[1]/60).toFixed(2);
		  tmt_hours_a = +tmt_hours_a_split[0] + +tmt_hours_a_split_mm;
		  if (per_hour_a == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_a = (tmt_hours_a * tmt_annum_a * per_hour_a).toFixed(2);
		  if(isNaN(labour_value_a)) {
			var labour_value_a = '0.00';
		  }
		  $('#labour_value_a').val(labour_value_a);
		  
		  var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
		  var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
		  var fix_cost_labour_value_a = (tmt_hours_a * tmt_annum_a * fix_cost_per_hour_a).toFixed(2);
		  if(isNaN(fix_cost_labour_value_a)) {
			var fix_cost_labour_value_a = '0.00';
		  }
		  $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
		  var wfix_cost_labour_value_a = (tmt_hours_a * tmt_annum_a * wfix_cost_per_hour_a).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_a)) {
			var wfix_cost_labour_value_a = '0.00';
		  }
		  $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
		  var tmt_hours_b_split = tmt_hours_b.split(':'); 
		  var tmt_hours_b_split_mm = (tmt_hours_b_split[1]/60).toFixed(2);
		  tmt_hours_b = +tmt_hours_b_split[0] + +tmt_hours_b_split_mm;
		  if (per_hour_b == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_b = (tmt_hours_b * tmt_annum_b * per_hour_b).toFixed(2);
		  if(isNaN(labour_value_b)) {
			var labour_value_b = '0.00';
		  }
		  $('#labour_value_b').val(labour_value_b);
		  
		  var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
		  var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
		  var fix_cost_labour_value_b = (tmt_hours_b * tmt_annum_b * fix_cost_per_hour_b).toFixed(2);
		  if(isNaN(fix_cost_labour_value_b)) {
			var fix_cost_labour_value_b = '0.00';
		  }
		  $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
		  var wfix_cost_labour_value_b = (tmt_hours_b * tmt_annum_b * wfix_cost_per_hour_b).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_b)) {
			var wfix_cost_labour_value_b = '0.00';
		  }
		  $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
		  var tmt_hours_c_split = tmt_hours_c.split(':'); 
		  var tmt_hours_c_split_mm = (tmt_hours_c_split[1]/60).toFixed(2);
		  tmt_hours_c = +tmt_hours_c_split[0] + +tmt_hours_c_split_mm;
		  if (per_hour_c == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_c = (tmt_hours_c * tmt_annum_c * per_hour_c).toFixed(2);
		  if(isNaN(labour_value_c)) {
			var labour_value_c = '0.00';
		  }
		  $('#labour_value_c').val(labour_value_c);
		  
		  var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
		  var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
		  var fix_cost_labour_value_c = (tmt_hours_c * tmt_annum_c * fix_cost_per_hour_c).toFixed(2);
		  if(isNaN(fix_cost_labour_value_c)) {
			var fix_cost_labour_value_c = '0.00';
		  }
		  $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
		  var wfix_cost_labour_value_c = (tmt_hours_c * tmt_annum_c * wfix_cost_per_hour_c).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_c)) {
			var wfix_cost_labour_value_c = '0.00';
		  }
		  $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
		  var tmt_hours_d_split = tmt_hours_d.split(':'); 
		  var tmt_hours_d_split_mm = (tmt_hours_d_split[1]/60).toFixed(2);
		  tmt_hours_d = +tmt_hours_d_split[0] + +tmt_hours_d_split_mm;
		  if (per_hour_d == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_d = (tmt_hours_d * tmt_annum_d * per_hour_d).toFixed(2);
		  if(isNaN(labour_value_d)) {
			var labour_value_d = '0.00';
		  }
		  $('#labour_value_d').val(labour_value_d);
		  
		  var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
		  var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
		  var fix_cost_labour_value_d = (tmt_hours_d * tmt_annum_d * fix_cost_per_hour_d).toFixed(2);
		  if(isNaN(fix_cost_labour_value_d)) {
			var fix_cost_labour_value_d = '0.00';
		  }
		  $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
		  var wfix_cost_labour_value_d = (tmt_hours_d * tmt_annum_d * wfix_cost_per_hour_d).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_d)) {
			var wfix_cost_labour_value_d = '0.00';
		  }
		  $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	  $("#annual_value_a,#annual_value_b,#annual_value_c,#annual_value_d,#annual_value_e,#annual_value_f,#annual_value_g,#annual_value_h,#tmt_per_annum_a,#tmt_per_annum_b,#tmt_per_annum_c,#tmt_per_annum_d,#tmt_per_annum_e,#tmt_per_annum_f,#tmt_per_annum_g,#tmt_per_annum_h,#no_hours_a,#no_hours_b,#no_hours_c,#no_hours_d,#no_hours_e,#no_hours_f,#no_hours_g,#no_hours_h,#tmt_annum_a,#tmt_annum_b,#tmt_annum_c,#tmt_annum_d,#tmt_annum_e,#tmt_annum_f,#tmt_annum_g,#tmt_annum_h,#other_item_a,#other_item_b,#other_tmt_annum_a,#other_tmt_annum_b,#tmt_hours_a,#tmt_hours_b,#tmt_hours_c,#tmt_hours_d,#unit_per_tmt_a,#unit_per_tmt_b,#unit_per_tmt_c,#unit_per_tmt_d,#unit_per_tmt_e,#unit_per_tmt_f,#unit_per_tmt_g,#unit_per_tmt_h,#other_unit_cost_a,#other_unit_cost_b,#other_tot_item_a,#other_tot_item_b").blur(function(){
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
			  var fix_cost_value = Math.floor(((Number(price_accept) - Number(fix_cost_total)) / Number(price_accept)) * 100);
              var fix_per_res = 'Equivalent';
			  $('#fix_percentage').val(fix_cost_value);
			  $("#actual_gm_result").text(fix_per_res);
		  } else if (price_accept != fix_cost_total) {
			  var fix_cost_value = Math.floor(((Number(price_accept) - Number(fix_cost_total)) / Number(price_accept)) * 100);
			  if (fix_cost_value < 0) {
				  var fix_price_res = 'Negative';
				  var fix_profit =  'Less';
				  var fix_cost_value_res = Math.abs(fix_cost_value);
				  var fix_per_res = fix_price_res +' ' + '(' + fix_cost_value_res+'%' + ' ' + fix_profit + ')';
			  } else {
				  var fix_price_res = 'Positive';
				  var fix_profit =  'More';
				  var fix_cost_value_res = Math.abs(fix_cost_value);
				  var fix_per_res = fix_price_res +' ' + '(' + fix_cost_value_res+'%' + ' ' + fix_profit + ')';
			  }
			  $('#fix_percentage').val(fix_cost_value);
			  $("#actual_gm_result").text(fix_per_res);
		  }
		  
		  if (price_accept == wfix_cost_total) {
			  var wfix_cost_value = Math.floor(((Number(price_accept) - Number(wfix_cost_total)) / Number(price_accept)) * 100);
              var wfix_per_res = 'Equivalent';
			  $('#wfix_percentage').val(wfix_cost_value);
			  $("#gm_wo_result").text(wfix_per_res);
		  } else if (price_accept != wfix_cost_total) {
			  var wfix_cost_value = Math.floor(((Number(price_accept) - Number(wfix_cost_total)) / Number(price_accept)) * 100);
			  if (wfix_cost_value < 0) {
				  var wfix_price_res = 'Negative';
				  var wfix_profit =  'Less';
				  var wfix_cost_value_res = Math.abs(wfix_cost_value);
				  var wfix_per_res = wfix_price_res +' ' + '(' + wfix_cost_value_res+'%' + ' ' + wfix_profit + ')';
			  } else {
				  var wfix_price_res = 'Positive';
				  var wfix_profit =  'More';
				  var wfix_cost_value_res = Math.abs(wfix_cost_value);
				  var wfix_per_res = wfix_price_res +' ' + '(' + wfix_cost_value_res+'%' + ' ' + wfix_profit + ')';
			  }
			  $("#gm_wo_result").text(wfix_per_res);
			  $('#wfix_percentage').val(wfix_cost_value);
		  }
		  
		  if (price_accept == total_annual_cost) {
			  var percentage = Math.floor(((Number(price_accept) - Number(total_annual_cost)) / Number(price_accept)) * 100);
              var price_res = 'Equivalent';
			  $('#total_percentage').val(percentage);
			  $("#percentage_result").text(price_res);
		  } else if (price_accept != total_annual_cost) {
			  var percentage = Math.floor(((Number(price_accept) - Number(total_annual_cost)) / Number(price_accept)) * 100);
			  if (percentage < 0) {
				  var price_res = 'Negative';
				  var profit =  'Less';
				  var percentage_res = Math.abs(percentage);
				  var price_res = price_res +' ' + '(' + percentage_res+'%' + ' ' + profit + ')';
			  } else {
				  var price_res = 'Positive';
				  var profit =  'More';
				  var percentage_res = Math.abs(percentage);
				  var price_res = price_res +' ' + '(' + percentage_res+'%' + ' ' + profit + ')';
			  }
			  $('#total_percentage').val(percentage);
			  $("#percentage_result").text(price_res);
		  }
		  
		  var price_accept_tax = Number(((price_accept * 7) / 100)) + Number(price_accept);
		  $('#price_accept_tax').val(price_accept_tax);
		  
		  $("#actual_gm").hide();
	      $("#gm_wo").hide();
	  });
	  
	 function total_percentage(){
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
			  var fix_cost_value = Math.floor(((Number(price_accept) - Number(fix_cost_total)) / Number(price_accept)) * 100);
              var fix_per_res = 'Equivalent';
			  $("#actual_gm_result").text(fix_per_res);
			  $('#fix_percentage').val(fix_cost_value);
		  } else if (price_accept != fix_cost_total) {
			  var fix_cost_value = Math.floor(((Number(price_accept) - Number(fix_cost_total)) / Number(price_accept)) * 100);
			  if (fix_cost_value < 0) {
				  var fix_price_res = 'Negative';
				  var fix_profit =  'Less';
				  var fix_cost_value_res = Math.abs(fix_cost_value);
				  var fix_per_res = fix_price_res +' ' + '(' + fix_cost_value_res+'%' + ' ' + fix_profit + ')';
			  } else {
				  var fix_price_res = 'Positive';
				  var fix_profit =  'More';
				  var fix_cost_value_res = Math.abs(fix_cost_value);
				  var fix_per_res = fix_price_res +' ' + '(' + fix_cost_value_res+'%' + ' ' + fix_profit + ')';
			  }
			  $("#actual_gm_result").text(fix_per_res);
			  $('#fix_percentage').val(fix_cost_value);
		  }
		  
		  if (price_accept == wfix_cost_total) {
			  var wfix_cost_value = Math.floor(((Number(price_accept) - Number(wfix_cost_total)) / Number(price_accept)) * 100);
              var wfix_per_res = 'Equivalent';
			  $('#wfix_percentage').val(wfix_cost_value);
			  $("#gm_wo_result").text(wfix_per_res);
		  } else if (price_accept != wfix_cost_total) {
			  var wfix_cost_value = Math.floor(((Number(price_accept) - Number(wfix_cost_total)) / Number(price_accept)) * 100);
			  if (wfix_cost_value < 0) {
				  var wfix_price_res = 'Negative';
				  var wfix_profit =  'Less';
				  var wfix_cost_value_res = Math.abs(wfix_cost_value);
				  var wfix_per_res = wfix_price_res +' ' + '(' + wfix_cost_value_res+'%' + ' ' + wfix_profit + ')';
			  } else {
				  var wfix_price_res = 'Positive';
				  var wfix_profit =  'More';
				  var wfix_cost_value_res = Math.abs(wfix_cost_value);
				  var wfix_per_res = wfix_price_res +' ' + '(' + wfix_cost_value_res+'%' + ' ' + wfix_profit + ')';
			  }
			  $('#wfix_percentage').val(wfix_cost_value);
			  $("#gm_wo_result").text(wfix_per_res);
		  }
		  
		  if (price_accept == total_annual_cost) {
			  var percentage = Math.floor(((Number(price_accept) - Number(total_annual_cost)) / Number(price_accept)) * 100);
              var price_res = 'Equivalent';
			  $('#total_percentage').val(percentage);
			  $("#percentage_result").text(price_res);
		  } else if (price_accept != total_annual_cost) {
			  var percentage = Math.floor(((Number(price_accept) - Number(total_annual_cost)) / Number(price_accept)) * 100);
			  if (percentage < 0) {
				  var price_res = 'Negative';
				  var profit =  'Less';
				  var percentage_res = Math.abs(percentage);
				  var price_res = price_res +' ' + '(' + percentage_res+'%' + ' ' + profit + ')';
			  } else {
				  var price_res = 'Positive';
				  var profit =  'More';
				  var percentage_res = Math.abs(percentage);
				  var price_res = price_res +' ' + '(' + percentage_res+'%' + ' ' + profit + ')';
			  }
			  $('#total_percentage').val(percentage);
			  $("#percentage_result").text(price_res);
		  }
		  
		  var price_accept_tax = Number(((price_accept * 7) / 100)) + Number(price_accept);
		  $('#price_accept_tax').val(price_accept_tax);
		  
		  $("#actual_gm").hide();
	      $("#gm_wo").hide();
	  }
	  
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
			
			if (surveyor_id == 28 || surveyor_id == 35) {
				$("#amend").prop( "checked",true);
				$("#amend").prop( "disabled",true);
			} else {
				var job_type = document.getElementById("job_type").value;
				if (job_type == ''){
					$("#amend").prop( "checked",false);
				    $("#amend").prop( "disabled",false);
				}
				else if (job_type == 'Product Sales') {
					 $("#amend").prop( "checked",true);
					 $("#amend").prop( "disabled",true);
				 } else if (job_type == 'Job') {
					 $("#amend").prop( "checked",false);
					 $("#amend").prop( "disabled",true);
				 } else if (job_type == 'Contract'){
					 $("#amend").prop( "checked",false);
					 $("#amend").prop( "disabled",false);
				 }
				
			}
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
					$('#business_origin_code').val(result.business_detail_code);
			}
		}
		});
	  });
	  
	  $("#sra").blur(function(){
		  var sra = $("#sra").val();
		  if(sra == '') {
			$("#sra_status").html('<i class="fa fa-times-circle" style="font-size:20px;color:red"></i>');
			$('#sra_validation').val('2');
			return false;
		  } else {
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			data: {sra:sra},
			success: function(result) {
				if(result=="OK")	
			    {
				$("#sra_status").html('<i class="fa fa-check-circle" style="font-size:20px;color:green"></i>');
				$('#sra_validation').val('1');
				return true;	
			    }
			    else
			    {
				$("#sra_status").html('<i class="fa fa-times-circle" style="font-size:20px;color:red"></i>');
				$('#sra_validation').val('2');
				return false;	
			    }
			}
		});
		}
	  });
	  
	  $("#prospect_no").blur(function(){
			var prospect_no = $("#prospect_no").val();
			var chkArray = [];
			$(".trial:checked").each(function() {
				chkArray.push($(this).val());
			});
			if (chkArray == ''){
			if(prospect_no == '') {
				$("#prospect_no_status").html('<i class="fa fa-times-circle" style="font-size:20px;color:red"></i>');
				$('#prospect_no_validation').val('2');
				return false;
			} else {
		  $.ajax({
			type: "POST",
			url: "ajax.php",
			data: {prospect_no:prospect_no},
			success: function(result) {
				if(result=="OK")	
			    {
					$("#prospect_no_status").html('<i class="fa fa-check-circle" style="font-size:20px;color:green"></i>');
					$('#prospect_no_validation').val('1');
					return true;	
			    }
			    else
			    {
					$("#prospect_no_status").html('<i class="fa fa-times-circle" style="font-size:20px;color:red"></i>');
					$('#prospect_no_validation').val('2');
					return false;	
			    }
			}
		});
		}
	  }else {
		$("#prospect_no_status").html('');
		$('#prospect_no_validation').val('1');
	  }
	  });
	  
	  $("#tmt_hours_a").blur(function(){
		  var tmt_hours_a = document.getElementById("tmt_hours_a").value;
		  var tmt_annum_a = document.getElementById("tmt_annum_a").value;
		  var per_hour_a = document.getElementById("per_hour_a").value;
		  var tmt_hours_a_split = tmt_hours_a.split(':'); 
		  var tmt_hours_a_split_mm = (tmt_hours_a_split[1]/60).toFixed(2);
		  tmt_hours_a = +tmt_hours_a_split[0] + +tmt_hours_a_split_mm;
		  if (per_hour_a == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_a = (tmt_hours_a * tmt_annum_a * per_hour_a).toFixed(2);
		  if(isNaN(labour_value_a)) {
			var labour_value_a = '0.00';
		  }
		  $('#labour_value_a').val(labour_value_a);
		  
		  var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
		  var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
		  var fix_cost_labour_value_a = (tmt_hours_a * tmt_annum_a * fix_cost_per_hour_a).toFixed(2);
		  if(isNaN(fix_cost_labour_value_a)) {
			var fix_cost_labour_value_a = '0.00';
		  }
		  $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
		  var wfix_cost_labour_value_a = (tmt_hours_a * tmt_annum_a * wfix_cost_per_hour_a).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_a)) {
			var wfix_cost_labour_value_a = '0.00';
		  }
		  $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	  
	  $("#tmt_hours_b").blur(function(){
		  var tmt_hours_b = document.getElementById("tmt_hours_b").value;
		  var tmt_annum_b = document.getElementById("tmt_annum_b").value;
		  var per_hour_b = document.getElementById("per_hour_b").value;
		  var tmt_hours_b_split = tmt_hours_b.split(':'); 
		  var tmt_hours_b_split_mm = (tmt_hours_b_split[1]/60).toFixed(2);
		  tmt_hours_b = +tmt_hours_b_split[0] + +tmt_hours_b_split_mm;
		  if (per_hour_b == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_b = (tmt_hours_b * tmt_annum_b * per_hour_b).toFixed(2);
		  if(isNaN(labour_value_b)) {
			var labour_value_b = '0.00';
		  }
		  $('#labour_value_b').val(labour_value_b);
		  
		  var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
		  var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
		  var fix_cost_labour_value_b = (tmt_hours_b * tmt_annum_b * fix_cost_per_hour_b).toFixed(2);
		  if(isNaN(fix_cost_labour_value_b)) {
			var fix_cost_labour_value_b = '0.00';
		  }
		  $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
		  var wfix_cost_labour_value_b = (tmt_hours_b * tmt_annum_b * wfix_cost_per_hour_b).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_b)) {
			var wfix_cost_labour_value_b = '0.00';
		  }
		  $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	  
	  $("#tmt_hours_c").blur(function(){
		  var tmt_hours_c = document.getElementById("tmt_hours_c").value;
		  var tmt_annum_c = document.getElementById("tmt_annum_c").value;
		  var per_hour_c = document.getElementById("per_hour_c").value;
		  var tmt_hours_c_split = tmt_hours_c.split(':'); 
		  var tmt_hours_c_split_mm = (tmt_hours_c_split[1]/60).toFixed(2);
		  tmt_hours_c = +tmt_hours_c_split[0] + +tmt_hours_c_split_mm;
		  if (per_hour_c == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_c = (tmt_hours_c * tmt_annum_c * per_hour_c).toFixed(2);
		  if(isNaN(labour_value_c)) {
			var labour_value_c = '0.00';
		  }
		  $('#labour_value_c').val(labour_value_c);
		  
		  var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
		  var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
		  var fix_cost_labour_value_c = (tmt_hours_c * tmt_annum_c * fix_cost_per_hour_c).toFixed(2);
		  if(isNaN(fix_cost_labour_value_c)) {
			var fix_cost_labour_value_c = '0.00';
		  }
		  $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
		  var wfix_cost_labour_value_c = (tmt_hours_c * tmt_annum_c * wfix_cost_per_hour_c).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_c)) {
			var wfix_cost_labour_value_c = '0.00';
		  }
		  $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	  
	  $("#tmt_hours_d").blur(function(){
		  var tmt_hours_d = document.getElementById("tmt_hours_d").value;
		  var tmt_annum_d = document.getElementById("tmt_annum_d").value;
		  var per_hour_d = document.getElementById("per_hour_d").value;
		  var tmt_hours_d_split = tmt_hours_d.split(':'); 
		  var tmt_hours_d_split_mm = (tmt_hours_d_split[1]/60).toFixed(2);
		  tmt_hours_d = +tmt_hours_d_split[0] + +tmt_hours_d_split_mm;
		  if (per_hour_d == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_d = (tmt_hours_d * tmt_annum_d * per_hour_d).toFixed(2);
		  if(isNaN(labour_value_d)) {
			var labour_value_d = '0.00';
		  }
		  $('#labour_value_d').val(labour_value_d);
		  
		  var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
		  var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
		  var fix_cost_labour_value_d = (tmt_hours_d * tmt_annum_d * fix_cost_per_hour_d).toFixed(2);
		  if(isNaN(fix_cost_labour_value_d)) {
			var fix_cost_labour_value_d = '0.00';
		  }
		  $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
		  var wfix_cost_labour_value_d = (tmt_hours_d * tmt_annum_d * wfix_cost_per_hour_d).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_d)) {
			var wfix_cost_labour_value_d = '0.00';
		  }
		  $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	  
	  $("#job_type").change(function(){
	     var job_type = $(this).val();
		 var job_type_a = $(this).val();
		 if (job_type != "") {
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
		 }
		 
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
		 if (job_type == 'Job' || job_type == 'Product Sales'){
			$("#billing_frequency option[value='Job (Select Invoice Type)']").show();
			$("#billing_frequency option[value='Annually']").hide();
			$("#billing_frequency option[value='Bi Annually']").hide();
			$("#billing_frequency option[value='Monthly']").hide();
			$("#billing_frequency option[value='Bi-Monthly']").hide();
			$("#billing_frequency option[value='Quarterly']").hide();
			$("#billing_frequency option").each(function () {
				$(this).removeAttr("selected", "selected");
				if ($(this).html() == "Job (Select Invoice Type)") {
					$(this).attr("selected", "selected");
					return;
				}
			});
			//$('#billing_frequency').attr("disabled", true);
		 } else if (job_type == 'Contract'){
			$("#billing_frequency option[value='Job (Select Invoice Type)']").hide();
			$("#billing_frequency option[value='Annually']").show();
			$("#billing_frequency option[value='Bi Annually']").show();
			$("#billing_frequency option[value='Monthly']").show();
			$("#billing_frequency option[value='Bi-Monthly']").show();
			$("#billing_frequency option[value='Quarterly']").show();
			$("#billing_frequency option").each(function () {
				$(this).removeAttr("selected", "selected");
				if ($(this).html() == "Monthly") {
				$(this).attr("selected", "selected");
				return;
				}
			});
			//$('#billing_frequency').attr("disabled", false);
		 }
		 
		 var surveyor = document.getElementById("surveyor").value;
		 if (surveyor == 28 || surveyor == 35){
			$("#amend").prop( "checked",true);
			$("#amend").prop( "disabled",true);
		 } else {
			 if (job_type == 'Product Sales') {
				 $("#amend").prop( "checked",true);
				 $("#amend").prop( "disabled",true);
			 } else if (job_type == 'Job') {
				 $("#amend").prop( "checked",false);
				 $("#amend").prop( "disabled",true);
			 } else if (job_type == 'Contract'){
				 $("#amend").prop( "checked",false);
				 $("#amend").prop( "disabled",false);
			 }
		 }
	 });
	 
	 $("#pest_a").change(function(){
		 var pest_a = $(this).find("option:selected").text();
		 var visit_annum_a = $("#visit_annum_a option:selected").text();
		 pest_a = pest_a.slice(0, 5);
		 if (pest_a == 'PESTS' && visit_annum_a != 'Visit'){
			 $('#condition1').val(pest_a+' '+visit_annum_a);
		 } else {
			 $('#condition1').val('');
		 }	
		 condition();	 
	 });
	 $("#visit_annum_a").change(function(){
		 var visit_annum_a = $(this).find("option:selected").text();
		 var pest_a = $("#pest_a option:selected").text();
		 pest_a = pest_a.slice(0, 5);
		 if (pest_a == 'PESTS' && visit_annum_a != 'Visit'){
			 $('#condition1').val(pest_a+' '+visit_annum_a);
		 } else {
			 $('#condition1').val('');
		 }
		 condition();
	 });
	 $("#pest_b").change(function(){
		var pest_b = $(this).find("option:selected").text();
		var visit_annum_b = $("#visit_annum_b option:selected").text();
	    pest_b = pest_b.slice(0, 5);
		if (pest_b == 'PESTS' && visit_annum_b != 'Visit'){
			$('#condition2').val(pest_b+' '+visit_annum_b);
		} else {
			$('#condition2').val('');
		}
		condition(); 
	 });
	 $("#visit_annum_b").change(function(){
		 var visit_annum_b = $(this).find("option:selected").text();
		 var pest_b = $("#pest_b option:selected").text();
		 pest_b = pest_b.slice(0, 5);
		 if (pest_b == 'PESTS' && visit_annum_b != 'Visit'){
			 $('#condition2').val(pest_b+' '+visit_annum_b);
		 } else {
			 $('#condition2').val('');
		 }
         condition();
	 });
	 
	 $("#pest_c").change(function(){
		 var pest_c = $(this).find("option:selected").text();
		 var visit_annum_c = $("#visit_annum_c option:selected").text();
		 pest_c = pest_c.slice(0, 5);
		 if (pest_c == 'PESTS' && visit_annum_c != 'Visit'){
			 $('#condition3').val(pest_c+' '+visit_annum_c);
		 } else {
			 $('#condition3').val('');
		 }
         condition();		 
	 });
	 $("#visit_annum_c").change(function(){
		 var visit_annum_c = $(this).find("option:selected").text();
		 var pest_c = $("#pest_c option:selected").text();
		 pest_c = pest_c.slice(0, 5);
		 if (pest_c == 'PESTS' && visit_annum_c != 'Visit'){
			 $('#condition3').val(pest_c+' '+visit_annum_c);
		 } else {
			 $('#condition3').val('');
		 }
		 condition();
	 });
	 
	 $("#pest_d").change(function(){
		 var pest_d = $(this).find("option:selected").text();
		 var visit_annum_d = $("#visit_annum_d option:selected").text();
		 pest_d = pest_d.slice(0, 5);
		 if (pest_d == 'PESTS' && visit_annum_d != 'Visit'){
			 $('#condition4').val(pest_d+' '+visit_annum_d);
		 } else {
			 $('#condition4').val('');
		 }
         condition();		 
	 });
	 $("#visit_annum_d").change(function(){
		 var visit_annum_d = $(this).find("option:selected").text();
		 var pest_d = $("#pest_d option:selected").text();
		 pest_d = pest_d.slice(0, 5);
		 if (pest_d == 'PESTS' && visit_annum_d != 'Visit'){
			 $('#condition4').val(pest_d+' '+visit_annum_d);
		 } else {
			 $('#condition4').val('');
		 }
		 condition();
	 });
	 
	 $("#pest_e").change(function(){
		 var pest_e = $(this).find("option:selected").text();
		 var visit_annum_e = $("#visit_annum_e option:selected").text();
		 pest_e = pest_e.slice(0, 5);
		 if (pest_e == 'PESTS' && visit_annum_e != 'Visit'){
			 $('#condition5').val(pest_e+' '+visit_annum_e);
		 } else {
			 $('#condition5').val('');
		 }
         condition();		 
	 });
	 $("#visit_annum_e").change(function(){
		 var visit_annum_e = $(this).find("option:selected").text();
		 var pest_e = $("#pest_e option:selected").text();
		 pest_e = pest_e.slice(0, 5);
		 if (pest_e == 'PESTS' && visit_annum_e != 'Visit'){
			 $('#condition5').val(pest_e+' '+visit_annum_e);
		 } else {
			 $('#condition5').val('');
		 }
		 condition();
	 });
	 
	 $("#pest_f").change(function(){
		 var pest_f = $(this).find("option:selected").text();
		 var visit_annum_f = $("#visit_annum_f option:selected").text();
		 pest_f = pest_f.slice(0, 5);
		 if (pest_f == 'PESTS' && visit_annum_f != 'Visit'){
			 $('#condition6').val(pest_f+' '+visit_annum_f);
		 } else {
			 $('#condition6').val('');
		 }
         condition();		 
	 });
	 $("#visit_annum_f").change(function(){
		 var visit_annum_f = $(this).find("option:selected").text();
		 var pest_f = $("#pest_f option:selected").text();
		 pest_f = pest_f.slice(0, 5);
		 if (pest_f == 'PESTS' && visit_annum_f != 'Visit'){
			 $('#condition6').val(pest_f+' '+visit_annum_f);
		 } else {
			 $('#condition6').val('');
		 }
		 condition();
	 });
	 $("#pest_g").change(function(){
		 var pest_g = $(this).find("option:selected").text();
		 var visit_annum_g = $("#visit_annum_g option:selected").text();
		 pest_g = pest_g.slice(0, 5);
		 if (pest_g == 'PESTS' && visit_annum_g != 'Visit'){
			 $('#condition7').val(pest_g+' '+visit_annum_g);
		 } else {
			 $('#condition7').val('');
		 }
         condition();		 
	 });
	 $("#visit_annum_g").change(function(){
		 var visit_annum_g = $(this).find("option:selected").text();
		 var pest_g = $("#pest_g option:selected").text();
		 pest_g = pest_g.slice(0, 5);
		 if (pest_g == 'PESTS' && visit_annum_g != 'Visit'){
			 $('#condition7').val(pest_g+' '+visit_annum_g);
		 } else {
			 $('#condition7').val('');
		 }
		 condition();
	 });
	 $("#pest_h").change(function(){
		 var pest_h = $(this).find("option:selected").text();
		 var visit_annum_h = $("#visit_annum_h option:selected").text();
		 pest_h = pest_h.slice(0, 5);
		 if (pest_h == 'PESTS' && visit_annum_h != 'Visit'){
			 $('#condition8').val(pest_h+' '+visit_annum_h);
		 } else {
			 $('#condition8').val('');
		 }
         condition();		 
	 });
	 $("#visit_annum_h").change(function(){
		 var visit_annum_h = $(this).find("option:selected").text();
		 var pest_h = $("#pest_h option:selected").text();
		 pest_h = pest_h.slice(0, 5);
		 if (pest_h == 'PESTS' && visit_annum_h != 'Visit'){
			 $('#condition8').val(pest_h+' '+visit_annum_h);
		 } else {
			 $('#condition8').val('');
		 }
		 condition();
	 });
	 
	 $("#no_hours_a").blur(function(){
        var no_hours_a = document.getElementById("no_hours_a").value;
		//alert(no_hours_a);
		var decimalTimeString_a = no_hours_a;
		var decimalTime_a = parseFloat(decimalTimeString_a);
		decimalTime_a = decimalTime_a * 60 * 60;
		var hours_a = Math.floor((decimalTime_a / (60 * 60)));
		decimalTime_a = decimalTime_a - (hours_a * 60 * 60);
		var minutes_a = Math.floor((decimalTime_a / 60));
		decimalTime_a = decimalTime_a - (minutes_a * 60);
		var seconds_a = Math.round(decimalTime_a);
		if(hours_a < 10)
		{
			hours_a = "0" + hours_a;
		}
		if(minutes_a < 10)
		{
			minutes_a = "0" + minutes_a;
		}
		if(seconds_a < 10)
		{
			seconds_a = "0" + seconds_a;
		}
		tmt_hours_a = hours_a + ":" + minutes_a;
		$('#tmt_hours_a').val(tmt_hours_a);
		
		  var tmt_hours_a = document.getElementById("tmt_hours_a").value;
		  var tmt_annum_a = document.getElementById("tmt_annum_a").value;
		  var per_hour_a = document.getElementById("per_hour_a").value;
		  var tmt_hours_a_split = tmt_hours_a.split(':'); 
		  var tmt_hours_a_split_mm = (tmt_hours_a_split[1]/60).toFixed(2);
		  tmt_hours_a = +tmt_hours_a_split[0] + +tmt_hours_a_split_mm;
		  if (per_hour_a == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_a = (tmt_hours_a * tmt_annum_a * per_hour_a).toFixed(2);
		  if(isNaN(labour_value_a)) {
			var labour_value_a = '0.00';
		  }
		  $('#labour_value_a').val(labour_value_a);
		  
		  var fix_cost_per_hour_a = document.getElementById("fix_cost_per_hour_a").value;
		  var wfix_cost_per_hour_a = document.getElementById("wfix_cost_per_hour_a").value;
		  var fix_cost_labour_value_a = (tmt_hours_a * tmt_annum_a * fix_cost_per_hour_a).toFixed(2);
		  if(isNaN(fix_cost_labour_value_a)) {
			var fix_cost_labour_value_a = '0.00';
		  }
		  $('#fix_cost_labour_value_a').val(fix_cost_labour_value_a);
		  var wfix_cost_labour_value_a = (tmt_hours_a * tmt_annum_a * wfix_cost_per_hour_a).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_a)) {
			var wfix_cost_labour_value_a = '0.00';
		  }
		  $('#wfix_cost_labour_value_a').val(wfix_cost_labour_value_a);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	 $("#no_hours_b").blur(function(){
        var no_hours_b = document.getElementById("no_hours_b").value;
		//alert(no_hours_a);
		var decimalTimeString_b = no_hours_b;
		var decimalTime_b = parseFloat(decimalTimeString_b);
		decimalTime_b = decimalTime_b * 60 * 60;
		var hours_b = Math.floor((decimalTime_b / (60 * 60)));
		decimalTime_b = decimalTime_b - (hours_b * 60 * 60);
		var minutes_b = Math.floor((decimalTime_b / 60));
		decimalTime_b = decimalTime_b - (minutes_b * 60);
		var seconds_b = Math.round(decimalTime_b);
		if(hours_b < 10)
		{
			hours_b = "0" + hours_b;
		}
		if(minutes_b < 10)
		{
			minutes_b = "0" + minutes_b;
		}
		if(seconds_b < 10)
		{
			seconds_b = "0" + seconds_b;
		}
		tmt_hours_b = hours_b + ":" + minutes_b;
		$('#tmt_hours_b').val(tmt_hours_b);
		
		  var tmt_hours_b = document.getElementById("tmt_hours_b").value;
		  var tmt_annum_b = document.getElementById("tmt_annum_b").value;
		  var per_hour_b = document.getElementById("per_hour_b").value;
		  var tmt_hours_b_split = tmt_hours_b.split(':'); 
		  var tmt_hours_b_split_mm = (tmt_hours_b_split[1]/60).toFixed(2);
		  tmt_hours_b = +tmt_hours_b_split[0] + +tmt_hours_b_split_mm;
		  if (per_hour_b == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_b = (tmt_hours_b * tmt_annum_b * per_hour_b).toFixed(2);
		  if(isNaN(labour_value_b)) {
			var labour_value_b = '0.00';
		  }
		  $('#labour_value_b').val(labour_value_b);
		  
		  var fix_cost_per_hour_b = document.getElementById("fix_cost_per_hour_b").value;
		  var wfix_cost_per_hour_b = document.getElementById("wfix_cost_per_hour_b").value;
		  var fix_cost_labour_value_b = (tmt_hours_b * tmt_annum_b * fix_cost_per_hour_b).toFixed(2);
		  if(isNaN(fix_cost_labour_value_b)) {
			var fix_cost_labour_value_b = '0.00';
		  }
		  $('#fix_cost_labour_value_b').val(fix_cost_labour_value_b);
		  var wfix_cost_labour_value_b = (tmt_hours_b * tmt_annum_b * wfix_cost_per_hour_b).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_b)) {
			var wfix_cost_labour_value_b = '0.00';
		  }
		  $('#wfix_cost_labour_value_b').val(wfix_cost_labour_value_b);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	 $("#no_hours_c").blur(function(){
        var no_hours_c = document.getElementById("no_hours_c").value;
		//alert(no_hours_a);
		var decimalTimeString_c = no_hours_c;
		var decimalTime_c = parseFloat(decimalTimeString_c);
		decimalTime_c = decimalTime_c * 60 * 60;
		var hours_c = Math.floor((decimalTime_c / (60 * 60)));
		decimalTime_c = decimalTime_c - (hours_c * 60 * 60);
		var minutes_c = Math.floor((decimalTime_c / 60));
		decimalTime_c = decimalTime_c - (minutes_c * 60);
		var seconds_c = Math.round(decimalTime_c);
		if(hours_c < 10)
		{
			hours_c = "0" + hours_c;
		}
		if(minutes_c < 10)
		{
			minutes_c = "0" + minutes_c;
		}
		if(seconds_c < 10)
		{
			seconds_c = "0" + seconds_c;
		}
		tmt_hours_c = hours_c + ":" + minutes_c;
		$('#tmt_hours_c').val(tmt_hours_c);
		
		  var tmt_hours_c = document.getElementById("tmt_hours_c").value;
		  var tmt_annum_c = document.getElementById("tmt_annum_c").value;
		  var per_hour_c = document.getElementById("per_hour_c").value;
		  var tmt_hours_c_split = tmt_hours_c.split(':'); 
		  var tmt_hours_c_split_mm = (tmt_hours_c_split[1]/60).toFixed(2);
		  tmt_hours_c = +tmt_hours_c_split[0] + +tmt_hours_c_split_mm;
		  if (per_hour_c == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_c = (tmt_hours_c * tmt_annum_c * per_hour_c).toFixed(2);
		  if(isNaN(labour_value_c)) {
			var labour_value_c = '0.00';
		  }
		  $('#labour_value_c').val(labour_value_c);
		  
		  var fix_cost_per_hour_c = document.getElementById("fix_cost_per_hour_c").value;
		  var wfix_cost_per_hour_c = document.getElementById("wfix_cost_per_hour_c").value;
		  var fix_cost_labour_value_c = (tmt_hours_c * tmt_annum_c * fix_cost_per_hour_c).toFixed(2);
		  if(isNaN(fix_cost_labour_value_c)) {
			var fix_cost_labour_value_c = '0.00';
		  }
		  $('#fix_cost_labour_value_c').val(fix_cost_labour_value_c);
		  var wfix_cost_labour_value_c = (tmt_hours_c * tmt_annum_c * wfix_cost_per_hour_c).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_c)) {
			var wfix_cost_labour_value_c = '0.00';
		  }
		  $('#wfix_cost_labour_value_c').val(wfix_cost_labour_value_c);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
	 $("#no_hours_d").blur(function(){
        var no_hours_d = document.getElementById("no_hours_d").value;
		//alert(no_hours_a);
		var decimalTimeString_d = no_hours_d;
		var decimalTime_d = parseFloat(decimalTimeString_d);
		decimalTime_d = decimalTime_d * 60 * 60;
		var hours_d = Math.floor((decimalTime_d / (60 * 60)));
		decimalTime_d = decimalTime_d - (hours_d * 60 * 60);
		var minutes_d = Math.floor((decimalTime_d / 60));
		decimalTime_d = decimalTime_d - (minutes_d * 60);
		var seconds_d = Math.round(decimalTime_d);
		if(hours_d < 10)
		{
			hours_d = "0" + hours_d;
		}
		if(minutes_d < 10)
		{
			minutes_d = "0" + minutes_d;
		}
		if(seconds_d < 10)
		{
			seconds_d = "0" + seconds_d;
		}
		tmt_hours_d = hours_d + ":" + minutes_d;
		$('#tmt_hours_d').val(tmt_hours_d);
		
		  var tmt_hours_d = document.getElementById("tmt_hours_d").value;
		  var tmt_annum_d = document.getElementById("tmt_annum_d").value;
		  var per_hour_d = document.getElementById("per_hour_d").value;
		  var tmt_hours_d_split = tmt_hours_d.split(':'); 
		  var tmt_hours_d_split_mm = (tmt_hours_d_split[1]/60).toFixed(2);
		  tmt_hours_d = +tmt_hours_d_split[0] + +tmt_hours_d_split_mm;
		  if (per_hour_d == ''){
			  alert('Please Choose Shift Type'); 
			  return false;
		  }
		  var labour_value_d = (tmt_hours_d * tmt_annum_d * per_hour_d).toFixed(2);
		  if(isNaN(labour_value_d)) {
			var labour_value_d = '0.00';
		  }
		  $('#labour_value_d').val(labour_value_d);
		  
		  var fix_cost_per_hour_d = document.getElementById("fix_cost_per_hour_d").value;
		  var wfix_cost_per_hour_d = document.getElementById("wfix_cost_per_hour_d").value;
		  var fix_cost_labour_value_d = (tmt_hours_d * tmt_annum_d * fix_cost_per_hour_d).toFixed(2);
		  if(isNaN(fix_cost_labour_value_d)) {
			var fix_cost_labour_value_d = '0.00';
		  }
		  $('#fix_cost_labour_value_d').val(fix_cost_labour_value_d);
		  var wfix_cost_labour_value_d = (tmt_hours_d * tmt_annum_d * wfix_cost_per_hour_d).toFixed(2);
		  if(isNaN(wfix_cost_labour_value_d)) {
			var wfix_cost_labour_value_d = '0.00';
		  }
		  $('#wfix_cost_labour_value_d').val(wfix_cost_labour_value_d);
		  
		  var labour_value_a = document.getElementById("labour_value_a").value;
		  var labour_value_b = document.getElementById("labour_value_b").value;
		  var labour_value_c = document.getElementById("labour_value_c").value;
		  var labour_value_d = document.getElementById("labour_value_d").value;
		  var total_labour_annum = (Number(labour_value_a) + Number(labour_value_b) + Number(labour_value_c) + Number(labour_value_d)).toFixed(2);
		  $('#total_labour_annum').val(total_labour_annum);
		  
		  var fix_cost_labour_value_a = document.getElementById("fix_cost_labour_value_a").value;
		  var fix_cost_labour_value_b = document.getElementById("fix_cost_labour_value_b").value;
		  var fix_cost_labour_value_c = document.getElementById("fix_cost_labour_value_c").value;
		  var fix_cost_labour_value_d = document.getElementById("fix_cost_labour_value_d").value;
		  var fix_cost_total_labour_annum = (Number(fix_cost_labour_value_a) + Number(fix_cost_labour_value_b) + Number(fix_cost_labour_value_c) + Number(fix_cost_labour_value_d)).toFixed(2);
		  $('#fix_cost_total_labour_annum').val(fix_cost_total_labour_annum);
		  
		  var wfix_cost_labour_value_a = document.getElementById("wfix_cost_labour_value_a").value;
		  var wfix_cost_labour_value_b = document.getElementById("wfix_cost_labour_value_b").value;
		  var wfix_cost_labour_value_c = document.getElementById("wfix_cost_labour_value_c").value;
		  var wfix_cost_labour_value_d = document.getElementById("wfix_cost_labour_value_d").value;
		  var wfix_cost_total_labour_annum = (Number(wfix_cost_labour_value_a) + Number(wfix_cost_labour_value_b) + Number(wfix_cost_labour_value_c) + Number(wfix_cost_labour_value_d)).toFixed(2);
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
  });
  
  function maxLengthCheck(object) {
		if (object.value.length > object.maxLength)
		object.value = object.value.slice(0, object.maxLength)
  }
    
  function isNumeric (evt) {
		var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode (key);
		var regex = /[0-9]|\./;
		if ( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
  }
	function validateForm() {
		var x = document.forms["addview"]["sra_validation"].value;
		if (x == 2) {
			alert("SRA Number Already Exists!!!");
			document.getElementById("sra").focus();
			return false;
		}
		
		var y = document.forms["addview"]["prospect_no_validation"].value;
		if (y == 2) {
			alert("Prospect Number Already Exists!!!");
			document.getElementById("prospect_no").focus();
			return false;
		}
		
		var tel_a = document.forms["addview"]["tel_a"].value;
		var tel_b = document.forms["addview"]["tel_b"].value;
		var regex_a = /^[0-9]{8}$/;
		if(regex_a.test(tel_a) == false){
			alert("The lenght of Billing Telephone should be eight digits");
			document.getElementById("tel_a").focus();
			return false;
		}
		if(regex_a.test(tel_b) == false){
			alert("The lenght of Premise Telephone should be eight digits");
			document.getElementById("tel_b").focus();
			return false;
		}
		
		var surveyor_code = document.forms["addview"]["surveyor_code"].value; 
		var business_code = document.forms["addview"]["business_code"].value; 
		var industry_code = document.forms["addview"]["industry_code"].value;
		if (surveyor_code == '') {
			alert("Please re-select Surveyor Name");
			document.getElementById("surveyor").focus();
			return false;
		}
		if (business_code == '') {
			alert("Please re-select Business Origin");
			document.getElementById("business_origin").focus();
			return false;
		}
		if (industry_code == '') {
			alert("Please re-select Industry");
			document.getElementById("industry").focus();
			return false;
		}
		var pest_a = document.forms["addview"]["pest_a"].value; 
		var pest_b = document.forms["addview"]["pest_b"].value;
		var pest_c = document.forms["addview"]["pest_c"].value;
		var pest_d = document.forms["addview"]["pest_d"].value;
		var pest_e = document.forms["addview"]["pest_e"].value;
		var pest_f = document.forms["addview"]["pest_f"].value;
		var pest_g = document.forms["addview"]["pest_g"].value;
		var pest_h = document.forms["addview"]["pest_h"].value;
		if (pest_a != '') {
			var visit_annum_a = document.forms["addview"]["visit_annum_a"].value;
			if(visit_annum_a == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_a").focus();
				return false;
			}
		}
		if (pest_b != '') {
			var visit_annum_b = document.forms["addview"]["visit_annum_b"].value;
			if(visit_annum_b == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_b").focus();
				return false;
			}
		}
		if (pest_c != '') {
			var visit_annum_c = document.forms["addview"]["visit_annum_c"].value;
			if(visit_annum_c == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_c").focus();
				return false;
			}
		}
		if (pest_d != '') {
			var visit_annum_d = document.forms["addview"]["visit_annum_d"].value;
			if(visit_annum_d == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_d").focus();
				return false;
			}
		}
		if (pest_e != '') {
			var visit_annum_e = document.forms["addview"]["visit_annum_e"].value;
			if(visit_annum_e == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_e").focus();
				return false;
			}
		}
		if (pest_f != '') {
			var visit_annum_f = document.forms["addview"]["visit_annum_f"].value;
			if(visit_annum_f == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_f").focus();
				return false;
			}
		}
		if (pest_g != '') {
			var visit_annum_g = document.forms["addview"]["visit_annum_g"].value;
			if(visit_annum_g == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_g").focus();
				return false;
			}
		}
		if (pest_h != '') {
			var visit_annum_h = document.forms["addview"]["visit_annum_h"].value;
			if(visit_annum_h == ''){
				alert("Please Choose Visit Frequency Per Annum!!!");
				document.getElementById("visit_annum_h").focus();
				return false;
			}
		}
		var job_type = document.forms["addview"]["job_type"].value;
		var job_duration = document.forms["addview"]["job_duration"].value;
		if(job_type =='Job' && job_duration == ''){
			alert("Please Choose Job Duration !!!");
				document.getElementById("job_duration").focus();
				return false;
		}
		var total_annual_cost = document.forms["addview"]["total_annual_cost"].value;
		if (total_annual_cost == '' || total_annual_cost == 0 || total_annual_cost == 'NaN') {
			alert("Total Cost cannot be zero!!!");
			document.getElementById("total_annual_cost").focus();
			return false;
		}
		
		document.getElementById("submit").style.display = "none";
		document.getElementById("submit_processing").style.display="";
		document.getElementById("save").style.display = "none";
		document.getElementById("save_processing").style.display="";
		return true;
	}
	function condition() {
		var i;
		var condition_a =  '';
		var condition_b = '';
		var condition_value = '';
		var conditionArray=[];
		var index;
		conditionArray = [];
	    for (i = 1; i < 9; i++) {
			condition_a = $('#condition'+i).val();
			if (condition_a != '') {
				for (j = i+1; j<9; j++) {
				condition_b = $('#condition'+j).val();
					if (condition_b != '') {
						//alert (condition_a+ '--'+condition_b);
						if (condition_a == condition_b){
							conditionArray.push(j);
						}
					}					
				}
			}
			
		 } 
		 var uniqueCondition = [];
		$.each(conditionArray, function(i, el){
			if($.inArray(el, uniqueCondition) === -1) uniqueCondition.push(el);
		});
		 var conditioncheck =  [1,2,3,4,5,6,7,8];
		 for (var k=0; k<uniqueCondition.length; k++) {
			index = conditioncheck.indexOf(uniqueCondition[k]);
			if (index > -1) {
				conditioncheck.splice(index, 1);
			}
		}
		for (var l=0; l<uniqueCondition.length; l++){
			if (uniqueCondition[l] == 1) {
				$('#annual_value_a').attr('readonly', true);
				$('#condition_ref1').val('1');
				$('#annual_value_a').val('');
			}
			if (uniqueCondition[l] == 2) {
				$('#annual_value_b').attr('readonly', true);
				$('#condition_ref2').val('1');
				$('#annual_value_b').val('');
			}
			if (uniqueCondition[l] == 3) {
				$('#annual_value_c').attr('readonly', true);
				$('#condition_ref3').val('1');
				$('#annual_value_c').val('');
			}
			if (uniqueCondition[l] == 4) {
				$('#annual_value_d').attr('readonly', true);
				$('#condition_ref4').val('1');
				$('#annual_value_d').val('');
			}
			if (uniqueCondition[l] == 5) {
				$('#annual_value_e').attr('readonly', true);
				$('#condition_ref5').val('1');
				$('#annual_value_e').val('');
			}
			if (uniqueCondition[l] == 6) {
				$('#annual_value_f').attr('readonly', true);
				$('#condition_ref6').val('1');
				$('#annual_value_f').val('');
			}
			if (uniqueCondition[l] == 7) {
				$('#annual_value_g').attr('readonly', true);
				$('#condition_ref7').val('1');
				$('#annual_value_g').val('');
			}
			if (uniqueCondition[l] == 8) {
				$('#annual_value_h').attr('readonly', true);
				$('#condition_ref8').val('1');
				$('#annual_value_h').val('');
			}
		}
		for (var m=0; m<conditioncheck.length; m++){
			if (conditioncheck[m] == 1) {
				$('#annual_value_a').attr('readonly', false);
				$('#condition_ref1').val('0');
				var pest_a = $('#pest_a').val();
				var condition_ref1 = $('#condition_ref1').val();
				if (pest_a != '' && condition_ref1 == 0) {
					$("#annual_value_a").prop('required',true);
				} else if (pest_a == '' && condition_ref1 == 0) {
					$("#annual_value_a").prop('required',false);
				}
			}
			if (conditioncheck[m] == 2) {
				$('#annual_value_b').attr('readonly', false);
				$('#condition_ref2').val('0');
				var pest_b = $('#pest_b').val();
				var condition_ref2 = $('#condition_ref2').val();
				if (pest_b != '' && condition_ref2 == 0) {
					$("#annual_value_b").prop('required',true);
				} else if (pest_b == '' && condition_ref2 == 0) {
					$("#annual_value_b").prop('required',false);
				}
			}
			if (conditioncheck[m] == 3) {
				$('#annual_value_c').attr('readonly', false);
				$('#condition_ref3').val('0');
				var pest_c = $('#pest_c').val();
				var condition_ref3 = $('#condition_ref3').val();
				if (pest_c != '' && condition_ref3 == 0) {
					$("#annual_value_c").prop('required',true);
				} else if (pest_c == '' && condition_ref3 == 0) {
					$("#annual_value_c").prop('required',false);
				}
			}
			if (conditioncheck[m] == 4) {
				$('#annual_value_d').attr('readonly', false);
				$('#condition_ref4').val('0');
				var pest_d = $('#pest_d').val();
				var condition_ref4 = $('#condition_ref4').val();
				if (pest_d != '' && condition_ref4 == 0) {
					$("#annual_value_d").prop('required',true);
				} else if (pest_d == '' && condition_ref4 == 0) {
					$("#annual_value_d").prop('required',false);
				}
			}
			if (conditioncheck[m] == 5) {
				$('#annual_value_e').attr('readonly', false);
				$('#condition_ref5').val('0');
				var pest_e = $('#pest_e').val();
				var condition_ref5 = $('#condition_ref5').val();
				if (pest_e != '' && condition_ref5 == 0) {
					$("#annual_value_e").prop('required',true);
				} else if (pest_e == '' && condition_ref5 == 0) {
					$("#annual_value_e").prop('required',false);
				}
			}
			if (conditioncheck[m] == 6) {
				$('#annual_value_f').attr('readonly', false);
				$('#condition_ref6').val('0');
				var pest_f = $('#pest_f').val();
				var condition_ref6 = $('#condition_ref6').val();
				if (pest_f != '' && condition_ref6 == 0) {
					$("#annual_value_f").prop('required',true);
				} else if (pest_f == '' && condition_ref6 == 0) {
					$("#annual_value_f").prop('required',false);
				}
			}
			if (conditioncheck[m] == 7) {
				$('#annual_value_g').attr('readonly', false);
				$('#condition_ref7').val('0');
				var pest_g = $('#pest_g').val();
				var condition_ref7 = $('#condition_ref7').val();
				if (pest_g != '' && condition_ref7 == 0) {
					$("#annual_value_g").prop('required',true);
				} else if (pest_g == '' && condition_ref7 == 0) {
					$("#annual_value_g").prop('required',false);
				}
			}
			if (conditioncheck[m] == 8) {
				$('#annual_value_h').attr('readonly', false);
				$('#condition_ref8').val('0');
				var pest_h = $('#pest_h').val();
				var condition_ref8 = $('#condition_ref8').val();
				if (pest_h != '' && condition_ref8 == 0) {
					$("#annual_value_h").prop('required',true);
				} else if (pest_h == '' && condition_ref8 == 0) {
					$("#annual_value_h").prop('required',false);
				}
			}
		}
		
		var annual_value_a = $('#annual_value_a').val();
		var annual_value_b = $('#annual_value_b').val();
		var annual_value_c = $('#annual_value_c').val();
		var annual_value_d = $('#annual_value_d').val();
		var annual_value_e = $('#annual_value_e').val();
		var annual_value_f = $('#annual_value_f').val();
		var annual_value_g = $('#annual_value_g').val();
		var annual_value_h = $('#annual_value_h').val();
		var price_accept = Number(annual_value_a) + Number(annual_value_b) + Number(annual_value_c) + Number(annual_value_d) + Number(annual_value_e) + Number(annual_value_f) + Number(annual_value_g) + Number(annual_value_h);
		var price_accept_tax = Number(price_accept) + (((Number(price_accept)*7))/100);
		 $('#price_accept').val(price_accept);
		 $('#price_accept_tax').val(price_accept_tax);
		//console.log(conditioncheck);
		//console.log(uniqueCondition);
	}
	
$("#name").on('keyup', function(e) {
    var val = $(this).val();
   if (val.match(/[^a-zA-Z\s]/g)) {
       $(this).val(val.replace(/[^a-zA-Z\s]/g, ''));
   }
});

	
/* var tel_a = document.querySelector("#tel_a"),
errorMsga = document.querySelector("#error-msg-a"),
validMsga = document.querySelector("#valid-msg-a");
var errorMapa = [ "X", "Invalid country code", "Too short", "Too long", "Invalid number"];

var intl = window.intlTelInput(tel_a, {
    utilsScript: "telephone/js/utils.js"
});

var reset_a = function() {
    tel_a.classList.remove("error");
    errorMsga.innerHTML = "";
    errorMsga.classList.add("hide");
    validMsga.classList.add("hide");
};

tel_a.addEventListener('blur', function() {
    reset_a();
    if(tel_a.value.trim()){
        if(intl.isValidNumber()){
            validMsga.classList.remove("hide");
        }else{
            tel_a.classList.add("error");
            var errorCodea = intl.getValidationError();
            errorMsga.innerHTML = errorMapa[errorCodea];
            errorMsga.classList.remove("hide");
        }
    }
});
tel_a.addEventListener('change', reset_a);
tel_a.addEventListener('keyup', reset_a);


var tel_b = document.querySelector("#tel_b"),
errorMsgb = document.querySelector("#error-msg-b"),
validMsgb = document.querySelector("#valid-msg-b");
var errorMapb = [ "X", "Invalid country code", "Too short", "Too long", "Invalid number"];

var intl = window.intlTelInput(tel_b, {
    utilsScript: "telephone/js/utils.js"
});

var reset_b = function() {
    tel_b.classList.remove("error");
    errorMsgb.innerHTML = "";
    errorMsgb.classList.add("hide");
    validMsgb.classList.add("hide");
};

tel_b.addEventListener('blur', function() {
    reset_b();
    if(tel_b.value.trim()){
        if(intl.isValidNumber()){
            validMsgb.classList.remove("hide");
        }else{
            tel_b.classList.add("error");
            var errorCodeb = intl.getValidationError();
            errorMsgb.innerHTML = errorMapb[errorCodeb];
            errorMsgb.classList.remove("hide");
        }
    }
});
tel_b.addEventListener('change', reset_b);
tel_b.addEventListener('keyup', reset_b); */

</script>
</body>
</html>

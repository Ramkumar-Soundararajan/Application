<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");
include ("../db/db_connect.php");
$menu_title='Add Business';
if (isset($_REQUEST["equipment_id"])) { $equipment_id = $_REQUEST["equipment_id"]; } else { $equipment_id = ""; }
if($equipment_id != ''){
	$query2 = "select * from eti_equipment where id='$equipment_id'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$equipment_name =  $res2['equipment_name'];
	$unit =  $res2['unit'];
	$selling_price =  $res2['selling_price'];
	$cost_price =  $res2['cost_price'];
	$id  =  $res2['id'];
}else{
	$equipment_name = '';
	$unit = '';
	$selling_price = '';
	$cost_price = '';
	$id = '';
}
if ($_POST){
	$equipment_id = $_POST['equipment_id'];
	$equipment_name = $_POST['equipment_name'];
	$unit = $_POST['unit'];
	$selling_price = $_POST['selling_price'];
	$cost_price = $_POST['cost_price'];
	
	if($equipment_id == ''){
		$query1 = "insert into eti_equipment(equipment_name,unit,selling_price,cost_price,deleted) 
				values('$equipment_name','$unit','$selling_price','$cost_price','0')";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				header ("location:listview.php");
	}else{
		$query4 = "update eti_equipment set equipment_name = '$equipment_name',unit = '$unit',selling_price = '$selling_price', cost_price = '$cost_price' where id = '$id'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		header ("location:listview.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Equipment Master</title>
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
        <?php echo $equipment_master_lbl; ?>
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
              <h3 class="box-title"><?php echo $add_equipment_lbl; ?></h3>
            </div>
    <form action="editview.php" method="post"> 
        <div class="box-body">
          <div class="row">
			<div class="col-md-6">
              <div class="form-group">
                <label><?php echo $equipment_name_lbl; ?></label>
                <input type="hidden" class="form-control" name="equipment_id" id="equipment_id" value="<?php echo $id; ?>">
                <input type="text" class="form-control" name="equipment_name" id="equipment_name" value="<?php echo $equipment_name; ?>" placeholder="Equipment Name" required="required">
              </div>
            </div>
			<div class="col-md-6">
              <div class="form-group">
                <label><?php echo $unit_measure_lbl; ?></label>
                <input type="text" class="form-control" name="unit" id="unit" value="<?php echo $unit; ?>" placeholder="Unit" required="required">
              </div>
            </div>
			<div class="col-md-6">
              <div class="form-group">
                <label><?php echo $selling_price_lbl; ?></label>
                <input type="text" class="form-control" name="selling_price" id="selling_price" value="<?php echo $selling_price; ?>" placeholder="Selling Price" required="required">
              </div>
            </div>
			<div class="col-md-6">
              <div class="form-group">
                <label><?php echo $cost_price_lbl; ?></label>
                <input type="text" class="form-control" name="cost_price" id="cost_price" value="<?php echo $cost_price; ?>" placeholder="Cost Price" required="required">
              </div>
            </div>
          </div>
        </div>
	
          </div>
        </div>
		<div class="box-footer">
                <button type="submit" name="cancel" id="cancel" class="btn btn-default"><?php echo $cancel_lbl; ?></button>
                <button type="submit" name="submit" id="submit" class="btn btn-info pull-right"><?php echo $submit_lbl; ?></button>
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

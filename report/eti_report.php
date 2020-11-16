<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");

include ("../db/db_connect.php");
$menu_title='Manage Competitor';

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }

if (isset($_SESSION['userloginid']));
   $session_id = $_SESSION['userloginid'];
   $query12 = "select * from eti_portal_user where id = '$session_id'";
   $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
   $res12 = mysql_fetch_array($exec12);
   $access_rights = $res12['access_rights'];
   $country_id = $res12['country'];
   $branch_id = $res12['branch'];
  
$path = '/ETI/eti/downloads/eti_pdf/';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | ETI Report</title>
  <!-- Tell the Employee Code to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
   <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
  <link rel="shortcut icon" type="image/png" href="../images/rentokil_logo.png"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <?php include ('../includes/header.php'); ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('../includes/sidebar.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $eti_master_lbl; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">ETI Report</h3>
				</div>
				<form class="form-vertical" name="search" action="eti_report.php" method="post">
              <div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>Job Type</label>
						  <select class="form-control select2" name="job_type" id="job_type">
							<option value="" selected="selected">Please Choose Job Type</option>
							<option value="Job">Job</option>
							<option value="Contract">Contract</option>
						  </select>
              
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>ETI Status</label>
						  <select class="form-control select2" name="eti_status" id="eti_status">
							<option value="" selected="selected">Please Choose ETI Status</option>
							<option value="0">Pending</option>
							<option value="1">Submitted</option>
							<option value="2">Cancelled</option>
							<option value="3">Completed</option>
						  </select>
              
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Completed Date</label>
						   <div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" class="form-control pull-right" id="completed_date" name="completed_date">
						   </div>
						</div>
					</div>
				</div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
					<button type="submit" class="btn btn-info">Search</button>
					<button type="submit" class="btn btn-info pull-right" formaction="../excel_export/eti_data.php">Export</button>
              </div>
              <!-- /.box-footer -->
            </form>
				</div>
            <!-- /.box-header -->
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $serial_number_lbl; ?></th>
                  <th><?php echo $contract_no_lbl; ?></th>
                  <th><?php echo $sra_sra_lbl; ?></th>
                  <th><?php echo $eti_date_lbl; ?></th>
                  <th><?php echo $eti_job_type_lbl; ?></th>
                  <th><?php echo $name_lbl; ?></th>
                  <th><?php echo $premises_address_a_lbl; ?></th>
                  <th><?php echo $premises_tel_a_lbl; ?></th>
                  <th><?php echo $billing_email_lbl; ?></th>
				  <th><?php echo $submitter_lbl; ?></th>
				  <th><?php echo $completed_lbl; ?></th>
				  <th><?php echo $status_lbl; ?></th>
                </tr>
                </thead>
                <tbody>
				<?php
					if (isset($_REQUEST["job_type"])) { 
						$job_type = $_REQUEST["job_type"]; 
					} else { 
						$job_type = ""; 
					}
					
					if (isset($_REQUEST["eti_status"])) { 
						$eti_status = $_REQUEST["eti_status"]; 
					} else { 
						$eti_status = ""; 
					}
					
					if (isset($_REQUEST["completed_date"])) { 
						$completed_date = $_REQUEST["completed_date"];
                        $completeddate = explode("/",$completed_date);
						$completed_start_date = $completeddate[0];
						$completed_start_date = date('Y-m-d', strtotime($completed_start_date));
						$completed_end_date = $completeddate[1];
						$completed_end_date = date('Y-m-d', strtotime($completed_end_date));
					} else { 
						$completed_date = ""; 
					}
					//echo $completed_date; exit;
					if ($job_type=='' && $eti_status=='' && $completed_date==''){
						$query2 = "select a.*, b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id";
					} else if ($job_type!='' && $eti_status=='' && $completed_date=='') {
						$query2 = "select a.*, b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.job_type='".$job_type."'";
					} else if ($job_type=='' && $eti_status!='' && $completed_date=='') {
						$query2 = "select a.* ,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.form_status='".$eti_status."'";
					} else if ($job_type=='' && $eti_status=='' && $completed_date!='') {
						$query2 = "select a.* ,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'";	
					} else if ($job_type!='' && $eti_status!='' && $completed_date=='') {
						$query2 = "select a.* ,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.job_type='".$job_type."' and a.form_status='".$eti_status."'";
					} else if ($job_type!='' && $eti_status=='' && $completed_date!='') {
						$query2 = "select a.* ,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.job_type='".$job_type."' and a.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'";
					} else if ($job_type=='' && $eti_status!='' && $completed_date!='') {
						$query2 = "select a.* ,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.form_status='".$eti_status."' and a.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'";
					} else if ($job_type!='' && $eti_status!='' && $completed_date!='') {
						$query2 = "select a.* ,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.job_type='".$job_type."' and a.form_status='".$eti_status."' and a.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'";
					}
					$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
					while ($res2 = mysql_fetch_array($exec2))
					{
					  $id_name= "ETI - ".$res2['serial_number'];
		              $actual_path = $path.$id_name.".pdf";
					  $new_path = str_replace("%20"," ",$actual_path);
					  $id = $res2['id'];
					  $eti_date = $res2['eti_date'];
					  $eti_date = date('d-m-Y', strtotime($eti_date));
					  $completed_date = $res2['date_completed'];
					  if ($completed_date != '') {
						  $completed_date = date('d-m-Y', strtotime($completed_date));
					  } else {
						  $completed_date = $res2['date_completed'];
					  }
					  $query3 = "select fix_percentage from eti_total_details where sra_id = '$id'";
					  $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
					  $res3 = mysql_fetch_array($exec3);
					  $fix_percentage = $res3['fix_percentage'];
					  if ($fix_percentage > 50) {
							$query4 = "select approve_a,approve_a_name,approve_a_date_time from eti_approve_details where sra_id = '$id'";
							$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
							$res4 = mysql_fetch_array($exec4);
							$approve_a = $res4['approve_a'];
							$approve_a_name = $res4['approve_a_name'];
							$approve_a_date_time = $res4['approve_a_date_time'];
							if ($approve_a == ''){
								$app_status = 'Sent to Admin Team';
							} else if ($approve_a == 5){
								$app_status = 'Rejected By'.$approve_a_name;
							}
					  } else if ($fix_percentage < 50){
						  if ($fix_percentage > 20) {
							    $query4 = "select approve_a,approve_a_name,approve_a_date_time from eti_approve_details where sra_id = '$id'";
								$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
								$res4 = mysql_fetch_array($exec4);
								$approve_a = $res4['approve_a'];
								$approve_a_name = $res4['approve_a_name'];
								$approve_a_date_time = $res4['approve_a_date_time'];
								if ($approve_a == ''){
									$app_status = 'Pending at Raymond';
								} else if ($approve_a == 1) {
									$app_status = 'Sent to Admin Team';
								} else if ($approve_a == 2) {
									$app_status = 'Rejected By'.$approve_a_name;
								} else if ($approve_a == 3) {
									$app_status = $approve_a_name.'ask for Clarification';
								} else if ($approve_a == 4) {
									$app_status = 'Clarified by'.$approve_a_name;
								}
						  } else if ($fix_percentage < 20) {
							    $query4 = "select approve_a,approve_a_name,approve_a_date_time,approve_b,approve_b_name,approve_b_date_time from eti_approve_details where sra_id = '$id'";
								$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
								$res4 = mysql_fetch_array($exec4);
								$approve_a = $res4['approve_a'];
								$approve_a_name = $res4['approve_a_name'];
								$approve_a_date_time = $res4['approve_a_date_time'];
								$approve_b = $res4['approve_b'];
								$approve_b_name = $res4['approve_b_name'];
								$approve_b_date_time = $res4['approve_b_date_time'];
								if ($approve_a == '' && $approve_b == ''){
									$app_status = 'Pending at Raymond';
								} else if ($approve_a == 1 && $approve_b == '') {
									$app_status = 'Pending at Joseph';
								} else if ($approve_a != '' && $approve_b == 1) {
									$app_status = 'Sent to Admin Team';
								} else if ($approve_a == 2 && $approve_b == '') {
									$app_status = 'Rejected by'.$approve_a_name;
								} else if ($approve_a != '' && $approve_b == 2) {
									$app_status = 'Rejected by'.$approve_b_name;
								} else if ($approve_a == 3 && $approve_b == '') {
									$app_status = $approve_a_name.'ask for Clarification';
								} else if ($approve_a != '' && $approve_b == 3) {
									$app_status = $approve_b_name.'ask for Clarification';
								} else if ($approve_a == 4 && $approve_b == '') {
									$app_status = 'Clarified by'.$approve_a_name;
								} else if ($approve_a != '' && $approve_b == 4) {
									$app_status = 'Clarified by'.$approve_b_name;
								}
						  }
					  }
				?>
                <tr>
                  <td><?php echo $res2['serial_number']; ?></td>
                  <td><?php echo $res2['contract_no']; ?></td>
                  <td><?php echo $res2['sra']; ?></td>
                  <td><?php echo $eti_date; ?></td>
                  <td><?php echo $res2['job_type']; ?></td>
                  <td><?php echo $res2['name']; ?></td>
                  <td><?php echo $res2['premises_address_a']; ?></td>
                  <td><?php echo $res2['tel_a']; ?></td>
                  <td><?php echo $res2['billing_email']; ?></td>
				  <td><?php echo $res2['employee_name']; ?></td>
				  <td><?php echo $completed_date; ?></td>
                  <td style="text-align:center;">
					<?php if ($res2['form_status'] == 0 && $res2['approve_desc']== ''){ 
						echo '<span class="label label-warning">Pending</span>'; 
					} else if ($res2['form_status'] == 1){ 
						echo '<span class="label label-success">Submitted</span>';
					} else if ($res2['form_status'] == 2){ 
						echo '<span class="label label-danger">Cancelled</span>';
					} else if ($res2['form_status'] == 0 && $res2['approve_desc']== 'Rejected By Admin') { 
						echo '<span class="label label-primary">Rejected</span>'; 
					} else if ($res2['form_status'] == 3 ){
						echo '<span class="label label-info">Completed</span>';
					}
					?>
				  </td>
                </tr>
				<?php } ?>
                </tbody>
                <tfoot>
                <!-- <tr>
                  <th><?php //echo $serial_number_lbl; ?></th>
                  <th><?php //echo $contract_no_lbl; ?></th>
                  <th><?php //echo $sra_sra_lbl; ?></th>
                  <th><?php //echo $eti_date_lbl; ?></th>
                  <th><?php //echo $eti_job_type_lbl; ?></th>
                  <th><?php //echo $name_lbl; ?></th>
                  <th><?php //echo $premises_address_a_lbl; ?></th>
                  <th><?php //echo $premises_tel_a_lbl; ?></th>
				  <th><?php //echo $submitter_lbl; ?></th>
				  <th><?php //echo $completed_lbl; ?></th>
				  <th><?php //echo $status_lbl; ?></th>
                </tr> -->
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include ('../includes/footer.php'); ?>
  </footer>

  <!-- Control Sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $success_lbl; ?></h4>
      </div>
      <div class="modal-body">
        <p><?php echo $success_msg_lbl; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $close_lbl; ?></button>
      </div>
    </div>

  </div>
</div>
<script src="../plugins/ajax/ajax.js"></script>
<script src="../plugins/ajax/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
<script>
document.getElementById('job_type').value = "<?php echo $_GET['job_type'];?>";
document.getElementById('eti_status').value = "<?php echo $_GET['eti_status'];?>";
  $(function () {
		$('#completed_date').daterangepicker({
			    autoUpdateInput: false,
				  locale: {
					  cancelLabel: 'Clear'
				  }
		});
		$('#completed_date').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD-MM-YYYY') + ' / ' + picker.endDate.format('DD-MM-YYYY'));
		});

		$('#completed_date').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
		$('#example1').DataTable({
            drawCallback: function () {
                $('.popoverButton').popover({
                    "html": true,
                    trigger: 'manual',
                    placement: 'left',
                    "content": function () {
				    var id = ($(this).val());
					if (id != ''){
						$.ajax({
						url:"fetch_status.php",
						method:"POST",
						async: false,
						data:{id:id},
						success:function(data)
						{
						 fetch_data = data;
						}
					   });
					}
                    return fetch_data;
                    }
                })
            }
        });
		
		$('table').on('click', function(e){
            if($('.popoverButton').length>1)
            $('.popoverButton').popover('hide');
            $(e.target).popover('toggle');
        });
  });
  $(document).ready(function(){
	$('#job_type').val("<?php echo $_POST['job_type'];?>");
    $('#eti_status').val("<?php echo $_POST['eti_status'];?>");
	$('#completed_date').val("<?php echo $_POST['completed_date'];?>");
	var st = "<?php echo $st ?>";
	if (st == 1) {
		$('#myModal').modal('show');
	}
  
			
	/* $('.hover').tooltip({
	title: fetchData,
	html: true,
	placement: 'right'
	});
    function fetchData()
	  {
	   //alert('asdad');
	   var fetch_data = '';
	   var element = $(this);
	   var id = element.attr("id");
		   $.ajax({
			url:"fetch_status.php",
			method:"POST",
			async: false,
			data:{id:id},
			success:function(data)
			{
			 fetch_data = data;
			}
		   });   
	   return fetch_data;
	  } */
  });
</script>
</body>
</html>

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
  <title>ETI | ETI Master</title>
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
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
  <link rel="shortcut icon" type="image/png" href="../images/rentokil_logo.png"/>
</head>
<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
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
            <div class="box-header">
              <h3 class="box-title"><?php echo $manage_eti_lbl; ?></h3>
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
                  <th><?php echo $submitter_lbl; ?></th>
				  <th><?php echo $status_lbl; ?></th>
				  <th><?php echo $app_status_lbl; ?></th>
				  <th><?php echo $action_lbl; ?></th>
                </tr>
                </thead>
                <tbody>
				<?php
				    if ($access_rights == 0){
						$query2 = "select a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.premises_address_a,a.tel_b,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.form_status NOT IN (2,3)";
					} else if ($access_rights == 1) {						
						$query2 = "select a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.premises_address_a,a.tel_b,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.created_by = '$session_id' and a.form_status NOT IN (2,3)";
					} else if ($access_rights == 2 || $access_rights == 3) {
						$query2 = "select  a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.premises_address_a,a.tel_b,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where (a.form_status = 1 OR a.form_status = 2 OR a.form_status = 3 OR a.form_status = 4 OR a.form_status = 5) and b.approve_desc = 'Sent To Admin Team' and a.form_status NOT IN (2,3)";
					} else if ($access_rights == 4){
						$query2 = "select a.serial_number,a.id,a.eti_date,a.contract_no,a.sra,a.job_type,a.name,a.premises_address_a,a.tel_b,a.form_status,a.google_drive,b.approve_desc, c.employee_name from eti_sra a LEFT JOIN eti_sra_status b ON a.id = b.sra_id LEFT JOIN eti_portal_user c ON a.created_by = c.id where a.form_status NOT IN (2,3)";
					} 
					$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
					while ($res2 = mysql_fetch_array($exec2))
					{
					  $id_name= "ETI - ".$res2['serial_number'];
		              $actual_path = $path.$id_name.".pdf";
					  $new_path = str_replace("%20"," ",$actual_path);
					  $id = $res2['id'];
					  $google_drive_fileid = $res2['google_drive'];
					  $google_drive_path = 'https://drive.google.com/open?id='.$google_drive_fileid;
					  $eti_date = $res2['eti_date'];
					  $eti_date = date('d/m/Y', strtotime($eti_date));
					  $query3 = "select fix_percentage from eti_total_details where sra_id = '$id'";
					  $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
					  $res3 = mysql_fetch_array($exec3);
					  $fix_percentage = $res3['fix_percentage'];
					  if ($fix_percentage >= 50) {
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
							$condition = 'Greater Than 50';
							$business_id = '0';
							$add_type = 'TO';
							$level = '0';
							$query38 = "select name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level = '$level' and business_type='$business_id' and add_type='$add_type'";
							$exec38 = mysql_query($query38) or die ("Error in Query38".mysql_error());
							$res38= mysql_fetch_array($exec38);
							$email = $res38['email'];
							$email_name = $res38['name'];
							$email_id = $res38['id'];
							$reject_url = 'reject_admin_a.php?eti_id='.base64_encode($res2['id']).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name);
					  } else if ($fix_percentage < 50){
						  if ($fix_percentage >= 20) {
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
								
								$condition = 'Greater Than 20';
								$business_id = '0';
								$add_type = 'TO';
								$level = '0';
								$query4 = "select id,name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level = '$level' and business_type='$business_id' and add_type='$add_type'";
								$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
								$res4 = mysql_fetch_array($exec4);
								$email = $res4['email'];
								$email_name = $res4['name'];
								$email_id = $res4['id'];
								$reject_url = 'reject_admin_a.php?eti_id='.base64_encode($res2['id']).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name);
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
								$condition = 'Less Than 20';
								$business_id = '0';
								$level = '0';
								$add_type = 'TO';
								$query4 = "select name,email,add_type from eti_approve_matrix where mail_condition='$condition' and level = '$level' and business_type='$business_id' and add_type='$add_type'";
								$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
								$res4 = mysql_fetch_array($exec4);
								$email = $res4['email'];
								$email_name = $res4['name'];
								$email_id = $res4['id'];
								$reject_url = 'reject_admin_b.php?eti_id='.base64_encode($res2['id']).'&&email='.base64_encode($email).'&&email_name='.base64_encode($email_name);
						  }
					  }
				?>
                <tr>
                  
				  <td>
					<?php echo $res2['serial_number']; ?>
				  </td>
				  <td>
					<?php echo $res2['contract_no']; ?>
				  </td>
				  <td>
					<?php echo $res2['sra']; ?>
				  </td>
				  <td>
					<?php echo $eti_date; ?>
				  </td>
				  <td>
					<?php echo $res2['job_type']; ?>
				  </td>
				  <td>
					<?php echo $res2['name']; ?>
				  </td>
				  <td>
					<?php echo $res2['premises_address_a']; ?>
				  </td>
				  <td>
					<?php echo $res2['tel_b']; ?>
				  </td>
				  <td>
					<?php echo $res2['employee_name']; ?>
				  </td>
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
					} else if ($res2['form_status'] == 4 ){
						echo '<span class="label label-danger">ERROR</span>';
					} else if ($res2['form_status'] == 5 ){
						echo '<span class="label label-success">Manual</span>';
					}
					?>
				  </td>
                  <td style="text-align:center;"><label>
					  <button class='popoverButton' value="<?php echo $res2['id']; ?>">Status</button>
					  <!-- <a href="#" class="hover" id="<?php //echo $res2['id']; ?>">Status</a> -->
					  </label>
					  <!--<span class="label label-warning"><?php //echo $app_status; ?></span> -->
				  </td>
				  <td>
					  <?php if ($access_rights == 0) { ?>
					  <a href="<?php echo $google_drive_path; ?>" target="_blank"><i class="fa fa-file-pdf-o" style="color:red" title="Download"></i></a>
					  <?php } ?>
				      <?php if ($res2['form_status'] == 1 || $res2['form_status'] == 3 || $res2['form_status'] == 5){ ?>
					  <a href="<?php echo $new_path; ?>" target="_blank"><i class="fa fa-download" style="color:red" title="Download"></i></a>
					  <?php } ?>
					  
					  <?php if ((($access_rights == 1 || $access_rights == 0) && $res2['form_status'] == 0) || (($access_rights == 1 || $access_rights == 0) && ($res2['form_status'] == 1 || $res2['form_status'] == 5))){ ?>
					  <a href="editview.php?eti_id=<?php echo base64_encode($res2['id']); ?>"><i class="fa fa-edit" style="color:green" title="Edit"></i></a>
					  <?php } ?>
					  
					  <?php if ($access_rights == 1 || $access_rights == 0) { ?>
					  <a href="copyview.php?eti_id=<?php echo base64_encode($res2['id']); ?>"><i class="fa fa-copy" title="Copy"></i></a> 
					  <?php } ?>
					  
					  <?php if (($access_rights == 2 && ($res2['contract_no'] == '' || $res2['contract_no'] != '') && ($res2['form_status'] == 1 || $res2['form_status'] == 5))||($access_rights == 2 && $res2['form_status'] == 4 && $res2['contract_no'] == 'ERROR')) { ?>
					  <a href="updateadminview.php?eti_id=<?php echo base64_encode($res2['id']); ?>"><i class="fa fa-edit"style="color:green" title="Update"></i></a>
					  <a href="<?php echo $reject_url; ?>" target="_blank"><i class="fa fa-times" style="color:red" title="Reject"></i></a>
					  <?php } ?>
					  
					  <?php if ($access_rights == 2) { ?>
					  <a class='eti_cancel_id' data-id="<?php echo $res2['id']; ?>"><i class="fa fa-ban" style="color:brown" title="Cancel"></i></a>
					  <?php } ?>
				  </td>
                </tr>
				<?php } ?>
                </tbody>
                <tfoot>
                <tr>	
                  <th><?php echo $serial_number_lbl; ?></th>
                  <th><?php echo $contract_no_lbl; ?></th>
                  <th><?php echo $sra_sra_lbl; ?></th>
                  <th><?php echo $eti_date_lbl; ?></th>
                  <th><?php echo $eti_job_type_lbl; ?></th>
                  <th><?php echo $name_lbl; ?></th>
                  <th><?php echo $premises_address_a_lbl; ?></th>
                  <th><?php echo $premises_tel_a_lbl; ?></th>
				  <th><?php echo $submitter_lbl; ?></th>
				  <th><?php echo $status_lbl; ?></th>
				  <th><?php echo $app_status_lbl; ?></th>
				  <th><?php echo $action_lbl; ?></th>
                </tr>
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

<div id="add_modal" class="modal fade" role="dialog">
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
<div id="update_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $success_lbl; ?></h4>
      </div>
      <div class="modal-body">
        <p><?php echo $update_msg_lbl; ?></p>
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
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../plugins/datatables/extensions/DateSorting/js/datesorting.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
<script>
  $(function () {
	    var st = "<?php echo $st; ?>";
		if (st == 1) {
			$('#add_modal').modal('show');
		}
		if (st == 2) {
			$('#update_modal').modal('show');
		}
		$('#example1').DataTable({
			"aoColumns": [
				null,
				null,
				null,
				{ "sType": "date-uk" },
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null
			],
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
		$('#example1 tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		});
 
		// DataTable
		var table = $('#example1').DataTable();
		// Apply the search
		table.columns().every( function () {
			var that = this;
			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			});
		});
		
		$('table').on('click', function(e){
            if($('.popoverButton').length>1)
            $('.popoverButton').popover('hide');
            $(e.target).popover('toggle');
        });
		
		$("#dialog").dialog({
        autoOpen: false,
        modal: true,
        title: "Details",
        buttons: {
            Close: function () {
                $(this).dialog('close');
            }
        }
		});
  });
  $('.eti_cancel_id').click(function() {
		var cancel_id = $(this).data('id');
		if (confirm('Are you sure want to cancel ETI?')) {
		 $.ajax
		   ({
			  url: 'ajax.php',
			  data: {cancel_id: cancel_id},
			  type: 'post',
			  success: function(data) {
				 alert(data);
				 //datatable.reload(); // to reload datatable and get new data from remote
				 window.location.reload();
			  },
			  error: function(data) {
				 window.alert('error: ' + cancel_id);
			  }
		   });
		}
		});	
	
  /* $(document).ready(function(){
	
	var st = "<?php echo $st ?>";
	if (st == 1) {
		$('#myModal').modal('show');
	}	
	$('.hover').tooltip({
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
	  } 
  }); */
</script>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../../PORTAL/index.php");
include ("../db/db_connect.php");
$menu_title='Manage Portal User';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Portal User Master</title>
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
  <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
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
        Portal User Master
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
              <h3 class="box-title">Manage Portal User</h3>
			  <!-- <button id="exportButton" class="btn btn-primary" style="float:right;"><span class="fa fa-file-excel-o"></span> Export</button> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>User Email</th>
                  <th>User Password</th>
                  <th>Employee Name</th>
                  <th>Employee Code</th>
                  <th>Branch</th>
                  <th>Country</th>
                  <th>Access Rights</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$query2 = "select * from eti_portal_user";
					$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
					while ($res2 = mysql_fetch_array($exec2))
					{
						$cou_id = $res2['country'];
						$branch_id = $res2['branch'];
						
						if ($res2['access_rights'] == '0'){
							$access_rights = 'Admin';
						} else if ($res2['access_rights'] == '1'){
							$access_rights = 'Sales';
						} else if ($res2['access_rights'] == '2'){
							$access_rights = 'Contract Admin';
						} else if ($res2['access_rights'] == '4'){
							$access_rights = 'IT Admin';
						} else if ($res2['access_rights'] == '5'){
							$access_rights = 'Reporting';
						}
						
						$query12 = "select country_name from eti_country_master where id= '$cou_id'";
						$exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
						$res12 = mysql_fetch_array($exec12);
						
						$query13 = "select branch_name from eti_branch_master where id= '$branch_id'";
						$exec13 = mysql_query($query13) or die ("Error in Query13".mysql_error());
						$res13 = mysql_fetch_array($exec13);
				?>
                <tr>
                  <td><?php echo $res2['user_mail']; ?></td>
                  <td><?php echo $res2['user_pass']; ?></td>
                  <td><?php echo $res2['employee_name']; ?></td>
                  <td><?php echo $res2['employee_code'];?></td>
                  <td><?php echo $res13['branch_name'];?></td>
				  <td><?php echo $res12['country_name'];?></td>
                  <td><?php echo $access_rights;?></td>
                  <td><?php if ($res2['deleted'] == 0 ){ echo '<span class="label label-success">Active</span>'; } else{ echo '<span class="label label-danger">Deactive</span>';} ?></td>
                  <td><?php if ($res2['deleted'] == 0 ){ ?><a href="editview.php?user_id=<?php echo $res2['id']; ?>"><i class="fa fa-edit"></i></a> &nbsp; <a href="deleteview.php?user_id=<?php echo $res2['id']; ?>"><i class="fa fa-trash"></i></a><?php } ?></td>
                </tr>
				<?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>User Email</th>
                  <th>User Password</th>
                  <th>Employee Name</th>
                  <th>Employee Code</th>
                  <th>Branch</th>
                  <th>Country</th>
                  <th>Access Rights</th>
                  <th>Status</th>
                  <th>Action</th>
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
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
</body>
</html>

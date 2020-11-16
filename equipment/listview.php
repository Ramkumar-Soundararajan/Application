<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");

include ("../db/db_connect.php");
$menu_title='Manage Competitor';

if (isset($_SESSION['userloginid']));
   $session_id = $_SESSION['userloginid'];
   $query12 = "select * from eti_portal_user where id = '$session_id'";
   $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
   $res12 = mysql_fetch_array($exec12);
   $access_rights = $res12['access_rights'];
   $country_id = $res12['country'];
   $branch_id = $res12['branch'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Equipment Master</title>
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
        <?php echo $equipment_master_lbl; ?>
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
              <h3 class="box-title"><?php echo $manage_equipment_lbl; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $equipment_name_lbl; ?></th>
                  <th><?php echo $unit_measure_lbl; ?></th>
                  <th><?php echo $selling_price_lbl; ?></th>
                  <th><?php echo $cost_price_lbl; ?></th>
				  <th><?php echo $status_lbl; ?></th>
                  <th><?php echo $action_lbl; ?></th>
                </tr>
                </thead>
                <tbody>
				<?php
					$query2 = "select * from eti_equipment";
					$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
					while ($res2 = mysql_fetch_array($exec2))
					{
				?>
                <tr>
                  <td><?php echo $res2['equipment_name']; ?></td>
                  <td><?php echo $res2['unit']; ?></td>
                  <td><?php echo $res2['selling_price']; ?></td>
                  <td><?php echo $res2['cost_price']; ?></td>
                  <td><?php if ($res2['deleted'] == 0 ){ echo '<span class="label label-success">Active</span>'; } else{ echo '<span class="label label-danger">Deactive</span>';} ?></td>
                  <td><?php if ($res2['deleted'] == 0 ){ ?><a href="editview.php?equipment_id=<?php echo $res2['id']; ?>"><i class="fa fa-edit"></i></a> &nbsp; <a href="deleteview.php?equipment_id=<?php echo $res2['id']; ?>"><i class="fa fa-trash"></i></a><?php } ?></td>
                </tr>
				<?php } ?>
                </tbody>
                <tfoot>
                <tr>	
                 <th><?php echo $equipment_name_lbl; ?></th>
                  <th><?php echo $unit_measure_lbl; ?></th>
                  <th><?php echo $selling_price_lbl; ?></th>
                  <th><?php echo $cost_price_lbl; ?></th>
				  <th><?php echo $status_lbl; ?></th>
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

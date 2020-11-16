<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<?php
 session_start();
   $session_id = $_SESSION['userloginid'];
   
   $query12 = "select * from eti_portal_user where id = '$session_id'";
   $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
   $res12 = mysql_fetch_array($exec12);
   $access_rights = $res12['access_rights'];
  
?>
<section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $_SESSION['user_pic']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['user_name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $online_lbl; ?></a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu">
        <li class="header"><?php echo $main_lbl; ?></li>
		<?php if($access_rights == '0') { ?>
		<li>
          <a href="#">
            <i class="fa fa-dashboard"></i> <span><?php echo $home_lbl; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../dashboard/dashboard.php"><i class="fa fa-circle-o"></i><?php echo $dashboard_lbl; ?></a></li>
          </ul>
        </li>
		<?php } ?>
		<li>
			<a href="#">
            <i class="fa fa-calculator"></i> <span><?php echo $eti_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
		  <?php if($access_rights == '0' || $access_rights == '1') { ?>
            <li><a href="../eti/addview.php"><i class="fa fa-plus"></i><?php echo $add_eti_lbl; ?></a></li>
		  <?php } ?>
            <li><a href="../eti/listview.php"><i class="fa fa-table"></i><?php echo $manage_eti_lbl; ?></a></li>
			<li><a href="../eti/completed_listview.php"><i class="fa fa-table"></i><?php echo $completed_eti_lbl; ?></a></li>
			<?php if ($session_id == 1) { ?>
			<li><a href="../eti/listview_angular.php"><i class="fa fa-table"></i><?php echo 'Listview Angular'; ?></a></li>
			<?php } ?>
			
          </ul>
		</li>
		<?php if($access_rights == '0' || $access_rights == '4') { ?>
		<li>
          <a href="#">
            <i class="fa fa-eyedropper"></i> <span><?php echo $surveyor_master_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../surveyor/editview.php"><i class="fa fa-plus"></i> <?php echo $add_surveyor_lbl; ?></a></li>
            <li><a href="../surveyor/listview.php"><i class="fa fa-table"></i><?php echo $manage_surveyor_lbl; ?></a></li>
          </ul>
        </li>
		<li>
          <a href="#">
            <i class="fa fa-industry"></i> <span><?php echo $industry_master_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../industry/editview.php"><i class="fa fa-plus"></i><?php echo $add_industry_lbl; ?></a></li>
            <li><a href="../industry/listview.php"><i class="fa fa-table"></i><?php echo $manage_industry_lbl; ?></a></li>
          </ul>
        </li>
		<li>
          <a href="#">
            <i class="fa fa-male"></i> <span><?php echo $competitor_master_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../competitor/editview.php"><i class="fa fa-plus"></i><?php echo $add_competitor_lbl; ?></a></li>
            <li><a href="../competitor/listview.php"><i class="fa fa-table"></i><?php echo $manage_competitor_lbl; ?></a></li>
          </ul>
        </li>
		
		<li>
          <a href="#">
            <i class="fa fa-briefcase"></i> <span><?php echo $business_master_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../business/editview.php"><i class="fa fa-plus"></i><?php echo $add_business_lbl; ?></a></li>
            <li><a href="../business/listview.php"><i class="fa fa-table"></i><?php echo $manage_business_lbl; ?></a></li>
          </ul>
        </li>
		
		<li>
          <a href="#">
            <i class="fa fa-bug"></i> <span><?php echo $pest_master_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../pest/editview.php"><i class="fa fa-plus"></i><?php echo $add_pest_lbl; ?></a></li>
            <li><a href="../pest/listview.php"><i class="fa fa-table"></i><?php echo $manage_pest_lbl; ?></a></li>
          </ul>
        </li>
		
		<li>
          <a href="#">
            <i class="fa fa-wrench"></i><span><?php echo $equipment_master_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../equipment/editview.php"><i class="fa fa-plus"></i> <?php echo $add_equipment_lbl; ?></a></li>
            <li><a href="../equipment/listview.php"><i class="fa fa-table"></i><?php echo $manage_equipment_lbl; ?></a></li>
          </ul>
        </li>

		<li>
          <a href="#">
            <i class="fa fa-group"></i> <span><?php echo $portal_usert_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../portal_user_master/editview.php"><i class="fa fa-plus"></i><?php echo $add_user_lbl; ?></a></li>
            <li><a href="../portal_user_master/listview.php"><i class="fa fa-table"></i><?php echo $manage_user_lbl; ?></a></li>
          </ul>
        </li>
		<?php } ?>
		<?php if ($session_id == 1 || $session_id == 8 || $session_id == 21 || $session_id == 13 || $access_rights == 5 || $session_id == 6 || $session_id == 15 || $session_id == 16 || $session_id == 44 || $session_id == 45 || $session_id == 76){ ?>
		<li>
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo $report_lbl; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../report/eti_report.php"><i class="fa fa-table"></i><?php echo $eti_report_lbl; ?></a></li>
          </ul>
        </li>
		<?php } ?>
      </ul>
    </section>
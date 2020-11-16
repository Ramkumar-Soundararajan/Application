  <?php
  session_start();
  if (!isset($_SESSION["userloginid"])) header ("location:index.php");
  include ("../db/db_connect.php");
  $session_id = $_SESSION['userloginid'];
  $language_id = $_SESSION['language_id'];
  
   $query12 = "select * from eti_portal_user where id = '$session_id'";
   $exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
   $res12 = mysql_fetch_array($exec12);
   $access_rights = $res12['access_rights'];
  
  if($language_id == "EN"){
	  include("../language/english.php");
  } else if ($language_id == "TH") {
	  include("../language/test.php");
  }
  
  ?>
  <link rel="shortcut icon" type="image/png" href="../images/rentokil_logo.png"/>
 <?php if ($access_rights == '1'){ ?>
<a href="../eti/addview.php" class="logo">
 <?php } else if ($access_rights == '2' || $access_rights == '3') {  ?>
<a href="../eti/listview.php" class="logo"> 
 <?php } else { ?>
<a href="../dashboard/dashboard.php?language_id=<?php echo $_SESSION["language_id"];?>" class="logo">
 <?php } ?>
      <span class="logo-mini"><b>E</b>TI</span>
      <span class="logo-lg"><b>Rentokil</b> ETI</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="../includes/profile.php?user_id=<?php echo $session_id;?>">My Profile</a>
          </li>
		  <li>
            <a href="../logout.php">Sign Out</a>
          </li>
        </ul>
      </div>
    </nav>
<?php
session_start();
include ("db/db_connect.php");

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = isset($_POST["frmflag1"]);
if ($frmflag1 == 'frmflag1')
{
	$user_mail = $_POST["user_mail"];
	$user_pass = $_POST["user_pass"];
	$language = $_POST["language"];
	$_SESSION['language_id'] = $language;

	$query12 = "select * from eti_portal_user where user_mail = '$user_mail' and user_pass = '$user_pass'";
	$exec12 = mysql_query($query12) or die ("Error in Query12".mysql_error());
	$res12 = mysql_fetch_array($exec12);
	$_SESSION['userloginid'] = $res12['id'];
	$_SESSION['access_rights'] = $res12['access_rights'];
	$_SESSION['user_mail'] = $res12['user_mail'];
	$access_rights = $res12['access_rights'];
	
	$query1 = "select * from eti_portal_user where user_mail = '$user_mail' and user_pass = '$user_pass'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$rowcount1 = mysql_num_rows($exec1);
	//echo $session_id = $exec1['id']; exit;
	if ($rowcount1 == 0){
		header ("location:index.php?st=1");
	}
	else{
		$res1 = mysql_fetch_array($exec1);
		$_SESSION["employee_name"] = $res1['employee_name'];
		if ($access_rights == '1'){
			header ("location:eti/addview.php");
		} else {
			header ("location:dashboard/dashboard.php");
		}
	}
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 1)
{
	$errmsg = "Login Failed. Email Or Password Incorrect.";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" 
      type="image/png" 
      href="images/rentokil_logo.png" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  </div>
  <div class="login-box-body">
    <p class="login-box-msg"><img src="images/rentokil_logo.png" alt="TPA" width="225"></p>

    <form action="index.php" method="post">
			<?php if($errmsg != '') { ?>
			<div style="background: #FF9900;" align="center">&nbsp;
				<?php
					echo $errmsg;
				?>
            </div>
			<?php } ?>
      <div class="form-group has-feedback">
        <input type="email" name="user_mail" id="user_mail" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="user_pass" id="user_pass" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
		<select name="language" id="language" class="form-control" placeholder="Language">
			<option value="EN">Engilish</option>
		</select>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div
        <div class="col-xs-4">
		  <input type="hidden" name="frmflag1" id="frmflag1" value="frmflag1" />
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

    <!-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
</body>
</html>

<?php
require("db/db_connect.php");
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:oauth/index.php");
$access_type = $_SESSION["access_type"];

	if (isset($_POST['language_submit'])){
		if ($_POST['language_id'] != ''){
			$_SESSION['language_id']= $_POST['language_id'];
		}
	if($access_type == 1) {
		header ("location:eti/addview.php");
	} else if ($access_type == 2 || $access_type == 3){
		header ("location:eti/listview.php");
	}else {
		header ("location:dashboard/dashboard.php");
	}
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ETI | Language</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="shortcut icon" type="image/png" href="images/rentokil_logo.png"/>
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<br><br><br><br><br><br><br>
<div class="example-modal">
        <div class="modal modal-primary">
          <div class="modal-dialog">
		    <form action="language.php" name="language" method="post" onsubmit="return validateForm()">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                  <span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title">Language</h4>
              </div>
					<div class="modal-body">
                        <select type='select' class="form-control" id="language_id" name="language_id">
                          <option value="">Please Choose Your Preferred Language</option>
							<?php
							$query2="select id,lang_name,lang_code from eti_lang_master where deleted='0'";
							$exec2=mysql_query($query2) or die ("Error in Query2".mysql_error());
							while($res2=mysql_fetch_array($exec2))
							{
							$lang_id = $res2['id'];
							$lang_code=$res2['lang_code'];
							$lang_name=$res2['lang_name'];
							?>
							<option value="<?php echo $lang_code; ?>"><?php echo $lang_name; ?></option>
							<?php }?>
                     </select>
              </div>
              <div class="modal-footer">
                <button type="submit" name="language_submit" id="language_submit" class="btn btn-outline">Submit</button>
              </div>
            </div>
			</form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      <!-- /.example-modal -->
<!-- /.center -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
function validateForm() {
    var x = document.forms["language"]["language_id"].value;
    if (x == "") {
        alert("Language Cannot be Empty!!");
        return false;
    }
}
</script>
</body>
</html>

<?php
//Include GP config file && User class
session_start();

include_once 'gpConfig.php';
include_once 'User.php';
include_once '../db/db_connect.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
        
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
         
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
	$user = new User();
	
	//Insert or update user data to the database
         $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
	
	//Storing user data into session
	$_SESSION['userData'] = $userData;
	
	//Render facebook profile data
    if(!empty($userData)){
        /* $language = $_POST['language'];
        $_SESSION["language"] = $language ;  */
        $_SESSION['user_pic']=$userData['picture'];
        $_SESSION['user_name']=$userData['first_name'];
		$_SESSION['user_email']=$userData['email'];
		
        $user_check = mysql_query("select id,access_rights,branch,country from eti_portal_user where user_mail='$userData[email]' and deleted=0") or die("Error in checking the user email. ".mysql_error());
		$user_res=mysql_fetch_array($user_check);
		$check='';
		$user = mysql_num_rows($user_check);
		if($user==1) 
		{
		$_SESSION["access_type"]= $user_res['access_rights']; 
		$_SESSION["userloginid"]= $user_res['id']; 
		$_SESSION["branch_id"]= $user_res['branch'];
		$_SESSION["country_id"]= $user_res['country'];
		header("location:../language.php");
		$_SESSION['login']=1;
		}else{
		header("location:message.php");
		}
		}else{
			$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
		}
	} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<a id="my_click" href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'">
                   <img src="images/google.png" width="90%"/>
                   </a>';
	$check=1;
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
  <title>ETI | Portal</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
  	<link rel="shortcut icon" type="image/png" href="../images/rentokil_logo.png"/>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  </div>
  <div class="login-box-body">
    <p class="login-box-msg"><img src="../images/rentokil_logo.png" alt="ETI" width="125"></p>

            <form action="index.php" method="post" id="test" name="test">
            <input type='hidden' id='check' name='check' value='<?php echo $check;?>'>
			
        <div class="row">
        <div class="col-xs-8">
          
        </div>
        <div class="col-xs-12">
		 <div><center><?php echo $output; ?></center></div>
		</div>
      </div>
    </form>

    <!-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
</div>
<script src="../plugins/jQuery/jquery-3.4.1.js"></script>
<script src="../bootstrap/js/bootstrap.min_latest.js"></script>
<script src="../plugins/iCheck/icheck.min.js"></script>
</body>
</html>


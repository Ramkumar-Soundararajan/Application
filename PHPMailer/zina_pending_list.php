<?php
include ("class.phpmailer.php");
include ("class.smtp.php");
$hostname = 'application.cric2bkwniue.us-east-2.rds.amazonaws.com';
$hostlogin = 'root';
$hostpassword = 'RenTokil!123';
$databasename = 'rentokil_eti';

//Folder Name Change Only Necessary
$appfoldername = 'ETI';

$link = mysql_connect($hostname, $hostlogin, $hostpassword) or die('Could not connect Table : ' . mysql_error());
mysql_select_db($databasename) or die('Could not select database'. mysql_error());
mysql_set_charset('UTF8');

$query1 = "SELECT 
   a.serial_number
FROM
    eti_sra a,
    eti_sra_status b
WHERE
    a.id = b.sra_id
        AND b.approve_desc = 'Pending at Zina Ang'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());

		$body .= "<html>
		          <head>
				  <style>
				  .link_button {
					display: inline-block;
					width: 115px;
					height: 25px;
					background: #4E9CAF;
					padding: 10px;
					text-align: center;
					border-radius: 5px;
					color: white;
					font-weight: bold;
					}
				  </style>
				  </head>
					<body>
						<div>
						<b>Dear Zina Ang,</b>
						</div> <br /> 
						<div>Please find pending ETI at you end.</div> <br />";
						while ($res1 = mysql_fetch_array($exec1)) {
							$body .= "<div>".$res1['serial_number']."</div>";
						}

		$body .= "<br /><div> 
						<b>Regards,<br /> Rentokil Initial Singapore Pte Ltd.</b>
					</div>
				</body>
			</html>";
		$subject = "ETI Pending for Approval";	
		$email = 'zina.ang@rentokil-initial.com'; //zina.ang@rentokil-initial.com
		$email_name = 'Zina Ang'; //Zina Ang
		//$email = 'ramkumar.soundararajan@rentokil-initial.com'; //zina.ang@rentokil-initial.com
		//$email_name = 'Ramkumar'; //Zina Ang
		$mail = new PHPMailer();
        $mail->IsSMTP();  // telling the class to use SMTP
        $mail->SMTPDebug = 0;
        $mail->Mailer = "smtp";
        $mail->Host = "ssl://smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = "speedasia-sg@rentokil-initial.com"; // SMTP username
        $mail->Password = "hczpdrjeurqfargw"; // SMTP password 
        $Mail->Priority = 1;
		$from_email = 'speedasia-sg@rentokil-initial.com';
		$from_name = 'Speedasia ETI';
		$mail->AddAddress($email,$email_name);
		$mail->AddCC('krishnadas.warrier@rentokil-initial.com','Krishnadas');
		$mail->SetFrom($from_email, $from_name);
		$mail->AddReplyTo($from_email,$from_name);
		$mail->Subject  = $subject;
		$mail->MsgHTML($body);   
		$mail->Send();
?>
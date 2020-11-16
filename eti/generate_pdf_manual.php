<?php
	session_start();
	include ("../db/db_connect.php");
	include ("../PHPMailer/class.phpmailer.php");
	include ("../PHPMailer/class.smtp.php");
	include ("../mpdf/mpdf.php");
	//include("quickstart.php");
	include 'quickstart_test.php';
	        $subject = 'HI';
	        $body = 'HI';
			$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPDebug = 0;
			$mail->Mailer = "smtp";
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->Username = "speedasia-sg@rentokil-initial.com"; // SMTP username
			$mail->Password = "hczpdrjeurqfargw"; // SMTP password 
			$mail->Priority = 1;
			$from_email = 'speedasia-sg@rentokil-initial.com';
			$from_name = 'Speedasia ETI';
			//$mail->AddAddress($email,$email_name);
			$mail->AddAddress('ramkumar.soundararajan@rentokil-initial.com','Ramkumar');
			//$mail->AddCC('krishnadas.warrier@rentokil-initial.com','Krishnadas');
			//$mail->AddCC('pc-eti-sg@rentokil-initial.com ','PC ETI');
			$mail->SetFrom($from_email, $from_name);
			$mail->AddReplyTo($from_email,$from_name);
			$mail->Subject  = $subject;
			$mail->MsgHTML($body);   
			$testing = 'https://drive.google.com/open?id=1igxNUaZPj0F5PuWzrIIGKne_5j7TnApv';
			$test='asdasd.pdf';
			$drive = new GoogleDrive();
			$fileId = '1hmHxCjv0rE6oP9l8jTnpr5pttaXEkWZM';
			$file = $drive->getFileID($fileId);
			//$mail->AddStringAttachment($file);
			$mail->AddAttachment($file, 'test.pdf' );
			$mail->Send();
			
			
		
?>
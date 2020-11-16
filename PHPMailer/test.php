<?php
    require 'class.phpmailer.php'; // path to the PHPMailer class
    require 'class.smtp.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();  // telling the class to use SMTP
        $mail->SMTPDebug = 2;
        $mail->Mailer = "smtp";
        $mail->Host = "ssl://smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = "speedasia-in@rentokil-initial.com"; // SMTP username
        $mail->Password = "@Process_01"; // SMTP password 
        $Mail->Priority = 1;
		$email = 'ramkumar.soundararajan@rentokil-initial.com';
		$visitor_email = 'speedasia-in@rentokil-initial.com';
        $mail->AddAddress($email,"Ramkumar");
        $mail->SetFrom($visitor_email, $name);
        $mail->AddReplyTo($visitor_email,$name);
		$user_message = 'Hi This is Ramkumar!!!!!!!';
        $mail->Subject  = "Mail From Rentokil";
        $mail->Body     = $user_message;
        $mail->WordWrap = 50;  

        if(!$mail->Send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
        echo 'Message has been sent.';
        }
?>
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
		
	$today =  date("Y/m/d");
	$cal_uid = date(’Ymd’).’T’.date(’His’).”-”.rand().”@rentokil-initial.com”;
	$meetingstamp = strtotime($today . ” UTC”);
    $dtstart= gmdate(”Ymd\THis\Z”,$today);
    $dtend= gmdate(”Ymd\THis\Z”,$today+$today);
    $todaystamp = gmdate(”Ymd\THis\Z”);
	$from_address = 'speedasia-in@rentokil-initial.com';
	$meeting_location = 'Chennai';
	$meeting_description = 'Test Meeting';
	$subject = 'asdasd';
	
	$user_message .= “–$mime_boundary\n”;
    $user_message .= “Content-Type: text/html; charset=UTF-8\n”;
    $user_message .= “Content-Transfer-Encoding: 8bit\n\n”;
 
    $user_message .= “<html>\n”;
    $user_message .= “<body>\n”;
    $user_message .= ‘<p>Dear ‘.$firstname.’ ‘.$lastname.’,</p>’;
    $user_message .= ‘<p>Here is my HTML Email / Used for Meeting Description</p>’;
    $user_message .= “</body>\n”;
    $user_message .= “</html>\n”;
    $user_message .= “–$mime_boundary\n”;
    //Create ICAL Content (Google rfc 2445 for details and examples of usage, beware of adding tabs)
    $ical =    ‘BEGIN:VCALENDAR
	PRODID:-//Microsoft Corporation//Outlook 11.0 MIMEDIR//EN
	VERSION:2.0
	METHOD:PUBLISH
	BEGIN:VEVENT
	ORGANIZER:MAILTO:’.$from_address.’
	DTSTART:’.$dtstart.’
	DTEND:’.$dtend.’
	LOCATION:’.$meeting_location.’
	TRANSP:OPAQUE
	SEQUENCE:0
	UID:’.$cal_uid.’
	DTSTAMP:’.$todaystamp.’
	DESCRIPTION:’.$meeting_description.’
	SUMMARY:’.$subject.’
	PRIORITY:5
	CLASS:PUBLIC
	END:VEVENT
	END:VCALENDAR’;
 
    $user_message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST;charset=utf-8\n';
    $user_message .= 'Content-Transfer-Encoding: 8bit\n\n';
    $user_message .= $ical;
		
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
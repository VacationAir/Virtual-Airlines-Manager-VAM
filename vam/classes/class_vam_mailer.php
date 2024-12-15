<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licenced under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php
	require 'PHPMailer-master/PHPMailerAutoload.php';
	class vam_mailer
	{
		function mail_register_compose($email_address)
		{
			include('db_login.php');
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			// Send mail to the pilot
			//  Get VA email configuration
			$sql = "select * from va_parameters";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$va_name = $row["va_name"];
			}
			$sql = "select * from config_emails";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$staff_email = $row["staff_email"];
				$ceo_email = $row["ceo_email"];
				$cc_email_1 = $row["cc_email_1"];
				$register_text = $row["register_text"];
			}
			$mail = new PHPMailer;
			$mail->addReplyTo($staff_email , 'VAM system');
			$mail->From = $staff_email;
			$mail->FromName = $va_name . ' VAM system';
			$mail->addAddress($email_address);
			$mail->addCC($ceo_email);
			$mail->addCC($cc_email_1);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Welcome to ' . $va_name;
			$mail->Body = $register_text . '</b>';
			$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
		}
		function mail_password_compose($email_address , $pass)
		{
         include('db_login.php');
         $db = new mysqli($db_host , $db_username , $db_password , $db_database);
         $db->set_charset("utf8");
         if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
         }
         // Send mail to the pilot
         //  Get VA email configuration
         $sql = "select * from va_parameters";
         if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
         }
         while ($row = $result->fetch_assoc()) {
            $va_name = $row["va_name"];
         }
         $sql = "select * from config_emails";
         if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
         }
         while ($row = $result->fetch_assoc()) {
            $staff_email = $row["staff_email"];
            $ceo_email = $row["ceo_email"];
            $cc_email_1 = $row["cc_email_1"];
            $register_text = $row["register_text"];
         }
         $mail = new PHPMailer;
         $mail->From = $staff_email;
         $mail->FromName = $va_name . ' VAM system';
         $mail->addAddress($email_address);               // Name is optional
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject = 'Password reset ' . $va_name;
         $mail->Body = 'Dear Pilot <p> Your new password is: ' . $pass . '<p>Regards<p>Virtual Airlines Manager system';
         $mail->AltBody = 'Dear Pilot. Your new password is:';
         if (!$mail->send()) {
            echo 'Message could not be sent';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
         } else {
            echo ' ';
         }
      }
		function mail_vampirep_compose($pilot,$action,$departure,$arrival,$comment)
		{
			include('../db_login.php');
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			$sql = "select * from gvausers where gvauser_id=".$pilot;
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$email_address = $row["email"];
				$accept_emails =$row["accept_emails"];
			}
			$sql = "select * from va_parameters";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$va_name = $row["va_name"];
			}
			$sql = "select * from config_emails";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$staff_email = $row["staff_email"];
				$ceo_email = $row["ceo_email"];
				$cc_email_1 = $row["cc_email_1"];
				$register_text = $row["register_text"];
			}
			if ($accept_emails==1)
			{
				switch ($action) {
			    case "acceptflight":
			        $validation="VALIDATED";
			        break;
			    case "rejectflight":
			        $validation="REJECTED";
			        break;
			    case "deleteflight":
			        $validation="DELETED";
			        break;
				}
				$mail = new PHPMailer;
				$mail->From = $staff_email;
				$mail->FromName = $va_name . ' VAM system';
				$mail->addAddress($email_address);               // Name is optional
				$mail->isHTML(true);
				$mail->Subject = 'VAM system - Flight validation ' . $va_name . '  '.  $departure . '-'. $arrival;
				$mail->Body = 'Dear Pilot <p> Your flight from ' . $departure . ' to ' .$arrival . ' has been  ' .$validation.'.<P>'.'Validator comments:' . $comment;
				$mail->AltBody = 'Dear Pilot <p> Your flight from ' . $departure . ' to ' .$arrival . ' has been  ' .$validation.'.<P>'.'Validator comments:' . $comment;
				if (!$mail->send()) {
					echo 'Message could not be sent';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo ' ';
				}
			}
		}
		function mail_validation_compose($pilot,$action,$departure,$arrival,$comment)
		{
			include('db_login.php');
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			$sql = "select * from gvausers where gvauser_id=".$pilot;
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$email_address = $row["email"];
				$accept_emails = $row["accept_emails"];
			}
			$sql = "select * from va_parameters";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$va_name = $row["va_name"];
			}
			$sql = "select * from config_emails";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$staff_email = $row["staff_email"];
				$ceo_email = $row["ceo_email"];
				$cc_email_1 = $row["cc_email_1"];
				$register_text = $row["register_text"];
			}
			if ($accept_emails==1)
			{
				switch ($action) {
			    case "acceptflight":
			        $validation="VALIDATED";
			        break;
			    case "rejectflight":
			        $validation="REJECTED";
			        break;
				}
				$mail = new PHPMailer;
				$mail->From = $staff_email;
				$mail->FromName = $va_name . ' VAM system';
				$mail->addAddress($email_address);               // Name is optional
				$mail->isHTML(true);
				$mail->Subject = 'VAM system - Flight validation ' . $va_name . '  '.  $departure . '-'. $arrival;
				$mail->Body = 'Dear Pilot <p> Your flight from ' . $departure . ' to ' .$arrival . ' has been  ' .$validation.'.<P>Email automatically generated by Virtual Airlines Manager system';
				$mail->AltBody = 'Dear Pilot <p> Your flight from ' . $departure . ' to ' .$arrival . ' has been  ' .$validation.'.<P>';
				if (!$mail->send()) {
					echo 'Message could not be sent';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo ' ';
				}
			}
		}
		function mail_flight_report_compose($pilot,$type,$departure,$arrival)
		{
			if ($type=='FSKEEPER PIREP')
			{
				include('../db_login.php');
			}
			else
			{
				include('db_login.php');
			}
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			$sql = "select * from gvausers where gvauser_id=$pilot";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$callsign = $row["callsign"];
				$pilot_name = $row["name"].' '. $row["surname"];
			}
			$sql = "select * from va_parameters";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$va_name = $row["va_name"];
			}
			$sql = "select * from config_emails";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$staff_email = $row["staff_email"];
				$ceo_email = $row["ceo_email"];
				$cc_email_1 = $row["cc_email_1"];
			}
				switch ($type) {
			    case "acceptflight":
			        $validation="VALIDATED";
			        break;
			    case "rejectflight":
			        $validation="REJECTED";
			        break;
				}
				$mail = new PHPMailer;
				$mail->From = $staff_email;
				$mail->FromName = $va_name . ' VAM system';
				$mail->addAddress($staff_email);               // Name is optional
				$mail->isHTML(true);
				$mail->Subject = 'VAM system - New '. $type . ' Flight reported ' . $callsign . '  '.  $departure . '-'. $arrival;
				$mail->Body = 'Dear staff team <p> A flight from ' . $departure . ' to ' .$arrival . ' has been  reported.<P>Pilot:'.$callsign.' - '. $pilot_name.'<P>Email automatically generated by Virtual Airlines Manager system';
				$mail->AltBody = 'Dear staff team <p> A flight from ' . $departure . ' to ' .$arrival . ' has been  rerported';
				if (!$mail->send()) {
					echo 'Message could not be sent';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo ' ';
				}
		}
		function mail_warning_inac_pilot_compose($pilot,$action)
		{
			$callsign = '';
			$pilot_name = '';
			$emil = '';
			$va_name = '';
			$staff_email = '';
			$ceo_email = '';
			$cc_email_1 = '';
			$Subject = '';
			$body = '';
			include('db_login.php');
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			$sql = "select * from gvausers where gvauser_id=$pilot";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$callsign = $row["callsign"];
				$pilot_name = $row["name"].' '. $row["surname"];
				$email= $row["email"];
			}
			$sql = "select * from va_parameters";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$va_name = $row["va_name"];
			}
			$sql = "select * from config_emails";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$staff_email = $row["staff_email"];
				$ceo_email = $row["ceo_email"];
				$cc_email_1 = $row["cc_email_1"];
				$warning_text = $row["warning_text"];
				$inactivate_text = $row["inactivate_text"];
			}
			if ($action==1){
				$Subject = $va_name.' VAM system - Pilot Inactivity Warning';
				$body = $warning_text;
			}
			else
			{
				$Subject=$va_name.' VAM system - Pilot Inactivation Notification';
				$body = $inactivate_text;
			}
			$mail = new PHPMailer;
			$mail->From = $staff_email;
			$mail->FromName = $va_name . ' VAM system';
			$mail->addAddress($staff_email);               // Name is optional
			$mail->addAddress($email);
			$mail->isHTML(true);
			$mail->Subject = $Subject;
			$mail->Body = $body;
			$mail->AltBody = $body;
			if (!$mail->send()) {
				echo 'Message could not be sent';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo ' ';
			}
		}
	}
?>

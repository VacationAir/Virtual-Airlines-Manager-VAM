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
	$callsign = strtoupper($_POST['callsign']);
	$email = strtoupper($_POST['email']);
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = 'select * from gvausers where UPPER(callsign)="' . $callsign . '" and UPPER(email)="' . $email . '"';
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
}
	else
	{
	$number_of_rows = $result->num_rows;
	if ($number_of_rows > 0)
	{
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$cad = "";
	for ($i = 0 ; $i < 12 ; $i++) {
		$cad .= substr($str , rand(0 , 62) , 1);
	}
	$con_encriptada = md5($cad);
	// update the password
	$sql = 'UPDATE gvausers SET password="' . $con_encriptada . '" where UPPER(callsign)="' . $callsign . '" and UPPER(email)="' . $email . '"';
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$db->close();
	// Send mail to the pilot
	$mail = new vam_mailer();
	$mail->mail_password_compose($email , $cad);
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo PASSWORD_RESET_OK; ?></div>
			<div class="alert alert-success" role="alert"><?php echo PASSWORD_RESET_OK_MSG; ?></div>
		<div>
	<div>
<div>
<?php
	}
	else
	{
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo PASSWORD_RESET_WRONG; ?></div>
			<div class="alert alert-danger"
			     role="alert"><?php echo PASSWORD_RESET_WRONG_MSG; ?></div>
		<div>
	<div>
<div>
<?php
	}
}
?>

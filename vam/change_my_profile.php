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
	include('processupload.php');
	require('check_login.php');
	if (is_logged())
	{
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$ivao = $_POST['ivao'];
		$vatsim = $_POST['vatsim'];
		$city = $_POST['city'];
		$hub = $_POST['hub'];
		$language = $_POST['language'];
		$pass = mysqli_real_escape_string($db , $_POST['password']);
		$country = $_POST['country'];
		$accept_emails = $_POST['accept_emails'];
		if ($_POST["password"]) {
		$encryptpassword = md5($pass);
		echo '<br>';
		$query = "update gvausers set language='$language' , hub_id=$hub, name='$name', surname='$surname',email='$email',ivaovid='$ivao',vatsimid='$vatsim',city='$city',country='$country',password='$encryptpassword' , accept_emails='$accept_emails' where gvauser_id=$id";
		$_SESSION["language"] = $language;
		if (!$result = $db->query($query)) {
		die('There was an error running the query [' . $db->error . ']');
		} else {
			?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo MY_PROFILE; ?></div>
							<div class="alert alert-success" role="alert"><?php echo MY_PROFILE_UPDATED; ?></div>
						<div>
					<div>
				<div>
				<?php
			}
		}
		$db->close();
	}
	else
	{
		include("./notgranted.php");
	}
?>

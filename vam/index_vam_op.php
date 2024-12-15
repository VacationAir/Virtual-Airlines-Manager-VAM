<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licensed under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php
	session_start();
	if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['languages'] = "en";
	}
	include("./languages/lang_" . $_SESSION['language'] . ".php");
	include('db_login.php');
	include('./languagesdd.php');
	include('classes/security.php');
	include('./va_parameters.php');
	include('./get_va_data.php');
	include('./main_vam_op.php');
	$secure = new SECURITY();
	$secure->parse_incoming();
	$id = $_SESSION["id"];
	if ($id == '') {
		header("Location: ./index.php?page=nosession");
		die();
	}
?>
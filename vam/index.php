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
	include("captcha/simple-php-captcha.php");
	$_SESSION['captcha'] = simple_php_captcha();
	if (isset ($_GET['lang']))
	{
		$_SESSION['language'] = $_GET['lang'];
	}
	if (isset($_SESSION['id'])) {
		$user_logged = 1;
	} else {
		$user_logged = 0;
	}
	if (!isset($_GET['lang']) && $_SESSION['language'] == '') {
		$_SESSION['language'] = "en";
	}
	if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['languages'] = "en";
	}
	include("./languages/lang_" . $_SESSION['language'] . ".php");
	include('db_login.php');
	include('./languagesdd.php');
	include('classes/class_vam_mailer.php');
	include('classes/security.php');
	include('./va_parameters.php');
	include('./get_va_index_data.php');
	include('./get_va_data.php');
	include('./get_va_parameters.php');
	include('./main_index.php');
	include('hangar_review.php');
	include('review_reserves.php');
	$secure = new SECURITY();
	$secure->parse_incoming();
?>
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

	$id = $_SESSION["id"];
	if ($id == '') {
		echo '<meta http-equiv="refresh" content="0; url=./index.php" />';		
	}
	 $usertype =$_SESSION["usertype"];
	if ($usertype != '3') {
		echo '<meta http-equiv="refresh" content="0; url=./index.php" />';
		
	}

?>

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
	session_start();
	session_unset();
	unset($_SESSION["id"]);
	unset($_SESSION["callsign"]);
	unset($_SESSION["language"]);
	unset($_SESSION["usertype"]);
	session_destroy();
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index.php?lang=en">'
?>
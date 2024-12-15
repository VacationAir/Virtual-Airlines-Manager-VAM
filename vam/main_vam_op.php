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
	include('vam_header.php');
	include('get_pilot_data.php');
	include('./get_va_parameters.php');
	require_once ('./helpers/conversions.php');
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
	} else {
			$Existe = file_exists($_GET["page"] . ".php");
			if ($Existe == true) {
				include($_GET["page"] . ".php");
			} else {
				echo "Page Not Found";
			}
		}
	?>
</div>
<br>
<?php include('footer.php');?>
</body>
</html>

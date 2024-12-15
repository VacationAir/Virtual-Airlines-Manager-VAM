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

	/* Connect to Database */

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	// Execute SQL query
	$total_amount=0;
	$sql = "select sum(amount) as total_amount from va_finances where report_id='$vamflightid' order by 1 desc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	while ($row2 = $result->fetch_assoc()) {
		$total_amount=$row2['total_amount'];
	}

	$sql = "select va_finances_id, description, amount from va_finances where report_id='$vamflightid' order by 1 desc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

?>

<div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">

			<!-- Table -->

			<table class="table table-hover">

				<?php
					if ( mysqli_num_rows ( $result ) >0)
					{
					while ($row2 = $result->fetch_assoc()) {
						echo '<tr><td>' . $row2['description'] . ' </td> <td>'. number_format($row2['amount'],2).'</td></tr>';
					}
					
					if ($total_amount>0)														
					{
						echo '<tr><td class="success">' . 'TOTAL'. ' </td> <td class="success">'.number_format($total_amount,2).'</td></tr>';
					}
					else
					{
						echo '<tr><td class="danger">' . 'TOTAL'. ' </td> <td class="danger">'.number_format($total_amount,2).'</td></tr>';
					}
						
					}
				?>
			</table>

		</div>

	</div>

</div>


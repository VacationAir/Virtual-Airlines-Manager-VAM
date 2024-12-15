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
	$sql = "select sum(amount) as total_amount from va_finances";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	while ($row = $result->fetch_assoc()) {
		$total_amount=$row['total_amount'];
	}

	$sql = "SELECT parameter_id,financial_parameter,sum(vaf.amount) as vaf_amount FROM  va_finances vaf inner join financial_parameters fp on vaf.parameter_id = fp.id where is_cost=1 group by parameter_id,financial_parameter";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT parameter_id,financial_parameter,sum(vaf.amount) as vaf_amount FROM  va_finances vaf inner join financial_parameters fp on vaf.parameter_id = fp.id where is_profit=1 group by parameter_id,financial_parameter";
	if (!$result2= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT 'Cargo in regular routes' as des,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99998) group by parameter_id";
	if (!$result3= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT 'PAX in regular routes' as des,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99999) group by parameter_id";
	if (!$result4= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT description,vaf.amount as vaf_amount FROM  va_finances vaf  where vaf.parameter_id =0 and report_type='New Aircraft'";
	if (!$result5= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	$sql = "SELECT 'Pilots Flight Salary' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99995) group by parameter_id";
	if (!$result6= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	$sql = "SELECT 'Aircraft Maintenance' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99997) group by parameter_id";
	if (!$result7= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	$sql = "SELECT 'Aircraft Repair' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99996) group by parameter_id";
	if (!$result8= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
?>

<div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading"><?php echo VA_GLOBAL_FINANCES; ?></div>

			<!-- Table -->

			<table class="table table-hover">

				<?php
					echo '<td class="warning">' . COSTS. ' </td> <td class="warning"></td></tr>';
					while ($row = $result->fetch_assoc()) {
						echo '<td>' . $row['financial_parameter'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}
					echo '<td class="warning">' . INCOME. ' </td> <td class="warning"></td></tr>';
					while ($row = $result2->fetch_assoc()) {
						echo '<td>' . $row['financial_parameter'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}
					echo '<td class="warning">' . INCOME_REGULAR_ROUTES. ' </td> <td class="warning"></td></tr>';
					while ($row = $result3->fetch_assoc()) {
						echo '<td>' . $row['des'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}
					while ($row = $result4->fetch_assoc()) {
						echo '<td>' . $row['des'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}
					echo '<td class="warning">' . AIRCRAFT_PURCHASE. ' </td> <td class="warning"></td></tr>';
					while ($row = $result5->fetch_assoc()) {
						echo '<td>' . $row['description'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}
					echo '<td class="warning">' . COSTS_PILOTS_SALARY. ' </td> <td class="warning"></td></tr>';
					while ($row = $result6->fetch_assoc()) {
						echo '<td>' . $row['description'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}	
					echo '<td class="warning">' . COSTS_AIRCRAFT_MAINTENANCE. ' </td> <td class="warning"></td></tr>';
					while ($row = $result7->fetch_assoc()) {
						echo '<td>' . $row['description'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}	
					echo '<td class="warning">' . COSTS_AIRCRAFT_REPAIR. ' </td> <td class="warning"></td></tr>';
					while ($row = $result8->fetch_assoc()) {
						echo '<td>' . $row['description'] . ' </td> <td>'. number_format($row['vaf_amount'],2).'</td></tr>';
					}	

					if ($total_amount>0)														
					{
						echo '<td class="success">' . FINANCE_BALANCE. ' </td> <td class="success">'.number_format($total_amount,2).'</td></tr>';
					}
					else
					{
						echo '<td class="danger">' . FINANCE_BALANCE. ' </td> <td class="danger">'.number_format($total_amount,2).'</td></tr>';
					}
					


					
					echo '</table>';
				?>

		</div>

	</div>

</div>


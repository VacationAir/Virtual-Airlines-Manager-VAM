<?php
	/*--HEADER--------------------------------------------------------------------------*/
	/*                                                                                  */
	/*    Project   : Live ACARS Demo PIREP Service v3.0.1                              */
	/*    Author    : Thomas Molitor                                                    */
	/*    Company   : Thomas Molitor EDV Service                                        */
	/*    Copyright : Copyright � 2002-2009 Thomas Molitor                              */
	/*                                                                                  */
	/*    Notes:                                                                        */
	/*                                                                                  */
	/*                                                                                  */
	/*                                                                                  */
	/*--END-----------------------------------------------------------------------------*/
	function convert_timestamp($timestamp)
	{
		$timestring = substr($timestamp , 0 , 4) . '-' . substr($timestamp , 4 , 2) . '-' . substr($timestamp , 6 , 2) . ' ' .
			substr($timestamp , 8 , 2) . ':' . substr($timestamp , 10 , 2) . ':' . substr($timestamp , 12 , 2);
		return strtotime($timestring);
	}
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0" , false);
	header("Pragma: no-cache");
	/* Connect to Database */
	$link = mysql_connect("host" , "user" , "password") or die("SQL Server connection failed.");
	mysql_select_db("ddb2575") or die("Database connection failed.");
	// Execute SQL query
	$query = "SELECT IDPIREP, CreatedOn, IDPilot, PilotName, Airline, FlightNumber, OriginAirport, DestinationAirport, BlockTime, OFFTime, FlightFuel from pirepfsfk ORDER BY CreatedON DESC";
	$result = mysql_query($query) or die("SQL query failed.");
	if (mysql_num_rows($result) == 0) die("There are currently no PIREPs available.");
?>
<html>
<head>
	<meta http-equiv="Content-Language" content="en-us">
	<title>FS Flight Keeper - PIREPs Overview</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Expires" content="0">
	<style type="text/css">
		<!--
		tr {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 9px;
		}
		-->
	</style>
</head>
<body>
<font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>PIREPs Overview</strong></font>
<br><br>
<table width="1024" border="0" cellpadding="4" cellspacing="0" bordercolor="#FFFFFF">
	<tr bordercolor="#FFFFFF" bgcolor="#00CCFF">
		<td width="80"><font color="#333333"><strong>Filed On</strong></font></td>
		<td width="110"><font color="#333333"><strong>Flight</strong></font></td>
		<td width="180"><font color="#333333"><strong>Pilot</strong></font></td>
		<td width="352"><font color="#333333"><strong>From - To </strong></font></td>
		<td width="55">
			<div align="center"><font color="#333333"><strong>Block Time</strong></font></div>
		</td>
		<td width="111">
			<div align="center"><font color="#333333"><strong>OFF Time</strong></font></div>
		</td>
		<td width="80">
			<div align="center"><font color="#333333"><strong>Flight Fuel (lbs) </strong></font></div>
		</td>
	</tr>
	<?php
		$i = 0;
		while ($row = mysql_fetch_object($result)) {
			?>
			<?php if (fmod($i , 2) == 0) {
				print "<tr bordercolor=\"#FFFFFF\" bgcolor=\"#FFFFCC\">";
			} else {
				print "<tr bordercolor=\"#FFFFFF\" bgcolor=\"#FFCC99\">";
			}
			?>
			<td><?php print date("d.m.Y" , convert_timestamp($row->CreatedOn)); ?></td>
			<td><a href="PIREPDetails.php?ID=<?php print $row->IDPIREP; ?>"
			       target="PIREP_DETAILS"><?php print $row->Airline . " " . $row->FlightNumber; ?></a></td>
			<td><?php print $row->PilotName . " (" . $row->IDPilot . ")"; ?></td>
			<td>
				<?php
					/* ### Changed v2.6 ### */
					print $row->OriginAirport;
					if (strlen($row->DestinationAirport) != 0) print "&nbsp; <b>-></b> &nbsp;" . $row->DestinationAirport;
				?>
			</td>
			<td>
				<div align="center"><?php print $row->BlockTime; ?></div>
			</td>
			<td>
				<div align="center"><?php print $row->OFFTime; ?></div>
			</td>
			<td>
				<div align="center"><?php print number_format($row->FlightFuel , 0 , "," , "."); ?></div>
			</td>
			</tr>
			<?php
			$i = $i + 1;
		}
	?>
</table>
</font>
</body>
</html>
<?php
	// Close connection
	mysql_close($link);
?>

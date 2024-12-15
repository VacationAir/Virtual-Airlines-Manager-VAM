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
	if (!isset($_REQUEST["ID"])) die("There is no PIREP ID given.");
	$pirepfsfk_id = $_REQUEST["ID"];
	/* Connect to Database */
	$link = mysql_connect("localhost" , "xxxxx" , "xxxxx") or die("SQL Server connection failed.");
	mysql_select_db("xxxxx") or die("Database connection failed.");
	// Execute SQL query
	$query = "SELECT * from pirepfsfk WHERE pirepfsfk_id = '" . $pirepfsfk_id . "'";
	$result = mysql_query($query) or die("SQL query failed.");
	if (mysql_num_rows($result) == 0) die("There is no PIREP with the given ID.");
	$row = mysql_fetch_object($result)
?>
<html>
<head>
	<meta http-equiv="Content-Language" content="en-us">
	<title>FS Flight Keeper - PIREP Details</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Expires" content="0">
	<style type="text/css">
		<!--
		tr {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
		}
		-->
	</style>
</head>
<body>
<p>
	<font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Detalles del vuelo</strong></font>
	<br><br>
<table width="800" border="1" cellpadding="4" cellspacing="0">
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Estado del reporte</strong></font></td>
	<td colspan="4"><strong><font color="#333333">Piloto </font></strong></td>
	<!--<td colspan="2"><strong><font color="#333333">Pilot ID </font></strong></td> -->
</tr>
<tr>
	<td colspan="3"><?php if ($row->Validado == 0) print 'En tramite';
			if ($row->Validado == 1) print 'Validado';
			if ($row->Validado == 2) print 'No aceptado'; ?></td>
	<td colspan="4"><?php print $row->PilotName ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Aeronave</strong></font></td>
	<td colspan="2"><font color="#333333"><strong>Tipo de aeronave</strong></font></td>
	<td width="135"><font color="#333333"><strong>Marticula</strong></font></td>
	<td width="81"><font color="#333333"><strong>Tipo de vuelo</strong></font></td>
</tr>
<tr>
	<td colspan="3"><?php print $row->AircraftTitle . "&nbsp;" ?></td>
	<td colspan="2"><?php print $row->AircraftType . "&nbsp;" ?></td>
	<td width="135"><?php print $row->TailNumber . "&nbsp;" ?></td>
	<td width="81"><?php print $row->FlightType . "&nbsp;" ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Aerolinea</strong></font></td>
	<td colspan="2"><font color="#333333"><strong>Nivel de vuelo</strong></font></td>
	<td width="135"><font color="#333333"><strong>POB</strong></font></td>
	<td width="81"><font color="#333333"><strong>Cargo</strong></font></td>
</tr>
<tr>
	<td colspan="3"><?php print $row->Airline . "&nbsp;" ?></td>
	<td colspan="2"><?php print $row->FlightLevel . "&nbsp;" ?></td>
	<td width="135"><?php print $row->Passenger . "&nbsp;" ?></td>
	<td width="81"><?php print $row->Cargo . "&nbsp;" ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="2"><font color="#333333"><strong>Origen</strong></font></td>
	<td width="136"><font color="#333333"><strong>Gate</strong></font></td>
	<td colspan="2"><font color="#333333"><strong>Runway</strong></font></td>
	<td width="135"><font color="#333333"><strong>SID</strong></font></td>
	<td width="81"><font color="#333333"><strong>Transition</strong></font></td>
</tr>
<tr>
	<td colspan="2"><?php print $row->OriginAirport . "&nbsp;" ?></td>
	<td width="136"><?php print $row->OriginGate . "&nbsp;" ?></td>
	<td colspan="2"><?php print $row->OriginRunway . "&nbsp;" ?></td>
	<td width="135"><?php print $row->SID . "&nbsp;" ?></td>
	<td width="81"><?php print $row->OriginTA . "&nbsp;" ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="2"><font color="#333333"><strong>Destino</strong></font></td>
	<td width="136"><font color="#333333"><strong>Gate</strong></font></td>
	<td colspan="2"><font color="#333333"><strong>Runway</strong></font></td>
	<td width="135"><font color="#333333"><strong>STAR</strong></font></td>
	<td width="81"><font color="#333333"><strong>Transition</strong></font></td>
</tr>
<tr>
	<td colspan="2"><?php print $row->DestinationAirport . "&nbsp;" ?></td>
	<td width="136"><?php print $row->DestinationGate . "&nbsp;" ?></td>
	<td colspan="2"><?php print $row->DestinationRunway . "&nbsp;" ?></td>
	<td width="135"><?php print $row->STAR . "&nbsp;" ?></td>
	<td width="81"><?php print $row->DestinationTA . "&nbsp;" ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="7"><font color="#333333"><strong>Alternativo</strong></font></td>
</tr>
<tr>
	<td colspan="7"><?php print $row->AlternateAirport . "&nbsp;" ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="7"><font color="#333333"><strong>ZFW (Kg) </strong></font></td>
</tr>
<tr>
	<td colspan="7"><?php print number_format(($row->ZFW) / 2.2 , 0 , "," , "."); ?></td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Time OUT </strong></font></td>
	<td colspan="2"><font color="#333333"><strong>Time OFF </strong></font></td>
	<td colspan="2"><font color="#333333"><strong>Takeoff IAS (kts)</strong></font></td>
</tr>
<tr>
	<td colspan="3"><?php print $row->OUTTime ?></td>
	<td colspan="2"><?php print $row->OFFTime ?></td>
	<td colspan="2"><?php print $row->TakeoffIAS ?></td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="2"><font color="#333333"><strong>Time ON </strong></font></td>
	<td><font color="#333333"><strong>Landing IAS (kts)</strong></font></td>
	<td colspan="3"><font color="#333333"><strong>Time IN </strong></font><font color="#333333">&nbsp;</font></td>
	<td><font color="#333333"><strong>Landing VS (ft/min)</strong></font></td>
</tr>
<tr>
	<td colspan="2"><?php print $row->ONTime ?></td>
	<td><?php print $row->LandingIAS ?></td>
	<td colspan="3"><?php print $row->INTime ?></td>
	<td><?php print $row->LandingVS ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Block Time</strong></font></td>
	<td colspan="4"><font color="#333333"><strong>Block Fuel (Kg)</strong></font></td>
</tr>
<tr>
	<td colspan="3"><?php print $row->BlockTime ?></td>
	<td colspan="4"><?php print number_format(($row->BlockFuel) / 2.2 , 0 , "," , "."); ?></td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Tiempo de vuelo</strong></font></td>
	<td colspan="4"><font color="#333333"><strong>Consumo de combustible (Kg)</strong></font></td>
</tr>
<tr>
	<td colspan="3"><?php print $row->FlightTime ?></td>
	<td colspan="4"><?php print number_format(($row->FlightFuel) / 2.2 , 0 , "," , "."); ?></td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Day Flight Time</strong></font></td>
	<td colspan="4"><font color="#333333"><strong>Night Flight Time </strong></font></td>
</tr>
<tr>
	<td colspan="3"><?php print $row->DayFlightTime ?></td>
	<td colspan="4"><?php print $row->NightFlightTime ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<tr bgcolor="#F4973A">
	<td colspan="3"><font color="#333333"><strong>Distancia del vuelo (nm)</strong></font></td>
	<td colspan="4"><font color="#333333"><strong>distancia planeada (nm) </strong></font></td>
</tr>
<tr>
	<td colspan="3"><?php print $row->DistanceFlight ?></td>
	<td colspan="4"><?php print $row->DistanceRoute ?></td>
</tr>
<tr>
	<td colspan="7">&nbsp;</td>
</tr>
<?php if (strlen($row->FlightPlan) > 0) { ?>
	<tr bgcolor="#F4973A">
		<td colspan="7"><font color="#333333"><strong>Ruta</strong></font></td>
	</tr>
	<tr bgcolor="#CCCCCC">
		<td width="55"><font color="#333333"><strong>Nr.</strong></font></td>
		<td width="147"><font color="#333333"><strong>Name</strong></font><font color="#333333">&nbsp;</font><font
				color="#333333">&nbsp;</font></td>
		<td><font color="#333333"><strong>Type</strong></font></td>
		<td width="95" bgcolor="#CCCCCC">
			<div align="center"><font color="#333333"><strong>Time</strong></font></div>
		</td>
		<td width="95" bgcolor="#CCCCCC">
			<div align="center"><font color="#333333"><strong>Fuel (Kg) </strong></font></div>
		</td>
		<td width="135" bgcolor="#CCCCCC">
			<div align="center"><font color="#333333"><strong>IAS (kts) </strong></font></div>
		</td>
		<td width="81" bgcolor="#CCCCCC">
			<div align="center"><font color="#333333"><strong>Alt (ft) </strong></font></div>
		</td>
	</tr>
	<?php
	$arData = split("\n" , $row->FlightPlan);
	for ($i = 0 ; $i <= count($arData) - 1 ; $i++) {
		//Number|Name|Type|Time|Fuel|IAS|Alitude|Heading|Wind|OAT
		//  0   |  1 |  2 |  3 |  4 | 5 |   6   |   7   |  8 | 9
		$arEntry = split("\|" , trim($arData[$i]));
		if (count($arEntry) >= 6) {
			?>
			<?php if (fmod($i , 2) == 0) { ?>
				<tr bgcolor="#FFFFCC">
			<?php } else { ?>
				<tr bgcolor="#EEEEEE">
			<?php } ?>
			<?php if ($arEntry[3] == "00:00" && $arEntry[4] == "0" && $arEntry[5] == "0" && $arEntry[6] == "0" && $arEntry[7] == "0" && $arEntry[8] == "0/0" && $arEntry[9] == "0") { ?>
				<td width="55">
					<div align="center"><?php print $arEntry[0] ?></div>
				</td>
				<td><?php print $arEntry[1] ?></td>
				<td><?php print $arEntry[2] ?></td>
				<td width="95">
					<div align="center">NA</div>
				</td>
				<td width="95">
					<div align="center">NA</div>
				</td>
				<td width="135">
					<div align="center">NA</div>
				</td>
				<td width="81">
					<div align="center">NA</div>
				</td>
			<?php } else { ?>
				<td width="55">
					<div align="center"><?php print $arEntry[0] ?></div>
				</td>
				<td><?php print $arEntry[1] ?></td>
				<td><?php print $arEntry[2] ?></td>
				<td width="95">
					<div align="center"><?php print $arEntry[3] ?></div>
				</td>
				<td width="95">
					<div align="center"><?php print number_format($arEntry[4] , 0 , "," , ".") ?></div>
				</td>
				<td width="135">
					<div align="center"><?php print $arEntry[5] ?></div>
				</td>
				<td width="81">
					<div align="center"><?php print $arEntry[6] ?></div>
				</td>
			<?php } ?>
			</tr>
		<?php
		}
	}
	?>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
<?php } ?>
<?php if (strlen($row->Comment) > 0) { ?>
	<tr bgcolor="#F4973A">
		<td colspan="7"><font color="#333333"><strong>Comentarios</strong></font></td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td colspan="7"><font size="2"
		                      face="Courier New, Courier, mono"><?php print str_replace(" " , "&nbsp;" , str_replace("\n" , "<br>" , str_replace("\r" , "" , $row->Comment))); ?></font>
		</td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
<?php } ?>
<?php if (strlen($row->FlightCritique) > 0) { ?>
	<tr bgcolor="#F4973A">
		<td colspan="7"><font color="#333333"><strong>Evaluaci�n del vuelo</strong></font></td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td colspan="7"><font size="2"
		                      face="Courier New, Courier, mono"><?php print str_replace(" " , "&nbsp;" , str_replace("\n" , "<br>" , str_replace("\r" , "" , $row->FlightCritique))); ?></font>
		</td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
<?php } ?>
<tr bgcolor="#F4973A">
	<td colspan="7"><font color="#333333"><strong>Mapas de vuelo</strong></font></td>
</tr>
<?php if (strlen($row->FlightMapJPG) > 0) { ?>
	<tr bgcolor="#CCCCCC">
		<td colspan="7"><font color="#333333"><strong>
					<center>Flight Route</center>
				</strong></font></td>
	</tr>
	<tr bgcolor="#888888">
		<td colspan="7" align="center" valign="middle"><img
				src="FSFK/Images/PIREP/<?php print $row->FlightMapJPG; ?>" width="800" height="529"></td>
	</tr>
<?php } ?>
<?php if (strlen($row->FlightMapWeatherJPG) > 0) { ?>
	<tr bgcolor="#CCCCCC">
		<td colspan="7"><font color="#333333"><strong>
					<center>Flight Weather</center>
				</strong></font></td>
	</tr>
	<tr bgcolor="#888888">
		<td colspan="7" align="center" valign="middle"><img
				src="FSFK/Images/PIREP/<?php print $row->FlightMapWeatherJPG; ?>" width="800" height="529"></td>
	</tr>
<?php } ?>
<?php if (strlen($row->FlightMapTaxiOutJPG) > 0) { ?>
	<tr bgcolor="#CCCCCC">
		<td colspan="7"><font color="#333333"><strong>
					<center>Taxi Route Origin</center>
				</strong></font></td>
	</tr>
	<tr bgcolor="#888888">
		<td colspan="7" align="center" valign="middle"><img
				src="FSFK/Images/PIREP/<?php print $row->FlightMapTaxiOutJPG; ?>" width="800" height="529"></td>
	</tr>
<?php } ?>
<?php if (strlen($row->FlightMapTaxiInJPG) > 0) { ?>
	<tr bgcolor="#CCCCCC">
		<td colspan="7"><font color="#333333"><strong>
					<center>Taxi Route Destination</center>
				</strong></font></td>
	</tr>
	<tr bgcolor="#888888">
		<td colspan="7" align="center" valign="middle"><img
				src="FSFK/Images/PIREP/<?php print $row->FlightMapTaxiInJPG; ?>" width="800" height="529"></td>
	</tr>
<?php } ?>
<?php if (strlen($row->FlightMapVerticalProfileJPG) > 0) { ?>
	<tr bgcolor="#CCCCCC">
		<td colspan="7"><font color="#333333"><strong>
					<center>Vertical Profile</center>
				</strong></font></td>
	</tr>
	<tr bgcolor="#888888">
		<td colspan="7" align="center" valign="middle"><img
				src="FSFK/Images/PIREP/<?php print $row->FlightMapVerticalProfileJPG; ?>" width="800" height="529">
		</td>
	</tr>
<?php } ?>
<?php if (strlen($row->FlightMapLandingProfileJPG) > 0) { ?>
	<tr bgcolor="#CCCCCC">
		<td colspan="7"><font color="#333333"><strong>
					<center>Approach/ILS Profile</center>
				</strong></font></td>
	</tr>
	<tr bgcolor="#888888">
		<td colspan="7" align="center" valign="middle"><img
				src="FSFK/Images/PIREP/<?php print $row->FlightMapLandingProfileJPG; ?>" width="800" height="529">
		</td>
	</tr>
<?php } ?>
</table>
</font>
</p>
</body>
</html>
<?php
	// Close connection
	mysql_close($link);
?>

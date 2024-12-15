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
	if (is_logged())
	{
		$id = $_SESSION["id"];
		chdir ('tmp_templates');
		$fskeeper_template = 'vam_fskeeper_'.$id.'.txt';
		$fp = fopen("$fskeeper_template", "w");
		$str= '[WEB_CONFIG]';
		fwrite($fp, $str . PHP_EOL);
		$str= 'ADDRESS=http://YOURDOMAIN/vam/FSFK/PIREPService.php';
		fwrite($fp, $str . PHP_EOL);
		$str= 'PORT=80';
		fwrite($fp, $str . PHP_EOL);
		$str= 'LOGIN_ENCODED=FALSE';
		fwrite($fp, $str . PHP_EOL);
		$str= 'USER='.$id;
		fwrite($fp, $str . PHP_EOL);
		$str= 'PASSWORD=';
		fwrite($fp, $str . PHP_EOL);
		$str= 'TIMEFORMAT=ZULU';
		fwrite($fp, $str . PHP_EOL);
		$str= 'DATETIME_FORMAT_STRING=dd\.mm\.yyyy HH\:nn';
		fwrite($fp, $str . PHP_EOL);
		$str= 'TIME_FORMAT_STRING=HH\:nn';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '[DATA]';
		fwrite($fp, $str . PHP_EOL);
		$str= '<FLIGHTDATA>';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$PilotID$@$~$@$PilotName$@$~$@$AircraftTitle$@$~$@$AircraftType$@$~$@$AircraftTailNumber$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$AircraftAirline$@$~$@$FlightNumber$@$~$@$FlightLevel$@$~$@$FlightType$@$~$@$Passenger$@$~$@$Cargo$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$ZFW$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$OriginICAO$@$~$@$OriginGate$@$~$@$OriginRunway$@$~$@$OriginTransitionAltitude$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$DestinationICAO$@$~$@$DestinationGate$@$~$@$DestinationRunway$@$~$@$DestinationTransitionAltitude$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$AlternateICAO$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$SID$@$~$@$STAR$@$~$@$FlightDistance$@$~$@$RouteDistance$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$OUTTime$@$~$@$OFFTime$@$~$@$ONTime$@$~$@$INTime$@$~$@$DayFlightTime$@$~$@$NightFlightTime$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$BlockTime$@$~$@$FlightTime$@$~$@$BlockFuel$@$~$@$FlightFuel$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$TOIAS$@$~$@$LAIAS$@$~$@$ONVS$@$~';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$FlightScore$@$';
		fwrite($fp, $str . PHP_EOL);
		$str= '</FLIGHTDATA>';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '<FLIGHTPLAN>$@$FlightPlan$@$</FLIGHTPLAN>';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '<COMMENT>$@$Comment$@$</COMMENT>';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '<FLIGHTCRITIQUE>$@$FlightCritique$@$</FLIGHTCRITIQUE>';
		fwrite($fp, $str . PHP_EOL);
		$str= '';
		fwrite($fp, $str . PHP_EOL);
		$str= '<FLIGHTMAPS>';
		fwrite($fp, $str . PHP_EOL);
		$str= '$@$FlightMapJPG$@$~$@$FlightMapWeatherJPG$@$~$@$FlightMapTaxiOutJPG$@$~$@$FlightMapTaxiInJPG$@$~$@$FlightMapVerticalProfileJPG$@$~$@$FlightMapLandingProfileJPG$@$';fwrite($fp, $str . PHP_EOL);
		fwrite($fp, $str . PHP_EOL);
		$str= '</FLIGHTMAPS>';
		fwrite($fp, $str . PHP_EOL);
		fclose($fp);
		// Creates zip file
		$zip = new ZipArchive;
		$fskeeper_zip = 'vam_fskeeper_'.$id.'.zip';
		$zip->open($fskeeper_zip,ZIPARCHIVE::CREATE);
		$zip->addFile($fskeeper_template);
		$zip->close();
		unlink($fskeeper_template);
	}
	else
	{
		include("./notgranted.php");
	}
?>

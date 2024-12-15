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
	// VAM 2.3 delete old templates BEGIN
	$dir = "/tmp_templates/";
	if (is_dir($dir)) {
		$handle = opendir($dir);
		while ($file = readdir($handle))
		{
			if (is_file($dir.$file))
			{
			  unlink($dir.$file);
		    }
		}
	}
	// VAM 2.3 delete old templates END
	$id = $_SESSION["id"];
	$fsacars_template = 'vam_fsacars_'.$id.'.ini';
	$fp = fopen("$fsacars_template", "w");
	$str= '[FSacars]';
	fwrite($fp, $str . PHP_EOL);
	$str= 'CompanyICAO=VAM';
	fwrite($fp, $str . PHP_EOL);
	$str= 'CompanyName=Virtual Airlines mamanager ALPHA 2.1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'CompanySite=http://YOURDOMAIN/vam/';
	fwrite($fp, $str . PHP_EOL);
	$str= 'UnitSystem=IS';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Remarks=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'UseLocal=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'PilotNumber=XX';
	fwrite($fp, $str . PHP_EOL);
	$str= 'CompanyIATA=VM';
	fwrite($fp, $str . PHP_EOL);
	$str= 'CallsignUses=Pilot';
	fwrite($fp, $str . PHP_EOL);
	$str= 'AcarsSite=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'AcarsUplinkSite=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'AcarsUplinkResetSite=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'StatusSite=http://YOURDOMAIN/vam/fsacars/receive_pirep.php';
	fwrite($fp, $str . PHP_EOL);
	$str= 'FPSite=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Antic=';
	fwrite($fp, $str . PHP_EOL);
	$str= '[Events]';
	fwrite($fp, $str . PHP_EOL);
	$str= 'UseCargo=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'FlapsEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'ToutchDownEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'TOLDPosEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'TOCTODEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'ComFreqEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'GearEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'FlightLengthEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'VrV2Event=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'FlightPosEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'N1Event=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'DurationEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'FuelEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'WeightEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'MetarsEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'DistLandEvent=1';
	fwrite($fp, $str . PHP_EOL);
	$str= '[Realism]';
	fwrite($fp, $str . PHP_EOL);
	$str= 'NoSlew=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'NoPause=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Crash=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'PIC=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'MinReset=0';
	fwrite($fp, $str . PHP_EOL);
	$str= 'MaxReset=0';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Wave=.\alert.WAV';
	fwrite($fp, $str . PHP_EOL);
	$str= '[Log]';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Log=http://YOURDOMAIN/vam/fsacars/receive_pirep.php';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Mail=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'URL=http://YOURDOMAIN/vam/fsacars/pilot_roster.php';
	fwrite($fp, $str . PHP_EOL);
	$str= 'passwd=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Log=';
	fwrite($fp, $str . PHP_EOL);
	$str= '[SendLog]';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Password=0';
	fwrite($fp, $str . PHP_EOL);
	$str= 'PilotNumber=XX';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Date=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Hour=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Callsign=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'IATAN=0';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Regist=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Depart=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Arrival=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Alternate=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'PlaneType=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'SpentFuel=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'IniFuel=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'EndFuel=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Dur=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Len=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'TD=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'ZFW=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Log=1';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Version=1';
	fwrite($fp, $str . PHP_EOL);
	$str= '[Log]';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Log=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'Mail=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'URL=';
	fwrite($fp, $str . PHP_EOL);
	$str= 'passwd=';
	fwrite($fp, $str . PHP_EOL);
	fwrite($fp, $str . PHP_EOL);
	fclose($fp);
	// Creates zip file
	$zip = new ZipArchive;
	$fsacars_zip = 'vam_fsacars_'.$id.'.zip';
	$zip->open($fsacars_zip,ZIPARCHIVE::CREATE);
	$zip->addFile($fsacars_template);
	$zip->close();
	unlink($fsacars_template);?>

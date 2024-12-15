<?php

	
$hostName = "localhost";
/* CHANGE THESE LINES TO YOUR DETAILS */
$userName = "";
$password = "";
$dbName = "";

/* make connection to database */
mysql_connect($hostName, $userName, $password) or die("Unable to connect to host $hostName");
mysql_select_db($dbName) or die("Unable to select database $dbName");

$lat = $_GET['lat'];
$long = $_GET['long'];
$gs = $_GET['GS'];
$alt = $_GET['Alt'];
$IATA = $_GET['IATA'];
$depAptICAO = $_GET['depaptICAO'];
$depApt = $_GET['depapt'];
$disDepApt = $_GET['disdepapt'];
$timeDepApt = $_GET['timedepapt'];
$destAptICAO = $_GET['destaptICAO'];
$destApt = $_GET['destapt'];
$disDestApt = $_GET['disdestapt'];
$timeDestApt = $_GET['timedestapt'];
$phase = $_GET['detailph'];
$pnum = $_GET['pnumber'];

if (!isset($gs)) $gs = 0;
if (!isset($alt)) $alt = 0;
if (!isset($disDepApt)) $disDepApt = 0;
if (!isset($disDestApt)) $disDestApt = 0;

$sql = "SELECT * FROM positions WHERE pilot_num='$pnum'";
$result = mysql_query( $sql );

/* mysql error */
if (!$result) {
    mysql_close();
    die("Error - Database Connection.");
}

if (mysql_num_rows($result) > 0) {
	/* Pilot found */
	// timestamp in case last_update='".date("m:d:Y H:i:s")."'
	$sql = "UPDATE positions SET pilot_num='$pnum', lat='$lat', lon='$long', gs=$gs, alt=$alt, IATA='$IATA', depAptICAO='$depAptICAO', depApt='$depApt', disDepApt=$disDepApt, timeDepApt='$timeDepApt', destAptICAO='$destAptICAO', destApt='$destApt', disDestApt=$disDestApt, timeDestApt='$timeDestApt', phase=$phase WHERE pilot_num='$pnum'";
} else {
    $values = "( NOW(), '$pnum', '$lat', '$long', $gs, $alt, '$IATA', '$depAptICAO', '$depApt', $disDepApt,'$timeDepApt', '$destAptICAO', '$destApt', $disDestApt, '$timeDestApt', $phase)";
    $sql = "INSERT INTO positions (last_update, pilot_num, lat, lon, gs, alt, IATA, depAptICAO, depApt, disDepApt, timeDepApt, destAptICAO, destApt, disDestApt, timeDestApt, phase) VALUES $values";
    print $sql."\n";
}

$result = mysql_query( $sql );
if (!$result) {
    mysql_close();
    die("Error updating position in database - Contact administrator.");
}

print "Position Updated";
    
/* Close the database connection */
mysql_close();
?>
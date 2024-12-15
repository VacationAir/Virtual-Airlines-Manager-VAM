
--
-- Estructura de tabla para la tabla `acars_flight`
--

DROP TABLE IF EXISTS `acars_flight`;
CREATE TABLE IF NOT EXISTS `acars_flight` (
  `acarsFlightID` int(10) unsigned NOT NULL DEFAULT '0',
  `userID` int(10) unsigned DEFAULT NULL,
  `acarsID` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `acType` varchar(20) DEFAULT NULL,
  `callsign` varchar(10) DEFAULT NULL,
  `flightType` varchar(4) DEFAULT 'IFR',
  `flightPlan` text,
  `departure` varchar(4) DEFAULT NULL,
  `destination` varchar(4) DEFAULT NULL,
  `alternate` varchar(4) DEFAULT NULL,
  `active` int(1) unsigned DEFAULT '1',
  `curPositionID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`acarsFlightID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acars_pirep`
--

DROP TABLE IF EXISTS `acars_pirep`;
CREATE TABLE IF NOT EXISTS `acars_pirep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timereport` int(11) DEFAULT NULL,
  `acarsid` int(11) DEFAULT NULL,
  `iduser` int(11) NOT NULL DEFAULT '0',
  `flightrot` varchar(10) DEFAULT NULL,
  `acicao` varchar(4) DEFAULT NULL,
  `flighttype` char(3) DEFAULT NULL,
  `departure` varchar(4) DEFAULT NULL,
  `destination` varchar(4) DEFAULT NULL,
  `alternate` varchar(4) DEFAULT NULL,
  `deptime` int(11) DEFAULT '0',
  `blocktime` int(11) DEFAULT NULL,
  `blockfuel` float DEFAULT NULL,
  `flighttime` int(11) DEFAULT NULL,
  `flightfuel` float DEFAULT NULL,
  `cruise` int(11) DEFAULT NULL,
  `pax` int(11) DEFAULT NULL,
  `cargo` float DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acars_position`
--

DROP TABLE IF EXISTS `acars_position`;
CREATE TABLE IF NOT EXISTS `acars_position` (
  `acarsReportID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acarsFlightID` int(10) unsigned NOT NULL DEFAULT '0',
  `acarsMsgID` varchar(10) DEFAULT NULL,
  `systemTime` bigint(20) NOT NULL DEFAULT '0',
  `remoteTime` bigint(20) NOT NULL DEFAULT '0',
  `msgtype` char(2) NOT NULL DEFAULT 'PR',
  `flightStatus` int(1) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT '0.000000',
  `longitude` decimal(10,6) DEFAULT '0.000000',
  `curWaypoint` varchar(5) DEFAULT NULL,
  `heading` smallint(3) DEFAULT NULL,
  `altitude` mediumint(6) DEFAULT NULL,
  `VS` mediumint(6) DEFAULT '0',
  `GS` smallint(4) DEFAULT NULL,
  `IAS` smallint(4) DEFAULT NULL,
  `TAS` smallint(4) DEFAULT NULL,
  `FOB` int(7) DEFAULT NULL,
  `WND` varchar(6) DEFAULT NULL,
  `OAT` int(3) DEFAULT NULL,
  `TAT` int(3) DEFAULT NULL,
  `distFromDep` int(11) DEFAULT NULL,
  `distTotal` int(11) DEFAULT NULL,
  `pauseMode` tinyint(1) DEFAULT '0',
  `message` text,
  PRIMARY KEY (`acarsReportID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `airports`
--

DROP TABLE IF EXISTS `airports`;
CREATE TABLE IF NOT EXISTS `airports` (
  `id` bigint(20) NOT NULL,
  `ident` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `latitude_deg` double NOT NULL,
  `longitude_deg` double NOT NULL,
  `elevation_ft` int(11) NOT NULL,
  `continent` varchar(10) NOT NULL,
  `iso_country` varchar(10) NOT NULL,
  `iso_region` varchar(10) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `scheduled_service` varchar(50) NOT NULL,
  `gps_code` varchar(6) NOT NULL,
  `iata_code` varchar(6) NOT NULL,
  `local_code` varchar(6) NOT NULL,
  `home_link` varchar(100) NOT NULL,
  `wikipedia_link` varchar(100) NOT NULL,
  `keywords` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gvauser_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pirep` bigint(20) DEFAULT NULL,
  `report` bigint(20) DEFAULT NULL,
  `pirepfsfk` varchar(255) DEFAULT NULL,
  `quantity` float NOT NULL DEFAULT '0',
  `jump` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancellations`
--

DROP TABLE IF EXISTS `cancellations`;
CREATE TABLE IF NOT EXISTS `cancellations` (
  `id` bigint(4) NOT NULL AUTO_INCREMENT,
  `route_id` bigint(20) NOT NULL,
  `gvauser_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_emails`
--

DROP TABLE IF EXISTS `config_emails`;
CREATE TABLE IF NOT EXISTS `config_emails` (
  `config_emails_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_email` varchar(100) NOT NULL,
  `ceo_email` varchar(100) NOT NULL,
  `cc_email_1` varchar(100) NOT NULL,
  `register_text` varchar(2000) NOT NULL,
  `inactivate_text` varchar(2000) NOT NULL,
  PRIMARY KEY (`config_emails_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country_t`
--

DROP TABLE IF EXISTS `country_t`;
CREATE TABLE IF NOT EXISTS `country_t` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) DEFAULT NULL,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(6) DEFAULT NULL,
  `un_member` varchar(12) DEFAULT NULL,
  `calling_code` varchar(8) DEFAULT NULL,
  `cctld` varchar(5) DEFAULT NULL,
  `spanish_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` date NOT NULL,
  `publish_date` date NOT NULL,
  `hide_date` date NOT NULL,
  `gvauser_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_text` varchar(2000) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fleets`
--

DROP TABLE IF EXISTS `fleets`;
CREATE TABLE IF NOT EXISTS `fleets` (
  `fleet_id` int(11) NOT NULL AUTO_INCREMENT,
  `fleettype_id` int(6) NOT NULL,
  `registry` varchar(10) NOT NULL,
  `value` bigint(20) NOT NULL,
  `location` varchar(4) NOT NULL,
  `hours` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '100',
  `booked` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `CTO` varchar(20) NOT NULL,
  `base` varchar(4) DEFAULT NULL,
  `hangar` tinyint(1) NOT NULL,
  `hangardate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fleet_id`),
  UNIQUE KEY `matricula` (`registry`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1032 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fleettypes`
--

DROP TABLE IF EXISTS `fleettypes`;
CREATE TABLE IF NOT EXISTS `fleettypes` (
  `fleettype_id` int(11) NOT NULL AUTO_INCREMENT,
  `plane_icao` varchar(10) NOT NULL,
  `plane_description` varchar(50) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`fleettype_id`),
  UNIQUE KEY `plane_icao_3` (`plane_icao`),
  KEY `plane_icao` (`plane_icao`),
  FULLTEXT KEY `plane_icao_2` (`plane_icao`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fleettypes_gvausers`
--

DROP TABLE IF EXISTS `fleettypes_gvausers`;
CREATE TABLE IF NOT EXISTS `fleettypes_gvausers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gvauser_id` int(11) NOT NULL,
  `fleettype_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fleettypes_routes`
--

DROP TABLE IF EXISTS `fleettypes_routes`;
CREATE TABLE IF NOT EXISTS `fleettypes_routes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `route_id` bigint(10) NOT NULL,
  `fleettype_id` int(10) NOT NULL,
  `fleet_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `route` (`route_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gvausers`
--

DROP TABLE IF EXISTS `gvausers`;
CREATE TABLE IF NOT EXISTS `gvausers` (
  `gvauser_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `callsign` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `user_type_id` int(11) NOT NULL DEFAULT '10',
  `register_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_visit_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `ivaovid` int(6) NOT NULL,
  `hub_id` int(11) NOT NULL,
  `location` varchar(4) CHARACTER SET utf8 NOT NULL,
  `country` varchar(30) CHARACTER SET utf8 NOT NULL,
  `city` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ivao_hours` int(10) unsigned DEFAULT NULL,
  `gva_hours` float NOT NULL,
  `route_id` bigint(4) DEFAULT NULL,
  `book_date` timestamp NULL DEFAULT NULL,
  `rank_id` tinyint(4) NOT NULL DEFAULT '1',
  `money` float NOT NULL DEFAULT '0',
  `reg_comments` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `birth_date` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `vatsimid` int(11) NOT NULL,
  `language` varchar(4) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`gvauser_id`),
  UNIQUE KEY `email_2` (`email`),
  KEY `usertype` (`user_type_id`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hangar`
--

DROP TABLE IF EXISTS `hangar`;
CREATE TABLE IF NOT EXISTS `hangar` (
  `hangar_id` int(11) NOT NULL AUTO_INCREMENT,
  `gvauser_id` int(11) NOT NULL,
  `fleet_id` int(11) NOT NULL,
  `registry` varchar(8) NOT NULL,
  `departure` varchar(4) NOT NULL,
  `location` varchar(4) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `reason` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hangar_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hubs`
--

DROP TABLE IF EXISTS `hubs`;
CREATE TABLE IF NOT EXISTS `hubs` (
  `hub_id` int(4) NOT NULL AUTO_INCREMENT,
  `hub` varchar(50) NOT NULL,
  `web` varchar(200) NOT NULL,
  PRIMARY KEY (`hub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jumps`
--

DROP TABLE IF EXISTS `jumps`;
CREATE TABLE IF NOT EXISTS `jumps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gvauser_id` int(11) NOT NULL,
  `callsign` varchar(8) NOT NULL,
  `from_airport` varchar(4) NOT NULL,
  `to_airport` varchar(4) NOT NULL,
  `value` bigint(20) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(50) NOT NULL,
  `file_sufix` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `text` varchar(5000) NOT NULL,
  `status` text NOT NULL,
  `sentdate` datetime NOT NULL,
  `readdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deletedate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notams`
--

DROP TABLE IF EXISTS `notams`;
CREATE TABLE IF NOT EXISTS `notams` (
  `notam_id` int(4) NOT NULL AUTO_INCREMENT,
  `notam_name` varchar(50) NOT NULL,
  `notam_text` varchar(2000) NOT NULL,
  `create_date` date NOT NULL,
  `publish_date` date NOT NULL,
  `hide_date` date NOT NULL,
  PRIMARY KEY (`notam_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pilots`
--

DROP TABLE IF EXISTS `pilots`;
CREATE TABLE IF NOT EXISTS `pilots` (
  `pilot_id` int(11) NOT NULL AUTO_INCREMENT,
  `pilot_num` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL DEFAULT '',
  `country` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `admission_date` date NOT NULL DEFAULT '0000-00-00',
  `status` varchar(30) NOT NULL DEFAULT '',
  `gvauser_id` int(11) NOT NULL,
  PRIMARY KEY (`pilot_id`),
  UNIQUE KEY `pilot_key` (`pilot_num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pirepfsfk`
--

DROP TABLE IF EXISTS `pirepfsfk`;
CREATE TABLE IF NOT EXISTS `pirepfsfk` (
  `IDPIREP` varchar(255) NOT NULL DEFAULT '',
  `pirepfsfk_id` int(11) NOT NULL AUTO_INCREMENT,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gvauser_id` varchar(255) DEFAULT NULL,
  `PilotName` varchar(255) DEFAULT NULL,
  `AircraftTitle` varchar(255) DEFAULT NULL,
  `AircraftType` varchar(255) DEFAULT NULL,
  `TailNumber` varchar(255) DEFAULT NULL,
  `Airline` varchar(255) DEFAULT NULL,
  `FlightNumber` varchar(255) DEFAULT NULL,
  `FlightType` varchar(255) DEFAULT NULL,
  `FlightLevel` varchar(255) DEFAULT NULL,
  `Passenger` varchar(255) DEFAULT NULL,
  `Cargo` varchar(255) DEFAULT NULL,
  `ZFW` varchar(255) DEFAULT NULL,
  `OriginAirport` varchar(255) DEFAULT NULL,
  `OriginGate` varchar(255) DEFAULT NULL,
  `OriginRunway` varchar(255) DEFAULT NULL,
  `OriginTA` varchar(255) DEFAULT NULL,
  `DestinationAirport` varchar(255) DEFAULT NULL,
  `DestinationGate` varchar(255) DEFAULT NULL,
  `DestinationRunway` varchar(255) DEFAULT NULL,
  `DestinationTA` varchar(255) DEFAULT NULL,
  `AlternateAirport` varchar(255) DEFAULT NULL,
  `SID` varchar(255) DEFAULT NULL,
  `STAR` varchar(255) DEFAULT NULL,
  `DistanceFlight` varchar(255) DEFAULT NULL,
  `DistanceRoute` varchar(255) DEFAULT NULL,
  `OUTTime` varchar(255) DEFAULT NULL,
  `OFFTime` varchar(255) DEFAULT NULL,
  `ONTime` varchar(255) DEFAULT NULL,
  `INTime` varchar(255) DEFAULT NULL,
  `BlockTime` varchar(255) DEFAULT NULL,
  `FlightTime` varchar(255) DEFAULT NULL,
  `DayFlightTime` varchar(255) DEFAULT NULL,
  `NightFlightTime` varchar(255) DEFAULT NULL,
  `BlockFuel` varchar(255) DEFAULT NULL,
  `FlightFuel` varchar(255) DEFAULT NULL,
  `TakeoffIAS` varchar(255) DEFAULT NULL,
  `LandingIAS` varchar(255) DEFAULT NULL,
  `LandingVS` varchar(255) DEFAULT NULL,
  `FlightMapJPG` varchar(255) DEFAULT NULL,
  `FlightMapWeatherJPG` varchar(255) DEFAULT NULL,
  `FlightMapTaxiOutJPG` varchar(255) DEFAULT NULL,
  `FlightMapTaxiInJPG` varchar(255) DEFAULT NULL,
  `FlightMapVerticalProfileJPG` varchar(255) DEFAULT NULL,
  `FlightMapLandingProfileJPG` varchar(255) DEFAULT NULL,
  `FlightScore` varchar(255) DEFAULT NULL,
  `FlightCritique` text,
  `FlightPlan` text,
  `Comment` text,
  `validated` varchar(2) DEFAULT '0',
  `charter` tinyint(4) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `route` int(11) NOT NULL,
  `flight` varchar(10) NOT NULL,
  PRIMARY KEY (`pirepfsfk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pireps`
--

DROP TABLE IF EXISTS `pireps`;
CREATE TABLE IF NOT EXISTS `pireps` (
  `pirep_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from_airport` varchar(4) NOT NULL,
  `to_airport` varchar(4) NOT NULL,
  `duration` float NOT NULL,
  `gvauser_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `plane_type` varchar(8) NOT NULL,
  `fuel` bigint(20) NOT NULL,
  `comment` varchar(400) DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '0',
  `distance` int(11) DEFAULT '0',
  `charter` tinyint(4) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `route` int(11) DEFAULT NULL,
  `flight` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`pirep_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;


--
-- Estructura de tabla para la tabla `ranks`
--

DROP TABLE IF EXISTS `ranks`;
CREATE TABLE IF NOT EXISTS `ranks` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(50) NOT NULL,
  `salary_hour` int(11) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regular_flights_tracks`
--

DROP TABLE IF EXISTS `regular_flights_tracks`;
CREATE TABLE IF NOT EXISTS `regular_flights_tracks` (
  `regular_flights_tracks_id` int(11) NOT NULL AUTO_INCREMENT,
  `gvauser_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `departure` varchar(4) NOT NULL,
  `arrival` varchar(4) NOT NULL,
  `route_id` int(11) NOT NULL,
  `fuel` float NOT NULL,
  `distance` float NOT NULL,
  `fleet_id` int(11) NOT NULL,
  PRIMARY KEY (`regular_flights_tracks_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `pilot_id` smallint(6) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00',
  `callsign` varchar(10) DEFAULT NULL,
  `origin_id` varchar(4) NOT NULL DEFAULT '0',
  `destination_id` varchar(4) NOT NULL DEFAULT '0',
  `registration` varchar(10) DEFAULT NULL,
  `equipment` varchar(10) DEFAULT NULL,
  `duration` time NOT NULL DEFAULT '00:00:00',
  `fuel` smallint(6) NOT NULL DEFAULT '0',
  `distance` smallint(6) NOT NULL DEFAULT '0',
  `fsacars_rep_url` text NOT NULL,
  `fsacars_log` varchar(9999) NOT NULL,
  `validated` int(11) NOT NULL DEFAULT '0',
  `charter` int(11) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '0',
  `gvauser_id` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `flight` varchar(10) NOT NULL,
  `LandingVS` int(6) NOT NULL,
  `fleet_id` INT( 11 ),
  PRIMARY KEY (`report_id`),
  UNIQUE KEY `report_id` (`report_id`),
  UNIQUE KEY `xpk_reports` (`report_id`),
  KEY `xi_reports` (`pilot_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserves`
--

DROP TABLE IF EXISTS `reserves`;
CREATE TABLE IF NOT EXISTS `reserves` (
  `id` bigint(4) NOT NULL AUTO_INCREMENT,
  `route_id` bigint(20) NOT NULL,
  `gvauser_id` int(11) NOT NULL,
  `fleet_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `flight` varchar(7) NOT NULL,
  `departure` varchar(4) NOT NULL,
  `arrival` varchar(4) NOT NULL,
  `alternative` varchar(4) DEFAULT NULL,
  `etd` varchar(4) DEFAULT NULL,
  `eta` varchar(4) DEFAULT NULL,
  `fleettype_id` int(10) DEFAULT NULL,
  `pax` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `flproute` varchar(500) NOT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `booked` tinyint(4) NOT NULL,
  `cargo` varchar(10) DEFAULT NULL,
  `fuel` bigint(20) DEFAULT '0',
  PRIMARY KEY (`route_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stafftrackers`
--

DROP TABLE IF EXISTS `stafftrackers`;
CREATE TABLE IF NOT EXISTS `stafftrackers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gvauser_id` int(11) NOT NULL,
  `action` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vaprofits`
--

DROP TABLE IF EXISTS `vaprofits`;
CREATE TABLE IF NOT EXISTS `vaprofits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `callsign` varchar(10) DEFAULT NULL,
  `gvauser_id` int(11) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `va_parameters`
--

DROP TABLE IF EXISTS `va_parameters`;
CREATE TABLE IF NOT EXISTS `va_parameters` (
  `va_parameters_id` int(11) NOT NULL AUTO_INCREMENT,
  `number_pilots` int(11) NOT NULL,
  `ivao` tinyint(1) NOT NULL,
  `vatsim` tinyint(1) NOT NULL,
  `va_icao` varchar(14) NOT NULL,
  `va_name` varchar(50) NOT NULL,
  `jump_type1` int(11) NOT NULL,
  `jump_type2` int(11) NOT NULL,
  `jump_type3` int(11) NOT NULL,
  `pirep_manual` tinyint(1) NOT NULL,
  `pirep_fskeeper` tinyint(1) NOT NULL,
  `pirep_fsacars` tinyint(1) NOT NULL,
  `pirep_kacars` tinyint(1) NOT NULL,
  `plane_status_hangar` int(11) NOT NULL,
  `landing_crash` int(11) NOT NULL,
  `landing_penalty1` int(11) NOT NULL,
  `landing_penalty2` int(11) NOT NULL,
  `landing_penalty3` int(11) NOT NULL,
  `landing_vs_penalty1` int(11) NOT NULL,
  `landing_vs_penalty2` int(11) NOT NULL,
  `flight_wear` int(11) NOT NULL,
  `hangar_maintenance_days` int(11) NOT NULL,
  `hangar_maintenance_value` int(11) NOT NULL,
  `hangar_crash_days` int(11) NOT NULL,
  `hangar_crash_value` int(11) NOT NULL,
  `pilot_crash_penalty` int(11) NOT NULL,
  `charter_reduction` int(11) NOT NULL,
  `currency` varchar(50) NOT NULL,
  PRIMARY KEY (`va_parameters_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- VIEWS:


DROP VIEW IF EXISTS `v_flights_pilots`;
create view v_flights_pilots as
select count(report_id) as c ,DATE_FORMAT(date, '%Y-%m-%d') as flight_date, pilot_id as pilot, 'fsacars' as type from reports group by pilot, date
union
select count(pirep_id) as c ,DATE_FORMAT(date, '%Y-%m-%d') as flight_date, gvauser_id as pilot, 'manual' as type  from pireps group by pilot, date
union 
select count(pirepfsfk_id) as c ,DATE_FORMAT(CreatedOn, '%Y-%m-%d') as flight_date, gvauser_id as pilot, 'fskeeper' as type  from pirepfsfk 
group by pilot, flight_date ;

DROP VIEW IF EXISTS `v_total_data_flight`;
create view v_total_data_flight as
select p.gvauser_id as pilot  ,pirep_id as id_flight,comment,valid as status,from_airport departure, to_airport arrival ,date,distance,ROUND(duration,2) as time ,charter, 'pirep' as type ,flight as flight
from pireps  p right outer join gvausers g on g.gvauser_id = p.gvauser_id 
UNION
select p.gvauser_id as pilot  ,pirepfsfk_id as id_flight,'' as comment,validated as status, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , '' as flight
from pirepfsfk p right outer  join gvausers g on g.gvauser_id = p.gvauser_id 
UNION
SELECT g.gvauser_id as pilot  ,report_id as id_flight,'' as comment , validated as status , origin_id as departure, destination_id as arrival, date, distance, ROUND((HOUR(duration)*60 + minute(duration))/60,2) as duration, charter, 'Fsacars' as type, '' as flight
from reports r right outer  join gvausers g on g.gvauser_id = r.pilot_id ;


DROP VIEW IF EXISTS `v_top_arrival`;
create view v_top_arrival as
select arrival , count(*) as num_flights from v_total_data_flight where arrival is not null 
group by arrival order by num_flights desc limit 5;


DROP VIEW IF EXISTS `v_top_departure`;
create view v_top_departure as
select departure , count(*) as num_flights from v_total_data_flight where departure is not null 
group by departure order by num_flights desc limit 5;


DROP VIEW IF EXISTS `v_top_flights`;
create view v_top_flights as
select pilot , count(*) as num_flights from v_total_data_flight where pilot is not null 
group by pilot order by num_flights desc limit 5;

DROP VIEW IF EXISTS `v_top_hours`;
create view v_top_hours as
select pilot , round(sum(time),2) as sum_time from v_total_data_flight where id_flight is not null 
group by pilot order by sum_time desc limit 5;

DROP VIEW IF EXISTS `v_top_routes`;
create view v_top_routes as
select  concat (departure ,' - ', arrival ) as route , count(*) as num_routes 
from v_total_data_flight where pilot is not null and arrival is not null 
and departure is not null group by route order by num_routes desc limit 5;

DROP VIEW IF EXISTS `v_top_vs`;
create view v_top_vs as
SELECT gvauser_id as pilot , min(LandingVS) as vs FROM pirepfsfk 
UNION
SELECT pilot_id as pilot , min(LandingVS) as vs from reports 
group by pilot order by vs asc limit 5;

DROP VIEW IF EXISTS v_last_5_flights;
create view v_last_5_flights as
SELECT g.callsign as callsign , concat (g.name,' ',g.surname) as pilot_name, departure, arrival, date, time 
FROM v_total_data_flight vtf inner join gvausers g on g.gvauser_id=vtf.pilot
WHERE date is not null order by date desc LIMIT 5;


--
-- VAM 2.2 SCHEMA CHANGES 2015-MAY-07
--


ALTER TABLE  `fleets` CHANGE  `CTO`  `CTO` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;

CREATE TABLE IF NOT EXISTS `vampireps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gvauser_id` int(11) NOT NULL,
  `flightid` varchar(500) NOT NULL,
  `departure` varchar(4) NOT NULL,
  `arrival` varchar(4) NOT NULL,
  `callsign` varchar(50) NOT NULL,
  `departure_time` varchar(10) NOT NULL,
  `cruise_speed` varchar(10) NOT NULL,
  `flight_level` varchar(10) NOT NULL,
  `pax` int(11) NOT NULL,
  `cargo` int(11) NOT NULL,
  `eet` varchar(10) NOT NULL,
  `endurance` varchar(10) NOT NULL,
  `alt1` varchar(4) NOT NULL,
  `alt2` varchar(4) NOT NULL,
  `route` varchar(2000) NOT NULL,
  `remarks` varchar(2000) NOT NULL,
  `flight_type` varchar(10) NOT NULL,
  `aircraft` varchar(500) NOT NULL,
  `aircraft_type` varchar(10) NOT NULL,
  `aircraft_registry` varchar(20) NOT NULL,
  `flight_status` varchar(20) NOT NULL,
  `flight_duration` float NOT NULL,
  `flight_fuel` double NOT NULL,
  `block_fuel` double NOT NULL,
  `flight_date` datetime NOT NULL,
  `distance` int(11) NOT NULL,
  `landing_vs` float NOT NULL,
  `landing_ias` float NOT NULL,
  `landing_forceg` float NOT NULL,
  `landing_bank` float NOT NULL,
  `landing_pitch` float NOT NULL,
  `landing_winddeg` int(11) NOT NULL,
  `landing_windknots` int(11) NOT NULL,
  `landing_oat` float NOT NULL,
  `landing_flaps` int(11) NOT NULL,
  `landing_light_bea` int(11) NOT NULL,
  `landing_light_nav` int(11) NOT NULL,
  `landing_light_ldn` int(11) NOT NULL,
  `landing_light_str` int(11) NOT NULL,
  `log_start` varchar(50) NOT NULL,
  `flight_start` varchar(50) NOT NULL,
  `log_end` varchar(50) NOT NULL,
  `flight_end` varchar(50) NOT NULL,
  `zfw` bigint(20) NOT NULL,
  `departure_metar` text NOT NULL,
  `arrival_metar` text NOT NULL,
  `virtual_airline` varchar(200) NOT NULL,
  `va_url` varchar(200) NOT NULL,
  `weight_unit` varchar(10) NOT NULL,
  `network` varchar(50) NOT NULL,
  `comments` text NOT NULL,
  `validated` varchar(2) NOT NULL DEFAULT '0',
  `charter` tinyint(4) NOT NULL DEFAULT '1',
  `paid` tinyint(4) NOT NULL,
  `vam_route` int(11) NOT NULL,
  `flight` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `vamevents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `flight_id` varchar(200) NOT NULL,
  `event_description` varchar(200) NOT NULL,
  `event_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ias` int(11) NOT NULL,
  `altitude` int(11) NOT NULL,
  `radio_altimeter` int(11) NOT NULL,
  `heading` int(11) NOT NULL,
  `fuel` int(11) NOT NULL,
  `fuel_used` int(11) NOT NULL,
  `log_time` float NOT NULL,
  `landing_vs` float NOT NULL,
  `flaps` int(11) NOT NULL,
  `light_nav` int(11) NOT NULL,
  `light_taxi` int(11) NOT NULL,
  `light_sto` int(11) NOT NULL,
  `light_lnd` int(11) NOT NULL,
  `light_bea` int(11) NOT NULL,
  `critical` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `vam_live_flights` (
`id` int(11) NOT NULL ,
  `gvauser_id` int(11) NOT NULL,
  `flight_id` varchar(200) NOT NULL,
  `departure` varchar(4) NOT NULL,
  `arrival` varchar(4) NOT NULL,
  `ias` int(11) NOT NULL,
  `heading` int(11) NOT NULL,
  `gs` int(11) NOT NULL,
  `altitude` int(11) NOT NULL,
  `fuel` int(11) NOT NULL,
  `fuel_used` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `time_passed` int(11) NOT NULL,
  `perc_completed` int(11) NOT NULL,
  `time_flag` timestamp NULL DEFAULT NULL,
  `oat` int(11) NOT NULL,
  `wind_deg` int(11) NOT NULL,
  `wind_knots` int(11) NOT NULL,
  `flight_status` varchar(50) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `vam_live_acars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gvauser_id` int(11) NOT NULL,
  `flight_id` varchar(200) NOT NULL,
  `departure` varchar(4) NOT NULL,
  `arrival` varchar(4) NOT NULL,
  `ias` int(11) NOT NULL,
  `heading` int(11) NOT NULL,
  `gs` int(11) NOT NULL,
  `altitude` int(11) NOT NULL,
  `fuel` int(11) NOT NULL,
  `fuel_used` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `time_passed` int(11) NOT NULL,
  `perc_completed` int(11) NOT NULL,
  `time_flag` timestamp NULL DEFAULT NULL,
  `oat` int(11) NOT NULL,
  `wind_deg` int(11) NOT NULL,
  `wind_knots` int(11) NOT NULL,
  `flight_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `vam_track` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `track_id` int(11) NOT NULL,
  `flight_id` varchar(50) NOT NULL,
  `ias` int(11) NOT NULL,
  `gs` int(11) NOT NULL,
  `heading` int(11) NOT NULL,
  `radio_altitude` int(11) NOT NULL,
  `altitude` int(11) NOT NULL,
  `fuel` int(11) NOT NULL,
  `fuel_used` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `time_passed` int(11) NOT NULL,
  `time_flag` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `perc_completed` int(11) NOT NULL,
  `oat` int(11) NOT NULL,
  `flight_status` varchar(50) NOT NULL,
  `wind_deg` int(11) NOT NULL,
  `wind_knots` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP VIEW IF EXISTS `v_total_data_flight`;
create view v_total_data_flight as
select p.gvauser_id as pilot  ,pirep_id as id_flight,comment,valid as status,from_airport departure, to_airport arrival ,date,distance,ROUND(duration,2) as time ,charter, 'pirep' as type ,flight as flight
from pireps  p right outer join gvausers g on g.gvauser_id = p.gvauser_id 
UNION
select p.gvauser_id as pilot  ,pirepfsfk_id as id_flight,'' as comment,validated as status, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , '' as flight
from pirepfsfk p right outer  join gvausers g on g.gvauser_id = p.gvauser_id 
UNION
SELECT g.gvauser_id as pilot  ,report_id as id_flight,'' as comment , validated as status , origin_id as departure, destination_id as arrival, date, distance, ROUND((HOUR(duration)*60 + minute(duration))/60,2) as duration, charter, 'Fsacars' as type, '' as flight
from reports r right outer  join gvausers g on g.gvauser_id = r.pilot_id 
UNION
SELECT g.gvauser_id as pilot  ,flightid as id_flight,comments as comment , validated as status , departure, arrival, flight_date as date, distance, flight_duration as duration, charter, 'VAM Acars' as type, '' as flight
from vampireps r right outer  join gvausers g on g.gvauser_id = r.gvauser_id
;

-- stats
-- month counter

DROP VIEW IF EXISTS `v_flights_pilots`;
create view v_flights_pilots as
select count(report_id) as c ,DATE_FORMAT(date, '%Y-%m-%d') as flightdate, pilot_id as pilot, 'fsacars' as type from reports group by pilot, date
union
select count(pirep_id) as c ,DATE_FORMAT(date, '%Y-%m-%d') as flightdate, gvauser_id as pilot, 'manual' as type  from pireps group by pilot, date
union 
select count(pirepfsfk_id) as c ,DATE_FORMAT(CreatedOn, '%Y-%m-%d') as flightdate, gvauser_id as pilot, 'fskeeper' as type  from pirepfsfk 
union
select count(flightid) as c ,DATE_FORMAT(flight_date, '%Y-%m-%d') as flightdate, gvauser_id as pilot, 'vamkeeper' as type  from vampireps 
group by pilot, flightdate 
;

-- top 5 touch
DROP VIEW IF EXISTS `v_top_vs`;
create view v_top_vs as
SELECT gvauser_id as pilot , min(abs(LandingVS)) as vs FROM pirepfsfk group by pilot 
UNION
SELECT pilot_id as pilot , min(abs(LandingVS)) as vs from reports group by pilot 
UNION
SELECT gvauser_id as pilot , min(abs(landing_vs)) as vs from vampireps 
group by pilot order by vs asc limit 5;

-- top 5 routes
DROP VIEW IF EXISTS `v_total_data_flight`;
create view v_total_data_flight as
select p.gvauser_id as pilot  ,pirep_id as id_flight,comment,valid as status,from_airport departure, to_airport arrival ,date,distance,ROUND(duration,2) as time ,charter, 'pirep' as type ,flight as flight
from pireps  p right outer join gvausers g on g.gvauser_id = p.gvauser_id where charter is not null
UNION
select p.gvauser_id as pilot  ,pirepfsfk_id as id_flight,'' as comment,validated as status, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , '' as flight
from pirepfsfk p right outer  join gvausers g on g.gvauser_id = p.gvauser_id where charter is not null
UNION
SELECT g.gvauser_id as pilot  ,report_id as id_flight,'' as comment , validated as status , origin_id as departure, destination_id as arrival, date, distance, ROUND((HOUR(duration)*60 + minute(duration))/60,2) as duration, charter, 'Fsacars' as type, '' as flight
from reports r right outer  join gvausers g on g.gvauser_id = r.pilot_id  where charter is not null
UNION
SELECT g.gvauser_id as pilot  ,flightid as id_flight,'' as comment , validated as status , departure, arrival, flight_date as dare, distance, ROUND(flight_duration,2) as duration, charter, 'VAMACARS' as type, '' as flight
from vampireps r right outer  join gvausers g on g.gvauser_id = r.gvauser_id where charter is not null;

-- top 5 flights
DROP VIEW IF EXISTS `v_top_flights`;
create view v_top_flights as
select pilot , count(*) as num_flights from v_total_data_flight where pilot is not null 
group by pilot order by num_flights desc limit 5;

-- PILOT_ROSTER

DROP VIEW IF EXISTS `v_pilot_roster`;
create view v_pilot_roster as
select p.gvauser_id as pilot  ,pirep_id as id_flight,comment,valid as status,from_airport departure, to_airport arrival ,date,distance,ROUND(duration,2) as time ,charter, 'pirep' as type ,flight as flight
from pireps  p right outer join gvausers g on g.gvauser_id = p.gvauser_id 
UNION
select p.gvauser_id as pilot  ,pirepfsfk_id as id_flight,'' as comment,validated as status, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , '' as flight
from pirepfsfk p right outer  join gvausers g on g.gvauser_id = p.gvauser_id 
UNION
SELECT g.gvauser_id as pilot  ,report_id as id_flight,'' as comment , validated as status , origin_id as departure, destination_id as arrival, date, distance, ROUND((HOUR(duration)*60 + minute(duration))/60,2) as duration, charter, 'Fsacars' as type, '' as flight
from reports r right outer  join gvausers g on g.gvauser_id = r.pilot_id 
UNION
SELECT g.gvauser_id as pilot  ,flightid as id_flight,'' as comment , validated as status , departure, arrival, flight_date as dare, distance, ROUND(flight_duration,2) as duration, charter, 'VAMACARS' as type, '' as flight
from vampireps r right outer  join gvausers g on g.gvauser_id = r.gvauser_id ;



--
-- VAM 2.3 SCHEMA CHANGES 2015 JUNE
--

-- Schema changes VAM 2.3
alter table vampireps add pause_time float;
ALTER TABLE vampireps ADD validator_comments VARCHAR (500);
ALTER TABLE vampireps ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE vampireps ADD updated_at TIMESTAMP ;
ALTER TABLE vampireps ADD beacon_off int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD ias_below_10000_ft int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD lights_below_10000_ft int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD lights_above_10000_ft int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD stall int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD overspeed int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD pause int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD refuel int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD crash int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD slew int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD taxi_no_lights int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD takeoff_ldn_lights_off int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD landing_ldn_lights_off int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD landed_not_in_planned int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD taxi_speed int(11) NOT NULL DEFAULT '0';
ALTER TABLE vampireps ADD rating INT default 100 ;

ALTER TABLE va_parameters ADD no_count_rejected INT default 0 ;
ALTER TABLE va_parameters ADD pilot_public INT default 0 ;

ALTER TABLE pirepfsfk ADD validator_comments VARCHAR (500);
ALTER TABLE pirepfsfk ADD rating INT default 100 ;

ALTER TABLE pirepfsfk ADD updated_at TIMESTAMP ;

ALTER TABLE pireps ADD validator_comments VARCHAR (500);
ALTER TABLE pireps ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE pireps ADD updated_at TIMESTAMP ;
ALTER TABLE pireps ADD rating INT default 100 ;

ALTER TABLE reports ADD validator_comments VARCHAR (500);
ALTER TABLE reports ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE reports ADD updated_at TIMESTAMP ;
ALTER TABLE reports ADD rating INT default 100 ;

ALTER TABLE gvausers ADD transfered_hours INT default 0 ;

DROP TABLE IF EXISTS `vamacars_parameters`;
CREATE TABLE vamacars_parameters (
  vamacars_parameters_id int(11) NOT NULL AUTO_INCREMENT,
  beacon_off int(11) NOT NULL DEFAULT '0',
  ias_below_10000_ft int(11) NOT NULL DEFAULT '0',
  lights_below_10000_ft int(11) NOT NULL DEFAULT '0',
  lights_above_10000_ft int(11) NOT NULL DEFAULT '0',
  stall int(11) NOT NULL DEFAULT '0',
  overspeed int(11) NOT NULL DEFAULT '0',
  pause int(11) NOT NULL DEFAULT '0',
  refuel int(11) NOT NULL DEFAULT '0',
  crash int(11) NOT NULL DEFAULT '0',
  incorrect_arrival int(11) NOT NULL DEFAULT '0',
  slew int(11) NOT NULL DEFAULT '0',
  taxi_lights int(11) NOT NULL DEFAULT '0',
  takeoff_lights int(11) NOT NULL DEFAULT '0',
  land_lights int(11) NOT NULL DEFAULT '0',
  landing_vs_0_100 int(11) NOT NULL DEFAULT '0',  
  landing_vs_100_200 int(11) NOT NULL DEFAULT '0', 
  landing_vs_200_300 int(11) NOT NULL DEFAULT '0', 
  landing_vs_300_400 int(11) NOT NULL DEFAULT '0', 
  landing_vs_400_500 int(11) NOT NULL DEFAULT '0', 
  landing_vs_500_600 int(11) NOT NULL DEFAULT '0', 
  landing_vs_greater_600 int(11) NOT NULL DEFAULT '0', 
  taxi_speed int(11) NOT NULL DEFAULT '0', 
  PRIMARY KEY (vamacars_parameters_id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


INSERT INTO vamacars_parameters (`vamacars_parameters_id`, `beacon_off`, `ias_below_10000_ft`, `lights_below_10000_ft`, `lights_above_10000_ft`, `stall`, `overspeed`, `pause`, `refuel`, `crash`, `incorrect_arrival`, `slew`, `taxi_lights`, `takeoff_lights`, `land_lights`) VALUES (1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- Data for VAM 2.3
UPDATE vampireps SET crash = 0;
UPDATE va_parameters SET no_count_rejected = 0;
UPDATE va_parameters SET pilot_public = 0;



-- New view for pilot hours no count rejected

DROP VIEW IF EXISTS `v_total_data_flight_no_rejected`;
create view v_total_data_flight_no_rejected as
select p.gvauser_id as pilot  ,pirep_id as id_flight,comment,valid as status,from_airport departure, to_airport arrival ,date,distance,ROUND(duration,2) as time ,charter, 'pirep' as type ,flight as flight
from pireps  p right outer join gvausers g on g.gvauser_id = p.gvauser_id where charter is not null and valid<>2
UNION
select p.gvauser_id as pilot  ,pirepfsfk_id as id_flight,'' as comment,validated as status, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , '' as flight
from pirepfsfk p right outer  join gvausers g on g.gvauser_id = p.gvauser_id where charter is not null and validated<>2
UNION
SELECT g.gvauser_id as pilot  ,report_id as id_flight,'' as comment , validated as status , origin_id as departure, destination_id as arrival, date, distance, ROUND((HOUR(duration)*60 + minute(duration))/60,2) as duration, charter, 'Fsacars' as type, '' as flight
from reports r right outer  join gvausers g on g.gvauser_id = r.pilot_id  where charter is not null and validated<>2
UNION
SELECT g.gvauser_id as pilot  ,flightid as id_flight,'' as comment , validated as status , departure, arrival, flight_date as dare, distance, ROUND(flight_duration,2) as duration, charter, 'VAMACARS' as type, '' as flight
from vampireps r right outer  join gvausers g on g.gvauser_id = r.gvauser_id where charter is not null and validated<>2;


-- Stats new views

DROP VIEW IF EXISTS `v_top_flights`;
create view v_top_flights as
select pilot , count(*) as num_flights  from v_total_data_flight v inner join gvausers gva on gva.gvauser_id = v.pilot
where pilot is not null and status is not null 
and activation=1 
group by pilot order by num_flights desc limit 5;

DROP VIEW IF EXISTS `v_top_flights_rejected`;
create view v_top_flights_rejected as
select pilot , count(*) as num_flights  from v_total_data_flight v inner join gvausers gva on gva.gvauser_id = v.pilot
where pilot is not null and status is not null 
and activation=1 
and status<>2
group by pilot order by num_flights desc limit 5;


DROP VIEW IF EXISTS `v_top_hours_rejected`;
create view v_top_hours_rejected as
select pilot , round(sum(time),2) as sum_time from v_total_data_flight where id_flight is not null and status<>2
group by pilot order by sum_time desc limit 5;

DROP VIEW IF EXISTS `v_pilot_roster_rejected`;
create view v_pilot_roster_rejected as
select p.gvauser_id as pilot  ,pirep_id as id_flight,comment,valid as status,from_airport departure, to_airport arrival ,date,distance,ROUND(duration,2) as time ,charter, 'pirep' as type ,flight as flight
from pireps  p right outer join gvausers g on g.gvauser_id = p.gvauser_id and valid<>2
UNION
select p.gvauser_id as pilot  ,pirepfsfk_id as id_flight,'' as comment,validated as status, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , '' as flight
from pirepfsfk p right outer  join gvausers g on g.gvauser_id = p.gvauser_id and validated<>2
UNION
SELECT g.gvauser_id as pilot  ,report_id as id_flight,'' as comment , validated as status , origin_id as departure, destination_id as arrival, date, distance, ROUND((HOUR(duration)*60 + minute(duration))/60,2) as duration, charter, 'Fsacars' as type, '' as flight
from reports r right outer  join gvausers g on g.gvauser_id = r.pilot_id and validated<>2
UNION
SELECT g.gvauser_id as pilot  ,flightid as id_flight,'' as comment , validated as status , departure, arrival, flight_date as dare, distance, ROUND(flight_duration,2) as duration, charter, 'VAMACARS' as type, '' as flight
from vampireps r right outer  join gvausers g on g.gvauser_id = r.gvauser_id and validated<>2;


--
-- VAM 2.4 SCHEMA CHANGES 2015 JULY
--

DROP TABLE IF EXISTS `runways`;
CREATE TABLE IF NOT EXISTS `runways` (
`id` int(11) NOT NULL,
  `airport_ref` int(10) unsigned NOT NULL,
  `airport_ident` varchar(6) COLLATE utf8_spanish2_ci  ,
  `length_ft` int(10) unsigned  ,

  `width_ft` int(10) unsigned  ,
  `surface` varchar(10) COLLATE utf8_spanish2_ci  ,
  `lighted` int(1) unsigned  ,
  `closed` int(1) unsigned  ,
  `le_ident` varchar(6) COLLATE utf8_spanish2_ci  ,
  `le_latitude_deg` float  ,
  `le_longitude_deg` float  ,
  `le_elevation_ft` int(10) unsigned  ,
  `le_heading_degT` float  ,
  `le_displaced_threshold_ft` int(10) unsigned  ,
  `he_ident` varchar(6) COLLATE utf8_spanish2_ci  ,
  `he_latitude_deg` float  ,
  `he_longitude_deg` float  ,
  `he_elevation_ft` int(10) unsigned  ,
  `he_heading_degT` float  ,
  `he_displaced_threshold_ft` int(10) unsigned
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Indices de la tabla `runways`
--
ALTER TABLE `runways`
 ADD PRIMARY KEY (`id`);


DROP TABLE IF EXISTS airport_frequencies  ;

CREATE TABLE IF NOT EXISTS airport_frequencies (
  `id` int(11) NOT NULL,
  `airport_ref` int(10) unsigned NOT NULL,
  `airport_ident` varchar(6) COLLATE utf8_spanish2_ci  ,
  `type` varchar(10) COLLATE utf8_spanish2_ci  ,
  `description` varchar(10) COLLATE utf8_spanish2_ci  ,
  `frequency_mhz` float
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Indices de la tabla `airport_frequencies`
--
ALTER TABLE airport_frequencies ADD PRIMARY KEY (`id`);



DROP TABLE IF EXISTS `navaids`;
CREATE TABLE IF NOT EXISTS `navaids` (
  `id` int(11) NOT NULL,
  `filename` varchar(6) COLLATE utf8_spanish2_ci  ,
  `ident` varchar(6) COLLATE utf8_spanish2_ci  ,
  `name` varchar(50) COLLATE utf8_spanish2_ci  ,
  `type` varchar(10) COLLATE utf8_spanish2_ci  ,
  `frequency_khz` float  ,
  `latitude_deg` float  ,
  `longitude_deg` float  ,
  `elevation_ft` int(11) ,
  `iso_country` varchar(4) COLLATE utf8_spanish2_ci  ,
  `dme_frequency_khz` float  ,
  `dme_channel` varchar(10) COLLATE utf8_spanish2_ci  ,
  `dme_latitude_deg` float  ,
  `dme_longitude_deg` float  ,
  `dme_elevation_ft` int(11) ,
  `slaved_variation_deg` varchar(10) COLLATE utf8_spanish2_ci  ,
  `magnetic_variation_deg` varchar(10) COLLATE utf8_spanish2_ci  ,
  `usageType` varchar(10) COLLATE utf8_spanish2_ci  ,
  `power` varchar(10) COLLATE utf8_spanish2_ci  ,
  `associated_airport` varchar(10) COLLATE utf8_spanish2_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Indices de la tabla `navaids`
--
ALTER TABLE `navaids`
ADD PRIMARY KEY (`id`);

ALTER TABLE routes ADD duration FLOAT NULL DEFAULT '0' ;
ALTER TABLE gvausers ADD  accept_emails INT NOT NULL DEFAULT  '1';

-- New Languages
INSERT INTO `languages` (`id`, `language_name`, `file_sufix`) VALUES
(6, 'Français', 'fr'),
(7, 'Čeština', 'cs');



--
-- VAM 2.5 SCHEMA CHANGES 2015 OCTOBER
--

CREATE TABLE IF NOT EXISTS `awards` (
  `award_id` int(11) NOT NULL, 
  `award_name` varchar(500) COLLATE utf8_general_ci NOT NULL, 
  `award_image` varchar(500) COLLATE utf8_general_ci DEFAULT NULL
) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `awards` 
ADD 
  PRIMARY KEY (`award_id`); 
ALTER TABLE 
  `awards` CHANGE `award_id` `award_id` INT(11) NOT NULL AUTO_INCREMENT; CREATE TABLE IF NOT EXISTS `award_pilots` (
    `award_pilot_id` int(11) NOT NULL, 
    `award_id` int(11) NOT NULL, 
    `gvauser_id` int(11) NOT NULL, 
    `comments` varchar(500) COLLATE utf8_general_ci DEFAULT NULL, 
    `award_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `award_pilots` 
ADD 
  PRIMARY KEY (`award_pilot_id`), 
ADD 
  UNIQUE KEY `award_pilot_id` (`award_pilot_id`), 
ADD 
  KEY `award_id` (`award_id`); 
ALTER TABLE 
  `award_pilots` CHANGE `award_pilot_id` `award_pilot_id` INT(11) NOT NULL AUTO_INCREMENT; CREATE TABLE IF NOT EXISTS `financial_parameters` (
    `id` int(11) NOT NULL, 
    `finantial_active` int(11) NOT NULL DEFAULT '1', 
    `financial_parameter` varchar(500) COLLATE utf8_general_ci DEFAULT NULL, 
    `amount` float DEFAULT NULL, 
    `is_cost` tinyint(4) DEFAULT '0', 
    `is_fix_cost` tinyint(4) DEFAULT '0', 
    `is_profit` tinyint(4) DEFAULT '0', 
    `linked_to_time` tinyint(4) DEFAULT '0', 
    `linked_to_pax` tinyint(4) DEFAULT '0', 
    `linked_to_distance` tinyint(4) DEFAULT '0', 
    `linked_to_flight` tinyint(4) DEFAULT '0', 
    `parameter_active` tinyint(4) DEFAULT '0', 
    `linked_to_fuel` tinyint(4) DEFAULT '0', 
    `monthly` TINYINT(4) NOT NULL DEFAULT '0', 
    `percent_of_taxes_per_income` TINYINT(4) NULL DEFAULT '0'
  ) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `financial_parameters` 
ADD 
  PRIMARY KEY (`id`); 
ALTER TABLE 
  `financial_parameters` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT; 
ALTER TABLE 
  `fleets` 
DROP 
  `CTO`; 
ALTER TABLE 
  `fleets` CHANGE `base` `hub_base` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 
ALTER TABLE 
  `fleets` 
ADD 
  `hub_id` INT NULL; 
ALTER TABLE 
  `fleets` 
ADD 
  `booked_at` TIMESTAMP NOT NULL; 
ALTER TABLE 
  `fleets` CHANGE `booked_at` `booked_at` TIMESTAMP NULL DEFAULT NULL; 
ALTER TABLE 
  `fleettypes` 
ADD 
  `pax` INT NULL, 
ADD 
  `maximum_range` VARCHAR(40) NULL, 
ADD 
  `cargo_capacity` VARCHAR(40) NULL, 
ADD 
  `aircraft_length` VARCHAR(40) NULL, 
ADD 
  `mzfw` VARCHAR(40) NULL, 
ADD 
  `mlw` VARCHAR(40) NULL, 
ADD 
  `mtow` VARCHAR(40) NULL, 
ADD 
  `service_ceiling` VARCHAR(40) NULL, 
ADD 
  `cruising_speed` VARCHAR(40) NULL, 
ADD 
  `unit_price` BIGINT NULL, 
ADD 
  `crew_members` INT NULL, 
ADD 
  `image_url` varchar(500) NULL; 
ALTER TABLE 
  `fleettypes` 
DROP 
  `active`; 
ALTER TABLE 
  `fleettypes` CHANGE `cargo_capacity` `cargo_capacity` INT NULL DEFAULT '0'; 
ALTER TABLE 
  `gvausers` 
ADD 
  `pilot_image` VARCHAR(500) NULL; 
ALTER TABLE 
  `hubs` 
ADD 
  `image_url` varchar(500) NULL; 
ALTER TABLE 
  `ranks` 
ADD 
  `minimum_hours` INT NULL; 
ALTER TABLE 
  `ranks` 
ADD 
  `maximum_hours` INT NULL; 
ALTER TABLE 
  `ranks` 
ADD 
  `image_url` varchar(500) NULL; 
ALTER TABLE 
  `routes` 
DROP 
  `booked`; 
ALTER TABLE 
  `routes` 
DROP 
  `cargo`; 
ALTER TABLE 
  `routes` 
DROP 
  `fuel`; 
ALTER TABLE 
  `routes` 
DROP 
  `pax`; 
ALTER TABLE 
  `routes` CHANGE `price` `pax_price` INT(11) NULL DEFAULT NULL; 
ALTER TABLE 
  `routes` 
ADD 
  `cargo_price` INT NULL; 
ALTER TABLE 
  `routes` 
ADD 
  `hub_id` INT NULL; 
ALTER TABLE 
  `routes` 
ADD 
  `flight_level` VARCHAR(20) NULL; CREATE TABLE IF NOT EXISTS `tours` (
    `tour_id` int(11) NOT NULL, 
    `tour_name` varchar(100) COLLATE utf8_general_ci DEFAULT NULL, 
    `tour_description` varchar(1000) COLLATE utf8_general_ci DEFAULT NULL, 
    `tour_image` varchar(500) COLLATE utf8_general_ci DEFAULT NULL, 
    `start_date` date DEFAULT NULL, 
    `end_date` date DEFAULT NULL, 
    `tour_award_image` varchar(500) COLLATE utf8_general_ci DEFAULT NULL
  ) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `tours` 
ADD 
  PRIMARY KEY (`tour_id`); 
ALTER TABLE 
  `tours` CHANGE `tour_id` `tour_id` INT(11) NOT NULL AUTO_INCREMENT; CREATE TABLE IF NOT EXISTS `tour_finished` (
    `tour_finished_id` int(11) NOT NULL, 
    `tour_id` int(11) NOT NULL, 
    `gvauser_id` int(11) NOT NULL, 
    `finish_date` date NOT NULL
  ) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `tour_finished` 
ADD 
  PRIMARY KEY (`tour_finished_id`); 
ALTER TABLE 
  `tour_finished` CHANGE `tour_finished_id` `tour_finished_id` INT(11) NOT NULL AUTO_INCREMENT; CREATE TABLE IF NOT EXISTS `tour_legs` (
    `tour_leg_id` int(11) NOT NULL, 
    `tour_id` int(11) NOT NULL, 
    `leg_number` int(11) NOT NULL, 
    `departure` varchar(4) COLLATE utf8_general_ci NOT NULL, 
    `arrival` varchar(4) COLLATE utf8_general_ci NOT NULL, 
    `leg_length` int(11) DEFAULT NULL, 
    `route` varchar(500) COLLATE utf8_general_ci DEFAULT NULL, 
    `comments` varchar(500) COLLATE utf8_general_ci DEFAULT NULL
  ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `tour_legs` 
ADD 
  PRIMARY KEY (`tour_leg_id`); 
ALTER TABLE 
  `tour_legs` CHANGE `tour_leg_id` `tour_leg_id` INT(11) NOT NULL AUTO_INCREMENT; CREATE TABLE IF NOT EXISTS `tour_pilots` (
    `tour_pilot_id` int(11) NOT NULL, 
    `tour_id` int(11) NOT NULL, 
    `leg_id` int(11) NOT NULL, 
    `gvauser_id` int(11) NOT NULL, 
    `report_date` date NOT NULL, 
    `status` int(11) NOT NULL
  ) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `tour_pilots` 
ADD 
  PRIMARY KEY (`tour_pilot_id`); 
ALTER TABLE 
  `tour_pilots` CHANGE `tour_pilot_id` `tour_pilot_id` INT(11) NOT NULL AUTO_INCREMENT; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_administration_panel` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_va_parameters` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_hub_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_fleet_type_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_fleet_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_rank_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_pilot_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_route_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_route_assignator` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_user_type_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_jump_validator` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_flight_validator` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_event_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_notam_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_email_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_language_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_vam_acars_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_financial_parameters` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_tour_manager` TINYINT NULL DEFAULT '0'; 
ALTER TABLE 
  `user_types` 
ADD 
  `access_award_manager` TINYINT NULL DEFAULT '0'; 

UPDATE 
  `user_types` 
SET 
  `access_administration_panel` = '1', 
  `access_va_parameters` = '1', 
  `access_hub_manager` = '1', 
  `access_fleet_type_manager` = '1', 
  `access_fleet_manager` = '1', 
  `access_rank_manager` = '1', 
  `access_pilot_manager` = '1', 
  `access_route_manager` = '1', 
  `access_route_assignator` = '1', 
  `access_user_type_manager` = '1', 
  `access_jump_validator` = '1', 
  `access_flight_validator` = '1', 
  `access_event_manager` = '1', 
  `access_notam_manager` = '1', 
  `access_email_manager` = '1', 
  `access_language_manager` = '1', 
  `access_vam_acars_manager` = '1', 
  `access_financial_parameters` = '1', 
  `access_tour_manager` = '1', 
  `access_award_manager` = '1' 
WHERE 
  `user_types`.`user_type_id` = 3; 

ALTER TABLE 
  `vampireps` 
ADD 
  `qnh_takeoff` INT NULL; 
ALTER TABLE 
  `vampireps` 
ADD 
  `qnh_landing` INT NULL; 
ALTER TABLE 
  `vampireps` 
ADD 
  `final_fuel` INT NULL; 
ALTER TABLE 
  `vampireps` 
ADD 
  `landing_hdg` INT NULL; 
ALTER TABLE 
  `vampireps` 
ADD 
  `route_id` INT NULL DEFAULT '0'; 
ALTER TABLE 
  `vampireps` 
ADD 
  `assigned_pax` INT NULL DEFAULT '0'; 
ALTER TABLE 
  `vampireps` 
ADD 
  `assigned_cargo` INT NULL DEFAULT '0'; 
ALTER TABLE 
  `vam_live_acars` 
ADD 
  `plane_type` VARCHAR(4) NULL; 
ALTER TABLE 
  `vam_live_acars` 
ADD 
  `pending_nm` INT NULL; 
ALTER TABLE 
  `vam_track` 
ADD 
  `plane_type` VARCHAR(4) NULL; 
ALTER TABLE 
  `vam_track` 
ADD 
  `pending_nm` INT NULL; 
ALTER TABLE 
  `vam_live_flights` 
ADD 
  `plane_type` VARCHAR(4) NULL; 
ALTER TABLE 
  `vam_live_flights` 
ADD 
  `pending_nm` INT NULL; 
ALTER TABLE 
  `va_parameters` 
ADD 
  `allow_select_aircraft_for_charter` INT NOT NULL; 
update 
  `va_parameters` 
set 
  allow_select_aircraft_for_charter = 0; 
ALTER TABLE 
  `va_parameters` 
ADD 
  `activate_finance_module` TINYINT NULL; 
ALTER TABLE 
  `va_parameters` 
ADD 
  `date_activation_finance_module` TIMESTAMP NULL; 
update 
  va_parameters 
set 
  activate_finance_module = 0; CREATE TABLE IF NOT EXISTS `va_finances` (
    `va_finances_id` int(11) NOT NULL, 
    `parameter_id` int(11) NOT NULL, 
    `finance_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    `amount` FLOAT(11) NOT NULL
  ) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci; 
ALTER TABLE 
  `va_finances` 
ADD 
  PRIMARY KEY (`va_finances_id`); 
ALTER TABLE 
  `va_finances` MODIFY `va_finances_id` int(11) NOT NULL AUTO_INCREMENT; 
ALTER TABLE 
  `va_finances` 
ADD 
  `gvauser_id` INT NOT NULL, 
ADD 
  `description` VARCHAR(1000) NOT NULL, 
ADD 
  `report_type` VARCHAR(20) NOT NULL, 
ADD 
  `report_id` VARCHAR(100) NOT NULL; 
ALTER TABLE 
  `reserves` 
ADD 
  `pax` INT NULL DEFAULT '0'; 
ALTER TABLE 
  `reserves` 
ADD 
  `cargo` INT NULL DEFAULT '0'; 
ALTER TABLE 
  `pireps` 
ADD 
  `pax` INT NULL DEFAULT '0'; 
ALTER TABLE 
  `pireps` 
ADD 
  `cargo` INT NULL DEFAULT '0'; CREATE VIEW v_hours_counter AS 
select 
  gvauser_id, 
  MONTH(flight_date) mes, 
  YEAR(flight_date) ye, 
  SUM(flight_duration) dur 
from 
  vampireps 
group by 
  gvauser_id, 
  MONTH(flight_date), 
  YEAR(flight_date) 
UNION 
select 
  gvauser_id, 
  MONTH(date) mes, 
  YEAR(date) ye, 
  SUM(duration) dur 
from 
  pireps 
group by 
  gvauser_id, 
  MONTH(date), 
  YEAR(date) 
UNION 
select 
  gvauser_id, 
  MONTH(CreatedOn) mes, 
  YEAR(CreatedOn) ye, 
  SUM(FlightTime) dur 
from 
  pirepfsfk 
group by 
  gvauser_id, 
  MONTH(CreatedOn), 
  YEAR(CreatedOn) 
UNION 
select 
  gvauser_id, 
  MONTH(date) mes, 
  YEAR(date) ye, 
  SUM(duration) dur 
from 
  reports 
group by 
  gvauser_id, 
  MONTH(date), 
  YEAR(date); CREATE VIEW v_flights_counter AS 
select 
  gvauser_id, 
  MONTH(flight_date) mes, 
  YEAR(flight_date) ye, 
  count(*) num 
from 
  vampireps 
group by 
  gvauser_id, 
  MONTH(flight_date), 
  YEAR(flight_date) 
UNION 
select 
  gvauser_id, 
  MONTH(date) mes, 
  YEAR(date) ye, 
  count(*) num 
from 
  pireps 
group by 
  gvauser_id, 
  MONTH(date), 
  YEAR(date) 
UNION 
select 
  gvauser_id, 
  MONTH(CreatedOn) mes, 
  YEAR(CreatedOn) ye, 
  count(*) num 
from 
  pirepfsfk 
group by 
  gvauser_id, 
  MONTH(CreatedOn), 
  YEAR(CreatedOn) 
UNION 
select 
  gvauser_id, 
  MONTH(date) mes, 
  YEAR(date) ye, 
  count(*) num 
from 
  reports 
group by 
  gvauser_id, 
  MONTH(date), 
  YEAR(date); CREATE VIEW v_flights_aircraft_counter AS 
select 
  AircraftType as aircraft, 
  count(*) num 
from 
  pirepfsfk 
where 
  CHAR_LENGTH(AircraftType) > 0 
group by 
  AircraftType 
UNION 
select 
  aircraft_type as aircraft, 
  count(*) num 
from 
  vampireps 
where 
  CHAR_LENGTH(aircraft_type) > 0 
group by 
  aircraft_type 
UNION 
select 
  plane_type as aircraft, 
  count(*) num 
from 
  pireps 
where 
  CHAR_LENGTH(plane_type) > 0 
group by 
  plane_type 
order by 
  num desc;

INSERT INTO `languages` (`id`, `language_name`, `file_sufix`) VALUES ('1000', 'Deutsche', 'de');

--
-- VAM 2.5.1 SCHEMA CHANGES 2015 NOVEMBER
--

ALTER TABLE `fleets` ADD `gvauser_id` INT(11) NULL DEFAULT NULL AFTER `booked_at`;



--
-- VAM 2.6 SCHEMA CHANGES 2016 NOVEMBER
--


-- VA_PARAMETERS TABLE CHANGES

ALTER TABLE `va_parameters` ADD `date_format` VARCHAR(20) NOT NULL DEFAULT '%Y-%m-%d',
ADD `time_format` VARCHAR(20) NOT NULL DEFAULT '1' , ADD `auto_approval` INT NOT NULL DEFAULT '0';
ALTER TABLE `va_parameters` ADD `hours_auto_cancellation` TINYINT(11) NULL DEFAULT '24';




-- VAM_LIVE_FLIGHTS AND VAM_LIVE_ACARS TABLE CHANGES

ALTER TABLE `vam_live_flights` ADD `network` VARCHAR(50) NULL DEFAULT NULL;
ALTER TABLE `vam_live_acars` ADD `network` VARCHAR(50) NULL DEFAULT NULL;

-- EXTEND VARCHAR FIELDS FOR NOTMAS AND EVENTS (READY FOR CK EDITOR)

ALTER TABLE `notams` CHANGE `notam_text` `notam_text` VARCHAR(20000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `events` CHANGE `event_text` `event_text` VARCHAR(20000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

-- NEW TABLE FOR WEB SECTION CONFIGURATION

CREATE TABLE `web_configurations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `welcome_text` VARCHAR(30000) NULL,
  `rules` VARCHAR(60000) NULL,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `web_configurations` ADD `school` VARCHAR(600000);


-- NEW SECURITY FUNCTIONS FOR ADMIN PANEL
ALTER TABLE `user_types` ADD `access_training_manager` TINYINT(4) NULL DEFAULT '0' , ADD `access_web_manager` TINYINT(4) NULL DEFAULT '0';
ALTER TABLE `user_types` ADD `access_simacars_manager` TINYINT(11) NOT NULL DEFAULT '0' , ADD `access_manual_manager` TINYINT(11) NOT NULL DEFAULT '0' , ADD `access_airports_manager` TINYINT(11) NOT NULL DEFAULT '0';

-- NEW TABLE FOR STAFF CONFIGURATION

CREATE TABLE `staffs` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `image_url` VARCHAR(500) NULL,
  `email` VARCHAR(200) NULL,
  `description` VARCHAR(9000) NULL,
    `role` VARCHAR(200) NULL,
    `name` VARCHAR(200) NULL,
    `display_position` INT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;



-- NEW TABLE COURSES

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `name` varchar(2000) NOT NULL,
  `description` varchar (9000) NOT NULL,
  `content` varchar (9000) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;



-- NEW TABLE TRAINING

CREATE TABLE `trainings` (
  `training_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `description` varchar (9000),
  `content` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `training_duration` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `trainings`
  ADD PRIMARY KEY (`training_id`);

ALTER TABLE `trainings`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT;

-- TABLE TOURS CHANGES

ALTER TABLE `tours` CHANGE `tour_description` `tour_description` VARCHAR(9000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

-- TABLE VAMPIREPS CHANGES

ALTER TABLE `vampireps` ADD `fob` BIGINT NULL;

-- TABLE CONFIG_EMAILS CHANGES

ALTER TABLE `config_emails` ADD `warning_text` VARCHAR(5000) NULL ;


-- NEW TABLE PILOT WARNING

CREATE TABLE `pilot_warning` (
  `id` int(11) NOT NULL,
  `gvauser_id` int(11) NOT NULL,
  `warning_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE = MyISAM;

ALTER TABLE `pilot_warning`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `pilot_warning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- TABLE GVAUSERS CHANGES

ALTER TABLE `gvausers` CHANGE `hub_id` `hub_id` INT(11) NULL DEFAULT NULL;

-- INDEX CREATION
ALTER TABLE airports ADD INDEX ( ident );
ALTER TABLE gvausers ADD INDEX ( gvauser_id );

-- VIEW change (used in home page)
DROP VIEW IF EXISTS v_last_5_flights;
create view v_last_5_flights as
SELECT g.gvauser_id, g.callsign as callsign , concat (g.name,' ',g.surname) as pilot_name, departure, arrival, date, time
FROM v_total_data_flight vtf inner join gvausers g on g.gvauser_id=vtf.pilot
WHERE date is not null order by date desc LIMIT 5;

-- FEED WEB_CONFIGURATION TABLE

INSERT INTO web_configurations (`id`, `last_update`, `welcome_text`, `rules`, `school`) VALUES (NULL, CURRENT_TIMESTAMP, NULL, NULL, NULL);

-- New Languages

INSERT INTO `languages` (`language_name`, `file_sufix`)
VALUES
  ('日本の','jp'),
  ('Ελληνικά','gr'),
  ('Polski','pl'),
  ('فارسی','fa'),
  ('Srpski','rs'),
  ('Brasileiro','ptbr');
  

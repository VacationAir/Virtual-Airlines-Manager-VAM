--
-- VAM 2.6 SCHEMA CHANGES 2016 NOVEMBER
--
-- **********************************************************************************************
-- *************** APPLY ONLY IF YOU HAVE vam 2.5.2 INSTALLED ************************************
-- **********************************************************************************************


-- VA_PARAMETERS TABLE CHANGES

ALTER TABLE `va_parameters` ADD `date_format` VARCHAR(20) NOT NULL ,
ADD `time_format` VARCHAR(20) NOT NULL , ADD `auto_approval` INT NOT NULL DEFAULT '0';
ALTER TABLE `va_parameters` ADD `hours_auto_cancellation` TINYINT(11) NULL;




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

-- set default values to VA PARAMETERS

update va_parameters set date_format='%Y-%m-%d';
update va_parameters set time_format=1;
update va_parameters set auto_approval=0;
update va_parameters set hours_auto_cancellation=24;


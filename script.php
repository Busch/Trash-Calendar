<?php

	date_default_timezone_set('Europe/Berlin');

	// BEGIN GLOBAL VARIABLES //

	$database_dir = "Database";

	$bezirk = $_GET["bezirk"];
	$strasse = $_GET["strasse"];
	$hausmuell = $_GET["hausmuell"];
	$notification_time_hausmuell = $_GET["notify_hausmuell"];
	$gelbersack = $_GET["gelbersack"];
	$notification_time_gelbersack = $_GET["notify_gelbersack"];
	$bioabfall = $_GET["bioabfall"];
	$notification_time_bioabfall = $_GET["notify_bioabfall"];
	$blauetonne = $_GET["blauetonne"];
	$notification_time_blauetonne = $_GET["notify_blauetonne"];
	$vereinssammlung = $_GET["vereinssammlung"];
	$notification_time_vereinssammlung = $_GET["notify_vereinssammlung"];
	$gruenabfuhr = $_GET["gruenabfuhr"];
	$notification_time_gruenabfuhr = $_GET["notify_gruenabfuhr"];

	/*
	// ONLY FOR CONSOLE TESTING!!!! //
	$bezirk = "Aalen";
	$strasse = "Affalterried";
	$hausmuell = "1";
	$notification_time_hausmuell = "10";
	$gelbersack = "1";
	$notification_time_gelbersack = "0";
	$bioabfall = "1";
	$notification_time_bioabfall = "0";
	$blauetonne = "1";
	$notification_time_blauetonne = "0";
	$vereinssammlung = "1";
	$notification_time_vereinssammlung = "0";
	$gruenabfuhr = "1";
	$notification_time_gruenabfuhr = "0";
	// ONLY FOR CONSOLE TESTING!!!! //
	*/

	$cal_name = "GOA Abfuhrkalender 2013/2014";
	$cal_prod_id = "//Michael Weishaar//dav.datenschleuder.com Web-Client v0.1//EN";
	$cal_desc = "Abfuhrkalender für 2013/2014";
	$cal_color = "#0E61B9";
	$cal_timezone_apple = "Europe/Berlin";
	$cal_tzid = "Europe/Berlin";
	$cal_scale = "GREGORIAN";
	$cal_tzoffsetfrom = "+0100";
	$cal_tzname = "GMT+2";
	$cal_tzoffseto = "+0200";
	$cal_location = $bezirk;
	$startDate = "2013-04-01";
	$endDate = "2014-03-31";

	$cal_vevent_begin_vevent = "BEGIN:VEVENT";
	$cal_vevent_created = "CREATED:" . date("Ymd") . "T" . date("His") . "Z";
	$cal_vevent_uid = "UID:";
	$cal_vevent_dtend = "DTEND;TZID=" . $cal_tzid . ":";
	$cal_vevent_dtstart = "DTSTART;TZID=" . $cal_tzid . ":";
	$cal_vevent_dtstamp = "DTSTAMP:" . date("Ymd") . "T" . date("His") . "Z";
	$cal_vevent_begin_valarm = "BEGIN:VALARM";
	$cal_vevent_alarm_uid_apple = "X-WR-ALARMUID:";
	$cal_vevent_alarm_uid = "UID:";
	$cal_vevent_attach_uri = "ATTACH;VALUE=URI:Basso";
	$cal_vevent_action = "ACTION:AUDIO";
	$cal_vevent_end_valarm = "END:VALARM";
	$cal_vevent_end_vevent = "END:VEVENT";

	// Anfang/Ende der Datumszeilen
	$begin_hausmuell = 0;
	$end_hausmuell = 0;
	$begin_gelbersack = 0;
	$end_gelbersack = 0;
	$begin_bioabfall = 0;
	$end_bioabfall = 0;
	$begin_bltonne = 0;
	$end_bltonne = 0;
	$begin_vereinssammlung = 0;
	$end_vereinssammlung = 0;
	$begin_gruenabfuhr = 0;
	$end_gruenabfuhr = 0;


	$file = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");

	for ($i=0; $i < count($file); $i++) { 
		if ($file[$i] == "Hausmüllabfuhr\r\n") {
			$begin_hausmuell = $i;
			$present_hausmuell = "1";
		} elseif ($file[$i] == "GelberSack\r\n") {
			$end_hausmuell = $i - 1;
			$begin_gelbersack = $i;
			$present_gelbersack = "1";
		} elseif ($file[$i] == "Bioabfall\r\n") {
			$end_gelbersack = $i - 1;
			$begin_bioabfall = $i;	
			$present_bioabfall = "1";
		} elseif ($file[$i] == "AltpapierBlaueTonne\r\n") {
			$end_bioabfall = $i - 1;
			$begin_bltonne = $i;
			$present_bltonne = "1";
		} elseif ($file[$i] == "AltpapierVereinssammlung\r\n") {
			$end_bltonne = $i - 1;
			$begin_vereinssammlung = $i;
			$present_vereinssammlung = "1";
		} elseif ($file[$i] == "Grünabfuhr\r\n") {
			$end_bltonne = $i - 1; // UNBEDINGT SCHAUEN OB DAS SO OK IST !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			$end_vereinssammlung = $i - 1;	
			$begin_gruenabfuhr = $i;
			$present_gruenabfuhr = "1";
		}
		$end_gruenabfuhr = $i;
	} // End for

	$onetime_uid = uniqid();
	$file = "";

	// END GLOBAL VARIABLES //


	// BEGIN CHECK FOR CORRECT INPUT //

	// END CHECK FOR CORRECT INPUT //


	// BEGIN CALL FUNCTIONS //

	write_metadata1();

	if (!$hausmuell != "1") {
		if ($present_hausmuell == "1") {
		$cal_vevent_trigger = "TRIGGER:-PT" . $notification_time_hausmuell . "H";
		write_vevents_hausmuell();
		}
	}
	
	if (!$gelbersack != "1") {
		if ($present_gelbersack == "1") {
		$cal_vevent_trigger = "TRIGGER:-PT" . $notification_time_gelbersack . "H";
		write_vevents_gelbersack();
		}
	}

	if (!$bioabfall != "1") {
		if ($present_bioabfall == "1") {
		$cal_vevent_trigger = "TRIGGER:-PT" . $notification_time_bioabfall . "H";
		write_vevents_bioabfall();
		}
	}

	if (!$blauetonne != "1") {
		if ($present_bltonne == "1") {
		$cal_vevent_trigger = "TRIGGER:-PT" . $notification_time_blauetonne . "H";
		write_vevents_blauetonne();
		}
	}

	if (!$vereinssammlung != "1") {
		if ($present_vereinssammlung == "1") {
			$cal_vevent_trigger = "TRIGGER:-PT" . $notification_time_vereinssammlung . "H";
			write_vevents_vereinssammlung();
		}
	}

	if (!$gruenabfuhr != "1") {
		if ($present_gruenabfuhr == "1") {
		$cal_vevent_trigger = "TRIGGER:-PT" . $notification_time_gruenabfuhr . "H";
		write_vevents_gruenabfuhr();
		}
	}

	
	write_metadata2();
	write_output();
	notify();

	// END CALL FUNCTIONS //


	function write_metadata1() {

		global $cal_name, $cal_prod_id, $cal_desc, $cal_color, $cal_timezone_apple, $cal_scale, $cal_tzoffsetfrom, $cal_tzname, $cal_tzoffseto, $cal_tzid;

		$cal_vcal = "BEGIN:VCALENDAR\nMETHOD:PUBLISH\nVERSION:2.0";
		$cal_name = "X-WR-CALNAME:" . $cal_name;
		$cal_prod_id = "PRODID:-" . $cal_prod_id;
		$cal_desc = "X-WR-CALDESC:" . $cal_desc;
		$cal_color = "X-APPLE-CALENDAR-COLOR:" . $cal_color;
		$cal_timezone_apple = "X-WR-TIMEZONE:" . $cal_timezone;
		$cal_scale = "CALSCALE:" . $cal_scale;
		$cal_begin_vtimez = "BEGIN:VTIMEZONE";
		$cal_tzid = "TZID:" . $cal_tzid;
		$cal_begin_daylight = "BEGIN:DAYLIGHT";
		$cal_tzoffsetfrom = "TZOFFSETFROM:" . $cal_tzoffsetfrom;
		$cal_dtstart = "DTSTART:19810329T020000";
		$cal_tzname = "TZNAME:" . $cal_tzname;
		$cal_tzoffseto = "TZOFFSETTO:" . $cal_tzoffseto;
		$cal_end_daylight = "END:DAYLIGHT";
		$cal_begin_standard = "BEGIN:STANDARD";
		$cal_dtstart2 = "DTSTART:19961027T030000";
		$cal_tzname2 = "TZNAME:GMT+1";
		$cal_tzoffseto2 = "TZOFFSETTO:+0100";
		$cal_end_standard = "END:STANDARD";
		$cal_end_vtimez = "END:VTIMEZONE";

		write_to_file($cal_vcal);
		write_to_file($cal_name);
		write_to_file($cal_prod_id);
		write_to_file($cal_desc);
		write_to_file($cal_color);
		write_to_file($cal_timezone);
		write_to_file($cal_scale);
		write_to_file($cal_begin_vtimez);
		write_to_file($cal_tzid);
		write_to_file($cal_begin_daylight);
		write_to_file($cal_tzoffsetfrom);
		write_to_file($cal_dtstart);
		write_to_file($cal_tzname);
		write_to_file($cal_tzoffseto);
		write_to_file($cal_end_daylight);
		write_to_file($cal_begin_standard);
		write_to_file($cal_tzoffsetfrom);
		write_to_file($cal_dtstart2);
		write_to_file($cal_tzname2);
		write_to_file($cal_tzoffseto2);
		write_to_file($cal_end_standard);
		write_to_file($cal_end_vtimez);

	} // End function get_metadata1()



	function write_metadata2() {

		write_to_file("END:VCALENDAR");

	} // End function get_metadata2()



	function write_vevents_hausmuell() {

		global $cal_vevent_begin_vevent, $cal_vevent_created, $cal_vevent_uid, $cal_vevent_dtend, $database_dir, $bezirk, $strasse, $cal_vevent_dtstart, $cal_vevent_dtstamp, $cal_location, $cal_vevent_begin_valarm, $cal_vevent_alarm_uid_apple, $cal_vevent_alarm_uid, $cal_vevent_trigger, $cal_vevent_attach_uri, $cal_vevent_action, $cal_vevent_end_valarm, $cal_vevent_end_vevent, $end_hausmuell, $begin_hausmuell;


		for ($i=0; $i < $end_hausmuell - $begin_hausmuell - 1; $i++) { 

			$temp = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");
			$date = $temp[$begin_hausmuell + $i + 2];
			
			write_to_file($cal_vevent_begin_vevent);
			write_to_file($cal_vevent_created);
			write_to_file($cal_vevent_uid . get_uid());
			write_to_file($cal_vevent_dtend . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T160000");
			write_to_file("SUMMARY:GOA Hausmüll");
			write_to_file($cal_vevent_dtstart . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T070000");
			write_to_file($cal_vevent_dtstamp);
			write_to_file("LOCATION:" . $cal_location);
			write_to_file($cal_vevent_begin_valarm);
			write_to_file($cal_vevent_alarm_uid_apple . get_uid());
			write_to_file($cal_vevent_alarm_uid . get_uid());
			write_to_file($cal_vevent_trigger);
			write_to_file($cal_vevent_attach_uri);
			write_to_file($cal_vevent_action);
			write_to_file($cal_vevent_end_valarm);
			write_to_file($cal_vevent_end_vevent);

		} // End for

	} // End funtion write_vevents_hausmuell



	function write_vevents_gelbersack() {

		global $cal_vevent_begin_vevent, $cal_vevent_created, $cal_vevent_uid, $cal_vevent_dtend, $database_dir, $bezirk, $strasse, $cal_vevent_dtstart, $cal_vevent_dtstamp, $cal_location, $cal_vevent_begin_valarm, $cal_vevent_alarm_uid_apple, $cal_vevent_alarm_uid, $cal_vevent_trigger, $cal_vevent_attach_uri, $cal_vevent_action, $cal_vevent_end_valarm, $cal_vevent_end_vevent, $end_gelbersack, $begin_gelbersack;


		for ($i=0; $i < $end_gelbersack - $begin_gelbersack - 1; $i++) { 

			$temp = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");
			$date = $temp[$begin_gelbersack + $i + 2];			
			
			write_to_file($cal_vevent_begin_vevent);
			write_to_file($cal_vevent_created);
			write_to_file($cal_vevent_uid . get_uid());
			write_to_file($cal_vevent_dtend . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T160000");
			write_to_file("SUMMARY:GOA Gelber Sack");
			write_to_file($cal_vevent_dtstart . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T070000");
			write_to_file($cal_vevent_dtstamp);
			write_to_file("LOCATION:" . $cal_location);
			write_to_file($cal_vevent_begin_valarm);
			write_to_file($cal_vevent_alarm_uid_apple . get_uid());
			write_to_file($cal_vevent_alarm_uid . get_uid());
			write_to_file($cal_vevent_trigger);
			write_to_file($cal_vevent_attach_uri);
			write_to_file($cal_vevent_action);
			write_to_file($cal_vevent_end_valarm);
			write_to_file($cal_vevent_end_vevent);

		} // End for

	} // End funtion write_vevents_gelbersack


	function write_vevents_bioabfall() {

		global $cal_vevent_begin_vevent, $cal_vevent_created, $cal_vevent_uid, $cal_vevent_dtend, $database_dir, $bezirk, $strasse, $cal_vevent_dtstart, $cal_vevent_dtstamp, $cal_location, $cal_vevent_begin_valarm, $cal_vevent_alarm_uid_apple, $cal_vevent_alarm_uid, $cal_vevent_trigger, $cal_vevent_attach_uri, $cal_vevent_action, $cal_vevent_end_valarm, $cal_vevent_end_vevent, $end_bioabfall, $begin_bioabfall, $startDate, $endDate;	

		$endDate = strtotime($endDate);

		for ($i=0; $i < $end_bioabfall - $begin_bioabfall - 1; $i++) { 

			$temp = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");
			$date = $temp[$begin_bioabfall + $i + 2];

			$bio_day = $temp[$begin_bioabfall + 1];
			
			write_to_file($cal_vevent_begin_vevent);
			write_to_file($cal_vevent_created);
			write_to_file($cal_vevent_uid . get_uid());
			write_to_file($cal_vevent_dtend . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T160000");
			write_to_file("SUMMARY:GOA Bioabfall");
			write_to_file($cal_vevent_dtstart . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T070000");
			write_to_file($cal_vevent_dtstamp);
			write_to_file("LOCATION:" . $cal_location);
			write_to_file($cal_vevent_begin_valarm);
			write_to_file($cal_vevent_alarm_uid_apple . get_uid());
			write_to_file($cal_vevent_alarm_uid . get_uid());
			write_to_file($cal_vevent_trigger);
			write_to_file($cal_vevent_attach_uri);
			write_to_file($cal_vevent_action);
			write_to_file($cal_vevent_end_valarm);
			write_to_file($cal_vevent_end_vevent);

			// Kalenderwochen in Array
			$kalenderwoche[$i] = date("W", strtotime($date[4] . $date[5] . $date[6] . $date[7] .  $date[2] . $date[3] . $date[0] . $date[1]));

		} // End for

		if ($bio_day == "Montag\r\n") { $day = "Monday"; } 
		elseif ($bio_day == "Dienstag\r\n") { $day = "Tuesday"; } 
		elseif ($bio_day == "Mittwoch\r\n") { $day = "Wednesday"; } 
		elseif ($bio_day == "Donnerstag\r\n") { $day = "Thursday"; } 
		elseif ($bio_day == "Freitag\r\n") { $day = "Friday"; } 
		elseif ($bio_day == "Samstag\r\n") { $day = "Saturday"; } 
		elseif ($bio_day == "Sonntag\r\n") { $day = "Sunday"; }

		for($i = strtotime($day, strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i)) {

			// Wenn Event in gleicher KW: Event nicht schreiben!
			if (in_array(date("W", strtotime(date("Ymd", $i))), $kalenderwoche)) {
				// NOP NOP...
			} else {

				$temp = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");
				$date = $temp[$begin_bioabfall + $i + 2];

				write_to_file($cal_vevent_begin_vevent);
				write_to_file($cal_vevent_created);
				write_to_file($cal_vevent_uid . get_uid());
				write_to_file($cal_vevent_dtend . date("Ymd", $i) . "T160000");
				write_to_file("SUMMARY:GOA Bioabfall");
				write_to_file($cal_vevent_dtstart . date("Ymd", $i) . "T070000");
				write_to_file($cal_vevent_dtstamp);
				write_to_file("LOCATION:" . $cal_location);
				write_to_file($cal_vevent_begin_valarm);
				write_to_file($cal_vevent_alarm_uid_apple . get_uid());
				write_to_file($cal_vevent_alarm_uid . get_uid());
				write_to_file($cal_vevent_trigger);
				write_to_file($cal_vevent_attach_uri);
				write_to_file($cal_vevent_action);
				write_to_file($cal_vevent_end_valarm);
				write_to_file($cal_vevent_end_vevent);
			}

		} // End for

	} // End funtion write_vevents_bioabfall



	function write_vevents_blauetonne() {

		global $cal_vevent_begin_vevent, $cal_vevent_created, $cal_vevent_uid, $cal_vevent_dtend, $database_dir, $bezirk, $strasse, $cal_vevent_dtstart, $cal_vevent_dtstamp, $cal_location, $cal_vevent_begin_valarm, $cal_vevent_alarm_uid_apple, $cal_vevent_alarm_uid, $cal_vevent_trigger, $cal_vevent_attach_uri, $cal_vevent_action, $cal_vevent_end_valarm, $cal_vevent_end_vevent, $end_bltonne, $begin_bltonne;

		for ($i=0; $i < $end_bltonne - $begin_bltonne - 1; $i++) { 

			$temp = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");
			$date = $temp[$begin_bltonne + $i + 2];
			
			write_to_file($cal_vevent_begin_vevent);
			write_to_file($cal_vevent_created);
			write_to_file($cal_vevent_uid . get_uid());
			write_to_file($cal_vevent_dtend . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T160000");
			write_to_file("SUMMARY:GOA Blaue Tonne");
			write_to_file($cal_vevent_dtstart . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T070000");
			write_to_file($cal_vevent_dtstamp);
			write_to_file("LOCATION:" . $cal_location);
			write_to_file($cal_vevent_begin_valarm);
			write_to_file($cal_vevent_alarm_uid_apple . get_uid());
			write_to_file($cal_vevent_alarm_uid . get_uid());
			write_to_file($cal_vevent_trigger);
			write_to_file($cal_vevent_attach_uri);
			write_to_file($cal_vevent_action);
			write_to_file($cal_vevent_end_valarm);
			write_to_file($cal_vevent_end_vevent);

		} // End for


	} // End funtion write_vevents_blauetonne


	function write_vevents_vereinssammlung() {

		global $cal_vevent_begin_vevent, $cal_vevent_created, $cal_vevent_uid, $cal_vevent_dtend, $database_dir, $bezirk, $strasse, $cal_vevent_dtstart, $cal_vevent_dtstamp, $cal_location, $cal_vevent_begin_valarm, $cal_vevent_alarm_uid_apple, $cal_vevent_alarm_uid, $cal_vevent_trigger, $cal_vevent_attach_uri, $cal_vevent_action, $cal_vevent_end_valarm, $cal_vevent_end_vevent, $end_vereinssammlung, $begin_vereinssammlung;

		for ($i=0; $i < $end_vereinssammlung - $begin_vereinssammlung; $i++) { 

			$temp = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");
			$date = $temp[$begin_vereinssammlung + $i + 1];
			
			write_to_file($cal_vevent_begin_vevent);
			write_to_file($cal_vevent_created);
			write_to_file($cal_vevent_uid . get_uid());
			write_to_file($cal_vevent_dtend . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T160000");
			write_to_file("SUMMARY:GOA Altpapier Vereinssammlung");
			write_to_file($cal_vevent_dtstart . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T070000");
			write_to_file($cal_vevent_dtstamp);
			write_to_file("LOCATION:" . $cal_location);
			write_to_file($cal_vevent_begin_valarm);
			write_to_file($cal_vevent_alarm_uid_apple . get_uid());
			write_to_file($cal_vevent_alarm_uid . get_uid());
			write_to_file($cal_vevent_trigger);
			write_to_file($cal_vevent_attach_uri);
			write_to_file($cal_vevent_action);
			write_to_file($cal_vevent_end_valarm);
			write_to_file($cal_vevent_end_vevent);

		} // End for

	} // End funtion write_vevents_vereinssammlung


	function write_vevents_gruenabfuhr() {

		global $cal_vevent_begin_vevent, $cal_vevent_created, $cal_vevent_uid, $cal_vevent_dtend, $database_dir, $bezirk, $strasse, $cal_vevent_dtstart, $cal_vevent_dtstamp, $cal_location, $cal_vevent_begin_valarm, $cal_vevent_alarm_uid_apple, $cal_vevent_alarm_uid, $cal_vevent_trigger, $cal_vevent_attach_uri, $cal_vevent_action, $cal_vevent_end_valarm, $cal_vevent_end_vevent, $end_gruenabfuhr, $begin_gruenabfuhr;


		for ($i=0; $i < $end_gruenabfuhr - $begin_gruenabfuhr - 1; $i++) { 

			$temp = file($database_dir . "/" . $bezirk . "_" . $strasse . ".txt");
			$date = $temp[$begin_gruenabfuhr + $i + 1];
			
			write_to_file($cal_vevent_begin_vevent);
			write_to_file($cal_vevent_created);
			write_to_file($cal_vevent_uid . get_uid());
			write_to_file($cal_vevent_dtend . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T160000");
			write_to_file("SUMMARY:GOA Grünabfuhr");
			write_to_file($cal_vevent_dtstart . $date[4] . $date[5] . $date[6] . $date[7] . $date[2] . $date[3] . $date[0] . $date[1] . "T070000");
			write_to_file($cal_vevent_dtstamp);
			write_to_file("LOCATION:" . $cal_location);
			write_to_file($cal_vevent_begin_valarm);
			write_to_file($cal_vevent_alarm_uid_apple . get_uid());
			write_to_file($cal_vevent_alarm_uid . get_uid());
			write_to_file($cal_vevent_trigger);
			write_to_file($cal_vevent_attach_uri);
			write_to_file($cal_vevent_action);
			write_to_file($cal_vevent_end_valarm);
			write_to_file($cal_vevent_end_vevent);

		} // End for

	} // End funtion write_vevents_gruenabfuhr


	function get_uid() {

		$uid = uniqid() . "@dav.datenschleuder.com";
		return $uid;

	} // End function get_uid

	function write_to_file($data) {

		global $hausmuell, $gelbersack, $bioabfall, $blauetonne, $vereinssammlung, $gruenabfuhr, $onetime_uid, $bezirk, $strasse;

		if ($hausmuell == 1) { $postfix = $postfix . "h"; }
		if ($gelbersack == 1) { $postfix = $postfix . "g"; }
		if ($bioabfall == 1) { $postfix = $postfix . "b"; }
		if ($blauetonne == 1) { $postfix = $postfix . "t"; }
		if ($vereinssammlung == 1) { $postfix = $postfix . "v"; }
		if ($gruenabfuhr == 1) { $postfix = $postfix . "a"; }

		$file = "webcal/" . $bezirk . "_" . $strasse . "_" . $onetime_uid . "_" . $postfix . ".ics";

		file_put_contents($file, $data . "\n", FILE_APPEND | LOCK_EX);

		// Only for console testing!!!
		// echo $data . "\n";

	} // End function write_file

	function write_output() {

		global $file, $bezirk, $strasse, $onetime_uid, $hausmuell, $gelbersack, $bioabfall, $blauetonne, $vereinssammlung, $gruenabfuhr;

		if ($hausmuell == 1) { $postfix = $postfix . "h"; }
		if ($gelbersack == 1) { $postfix = $postfix . "g"; }
		if ($bioabfall == 1) { $postfix = $postfix . "b"; }
		if ($blauetonne == 1) { $postfix = $postfix . "t"; }
		if ($vereinssammlung == 1) { $postfix = $postfix . "v"; }
		if ($gruenabfuhr == 1) { $postfix = $postfix . "a"; }

		$url = "webcal://dav.datenschleuder.com/webcal/";
		$file = $url . urlencode($bezirk) . "_" . urlencode($strasse) . "_" . $onetime_uid . "_" . $postfix . ".ics";
		echo $file;

	} // End function write_output()

	function notify() {

		global $file;

		// E-Mail new subscription
		$to = "busch@datenschleuder.com";
 		$subject = "#newcalendersubscription";
 		$body = $file;
 		$headers = "From: GOA-Calendar-Web-Frontend\r\n";
 		mail($to, $subject, $body, $headers);
 		
 		// Pushover new subscription
 		curl_setopt_array($ch = curl_init(), array(
 		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_URL => "https://api.pushover.net/1/messages.json",
  		CURLOPT_POSTFIELDS => array(
    		"token" => "4YJUkNWerWvKgmNcamN8CY1cpJZdho",
    		"user" => "EtrEtbN4UxynxRgNiwX7xT8bosNXj4",
    		"message" => "New Calendar Subscription",
    		"url" => $file,
  		)));
		curl_exec($ch);
		curl_close($ch);

 	} // End function notify()
?>
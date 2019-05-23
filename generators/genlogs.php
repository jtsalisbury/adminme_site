<?php
	include("../steamauth/mysql.php");

	$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `logs` ORDER BY timestamp DESC LIMIT 200");
	$stmt->execute();

	$events = array();
	$evs = array();

	while ($row = $stmt->fetch()) {
		$steamid = $row["steamid"];
		$event   = $row["event"];
		$time    = gmdate("m/d/Y H:i:s", $row["timestamp"]);

		$events[] = array("steamid" => $steamid, "event" => $event, "time" => $time);
	}

	$evs['events'] = $events;

	echo json_encode($events);
?>
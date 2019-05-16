<?php

	$skipCheck = true;
	include("../steamauth/mysql.php");

	$sql = "SELECT * FROM `logs` ORDER BY id DESC LIMIT 200";
	$res = $link->query($sql);
	$events = array();
	$evs = array();

	$dto = new DateTime();

	while ($row = $res->fetch_assoc()) {
		$steamid = $row["steamid"];
		$event   = $row["event"];
		$time    = $dto->setTimestamp($row["timestamp"]);

		$events[] = array("steamid" => $steamid, "event" => $event, "time" => $time->format("m/d/Y h:i:s"));
	}

	$evs['events'] = $events;

	echo json_encode($events);


?>

<?php
	include("../steamauth/mysql.php");

	$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `bans` ORDER BY banned_timestamp DESC");
	$stmt->execute();

	$events = array();
	$evs = array();

	while ($row = $stmt->fetch()) {
		$steamid = $row["banned_steamid"];
		$reason  = $row["banned_reason"];
		
		$time    = date("m/d/Y H:i:s", $row["banned_timestamp"]);

		$active  = $row["ban_active"];
		if ($active == 1) {
			$active = "Yes";
		} else {
			$active = "No";
		}
		$bannedName = $row["banned_name"];

		$events[] = array("steamid" => $steamid, "reason" => $reason, "time" => $time, "active" => $active, "name" => $bannedName, "moreOptions" =>
			"<input onclick='viewMore(".$row["id"].");' class='viewMore btn btn-primary' type='submit' value='View More' style='float: left; margin-left: 10px'>");
	}

	$evs['events'] = $events;

	echo json_encode($events);
?>
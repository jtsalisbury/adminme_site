<?php
	$skipCheck = true;
	include("../steamauth/mysql.php");

	$sql = "SELECT * FROM `users` ORDER BY rank DESC";
	$res = $link->query($sql);
	$users = array();

	while ($row = $res->fetch_assoc()) {
		$steamid = $row["steamid"];
		$name    = $row["name"];
		$ranks   = $row["rank"];

		$rankPretty = "";
		$rankList = json_decode($ranks);
		foreach ($rankList as $ran => $serv) {
			$servPretty = "";

			foreach ($serv as $serv) {
				$servPretty = $servPretty . $serv . ", ";
			}
			$servPretty = rtrim($servPretty, ", ");

			$rankPretty = $rankPretty . "<strong>" . $ran . "</strong> (" . $servPretty . "), ";
		}
		$rankPretty = rtrim($rankPretty, ", ");

		$users[] = array("steamid" => $steamid, "name" => $name, "rank" => $rankPretty);
	}

	echo json_encode($users);
?>

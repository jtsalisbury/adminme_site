<?php

	include("../steamauth/mysql.php");



	$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `users` ORDER BY `rank` DESC");

	$stmt->execute();

	$users = array();



	while ($row = $stmt->fetch()) {

		$steamid = $row["steamid"];

		$name   = $row["name"];

		$rank    = $row["rank"];



		$users[] = array("steamid" => $steamid, "name" => $name, "rank" => $rank);

	}



	echo json_encode($users);

?>
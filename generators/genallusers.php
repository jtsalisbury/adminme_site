<?php
	$skipCheck = true;
	include("../steamauth/mysql.php");

	$sql = "SELECT * FROM `play_times` ORDER BY last_join DESC";
	$res = $link->query($sql);
	$users = array();
	$dto = new DateTime();

	while ($row = $res->fetch_assoc()) {
		$steamid = $row["steamid"];
		$name    = $row["nick"];
		$last_join = $dto->setTimestamp($row["last_join"]);
    $play_time = $row["play_time_seconds"];

		$H = floor($play_time / 3600);
		$i = ($play_time / 60) % 60;
		$s = $play_time % 60;

		$users[] = array(
      "steamid" => $steamid,
      "name" => $name,
      "last_join" => $dto->format("m/d/Y h:i:s"),
      "play_time" => $H." hours, ".$i." minutes, and " . $s. " seconds"
    );
	}

	echo json_encode($users);
?>

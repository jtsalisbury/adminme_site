<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");

	$id = $_POST["id"];
	$name = $_POST["name"];
	$rank = $_POST["rank"];

	$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `bans` WHERE `id` = :id");
	if ($stmt->execute(array(":id" => $id))) {
		$row = $stmt->fetch();

		$toEncode = array(
			"ban_active" => $row["ban_active"],
			"banned_name" => $row["banned_name"],
			"banned_reason" => $row["banned_reason"],
			"banned_steamid" => $row["banned_steamid"],
			"banned_time" => $row["banned_time"],
			"banned_timestamp" => gmdate("m/d/Y H:i:s", $row["banned_timestamp"]),
			"unbanned_timestamp" => gmdate("m/d/Y H:i:s", $row["banned_timestamp"] + $row["banned_time"]),
			"banner_name" => $row["banner_name"],
			"banner_steamid" => $row["banner_steamid"]
		);

		die(json_encode($toEncode));
	}

	die("fail");
?>
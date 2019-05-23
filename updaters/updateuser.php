<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	checkLogin();

	$id = $_POST["steamid"];
	$rank = $_POST["rank"];
	$server = $_POST["server"];

	$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `users` WHERE `steamid` = :steamid");
	$stmt->execute(array(":steamid" => $id));
	if (count($stmt->fetch()) == 0) {
		die("There is no user with that ID!");
	}

	$stmt;
	if ($rank == "user") {
		$stmt = $GLOBALS["link"]->prepare("DELETE FROM `users` WHERE `steamid` = :id");
		$stmt->execute(array(":id" => $id));
	} else {
		$stmt = $GLOBALS["link"]->prepare("UPDATE `users` SET `rank` = :rank, `server` = :server WHERE `steamid` = :id");
		$stmt->execute(array(":rank" => $rank, ":id" => $id, ":server" => $server));
	}

	if (count($stmt->fetch()) == 0) {
		die("fail");
	}

	echo "success";
?>
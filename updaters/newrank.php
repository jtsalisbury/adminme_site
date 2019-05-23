<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	checkLogin();

	$rank = $_POST["rank"];
	$perms = $_POST["perms"];
	$heirarchy = $_POST["heirarchy"];

	$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `ranks` WHERE `rank` = :rank");
	$stmt->execute(array(":rank" => $rank));
	if (count($stmt->fetch()) > 1) {
		die("Already a rank with that name!");
	}

	$stmt = $GLOBALS["link"]->prepare("INSERT INTO `ranks` (`rank`, `perms`, `heirarchy`) VALUES (:rank, :perms, :heirarchy)");
	if ($stmt->execute(array(":rank" => $rank, ":perms" => $perms, ":heirarchy" => $heirarchy))) {
		die("Rank added!");
	}

	die("Failed!");
?>
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
	if (count($stmt->fetch()) == 0) {
		die("There's no rank like that!");
	}

	$stmt = $GLOBALS["link"]->prepare("UPDATE `ranks` SET `perms` = :perms, `heirarchy` = :heirarchy WHERE `rank` = :rank");
	$stmt->execute(array(":perms" => $perms, ":rank" => $rank, ":heirarchy" => $heirarchy));
	if (count($stmt->fetch()) == 0) {
		die("fail");
	}

	echo "success";
?>
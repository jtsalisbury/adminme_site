<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	$rank = $_POST["rank"];
	$perms = $_POST["perms"];

	$rank = $link->real_escape_string($rank);
	$perms = $link->real_escape_string($perms);

	$sql = "SELECT * FROM `ranks` WHERE `rank` = '" . $rank . "'";
	$res = $link->query($sql);
	if ($res && $res->num_rows != 0) { 
		die('Theres already a rank with that name!');
	}

	$sql = "INSERT INTO `ranks` (`rank`, `perms`) VALUES ('".$rank."', '". $perms ."')";

	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}

	die("success");
?>

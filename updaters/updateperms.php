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
	if (!$res) {
		die("Error!");
	}
	if ($res->num_rows == 0) {
		die("No rank with that ID!");
	}

	$sql = "UPDATE `ranks` SET `perms` = '".$perms."' WHERE `rank` = '".$rank."' ";

	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}

	echo "success";
?>

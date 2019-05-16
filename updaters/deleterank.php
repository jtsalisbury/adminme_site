<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	$rank = $_POST["rank"];

	$rank = $link->real_escape_string($rank);

	$sql = "SELECT * FROM `ranks` WHERE `rank` = '".$rank."'";
	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}
	if ($res->num_rows == 0) {
		die($rank);
	}

	$sql = "DELETE FROM `ranks` WHERE `rank` = '".$rank."' ";

	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}

	echo "success";
?>

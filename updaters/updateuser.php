<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	$rank = $_POST["rank"];
	$id   = $_POST["steamid"];

	$rank = $link->real_escape_string($rank);
	$id   = $link->real_escape_string($id);

	$sql = "SELECT * FROM `users` WHERE `steamid` = '".$id."'";
	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}
	if ($res->num_rows == 0) {
		die("No user with that ID!");
	}

	$sql = "UPDATE `users` SET `rank` = '".$rank."' WHERE `steamid` = '".$id."' ";
	if ($rank == "user") {
		$sql = "DELETE FROM `users` WHERE `steamid` = '".$id."'";
	}

	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}

	echo "success";
?>

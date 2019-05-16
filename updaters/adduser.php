<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	$name = $_POST["name"];
	$rank = $_POST["rank"];
	$id   = $_POST["steamid"];

	$id   = $link->real_escape_string($id);
	$name = $link->real_escape_string($name);
	$rank = $link->real_escape_string($rank);
	$serv = $link->real_escape_string($serv);

	$sql = "SELECT * FROM `users` WHERE `steamid` = '".$id."'";
	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}
	if ($res->num_rows > 0) {
		die("Already a user with that ID!");
	}

	$sql = "INSERT INTO `users` (`steamid`, `name`, `rank`) VALUES ('".$id."', '".$name."', '".$rank."')";

	$res = $link->query($sql);
	if (!$res) {
		die("Error!");
	}

	echo "success";
?>

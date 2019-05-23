<?php

	include("../steamauth/mysql.php");

	include("../steamauth/steamauth.php");



	checkLogin();



	$id = $_POST["steamid"];

	$name = $_POST["name"];

	$rank = $_POST["rank"];

	$server = $_POST["server"];


	$stmt = $GLOBALS["link"]->prepare("INSERT INTO `users` (`steamid`, `name`, `rank`, `server`) VALUES (:steamid, :name, :rank, :server)");

	if ($stmt->execute(array(":steamid" => $id, ":name" => $name, ":rank" => $rank, ":server" => $server))) {

		die("success");

	}



	die("fail");

?>
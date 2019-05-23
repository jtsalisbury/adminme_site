<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");

	checkLogin();

	$ident = $_POST["identifier"];
	$ip = $_POST["ip"];
	$port = $_POST["port"];

	$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `registered_servers` WHERE `ip` = :ip");
	$stmt->execute(array(":ip" => $ip));
	if (count($stmt->fetch()) > 1) {
		die("Already a server with that IP!");
	}

	$stmt = $GLOBALS["link"]->prepare("INSERT INTO `registered_servers` (`name`, `ip`, `port`) VALUES (:name, :ip, :port)");
	if ($stmt->execute(array(":name" => $ident, ":ip" => $ip, ":port" => $port))) {
		die("Server added!");
	}

	die("fail");
?>
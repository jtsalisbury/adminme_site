<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	
	checkLogin();

	$id = $_POST["id"];
	
	$stmt = $GLOBALS["link"]->prepare("DELETE FROM `registered_servers` WHERE `id` = :id");
	$stmt->execute(array(":id" => $id));
	if (count($stmt->fetch()) == 0) {
		die("No server found!");
	} else {
		die("Server successfully removed!");
	}

	echo "fail";
?>
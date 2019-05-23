<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");

	checkLogin();

	$id = $_POST["id"];
	
	$stmt = $GLOBALS["link"]->prepare("DELETE FROM `bans` WHERE `id` = :id");
	$stmt->execute(array(":id" => $id));
	if (count($stmt->fetch()) == 0) {
		die("No ban found with that ID!");
	} else {
		die("Ban successfully removed!");
	}

	echo "Failure";
?>
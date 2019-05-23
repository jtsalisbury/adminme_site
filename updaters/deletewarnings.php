<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	
	checkLogin();

	$id = $_POST["id"];
	
	$stmt = $GLOBALS["link"]->prepare("DELETE FROM `warnings` WHERE `id` = :id");
	$stmt->execute(array(":id" => $id));
	if (count($stmt->fetch()) == 0) {
		die("No warning for that player found with that ID!");
	} else {
		die("success");
	}

	echo "fail";
?>
<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	
	checkLogin();

	$rank = $_POST["rank"];
	
	$stmt = $GLOBALS["link"]->prepare("DELETE FROM `ranks` WHERE `rank` = :rank");
	$stmt->execute(array(":rank" => $rank));
	if (count($stmt->fetch()) == 0) {
		die("No rank found with that ID!");
	} else {
		die("success");
	}

	echo "fail";
?>
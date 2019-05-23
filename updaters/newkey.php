<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");

	checkLogin(); 

	$rank = $_POST["rank"];
	$key  = md5(time().$rank);

	$stmt = $GLOBALS["link"]->prepare("INSERT INTO `keys` (`key`, `rank`) VALUES (:key, :rank)");
	$stmt->execute(array(":key" => $key, ":rank" => $rank));
	if (count($stmt->fetch()) == 0) {
		die("fail");
	}

	echo "success";
?>
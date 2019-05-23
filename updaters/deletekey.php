<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");

	checkLogin();

	$id = $_POST["id"];

	$stmt = $GLOBALS["link"]->prepare("DELETE FROM `keys` WHERE `id` = :id");
	
	if ($stmt->execute(array(":id" => $id))) {
		die("success");
	}
	

	echo "fail";
?>
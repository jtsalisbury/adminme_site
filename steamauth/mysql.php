<?php

	$s = "";

	$u = "";

	$p = "";

	$d = "";



	$dsn = "mysql:host=$s;dbname=$d";

	try {

		$GLOBALS["link"] = new PDO($dsn, $u, $p);

	} catch (PDOException $e) {

		die('Error: ' . $e);

	}

?>
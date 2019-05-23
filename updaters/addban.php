<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	checkLogin();

	$id = $_POST["steamid"];
	$name = $_POST["name"];
	$reason = $_POST["reason"];
	$bannedUntil = $_POST["date"];

	$bannerID = $_SESSION["steam_steamid"];
	$bannerName = $_SESSION["steam_personaname"];

	$datePts = explode("T", $bannedUntil);
	$bannedUntil = $datePts[0] ." " . $datePts[1];

	$banTime = strtotime($bannedUntil) - time();
	$active = 1;

	$stmt = $GLOBALS["link"]->prepare("INSERT INTO `bans` (`banned_steamid`, `banned_name`, `banned_reason`, `banned_time`, `banner_steamid`, `banner_name`, `ban_active`, `banned_timestamp`) VALUES (:steamid, :name, :reason, :time, :rsteamid, :rname, :active, :timestamp)");
	if ($stmt->execute(array(":steamid" => $id, ":name" => $name, ":reason" => $reason, ":time" => $banTime, ":rsteamid" => $bannerID, ":rname" => $bannerName, ":active" => $active, ":timestamp" => time()))) {
		die("Ban added!");
	}

	die("fail");
?>
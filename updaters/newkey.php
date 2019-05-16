<?php
	include("../steamauth/mysql.php");
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");

	$id = $_SESSION["steamid"];
	if (isset($id)) {
		$authserver = bcsub($id, '76561197960265728') & 1;
		$authid = (bcsub($id, '76561197960265728')-$authserver)/2;
		$id = mysql_escape_string("STEAM_0:$authserver:$authid");

		$sql = "SELECT * FROM `users` WHERE `steamid` = '". $id ."'";
		$res = mysql_query($sql, $link);

		if (!$res or mysql_num_rows($res) == 0) { header("Location: ../steamauth/logout.php"); }
		$row = mysql_fetch_assoc($res);
		$rank = $row['rank'];

		$sql = "SELECT * FROM `ranks` WHERE `rank` = '". $rank ."'";
		$res = mysql_query($sql, $link);
		if ($res && mysql_num_rows($res) == 1) {
			$rows = mysql_fetch_assoc($res);

			$perms = $rows[ 'perms' ];

			$access = strpos($perms, '*');
			$access2 = strpos($perms, 'website');

			if ($access == NULL and $access != FALSE and $access2 == NULL) {
				header("Location: ../steamauth/logout.php");
			}
		} else {
			header("Location: ../steamauth/logout.php");
		}
	} else {
		die("Not logged in!");
	}

	$rank = $_POST["rank"];
	$rank = mysql_escape_string($rank);
	$key  = md5(time().$rank);

	$sql = "INSERT INTO `keys` (`key`, `rank`) VALUES ('".$key."', '".$rank."')";
	
	$res = mysql_query($sql, $link);
	if (!$res) { die(mysql_error($link)); }

	echo "success";
?>
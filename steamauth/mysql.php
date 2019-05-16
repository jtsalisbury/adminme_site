<?php
	$s = "";
	$u = "";
	$p = "";
	$d = "";

	$link = mysqli_connect($s, $u, $p, $d);

	$id = $_SESSION["steamid"];

	if (!$skipCheck) {
		if (isset($id)) {
			$authserver = bcsub($id, '76561197960265728') & 1;
			$authid = (bcsub($id, '76561197960265728')-$authserver)/2;

			$id = $link->real_escape_string("STEAM_0:$authserver:$authid");

			$sql = "SELECT * FROM `users` WHERE `steamid` = '". $id ."'";
			$res = $link->query($sql);

			if (!$res or $res->num_rows == 0) { header("Location: http://projectaxiom.org/adminmev3/steamauth/logout.php"); }
			$row = $res->fetch_assoc();
			$rank = $row['rank'];

			$rankList = "";
			foreach (json_decode($rank) as $key => $v) {
				$rankList = $rankList . " `rank` = '" . $key . "' OR ";
			}

			$rankList = rtrim($rankList, " OR ");

			$sql = "SELECT * FROM `ranks` WHERE " . $rankList;
			$res = $link->query($sql);

			$access; $access2;
			while ($row = $res->fetch_assoc()) {
				$perms = $row[ 'perms' ];

				$access = strpos($perms, '*');
				$access2 = strpos($perms, 'website');

				if ($access || $access2) {
					break;
				}
			}

			if (!$access and !$access2) {
				header("Location: http://projectaxiom.org/adminmev3/steamauth/logout.php");
			}

		} else if ($_SERVER['REQUEST_URI'] != "/adminmev3/index.php"){
			header("Location: http://projectaxiom.org/adminmev3/index.php");
		}
	}



?>

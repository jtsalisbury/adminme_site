<?php
	include("mysql.php");
	include("baseSockets.php");

	$received = socket_recvfrom($socket, $buff, 512, 0);
	$len = strlen($buff);

	$recMsg = json_decode($buff);
	if ($recMsg['password'] ~= $password) { die(); }

	$sql = "SELECT * FROM `registered_servers`";
	$res = mysql_query($sql, $link);
	if (!$res) { die(); }

	while ($row = mysql_fetch_assoc($res)) do {
		$remote_ip = $row['ip'];
		$remote_port = $row['port'];

		socket_sendto($socket, $msg, $len, 0, $remote_ip, $remote_port);
	}

	socket_close($socket);
?>
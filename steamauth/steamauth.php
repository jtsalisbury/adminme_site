<?php

ob_start();

session_start();



function logoutbutton() {

	echo "<form action='' method='get'><button name='logout' type='submit'>Logout</button></form>"; //logout button

}



function loginbutton($buttonstyle = "square") {

	$button['rectangle'] = "01";

	$button['square'] = "02";

	$button = "<a href='?login'><img src='http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";

	

	echo $button;

}



if (isset($_GET['login'])){

	require 'openid.php';

	try {

		require 'SteamConfig.php';

		$openid = new LightOpenID($steamauth['domainname']);

		

		if(!$openid->mode) {

			$openid->identity = 'http://steamcommunity.com/openid';

			header('Location: ' . $openid->authUrl());

		} elseif ($openid->mode == 'cancel') {

			echo 'User has canceled authentication!';

		} else {

			if($openid->validate()) { 

				$id = $openid->identity;

				$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";

				preg_match($ptn, $id, $matches);

				

				$_SESSION['steamid'] = $matches[1];

				if (!headers_sent()) {

					header('Location: '.$steamauth['loginpage']);

					exit;

				} else {

					?>

					<script type="text/javascript">

						window.location.href="<?=$steamauth['loginpage']?>";

					</script>

					<noscript>

						<meta http-equiv="refresh" content="0;url=<?=$steamauth['loginpage']?>" />

					</noscript>

					<?php

					exit;

				}

			} else {

				echo "User is not logged in.\n";

			}

		}

	} catch(ErrorException $e) {

		echo $e->getMessage();

	}

}



if (isset($_GET['logout'])){

	require 'SteamConfig.php';

	session_destroy();

	session_unset();

	session_regenerate_id(true);

	header('Location: '.$steamauth['logoutpage']);

	exit;

}



if (isset($_GET['update'])){

	unset($_SESSION['steam_uptodate']);

	require 'userInfo.php';

	header('Location: '.$_SERVER['PHP_SELF']);

	exit;

}



function checkLogin() {

	$id = $_SESSION["steamid"];

	if ($id != NULL and isset($id)) {



		$authserver = bcsub($id, '76561197960265728') & 1;

		$authid = (bcsub($id, '76561197960265728')-$authserver)/2;

		$id = "STEAM_0:$authserver:$authid";

		$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `users` WHERE `steamid` = :steamid");

		$stmt->execute(array(":steamid" => $id));

		$result = $stmt->fetch();



		if (count($result) == 0) { 

		    session_unset();

		    session_destroy();

		    session_write_close();

		    setcookie(session_name(),'',0,'/');

		    session_regenerate_id(true);



			header("Location: https://adminme.000webhostapp.com/login.php");

		}



		$rank = $result['rank'];



		$stmt = $GLOBALS["link"]->prepare("SELECT * FROM `ranks` WHERE `rank` = :rank");

		$stmt->execute(array(":rank" => $rank));

		$result = $stmt->fetch();



		if ($stmt->rowCount() == 1) {

			$perms = $result['perms'];



			$name = basename($_SERVER['PHP_SELF']);

			$permPart = explode(".", $name);

			$perm = $permPart[0];



			$access = strpos($perms, '*');

			$access2 = strpos($perms, 'website');



			if ($access === FALSE and $access2 === FALSE) {

			    session_unset();

			    session_destroy();

			    session_write_close();

			    setcookie(session_name(),'',0,'/');

			    session_regenerate_id(true);



				header("Location: ");

			}

		} else {

		    session_unset();

		    session_destroy();

		    session_write_close();

		    setcookie(session_name(),'',0,'/');

		    session_regenerate_id(true);



			header("Location: https://adminme.000webhostapp.com/login.php");

		}

	} else {

		header("Location: https://adminme.000webhostapp.com/login.php");

	}

}



// Version 3.2



?>


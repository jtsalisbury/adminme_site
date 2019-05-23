<?php

	include("steamauth/steamauth.php");

	include("steamauth/userInfo.php");

	include("steamauth/mysql.php");



	checkLogin();

?>



<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>AdminMe - Dashboard</title>



<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/datepicker3.css" rel="stylesheet">

<link href="css/styles.css" rel="stylesheet">



<!--Icons-->

<script src="js/lumino.glyphs.js"></script>



<!--[if lt IE 9]>

<script src="js/html5shiv.js"></script>

<script src="js/respond.min.js"></script>

<![endif]-->



</head>



<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

		<div class="container-fluid">

			<div class="navbar-header">

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">

					<span class="sr-only">Toggle navigation</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

				</button>

				<a class="navbar-brand" href="#"><span>AdminMe</span>Panel</a>

				

			</div>

							

		</div><!-- /.container-fluid -->

	</nav>

		

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

		<ul class="nav menu">

			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>



			<?php if (isset($_SESSION['steamid'])) { ?>

				<li><a href="ranks.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"/></svg> Ranks</a></li>

				<li class='active'><a href="users.php"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Users</a></li>

				<li><a href="logs.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Logs</a></li>

				<li><a href="keys.php"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Keys</a></li>

				<li><a href="bans.php"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Bans</a></li>

				<li><a href="servers.php"><svg class="glyph stroked external hard drive"><use xlink:href="#stroked-external-hard-drive"/></svg> Servers</a></li>

				<li><a href="warnings.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Warnings</a></li>

			<?php } ?>



			<li role="presentation" class="divider"></li>



			<li><a href="public/userlist.php"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> User List</a></li>

			<li><a href="public/banlist.php"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Ban List</a></li>



			

			<li role="presentation" class="divider"></li>



			<?php if (!isset($_SESSION['steamid'])) { ?>

				<li><a href="login.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>

			<?php } else { ?>

				<li><a href="steamauth/logout.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Logout <? echo $_SESSION["steam_personaname"]; ?></a></li>

			<?php } ?>

		</ul>



	</div><!--/.sidebar-->

		

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			

		<div class="row">

			<ol class="breadcrumb">

				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>

				<li class="active"> Users</li>

			</ol>

		</div><!--/.row-->

										

		<div class="row">

			<div class="col-lg-12">

				<div class="panel panel-default">

					<div class="panel-heading">Users With Ranks</div>

					<div class="panel-body">

						<table class='table'>

						    <thead>

						    <tr>

						        <th data-field="id" data-sortable="true">User SteamID</th>

						        <th data-field="name"  data-sortable="true">Username</th>

						        <th data-field="perms" data-sortable="true">User Rank & Server</th>

						    </tr>

						    </thead>



						    <?php

						    	$sql = $GLOBALS["link"]->query("SELECT * FROM `users`");



						    	$servers = $GLOBALS["link"]->query("SELECT `name` FROM `servers`");

						    	$serverResults = $servers->fetchAll();



						    	$ranks = $GLOBALS["link"]->query("SELECT `rank` FROM `ranks`");

						    	$rankResults = $ranks->fetchAll();



						    	while ($row = $sql->fetch()) {

						    		echo "<tr><td>".$row['steamid']."</td><td>".$row["name"]."</td><td style='width: 60%'>

			

										<form user='".$row['steamid']."' group='".$row['id']."' class='updateUser' style='float: left; width: 100%;'>

											<select class='updateRank form-control' style='width: 30% !important; float: left; margin-left: 10px;'>

												<option value='". $row["rank"] ."'>". $row["rank"] ."</option>

												";



											//List all available servers

											foreach ($rankResults as $row2) {

												if ($row2["rank"] == $row["rank"]) { continue; }



												echo "<option value='". $row2["rank"] ."'>" . $row2["rank"] . "</option>";

											}



											echo "

											</select>

											<select class='updateUserServer form-control' style='width: 30% !important; float: left; margin-left: 10px;'>

												<option value='". $row["server"] ."'>". $row["server"] ."</option>

												";



											//List all available servers

											foreach ($serverResults as $row2) {

												if ($row2["name"] == $row["server"]) { continue; }



												echo "<option value='". $row2["name"] ."'>" . $row2["name"]. "</option>";

											}



											//Global isn't a registered server, so we gotta hard code it in

											if ($row["server"] != "global") {

												echo "<option value='global'>global</option>";

											}



									echo    "</select>



											<input class='updateUserRank btn btn-primary' type='submit' value='Update' style='float: left; margin-left: 10px'>

										</form>



									</td></tr>";

						    	}

						    ?>

						</table>

					</div>

				</div>

			</div>

			<div class="col-lg-12">

				<div class="panel panel-default">

					<div class="panel-heading">Add User</div>

					<div class="panel-body">



						<form class='newUser' style='width: 100%; float: left;'>

							<input class='newUserSteamID form-control' style='width: 20%; float: left; margin-left: 10px;' type='text' placeholder='steamid'>

							<input class='newUserName form-control' style='width: 20%; float: left; margin-left: 10px;' type='text' placeholder='username'>

							<select class="newUserPerms form-control" style="width: 20% !important; float: left; margin-left: 10px;">

							<?php 

								$ranks = $GLOBALS["link"]->query("SELECT `rank` FROM `ranks`");

								while ($row = $ranks->fetch()) {

									if ($row["rank"] == "user") { continue; }



									echo "<option value='". $row["rank"] ."'>" . $row["rank"]. "</option>";

								}

							?>

							</select>



							<select class='newUserServer form-control' style='width: 20% !important; float: left; margin-left: 10px;'>

								<option value="global">global</option>



							<?php //List all available servers



								$servers = $GLOBALS["link"]->query("SELECT `name` FROM `registered_servers`");

								while ($row = $servers->fetch()) {

									echo "<option value='". $row["name"] ."'>" . $row["name"]. "</option>";

								}



							?>

							</select>



							<input class='addUser btn btn-primary' type='submit' value='Add User' style='margin-left: 10px; float: left;'>

						</form>

			

					</div>

				</div>

			</div>

			



		</div><!--/.row-->				

		

	</div>	<!--/.main-->



	<script src="js/jquery-1.11.1.min.js"></script>

	<script src="js/bootstrap.min.js"></script>

	<script src="js/chart.min.js"></script>

	<script src="js/chart-data.js"></script>

	<script src="js/easypiechart.js"></script>

	<script src="js/easypiechart-data.js"></script>

	<script src="js/bootstrap-datepicker.js"></script>

	<script src="js/bootstrap-table.js"></script>

	<script>

		$('#calendar').datepicker({

		});



		!function ($) {

		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          

		        $(this).find('em:first').toggleClass("glyphicon-minus");      

		    }); 

		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");

		}(window.jQuery);



		$(window).on('resize', function () {

		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')

		})

		$(window).on('resize', function () {

		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')

		})



		$('.newUser').on("submit", function(e){

			e.preventDefault();

	        var name = $(".newUserName").val();

	        var id = $(".newUserSteamID").val();

			var rank = $(".newUserPerms").val();

			var serv = $(".newUserServer").val();



	        if (id.length < 10) {

	            alert("Please enter a valid SteamID!");

	        } else if (name.length < 1) {

	        	alert("Please enter in a name of more than 1 character! Current: " + name.length);

	        } else if (rank === "Select...") {

	     		alert("Please select a rank!");

		    } else {



		        $.ajax({

		            url: 'updaters/adduser.php',

		            type: 'POST',

		            data: { "steamid": id,

		                    "name": name,

		                    "rank": rank,

		                    "server": serv,

		                },

		            success:function(data) {

		                alert(data);

		                document.location.href = "users.php";

		            },

		            error:function(msg) {

		            }

		        });

		    }

		})



		$('.updateUserRank').click(function(e){

			e.preventDefault();



			var form = $(this).parent("form");

			var id = form.attr("user");

			var server = $(form).children(".updateUserServer").val();



	        var rank = $(form).children(".updateRank").val();



	        if (rank.length === 0) {

	     		alert("Please set a rank!");

		    } else {



		        $.ajax({

		            url: 'updaters/updateuser.php',

		            type: 'POST',

		            data: { "steamid": id,

		                    "rank": rank,

		                    "server": server,

		                },

		            success:function(data) {

		                alert("User updated!");

		                document.location.href = "users.php?";

		            },

		            error:function(msg) {

		                alert(msg);

		            }

		        });

		    }

		})

	</script>	

</body>



</html>


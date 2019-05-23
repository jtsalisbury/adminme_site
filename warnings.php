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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
				<li><a href="users.php"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Users</a></li>
				<li><a href="logs.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Logs</a></li>
				<li><a href="keys.php"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Keys</a></li>
				<li><a href="bans.php"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Bans</a></li>
				<li><a href="servers.php"><svg class="glyph stroked external hard drive"><use xlink:href="#stroked-external-hard-drive"/></svg> Servers</a></li>
				<li class='active'><a href="warnings.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Warnings</a></li>
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
				<li class="active"> Warnings</li>
			</ol>
		</div><!--/.row-->
										
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">All Warnings</div>
					<div class="panel-body">
						<table class='table'>
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="name"  data-sortable="true">Name</th>
						        <th data-field="sid" data-sortable="true">SteamID</th>
						        <th data-field="count" data-sortable="true">Warning Count</th>
						        <th></th>
						    </tr>
						    </thead>

						    <?php
						    	$sql = $GLOBALS["link"]->query("SELECT * FROM `warnings`");

						    	while ($row = $sql->fetch()) {
						    		echo "<tr><td>".$row['id']."</td><td>".$row["name"]."</td><td>". $row["steamid"] ."</td><td>". $row["warnings"] ."</td><td style='width: 15%'>
			
										<form id='".$row['id']."' wdata='". $row["warningsData"] ."' name='". $row["name"] ."' steamid='". $row["steamid"] ."' class='updatePerms' style='float: left; width: 100%;'>
											<input class='viewMore btn btn-primary' type='submit' value='View' style='float: left; margin-left: 10px'>
										</form>

									</td></tr>";
						    	}
						    ?>
						</table>
					</div>
				</div>
			</div>

		</div><!--/.row-->				
		
	</div>	<!--/.main-->

	<div id="moreInfoModal" title="View More">
		<p id="user"></p>
		<p id="warningInfo"></p>

		<input class='warningDelete btn btn-primary' id="" type='submit' value='Delete All' style='float: left; margin-left: 10px'>
	</div>

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
		$( "#moreInfoModal" ).dialog({
			autoOpen: false,
			autoResize: true,
		});

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

		$(".viewMore").click(function(e) {
			e.preventDefault();

			var form = $(this).parent("form");
			var data = form.attr("wdata");
			var id = form.attr("id");
			var name = form.attr("name");
			var sid = form.attr("steamid");

			var arr = jQuery.parseJSON(data);

			var str = "";
			arr.forEach(function(val, ind, arr) {

				var date = new Date(val["timestamp"] * 1000);
				var toAppend = "<b>Admin: </b>" + val["admin"] + "<br><b>Timestamp: </b>" + date.toDateString() + " at " + date.toTimeString() + "<br><b>Reason: </b>" + val["reason"] + "<br><br>";
				str = str + toAppend;
			})

			$("#warningInfo").html(str);
			$("#user").html("<b>Player: </b>" + name + " (" + sid + ")");

			$(".warningDelete").attr("id", id);
			$("#moreInfoModal").dialog("open");
		})

		$('.warningDelete').click(function(e) {
			e.preventDefault();

			var id = $(this).attr("id");
			$.ajax({
				url: "updaters/deletewarnings.php",
				type: "POST",
				data: {"id": id},
				success:function(data) {
					document.location.href = "warnings.php";
				},
				error:function(msg) {
				}
			})
			
		});	
	</script>	
</body>

</html>

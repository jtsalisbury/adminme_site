<?php
	include("../steamauth/steamauth.php");
	include("../steamauth/userInfo.php");
	include("../steamauth/mysql.php");

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminMe - Dashboard</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/datepicker3.css" rel="stylesheet">
<link href="../css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="../js/lumino.glyphs.js"></script>

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
			<li><a href="../index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>

			<?php if (isset($_SESSION['steamid'])) { ?>
				<li><a href="../ranks.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"/></svg> Ranks</a></li>
				<li><a href="../users.php"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Users</a></li>
				<li><a href="../logs.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Logs</a></li>
				<li><a href="../keys.php"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Keys</a></li>
				<li><a href="../bans.php"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Bans</a></li>
				<li><a href="../servers.php"><svg class="glyph stroked external hard drive"><use xlink:href="#stroked-external-hard-drive"/></svg> Servers</a></li>
				<li><a href="../warnings.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Warnings</a></li>
			<?php } ?>

			<li role="presentation" class="divider"></li>

			<li class='active'><a href="userlist.php"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> User List</a></li>
			<li><a href="banlist.php"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Ban List</a></li>

			
			<li role="presentation" class="divider"></li>

			<?php if (!isset($_SESSION['steamid'])) { ?>
				<li><a href="../login.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
			<?php } else { ?>
				<li><a href="../steamauth/logout.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Logout <? echo $_SESSION["steam_personaname"]; ?></a></li>
			<?php } ?>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li>Public</li>
				<li class="active">User List</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Users</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="../generators/genusers.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true">
						    <thead>
						    <tr>
						        <th data-field="steamid" data-sortable="true" >SteamID</th>
						        <th data-field="name" data-sortable="true">Name</th>
						        <th data-field="rank"  data-sortable="true">Rank</th>
						    </tr>
						    </thead>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
								
		
								
		
	</div>	<!--/.main-->

	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/bootstrap-table.js"></script>
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
	</script>	
</body>

</html>

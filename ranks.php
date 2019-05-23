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
				<li class='active'><a href="ranks.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"/></svg> Ranks</a></li>
				<li><a href="users.php"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Users</a></li>
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
				<li class="active"> Ranks</li>
			</ol>
		</div><!--/.row-->
										
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Available Ranks</div>
					<div class="panel-body">
						<table class='table'>
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">Rank ID</th>
						        <th data-field="name"  data-sortable="true">Rank Name</th>
						        <th data-field="perms" data-sortable="true">Rank Permissions & Heirarchy</th>
						    </tr>
						    </thead>

						    <?php
						    	$sql = $GLOBALS["link"]->query("SELECT * FROM `ranks`");

						    	while ($row = $sql->fetch()) {
						    		echo "<tr><td>".$row['id']."</td><td>".$row["rank"]."</td><td style='width: 75%'>
			
										<form group='".$row['rank']."' class='updatePerms' style='float: left; width: 100%;'>
											<input class='perms form-control' style='width: 60%; float: left;' type='text' value='".$row["perms"]."'>
											<input class='heirarchy form-control' style='width: 20%; float: left; margin-left: 10px;' type='text' value='".$row["heirarchy"]."'>

											<input class='doUpdate btn btn-primary' type='submit' value='Update' style='float: left; margin-left: 10px'>
											<input class='rankDel btn btn-primary' type='submit' value='Delete' style='float: left; margin-left: 10px'>
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
					<div class="panel-heading">New Rank</div>
					<div class="panel-body">

						<form class='newRank' style='width: 100%; float: left;'>
							<input class='rank form-control' style='width: 30%; float: left;' type='text' placeholder='rank name' >
							<input class='perms form-control' style='width: 30%; float: left; margin-left: 10px;' type='text' placeholder='permissions'>
							<input class='heirarchy form-control' style='width: 30%; float: left; margin-left: 10px;' type='text' placeholder='heirarchy'>

							<input class='createRank btn btn-primary' type='submit' value='Create' style='margin-left: 10px; float: left;'>
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

		$('.rankDel').click(function(e) {
			e.preventDefault();

			var form = $(this).parent('form');
			var rank = form.attr("group");

			$.ajax({
				url: "updaters/deleterank.php",
				type: "POST",
				data: {"rank": rank},
				success:function(data) {
					 if (data.match('success')) {
		            	//$(this).find("input")[0].disabled = false;
		                alert("Rank deleted!");
		                document.location.href = "ranks.php";
		            } else {
		            }
				},
				error:function(msg) {
				}
			})
			
		});

		$('.doUpdate').click(function(e){
			e.preventDefault();

			var form = $(this).parent("form");
			var rank = form.attr("group");

			var perms = form.children(".perms").val();
			var heirarchy = form.children(".heirarchy").val();

			if (perms.length === 0) {
				alert("Please add permissions!");
			} else {

			    $.ajax({
			        url: 'updaters/updateperms.php',
			        type: 'POST',
			        data: { "rank": rank,
			                "perms": perms,
			                "heirarchy": heirarchy,
			            },
			        success:function(data) {
			            if (data.match('success')) {
			            	//$(this).find("input")[0].disabled = false;
			                alert("Permissions updated!");
			                document.location.href = "ranks.php";
			            } else {
			            }
			        },
			        error:function(msg) {
			        }
			    });
			}
		});

		$('.createRank').click(function(e) {
			e.preventDefault();

			var form = $(this).parent("form");
			var rank = form.children('.rank').val();
			var perms = form.children('.perms').val();
			var heirarchy = form.children('.heirarchy').val();


			if (perms && rank) {
				$.ajax({
					url: "updaters/newrank.php",
					type: "POST",
					data: {
						"rank": rank, 
						"perms": perms, 
						"heirarchy": heirarchy
					},
					success:function(data) {
						alert(data);
						document.location.href = "ranks.php";
					},
					error:function(msg) {
					}
				})
			}
		});

	
	</script>	
</body>

</html>

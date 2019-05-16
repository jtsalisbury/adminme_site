<?php
	include("steamauth/steamauth.php");
	include("steamauth/userInfo.php");
	include("steamauth/mysql.php");

	$id = $_SESSION["steamid"];
	if (isset($id)) {
		$authserver = bcsub($id, '76561197960265728') & 1;
		$authid = (bcsub($id, '76561197960265728')-$authserver)/2;
		$id = mysql_escape_string("STEAM_0:$authserver:$authid");

		$sql = "SELECT * FROM `users` WHERE `steamid` = '". $id ."'";
		$res = mysql_query($sql, $link);

		if (!$res or mysql_num_rows($res) == 0) { header("Location: steamauth/logout.php"); }
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
				die($access == NULL);
				header("Location: steamauth/logout.php");
			}
		} else {
			header("Location: steamauth/logout.php");
		}
	} else {
		header("Location: index.php");
	}
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
				<li><a href="users.php"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Users</a></li>
				<li><a href="logs.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Logs</a></li>
				<li class='active'><a href="keys.php"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Keys</a></li>
				<li><a href="bans.php"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Bans</a></li>
			<? } ?>

			<li role="presentation" class="divider"></li>

			<li><a href="public/ranklist.php"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Rank List</a></li>
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
				<li class="active"> Keys</li>
			</ol>
		</div><!--/.row-->
										
		<div class="row">
			
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">All Keys</div>
					<div class="panel-body">
						<table class='table'>
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">Key ID</th>
						        <th data-field="key"  data-sortable="true">Key</th>
						        <th data-field="rank" data-sortable="true">Rank</th>
						        <th data-field="rank" data-sortable="true">Redeemd By</th>
						    </tr>
						    </thead>

						    <?php
						    	$sql = "SELECT * FROM `keys`";
						    	$res = mysql_query($sql, $link);
						    	if (!$res) { die("No result."); }

						    	while ($row = mysql_fetch_assoc($res)) {
						    		echo "<tr><td>".$row['id']."</td><td>".$row["key"]."</td><td>".$row["rank"]."</td><td>".$row["redeemed_by"]."</td><td>
			
										<form keyid='".$row['id']."' class='deleteKeyForm' style='float: left; width: 100%;'>
											<input class='deleteKey btn btn-primary' type='submit' value='Delete' style='float: left; margin-left: 10px'>
										</form>

									</td></tr>";
						    	}
						    ?>
						</table>
					</div>
				</div>
			</div>
			

		</div><!--/.row-->	

		<div class="row">
			
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Generate New Key</div>
					<div class="panel-body">
						<form class='newKey' style='width: 100%; float: left;'>
							<input class='keyRank form-control' style='width: 25%; float: left; margin-left: 10px;' type='text' placeholder='rank'>


							<input class='createNewKey btn btn-primary' type='submit' value='Generate' style='margin-left: 10px; float: left;'>
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
		$(document).ready(function() {
			$('.createNewKey').click(function(e){
				e.preventDefault();

				var rank = $(".keyRank").val();

		        if (rank.length === 0) {
		     		alert("Please set a rank!");
			    } else {

			        $.ajax({
			            url: 'updaters/newkey.php',
			            type: 'POST',
			            data: { 
			                    "rank": rank,
			                },
			            success:function(data) {
			                alert("Key added!");
			                document.location.href = "keys.php";
			            },
			            error:function(msg) {
			            }
			        });
			    }
			})

			$('.deleteKey').click(function(e){
				e.preventDefault();

				var form = $(this).parent("form");
				var id   = form.attr("keyid");

		        $.ajax({
		            url: 'updaters/deletekey.php',
		            type: 'POST',
		            data: { 
		                    "id": id,
		                },
		            success:function(data) {
		                alert("Key deleted!");
		                document.location.href = "keys.php";
		            },
		            error:function(msg) {
		            }
		        });
			    
			})
		})
	</script>
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

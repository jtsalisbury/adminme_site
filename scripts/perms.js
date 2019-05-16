$(document).ready(function() {
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

		if (perms.length === 0) {
			alert("Please add permissions!");
		} else {

		    $.ajax({
		        url: 'updaters/updateperms.php',
		        type: 'POST',
		        data: { "rank": rank,
		                "perms": JSON.stringify(perms.replace(/\s+/g, '').split(",")),
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

		if (perms && rank) {
			$.ajax({
				url: "updaters/newrank.php",
				type: "POST",
				data: {
						"rank": rank,
						"perms": JSON.stringify(perms.replace(/\s+/g, '').split(","))
					},
				success:function(data) {
					alert("Rank created successfully!");
					document.location.href = "ranks.php";
				},
				error:function(msg) {
				}
			})
		}
	});


})

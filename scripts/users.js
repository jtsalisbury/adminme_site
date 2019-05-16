$(document).ready(function() {
	$('.newUser').on("submit", function(e){
		e.preventDefault();
        var name = $(".newUserName").val();
        var id = $(".newUserSteamID").val();
		var rank = $(".newUserPerms").val();

        if (id.length < 10) {
            alert("Please enter a SteamID!");
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
	                },
	            success:function(data) {
	                alert("User added!");
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

        var rank = $(form).children(".rank").val();

        if (rank.length === 0) {
     		alert("Please set a rank!");
	    } else {

	        $.ajax({
	            url: 'updaters/updateuser.php',
	            type: 'POST',
	            data: { "steamid": id,
	                    "rank": rank,
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
})
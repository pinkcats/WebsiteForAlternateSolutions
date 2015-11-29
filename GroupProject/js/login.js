$(document).ready( function() {
    var form = $('#loginForm');
    $("#loginSubmit").on("click", function() {
		$.ajax( {
			type: "POST",
			url: "php/controller/loginController.php",
			data: form.serialize(),
			dataType: "json",
			success: function(response) {
				console.log(response);
				if(response.success){
					var desiredPage = (response.isStaff == 1) ? "staffHome.php" : "clientHome.php";
					window.location = desiredPage;
				}
			}
		});  
	});
});
$(document).ready( function() {
    var registerForm = $('#registerForm');
    $("#registerSubmit").on("click", function() {
    	console.log(registerForm.serialize());
		$.ajax( {
			type: "POST",
			url: "php/controller/registerController.php",
			data: registerForm.serialize(),
			dataType: "json",
			success: function(response) {
				console.log(response.success);
				if(response.success){
					window.location = "clientPortal.php";
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
});
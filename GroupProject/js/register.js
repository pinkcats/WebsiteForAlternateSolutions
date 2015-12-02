$(document).ready( function() {
    var registerForm = $('#registerForm');

    $("#registerForm input").on("blur", function() {
    	if(registerForm.hasClass("dirty")){
    		validateForm("registerForm");
    	}
    });


    $("#registerSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	registerForm.addClass("dirty");
    	var valid = validateForm("registerForm");

		if(!valid) { 
			return;
		}
		
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
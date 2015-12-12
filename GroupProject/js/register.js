$(document).ready( function() {
    var registerForm = $('#registerForm');
	var staffVeriForm = $("#staffVeriForm");
	var isValidStaffLogin = false;
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
		var isStaff = $("input[name=isStaff]:checked").val()
		if(isStaff == 1){
			$("#staffVeriModal").modal("show");
			var staffForm = $("#staffVeriForm");
			//this will have username and password
			$("#staffVeriSubmit").on("click", function(){
				//this is staffVeriController
				$.ajax( {
					type: "POST",
					url: "php/controller/staffVeriController.php",
					data: staffVeriForm.serialize(),
					dataType: "json",
					success: function(response) {
						if(response.success){
							console.log("successful");
							isValidStaffLogin = true;
						}else if(!response.success){
							console.log("not successful");
							isValidStaffLogin = false;	
						} else {
							alert('An error has occured! Error in console.');
							console.log(response.errorMessage);
						}
					}
				}).done(function(){
					isVerifed();
				}); 
			})
		}else{
			registerUser();
		}			
	});
	//functions that might make things easier
	var isVerifed = function(){
		if(!isValidStaffLogin){
			$("#responseMessage").empty().append("Invalid Staff Login");
		}else{
			$("#responseMessage").empty().append("Welcome, Staff");
			registerUser();
			
		}
	};
	var registerUser =  function(){
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
	};
});

			
$(document).ready( function() {
    var registerForm = $('#registerForm');

    $("#registerForm input").on("blur", function() {
    	if(registerForm.hasClass("dirty")){
    		validateForm();
    	}
    });


    $("#registerSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	registerForm.addClass("dirty");
    	var valid = validateForm();

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

	function validateForm() {
		var isValid = true;
		//Remove all past messages to since new ones
		//Will be added if necessary anyway. This is very
		//much a greedy and inefficient way of doing validation
		//but its easy and works for what we need.
		$("#registerForm .error").remove();
		$("#registerForm .invalid").removeClass("invalid");
		//Here we check each field to see if it is empty
    	$('#registerForm *').filter(':input').each(function(){
		    var field = $(this);
		    var thisFieldValid = false;
		    if(field.val() === ""){
		    	field.addClass("invalid");
		    	var requiredErrorBlock = "<span class='help-block error'>Required</span>";
		    	field.parent().append(requiredErrorBlock);
		    } else {
		    	thisFieldValid = true;
		    }

		    isValid = isValid && thisFieldValid; 
		});

		//If there's already errors, no point in doing
		//more work so lets just kick out right away
		if(!isValid) {
			return false;
		}

		//Let's check phone number here with simple regex
		var phoneNumberField = $("#phoneNumber");
		var phoneNumberValue = phoneNumberField.val();
		var phoneNumberPattern = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
		var phoneNumberValid = phoneNumberPattern.test(phoneNumberValue);

		if(!phoneNumberValid){
			phoneNumberField.addClass("invalid");
			var phoneNumberErrorBlock = "<span class='help-block error'>Invalid Phone Number</span>";
			phoneNumberField.parent().append(phoneNumberErrorBlock);
			isValid = false;
		}


		//TODO... zip code, email address, check for special key for organization

		//Here we shall check the password.
		var passwordField = $("#password");
		var confirmPasswordField = $("#passwordConfirmation");
		var passwordValue = passwordField.val();
		var confirmPasswordValue = confirmPasswordField.val();
		if(passwordValue !== confirmPasswordValue){
			passwordField.addClass("invalid");
			var passwordErrorBlock = "<span class='help-block error'>Password and Password Confirmation must match</span>";
			passwordField.parent().append(passwordErrorBlock);
			isValid = false;
		}
		return isValid;
	}
});
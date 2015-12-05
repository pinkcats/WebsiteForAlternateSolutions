//Here we will put global js stuff
$(document).ready(function(){
	updateActiveHeaderItem();
});

function updateActiveHeaderItem() {
	
	//returns last item in path, ex "index.php"
	var currentFile = window.location.pathname.split('/').pop();
	currentFile = (isService(currentFile)) ? "services.php" : currentFile;
	
	//then the list item of the current active link
	var activeElement = $("a[href^='" + currentFile + "']").parent();
	$("#navbar li").removeClass("active");
	activeElement.addClass("active");

}

function isService(fileName){
	var isServiceFile = false;
	switch(fileName) {
		case "mediation.php":
		case "facilitation.php":
		case "consultation.php":
		case "coaching.php":
		case "training.php":
			isServiceFile = true;
			break;
	}
	return isServiceFile;
}

/*
Everything below is validation! 
Hopefully it's pretty straight forward, all you need to
do for this to work is pass in your form's id. Then in your
form if a field is optional add a data attribute data-required="false". The
same goes for phoneNumber, emailAddress, zipCode, and password fields. use data-type="[typeHere]".
I could have organized this a little better instead of just throwing these functions in here but 
running out of time and a class is coming in the lab right now so flying out.
*/

function validateForm(formId) {
	var isValid = true;
	//Remove all past messages to since new ones
	//Will be added if necessary anyway. This is very
	//much a greedy and inefficient way of doing validation
	//but its easy and works for what we need.
	$("#" + formId + " .error").remove();
	$("#" + formId + " .invalid").removeClass("invalid");
	//Here we check each field to see if it is empty
	$("#" + formId + " *").filter(':input').each(function(){
	    var field = $(this);
	    var fieldData = field.data();
	    
	    //Funny logic below, but works easiest to make it so all fields are required
	    //unless specifically stated as it being not required
	    var fieldRequired = !(fieldData.required === false);
	    var thisFieldValid = true;
	    //Here we check if all required fields have some stuff in them
	    if(fieldRequired){
	    	thisFieldValid = false;
		    //Here we check if it is required, if so then check validation
		    if(field.val() === ""){
		    	field.addClass("invalid");
		    	var requiredErrorBlock = "<span class='help-block error'>Required</span>";
		    	field.parent().append(requiredErrorBlock);
		    } else {
		    	thisFieldValid = true;
		    }
	    }
	    
	    isValid = isValid && thisFieldValid; 
	});


	//Types are zipCode, phoneNumber, emailAddress, and password
	$("#" + formId + " *").filter("[data-type]").each(function(){
		var field = $(this);
		var fieldData = field.data();
		var fieldType = fieldData.type;
		var fieldOptional = (fieldData.required === false);
		//If there's already errors, no point in doing
		//more work so lets just skip those that are invalid
		//also to keep from validating options fields don't validate
		//if they are empty and not required
		if(fieldOptional && field.val() === ""){
			return;
		}

		if(!field.hasClass("invalid")){
			if(fieldType == "phoneNumber"){
				isValid = validatePhoneNumber(field);
			} else if(fieldType === "emailAddress") {
				isValid = validateEmailAddress(field);
			} else if(fieldType === "zipCode") {
				isValid = validateZipCode(field);
			} else if(fieldType === "password") {
				isValid = validatePassword(field);
			}
		}
	});
	
	return isValid; // austin you forgot to return isValid so I added it for you :P
}

function validatePhoneNumber(field) {
	var phoneNumberField = field;
	var phoneNumberValue = phoneNumberField.val();
	var phoneNumberPattern = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
	var phoneNumberValid = phoneNumberPattern.test(phoneNumberValue);
	var isValid = true;
	if(!phoneNumberValid){
		phoneNumberField.addClass("invalid");
		var phoneNumberErrorBlock = "<span class='help-block error'>Invalid Phone Number</span>";
		phoneNumberField.parent().append(phoneNumberErrorBlock);
		isValid = false;
	}

	return isValid;
}

function validateEmailAddress(field) {
	var emailAddressField = field;
	var emailAddressValue = emailAddressField.val();
	var emailAddressPattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var emailAddressValid = emailAddressPattern.test(emailAddressValue);
	var isValid = true;
	if(!emailAddressValid){
		emailAddressField.addClass("invalid");
		var emailAddressErrorBlock = "<span class='help-block error'>Invalid Email Address</span>";
		emailAddressField.parent().append(emailAddressErrorBlock);
		isValid = false;
	}

	return isValid;
}

function validateZipCode(field) {
	var zipCodeField = field;
	var zipCodeValue = zipCodeField.val();
	var zipCodePattern = /(^\d{5}$)|(^\d{5}-\d{4}$)/;
	var zipCodeValid = zipCodePattern.test(zipCodeValue);
	var isValid = true;
	if(!zipCodeValid){
		zipCodeField.addClass("invalid");
		var zipCodeErrorBlock = "<span class='help-block error'>Invalid Zip Code</span>";
		zipCodeField.parent().append(zipCodeErrorBlock);
		isValid = false;
	}

	return isValid;
}

function validatePassword(field) {
	var passwordField = field;
	var passwordFieldData = passwordField.data();
	var confirmPasswordField = $("#" + passwordFieldData.compare);
	var passwordValue = passwordField.val();
	var confirmPasswordValue = confirmPasswordField.val();
	var isValid = true;
	if(passwordValue !== confirmPasswordValue){
		passwordField.addClass("invalid");
		var passwordErrorBlock = "<span class='help-block error'>Password and Password Confirmation must match</span>";
		passwordField.parent().append(passwordErrorBlock);
		isValid = false;
	}

	return isValid;
}
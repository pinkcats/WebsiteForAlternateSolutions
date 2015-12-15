$(document).ready( function() {
	var contactUsForm = $('#contactUsForm');

    $("#contactUsForm input").on("blur", function() {
    	if(contactUsForm.hasClass("dirty")){
    		validateForm("contactUsForm");
    	}
    });
	
	$("#contactUsSubmit").on("click", function() {
		contactUsForm.addClass("dirty");
    	var valid = validateForm("contactUsForm");

		if(!valid) { 
			return;
		}

		$.ajax( {
			type: "POST",
			url: "php/controller/contactUsController.php",
			data: contactUsForm.serialize(),
			dataType: "json",
			success: function(response) {
				document.getElementById("contactUsForm").reset();
				$("#contactUsSuccess").fadeIn();
			}
		});  

	});
});
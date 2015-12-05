$(document).ready( function() {
    var contactInfoForm = $('#contactInfoForm');

    $("#contactInfoForm input").on("blur", function() {
    	if(contactInfoForm.hasClass("dirty")){
    		validateForm("contactInfoForm");
    	}
    });

    $("#contactInfoSave").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
		
    	contactInfoForm.addClass("dirty");
    	var valid = validateForm("contactInfoForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/contactInfoController.php",
			data: contactInfoForm.serialize(),
			dataType: "json",
			success: function(response) {
				console.log(response.success);
				if(response.success){
					alert("It Worked");
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
});
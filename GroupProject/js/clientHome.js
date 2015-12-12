$(document).ready( function() {
	contactInfo();
	serviceRequest();
	joinOrganization();
});

function contactInfo(){
	var firstName = $("#firstName").val();
	var lastName = $("#lastName").val();
	$("#userWelcome").text(firstName + " " + lastName);
	
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
					window.location = "clientHome.php";
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
};

function serviceRequest(){
	
	var serviceRequestForm = $('#serviceRequestForm');
	
	$("#serviceRequestForm input").on("blur", function() {
    	if(serviceRequestForm.hasClass("dirty")){
    		validateForm("serviceRequestForm");
    	}
    });
	
	$("#serviceRequesterSubmit").on("click", function() {
    	
		debugger;
    	serviceRequestForm.addClass("dirty");
    	var valid = validateForm("serviceRequestForm");
		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/serviceRequestController.php",
			data: serviceRequestForm.serialize(),
			dataType: "json",
			success: function(response) {
				console.log(response.success);
				if(response.success){
					alert("worked");
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
};

function joinOrganization(){
    var joinOrganizationForm = $('#joinOrganizationForm');

    $("#joinOrganizationForm input").on("blur", function() {
    	if(joinOrganizationForm.hasClass("dirty")){
    		validateForm("joinOrganizationForm");
    	}
    });


    $("#joinOrganizationSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	joinOrganizationForm.addClass("dirty");
    	debugger;
    	var valid = validateForm("joinOrganizationForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/clientHome/joinOrganizationController.php",
			data: joinOrganizationForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					alert('done');
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			},
			complete: function() {
				joinOrganizationForm.trigger("reset");
			}
		});  
	});
};
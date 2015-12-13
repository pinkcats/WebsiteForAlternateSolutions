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

    	var valid = validateForm("joinOrganizationForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/userHome/joinOrganizationController.php",
			data: joinOrganizationForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					var well = $("#joinOrganizationForm").parent();
					var success = '<div class="alertalert-success">' + 
									'You have successfully joined the organization <strong>'+ response.newOrganization.name +'</strong>' +
									'</div>';
					$("#joinOrganizationForm").remove();
					well.append(success).fadeIn();
				} else {
					var errorMessage = "Invalid Organization Key. Please make sure you are using the key"
										+ " provided to you by your supervisor.";
					var invalidKeyBlock = "<span class='help-block error'>"+ errorMessage +"</span>";
		    		$("#joinOrganizationKey").parent().append(invalidKeyBlock);
				}
			},
			complete: function() {
				joinOrganizationForm.trigger("reset");
			}
		});  
	});
};
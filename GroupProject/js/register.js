$(document).ready( function() {
    var registerForm = $('#registerForm');
	var staffVeriForm = $("#staffVeriForm");
	var isValidStaffLogin = false;
	var isValidOrganizationKey = false;
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
		var isStaff = parseInt($("input[name=isStaff]:checked").val()) === 1;
		var isOrganizaiton = parseInt($("input[name=isOrganization]:checked").val()) === 1;

		if(isOrganizaiton){
			verifyOrganizationKey();
			
		} else if(isStaff){
			$("#responseMessage").empty();
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
							isValidStaffLogin = true;
						}else if(!response.success){
							isValidStaffLogin = false;	
						} else {
							alert('An error has occured! Error in console.');
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

	$("input[name=isOrganization]").on("change", function() {
		var isOrganizaiton = parseInt($("input[name=isOrganization]:checked").val()) === 1;
		var organizationKeyField = $("#organizationKeyDiv");
		if(isOrganizaiton){
			organizationKeyField.removeClass("hidden");
		} else {
			organizationKeyField.addClass("hidden");
		}
		
	});


	
	//functions that might make things easier
	var verifyOrganizationKey = function() {
		var organizationKey = $("#organizationKey").val();
		var validKey = false;
		$.ajax({
			type: "POST",
			url: "php/controller/staffHome/checkOrganizationKeyController.php",
			data: {
				organizationKey: organizationKey
			},
			dataType: "json",
			success: function(response) {
				if(response.success){
					isValidOrganizationKey = true;
				}
			},
			error: function(response) {
				alert("An error occured on organization check.");
			}
		}).done(function(response){
			markValid(response);
		}); 
	}

	var markValid = function(response) {
		debugger;
		if(!isValidOrganizationKey){
			var invalidKeyBlock = "<span class='help-block error'>Invalid Organization Key</span>";
		    $("#organizationKey").parent().append(invalidKeyBlock);
		} else {
			var organizationId = response.organizationId;
			registerUser(organizationId);
		}
	}

	var isVerifed = function(){
		if(!isValidStaffLogin){
			$("#responseMessage").empty().append("Invalid Staff Login");
		}else{
			$("#responseMessage").empty().append("Welcome, Staff");
			registerUser();
			
		}
	};
	var registerUser =  function(organizationId){
		var data = registerForm.serialize();
		if(typeof organizationId !== 'undefined'){
			data += "&organizationId=" + encodeURIComponent(organizationId);
		}
		$.ajax( {
				type: "POST",
				url: "php/controller/registerController.php",
				data: data,
				dataType: "json",
				success: function(response) {
					if(response.success){
						window.location = "clientPortal.php";
					} else {
						alert('An error has occured! Error in console.');
					}
				}
			}); 
	};
});

			
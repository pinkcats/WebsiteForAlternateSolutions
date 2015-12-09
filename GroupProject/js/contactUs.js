$(document).ready( function() {
	var contactUsForm = $('#contactUsForm');

    $("#contactUsForm input").on("blur", function() {
    	if(contactUsForm.hasClass("dirty")){
    		validateForm("contactUsForm");
    	}
    });

	//$("#contactUsError").hide();
    
	
	
	$("#contactUsSubmit").on("click", function() {
		contactUsForm.addClass("dirty");
    	var valid = validateForm("contactUsForm");

		if(!valid) { 
			return;
		}
		/*var valid = true;
		var name = $("#contactUsName").val();
		var phone = $("#contactUsPhone").val();
		var email = $("#contactUsEmail").val();
		var subject = $("#contactUsSubject").val();
		var message = $("#contactUsMessage").val();
		
		if(name.length < 1){
			valid = false;
		}
		
		var regex = new RegExp("/^[2-9]\d{2}-\d{3}-\d{4}$/g");
		if(phone.length < 1){
			valid = false;
		}
		
		if(email.length < 1){
			valid = false;
		}
		
		if(subject.length < 1){
			valid = false;
		}
		
		if(message.length < 1){
			valid = false;
		}*/
		

		$.ajax( {
			type: "POST",
			url: "php/controller/contactUsController.php",
			data: contactUsForm.serialize(),
			dataType: "json",
			success: function(response) {
				document.getElementById("contactUsForm").reset();
				$("#contactUsError").hide();
				alert("Success");
			}
		});  

	});
});
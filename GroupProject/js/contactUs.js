$(document).ready( function() {
    var contactUsForm = $('#contactUsForm');
    $("#contactUsSubmit").on("click", function() {
		$.ajax( {
			type: "POST",
			url: "php/controller/contactUsController.php",
			data: contactUsForm.serialize(),
			dataType: "json",
			success: function(response) {
				document.getElementById("contactUsForm").reset();
				alert("Success");
			}
		});  
	});
});
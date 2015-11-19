$(document).ready( function() {
    
    $("#contactUsSubmit").on("click", function() {
		$.ajax( {
			type: "POST",
			url: "php/controller/contactUsController.php",
			data: form.serialize(),
			dataType: "json",
			success: function(response) {
				console.log(response.success);
			}
		});  
	});
});
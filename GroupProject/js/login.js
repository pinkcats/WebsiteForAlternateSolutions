$(document).ready( function() {
    var form = $('#loginForm');
    $("#loginSubmit").on("click", function() {
  
		$.ajax( {
			type: "POST",
			url: "../php/controller/loginController.php",
			data: form.serialize(),
			success: function( response ) {
				console.log( response );
			}
		});  
	});

});
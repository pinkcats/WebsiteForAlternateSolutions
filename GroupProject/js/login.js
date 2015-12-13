$(document).ready( function() {
	$("#loginError").hide();
    var form = $('#loginForm');
    $("#loginSubmit").on("click", function() {
		
		var valid = true;
		
		var username = $("#username").val();
		var password = $("#password").val();
		
		if(username.length < 1){
			valid = false;
		}
		if(password.length < 1){
			valid = false;
		}
		if(valid)
		{
			$.ajax( {
				type: "POST",
				url: "php/controller/loginController.php",
				data: form.serialize(),
				dataType: "json",
				success: function(response) {
					$("#loginError").hide();
					if(response.success){
						window.location = "clientHome.php";
					}else{
						$("#loginError").show();
					}
				}
			});  
		}
		else{
			$("#loginError").show();
		}
	});
});
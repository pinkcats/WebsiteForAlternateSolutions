
<!--
	This is a template. That means you do not dev you stuff here.
	you just copy this into a new file and start from there.
-->


<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<!--<link rel="icon" href="../../favicon.ico">-->
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/site.css" rel="stylesheet">
        <title>Client Portal</title>
    </head>
    <body>
    
		<!-- Header Include -->
		<?php include "php/header.php"; ?>
		
		<!-- Begin page content -->
		<div class="container">
		    <div class="row">
			
				<!-- sidebar Include -->
				<?php include "php/sidebar.php";?> 
				
			    <div class="col-md-9">
					<h1>Client Portal</h1>
					<hr/>
					<div class="well">
					<article style="text-align:center;">
						<h3>Manage Your Account</h3>
						<div>
							<form id="loginForm">
								<label>Username:
								<input name="userName" id="username"/></label>
								
								<br/>
								<label>Password: 
								<input name="password" id="password"/></label>
								<br/>
								<a id="loginSubmit" href="#" class="btn btn-default">Submit</a>
								<a href="register.php" class="btn btn-default">Register</a><br/>
								<span id="loginError" class="error">The Username or Password is invalid.</span>
							</form>
						</div>
					</article>
					</div>
				</div> 
			</div>
		</div>

		<!-- Footer Include -->
		<?php include "php/footer.php"; ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
		<script src="js/login.js"></script>
	</body>
</html>

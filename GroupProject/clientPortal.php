<?php
	include "php/portalConfig.php";
?>

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
		<link href="./images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
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
					<h1>Portal</h1>
					<hr/>
					<div class="well">
					<article>
						<h3 class="col-lg-10 col-lg-offset-2">Manage Your Account</h3>
							<form id="loginForm" class="form-horizontal">
								<div class="form-group">
									<label for="username" class="col-lg-2 control-label">Username:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="username" name="userName"/>
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-lg-2 control-label">Password:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="password" name="password"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<a href="#" class="btn btn-default" id="loginSubmit">Submit</a>
										<a href="register.php" class="btn btn-default">Register</a>
									</div>
								</div>
								<span id="loginError"> The Username or password is invalid.</span>
							</form>
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

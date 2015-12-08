<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="robots" content="noindex, nofollow" />
		<!--<link rel="icon" href="../../favicon.ico">-->
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/site.css" rel="stylesheet">
		<link href="./images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <title>Client Portal | Register</title>
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
					<article>
						<h3>Register Your Account</h3>
						<div>
							<form id="registerForm" class="form-horizontal">
								<div class="form-group">
      								<label for="firstName" class="col-lg-2 control-label">First Name</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="firstName" name="firstName">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="lastName" class="col-lg-2 control-label">Last Name</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="lastName" name="lastName">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="address" class="col-lg-2 control-label">Address</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="address" name="address">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="city" class="col-lg-2 control-label">City</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="city" name="city">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="state" class="col-lg-2 control-label">State</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="state" name="state">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="zipCode" class="col-lg-2 control-label">Zip Code</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="zipCode" data-type="zipCode" name="zipCode">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="emailAddress" class="col-lg-2 control-label">Email Address</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="emailAddress" data-type="emailAddress" name="emailAddress">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="phoneNumber" class="col-lg-2 control-label">Phone Number</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="phoneNumber" data-type="phoneNumber" name="phoneNumber">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="isStaff" class="col-lg-2 control-label">Staff</label>
      								<div class="col-lg-10">
        								<div class="radio">
          									<label>
            									<input type="radio" name="isStaff" value="1">
            										Yes
          									</label>
    									</div>
        								<div class="radio">
          									<label>
									            <input type="radio" name="isStaff" value="0" checked="">
									            	No
          										</label>
        								</div>
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="password" class="col-lg-2 control-label">Password</label>
      								<div class="col-lg-10">
        								<input type="password" class="form-control" id="password" data-type="password" data-compare="passwordConfirmation" name="password">
      								</div>
    							</div>

    							<div class="form-group">
      								<label for="passwordConfirmation" class="col-lg-2 control-label">Password Confirmation</label>
      								<div class="col-lg-10">
        								<input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation">
      								</div>
    							</div>

    							<div class="form-group">
      								<div class="col-lg-10 col-lg-offset-2">
        								<a id="registerSubmit" class="btn btn-default">Submit</a>
										<a href="clientPortal.php" class="btn btn-default">Login</a>
      								</div>
    							</div>
								
							
								
							</form>
						</div>
					</article>
					</div>
				</div> 
			</div>
		</div>
		<!---Modal--->
		<div class="modal" id="staffVeriModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="glyphicon glyphicon glyphicon-remove"></span>
						</button>
						<h4 class="modal-title">Staff Verifcation</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="staffVeriForm">
							<div class="form-group">
      								<label for="staffUser" class="col-lg-2 control-label">Username:</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="staffUser" name="staffUser">
      								</div>
    						</div>
							<div class="form-group">
      								<label for="staffPass" class="col-lg-2 control-label">Password:</label>
      								<div class="col-lg-10">
        								<input type="text" class="form-control" id="staffPass" name="staffPass">
      								</div>
    						</div>
							<div class="modal-footer">
								<div class="form-group">
      								<div class="col-lg-10 col-lg-offset-2">
									<button type="button" class="btn btn-default">Submit</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      								</div>
    							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Include -->
		<?php include "php/footer.php"; ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
		<script src="js/register.js"></script>
	</body>
</html>

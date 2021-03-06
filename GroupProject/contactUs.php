
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
		<meta name="robots" content="noindex, nofollow" />
		<!--<link rel="icon" href="../../favicon.ico">-->
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/site.css" rel="stylesheet">
		<link href="./images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <title>Contact Us</title>
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
					<h2 id="sec0">Contact Us</h2>
					<hr/>
					<div class="well">
						<article>
							<h3>Do you or your organization need conflict resolution?</h3>
							<form id="contactUsForm" class="form-horizontal">
								<div id="contactUsSuccess" class="alert alert-dismissible alert-success" hidden>
											<button type="button" class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></button>
											Thank you for reaching out to us. We will respond to you as soon as we are able.
										</div>
								<div class="form-group">
									<label for="contactUsName" class="col-lg-2 control-label">
										Name: </label>
									<div class="col-lg-10">
										<input type="text" id="contactUsName" name="name" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label for="contactUsPhone" class="col-lg-2 control-label">
										Phone:</label>
									<div class="col-lg-10">
										<input type="text" id="contactUsPhone" data-type="phoneNumber" name="phone" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label for="contactUsEmail" class="col-lg-2 control-label">
										Email:
									</label>
									<div class="col-lg-10">
										<input type="text" id="contactUsEmail" data-type="emailAddress" name="email" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label for="contactUsSubject" class="col-lg-2 control-label">Subject:</label>
									<div class="col-lg-10">
										<input type="text" id="contactUsSubject" name="subject" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label for="contactUsMessage" class="col-lg-2 control-label">Message:</label>
									<div class="col-lg-10">
										<textarea id="contactUsMessage" name="message" class="form-control"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<a id="contactUsSubmit" class="btn btn-default">Submit</a>
									</div>
								</div>
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
		<script src="js/contactUs.js"></script>
	</body>
</html>

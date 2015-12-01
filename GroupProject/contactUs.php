
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
							<h3>Do you or your orgnizaiton need conflict resolution?</h3>
							<form id="contactUsForm">
								<label>Name: <br>
								<input type="text" id="contactUsName" name="name"></label><br>
								<label>Phone:<br/>
								<input type="text" id="contactUsPhone" name="phone"></label><br/>
								<label>Email:<br/>
								<input type="text" id="contactUsEmail" name="email"></label><br/>
								<label>Subject:<br>
								<input type="text" id="contactUsSubject" name="subject"></label><br>
								<label>Message:<br>
								<textarea rows="4" id="contactUsMessage" name="message"></textarea></label><br>
								<a id="contactUsSubmit" class="btn btn-default">Submit</a>
								<span id="contactUsError">Your form is invalid.</span>
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

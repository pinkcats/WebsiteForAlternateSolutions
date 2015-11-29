
<!--
	This is a template. That means you do not dev you stuff here.
	you just copy this into a new file and start from there.
-->
<?php
	include "php/userConfig.php";
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
        <title>Client Home</title>
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
					<h1 id="sec0" style="text-align:center;">
					Welcome, <?= $userFirstName . " " . $userLastName; ?>!
					</h1>
					<hr/>
					<div class="well">
						<article>
							<h3>Contact Information</h3>
							<form class="form-horizontal">
								<div class="form-group">
									<label for="firstName" class="col-lg-2 control-label">
									First Name:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="firstName" name="firstName"/>
									</div>
								</div>
								<div class="form-group">
									<label for="lastName" class="col-lg-2 control-label">
									Last Name:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="lastName" name="lastName"/>
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-lg-2 control-label">
									 Email:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="email" name="email"/>
									</div>
								</div>
								<div class="form-group">
									<label for="phone" class="col-lg-2 control-label">
									Phone Number:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="phone" name="phone"/>
									</div>
								</div>
								<div class="form-group">
									<label for="address" class="col-lg-2 control-label">
									Address:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="address" name="address"/>
									</div>
								</div>
								<div class="form-group">
									<label for="city" class="col-lg-2 control-label">
									City:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="city" name="city"/>
									</div>
								</div>
								<div class="form-group">
									<label for="state" class="col-lg-2 control-label">
									State:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="state" name="state"/>
									</div>
								</div>
								<div class="form-group">
									<label for="zipcode" class="col-lg-2 control-label">
									Zipcode:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="zipcode" name="zipcode"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<a href="#" class="btn btn-primary">Save</a>
									</div>
								</div>
							</form>
						</article>
					</div>
					<div class="well">
						<article>
							<h3>Schedule of Services</h3>
							<form class="form-horizontal">
								<div class="form-group">
									<label for="startDate" class="col-lg-2 control-label">
									Start Date:
									</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="startDate" name="startDate"/>
									</div>
								</div>
								<div class="form-group">
									<label for="endDate" class="col-lg-2 control-label">
									End Date:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="endDate" name="endDate"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<a href="#" class="btn btn-primary">Submit</a>
									</div>
								</div>
								<table class="table">
									<tbody>
										<?php foreach($services as $service){ ?> 
											<tr>
												<td><?= $service['name']; ?></td>
												<td><a href="#" class="btn btn-primary">Schedule</a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</form>
						</article>
					</div>
					<div class="well">
						<article>
							<h3>Request Service</h3>
							<form class="form-horizontal">
								<div class="form-group">
									<label for="service" class="col-lg-2 control-label">
									Service:</label>
									<div class="col-lg-10">
										<select id="service" name="service" class="form-control">
											<option value="-1">Select a Service</option>
											<?php foreach($services as $service){ ?>
												<option><?= $service['name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="date" class="col-lg-2 control-label">
									Date:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="date" name="date"/>
									</div>
								</div>
								<div class="form-group">
									<label for="time" class="col-lg-2 control-label">
									Time:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="time" name="time"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<a href="#" class="btn btn-primary">Submit</a>
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
	</body>
</html>

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
						<h2>Contact Information</h2>
						<table>
							<tbody>
								<tr>
									<td><label for="firstName">First Name:</label></td>
									<td><input name="firstName"/></td>
								</tr>
								<tr>
									<td><label for="lastName">Last Name:</label></td>
									<td><input name="lastName"/></td>
								</tr>
								<tr>
									<td><label for="email">Email:</label></td>
									<td><input name="email"/></td>
								</tr>
								<tr>
									<td><label for="phoneNumber">Phone Number:</label></td>
									<td><input name="phoneNumber"/></td>
								</tr>
								<tr>
									<td><label for="address">Address:</label></td>
									<td><input name="address"/></td>
								</tr>
							</tbody>
						</table>
						<a href="#" class="btn btn-default">Save</a>
						</article>
					</div>
					<div class="well">
						<article>
							<h2>Schedule of Services</h2>
							<table>
								<tbody>
									<tr>
										<td><label for="startDate">Start Date:</label></td>
										<td><input name="startDate"/></td>
									</tr>
									<tr>
										<td><label name="endDate">End Date: </label></td>
										<td><input name="endDate" id="endDate"/></td>
									</tr>
								</tbody>
							</table>
							<a href="#" class="btn btn-default">Submit</a><br/>
							<textarea></textarea>
						</article>
					</div>
					<div class="well">
						<h2>Request Service</h2>
						<table>
							<tbody>
								<tr>
									<td><label for="service">Serivce:</label></td>
									<td><select name="service" id="service">
										<option value="0">The services</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><label for="date">Date:</label></td>
									<td><input name="date" id="date"/></td>
								</tr>
								<tr>
									<td><label for="time">Time:</td>
									<td><input name="time" id="time"/></td>
								</tr>
							</tbody>
						</table>
						<a href="#" class="btn btn-default">Submit</a>
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
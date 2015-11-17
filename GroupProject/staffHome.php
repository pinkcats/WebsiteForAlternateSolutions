
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
        <title>Staff Home</title>
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
					Welcome, Staff Member!!
					</h1>
					<hr/>
					<div class="well">
					<h2>Clients</h2>
						<table>
							<tbody>
								<tr>
									<td><h3>Client A</h3></td>
									<td><a href="#" class="btn btn-default">View</a></td>
									<td><a href="#" class="btn btn-default">Edit</a></td>
								</tr>
								<tr>
									<td><h3>Client B</h3></td>
									<td><a href="#" class="btn btn-default">View</a></td>
									<td><a href="#" class="btn btn-default">Edit</a></td>
								</tr>
								<tr>
									<td><h3>Client C</h3></td>
									<td><a href="#" class="btn btn-default">View</a></td>
									<td><a href="#" class="btn btn-default">Edit</a></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="well">
						<h2>Schedule</h2>
						<table>
							<tbody>
								<tr>
									<td>Date Range:</td>
									<td><input /></td>
									<td><input /></td>
								</tr>
								<tr>
									<td>Service:</td>
									<td><select>
										<option value="0">Service</option>
									</td>
								</tr>
								<tr>
									<td>Client:</td>
									<td><select>
										<option value="0">All Clients</option>
										</select>
									</td>
								</tr>
							</tbody>
						</table>
						<a href="#" class="btn btn-default">Search</a>
					</div>
					<div class="well">
						<h2>Requests</h2>
						<textarea></textarea>
					</div>
				</div> 
			</div>
		</div>

		<!-- Footer Include -->
		<?php include "php/footer.php"; ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php
	include "php/staffConfig.php";
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
					Welcome, <?= $staffFirstName . " " . $staffLastName; ?>
					</h1>
					<hr/>
					<div class="well">
					<h2>Clients</h2>
						<table class="table">
							<tbody>
								<?php foreach($clients as $client){ ?>
									<tr>
										<td><h3><?= $client['name'];?></h3></td>
										<td><a href="#" class="btn btn-default">View</a></td>
										<td><a href="#" class="btn btn-default">Edit</a></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="well">
						<h2>Schedule</h2>
						<form>
							<table class="table">
								<tbody>
									<tr>
										<td>Date Range:</td>
										<td><input /></td>
										<td><input /></td>
									</tr>
									<tr>
										<td>Service:</td>
										<td>
											<select>
											<?php foreach($services as $service){?>
												<option value="0"><?= $service['name']; ?></option>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<td>Client:</td>
										<td>
											<select>
												<?php foreach($clients as $client){ ?> 
													<option value="0"><?= $client['name']; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
							<a href="#" class="btn btn-default">Search</a>
						</form>
					</div>
					<div class="well">
						<h2>Requests</h2>
						<table class="table">
							<tbody>
							<?php foreach($requests as $request){?>
								<tr>
									<td><?= $request['name'];?></td>
									<td><?= $request['client'];?></td>
									<td><?= $request['date'];?></td>
									<td><?= $request['time']?></td>
									<td></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="well">
						<article>
							<h2>Sidebar Content</h2>
							<a href="#" class="btn btn-default">Add</a>
							<table class="table">
								<thead>
									<tr>
										<td>Title</td>
										<td>Link</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php foreach($links as $link){ ?>
										<tr>
											<td><?= $link['title']; ?></td>
											<td><?= $link['link'];?></td>
											<td><a href="#" class="btn btn-default">Archive</a></td>
											<td><a href="#" class="btn btn-default">Edit</a></td>
											<td><a href="#" class="btn btn-default">Delete</a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
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
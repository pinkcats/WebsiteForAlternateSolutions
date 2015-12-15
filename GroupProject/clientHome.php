<?php
	include "php/userConfig.php";
	include_once "php/dbConfig.php";
	try {
		$query = $db->prepare("SELECT u.first_name, u.last_name, u.email, u.phone_number, u.address, u.city, u.state, u.zip_code FROM users as u WHERE u.Id = ?");
		$query->execute(array($userId));
		$contactInfo = $query->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $ex) {
		echo "Something went wrong with getting the contact information"; 
		echo $ex->getMessage();
	}
	
	try{
		$services = $db->prepare("SELECT Id, name, description FROM services");
		$services->execute(array());
		$servicesArr = $services->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the services"; 
		echo $ex->getMessage();
	}

	try{
		$organizationQuery = $db->prepare("SELECT name, email FROM userOrganization AS UO INNER JOIN organization AS O ON O.Id = UO.organization_Id WHERE user_Id = ?");
		$organizationQuery->execute(array($userId));
		$organizationInfo = $organizationQuery->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the services"; 
		echo $ex->getMessage();
	}

	try{
		$schedules = $db->prepare("SELECT users.first_name, users.last_name, schedule.startDate, schedule.endDate, services.name FROM users INNER JOIN schedule ON users.Id = schedule.clientId INNER JOIN services ON schedule.serviceId = services.Id WHERE schedule.isArchived =0 AND users.Id  = ?");
		$schedules->execute(array($userId));
		$schedulesArr = $schedules->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $ex){
		echo "Something went wrong with getting the schedule requests";
		echo $ex->getMessage();
	}


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
		<meta name="robots" content="noindex, nofollow" />
		<!--<link rel="icon" href="../../favicon.ico">-->
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/site.css" rel="stylesheet">
		<link href="./images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
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
					Welcome, <span id="userWelcome"></span>!
					</h1>
					<hr/>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#info" data-toggle="tab" aria-expanded="false">Information</a></li>
						<li><a href="#services" data-toggle="tab" aria-expanded="false">Services</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="info">
							<div class="well">
								<article>
									<h3>Contact Information</h3>
									<form id="contactInfoForm" class="form-horizontal">
										<div class="form-group hidden">
											<label for="Id" class="col-lg-2 control-label">
											Id:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="Id" name="Id" value="<?php echo $userId;?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="firstName" class="col-lg-2 control-label">
											First Name:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $contactInfo[0]["first_name"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="lastName" class="col-lg-2 control-label">
											Last Name:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $contactInfo[0]["last_name"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="col-lg-2 control-label">
											 Email:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="email" name="email" data-type="emailAddress" value="<?php echo $contactInfo[0]["email"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="phone" class="col-lg-2 control-label">
											Phone Number:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="phone" name="phone" data-type="phoneNumber" value="<?php echo $contactInfo[0]["phone_number"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="address" class="col-lg-2 control-label">
											Address:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="address" name="address" value="<?php echo $contactInfo[0]["address"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="city" class="col-lg-2 control-label">
											City:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="city" name="city" value="<?php echo $contactInfo[0]["city"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="state" class="col-lg-2 control-label">
											State:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="state" name="state" value="<?php echo $contactInfo[0]["state"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<label for="zipcode" class="col-lg-2 control-label">
											Zipcode:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="zipcode" name="zipcode" data-type="zipCode" value="<?php echo $contactInfo[0]["zip_code"];?>"/>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-10 col-lg-offset-2">
												<a id="contactInfoSave" class="btn btn-default">Save</a>
											</div>
										</div>
									</form>
								</article>
							</div>
							<div class="well">
								<article>
									<h3>Organization Information</h3>
									<form id="joinOrganizationForm" class="form-horizontal">
										<?php 
											if(!empty($organizationInfo)){
												?>
													<div class="form-group">
														<div class="col-lg-12">
															<p><strong>Name: </strong><span><?= $organizationInfo[0]["name"]; ?></span><p>
														</div>
														<div class="col-lg-12">
															<p><strong>Contact Email: </strong><span><?= $organizationInfo[0]["email"]; ?></span></p>
														</div>
													</div>
												<?php
											} else {
												?>
													<div class="form-group">
														<label for="joinOrganizationKey" class="col-lg-2 control-label">
														Key:</label>
														<div class="col-lg-10">
															<input type="text" class="form-control" id="joinOrganizationKey" name="joinOrganizationKey"/>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-10 col-lg-offset-2">
															<a id="joinOrganizationSubmit" class="btn btn-default">Join Organization</a>
														</div>
													</div>
												<?php
											}
										?>
										
									</form>
								</article>
							</div>
						</div>
						<div class="tab-pane fade" id="services">
							<div class="well">
								<h3>Schedule of Services</h3>
								<article>
									<form class="form-horizontal" id="filterScheduleForm">
										<div class="form-group">
											<label for="startDate" class="col-lg-2 control-label">Start Date:</label>
											<div class="col-lg-10">
												<input type="date" class="form-control" id="scheduleStartDate" name="startDate" />
											</div>
										</div>
										<div class="form-group">
											<label for="endDate" class="col-lg-2 control-label">End Date:</label>
											<div class="col-lg-10">
												<input type="date" class="form-control" id="scheduleEndDate" name="endDate"/>
											</div>
										</div>
										<div class="form-group">
											<label for="service" class="col-lg-2 control-label">Service:</label>
											<div class="col-lg-10">
												<select id="scheduleService" name="service" class="form-control">
													<option value="-1">Select a Service</option>
													<?php foreach($servicesArr as $service){ ?>
														<option value="<?php echo $service['Id']?>"><?= $service['name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-10 col-lg-offset-2">
												<a class="btn btn-default" id="filterSchedule">Filter</a>
											</div>
										</div>
									</form>
									<table class="table table-striped table-hover" id="filterScheduleTable">
										<thead>
											<tr>
												<th>Service</th>
												<th>Start Date</th>
												<th>End Date</th>
											</tr>
										</thead>
										<tbody id="filterScheduleTableRows">
										<?php foreach($schedulesArr as $schedule){?>
											<tr>
												<td><?= $schedule['name'];?></td>
												<td><?= $schedule['startDate']; ?></td>
												<td><?= $schedule['endDate'];?></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</article>
							</div>
							<div class="well">
								<article>
									<h3>Request Service</h3>
									<form id="serviceRequestForm" class="form-horizontal">
										<div id="serviceRequestSuccess" class="alert alert-dismissible alert-success" hidden>
											<button type="button" class="close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></button>
											Service succesfully requested.
										</div>
										<div class="form-group">
											<label for="service" class="col-lg-2 control-label">
											Service:</label>
											<div class="col-lg-10">
												<select id="serviceRequesterService" name="service" class="form-control">
													<option value="-1">Select a Service</option>
													<?php foreach($servicesArr as $service){ ?>
														<option value="<?php echo $service['Id']?>"><?= $service['name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="date" class="col-lg-2 control-label">
											Date:</label>
											<div class="col-lg-10">
												<input type="date" class="form-control" id="serviceRequesterDate" name="date" placeholder="mm/dd/yyyy" />
											</div>
										</div>
										<div class="form-group hidden">
											<label for="Id" class="col-lg-2 control-label">
											Id:</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="serviceRequesterId" name="Id" value="<?php echo $userId; ?>"/>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-10 col-lg-offset-2">
												<a id="serviceRequesterSubmit" class="btn btn-default">Submit</a>
											</div>
										</div>
									</form>
								</article>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>

		<!-- Footer Include -->
		<?php include "php/footer.php"; ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
		<script src="js/clientHome.js"></script>
	</body>
</html>
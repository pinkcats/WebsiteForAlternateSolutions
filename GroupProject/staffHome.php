<?php
	include "php/staffConfig.php";
	include_once "php/dbConfig.php";
	
	try{
		$clients = $db->prepare("SELECT Id, first_name, last_name, email, CONCAT(first_name, ' ', last_name) AS full_name FROM users WHERE is_staff = 0");
		$clients->execute(array());
		$clientsArr = $clients->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the clients"; 
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
		$sidebarLinks = $db->prepare("SELECT Id, title, link, (isArchived + 0) AS isArchived FROM sidebarLinks ORDER BY Id DESC");
		$sidebarLinks->execute(array());
		$sidebarLinksArr = $sidebarLinks->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the sidebar links"; 
		echo $ex->getMessage();
	}

	try{
		$organizations = $db->prepare("SELECT Id, name, organizationKey, email, address, city, state, zip_code FROM organization");
		$organizations->execute(array());
		$organizationsArr = $organizations->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the organizations"; 
		echo $ex->getMessage();
	}
	
	try{
		$contactRequests = $db->prepare("SELECT Id, name, email, message AS request FROM contactUs");
		$contactRequests->execute(array());
		$contactRequestsArr = $contactRequests->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the contact requests"; 
		echo $ex->getMessage();
	}
	
	try{
		$schedules = $db->prepare("SELECT users.first_name, users.last_name, schedule.startDate, schedule.endDate, services.name FROM users INNER JOIN schedule ON users.Id = schedule.clientId INNER JOIN services ON schedule.serviceId = services.Id WHERE schedule.isArchived =0");
		$schedules->execute(array());
		$schedulesArr = $schedules->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $ex){
		echo "Something went wrong with getting the schedule requests";
		echo $ex->getMessage();
	}
	
	try{
		$services = $db->prepare("SELECT serviceRequests.Id, services.name, users.first_name, users.last_name, serviceRequests.Date FROM services INNER JOIN serviceRequests ON services.Id = serviceRequests.serviceId INNER JOIN users ON serviceRequests.userId = users.Id");
		$services->execute(array());
		$servicesRequestArr = $services->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $ex){
		echo "Something went wrong with getting the service requests";
		echo $ex->getMessage();
	}

	try {
		$query = $db->prepare("SELECT u.first_name, u.last_name, u.email, u.phone_number, u.address, u.city, u.state, u.zip_code FROM users as u WHERE u.Id = ?");
		$query->execute(array($staffId));
		$contactInfo = $query->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $ex) {
		echo "Something went wrong with getting the contact information"; 
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
					Welcome, <span id="staffWelcome"></span>
					</h1>
					<hr/>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#myInfo" data-toggle="tab" aria-expanded="false">My Information</a></li>
						<li><a href="#clients" data-toggle="tab" aria-expanded="false">Clients</a></li>
						<li><a href="#serviceAndSchedule" data-toggle="tab" aria-expanded="false">Schedule</a></li>
						<li><a href="#sidebarContent" data-toggle="tab" aria-expanded="false">Sidebar Content</a></li>
						<li><a href="#organizations" data-toggle="tab" aria-expanded="false">Organizations</a></li>
						<li><a href="#contactRequests" data-toggle="tab" aria-expanded="false">Contact Requests</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="well tab-pane fade active in" id="myInfo">
							<article>
								<h3>My Information</h3>
								<form id="myContactInfoForm" class="form-horizontal">
									<div class="form-group hidden">
										<label for="myInfoId" class="col-lg-2 control-label">
										Id:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoId" name="Id" value="<?php echo $staffId;?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoFirstName" class="col-lg-2 control-label">
										First Name:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoFirstName" name="firstName" value="<?php echo $contactInfo[0]["first_name"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoLastName" class="col-lg-2 control-label">
										Last Name:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoLastName" name="lastName" value="<?php echo $contactInfo[0]["last_name"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoEmail" class="col-lg-2 control-label">
										 Email:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoEmail" name="email" data-type="emailAddress" value="<?php echo $contactInfo[0]["email"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoPhone" class="col-lg-2 control-label">
										Phone Number:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoPhone" name="phone" data-type="phoneNumber" value="<?php echo $contactInfo[0]["phone_number"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoAddress" class="col-lg-2 control-label">
										Address:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoAddress" name="address" value="<?php echo $contactInfo[0]["address"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoCity" class="col-lg-2 control-label">
										City:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoCity" name="city" value="<?php echo $contactInfo[0]["city"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoState" class="col-lg-2 control-label">
										State:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoState" name="state" value="<?php echo $contactInfo[0]["state"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="myInfoZipcode" class="col-lg-2 control-label">
										Zipcode:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="myInfoZipcode" name="zipcode" data-type="zipCode" value="<?php echo $contactInfo[0]["zip_code"];?>"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-10 col-lg-offset-2">
											<a id="myContactInfoSave" class="btn btn-default">Save</a>
										</div>
									</div>
								</form>
							</article>
						</div>
						<div class="well tab-pane fade" id="clients">
						<h2>Clients</h2>
							<table class="table table table-striped table-hover">
								<tbody>
									<?php foreach($clientsArr as $client){ ?>
										<tr>
											<td><h3><?= $client['full_name'];?></h3></td>
											<td class="text-right"><a href="clientView.php?Id=<?= $client['Id']?>" class="btn btn-default">View</a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="serviceAndSchedule">
							<div class="well">
								<h2>Schedule</h2>
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
											<label for="client" class="col-lg-2 control-label">Client:</label>
											<div class="col-lg-10">
												<select id="scheduleClient" name="client" class="form-control">
													<option value="-1">Select a Client</option>
													<?php foreach($clientsArr as $client){ ?> 
														<option value="<?php echo $client['Id']?>"><?= $client['full_name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-10 col-lg-offset-2">
												<a class="btn btn-default" id="addSchedulingButton">Add</a>
												<a class="btn btn-default" id="filterSchedule">Filter</a>
											</div>
										</div>
									</form>
									<table class="table table-striped table-hover" id="filterScheduleTable">
										<thead>
											<tr>
												<th>Client</th>
												<th>Service</th>
												<th>Start Date</th>
												<th>End Date</th>
											</tr>
										</thead>
										<tbody id="filterScheduleTableRows">
										<?php foreach($schedulesArr as $schedule){?>
											<tr>
												<td><?= $schedule['first_name']." ".$schedule['last_name'];?></td>
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
								<h2>Service Requests</h2>
								<table class="table table-striped table-hover">
									<tbody>
									<?php foreach($servicesRequestArr as $request){?>
										<tr>
											<td id="request<?=$request['Id'];?>" class="hidden"></td>
											<td><?= $request['name'];?></td>
											<td><?= $request['first_name']." ". $request['last_name'];?></td>
											<td><?= $request['Date'];?></td>
											<td><a class="btn btn-default deleteServiceRequest" data-id="<?= $request['Id'];?>">Delete</a></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="well tab-pane fade" id="sidebarContent">
							<article>
								<h2>Sidebar Content</h2>
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addSidebarLinkModal">
									Add
								</button>
								<table class="table table-striped table-hover" id="sidebarLinksTable">
									<thead>
										<tr>
											<th>Title</th>
											<th>Link</th>
											<th>Archived</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($sidebarLinksArr as $link){ ?>
											<tr>
												<td id="title<?= $link['Id']; ?>"><?= $link['title']; ?></td>
												<td id="link<?= $link['Id']; ?>"><a target="_blank" href="<?= $link['link']; ?>"><?= $link['link']; ?></a></td>
												<td id="isArchived<?= $link['Id']; ?>"><?= $link['isArchived']; ?></td>
												<td class="text-right"><button type="button" class="btn btn-default editSidebarLink" data-id="<?= $link['Id']; ?>">Edit</button></td>
												<td class="text-right"><button type="button" class="btn btn-default deleteSidebarLink" data-id="<?= $link['Id']; ?>">Delete</button></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</article>
						</div>
						<div class="well tab-pane fade" id="organizations">
							<article>
								<h2>Organizations</h2>
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addOrganizationModal">
									Add
								</button>
								<table class="table table-striped table-hover" id="organizationsTable">
									<thead>
										<tr>
											<th>Name</th>
											<th>Key</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($organizationsArr as $organization){ ?>
											<tr>
												<td id="organizationName<?= $organization['Id']; ?>"><?= $organization['name']; ?></td>
												<td id="organizationKey<?= $organization['Id']; ?>"><?= $organization['organizationKey']; ?></td>
												<td id="organizationEmail<?= $organization['Id']; ?>"><?= $organization['email']; ?></td>
												<td class="hidden" id="organizationAddress<?= $organization['Id']; ?>"><?= $organization['address']; ?></td>
												<td class="hidden" id="organizationCity<?= $organization['Id']; ?>"><?= $organization['city']; ?></td>
												<td class="hidden" id="organizationState<?= $organization['Id']; ?>"><?= $organization['state']; ?></td>
												<td class="hidden" id="organizationzipCode<?= $organization['Id']; ?>"><?= $organization['zip_code']; ?></td>
												<td class="text-right"><button type="button" class="btn btn-default editOrganization" data-id="<?= $organization['Id']; ?>">Edit</button></td>
												<td class="text-right"><button type="button" class="btn btn-default deleteOrganization" data-id="<?= $organization['Id']; ?>">Delete</button></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</article>
						</div>
						<div class="well tab-pane fade" id="contactRequests">
							<article>
								<h2>Contact Requests</h2>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th class="hidden">Id</th>
											<th>Name</th>
											<th>Email</th>
											<th>Request</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($contactRequestsArr as $contact){ ?>
										<tr>
											<td id="contactRequest<?=$contact['Id'];?>" class="hidden"><?= $contact['Id'];?></td>
											<td><?= $contact['name'];?></td>
											<td><?= $contact['email'];?></td>
											<td><?= $contact['request'];?></td>
											<td class="text-right"><button type="button" class="btn btn-default deleteContactRequest" data-id="<?= $contact['Id']; ?>">Delete</button></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</article>
						</div>
					</div>
				</div> 
			</div>
		</div>

		<!-- Modals -->
		<div class="modal" id="addScheduling">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="glyphicon glyphicon glyphicon-remove"></span>
						</button>
						<h4 class="modal-title">Add Scheduling</h4>
					</div>
					<div class="modal-body">
        				<article>
							<form class="form-horizontal" id="addSchedulingForm">
								<div class="form-group">
									<label for="scheduleClientPopup" class="col-lg-2 control-label">Client:</label>
									<div class="col-lg-10">
										<select id="scheduleClientPopup" name="scheduleClient" class="form-control">
											<option value="-1">Select a Client</option>
											<?php foreach($clientsArr as $client){ ?> 
												<option value="<?php echo $client['Id']?>"><?= $client['full_name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="scheduleServicePopup" class="col-lg-2 control-label">Service:</label>
									<div class="col-lg-10">
										<select id="scheduleServicePopup" name="scheduleService" class="form-control">
											<option value="-1">Select a Service</option>
											<?php foreach($servicesArr as $service){ ?>
												<option value="<?php echo $service['Id']?>"><?= $service['name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
      								<label for="addScheduleStart" class="col-lg-2 control-label">Start Date:</label>
      								<div class="col-lg-10">
										<input type="date" class="form-control" id="addScheduleStart" name="addScheduleStart"/>
      								</div>
    							</div>
								<div class="form-group">
      								<label for="addScheduleEnd" class="col-lg-2 control-label">End Date:</label>
      								<div class="col-lg-10">
										<input type="date" class="form-control" id="addScheduleEnd" name="addScheduleEnd"/>
      								</div>
    							</div>
							</form>
						</article>
      				</div>
					<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        				<button type="button" class="btn btn-default" id="addScheduleSubmit">Submit</button>
      				</div>
				</div>
			</div>
		</div>

		<div class="modal" id="addSidebarLinkModal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        					<span class="glyphicon glyphicon glyphicon-remove"></span>
        				</button>
        				<h4 class="modal-title">Add Sidebar Link</h4>
      				</div>
      				<div class="modal-body">
        				<article>
							<form class="form-horizontal" id="addSidebarLinkForm">
								<div class="form-group">
									<label for="addSidebarLinkTitle" class="col-lg-2 control-label">Title:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addSidebarLinkTitle" name="addSidebarLinkTitle" />
									</div>
								</div>
								<div class="form-group">
									<label for="addSidebarLinkAddress" class="col-lg-2 control-label">link:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addSidebarLinkAddress" name="addSidebarLinkAddress"/>
									</div>
								</div>
								<div class="form-group">
      								<label for="addSidebarLinkisArchived" class="col-lg-2 control-label">Archived</label>
      								<div class="col-lg-10">
        								<div class="radio">
          									<label>
            									<input type="radio" name="addSidebarLinkisArchived" value="1">
            										Yes
          									</label>
    									</div>
        								<div class="radio">
          									<label>
									            <input type="radio" name="addSidebarLinkisArchived" value="0" checked="">
									            	No
          										</label>
        								</div>
      								</div>
    							</div>
							</form>
						</article>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        				<button type="button" class="btn btn-default" id="addSidebarLinkSubmit">Submit</button>
      				</div>
    			</div>
  			</div>
		</div>

		<div class="modal" id="editSidebarLinkModal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        					<span class="glyphicon glyphicon glyphicon-remove"></span>
        				</button>
        				<h4 class="modal-title">Edit Sidebar Link</h4>
      				</div>
      				<div class="modal-body">
        				<article>
							<form class="form-horizontal" id="editSidebarLinkForm">
								<input type="hidden" id="editSidebarLinkId" name="editSidebarLinkId"/>
								<div class="form-group">
									<label for="editSidebarLinkTitle" class="col-lg-2 control-label">Title:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="editSidebarLinkTitle" name="editSidebarLinkTitle" />
									</div>
								</div>
								<div class="form-group">
									<label for="editSidebarLinkAddress" class="col-lg-2 control-label">Link:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="editSidebarLinkAddress" name="editSidebarLinkAddress"/>
									</div>
								</div>
								<div class="form-group">
      								<label for="editSidebarLinkIsArchived" class="col-lg-2 control-label">Archived</label>
      								<div class="col-lg-10">
        								<div class="radio">
          									<label>
            									<input type="radio" id="editSidebarLinkIsArchived" name="editSidebarLinkIsArchived" value="1">
            										Yes
          									</label>
    									</div>
        								<div class="radio">
          									<label>
									            <input type="radio" id="editSidebarLinkIsNotArchived" name="editSidebarLinkIsArchived" value="0" checked="">
									            	No
          										</label>
        								</div>
      								</div>
    							</div>
							</form>
						</article>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        				<button type="button" class="btn btn-default" id="editSidebarLinkSubmit">Save changes</button>
      				</div>
    			</div>
  			</div>
		</div>

		<div class="modal" id="addOrganizationModal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        					<span class="glyphicon glyphicon glyphicon-remove"></span>
        				</button>
        				<h4 class="modal-title">Add Organization</h4>
      				</div>
      				<div class="modal-body">
        				<article>
							<form class="form-horizontal" id="addOrganizationForm">
								<div class="form-group">
									<label for="addOrganizationName" class="col-lg-2 control-label">Name:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addOrganizationName" name="addOrganizationName"/>
									</div>
								</div>						
								<div class="form-group">
									<label for="addOrganizationEmail" class="col-lg-2 control-label">Email:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addOrganizationEmail" data-type="emailAddress" name="addOrganizationEmail" />
									</div>
								</div>
								<div class="form-group">
									<label for="addOrganizationAddress" class="col-lg-2 control-label">Address:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addOrganizationAddress" name="addOrganizationAddress" />
									</div>
								</div>
								<div class="form-group">
									<label for="addOrganizationCity" class="col-lg-2 control-label">City:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addOrganizationCity" name="addOrganizationCity" />
									</div>
								</div>
								<div class="form-group">
									<label for="addOrganizationState" class="col-lg-2 control-label">State:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addOrganizationState" name="addOrganizationState" />
									</div>
								</div>
								<div class="form-group">
									<label for="addOrganizationZipCode" class="col-lg-2 control-label">Zip Code:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="addOrganizationZipCode" data-type="zipCode" name="addOrganizationZipCode" />
									</div>
								</div>
							</form>
						</article>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        				<button type="button" class="btn btn-default" id="addOrganizationSubmit">Submit</button>
      				</div>
    			</div>
  			</div>
		</div>

		<!-- Footer Include -->
		<?php include "php/footer.php"; ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
		<script src="js/staffHome.js"></script>
	</body>
</html>
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
		$sidebarLinks = $db->prepare("SELECT Id, title, link, (isArchived + 0) AS isArchived FROM sidebarLinks");
		$sidebarLinks->execute(array());
		$sidebarLinksArr = $sidebarLinks->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the sidebar links"; 
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
					Welcome, <?= $staffFirstName . " " . $staffLastName; ?>
					</h1>
					<hr/>
					<div class="well">
					<h2>Clients</h2>
						<table class="table table table-striped table-hover">
							<tbody>
								<?php foreach($clientsArr as $client){ ?>
									<tr>
										<td><h3><?= $client['full_name'];?></h3></td>
										<td><a href="#" class="btn btn-default">View</a></td>
										<td><a href="#" class="btn btn-default">Edit</a></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="well">
						<h2>Schedule</h2>
						<article>
							<form class="form-horizontal">
								<div class="form-group">
									<label for="startDate" class="col-lg-2 control-label">Start Date:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="startDate" name="startDate" />
									</div>
								</div>
								<div class="form-group">
									<label for="endDate" class="col-lg-2 control-label">End Date:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="endDate" name="endDate"/>
									</div>
								</div>
								<div class="form-group">
									<label for="service" class="col-lg-2 control-label">Service:</label>
									<div class="col-lg-10">
										<select id="service" name="service" class="form-control">
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
										<select id="client" name="client" class="form-control">
											<option value="-1">Select a Client</option>
											<?php foreach($clientsArr as $client){ ?> 
												<option value="<?php echo $client['Id']?>"><?= $client['full_name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<a href="#" class="btn btn-default">Search</a>
									</div>
								</div>
							</form>
						</article>
					</div>
					<div class="well">
						<h2>Requests</h2>
						<table class="table table-striped table-hover">
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
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addSidebarLinkModal">
								Add
							</button>
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Title</th>
										<th>Link</th>
										<th>Archived</th>
										<th></th>
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
											<td class="text-right"><button type="button" class="btn btn-default archiveSidebarLink" data-id="<?= $link['Id']; ?>">Archive</button></td>
											<td class="text-right"><button type="button" class="btn btn-default editSidebarLink" data-id="<?= $link['Id']; ?>">Edit</button></td>
											<td class="text-right"><button type="button" class="btn btn-default deleteSidebarLink" data-id="<?= $link['Id']; ?>">Delete</button></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</article>
					</div>
					<div class="well">
						<article>
							<h2>Contact Requests</h2>
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Request</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($contacts as $contact){ ?>
									<tr>
										<td><?= $contact['name'];?></td>
										<td><?= $contact['email'];?></td>
										<td><?= $contact['request'];?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</article>
					</div>
				</div> 
			</div>
		</div>

		<!-- Modals -->
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
        				<button type="button" class="btn btn-default" id="addSidebarLinkSubmit">Save changes</button>
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
      								<label for="editSidebarLinkisArchived" class="col-lg-2 control-label">Archived</label>
      								<div class="col-lg-10">
        								<div class="radio">
          									<label>
            									<input type="radio" name="editSidebarLinkisArchived" value="1">
            										Yes
          									</label>
    									</div>
        								<div class="radio">
          									<label>
									            <input type="radio" name="editSidebarLinkisArchived" value="0" checked="">
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

		<!-- Footer Include -->
		<?php include "php/footer.php"; ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
		<script src="js/staffHome.js"></script>
	</body>
</html>

<?php
	include_once "php/dbConfig.php";
	$userId = $_GET['Id'];
	try {
		$query = $db->prepare("SELECT Id, first_name, last_name, email, CONCAT(first_name, ' ', last_name) AS full_name, address, city, state, phone_number, zip_code FROM users WHERE is_staff = 0 AND Id = ?");
		$query->execute(array($userId));
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
		<!--<link rel="icon" href="../../favicon.ico">-->
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/site.css" rel="stylesheet">
		<link href="./images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <title>Client View</title>
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
					<h2 id="sec0">Client View</h2>
					
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
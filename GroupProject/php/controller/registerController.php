<?php
	header('Content-Type', 'application/json');
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zipCode = $_POST["zipCode"];
	$isStaff = boolval($_POST["isStaff"]);
	$emailAddress = $_POST["emailAddress"];
	$phoneNumber = $_POST["phoneNumber"];
	$password = $_POST["password"];
	include_once "../dbConfig.php";
	
	$registerResponse = array("success" => FALSE);
	try {
		$query = $db->prepare
		("
			INSERT INTO 
				users
				(
					Id,
					first_name,
					last_name,
					address,
					city,
					state,
					zip_code,
					is_staff,
					email,
					phone_number,
					password
				)
			VALUES 
			 	(
			 		NULL,
			 		?,
			 		?,
			 		?,
			 		?,
			 		?,
			 		?,
			 		?,
			 		?,
			 		?,
			 		?
		 		);
		");
	
		$query->execute(array(
			$firstName, 
			$lastName, 
			$address, 
			$city, 
			$state, 
			$zipCode, 
			$isStaff, 
			$emailAddress, 
			$phoneNumber, 
			$password));
		if($query->rowCount() == 1){
			$registerResponse['success'] = TRUE;
		}
	} catch(PDOException $ex) {
		$registerResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($registerResponse);
?>
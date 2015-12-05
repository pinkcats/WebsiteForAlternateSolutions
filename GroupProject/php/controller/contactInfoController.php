<?php
	header('Content-Type', 'application/json');
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zipCode = $_POST["zipcode"];
	$emailAddress = $_POST["email"];
	$phoneNumber = $_POST["phone"];
	$Id = $_POST["Id"];
	include_once "../dbConfig.php";
	
	$contactInfoResponse = array("success" => FALSE);
	try {
		$query = $db->prepare
		("
			UPDATE 
				users 
			SET 
				first_name = ?,
				last_name = ?,
				address = ?,
				city = ?,
				state = ?,
				zip_code  = ?,
				email = ?,
				phone_number = ?
			WHERE 
				Id = ?
		");
		$query->execute(array(
			$firstName, 
			$lastName, 
			$address, 
			$city, 
			$state, 
			$zipCode, 
			$emailAddress, 
			$phoneNumber,
			$Id
			));
		if($query->rowCount() != -1){
			$contactInfoResponse['success'] = TRUE;
		}
	} catch(PDOException $ex) {
		$contactInfoResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($contactInfoResponse);
?>
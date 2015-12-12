<?php
	header('Content-Type', 'application/json');
	//$key = $_POST["addOrganizationKey"];
	$name = $_POST["addOrganizationName"];
	$email = $_POST["addOrganizationEmail"];
	$address = $_POST["addOrganizationAddress"];
	$city = $_POST["addOrganizationCity"];
	$state = $_POST["addOrganizationState"];
	$zip_code = $_POST["addOrganizationZipCode"];
	$uniqueKey = substr(md5($name . "" . $email . "" . $zip_code), 0, 8);
	include_once "../../dbConfig.php";
	
	$addOrganizationResponse = array("success" => FALSE);
	try {
		$query = $db->prepare
		("
			INSERT INTO 
				organization
				(
					Id,
					name,
					organizationKey,
					email,
					address,
					city,
					state,
					zip_code
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
			 		?
		 		);
		");
	
		$query->execute(array(
			$name, 
			$uniqueKey,
			$email,
			$address,
			$city,
			$state,
			$zip_code));
		$lastId = $db->lastInsertId();
		if($query->rowCount() == 1){
			$addOrganizationResponse['success'] = TRUE;
			$addOrganizationResponse['newOrganization'] = array(
				"id" => $lastId, 
				"name" => $name, 
				"key" => $uniqueKey,
				"email" => $email, 
				"address" => $address,
				"city" => $city,
				"state" => $state,
				"zipCode" => $zip_code);
		}
	} catch(PDOException $ex) {
		$addOrganizationResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($addOrganizationResponse);
?>
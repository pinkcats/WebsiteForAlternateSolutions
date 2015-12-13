<?php
	header('Content-Type', 'application/json');	
	include_once "../../dbConfig.php";
	include_once "../../userConfig.php";
	$organizationKey = $_POST["joinOrganizationKey"];

	$joinOrganizationResponse = array("success" => FALSE);

	try {
		$query = $db->prepare
		("
			SELECT Id, name FROM organization WHERE organizationKey = ?
		");
	
		$query->execute(array(
			$organizationKey));
		$organization = $query->fetchAll(PDO::FETCH_ASSOC);
		$organizationId = $organization[0]['Id'];
		$organizationName = $organization[0]['name'];
	} catch(PDOException $ex) {
		$joinOrganizationResponse['errorMessage'] = $ex->getMessage();
	}

	if(!empty($organizationId) && isset($organizationId)){
		try {
			$query = $db->prepare
			("
				INSERT INTO 
					userOrganization
					(
						user_Id,
						organization_Id
					)
				VALUES 
				 	(
				 		?,
				 		?
			 		);
			");
		
			$query->execute(array(
				$userId, 
				$organizationId));
			if($query->rowCount() == 1){
				$joinOrganizationResponse['success'] = TRUE;
				$joinOrganizationResponse['newOrganization'] = array(
					"name" => $organizationName);
			}
		} catch(PDOException $ex) {
			$joinOrganizationResponse['errorMessage'] = $ex->getMessage();
		}
	}
	echo json_encode($joinOrganizationResponse);
?>
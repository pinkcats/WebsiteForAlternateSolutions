<?php
	header('Content-Type', 'application/json');
	$organizationId = $_POST["organizationId"];
	include_once "../../dbConfig.php";
	
	$deleteOrganizationResponse = array("success" => FALSE);
	try {
		$query = $db->prepare
		("
			DELETE FROM 
				organization
			WHERE
				Id = ?;
		");
	
		$query->execute(array(
			$organizationId));
		$deleteOrganizationResponse['success'] = TRUE;
	} catch(PDOException $ex) {
		$deleteOrganizationResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($deleteOrganizationResponse);
?>
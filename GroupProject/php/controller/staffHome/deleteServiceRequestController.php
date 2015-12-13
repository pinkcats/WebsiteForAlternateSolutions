<?php 
	header('Content-Type', 'application/json');
	$requestId = $_POST["requestId"];
	include_once"../../dbConfig.php";
	
	$deleteServiceRequestResponse = array("success"=> FALSE);
	try{
		$query = $db->prepare("DELETE FROM serviceRequests WHERE Id = ?");
		$query->execute(array($requestId));
		$deleteServiceRequestResponse['success'] = TRUE;
	}catch(PDOException $ex){
		$deleteServiceRequestResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($deleteServiceRequestResponse);
?>
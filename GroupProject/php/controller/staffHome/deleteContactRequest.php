<?php
	header('Content-Type', 'application/json');
	$requestId = $_POST["requestId"];
	include_once"../../dbConfig.php";
	
	$deleteContactRequestResponse = array("success"=> FALSE);
	try{
		$query = $db->prepare("DELETE FROM contactUs WHERE Id = ?");
		$query->execute(array($requestId));
		$deleteContactRequestResponse['success'] = TRUE;
	}catch(PDOException $ex){
		$deleteContactRequestResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($deleteContactRequestResponse);
?>
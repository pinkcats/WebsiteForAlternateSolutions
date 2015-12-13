<?php
	header('Content-Type', 'application/json');
	session_start();
	$organizationKey = $_POST["organizationKey"];
	include_once "../../dbConfig.php";
	
	$organizationKeyResponse = array("success" => FALSE);
	try {
		$query = $db->prepare("SELECT Id FROM organization WHERE organizationKey = ?");
		$query->execute(array($organizationKey));
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		if($query->rowCount() == 1){
			$organizationKeyResponse['success'] = TRUE;
			$organizationKeyResponse['organizationId'] = $rows[0]['Id'];
		} 
	} catch(PDOException $ex) {
		echo "An Error occured!"; 
		echo $ex->getMessage();
	}
	
	echo json_encode($organizationKeyResponse);
?>
<?php
	header('Content-Type', 'application/json');
	$userId = $_POST["Id"];
	$date = $_POST["date"];
	$service = $_POST["service"];
	
	include_once "../dbConfig.php";
	
	$formatedDate = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
	
	$serviceRequestResponse = array("success" => FALSE);
	try {
		$query = $db->prepare("
		INSERT INTO serviceRequests
			(Id, serviceId, Date, userId) 
		VALUES 
			(NULL,?,?,?)
		");
		$query->execute(array($service, $formatedDate, $userId));
		if($query->rowCount() == 1){
			$serviceRequestResponse['success'] = TRUE;
		}
	} catch(PDOException $ex) {
		echo "Error on service request"; 
		echo $ex->getMessage();
	}
	
	echo json_encode($serviceRequestResponse);
?>
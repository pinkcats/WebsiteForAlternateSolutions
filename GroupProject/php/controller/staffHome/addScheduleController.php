<?php 
	header('Content-Type', 'application/json');
	$client = $_POST['scheduleClient'];
	$service = $_POST['scheduleService'];
	$startDate = $_POST['addScheduleStart'];
	$endDate = $_POST['addScheduleEnd'];
	include_once "../../dbConfig.php";
	
	$addScheduleResponse = array("success" => FALSE);
	try{
		$query = $db->prepare("INSERT INTO schedule (startDate, endDate, clientId, isArchived, serviceId) VALUES(?,?,?, 0, ?)");
		$query->execute(array($startDate, $endDate, $client, $service));
		if($query->rowCount() == 1){
			$addScheduleResponse['success'] = TRUE;
		}
	}catch(PDOException $ex){
		$addScheduleResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($addScheduleResponse);
?>
<?php 
	header('Content-Type', 'application/json');
	$startDate = $_POST['startDate'];
	$endDate = $_POST["endDate"];
	$service = $_POST["service"];
	include_once "../../dbConfig.php";
	include_once "../../userConfig.php";
	$filterResponse = array("success" => FALSE);
	if($startDate != "")
	{
		$startDate = date('Y-m-d', strtotime(str_replace('-', '/', $startDate)));
	}
	if($endDate != "")
	{
		$endDate = date('Y-m-d', strtotime(str_replace('-', '/', $endDate)));
	}
	try {
		//We are so, so sorry for this terrible query. We weren't able to figure out
		//how to properly declare mysql variables and this (somehow) worked so we had to
		//roll with it, unfortunately.
		$query = $db->prepare("
								SELECT 
									users.first_name AS firstName, 
									users.last_name AS lastName, 
									schedule.startDate AS startDate, 
									schedule.endDate AS endDate, 
									services.name AS serviceName,
									@start_date := ?,
									@end_date := ?,
									@service := ?
								FROM 
									schedule AS schedule
									INNER JOIN users AS users ON users.Id = schedule.clientId
									INNER JOIN services AS services ON services.Id = schedule.serviceId
								WHERE 
								(
								    (
								        @start_date := ? = ''
								        OR
								        @end_date := ? = '' 
								    )
								    OR
								    (
								        STR_TO_DATE(startDate, '%Y-%m-%d') <= STR_TO_DATE(@end_date := ?, '%Y-%m-%d')
								        AND
								        STR_TO_DATE(@start_date := ?, '%Y-%m-%d') <= STR_TO_DATE(endDate, '%Y-%m-%d')
								    )
								    
								)
								AND
								(
								    @service := ? = -1
								    OR
								    schedule.serviceId = @service := ?
								)
								AND
									users.Id = ?
								ORDER BY 
									startDate
		");
		$query->execute(array($startDate, $endDate, $service, $startDate, $endDate, $endDate, $startDate, $service, $service, $userId));
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		$filterResponse['success'] = TRUE;
		$filterResponse['rows'] = $rows;
	}catch(PDOException $ex){
		$filterResponse['errorMessage']  = $ex->getMessage();
	}
	
	echo json_encode($filterResponse);
	
?>

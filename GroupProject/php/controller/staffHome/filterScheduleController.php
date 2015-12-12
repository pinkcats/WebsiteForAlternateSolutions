<?php 
	header('Content-Type', 'application/json');
	$startDate = $_POST["startDate"];
	$endDate = $_POST["endDate"];
	$service = $_POST["service"];
	$client = $_POST["client"];
	if(isset($startDate) && isset($endDate)&&isset($service)&&isset($client)){
		$filterResponse = array("success" => FALSE);
		$query = $db->prepare("SET @start_Date = ?;
							SET @end_Date = ?;
							SET @service = ?;
							SET @client = ?;

							SELECT
							users.first_name, 
							users.last_name, 
							schedule.startDate, 
							schedule.endDate, 
							services.name 
							FROM users INNER JOIN schedule ON users.Id = schedule.clientId 
							INNER JOIN services ON schedule.serviceId = services.Id
							WHERE 
								(
									(
										@start_Date = NULL
										OR
										@end_Date = NULL 
									 )
									OR
									(
									  schedule.startDate <= @end_Date
									  AND
									  @start_Date <= schedule.endDate
									)
									
								)
								AND
								(
									@service = NULL
									OR
									schedule.serviceId = @service
								)
								AND
								(
									@client = NULL
									OR
									schedule.clientId = @client
								)");
		$query->execute(array($startDate, $endDate, $service, $client));
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		if($query->rowCount() == 1){
			$filterResponse['success'] = TRUE;
		}
	}catch{
		$filterResponse['errorMessage']  = $ex->getMessage();
	}
	
	echo json_encode($filterResponse);
?>
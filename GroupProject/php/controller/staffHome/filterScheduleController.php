<?php 
	header('Content-Type', 'application/json');
	$startDate = $_POST['startDate'];
	$endDate = $_POST["endDate"];
	$service = $_POST["service"];
	$client = $_POST["client"];
	include_once "../../dbConfig.php";
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
		$query = $db->prepare("
SELECT 
	users.first_name, 
	users.last_name, 
	schedule.startDate, 
	schedule.endDate, 
	services.name,
	@start_date := ?,
	@end_date := ?,
	@service := ?,
	@client := ?
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
        schedule.startDate <= @end_date := ?
        AND
        @start_date := ? <= schedule.endDate
    )
    
)
AND
(
    @service := ? = -1
    OR
    schedule.serviceId = @service := ?
)
AND
(
    @client := ? = -1
    OR
    schedule.clientId = @client := ?
)");
		$query->execute(array($startDate, $endDate, $service, $client, $startDate, $endDate, $endDate, $startDate, $service, $service, $client, $client));
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		$filterResponse['success'] = TRUE;
		$filterResponse['stuff'] = $rows;
	}catch(PDOException $ex){
		$filterResponse['errorMessage']  = $ex->getMessage();
	}
	
	echo json_encode($filterResponse);
	
?>

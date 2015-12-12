<?php 
	header('Content-Type', 'appplication/json');
	session_start();
	$username = $_POST["staffUser"];
	$password = $_POST["staffPass"];
	include_once"../dbConfig.php";
	
	$loginResponse = array("success" => FALSE);
	try{
		$query = $db->prepare("SELECT Id FROM users WHERE(email = ? AND password = ?) AND is_staff = 1");
		$query->execute(array($username, $password));
		$rows = $query->fetchALL(PDO::FETCH_ASSOC);
		if($query->rowCount() == 1){
			$loginResponse['success'] = TRUE;
		}
	}catch(PDOException $ex){
		echo "An Error occured!";
		echo $ex->getMessage();
	}
	echo json_encode($loginResponse);
?>
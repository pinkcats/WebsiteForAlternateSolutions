<?php 
	header('Content-Type', 'appplication/json');
	session_start();
	$username = $_POST["userName"];
	$password = $_POST["password"];
	include_once"../dbConfig.php";
	
	$loginResponse = array("success" => FALSE);
	try{
		$query = $db->prepare("SELECT Id FROM users WHERE(email = ? AND $password = ?) AND is_staff = 1");
		$query->execute(array($username, $password));
		$rows = $query->fetchALL(PDO::FETCH_ASSOC);
		if($query->rowCount() == 1){
			$_SESSION['userInformation'] = $rows;
			$loginResponse['success'] = TRUE;
			$loginResponse['isStaff'] = $rows[0]['is_staff'];
		}
	}catch(PDOException $ex){
		echo "An Error occured!";
		echo $ex->getMessage();
	}
	echo json_encode(loginResponse);
?>
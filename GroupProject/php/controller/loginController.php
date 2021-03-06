<?php
	header('Content-Type', 'application/json');
	session_start();
	$name = $_POST["userName"];
	$password = $_POST["password"];
	include_once "../dbConfig.php";
	
	$loginResponse = array("success" => FALSE);
	try {
		$query = $db->prepare("SELECT Id, first_name, last_name, (is_staff + 0) AS is_staff FROM users WHERE email = ? AND password = ?");
		$query->execute(array($name, $password));
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		if($query->rowCount() == 1){
			$_SESSION['userInformation'] = $rows;
			$loginResponse['success'] = TRUE;
			$loginResponse['isStaff'] = $rows[0]['is_staff'];
		}
	} catch(PDOException $ex) {
		echo "An Error occured!"; 
		echo $ex->getMessage();
	}
	
	echo json_encode($loginResponse);
?>
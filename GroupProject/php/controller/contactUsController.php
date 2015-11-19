<?php
	header('Content-Type', 'application/json');
	$name = $_POST["user"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	
	include_once "../dbConfig.php";
	$contactUsResponse = array("success" => FALSE);
	try {
		$query = $db->prepare("");
		$query->execute(array($name, $phone, $email, $subject, $message));
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		if($query->rowCount() == 1){
			$contactUsResponse['success'] = TRUE;
		}
	} catch(PDOException $ex) {
		echo "An Error occured!"; 
		echo $ex->getMessage();
	}
	
	echo json_encode($contactUsResponse);
?>
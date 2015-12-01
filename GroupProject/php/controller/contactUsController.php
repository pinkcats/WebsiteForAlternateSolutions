<?php
	header('Content-Type', 'application/json');
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	
	include_once "../dbConfig.php";
	$contactUsResponse = array("success" => FALSE);
	try {
		$query = $db->prepare("
			INSERT INTO 
				contactUs
				(
					Id,
					name,
					phone,
					email,
					subject,
					message
				)
			VALUES 
			 	(
			 		NULL,
			 		?,
			 		?,
			 		?,
			 		?,
			 		?
		 		);
		");
		$query->execute(array($name, $phone, $email, $subject, $message));
		if($query->rowCount() == 1){
			$contactUsResponse['success'] = TRUE;
		}
	} catch(PDOException $ex) {
		echo "Test"; 
		echo $ex->getMessage();
	}
	
	echo json_encode($contactUsResponse);
?>
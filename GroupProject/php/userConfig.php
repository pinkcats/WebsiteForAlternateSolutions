<?php
	session_start();
	if(!isset($_SESSION["userInformation"])){
		header("Location: clientPortal.php");
		die();
	}else {

		
		$userInformation = $_SESSION['userInformation'];
		$userId = $userInformation[0]["Id"];
		$userFirstName = $userInformation[0]["first_name"];
		$userLastName = $userInformation[0]["last_name"];
	}
?>
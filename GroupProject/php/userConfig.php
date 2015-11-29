<?php
	session_start();
	if(!isset($_SESSION["userInformation"])){
		header("Location: clientPortal.php");
		die();
	} else if($_SESSION['userInformation'][0]['is_staff'] == 1) {
		header("Location: staffHome.php");
		die();
	} else {
		$userInformation = $_SESSION['userInformation'];
		$userId = $userInformation[0]["Id"];
		$userFirstName = $userInformation[0]["first_name"];
		$userLastName = $userInformation[0]["last_name"];
	}
?>
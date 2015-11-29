<?php
	session_start();
	if(!isset($_SESSION["userInformation"])){
		header("Location: clientPortal.php");
		die();
	} else if($_SESSION['userInformation'][0]['is_staff'] == 0) {
		header("Location: clientHome.php");
		die();
	} else {
		$userInformation = $_SESSION['userInformation'];
		$staffId = $userInformation[0]["Id"];
		$staffFirstName = $userInformation[0]["first_name"];
		$staffLastName = $userInformation[0]["last_name"];
	}
?>
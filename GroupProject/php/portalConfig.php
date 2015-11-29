<?php
	session_start();
	//If user is logged in, redirect to necessary page
	if(isset($_SESSION["userInformation"])){
		$isStaff = $_SESSION['userInformation'][0]['is_staff'] == 0;
		$redirectLocation = ($isStaff) ? "staffHome.php" : "clientHome.php";
		header("Location: " . $redirectLocation);
		die();
	}
?>
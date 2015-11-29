<?php
	session_start();
	
	if($_GET['action'] === "logout"){
		session_destroy();
		session_unset();
		header("Location: clientPortal.php");
		die();
	} else if(isset($_SESSION["userInformation"])){
		$isStaff = $_SESSION['userInformation'][0]['is_staff'] == 0;
		$redirectLocation = ($isStaff) ? "staffHome.php" : "clientHome.php";
		header("Location: " . $redirectLocation);
		die();
	}
?>
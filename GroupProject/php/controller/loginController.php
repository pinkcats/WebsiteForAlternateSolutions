<?php
	$name = $_POST["userName"];
	$password = $_POST["password"];
	include_once "../dbConfig.php";
	
	try{
		$query = $db->prepare("SELECT Id FROM users Where email = ? AND password = ?");
		$query->execute(array($name, $password));
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $ex) {
		echo "An Error occured!"; 
		echo $ex->getMessage();
	}
	
	echo count($rows) > 0;
?>
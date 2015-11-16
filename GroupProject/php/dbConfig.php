<?php
	$db_hostname = 'localhost';
	$db_database = 'likwam29';
	$db_username = 'likwam29';
	$db_password = 'p561629';
	

	// Connect to the DB

	$db = new PDO("mysql:dbname=" . $db_database . ";host=localhost", $db_username, $db_password);

	// One of the big advantages of PDO objects is that they support
	// exception handling
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
	header('Content-Type', 'application/json');
	$title = $_POST["addSidebarLinkTitle"];
	$link = $_POST["addSidebarLinkAddress"];
	$isArchived = $_POST["addSidebarLinkisArchived"];
	include_once "../../dbConfig.php";
	
	$addSidebarLinkResponse = array("success" => FALSE);
	try {
		$query = $db->prepare
		("
			INSERT INTO 
				sidebarLinks
				(
					Id,
					title,
					link,
					isArchived
				)
			VALUES 
			 	(
			 		NULL,
			 		?,
			 		?,
			 		?
		 		);
		");
	
		$query->execute(array(
			$title, 
			$link, 
			$isArchived));
		if($query->rowCount() == 1){
			$addSidebarLinkResponse['success'] = TRUE;
		}
	} catch(PDOException $ex) {
		$addSidebarLinkResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($addSidebarLinkResponse);
?>
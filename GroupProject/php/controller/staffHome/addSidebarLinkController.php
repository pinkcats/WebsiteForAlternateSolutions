<?php
	header('Content-Type', 'application/json');
	$title = $_POST["addSidebarLinkTitle"];
	$link = $_POST["addSidebarLinkAddress"];
	$isArchived = $_POST["addSidebarLinkisArchived"];
	$isArchivedBool = boolval($isArchived);
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
			$isArchivedBool));
		$lastId = $db->lastInsertId();
		if($query->rowCount() == 1){
			$addSidebarLinkResponse['success'] = TRUE;
			$addSidebarLinkResponse['newLink'] = array(
				"id" => $lastId, 
				"title" => $title, 
				"link" => $link, 
				"isArchived" => $isArchived);
		}
	} catch(PDOException $ex) {
		$addSidebarLinkResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($addSidebarLinkResponse);
?>
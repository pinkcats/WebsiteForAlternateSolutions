<?php
	header('Content-Type', 'application/json');
	$title = $_POST["editSidebarLinkTitle"];
	$link = $_POST["editSidebarLinkAddress"];
	$isArchived = boolval($_POST["editSidebarLinkIsArchived"]);
	$id = $_POST["editSidebarLinkId"];
	include_once "../../dbConfig.php";
	
	$editSidebarLinkResponse = array("success" => FALSE);
	try {
		$query = $db->prepare
		("
			UPDATE  
				sidebarLinks 
			SET 
				title = ?,
				link = ?, 
				isArchived = ? 
			WHERE  
				Id = ?;
		");
	
		$query->execute(array(
			$title, 
			$link, 
			$isArchived,
			$id));
		$editSidebarLinkResponse['success'] = TRUE;
	} catch(PDOException $ex) {
		$editSidebarLinkResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($editSidebarLinkResponse);
?>
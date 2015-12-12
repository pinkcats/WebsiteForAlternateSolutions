<?php
	header('Content-Type', 'application/json');
	$linkId = $_POST["linkId"];
	include_once "../../dbConfig.php";
	
	$deleteSidebarLinkResponse = array("success" => FALSE);
	try {
		$query = $db->prepare
		("
			DELETE FROM 
				sidebarLinks
			WHERE
				Id = ?;
		");
	
		$query->execute(array(
			$linkId));
		$deleteSidebarLinkResponse['success'] = TRUE;
	} catch(PDOException $ex) {
		$deleteSidebarLinkResponse['errorMessage'] = $ex->getMessage();
	}
	
	echo json_encode($deleteSidebarLinkResponse);
?>
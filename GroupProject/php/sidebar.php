<?php
	include_once "dbConfig.php";
	try{
		$sidebarLinks = $db->prepare("SELECT Id, title, link, (isArchived + 0) AS isArchived FROM sidebarLinks");
		$sidebarLinks->execute(array());
		$sidebarLinksArr = $sidebarLinks->fetchAll(PDO::FETCH_ASSOC);
	}catch (PDOException $ex){
		echo "Something went wrong with getting the sidebar links"; 
		echo $ex->getMessage();
	}
?>
<div class="col-md-3" id="leftCol">
	<div class="well"> 
		<ul class="nav nav-stacked" id="sidebar">
			<?php foreach($sidebarLinksArr as $link){ ?>
				<tr>
					<li><a target="_blank" href="<?= $link['link']; ?>"><?= $link['title']; ?></a></li>
				</tr>
			<?php } ?>
	   </ul>
	</div>
</div> 
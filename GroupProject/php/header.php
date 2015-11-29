<?php
	session_start();
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.php">Alternative Resolutions</a>
	</div>
	<div id="navbar" class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="index.php">Home <?= $currentPath ?></a></li>
			<li><a href="articles.php">Articles</a></li>
			<li><a href="services.php">Services</a></li>
			<li><a href="clients.php">Clients</a></li>
			<li><a href="staff.php">Staff</a></li>
			<li><a href="contactUs.php">Contact Us</a></li>
			<?php
				if(isset($_SESSION["userInformation"])) {
					?>
					<li class="dropdown">
						<a href="clientPortal.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Portal <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<li><a href="clientPortal.php">Home</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="clientPortal.php?action=logout">Logout</a></li>
						</ul>
					</li>
					<?php
				} else { ?>
					<li><a href="clientPortal.php">Portal</a></li>
				<?php } ?>
		</ul>
	</div>
	</div>
</nav>
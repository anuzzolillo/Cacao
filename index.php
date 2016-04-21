<?php require_once("System/Config/Config.php"); ?>
<?php include("System/Includes/head.php"); ?>
<body>
	<?php include("System/Includes/aside.php"); ?>
	<main class="main">
		<div class="heading clearfix">
			Dashboard
			<?php include("System/Includes/alert.php"); ?>
		</div>
		<section class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="module">
						<div class="heading">Total Posts</div>
						<div class="value">
							<?php include("System/Controllers/totalArticlesController.php"); ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="module">
						<div class="heading">Visits</div>
						<div class="value">
							<?php include("System/Controllers/visitsController.php"); ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="module">
						<div class="heading">Online Users</div>
						<div class="value">
							<?php include("System/Controllers/onlineController.php"); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php include("System/Includes/posts.php"); ?>
				</div>
			</div>
		</section>
	</main>
	<script src="<?php echo BOARD; ?>/Public/js/pick.js"></script>
	
<?php include("System/Includes/footer.php"); ?>
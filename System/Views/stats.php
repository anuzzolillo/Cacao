<?php require("System/Config/Config.php"); CheckUserLogged($_SESSION["id"] ?? 0); ?>
<?php include("System/Includes/head.php"); ?>
<body>
	<?php include("System/Includes/aside.php"); ?>
	<main class="main">
		<div class="heading">
			Stats
			<?php include("System/Includes/alert.php"); ?>
		</div>
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="notification notification-info">
						<div class="inner">
							<div class="close">x</div>
						<p>En estos momentos no cuentas con un resumen estadístico. Usa Google Analytics.</p>
						</div>
					</div>
					<a href="http://www.google.com" target="_blank" class="btn btn-orange btn-addon btn-uppercase">
						<iv class="addon"><span class="fa fa-line-chart"></span></iv>
						<div class="text">Google Analytics</div>
					</a>
				</div>
			</div>
		</section>
	</main>

<?php include("System/Includes/footer.php"); ?>
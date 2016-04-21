<?php require("System/Config/Config.php"); CheckUserBeforeLogin($_SESSION["id"] ?? 0); ?>
<?php include("System/Includes/head.php"); ?>
<body class="login-template">
	<main class="main">
		<div class="vertical">
			<div class="container">
				<form action="<?php echo SYSTEM; ?>/Actions/Users/login.php" method="POST" name="Login" class="form" onsubmit="return false">
					<div class="modal">
						<div class="body">
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
							</div>
							<div class="form-group clearfix">
								<button class="btn btn-addon btn-info pull-right" onclick="fn_login()">
									<div class="addon"><span class="fa fa-key"></span></div>
									<div class="text">Login</div>
								</button>
								<a href="<?php echo URL; ?>" class="btn btn-default pull-right">Cancelar</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</main>
	<div class="notification notification-fixed notification-condensed hide">
		<div class="inner">
			<div class="close">x</div>
			<p></p>
		</div>
	</div>
	<script src="<?php echo BOARD; ?>/Public/js/login.js"></script>

<?php include("System/Includes/footer.php"); ?>
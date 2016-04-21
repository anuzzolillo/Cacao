<?php require("System/Config/Config.php"); CheckUserLogged($_SESSION["id"] ?? 0); ?>
<?php include("System/Includes/head.php"); ?>
<body>
	<?php include("System/Includes/aside.php"); ?>
	<main class="main">
		<div class="heading">
			Users
			<?php include("System/Includes/alert.php"); ?>
		</div>
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<?php include("System/Controllers/usersController.php"); ?>
					<form class="form slim" action="<?php echo SYSTEM; ?>/Actions/Users/update.php" method="POST" name="Sign" onsubmit="return false;" id="user">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="username">Nombre de usuario</label>
									<input type="text" class="form-control" name="username" id="username" autocomplete="off" value="<?php echo $data->username; ?>" required>
									<p class="info">Escriba el nombre de usuario para acceder al panel de administración.</p>
								</div>
								<div class="form-group">
									<label for="name">Nombre</label>
									<input type="text" class="form-control" name="name" id="name" autocomplete="off" value="<?php echo $data->name; ?>" required>
									<p class="info">Primer nombre real.</p>
								</div>
								<div class="form-group">
									<label for="last-name">Apellido</label>
									<input type="text" class="form-control" name="lastname" id="last-name" autocomplete="off" value="<?php echo $data->lastname; ?>" required>
									<p class="info">Primer apellido real.</p>
								</div>
								<div class="form-group">
									<label for="email">Correo electrónico</label>
									<input type="email" class="form-control" name="email" id="email" autocomplete="off" value="<?php echo $data->email; ?>" required>
									<p class="info">Con este e-mail usted podrá acceder.</p>
								</div>
								<div class="form-group">
									<label for="password">Contraseña</label>
									<input type="password" class="form-control" name="password" id="password" value="0000" required>
									<p class="info">Coloque una contraseña de acceso fuerte y recuérdela.</p>
								</div>
								<div class="form-group">
									<label for="password2">Confirmación de contraseña</label>
									<input type="password" class="form-control" name="password2" id="password2" value="0000" required>
									<p class="info">Confirme su contraseña.</p>
								</div>
								<div class="form-group clearfix">
									<button class="btn btn-addon btn-primary btn-uppercase pull-right" onclick="save()">
										<div class="addon"><span class="fa fa-check"></span></div>
										<span class="text">Guardar</span>
									</button>
								</div>
							</div>
							<div class="col-md-4">
								<button class="btn btn-success btn-addon btn-uppercase pull-right" onclick="fn_user();">
									<div class="addon"><span class="fa fa-users"></span></div>
									<span class="text">Invite user</span>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>
	<div class="notification notification-condensed notification-fixed notification-success hide">
		<div class="inner">
			<div class="close">x</div>
			<p>Operación exitosa.</p>
		</div>
	</div>
	<div class="notification notification-condensed notification-fixed notification-danger hide">
		<div class="inner">
			<div class="close">x</div>
			<p>Ocurrió un error.</p>
		</div>
	</div>
	<section class="fade">
		<div class="vertical-hack">
			<div class="vertical">
				<div class="inner">
					<form action="<?php echo SYSTEM ?>/Actions/Users/register.php" method="POST" onsubmit="return false" class="form slim" id="invite">
						<div class="modal">
							<div class="heading">
								Invitar Usuario
							</div>
							<div class="body">
								<div class="form-group">
									<label for="username">Usuario</label>
									<input type="text" class="form-control" name="username" id="username" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="password">Contraseña</label>
									<input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
								</div>
							</div>
							<div class="footer clearfix">
								<button class="btn btn-uppercase pull-right btn-primary" onclick="invite()">
									Invitar	
								</button>
								<button class="btn btn-uppercase pull-right btn-primary" onclick="fn_close()">
									Close	
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script>
		var save = function() {
			var form = $(".form#user");
			var method = form.attr("method");
			var action = form.attr("action");
			var dataString = form.serialize();
			var alert = $(".notification");
			var alertSuccess = $(".notification-success");
			var alertDanger = $(".notification-danger");

			$.ajax({
				type: method,
				url: action,
				data: dataString,
				success: function(html) {
					if(html > 0) {
						alertSuccess.fadeIn();
					} else {
						alertDanger.fadeIn();
					}
					setTimeout(function() {
						alert.fadeOut();
					}, 4000);
				}
			})
		}
		var invite = function() {
			var form = $(".form#invite");
			var method = form.attr("method");
			var action = form.attr("action");
			var dataString = form.serialize();
			var alert = $(".notification");
			var alertSuccess = $(".notification-success");
			var alertDanger = $(".notification-danger");

			$.ajax({
				type: method,
				url: action,
				data: dataString,
				success: function(html) {
					if(html > 0) {
						$(".form#invite input").val("");
						$(".fade").fadeOut();
						alertSuccess.fadeIn();
					} else {
						alertDanger.fadeIn();
					}
					setTimeout(function() {
						alert.fadeOut();
					}, 4000);
				}
			})
		}
	</script>
	<script>

		var fade = $(".fade");

		var fn_user = function() {
			fade.fadeIn();
		}
		var fn_close = function() {
			fade.fadeOut();
		}

	</script>
<?php include("System/Includes/footer.php"); ?>
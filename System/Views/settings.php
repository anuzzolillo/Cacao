<?php require("System/Config/Config.php"); CheckUserLogged($_SESSION["id"] ?? 0); ?>
<?php include("System/Includes/head.php"); ?>
<body>
	<?php include("System/Includes/aside.php"); ?>
	<main class="main">
		<div class="heading">
			Settings
			<?php include("System/Includes/alert.php"); ?>
		</div>
		<section class="container">
			<div class="row">
				<div class="col-md-8">
					<?php include("System/Controllers/settingsController.php"); ?>
					<form action="<?php echo SYSTEM; ?>/Actions/Page/update.php" method="POST" class="form slim" name="settings" onsubmit="return false;">
						<div class="form-group">
							<label for="title">Titulo de la página</label>
							<input type="text" name="title" class="form-control" id="title" required value="<?php echo $data->title; ?>">
							<p class="info">Escribe el titulo de la pagina que se verá en el Header.</p>
						</div>
						<div class="form-group">
							<label for="description">Descripción</label>
							<textarea name="description" id="description" class="form-control" required><?php echo $data->description; ?></textarea>
							<p class="info">Escribe una pequeña descripción que acompañará al titulo en el Header.</p>
						</div>
						<div class="form-group">
							<label for="owner">Dueño de la página</label>
							<input type="text" name="owner" class="form-control" id="owner" required value="<?php echo $data->owner; ?>">
							<p class="info">Nombre del dueño del sitio web.</p>
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" class="form-control" id="email" required value="<?php echo $data->email; ?>">
							<p class="info">Correo electrónico del dueño.</p>
						</div>
						<div class="form-group">
							<label>Avatar</label>
							<input type="file" name="file">
							<p class="info">Sube una imagen como Avatar.</p>
						</div>
						<div class="form-group">
							<label for="articles">Número de artículos por página</label>
							<input type="number" name="articles" id="articles" class="form-control" required value="<?php echo $data->articles; ?>">
							<p class="info">Elige cuantos artículos quieres mostrar por página.</p>
						</div>
						<div class="form-group">
							<label>Pagina en mantenimiento</label>
							<div class="switch">
								<div class="on <?php if($data->status == 0){ echo "active"; } ?>" data-status="0">SI</div>
								<div class="off <?php if($data->status == 1){ echo "active"; } ?>" data-status="1">NO</div>
								<input type="hidden" name="status" value="<?php echo $data->status; ?>" id="status">
							</div>
							<p class="info">Selecciona el estado en mantenimiento cuando la página esté cerrada.</p>
						</div>
						<div class="form-group clearfix">
							<button class="btn btn-primary pull-right btn-uppercase btn-addon" onclick="settings_update();">
								<div class="addon"><span class="fa fa-check"></span></div>
								<div class="text">Guardar</div>
							</button>
						</div>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</section>
	</main>
	<div class="notification notification-condensed notification-fixed notification-success hide">
		<div class="inner">
			<div class="close">x</div>
			<p>Cambios realizados con éxito.</p>
		</div>
	</div>
	<div class="notification notification-condensed notification-fixed notification-danger hide">
		<div class="inner">
			<div class="close">x</div>
			<p>Ocurrió un error.</p>
		</div>
	</div>
	<script src="Public/js/switch.js"></script>
	<script src="Public/js/settings.js"></script>

<?php include("System/Includes/footer.php"); ?>
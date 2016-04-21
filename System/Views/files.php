<?php require("System/Config/Config.php"); CheckUserLogged($_SESSION["id"] ?? 0); ?>
<?php include("System/Includes/head.php"); ?>
<body>
	<section class="fade">
		<div class="vertical-hack">
			<div class="vertical">
				<div class="container" style="margin: auto;">
					<form action="<?php echo SYSTEM; ?>/Actions/Files/upload.php" method="POST" enctype="multipart/form-data" name="files" class="form slim" id="ajax">
						<div class="modal">
							<div class="heading">Gestor de archivos</div>
							<div class="body">
								<div class="form-group">
									<label for="title">Titulo</label>
									<input type="text" class="form-control" id="title" name="title" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>Seleccionar archivo</label>
									<input type="file" name="file" id="file" required>
								</div>
							</div>
							<div class="footer clearfix">
								<button class="btn btn-addon btn-uppercase btn-success pull-right">
									<div class="addon"><span class="fa fa-upload"></span></div>
									<div class="text">Subir</div>
								</button>
								<button class="btn btn-default btn-uppercase pull-right btn-addon" onclick="close_manager();">
									<div class="addon"><span class="fa fa-remove"></span></div>
									<div class="text">Cancelar</div>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php include("System/Includes/aside.php"); ?>
	<main class="main">
		<div class="heading">
			Files
			<?php include("System/Includes/alert.php"); ?>
		</div>
		<section class="container">
			<div class="row">
				<div class="col-md-12 clearfix">
					<button class="btn btn-addon btn-success btn-uppercase pull-right" onclick="open_manager();">
						<div class="addon"><span class="fa fa-plus"></span></div>
						<span class="text">Nuevo Archivo</span>
					</button>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12 scrollable-t">
					<table class="table table-condensed table-hover table-complete files">
						<thead>
							<tr>
								<th></th>
								<th>Titulo</th>
								<th>Fecha</th>
								<th>Usuario</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
							<?php

							include("System/Controllers/filesController.php");
							while($num_rows > 0 AND $data = $query->fetch_object()) {
							
							?>
							<tr>
								<td width="70"><img src="<?php echo FILES; ?><?php echo $data->route; ?>" alt="<?php echo $data->alt; ?>"></td>
								<td><?php echo $data->route; ?></td>
								<td width="120"><?php echo $connection->When($data->time); ?></td>
								<td width="120"><?php echo $user->Who($data->user); ?></td>
								<td width="80"><button class="btn btn-sm btn-danger" data-action="<?php echo SYSTEM; ?>/Actions/Files/remove.php" data-method="POST" onclick="remove_file(<?php echo $data->id; ?>);">Eliminar</button></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</main>
	<div class="notification notification-condensed notification-fixed notification-success hide">
		<div class="inner">
			<div class="close">x</div>
			<p>Archivo subido con éxito.</p>
		</div>
	</div>
	<div class="notification notification-condensed notification-fixed notification-danger hide">
		<div class="inner">
			<div class="close">x</div>
			<p>Ocurrió un error.</p>
		</div>
	</div>
	<script src="<?php echo BOARD; ?>/Public/js/file.js"></script>
<?php include("System/Includes/footer.php"); ?>
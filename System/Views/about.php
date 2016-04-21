<?php require("System/Config/Config.php"); CheckUserLogged($_SESSION["id"] ?? 0); ?>
<?php include("System/Includes/head.php"); ?>
<body>
	<?php include("System/Includes/aside.php"); ?>
	<main class="main">
		<div class="heading">
			About
			<?php include("System/Includes/alert.php"); ?>
		</div>
		<section class="container">
			<?php

			include_once("System/Controllers/updateAboutController.php");

			?>
			<form action="<?php echo SYSTEM; ?>/Actions/Articles/about.php" method="POST" class="form" onsubmit="return false" name="Article">
				<div class="form-group">
					<input type="text" class="form-control title" name="title" placeholder="Title" value="<?php echo $p->title; ?>" required>
				</div>
				<div class="row" id="editor">
					<div class="col-md-6">
						<div class="form-group">
							<textarea v-model="input" name="markdown" placeholder="Write something" class="form-control" required><?php echo $p->markdown; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div v-html="input | marked" class="preview post" id="markdown"></div>
							<script>
							new Vue({
								el: '#editor',
								data: {
									input: ''
								},
								filters: {
									marked: marked
								}
							})
							</script>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<div class="notification notification-success notification-condensed hide">
								<div class="inner">
									<div class="close">x</div>
									<p>Cabmbio ralizado con éxito</p>
								</div>
							</div>
							<div class="notification notification-danger notification-condensed hide">
								<div class="inner">
									<div class="close">x</div>
									<p>Ha ocurrido un error.</p>
								</div>
							</div>
							<input type="hidden" name="content" id="html">
							<input type="hidden" name="article" value="<?php echo $p->id; ?>">
						</div>
					</div>
					<div class="col-md-2">
						<button class="btn btn-success pull-right btn-addon btn-uppercase" style="position:relative; top:4px;" onmouseover="keywordPress()" onclick="fn_UpdateAboutPage()">
							<div class="addon"><span class="fa fa-refresh"></span></div>
							<div class="text">Update</div>
						</button>
					</div>
				</div>
			</form>
		</section>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="<?php echo BOARD; ?>/Public/js/article.js"></script>
	
<?php include("System/Includes/footer.php"); ?>
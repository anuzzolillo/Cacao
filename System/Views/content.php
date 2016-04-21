<?php require("System/Config/Config.php"); CheckUserLogged($_SESSION["id"] ?? 0); ?>
<?php include("System/Includes/head.php"); ?>
<body>
	<?php include("System/Includes/aside.php"); ?>
	<main class="main">
		<div class="heading">
			Content
			<?php include("System/Includes/alert.php"); ?>
		</div>
		<section class="container">
			<form action="<?php echo SYSTEM; ?>/Actions/Articles/create.php" method="POST" class="form" onsubmit="return false" name="Article">
				<div class="form-group">
					<input type="text" class="form-control title" name="title" placeholder="Title" autocomplete="off" required>
				</div>
				<div class="row" id="editor">
					<div class="col-md-6">
						<div class="form-group">
							<textarea v-model="input" name="markdown" placeholder="Write something" class="form-control" required></textarea>
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
					<div class="col-md-9">
						<div class="form-group">
							<input type="text" class="form-control" name="tags" placeholder="Tags" autocomplete="off">
							<input type="hidden" name="content" id="html">
						</div>
					</div>
					<div class="col-md-3">
						<button class="btn btn-success pull-right btn-addon btn-uppercase" style="position:relative; top:4px;" onmouseover="keywordPress" onclick="fn_publish(1)">
							<div class="addon"><span class="fa fa-check"></span></div>
							<div class="text">Publish</div>
						</button>
						<button class="btn btn-danger pull-right btn-addon btn-uppercase" style="position:relative; top:4px;" onmouseover="keywordPress" onclick="fn_publish(0);">
							<div class="addon"><span class="fa fa-archive"></span></div>
							<div class="text">Draft</div>
						</button>
					</div>
				</div>
			</form>
		</section>
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="<?php echo BOARD; ?>/Public/js/article.js"></script>
	
<?php include("System/Includes/footer.php"); ?>
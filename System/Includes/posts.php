<?php
	/**
	* _________________________________________________________________________________________
	* 
	*  Require Resources
	* _________________________________________________________________________________________
	**/
	require_once("System/Models/Connection.php");
	require_once("System/Models/Article.php");

	/**
	* _________________________________________________________________________________________
	* 
	*  Call Article class
	* _________________________________________________________________________________________
	**/
	$article = new Models\Article;

	/**
	* _________________________________________________________________________________________
	* 
	*  Get All articles
	* _________________________________________________________________________________________
	**/
	$data = $article->get_all();
?>
<div class="module module-nopadding nowrap clearfix">
	<div class="post-list">
		<ul>
<?php
	/**
	* _________________________________________________________________________________________
	* 
	*  Process data
	* _________________________________________________________________________________________
	**/
	while($result = $data->fetch_object()) {

?>
			<li onclick="fn_pick(this, <?php echo $result->id ?>)">
				<div class="post-box">
					<div class="post-title"><?php echo $result->title; ?></div>
					<div class="post-date"><?php echo $result->update_date;  ?></div>
					<div class="post-status">
						<?php

						switch ($result->status) {
							case 1:
								echo "Published";
								break;
							
							default:
								echo "Draft";
								break;
						}

						?>
					</div>
				</div>
			</li>
<?php 
	/**
	* _________________________________________________________________________________________
	* 
	*  End 
	* _________________________________________________________________________________________
	**/
	} 
?>
		</ul>
	</div>
	<div class="post-content">
<?php 
	/**
	* _________________________________________________________________________________________
	* 
	*  Get last id
	* _________________________________________________________________________________________
	**/
	$last = $article->last();

	/**
	* _________________________________________________________________________________________
	* 
	*  Get Article By Id
	* _________________________________________________________________________________________
	**/
	if ($last > 0)
	$data = $article->GetArticleById($_GET["id"] ?? $last);

	/**
	* _________________________________________________________________________________________
	* 
	*  Process data
	* _________________________________________________________________________________________
	**/
	$num_rows = $data->num_rows;
	if ($num_rows > 0) {

		$result = $data->fetch_object();
?>
		<div class="info">
			<div class="title"><?php echo $result->title; ?></div>
			<div class="options">
				<div class="fa fa-eye" onclick="fn_visibility(<?php echo $result->id; ?>)"></div>
				<div class="fa fa-trash" onclick="fn_delete(<?php echo $result->id; ?>)"></div>
				<a href="<?php echo BOARD; ?>/edit.php?id=<?php echo $result->id; ?>" class="fa fa-edit"></a>
			</div>
		</div>
		<div class="content post" id="content">
			<?php echo $result->content; ?>
		</div>
	</div>
<?php
	/**
	* _________________________________________________________________________________________
	* 
	*  End
	* _________________________________________________________________________________________
	**/
	}
?>
</div>
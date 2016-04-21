<?php
	/**
	* _________________________________________________________________________________________
	* 
	*  Require Resources
	* _________________________________________________________________________________________
	**/
	require("../../Config/Config.php");

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
	*  Set Attibutes
	* _________________________________________________________________________________________
	**/
	if(isset($_POST["title"]) AND isset($_POST["content"])) {

	$article->set("id", $_POST["article"]);
	$article->set("title", $_POST["title"]);
	$article->set("markdown", $_POST["markdown"]);
	$article->set("content", $_POST["content"]);
	$article->set("tags", $_POST["tags"] ?? "");
	$article->set("date", date("d M, Y"));

	/**
	* _________________________________________________________________________________________
	* 
	*  Create article
	* _________________________________________________________________________________________
	**/
	$article->update();

	}

	/**
	* _________________________________________________________________________________________
	* 
	*  Avoid Repeat
	* _________________________________________________________________________________________
	**/
	$_POST["title"] = NULL;
	$_POST["content"] = NULL;

	/**
	* _________________________________________________________________________________________
	* 
	*  Redirect
	* _________________________________________________________________________________________
	**/
	//header("Location: " . URL);


?>
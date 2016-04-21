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
	$tag = new Models\Tag;

	/**
	* _________________________________________________________________________________________
	* 
	*  Set Attibutes
	* _________________________________________________________________________________________
	**/
	if(isset($_POST["title"]) AND isset($_POST["content"])) {

	$article->set("title", $_POST["title"]);
	$article->set("markdown", $_POST["markdown"]);
	$article->set("content", $_POST["content"]);
	$article->set("time", date("Y-m-d h:i:s"));
	$article->set("date", date("d M, Y"));
	$article->set("tags", $_POST["tags"] ?? "");
	$article->set("author", $_SESSION["id"]);
	$article->set("status", $_POST["status"]);

	$tag->SetAttribute("tag", $_POST["tags"] ?? NULL);

	/**
	* _________________________________________________________________________________________
	* 
	*  Create article
	* _________________________________________________________________________________________
	**/
	$article->create();
	$taf->Add();

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
<?php
	/**
	* _________________________________________________________________________________________
	* 
	*  Require Resources
	* _________________________________________________________________________________________
	**/
	require_once("../../Config/Config.php");

	/**
	* _________________________________________________________________________________________
	* 
	*  Call User class
	* _________________________________________________________________________________________
	**/
	$user = new Models\User;

	/**
	* _________________________________________________________________________________________
	* 
	*  Set user attributes
	* _________________________________________________________________________________________
	**/
	$user->set("username", $_POST["username"]);
	$user->set("password", $_POST["password"]);
	$user->set("email", $_POST["email"]);

	/**
	* _________________________________________________________________________________________
	* 
	*  Create user
	* _________________________________________________________________________________________
	**/
	if(isset($_SESSION["id"]) AND $_SESSION["id"] == 1) {
		$user->create();
		echo 1;
	} else {
		echo 0;
	}

	/**
	* _________________________________________________________________________________________
	* 
	*  Redirect
	* _________________________________________________________________________________________
	**/
	//header("Location:" . URL);


?>
<?php

	/**
	* _________________________________________________________________________________________
	* 
	*  Require Resources
	* _________________________________________________________________________________________
	**/
	require_once("System/Models/Connection.php");
	require_once("System/Models/User.php");

	/**
	* _________________________________________________________________________________________
	* 
	*  Call user class
	* _________________________________________________________________________________________
	**/
	$user = new Models\User;

	/**
	* _________________________________________________________________________________________
	* 
	*  SESSION DURATION
	* _________________________________________________________________________________________
	**/
	$user->SessionDuration();

?>
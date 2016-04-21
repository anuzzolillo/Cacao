<?php

	function CheckUserLogged(int $var) {
		if($var == 0) {
			header("Location:" . BOARD . "/login");
		} else {
			include_once("System/Controllers/statusController.php");
		}
	}

	function CheckUserBeforeLogin(int $var) {
		if($var > 0) {
			header("Location:" . BOARD);
		}
	}

?>
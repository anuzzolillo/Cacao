<?php namespace Config;

	class Autoload
	{
		// Metodos
		public static function play() {
			spl_autoload_register(function($class) {
					$ruta = "../../" . str_replace("\\", "/", $class) . ".php";
				if(is_readable($ruta)) {

					include_once $ruta;

				}
			});
		}
	}

?>
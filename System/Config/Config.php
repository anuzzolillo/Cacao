<?php

	/**
	* _________________________________________________________________________________________
	* 
	*  DEVELOPE
	* _________________________________________________________________________________________
	*
	* WarairaCMS es un proyecto creado por Jose Alvarado. Es un gestor de contenido simple para
	* bloguear. Aun le falta muchos detalles por crear y acomodar pero poco a poco se le irá
	* mejorando. WarairaCMS está compartido en el repositorio de Github del creador y se le
	* puede hacer cualquier tipo de cambio, mejora y adaptación para el sitio que se desee
	* utilizar.
	* _________________________________________________________________________________________
	**/


	/**
	* _________________________________________________________________________________________
	* 
	*  DATABASE 
	* _________________________________________________________________________________________
	*
	* Estos son los datos para configurar el acceso a la base de datos. Se trata de un arreglo
	* que contiene [Nombre del Servidor, Usuario de la base de datos, Contraseña de la base de
	* datos, Nombre de la base de datos]. La conexión se crea en un Modelo llamado Connection
	* ubicado en la carpeta Models.
	* _________________________________________________________________________________________
	**/
	define("SERVER", ["localhost","root","","waraira"]);
	define("HOST_DB", "localhost");
	define("USER_DB", "root");
	define("PASS_DB", "");
	define("BASE_DB", "waraira");

	/**
	* _________________________________________________________________________________________
	* 
	*  TIMEZONE
	* _________________________________________________________________________________________
	*
	* El Timezone es una configuración del horario que tomará el servidor para trabajar las
	* fechas. Se puede configurar según la localidad del servidor o el propietario.
	* _________________________________________________________________________________________
	**/
	date_default_timezone_set('America/Caracas');
	
	/**
	* _________________________________________________________________________________________
	* 
	*  RESOURCES
	* _________________________________________________________________________________________
	*
	* Algunos recursos son utilizados durante la sesión dentro del panel. Autoload es una clase
	* que carga los modelos necesarios, en algunos casos, para procesar acciones. Y Key es un
	* archivo que guarda un par de funciones para verificar si el usuario está o no loggeado.
	* _________________________________________________________________________________________
	**/
	require_once("Autoload.php");
	require_once("Key.php");
	
	/**
	* _________________________________________________________________________________________
	* 
	*  AUTOLOAD
	* _________________________________________________________________________________________
	**/
	Config\Autoload::play();

	/**
	* _________________________________________________________________________________________
	* 
	*  VISITS
	* _________________________________________________________________________________________
	*
	* Este bloque de código incluye un controlador que gestiona las visitas a la págona, sin
	* embargo durante la etapa de producción generó unos errores por lo que fue desactivado
	* hasta encontrarle solución. El error fue: max_user_connections y aunque en el servidor
	* locar funciona, en algunos servidores en línea no. Falta optomizarlo.
	* _________________________________________________________________________________________
	**/
	if(is_file("post.php")) {
		//include_once("dashboard/System/Controllers/catchVisitsController.php");
	}

	/**
	* _________________________________________________________________________________________
	* 
	*  SYSTEM
	* _________________________________________________________________________________________
	*
	* Las definiciones del sistema son definiciones de constanstes que básicamente se usará en
	* las URL al momento de requerirlo en un formulario o enlace. La definición que se debe
	* cambiar según el sitio web a utilizar es la URL (línea 95).
	* _________________________________________________________________________________________
	**/
	define("DS", DIRECTORY_SEPARATOR);
	define("ROOT", realpath(dirname(__FILE__)) . DS);
	define("URL", "http://localhost/proyecto");
	define("BOARD", URL);
	define("KEY", URL . "/login");
	define("SYSTEM", BOARD . "/System");
	define("FILES", BOARD . "/Public/articles/images/");
	
	/**
	* _________________________________________________________________________________________
	* 
	*  SESSION
	* _________________________________________________________________________________________
	*
	* Este bloque de código es tan solo una cartera de sesión que mantendrá los datos de la
	* sesión en toda la página, y en caso no existir una sesión los valores por defectode las
	* variables serán NULL.
	* _________________________________________________________________________________________
	**/
	if(session_start()) {
		$_SESSION["id"] ?? NULL;
		$_SESSION["username"] ?? NULL;
		$_SESSION["email"] ?? NULL;
	}

	/**
	* _________________________________________________________________________________________
	* 
	*  ERROR
	* _________________________________________________________________________________________
	*
	* En caso de que exista un error de acoplamiento entre una página y este archivo (Config)
	* Descomente la línea que ejecuta un ALERT que dice 'Acoplado'. Si el Alert aparece,
	* entonces el problema no es este archivo.
	* _________________________________________________________________________________________
	**/
	//echo "<script>alert('Acoplado');</script>";
?>
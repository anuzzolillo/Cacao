<?php namespace Models;

	class Connection
	{
		/**
		* _________________________________________________________________________________________
		* 
		*  To declare variables
		* _________________________________________________________________________________________
		**/
		private $mysqli;

		/**
		* _________________________________________________________________________________________
		* 
		*  Create Connection
		* _________________________________________________________________________________________
		**/
		public function __construct() {
			$this->mysqli = new \mysqli(HOST_DB,USER_DB,PASS_DB,BASE_DB);
			$this->mysqli->set_charset("utf8");
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Clear Strings
		* _________________________________________________________________________________________
		**/
		public function clear(string $string): string {
			$str = $this->mysqli->escape_string($string);
			return $str;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Make a simple query
		* _________________________________________________________________________________________
		**/
		public function query(string $string) {
			$this->mysqli->query($string);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Make a query with return
		* _________________________________________________________________________________________
		**/
		public function complex_query(string $string) {
			$data = $this->mysqli->query($string);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Fetch a query as object
		* _________________________________________________________________________________________
		**/
		public function fetch(string $string) {
			$data = $this->mysqli->query($string);
			return $data->fetch_object();
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Fetch a query as array
		* _________________________________________________________________________________________
		**/
		public function fetchArray(string $string) {
			$data = $this->mysqli->query($string);
			return $data->fetch_array();
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Convert timestamp to relative time
		* _________________________________________________________________________________________
		**/
		public function When(string $date): string {
			if(empty($date)) {
				return "No hay fecha";
			}

			$intervals = array("segundo","minuto","hora","día","semana","mes","año");
			$durations = array(60,60,24,7,4.35,12);

			$now = time();
			$unix = strtotime($date);

			if(empty($unix)) {
				return "Fecha incorrecta";
			}

			if($now > $unix) {
				$difference = $now - $unix - 43200;
				$time = "hace";
			} else {
				$difference = $unix - $now;
				$time = "dentro de";
			}

			for($i=0; $difference>=$durations[$i] && $i<count($durations)-1; $i++) {
				$difference /= $durations[$i];
			}

			$difference = round($difference);

			if($difference != 1) {
				$intervals[5] .="e";
				$intervals[$i] .= "s";
			}

			return "$time $difference $intervals[$i]";
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Friendly String
		* _________________________________________________________________________________________
		**/
		public function friendlyString(string $string): string {
			$string= utf8_decode($string);
			$string= strtolower($string);
			$string = str_replace(' ', '-', $string);
			$string = str_replace('?', '', $string);
			$string = str_replace('+', '', $string);
			$string = str_replace(':', '', $string);
			$string = str_replace('??', '', $string);
			$string = str_replace('`', '', $string);
			$string = str_replace('!', '', $string);
			$string = str_replace('¿', '', $string);
			$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
			$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
			$string = strtr($string, utf8_decode($originales), $modificadas);
			return $string;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Destroy Connection
		* _________________________________________________________________________________________
		**/
		public function Destroy() {
			mysqli_close($this->mysqli);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Destroy Class
		* _________________________________________________________________________________________
		**/
		public function __destruct() {
			$this->mysqli->close();
			unset($this);
		}
	}

?>
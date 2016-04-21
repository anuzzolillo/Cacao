<?php namespace Models;
	
	use Models\Connection as Connection;

	class File
	{
		/**
		* _________________________________________________________________________________________
		* 
		*  To declare variables
		* _________________________________________________________________________________________
		**/
		public $title;
		private $alt;
		private $date;
		private $user;
		private $file;
		private $route;
		private $mysqli;

		/**
		* _________________________________________________________________________________________
		* 
		*  Create Connection
		* _________________________________________________________________________________________
		**/
		public function __construct() {
			$this->mysqli = new Connection;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Set File attributes
		* _________________________________________________________________________________________
		**/
		public function set(string $key, string $value) {
			$this->$key = $this->mysqli->clear($value);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Catch File
		* _________________________________________________________________________________________
		**/
		public function catchFile($file) {
			$this->file = $file;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Insert new file
		* _________________________________________________________________________________________
		**/
		public function insert() {

			$sql = sprintf("INSERT INTO files (title,time,user,alt,route) VALUES ('%s','%s','%s','%s','%s')",
							$this->mysqli->friendlyString($this->title),
							$this->time,
							$this->user,
							$this->alt,
							$this->route);
			$this->mysqli->query($sql);

		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Upload new file
		* _________________________________________________________________________________________
		**/
		public function upload() {

			if(isset($this->title)) {
				$od = $this->file["tmp_name"];
				$f = $this->file["name"];
				$type = $this->file["type"];
				$type = explode("/", $type)[0];
				$ext = explode(".", $f)[1];
				if($type == "image") {

					$fd = $this->mysqli->friendlyString($this->title) . "." . $ext;
					$this->route = $fd;
					$fd = "../../../Public/articles/images/" . $fd;
					if(move_uploaded_file($od, $fd)) {
						echo 1;
						$this->insert();
						unset($this->title);
					} else {
						echo 0;
					}
				} else {
					echo 0;
				}
			} else {
				echo 0;
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Remove file
		* _________________________________________________________________________________________
		**/
		public function remove(int $id) {
			$sql = sprintf("SELECT route FROM files WHERE id=%s", $id);
			$d = $this->mysqli->complex_query($sql);
			$r = $d->fetch_object();
			unlink("../../../Public/articles/images/" . $r->route);
			$this->clear($id);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Clear file of DB
		* _________________________________________________________________________________________
		**/
		public function clear(int $id) {
			$sql = sprintf("DELETE FROM files WHERE id=%s", $id);
			$this->mysqli->query($sql);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get files
		* _________________________________________________________________________________________
		**/
		public function data() {
			$sql = sprintf("SELECT * FROM files ORDER BY id DESC");
			$data = $this->mysqli->complex_query($sql);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Destroy Class
		* _________________________________________________________________________________________
		**/
		public function __destruct() {
			unset($this);
		}
	}

?>
<?php namespace Models;
	
	use Models\Connection as Connection;

	class Page
	{
		/**
		* _________________________________________________________________________________________
		* 
		*  To declare variables
		* _________________________________________________________________________________________
		**/
		private $title;
		private $description;
		private $articles;
		private $owner;
		private $email;
		private $status;
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
		*  Set Page attributes
		* _________________________________________________________________________________________
		**/
		public function set(string $key, string $value) {
			$this->$key = $this->mysqli->clear($value);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Update page's information
		* _________________________________________________________________________________________
		**/
		public function update() {
			$sql = sprintf("UPDATE information SET title='%s', description='%s', owner='%s', email='%s', articles=%s, status=%s WHERE id=1",
							$this->title,
							$this->description,
							$this->owner,
							$this->email,
							$this->articles,
							$this->status);
			$this->mysqli->query($sql);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get data 
		* _________________________________________________________________________________________
		**/
		public function data() {
			$sql = sprintf("SELECT * FROM information WHERE id=1");
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
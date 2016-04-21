<?php namespace Models;

	use Models\Connection as Connection;

	class Visit
	{
		/**
		* _________________________________________________________________________________________
		* 
		*  To declare variables
		* _________________________________________________________________________________________
		**/
		private $ip;
		private $time;
		private $status;
		private $mysqli;

		/**
		* _________________________________________________________________________________________
		* 
		*  Create Connection and execute functions
		* _________________________________________________________________________________________
		**/
		public function __construct() {
			$this->mysqli = new Connection;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Catch user
		* _________________________________________________________________________________________
		**/
		public function Catch(string $ip) {
			$this->ip = $ip;
			$this->time = time();
			$this->status = 1;
			$this->RemoveOnline();
			$this->New();
			$this->InsertOnline();
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  New visit
		* _________________________________________________________________________________________
		**/
		public function New() {
			if(!isset($_SESSION["id"]) AND !empty($_SESSION["id"])) {
				$sql = sprintf("SELECT * FROM online WHERE ip='%s'", $this->ip);
				$data = $this->mysqli->complex_query($sql);
				$num_rows = $data->num_rows;
				$data->free();

				if($num_rows == 0) {
					$sql = sprintf("UPDATE information SET visits=visits+1 WHERE id=1");
					$this->mysqli->query($sql);
				}

			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Insert or Keep an user into the table
		* _________________________________________________________________________________________
		**/
		public function InsertOnline() {

			if(!empty($this->ip)) {
				$sql = sprintf("SELECT * FROM online WHERE ip='%s'", $this->ip);
				$data = $this->mysqli->complex_query($sql);
				$num_rows = $data->num_rows;
				$data->free();

				if($num_rows == 0) {
					$sql = sprintf("INSERT INTO online (ip,time,status) VALUES ('%s','%s',%s)",
									$this->ip,
									$this->time,
									$this->status);
				} else {
					$sql = sprintf("UPDATE online SET time='%s' WHERE ip='%s'",
									$this->time,
									$this->ip);
				}
				
				$this->mysqli->query($sql);
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Remove user
		* _________________________________________________________________________________________
		**/
		public function RemoveOnline() {
			$now = time();

			$sql = sprintf("SELECT * FROM online WHERE ip='%s'", $this->ip);
			$data = $this->mysqli->complex_query($sql);
			$num_rows = $data->num_rows;
			$result = $data->fetch_object();
			$data->free();

			if ($num_rows > 0) {

				$limit = $result->time + 60 * 6;

				if($now > $limit) {
					$sql = sprintf("DELETE FROM online WHERE time < $limit");
					$this->mysqli->query($sql);
				}
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Online visits
		* _________________________________________________________________________________________
		**/
		public function Online() {
			$sql = sprintf("SELECT * FROM online");
			$data = $this->mysqli->complex_query($sql);
			$num_rows = $data->num_rows;
			return $num_rows;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Total visits
		* _________________________________________________________________________________________
		**/
		public function total() {
			$sql = sprintf("SELECT visits FROM information");
			$data = $this->mysqli->complex_query($sql);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Destroy class
		* _________________________________________________________________________________________
		**/
		public function __destruct() {
			unset($this);
		}
	}


?>
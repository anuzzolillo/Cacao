<?php namespace Models;

	use Models\Connection as Connection;

	class Tag
	{
		/**
		* _________________________________________________________________________________________
		* 
		*  To declare variables
		* _________________________________________________________________________________________
		**/
		private $tag;
		private $id;
		private $count;
		private $mysqli;

		/**
		* _________________________________________________________________________________________
		* 
		*  Connection
		* _________________________________________________________________________________________
		**/
		public function __construct() {
			$this->mysqli- = new Connecion;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Set Attributes
		* _________________________________________________________________________________________
		**/
		public function SetAttribute(string $key, string $value) {
			$this->$key = $this->mysqli->clear($value);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Add Tag
		* _________________________________________________________________________________________
		**/
		public function Add() {
			if(!empty($this->tag) OR $this->tag != NULL) {
				$sql = sprintf("SELECT * FROM tags WHERE tag='%s'", $this->tag);
				$data = $this->mysqli->complex_query($sql);
				$num_rows = $data->num_rows;

				if($num_rows == 0) {
					$sql = sprintf("INSERT INTO tags (tag) VALUES ('{$this->tag}')");
				} else {
					$sql = sprintf("UPDATE tags SET count+=1 WHERE tag ='%s'", $this->tag);
				}
				
				$data->free();
				$this->mysqli->query($sql);
			}
		}

	}

?>
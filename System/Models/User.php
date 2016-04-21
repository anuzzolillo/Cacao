<?php namespace Models;

	use Models\Connection as Connection;

	class User
	{
		/**
		* _________________________________________________________________________________________
		* 
		*  To declare variables
		* _________________________________________________________________________________________
		**/
		private $username;
		private $name;
		private $lastname;
		private $password;
		private $email;
		private $mysqli;

		/**
		* _________________________________________________________________________________________
		* 
		*  Call Connection class
		* _________________________________________________________________________________________
		**/
		public function __construct() {
			$this->mysqli = new Connection;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Set value to variable
		* _________________________________________________________________________________________
		**/
		public function set(string $var, string $value) {
			$this->$var = $this->mysqli->clear($value);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Create user
		* _________________________________________________________________________________________
		**/
		public function create() {
			$username = $this->username;
			$email = $this->email;
			$password = password_hash(md5($this->password), PASSWORD_DEFAULT);

			if(isset($username) AND isset($password)) {

				$sql = sprintf("SELECT id FROM users WHERE username='%s' OR email='%s'", $username, $email);
				$query = $this->mysqli->complex_query($sql);
				$num_rows = $query->num_rows;

				if ($num_rows == 0) {

					$sql = sprintf("INSERT INTO users (username,password,email) VALUES
									('$username','$password','$email')");
					$this->mysqli->query($sql);

				}
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Start User Session
		* _________________________________________________________________________________________
		**/
		public function login(string $username, string $password) {
			if(isset($username) AND isset($password)) {

				$sql = sprintf("SELECT * FROM users WHERE username='$username' OR email='$username'");
				$query = $this->mysqli->complex_query($sql);
				$result = $query->fetch_object();
				$num_rows = $query->num_rows;
				$now = time();

				if($num_rows > 0) {
					if(password_verify(md5($password), $result->password)) {
						echo 1;
						$sql = sprintf("UPDATE users SET status=1, time=$now WHERE username='$username'");
						$this->mysqli->query($sql);

						$_SESSION["id"] = $result->id;
						$_SESSION["username"] = $result->username;
						$_SESSION["email"] = $result->email;
					} else {
						echo 0;
					}
				} else {
					echo -1;
				}
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Destroy Session
		* _________________________________________________________________________________________
		**/
		public function logout() {
			if(isset($_SESSION["id"])) {

				$sql = sprintf("UPDATE users SET status=0, time=0 WHERE id=%s", $_SESSION["id"]);
				$this->mysqli->query($sql);
				
				$_SESSION["id"] = NULL;
				$_SESSION["username"] = NULL;
				$_SESSION["email"] = NULL;

				unset($_SESSION["id"]);
				unset($_SESSION["username"]);
				unset($_SESSION["email"]);

				session_destroy();
			}

			header("Location:" . BOARD . "/login");
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  DISCONNECT user
		* _________________________________________________________________________________________
		**/
		public function SessionDuration() {
			if(isset($_SESSION["id"])) {

				$now = time();

				$sql = sprintf("SELECT time FROM users WHERE id=%s", $_SESSION["id"]);
				$data = $this->mysqli->complex_query($sql);
				$time = $data->fetch_object()->time;
				$limit = $time+(60*60);
				$data->free();

				if ($now > $limit) {

					$sql = sprintf("UPDATE users SET time=0, status=0 WHERE time < %s", $limit);

				} else {

					$sql = sprintf("UPDATE users SET time=%s WHERE id=%s",
									$now,
									$_SESSION["id"]);
				}
				$this->mysqli->query($sql);
				$this->CheckUserStatus();
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  CHECK STATUS
		* _________________________________________________________________________________________
		**/
		public function CheckUserStatus() {

			$sql = sprintf("SELECT status FROM users WHERE id=%s", $_SESSION["id"]);
			$data = $this->mysqli->complex_query($sql);
			$status = $data->fetch_object()->status;

			if($status == 0) {
				$this->logout();
			}

		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Update user data
		* _________________________________________________________________________________________
		**/
		public function update() {
			if($this->password == "0000") {
				$sql = sprintf("UPDATE users SET username='%s', name='%s', lastname='%s', email='%s' WHERE id=%s",
								$this->username,
								$this->name,
								$this->lastname,
								$this->email,
								$_SESSION["id"]);
			} else {
				$this->password = password_hash(md5($this->password), PASSWORD_DEFAULT);
				$sql = sprintf("UPDATE users SET username='%s', name='%s', lastname='%s', password='%s', email='%s'
								WHERE id=%s",
								$this->username,
								$this->name,
								$this->lastname,
								$this->password,
								$this->email,
								$_SESSION["id"]);
			}
			$this->mysqli->query($sql);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  DELETE user
		* _________________________________________________________________________________________
		**/
		public function Delete(int $id) {
			$id = $this->mysqli->clear($id);
			$sql = sprintf("DELETE FROM users WHERE id=%s", $id);
			$this->mysqli->query($sql);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get data from user by id
		* _________________________________________________________________________________________
		**/
		public function data(int $id) {
			$sql = sprintf("SELECT * FROM users WHERE id=%s", $this->mysqli->clear($id));
			$data = $this->mysqli->complex_query($sql);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get username
		* _________________________________________________________________________________________
		**/
		public function Who(int $id): string {
			$sql = sprintf("SELECT username FROM users WHERE id=%s", $id);
			$data = $this->mysqli->complex_query($sql);
			$result = $data->fetch_object();
			return $result->username;
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
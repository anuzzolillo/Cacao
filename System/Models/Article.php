<?php namespace Models;

	use Models\Connection as Connection;

	class Article
	{
		/**
		* _________________________________________________________________________________________
		* 
		*  To declare variables
		* _________________________________________________________________________________________
		**/
		private $id;
		private $title;
		private $markdown;
		private $content;
		private $tags;
		private $time;
		private $date;
		private $author;
		private $status;
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
		*  Set Article attributes
		* _________________________________________________________________________________________
		**/
		public function set(string $attr, string $value) {
			$this->$attr = $this->mysqli->clear($value);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Create New Article
		* _________________________________________________________________________________________
		**/
		public function create() {
			if(!empty($this->title) AND !empty($this->content) AND $this->title != NULL AND $this->content != NULL) {
				$this->seo = $this->mysqli->friendlyString($this->title) . ".html";
				$this->description = sprintf("<p>" . substr(strip_tags($this->content, "<a><strong><em><h1><h2><h3><h4><h5><h6><b><i><del><code>"), 0, 400)."... <a href=\"" . URL . "/post/" . $this->seo . " \" class=\"readmore\"><span class=\"fa fa-angle-double-right\"></span></a></p>");
				$sql = sprintf("INSERT INTO articles (title,seo,markdown,content,description,time,creation_date,update_date,tags,author,status)
								VALUES ('$this->title','$this->seo','$this->markdown','$this->content',
										'$this->description','$this->time','$this->date','$this->date',
										'$this->tags','$this->author','$this->status')");
				$this->mysqli->query($sql);
				echo 1;

				$this->title = NULL;
				$this->content = NULL;
				unset($this->title);
				unset($this->content);
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Update post
		* _________________________________________________________________________________________
		**/
		public function update() {
			if(!empty($this->title) AND !empty($this->content) AND $this->title != NULL AND $this->content != NULL) {
				$this->seo = $this->mysqli->friendlyString($this->title) . ".html";
				$this->description = sprintf("<p>" . substr(strip_tags($this->content, "<a><strong><em><h1><h2><h3><h4><h5><h6><b><i><del><code>"), 0, 400)."... <a href=\"" . URL . "/post/" . $this->seo . " \" class=\"readmore\"><span class=\"fa fa-angle-double-right\"></span></a></p>");
				$sql = sprintf("UPDATE articles SET title='%s', seo='%s', markdown='%s', content ='%s', description='%s', tags='%s', update_date='%s' WHERE id=%s",
								$this->title,
								$this->seo,
								$this->markdown,
								$this->content,
								$this->description,
								$this->tags,
								$this->date,
								$this->id);
				$this->mysqli->query($sql);
				echo 1;

				$this->title = NULL;
				$this->content = NULL;
				unset($this->title);
				unset($this->content);
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get Article By Id
		* _________________________________________________________________________________________
		**/
		public function GetArticleById(int $id) {
			$sql = sprintf("SELECT * FROM articles WHERE id = '$id'");
			$data = $this->mysqli->complex_query($sql);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get last id
		* _________________________________________________________________________________________
		**/
		public function last() {
			$sql = sprintf("SELECT id FROM articles ORDER BY id DESC");
			$data = $this->mysqli->complex_query($sql);
			$result = $data->fetch_object();
			$num_rows = $data->num_rows;

			if ($num_rows > 0)
				return $result->id;
			else
				return 0;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get All Articles
		* _________________________________________________________________________________________
		**/
		public function get_all() {
			$sql = sprintf("SELECT * FROM articles ORDER BY id DESC");
			$data = $this->mysqli->complex_query($sql);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get All Articles for Blog
		* _________________________________________________________________________________________
		**/
		public function blog(int $param) {
			$limit = 3;
			$count = 1;
			$page = $param;
			$end = $limit;

			if(!isset($page) OR $page<1 OR empty($page) OR $page==NULL) {
				$start= 0;
				$page = 1;
			} else {
				$start = ($page-1) * $end;
			}
			$sql = sprintf("SELECT * FROM articles");
			$data = $this->mysqli->complex_query($sql);
			$num_rows = $data->num_rows;

			if($num_rows > 0) {

				$sql = sprintf("SELECT * FROM articles WHERE status>0 ORDER BY id DESC LIMIT $start, $end");
				$data = $this->mysqli->complex_query($sql);

				$total = ceil($num_rows/$limit);

				$array = [$data, $total];
				return $array;
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  About's page
		* _________________________________________________________________________________________
		**/
		public function about() {
			$sql = sprintf("SELECT * FROM about WHERE id=1");
			$data = $this->mysqli->fetch($sql);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Update post
		* _________________________________________________________________________________________
		**/
		public function UpdateAboutPage() {
			if(!empty($this->title) AND !empty($this->content) AND $this->title != NULL AND $this->content != NULL) {
				$this->seo = $this->mysqli->friendlyString($this->title) . ".html";
				$this->description = sprintf("<p>" . substr(strip_tags($this->content, "<a><strong><em><h1><h2><h3><h4><h5><h6><b><i><del><code>"), 0, 400)."... <a href=\"" . URL . "/post/" . $this->seo . " \" class=\"readmore\"><span class=\"fa fa-angle-double-right\"></span></a></p>");
				$sql = sprintf("UPDATE about SET title='%s', markdown='%s', content ='%s', update_date='%s', author=%s WHERE id=1",
								$this->title,
								$this->markdown,
								$this->content,
								$this->date,
								$this->author);
				$this->mysqli->query($sql);
				echo 1;

				$this->title = NULL;
				$this->content = NULL;
				unset($this->title);
				unset($this->content);
			} else {
				echo 0;
			}
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Read article by SEO
		* _________________________________________________________________________________________
		**/
		public function read(string $seo) {
			$sql = sprintf("SELECT * FROM articles WHERE seo='$seo'");
			$data = $this->mysqli->fetch($sql);
			return $data;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Change post visibility (status)
		* _________________________________________________________________________________________
		**/
		public function visibility(int $id) {
			$this->set("id", $id);
			$sql = sprintf("SELECT status FROM articles WHERE id=%s", $this->id);
			$r = $this->mysqli->fetch($sql);
			if ($r->status == 0) {
				$this->status = 1;
			} else {
				$this->status = 0;
			}
			$sql = sprintf("UPDATE articles SET status=%s WHERE id=%s", $this->status, $this->id);
			$this->mysqli->query($sql);
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Get author of an article
		* _________________________________________________________________________________________
		**/
		public function author(int $id): string {
			$sql = sprintf("SELECT username FROM users WHERE id='$id'");
			$data = $this->mysqli->fetch($sql);
			return $data->username;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Total articless
		* _________________________________________________________________________________________
		**/
		public function total() {
			$data = $this->get_all();
			$num_rows = $data->num_rows;
			return $num_rows;
		}

		/**
		* _________________________________________________________________________________________
		* 
		*  Delete Article by Id
		* _________________________________________________________________________________________
		**/
		public function delete(int $id) {
			$sql = sprintf("DELETE FROM articles WHERE id='$id'");
			$this->mysqli->query($sql);
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
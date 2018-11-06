<?php

class Students extends MT_Module{
	public $db;
	public function __construct(){
		parent::__construct();
		$this->db = $this->localConnect();
	}
	function addDB(){
		$this->db->query("CREATE TABLE `products` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `title` varchar(50) NOT NULL,
			 `author` varchar(50) NOT NULL,
			 PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1")->execute();
	}

	public function index(){
		$data['rows'] = $this->db->query("select * from products")->resultSet();
		$this->view("index",$data);
	}
	/** handled via ajax to demonstrate routes **/
	public function add(){
		if(isset($_POST['_token']) && $_POST['_token']!='' && $_SESSION['csrf']==$_POST['_token'])
		{
			$title = $this->dbIN($_POST['title']);
			$author= $this->dbIN($_POST['author']);
			$this->db->query("insert into products (title,author) values 
				('$title','$author')")->execute();
			echo $this->db->lastInsertId();
		}else{
			echo "CSRF token required";
		}
	}
	public function update(){
		if(isset($_POST['_token']) && $_POST['_token']!='' && $_SESSION['csrf']==$_POST['_token'])
		{
			$title = $this->dbIN($_POST['title']);
			$author= $this->dbIN($_POST['author']);
			$id    = $_POST['id'];
			$this->db->query("update products set title='$title', author='$author' where id='$id'")->execute();
			echo $id;
		}else{
			echo "CSRF token required";
		}
	}
	public function delete(){
		if(isset($_POST['_token']) && $_POST['_token']!='' && $_SESSION['csrf']==$_POST['_token'])
		{
			$id    = $_POST['id'];
			$this->db->query("delete from products where id='$id'")->execute();
			echo $id;
		}else{
			echo "CSRF token required";
		}
	}

}
?>
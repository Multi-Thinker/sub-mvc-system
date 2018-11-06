<?php
	// PDO Database class
	// connect to Database
	// create prepared statements
	// bind values
	// return rows and results
	class Database {
		private $host = DB_HOST; 
		private $user = DB_USER; 
		private $pass = DB_PASS; 
		private $dbname = DB_NAME; 

		private $dbh; 
		private $stmt; 
		private $error; 

		public function __construct($dbname=''){
			//set dsn 
			$dbName = $dbname!='' ? $dbname : $this->dbname;
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $dbName; 
			$options = array(
				//increases performance by checking to see if there is already an existing connection with db
				PDO::ATTR_PERSISTENT => true, 
				//error handeling
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			); 

			//create a pdo instance 
			try{
				$this->dbh = new PDO($dsn, $this->user, $this->pass, $options); 

			} catch(PDOException $e){
				$this->error = $e->getMessage(); 
				echo $this->error; 
			}

		}
		public function __call($func,$arr){
			return $this->dbh->$func();
		}
		// create new database and return its object 
		public function create($dbName){
			$user  = $this->user;
			$pass  = $this->pass;
			$host  = $this->host;
			$db    = $dbName;
			    try {
			        $this->dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`;
			                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
			                GRANT ALL ON `$db`.* TO '$user'@'localhost';
			                FLUSH PRIVILEGES;") 
			        or die(print_r($this->dbh->errorInfo(), true));
			    } catch (PDOException $e) {
			        die("DB ERROR: ". $e->getMessage());
			    }
		}
		//make query, bind, value, execute
		//prepare statement with query
		public function query($sql){
			$this->stmt = $this->dbh->prepare($sql); 
			return $this;
		}
		//bind vlaues
		public function bind($param, $value, $type=null){
			if(is_null($type)){
				switch(true){
					case is_int($value):
						$type = PDO::PARAM_INT; 
						break; 
					case is_bool($value):
						$type = PDO::PARAM_BOOL; 
						break; 
					case is_null($value):
						$type = PDO::PARAM_NULL; 
						break; 
					default:
						$type = PDO::PARAM_STR;  
						break; 

				}
			}
			$this->stmt->bindValue($param, $value, $type); 
		}
		//execute the prepared statement
		public function execute(){
			return $this->stmt->execute();
		}

		//get results set as array of objects
		public function resultSet(){
			$this->execute(); 
			return $this->stmt->fetchAll(PDO::FETCH_OBJ); 
		}
		//get single record as object
		public function single(){
			$this->execute(); 
			return $this->stmt->fetch(PDO::FETCH_OBJ); 
		}
		//get row count
		public function rowCount(){
			return $this->stmt->rowCount(); 
		}
	}

?>
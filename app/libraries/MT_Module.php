<?php 			

class MT_Module{
	private $activePlugin; 
	public $path;
	public $local_database=NULL;
	public $parent_database=NULL;
	public $pluginName;
	public $counter=0;
	public function __construct(){
		session_start();
		$path 		= explode("/",explode("/module/",$_SERVER['REQUEST_URI'])[1]);
		$this->path = $path;
		$module     = isset($path[0]) ? strtolower($path[0]) ?? '' : '';
		if($module!=''){
			$this->pluginName = $module;
			if(!file_exists("../app/modules/".$module."/.checked")){
				$this->checkBasicFolders($module);
			}
		}
	}
	private function checkBasicFolders($PluginPath){
		$error 			 = false;
		if(!file_exists("../app/modules/".$PluginPath."/.checked")){
			if(!is_dir("../app/modules/".$PluginPath)){
				$error = true;
				die("the plugin requested doesn't exist");
			}
			$requiredFolders = ['controllers','views'];
			foreach ($requiredFolders as $key => $dir) {
				if(!is_dir("../app/modules/".$PluginPath."/".$dir)){
					$error = true;
					die("the plugin doesn't have required file structure");
				}
			}
			if(!$error){
				touch("../app/modules/".$PluginPath."/.checked");
				chmod("../app/modules/".$PluginPath."/.checked", 0777);
				$this->RegisterPlugin($PluginPath,true);
				
			}
		}
		if(!$error){
			$this->RegisterPlugin($PluginPath,false);
		}
	}
	private function RegisterPlugin($PluginPath,$create=true){
		if($create) $this->create($PluginPath);
	}
	private function create($db){
		$host 	= DB_HOST; 
		$user 	= DB_USER; 
		$pass 	= DB_PASS; 
		$dbname = DB_NAME; 
		 try {
	    	$dbh = new PDO("mysql:host=$host", $user, $pass);
	        $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`;
	                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
	                GRANT ALL ON `$db`.* TO '$user'@'localhost';
	                FLUSH PRIVILEGES;") 
	        or die(print_r($dbh->errorInfo(), true));
			$dbh = null;
	    } catch (PDOException $e) {
	        die("DB ERROR: ". $e->getMessage());
	    }
	}
	public function parentConnect(){
		if($this->parent_database==NULL){
			$this->parent_database = new Database();
		}
		return $this->parent_database;
	}
	public function localConnect(){
		if($this->local_database==NULL){
			$PluginPath = $this->pluginName;
			$this->local_database = new Database($PluginPath);
		}
		return $this->local_database;
	}
	public function view($view, $data = []){
			$module = $this->pluginName;
			$baseurl= "../app/modules/".$module. '/views/';
			$csrf   = md5(microtime());
			$path   = $this->path;
			$ci     = "/".URLROOT."/module/".$this->pluginName."/".$path[1];
			$_SESSION['csrf'] = $csrf;
			foreach($data as $key => $var){
				$$key = $var;
			}
			if(file_exists("../app/modules/".$module. '/views/'.$view.'.php')){
				require_once "../app/modules/".$module. '/views/'.$view.'.php'; 
			} else {
				die('View does not exist'); 
			} 
		}
	public function model($model){
			$model = ucfirst($model);
			require_once "../app/modules/".$module. '/models/'.$model.'.php'; 
			return new $model(); 
	}
	public static function dbIN($string){
        return htmlentities(htmlspecialchars(urldecode($string),ENT_QUOTES),ENT_QUOTES); 
    }
    public static function dbOut($string){
        return htmlspecialchars_decode(urldecode(html_entity_decode($string)));
    }
}
?>
<?php
	/*
	App Core Class
	*/
	class Core {
		protected $currentController = 'Pages'; 
		protected $currentMethod = 'index'; 
		protected $params = []; 

		public function __construct($modules=true){
			$url = $this->getUrl(); 
			$firstSegment = strtolower($url[0]);
			$root = '';
			$fallBack = '';
			$install  = '';
			if($firstSegment=="module"){
				if(!isset($url[1])) die("welcome to modules directory, specify a name now");
				$root = 'modules/'.strtolower($url[1])."/";
				$this->currentController = isset($url[2]) ? ucfirst($url[2]) : '';
				$this->currentMethod     = isset($url[3]) ? strtolower($url[3]) : '';
				$m = 3;
				$c = 2;
				if(file_exists("../app/".$root.strtolower($url[1]).".json")){
						$json 			= "../app/".$root.strtolower($url[1]).".json";
						$checkInstaller = json_decode(file_get_contents($json),true);
						$className 		= ucfirst($checkInstaller['controller']);
						$classPath      = "../app/".$root."controllers/".$className.".php";
						$default  		= isset($checkInstaller['default']) && $checkInstaller['default']!='' ? 
												 $checkInstaller['default'] : '';
						$fallBack 		= isset($checkInstaller['fallback']) && $checkInstaller['fallback']!='' ? 
												 ucwords($checkInstaller['fallback']) : '';
						$install 		= isset($checkInstaller['installation']) && $checkInstaller['installation']!='' ? 
												 $checkInstaller['installation'] : '';
						
				}
			}else{
				$this->currentMethod    = isset($url[1]) ? $url[1] : '';
				$m = 1;
				$c = 0;
			}
			if(isset($url[$c]) && $url[$c]!='' && file_exists('../app/'.$root.'controllers/' . ucwords($url[$c]) . '.php')){
				$this->currentController = ucwords($url[$c]); 
				unset($url[$c]); 
			}else{

					if(!isset($url[$c])){
						if(isset($className) && $className!=''){
							$this->currentController = $className;
						}else{
							die("<h1>Default Notice</h1><p>The controller you are looking for can't be found</p>");
						}
					}else if(!file_exists('../app/'.$root.'controllers/' . ucwords($url[$c]) . '.php')){
						if($fallBack!='' && file_exists('../app/'.$root.'controllers/' . ucwords($fallBack) . '.php')){
							echo "<b>Loaded: Fallback</b><br>";
							$this->currentController = $fallBack;
						}else{
							die("<h1>Default Notice</h1><p>The controller you are looking for can't be found</p>");
						}
					}
			}

			require_once '../app/'.$root.'controllers/' . $this->currentController . '.php'; 
			$this->currentController = new $this->currentController; 

			if($install!=''){
						if(!file_exists('../app/'.$root.'.install' )){
							if(method_exists($this->currentController, $install)){
								$this->currentController->$install();
							}
							touch('../app/'.$root.'.install');
							chmod('../app/'.$root.'.install', 0777);
						}
					}
			if(isset($url[$m]) && $url[$m]!=''){
				if(method_exists($this->currentController, $url[$m])){
					$this->currentMethod = $url[$m]; 
					unset($url[$m]); 

				}else{
					if(method_exists($this->currentController, "notFound")){
						$this->currentController->notFound();

					}else{
						echo "<h1>Default Notice</h1><p>The page you are looking for can't be found</p>";
					}
					die();
				}
			}else{
				if(!isset($url[$m])){
						$this->currentMethod = $default;
				}
			}
			$this->params = $url ? array_values($url) : []; 
			if($this->currentMethod!=''){
				if($firstSegment=="module" && !$this->currentController instanceof MT_Module){
					die("the class is not extending MT_Module");
				}
				call_user_func_array([$this->currentController, $this->currentMethod], $this->params); 
			}
		}
		public static function getUrl(){
			if(isset($_GET['url'])){
				$url = rtrim($_GET['url'], '/'); 
				$url = filter_var($url, FILTER_SANITIZE_URL); 
				$url = explode('/', $url); 
				return $url; 
			}
		}
		
	}
?>
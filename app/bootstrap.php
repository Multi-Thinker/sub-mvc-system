<?php
// error_reporting(0);
//** TALHA HABIB **//
spl_autoload_register(function($className){
	$enabledClasses = ['Core','MT_Module','Database','Controller'];
	if(in_array($className,$enabledClasses)){
		require_once 'libraries/' . $className . '.php'; 
	}
}); 
require_once 'config/config.php'; 
?>
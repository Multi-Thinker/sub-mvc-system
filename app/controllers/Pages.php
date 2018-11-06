<?php
	class Pages extends Controller {
		public function __construct(){
	
		}

		public function index(){             
			$data = [
				'title' => 'Welcome',
				'contacts' => 'none'
			]; 
			$this->view('pages/index', $data); 
		}

		public function about(){
			$data = [
				'title' => 'About Us'
			]; 

			$this->view('pages/about', $data); 
			 
		}

		public function notFound(){
			echo "the page you are looking for can't be found";
		}
	}			
?>
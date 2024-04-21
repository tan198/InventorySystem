<?php
	
	defined('BASEPATH') OR exit ('No direct script access allowed');

	class LanguageSwitch extends Admin_Controller{
 
		public function __construct()
		{
			parent::__construct();
		}

		public function switchLang($language=""){
			$language = ($language != "") ? $language : "english";
			$this->session->set_userdata('site_lang',$language);
			redirect($_SERVER['HTTP_REFERER']);
		}
		
	}
?>
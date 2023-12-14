<?php
	defined('BASEPATH') OR exit ('No direct script access allowed');

	class Loan extends Admin_Controller{
		public function __construct(){
			parent::__construct();
			$this->not_logged_in();
			$this->data['page_title'] = 'Loans';
			$this->load->model('Model_loan');
		}

		public function index(){
			if(!array('viewLoans', $this->permission)){
				redirect('dashboard','refresh');
			}

			$this->render_template('loans/index',$this->data);
		}
	}
?>
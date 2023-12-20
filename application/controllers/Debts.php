<?php
	defined('BASEPATH') OR exit ('No direct script access allowed');

	class Debts extends Admin_Controller{
		public function __construct(){
			parent::__construct();
			$this->not_logged_in();

			$this->data['page_title'] = 'Debts';
			$this->load->model('model_debt');
		}

		public function index(){
			if(!in_array('viewDebts', $this->permission)){
				redirect('dashboard','refresh');
			}

			$this->render_template('debts/index',$this->data);
		}

		public function fetchDebtsDataById($id){
			if($id){
				$data = $this->model_debt->getDebtsData($id);
				echo json_encode($data);
			}
			return false;
		}

		public function fetchDebtsData()
		{
			$result = array('data' => array());
	
			$data = $this->model_debt->getDebtsData();
	
			foreach ($data as $key => $value) {
				$repayment_period = date("d/m/Y",strtotime($value['thoiHanTra']));
				// button
				$buttons = '';
	
				if(in_array('updateLoans', $this->permission)) {
					$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['idKhoanNo'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
				}
	
				if(in_array('deleteLoans', $this->permission)) {
					$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idKhoanNo'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
				}
					
	
				//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
	
				$result['data'][$key] = array(
					$value['donViChoVay'],
					$value['soTien'],
					$repayment_period,
					$buttons
				);
			} // /foreach
	
			echo json_encode($result);
		}

		public function create()
		{
			if(!in_array('createDebts', $this->permission)) {
				redirect('dashboard', 'refresh');
			}
	
			$response = array();
	
			$this->form_validation->set_rules('debt_unit', 'Debt Unit', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('payment_period', 'Payment Period', 'trim|required');
	
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
	
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'donViChoVay' => $this->input->post('debt_unit'),
					'soTien' => $this->input->post('amount'),
					'thoiHanTra' => $this->input->post('payment_period'),	
				);
	
				$create = $this->model_debt->create($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the brand information';			
				}
			}
			else {
				$response['success'] = false;
				foreach ($_POST as $key => $value) {
					$response['messages'][$key] = form_error($key);
				}
			}
	
			echo json_encode($response);
		}
	

		public function update($id){
			if(!in_array('updateDebts', $this->permission)) {
				redirect('dashboard','refresh');
			}
			$response = array();
			if($id) {
				$this->form_validation->set_rules('edit_debt_unit', 'Edit Debt Unit', 'required|trim');
				$this->form_validation->set_rules('edit_amount', 'Edit Amount', 'required|trim');
				$this->form_validation->set_rules('edit_payment_period', 'Edit Payment Period', 'trim|required');
				
				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

				if($this->form_validation->run() == TRUE){
					$data = array(
						'donViChoVay' => $this->input->post('edit_debt_unit'),
						'soTien' => $this->input->post('edit_amount'),
						'thoiHanTra'=> $this->input->post('edit_payment_period')
					);

					$update = $this->model_debt->update($id,$data);

					if($update == true){
						$response['success'] = true;
						$response['messages'] = "Successfully updated";
					}else{
						$response['success'] = false;
						$response['messages'] = "Error in the database while updating the information";
					}
				}else{
					$response['success'] = false;
					foreach ($_POST as $key => $value) {
						$response['messages'][$key] = form_error($key);
					}
				}
			}else{
				$response['success'] = false;
				$response['messages'] = "Error please refresh the page again!!";
			}
			echo json_encode($response);
		}

		public function remove(){
			if(!in_array('deleteDebts',$this->permission)){
				redirect('dashboard','refresh');				
			}

			$id = $this->input->post('idKhoanNo');
			$response = array();

			if($id){
				$delete = $this->model_debt->remove($id);

				if($delete == true){
					$response['success'] = true;
					$response['messages'] = "Successfully removed";
				}else{
					$response['success'] = false;
					$response['messages'] = "Error in the database while removing the data";
				}
			}else{
				$response['success'] = false;
				$response['messages'] = "Refresh the page again!!";
			}
			echo json_encode($response);
		}
	}
?>